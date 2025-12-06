<x-user-layout>
    <x-slot:header>{{ $header }}</x-slot:header>
    <x-user.siswaIndex :pengajar='$pengajar' :mapels='$mapels' :siswas='$siswas' :jumlah='$jumlah' :childs='$wali'></x-user.siswaIndex>
</x-user-layout>
