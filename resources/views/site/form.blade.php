<x-app-layout>
    @slot('title','Create a Site')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Site') }}
        </h2>
    </x-slot>
    
    <x-container>
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <form action ="{{ route('sites.store') }}" method="post" class="[&>div]:mb-3" novalidate>
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="owner" :value="__('Owner')" />
                        <x-text-input id="owner" class="block mt-1 w-full" type="text" name="owner" :value="old('owner')" autofocus />
                        <x-input-error :messages="$errors->get('owner')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="district" :value="__('District')" />
                        <x-text-input id="district" class="block mt-1 w-full" type="text" name="district" :value="old('district')" autofocus />
                        <x-input-error :messages="$errors->get('district')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="regency" :value="__('Regency')" />
                        <x-text-input id="regency" class="block mt-1 w-full" type="text" name="regency" :value="old('regency')" autofocus />
                        <x-input-error :messages="$errors->get('regency')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="province" :value="__('Province')" />
                        <x-text-input id="province" class="block mt-1 w-full" type="text" name="province" :value="old('province')" autofocus />
                        <x-input-error :messages="$errors->get('province')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" autofocus />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <x-primary-button class="w-32">
                        {{ __('Create') }}
                    </x-primary-button>
                    <x-danger-button as="a" href="{{ route('sites.index')}}" class="w-32">
                        {{ __('Back') }}
                    </x-danger-button>
                </form>
            </div>
        </div>
    </x-container>
</x-app-layout>