<x-app-layout>
    @slot('title','GAIT Division')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('GAIT Division') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <x-primary-button as="a" href="{{ route('sites.index')}}">
                        {{ __('List Site') }}
                    </x-primary-button>
                </div>
            </div>
        </div>    
    </x-container>
</x-app-layout>