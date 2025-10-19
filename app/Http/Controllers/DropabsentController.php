<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DropabsentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absensis = Absensi::query()->latest()->paginate(50)->withQueryString();
        return view('absen', ['absensis' => $absensis]);
    }

    public function Drop()
    {
        Absensi::truncate();
        return redirect('absensi')->with(['berhasil' => 'data absensi berhasil dihapus']);
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
    public function edit(Absensi $absensi)
    {
        return view('absenEdit', ['absensi' => $absensi]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absensi $absensi)
    {
        Validator::make($request->all(), [
            'status' => 'required'
        ],[
            'required' => ':attribute wajib diisi'
        ])->validate();
        $absensi->update([
        'absensi' => $request->status,
        ]);
        return redirect('absensi')->with(['berhasil' => 'Absensi ' . $absensi->siswa->nama . ' berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
