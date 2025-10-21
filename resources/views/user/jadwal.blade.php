<x-user-layout>
    <x-slot:header>{{ $header }}</x-slot:header>
    <x-user.jadwal :jadwals='$jadwal' :tanggal='$hari'></x-user.jadwal>
</x-user-layout>
