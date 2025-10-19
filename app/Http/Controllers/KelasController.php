<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kelas', ['kelases' => Kelas::query()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelasCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(),[
            'kelas' => 'required|string|unique:'.Kelas::class,
            'category' => 'required'
        ],[
            'required' => ':attribute wajib diisi',
            'unique' => 'Kelas sudah ada',
            'string' => 'Hanya string'
        ])->validate();
        Kelas::create([
            'kelas' => $request->kelas,
            'category_id' => $request->category
        ]);
        return redirect('kelas')->with(['berhasil' => 'Kelas berhasil ditambah']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        $data = Siswa::where('kelas_id', '=', $kelas->id);
        if(request('cari')){
            $data->where('nama', 'like', '%' . request('cari') . '%');
        }
        return view('kelasShow', ['info' => $kelas->kelas, 'data' => $data->paginate(5)->withQueryString()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        return view('kelasUpdate', ['kelas' => $kelas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        Validator::make($request->all(),[
            'kelas' => 'required|string|unique:kelas,kelas,'.$kelas->id,
            'category' => 'required'
        ],[
            'required' => ':attribute wajib diisi',
            'unique' => 'Kelas sudah ada',
            'string' => 'Hanya string'
        ])->validate();
        $kelas->update([
            'kelas' => $request->kelas,
            'category_id' => $request->category
        ]);
        return redirect('kelas')->with(['berhasil' => 'Kelas ' . $kelas->kelas . ' berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $data = Siswa::where('kelas_id', '=', $kelas->id)->get();
        if(count($data) != 0){
            return redirect('kelas')->with(['tolak' => 'Sistem kami menjaga keutuhan data siswa! Terdapat ' . count($data) . ' siswa, pastikan tidak ada siswa yang terdaftar pada kelas ' . $kelas->kelas]);
        }
        $kelas->delete();
        return redirect('kelas')->with(['berhasil' => 'Kelas ' . $kelas->kelas . ' berhasil dihapus']);
    }
}
