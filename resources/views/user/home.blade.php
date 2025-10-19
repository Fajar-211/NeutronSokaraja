<x-user-layout>
    <x-slot:header>{{ $header }}</x-slot:header>
    <x-user.siswaIndex :pengajar='$pengajar' :mapels='$mapels' :siswas='$siswas' :jumlah='$jumlah'></x-user.siswaIndex>
</x-user-layout>
