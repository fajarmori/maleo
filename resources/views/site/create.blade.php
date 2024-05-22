<x-app-layout>
    @slot('title','Create a Site')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Site') }}
        </h2>
    </x-slot>
    
    <x-container>
        {{ __("Create a Site") }}
    </x-container>
</x-app-layout>
