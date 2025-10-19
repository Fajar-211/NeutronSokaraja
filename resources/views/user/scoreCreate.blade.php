<x-user-layout>
    @php
        $m = [];
        $k = [];
        foreach($kelas as $kls):
            $k[] = $kls['kelas'];
        endforeach;
        foreach($mapel as $mpl):
            $m[] = $mpl['nama_mapel'];
            $i[] = $mpl['id'];
        endforeach;
    @endphp
    <x-slot:header>{{ $header . $m[0] . ' into class ' . $k[0]}}</x-slot:header>
    <x-user.scoreCreate :siswas='$siswas' :mata='$i[0]' :kelas='$k[0]' :nm='$m[0]'></x-user.scoreCreate>
</x-user-layout>