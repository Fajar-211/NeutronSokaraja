<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail information') }}
        </h2>
    </x-slot>
    {{-- @php
        if(!empty($utbks)){
            dump($utbks);
        }
    @endphp --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.siswaShow :siswa='$siswa' :hadir='$hadir' :tidak='$tidak' :bulan='$bulan' :tahun='$tahun'></x-admin.siswaShow>
        </div>
    </div>
</x-app-layout>
