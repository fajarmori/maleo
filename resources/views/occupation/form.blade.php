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
                        <x-input-label for="name" :value="__('Occupation')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name',$occupation->name)" autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="department" :value="__('Department')" />
                        <select id="department" name="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @if($page_meta['method'] === 'post')
                                <option selected>Choose department</option>
                            @endif
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" @if(isset($occupation->department->id)) {{ $department->id == $occupation->department->id ? 'selected' : '' }} @endif>({{ $department->code }}) {{ $department->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('department')" class="mt-2" />
                    </div>
                    <x-primary-button class="w-32">
                        {{ __('Save') }}
                    </x-primary-button>
                    <x-danger-button as="a" :href="route('occupations.index')" class="w-32">
                        {{ __('Back') }}
                    </x-danger-button>
                </form>
            </div>
        </div>
    </x-container>
</x-app-layout>
