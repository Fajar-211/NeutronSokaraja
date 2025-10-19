<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rapor</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #111;
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 8px;
        }
        .header img.logo-left {
            height: 50px;
        }
        .header .title {
            text-align: center;
            position: relative;
        }
        .header .title img {
            height: 18px;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }
        .header .title h1 {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }
        .header .title p {
            margin: 0;
            font-size: 10px;
        }
        .header .location {
            text-align: right;
            font-weight: bold;
        }
        .info-table {
            width: 100%;
            margin-bottom: 12px;
        }
        .info-table td {
            padding: 2px 6px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        .table th, .table td {
            border: 1px solid #ccc;
            padding: 4px 6px;
            text-align: left;
        }
        .table th {
            background: #f0f0f0;
            font-weight: bold;
        }
        .table thead th:first-child {
            border-top-left-radius: 4px;
        }
        .table thead th:last-child {
            border-top-right-radius: 4px;
        }
        .table tfoot th:first-child {
            border-bottom-left-radius: 4px;
        }
        .table tfoot th:last-child {
            border-bottom-right-radius: 4px;
        }
        h2 {
            font-weight: bold;
            margin: 16px 0 8px 0;
            font-size: 14px;
        }
        .notes {
            font-style: italic;
            color: #555;
            margin-bottom: 16px;
        }
        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 48px;
        }
        .signatures div {
            text-align: center;
        }
        .signatures p.title {
            font-weight: bold;
        }
        .siswa-page {
            page-break-after: always; /* pastikan tiap siswa ke halaman baru */
        }
        .siswa-page:last-child {
            page-break-after: auto; /* siswa terakhir ga perlu halaman baru kosong */
        }
    </style>
</head>
<body>
    @foreach ($siswas as $siswa)
        <div class="siswa-page">
            <!-- Header -->
    <div class="header">
        <div>
            <img src="{{ public_path('img/n.png') }}" alt="Logo" class="logo-left">
        </div>
        <div class="title">
            <h1>RAPOR</h1>
            <img src="{{ public_path('img/neu.png') }}" alt="Logo">
            <p>Laporan Hasil Belajar</p>
        </div>
        <div class="location">Purbalingga</div>
    </div>

    <!-- Identitas -->
    <table class="info-table">
        <tr>
            <td>Nama</td>
            <td>: {{ $siswa->nama }}</td>
        </tr>
        <tr>
            <td>Asal Sekolah</td>
            <td>: {{ $siswa->sekolah }}</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>: {{ $siswa->kelas->kelas }}</td>
        </tr>
    </table>

    <!-- Nilai UTBK -->
    @if ($siswa->kelas->category['category'] == 'kelas besar')
        <h2>Hasil Tryout UTBK</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>UTBK</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa->note->score as $score)
                    <tr>
                        <td>{{ $score->utbk->utbk }}</td>
                        <td>{{ $score->score }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Hasil Evaluasi -->
    <h2>Hasil Evaluasi</h2>
            <table class="table">
            <thead>
                <tr>
                    <th>Mapel</th>
                    @php 
                        $nilaiGrouped = $siswa->nilai->groupBy('mapel_id'); 
                        $maxNilai = $nilaiGrouped->max(fn($g) => $g->count()); 
                    @endphp
                    @for ($i=1; $i <= $maxNilai; $i++)
                        <th>Evaluasi {{ $i }}</th>
                    @endfor
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nilaiGrouped as $mapelId => $nilaiList)
                    <tr>
                        <td>{{ $nilaiList->first()->mapel->nama_mapel }}</td>
                        
                        {{-- nilai evaluasi --}}
                        @foreach ($nilaiList as $n)
                            <td>{{ $n->nilai }}</td>
                        @endforeach

                        {{-- kalau jumlah evaluasi mapel ini kurang dari max, tambahin kolom kosong --}}
                        @for ($i = $nilaiList->count(); $i < $maxNilai; $i++)
                            <td></td>
                        @endfor

                        {{-- catatan khusus mapel ini --}}
                        <td>
                            @php
                                // gabung semua catatan mapel ini jadi satu string (kalau lebih dari satu evaluasi)
                                $catatan = $nilaiList->pluck('catatan')->filter()->implode(', ');
                            @endphp
                            {{ $catatan }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    <!-- Kehadiran -->
    <h2>Rekap Kehadiran</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Mapel</th>
                <th>Hadir</th>
                <th>Absen</th>
            </tr>
        </thead>
        <tbody>
            @php
                 $hadir = $siswa->absen->where('absensi','hadir');
                $tidak = $siswa->absen->where('absensi','tidak hadir');
                $rekapHadir = $hadir->groupBy('mapel_id')->map->count(); 
                $rekapTidak = $tidak->groupBy('mapel_id')->map->count(); 
            @endphp
            @foreach ($siswa->mengambil as $mapel)
                <tr>
                    <td>{{ $mapel->nama_mapel }}</td>
                    <td>{{ $rekapHadir[$mapel->id] ?? 0 }}</td>
                    <td>{{ $rekapTidak[$mapel->id] ?? 0 }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Total</th>
                <td>{{ $hadir->count() }}</td>
                <td>{{ $tidak->count() }}</td>
            </tr>
        </tfoot>
    </table>

    <!-- Catatan -->
    @if ($siswa->kelas->category['category'] == 'kelas besar')
        <div class="notes">
            <p class="italic" style="color: red" >Catatan*</p>
            {{ $siswa->note->catatan }}
        </div>
    @endif

    <!-- Tanda tangan -->
    <!-- Tanda tangan -->
    <table style="width:100%; margin-top:20px; border:none;">
        <tr>
            <td style="width:50%; text-align:center; border:none;">
                <p style="font-weight:bold;">Kepala Cabang</p>
                <p style="margin-top:80px;">TRI SANTOSO</p>
            </td>
            <td style="width:50%; text-align:center; border:none;">
                <p style="font-weight:bold;">Koordinator Pendidik</p>
                <p style="margin-top:80px;">ARIYANTO TRI KUSUMO</p>
            </td>
        </tr>
    </table>
        </div>
    @endforeach
</body>
</html>
