<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajar = Auth::user(); // ambil user yg login
        // ambil semua mapel_id yang dia ampu
        $mapelIds = $pengajar->mengajar()->pluck('mapels.id');

        $kelasIds = Auth::user()->wali()->pluck('kelas_id');

        $siswasWali = Siswa::whereIn('kelas_id', $kelasIds);
        // if(request('nama')){
        //     $siswasWali = $siswasWali->where('nama', request('nama'));
        // }
        $listWali = $siswasWali->orderBy('nama', 'asc')->get();
        // query siswa yang ngambil mapel itu
        $siswas = Siswa::whereHas('mengambil', function ($q) use ($mapelIds) {
            $q->whereIn('mapel_id', $mapelIds);
        })->distinct();
        if(request('nama')){
            $siswas = Siswa::whereHas('mengambil', function ($q) use ($mapelIds) {
            $q->whereIn('mapel_id', $mapelIds);
        })->where('nama', '=', request('nama'))->distinct();
        }
        $jml = $siswas->count();
        return view('user.home', ['header' => 'home', 'pengajar' => Auth::user(), 'mapels' => $pengajar->mengajar()->get(), 'siswas' => $siswas->orderBy('nama', 'asc')->paginate(15)->withQueryString(), 'jumlah' => $jml , 'wali' => $listWali]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
