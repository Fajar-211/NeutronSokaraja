<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jams = Jam::query()->get();
        $schedulses = Schedule::query()->paginate(10)->withQueryString();
        return view('jadwal', ['jams' => $jams, 'schedules' => $schedulses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jadwalCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'pengajar' => 'required',
            'mapel' => 'required',
            'kelas' => 'required',
            'jam' => 'required',
            'tanggal' => 'required'
        ], [
            'required' => ':attribute wajib diisi'
        ]
        )->validate();
        Schedule::create([
            'pengajar_id' => $request->pengajar,
            'mapel_id' => $request->mapel,
            'kelas_id' => $request->kelas,
            'jam_id' => $request->jam,
            'tanggal' => $request->tanggal
        ]);
        return redirect('jadwal')->with(['berhasil' => 'Schedule berhasil ditambah']);
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
    public function edit(Schedule $schedule)
    {
        return view('jadwalEdit', ['schedule' => $schedule]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        Validator::make($request->all(), [
            'pengajar' => 'required',
            'mapel' => 'required',
            'kelas' => 'required',
            'jam' => 'required',
            'tanggal' => 'required'
        ], [
            'required' => ':attribute wajib diisi'
        ]
        )->validate();
        $schedule->update([
            'pengajar_id' => $request->pengajar,
            'mapel_id' => $request->mapel,
            'kelas_id' => $request->kelas,
            'jam_id' => $request->jam,
            'tanggal' => $request->tanggal
        ]);
        return redirect('jadwal')->with(['berhasil' => 'Schedule berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect('jadwal')->with(['berhasil' => 'Schedule berhasil dihapus']);
    }
}
