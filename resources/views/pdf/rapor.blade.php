<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rapor {{ $siswa->nama }}</title>
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
    </style>
</head>
<body>

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
        <div class="location">Sokaraja</div>
        <div>Periode {{ $bulan }} {{ $tahun }}</div>
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
    <!-- Hasil Evaluasi -->
    <h2>Hasil Evaluasi</h2>
    @php
        // Group nilai per mapel
        $nilaiGrouped = $siswa->nilai->groupBy('mapel_id');

        // Ambil jumlah max evaluasi antar mapel
        $maxNilai = $nilaiGrouped->max(fn($g) => $g->count());

        // Hitung jumlah hadir per mapel
        $rekapHadir = $hadir->groupBy('mapel_id')->map->count();
        $rekapTidakHadir = $tidak->groupBy('mapel_id')->map->count();
    @endphp

    <table class="table">
        <thead>
            <tr>
                <th>Mapel</th>

                @for ($i=1; $i <= $maxNilai; $i++)
                    <th>{{ $i }}</th>
                @endfor

                <th>Jml Pertemuan</th>
                <th>Jml Hadir</th>
                <th>%</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($siswa->mengambil as $mapel)
                @php
                    $nilaiList = $nilaiGrouped[$mapel->id] ?? collect([]);
                    $jumlahHadir = $rekapHadir[$mapel->id] ?? 0;
                    $jumlahTidakHadir = $rekapTidakHadir[$mapel->id] ?? 0;
                    $jumlahPertemuan = $jumlahHadir + $jumlahTidakHadir;
                    $persen = $jumlahPertemuan ? round(($jumlahHadir / $jumlahPertemuan) * 100) : 0;
                @endphp

                <tr>
                    <td>{{ $mapel->nama_mapel }}</td>

                    {{-- isi nilai evaluasi --}}
                    @foreach ($nilaiList as $n)
                        <td>{{ $n->nilai }}</td>
                    @endforeach

                    {{-- jika jumlah kurang dari max --}}
                    @for ($i = $nilaiList->count(); $i < $maxNilai; $i++)
                        <td></td>
                    @endfor

                    {{-- tabel attendance --}}
                    <td>{{ $jumlahPertemuan }}</td>
                    <td>{{ $jumlahHadir }}</td>
                    <td>{{ $persen }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tanda tangan -->
    <!-- Tanda tangan -->
    <table style="width:100%; margin-top:20px; border:none;">
        <tr>
            <td style="width:50%; text-align:center; border:none;">
                <p style="font-weight:bold;">Kepala Cabang</p>
                <p style="margin-top:80px;">Nama Kacab</p>
            </td>
            <td style="width:50%; text-align:center; border:none;">
                <p style="font-weight:bold;">Koordinator Pendidik</p>
                <p style="margin-top:80px;">Nama Koordinator</p>
            </td>
        </tr>
    </table>
    <div style="page-break-before: always;"></div>

<h2>Detail Kehadiran</h2>

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Mapel</th>
            <th>Absensi</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @php
            $jml = 1;
        @endphp
        @foreach ($listAbsensi as $absen)
        @php
            $tgl = \Carbon\Carbon::parse($absen->tanggal)->translatedFormat('d F Y');
        @endphp
        <tr>
            <td>{{ $jml }}</td>
            <td>{{ $absen->mapel->nama_mapel ?? '-' }}</td>
            <td>{{ ucfirst($absen->absensi) }}</td>
            <td>{{ $tgl }}</td>
        </tr>
        @php
            $jml ++;
        @endphp
        @endforeach
    </tbody>
</table>

</body>
</html>
