<x-user-layout>
    <x-slot:header>{{ $header }}</x-slot:header>
    <x-user.scoreselect :kelases='$kelas' :mapels='$mapels'></x-user.scoreselect>
    {{-- @php
        dump($kelas->category->category);
    @endphp --}}
</x-user-layout>