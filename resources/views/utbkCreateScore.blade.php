<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create UTBK Score') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin.utbkCreateScore :utbks='$utbks' :notes='$notes' :scores='$scores'></x-admin.utbkCreateScore>
        </div>
    </div>
</x-app-layout>
