<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajar = Auth::user();
        $kelas = Kelas::whereHas('siswa.mengambil', function ($q) use ($pengajar) {
            $q->whereIn('mapel_id', $pengajar->mengajar->pluck('id'));
        })->get();
        return view('user.score', ['header' => 'Score', 'kelases' => $kelas]);
    }

    public function utbkIndex()
    {
        $pengajar = Auth::user();
        $siswas = Siswa::whereHas('kelas.category', function ($q) {
                $q->where('category', 'kelas besar');
            })
            ->whereHas('mengambil', function ($q) use ($pengajar) {
                $q->whereIn('mapel_id', $pengajar->mengajar->pluck('id'));
            })
            ->get();
        return view('user.utbk', ['header' => 'UTBK note', 'siswas' => $siswas]);
    }
    public function notecreate(Request $request)
    {
        $datas = $request->catatan;
        foreach ($datas as $siswaId => $value) {
            // kalau kosong, bisa lo skip
            if ($value !== null) {
                Note::where('siswa_id', $siswaId)
                    ->update(['catatan' => $value]);
            }
        }
        return redirect('score')->with(['berhasil' => 'Note UTBK berhasil dirubah']);
    }
    public function showmapel(Kelas $kelas){
        $user = Auth::user();

        $mapels = $user->mengajar()
            ->whereHas('diambil', function ($q) use ($kelas) {
                $q->where('siswas.kelas_id', $kelas->id);
            })->withCount([
                'diambil as siswa_di_kelas_count' => function ($q) use ($kelas) {
                    $q->where('siswas.kelas_id', $kelas->id);
                }
            ])->get();

        return view('user.scoreshowmapel', [
            'header' => 'Select mapel in class ' . $kelas->kelas,
            'mapels' => $mapels,
            'kelas' => $kelas
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas_id = request('kelas');
        $mapel_id = request('mapel');

        $pengajar = Auth::user();

    // ambil semua mapel_id yang diampu pengajar login
    $mapelIds = $pengajar->mengajar()
        ->select('mapels.id') // kasih prefix biar jelas
        ->pluck('id');

    // pastikan mapel ini diampu pengajar
    if (!in_array($mapel_id, $mapelIds->toArray())) {
        abort(403, 'Kamu tidak mengampu mapel ini.');
    }

    // ambil siswa yang kelasnya sama dan mengambil mapel tersebut
    $siswas = Siswa::where('kelas_id', $kelas_id)
        ->whereHas('mengambil', function ($q) use ($mapel_id) {
            $q->where('mapels.id', $mapel_id); // prefix jelas biar ga ambigu
        });
        $kelas = Kelas::select('kelas')->where('id' ,'=', $kelas_id)->get();
        $mapel = Mapel::where('id', '=', $mapel_id)->get();
        return view('user.scoreCreate', ['header' => 'Insert score ' , 'siswas' => $siswas->orderBy('nama', 'asc')->paginate(20)->withQueryString(), 'kelas' => $kelas, 'mapel' => $mapel]);
    }
    public function insert(Siswa $siswa){
        $mapel = request('mapel');
        $nama_mapel = request('nm');
        $kelas = request('kelas');
        return view('user.scoreInsert', ['header' => 'Form evaluasi ' . $nama_mapel . ' on class ' . $kelas, 'siswa' => $siswa, 'mapel' => $mapel]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(),[
            'score' => 'required|numeric',
            'tanggal' => 'required',
            'catatan' => 'max:200'
        ],[
            'required' => ':attribute wajib dipilih',
            'max' => 'catatan maksimal 200 karakter'
        ])->validate();
        Nilai::create([
            'siswa_id' => $request->siswa,
            'pengajar_id' => $request->pengajar,
            'mapel_id' => $request->mapel,
            'nilai' => $request->score,
            'tanggal' => $request->tanggal,
            'catatan' => $request->note
        ]);
        return redirect('score')->with(['berhasil' => 'Nilai berhasil ditambah']);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
