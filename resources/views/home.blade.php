<x-app-layout>
    @slot('title','Home')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                {{ __("Welcome to MRIA Application") }}
            </div>
        </div>
    </x-container>
</x-app-layout>
