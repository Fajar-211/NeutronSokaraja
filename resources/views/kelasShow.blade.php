<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(count($data) . ' students in class ' . $info) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xs sm:rounded-lg">
                <x-admin.kelasShow :siswas='$data'></x-admin.kelasShow>
            </div>
        </div>
    </div>
</x-app-layout>
