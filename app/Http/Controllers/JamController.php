<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jadwalJam');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'start' => 'required',
            'end' => 'required'
        ], [
            'required' => 'jam wajib diisi'
        ])->validate();
        Jam::create([
            'start' => $request->start,
            'end' => $request->end
        ]);
        return redirect('jadwal')->with(['berhasil' => 'Jam berhasil ditambah']);
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
    public function edit(Jam $jam)
    {
        return view('jadwalJamEdit', ['jam' => $jam]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jam $jam)
    {
        Validator::make($request->all(), [
            'start' => 'required',
            'end' => 'required'
        ], [
            'required' => 'jam wajib diisi'
        ])->validate();
        $jam->update([
            'start' => $request->start,
            'end' => $request->end
        ]);
        return redirect('jadwal')->with(['berhasil' => 'Jam berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jam $jam)
    {
        $jam->delete();
        return redirect('jadwal')->with(['berhasil' => 'Jam berhasil dihapus']);
    }
}
