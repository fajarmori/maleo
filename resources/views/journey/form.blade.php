<x-app-layout>
    @slot('title',$page_meta['title'])
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $page_meta['title'] }}
        </h2>
    </x-slot>
    
    <x-container>
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{ $page_meta['url'] }}" method="post" class="[&>div]:mb-3" novalidate>
                    @method($page_meta['method'])
                    @csrf
                    <div>
                        <x-input-label for="event" :value="__('Event')" />
                        <x-text-input id="event" class="block mt-1 w-full" type="text" name="event" :value="old('event',$journey->event)" autofocus />
                        <x-input-error :messages="$errors->get('event')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="site" :value="__('Site')" />
                        <x-text-input id="site" class="block mt-1 w-full" type="text" name="site" :value="old('site',$journey->site)" autofocus />
                        <x-input-error :messages="$errors->get('site')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="application" :value="__('Application')" />
                        <x-text-input id="application" class="block mt-1 w-full" type="text" name="application" :value="old('application',$journey->application)" autofocus />
                        <x-input-error :messages="$errors->get('application')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="origin" :value="__('Origin')" />
                        <x-text-input id="origin" class="block mt-1 w-full" type="text" name="origin" :value="old('origin',$journey->origin)" autofocus />
                        <x-input-error :messages="$errors->get('origin')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="destination" :value="__('Destination')" />
                        <x-text-input id="destination" class="block mt-1 w-full" type="text" name="destination" :value="old('destination',$journey->destination)" autofocus />
                        <x-input-error :messages="$errors->get('destination')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="date" :value="__('Date')" />
                        <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date',$journey->date)" autofocus />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="transportation" :value="__('Transportation')" />
                        <x-text-input id="transportation" class="block mt-1 w-full" type="text" name="transportation" :value="old('transportation',$journey->transportation)" autofocus />
                        <x-input-error :messages="$errors->get('transportation')" class="mt-2" />
                    </div>
                    <x-primary-button class="w-32">
                        {{ __('Save') }}
                    </x-primary-button>
                    <x-danger-button as="a" :href="route('journeys.index')" class="w-32">
                        {{ __('Back') }}
                    </x-danger-button>
                </form>
            </div>
        </div>
    </x-container>
</x-app-layout>
