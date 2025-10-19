<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class DropnilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nilais = Nilai::query();
        if(request('cari')){
            $nilais->where('pengajar_id');
        }
        return view('nilai', ['nilais' => $nilais->latest()->paginate(50)->withQueryString()]);
    }
    public function Drop()
    {
        Nilai::truncate();
        return redirect('nilai')->with(['berhasil' => 'Data nilai kelas kecil berhasil dihapus']);
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
    public function edit(Nilai $nilai)
    {
        return view('nilaiEdit', ['nilai' => $nilai]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nilai $nilai)
    {
        $nilai->update([
            'nilai' => $request->nilai,
            'catatan' => $request->catatan
        ]);
        return redirect('nilai')->with(['berhasil' => 'Nilai ' . $nilai->milik->nama . ' berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return redirect('nilai')->with(['berhasil' => 'Nilai berhasil dihapus']);
    }
}
