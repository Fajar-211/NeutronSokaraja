<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Set Time') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <x-admin.jadwalJamCreate></x-admin.jadwalJamCreate>
    </div>
</x-app-layout>
