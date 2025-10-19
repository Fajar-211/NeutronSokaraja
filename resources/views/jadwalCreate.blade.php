<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedule Create') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <x-admin.jadwalCreate></x-admin.jadwalCreate>
        </div>
    </div>
</x-app-layout>
