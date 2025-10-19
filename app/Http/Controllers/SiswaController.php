<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Category;
use App\Models\Kelas;
use App\Models\Note;
use App\Models\Siswa;
use App\Models\Ujian;
use App\Models\Utbk;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mpdf\Mpdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class SiswaController extends Controller
{
    public function all()
    {
        $siswas = Siswa::all(); // ambil semua siswa
        $pdf = Pdf::loadView('pdf.raporAll', ['siswas' => $siswas])->setPaper('A4', 'portrait');

        return $pdf->stream("rapor_semua_siswa.pdf");
    }
    public function download(Siswa $siswa)
    {
        // ambil data absensi
        $hadir = Absensi::where('siswa_id', $siswa->id)->where('absensi', 'hadir')->get();

        $tidak = Absensi::where('siswa_id', $siswa->id)->where('absensi', 'tidak hadir')->get();
        Carbon::setLocale('id');
        $tanggal = Carbon::now()->translatedFormat('d F Y');
        $arr = explode(' ', $tanggal);
        // generate PDF pake view
        $pdf = Pdf::loadView('pdf.rapor', [
            'siswa' => $siswa,
            'hadir' => $hadir,
            'tidak' => $tidak,
            'bulan' => $arr[1],
            'tahun' => $arr[2]
        ])->setPaper('A4', 'portrait');

        return $pdf->stream("rapor_{$siswa->nama}.pdf");

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::query();
        if(request('cari')){
            $siswa->where('nama', 'like', '%' . request('cari') . '%');
        }
        return view('siswa', ['siswas' => $siswa->orderBy('nama', 'asc')->paginate(20)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswaCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kelas = $request->kelas;
        $mpl = Kelas::where('id', '=', $kelas)->get('category_id');
        $category = Category::where('category', '=', 'kelas besar')->get('id');
        $category = $category->toArray();
        $mpl = $mpl->toArray();
        Validator::make($request->all(),[
            'nama' => 'required',
            'nis' => 'required|unique:'.Siswa::class,
            'sekolah' => 'required',
            'kelas' => 'required',
            'mapel' => 'required|array|min:1'
        ],[
            'required' => ':attribute wajib diisi',
            'unique' => 'NIS sudah ada',
            'mapel.required' => 'Minimal pilih 1 mata pelajaran.'
        ])->validate();
        $siswa= Siswa::create([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'nis' => $request->nis,
            'sekolah' => $request->sekolah,
            'kelas_id' => $request->kelas
        ]);
        $siswa->mengambil()->attach($request->mapel);
        if ($mpl[0]['category_id'] == $category[0]['id']) {
            $siswa->note()->create();
        }
        return redirect('siswa')->with(['berhasil' => 'Siswa berhasil ditambah']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        $hadir = Absensi::where('siswa_id', '=', $siswa['id'])->where('absensi', '=', 'hadir')->get();
        $tidak = Absensi::where('siswa_id', '=', $siswa['id'])->where('absensi', '=', 'tidak hadir')->get();
        Carbon::setLocale('id');
        $tanggal = Carbon::now()->translatedFormat('d F Y');
        $arr = explode(' ', $tanggal);
        return view('siswaShow',['siswa' => $siswa, 'hadir' => $hadir, 'tidak' => $tidak, 'bulan' => $arr[1], 'tahun' => $arr[2]]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        return view('siswaUpdate', ['siswa' => $siswa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $kelas = $request->kelas;
        $mpl = Kelas::where('id', '=', $kelas)->get('category_id');
        $category = Category::where('category', '=', 'kelas besar')->get('id');
        $category = $category->toArray();
        $mpl = $mpl->toArray();
        Validator::make($request->all(),[
            'nama' => 'required',
            'nis' => 'required|unique:siswas,nis,'.$siswa->id,
            'sekolah' => 'required',
            'kelas' => 'required',
            'mapel' => 'required|array|min:1'
        ],[
            'required' => ':attribute wajib diisi',
            'unique' => 'NIS sudah ada',
            'mapel.required' => 'Minimal pilih 1 mata pelajaran.'
        ])->validate();
        $siswaupdate = $siswa->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'nis' => $request->nis,
            'sekolah' => $request->sekolah,
            'kelas_id' => $request->kelas
        ]);
        $siswa->mengambil()->sync($request->mapel);
        if ($mpl[0]['category_id'] == $category[0]['id']) {
            $siswa->note()->create();
        }else{
            $siswa->note()->delete();
        }
        return redirect('siswa')->with(['berhasil' => $siswa->nama . ' berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->mengambil()->detach();
        $siswa->note()->delete();
        $siswa->nilai()->delete();
        $siswa->absen()->delete();
        $siswa->delete();
        return redirect('siswa')->with(['berhasil' => $siswa->nama . ' berhasil dihapus']);
    }
}
