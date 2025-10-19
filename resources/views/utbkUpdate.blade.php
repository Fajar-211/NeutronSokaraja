<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update UTBK') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.utbkUpdate :utbk='$utbk'></x-admin.utbkUpdate>
        </div>
    </div>
</x-app-layout>
