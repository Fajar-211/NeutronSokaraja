<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Utbk;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Category;
use App\Models\Utbkscore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class UtbkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $utbk = Utbk::query()->get();
        $siswas = Siswa::whereHas('kelas', function($query) {
        $query->whereHas('category', function($q) {
            $q->where('category', '=', 'kelas besar');
        });
    });
        // $siswas = Note::query()->paginate(20)->withQueryString();
        if(request('cari')){
            $siswas->where('nama', 'like', '%' . request('cari') . '%');
        }
        return view('utbk', ['utbks' =>  $utbk, 'siswas' => $siswas->paginate(20)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('utbkCreate');
    }

    public function createScore()
    {
        $utbks = Utbk::query()->get();
        $notes = Siswa::whereHas('kelas.category', function($query) {
            $query->where('category', 'kelas besar');
        })->get();
         $scores = Utbkscore::get()->mapWithKeys(function ($item) {
        return [$item->peserta_id . '_' . $item->utbk_id => $item->score];
    });
        // $notes = Note::get();
        return view('utbkCreateScore', ['utbks' => $utbks, 'notes' => $notes, 'scores' => $scores]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(),[
            'utbk' => 'required|unique:'.Utbk::class
        ],[
            'required' => 'Nama UTBK wajib diisi',
            'unique' => 'UTBK sudah ada'
        ])->validate();
        Utbk::create([
            'utbk' => $request->utbk
        ]);
        return redirect('utbk')->with(['berhasil' => 'UTBK berhasil ditambah']);
    }

    public function storescore(Request $request)
    {
        Validator::make($request->all(), [
            'scores.*.*' => 'numeric'
        ], [
            // 'required' => 'nilai wajib diisi',
            'numeric' => 'input harus angka'
        ])->validate();
         $scores = $request->input('scores');
         
        DB::transaction(function () use ($scores) {
        foreach ($scores as $siswaId => $utbkScores) {
            foreach ($utbkScores as $utbkId => $score) {
                $note = Note::where('siswa_id', $siswaId)->first(); 
                if (!$note) {
                    continue; // kalau siswa belum punya note, skip biar gak error
                }
                // update kalau sudah ada, kalau belum insert
                Utbkscore::updateOrCreate(
                    [
                        // 'peserta_id' => $siswaId,   // note_id
                        'peserta_id' => $note->id,
                        'utbk_id'    => $utbkId
                    ],
                    [
                        'score' => $score
                    ]
                );
            }
        }});
        return redirect('utbk')->with(['berhasil' => 'Nilai UTBK berhasil ditambah']);
    }

    public function utbk(Request $request, Siswa $siswa){
        $arr[] = $request->id;
        $score[] = $request->utbk;
        Validator::make($request->all(), [
            'utbk.*' => 'numeric'
        ], [
            // 'required' => 'nilai wajib diisi',
            'numeric' => 'input harus angka'
        ])->validate();
        $siswa->note->update([
            'catatan' => $request->catatan
        ]);
        
        for($i=0; $i<count($score[0]); $i++){
            $siswa->note->score()->create([
            'peserta_id' => $siswa['id'],
            'utbk_id' => $arr[0][$i],
            'score' => $score[0][$i]
            ]);
        }
        return redirect('utbk')->with(['berhasil' => 'Nilai UTBK berhasil ditambah']);
    }

    public function editscore(Request $request, Siswa $siswa){
        $inpu[] = $request->utbk;
        for($i=0; $i<count($inpu[0]); $i++){
            Utbkscore::where('peserta_id', '=', $siswa->note->id)
            ->where('utbk_id', '=', $request->id[$i])->update([
                'score' => $inpu[0][$i]
            ]);
        }
        return redirect('utbk')->with(['berhasil' => 'Nilai UTBK berhasil diperbarui']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Utbk $utbk)
    {
        return view('utbkUpdate', ['utbk' => $utbk]);
    }

    public function Drop()
    {
        // Hapus semua nilai UTBK dulu supaya foreign key aman
        Utbkscore::truncate();

        // Hapus semua catatan Note
        Note::query()->update(['catatan' => null]);

        // Reset auto-increment biar mirip truncate
        // DB::statement('ALTER TABLE notes AUTO_INCREMENT = 1');
        // DB::statement('ALTER TABLE utbkscores AUTO_INCREMENT = 1');

        return redirect('utbk')->with(['berhasil' => 'Nilai UTBK berhasil dihapus']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Utbk $utbk)
    {
        Validator::make($request->all(),[
            'utbk' => 'required|unique:utbks,utbk,'. $utbk->id
        ],[
            'required' => 'Nama UTBK wajib diisi',
            'unique' => 'UTBK sudah ada'
        ])->validate();
        $utbk->update([
            'utbk' => $request->utbk
        ]);
        return redirect('utbk')->with(['berhasil' => 'UTBK berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Utbk $utbk)
    {
        if($utbk->utbkscore()->exists() == true){
            return redirect('utbk')->with(['berhasil' => 'Sistem secara otomatis menjaga integritas data UTBK dan nilai UTBK. Saat ini anda tidak diizninkan untuk menghapus UTBK ' . $utbk['utbk'] . ' karena UTBK terhubung dengan nilai akhir']);
        }
        $utbk->delete();
        return redirect('utbk')->with(['berhasil' => 'UTBK berhasil dihapus']);
    }
}
