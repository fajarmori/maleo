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
        @if($countJourney > 0)
        <a href="{{ route('dashboard') }}">
            <div class="mb-6 bg-green-200 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="font-semibold">{{ __("Update employee journey") }}</div>
                    <div class="italic"><span class="font-semibold">{{ $countJourney }} journeys</span> , click here to see ...</div>
                </div>
            </div>
        </a>
        @endif
    </x-container>
</x-app-layout>
