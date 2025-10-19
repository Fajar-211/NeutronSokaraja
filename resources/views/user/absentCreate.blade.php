<x-user-layout>
    @php
        $mpl = [];
        $kls = [];
        foreach($kelas as $k):
            $kls[] = $k['kelas'];
        endforeach;
        foreach($mapel as $mp):
            $mpl[] = $mp['nama_mapel'];
        endforeach
    @endphp
    <x-slot:header>{{ $header . $mpl[0] . ' in class ' . $kls[0]}}</x-slot:header>
    <x-user.absencreate :siswas='$siswa' :mapels='$mapel'></x-user.absencreate>
    @push('date')
        <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    @endpush
</x-user-layout>