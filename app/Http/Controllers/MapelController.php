<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Mapel;
use App\Models\Mata_ujian;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapel = Mapel::query();
        if(request('cari')){
            $mapel->where('nama_mapel', 'like', '%' . request('cari') . '%');
        }
        return view('mapel', ['mapels' => $mapel->paginate(10)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryMapels = Category::where('category', '=', 'kelas kecil')->get();
        return view('mapelCreate', ['categories' => $categoryMapels]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(),[
            'nama_mapel' => 'required|string|unique:'.Mapel::class
        ],[
            'required' => 'Mapel wajib diisi',
            'unique' => 'Mapel sudah ada',
            'string' => 'hanya string'
        ])->validate();
        Mapel::create([
            'nama_mapel' => $request->nama_mapel,
            'slug' => Str::slug($request->nama_mapel)
        ]);
        return redirect('mapel')->with(['berhasil' => 'Mapel berhasil ditambah']);
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
    public function edit(Mapel $mapel)
    {
        return view('mapelUpdate', ['mapel' => $mapel]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mapel $mapel)
    {
        Validator::make($request->all(),[
            'nama_mapel' => 'required|string|unique:mapels,nama_mapel,'.$mapel->id,
        ],[
            'required' => 'Mapel wajib diisi',
            'unique' => 'Mapel sudah ada',
            'string' => 'hanya string'
        ])->validate();
        $mapel->update([
            'nama_mapel' => $request->nama_mapel,
            'slug' => Str::slug($request->nama_mapel)
        ]);
        return redirect('mapel')->with(['berhasil' => 'Mapel ' . $mapel->nama_mapel . ' berhasil dupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapel $mapel)
    {
        if($mapel->diambil()->exists() == true || $mapel->diajar()->exists() == true){
            return redirect('mapel')->with(['berhasil' => 'Sistem secara otomatis menjaga integritas data pengajar dan siswa. Saat ini anda tidak dizinkan oleh sistem untuk menghapus mata pelajaran ' . $mapel->nama_mapel]);
        }
        $mapel->diambil()->detach();
        $mapel->diajar()->detach();
        $mapel->delete();
        return redirect('mapel')->with(['berhasil' => $mapel->nama_mapel . ' berhasil dihapus']);
    }
}
