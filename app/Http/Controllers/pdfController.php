<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Absensi;
use Illuminate\Http\Request;
use PDF;
class pdfController extends Controller
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
    public function show(Siswa $siswa)
{
    $hadir = Absensi::where('siswa_id', $siswa->id)->where('absensi', 'hadir')->get();
    $tidak = Absensi::where('siswa_id', $siswa->id)->where('absensi', 'tidak hadir')->get();

    $html = view('pdf.rapor', [
        'siswa' => $siswa,
        'hadir' => $hadir,
        'tidak' => $tidak
    ])->render();

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    return $mpdf->Output("rapor-{$siswa->nama}.pdf", 'I');
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
