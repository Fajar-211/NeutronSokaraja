<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AbsenController extends Controller
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
        return view('user.absent', ['header' => 'Student absent', 'kelases' => $kelas]);
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
        })->orderBy('nama', 'asc')->get();
        $kelas = Kelas::select('kelas')->where('id' ,'=', $kelas_id)->get();
        $mapel = Mapel::where('id', '=', $mapel_id)->get();
        return view('user.absentCreate', ['header' => 'Absence from ', 'siswa' => $siswas , 'kelas' => $kelas, 'mapel' => $mapel]);
    }

    public function Showmap(Kelas $kelas)
    {
        $user = Auth::user();

        $mapels = $user->mengajar()
            ->whereHas('diambil', function ($q) use ($kelas) {
                $q->where('siswas.kelas_id', $kelas->id);
            })
            ->withCount([
                'diambil as siswa_di_kelas_count' => function ($q) use ($kelas) {
                    $q->where('siswas.kelas_id', $kelas->id);
                }
            ])->get();

        return view('user.absentshowmapel', [
            'header' => 'Select mapel in class ' . $kelas->kelas,
            'mapels' => $mapels,
            'kelas' => $kelas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $siswa = $request->siswa;
        Validator::make($request->all(), [
            // 'siswa' => 'required|array|min:1',
            'tanggal' => 'required',
            'sumary' => 'required|max:200'
            // 'mapel.*'   => 'exists:mapels,id',
        ],[
            'required' => ':attribute wajib diisi',
            'max' => ':attribute maksimal 200 karakter',
            // 'siswa.required' => 'Minimal pilih 1 siswa.',
            // 'siswa.min'      => 'Minimal pilih 1 siswa.',
        ])->validate();
        foreach ($request->all as $siswaId) {
            if($siswa == null){
                $status = 'tidak hadir';
            }else{
                if(in_array($siswaId, $siswa)){
                    $status = 'hadir';
                }else{
                    $status = 'tidak hadir';
                }
            }
            Absensi::create([
                'user_id' => $request->pengajar,
                'siswa_id'    => $siswaId,
                'mapel_id' => $request->mapel,
                'tanggal'     => $request->tanggal,
                'absensi' => $status,
                'sumary'     => $request->sumary,
            ]);
        }
        return redirect('absent')->with(['berhasil' => 'Absensi berhasil']);
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
