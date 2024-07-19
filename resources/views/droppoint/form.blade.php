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
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name',$droppoint->name)" autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="address" :value="__('Address')" />
                        <x-textarea id="address" name="address" rows="2" class="block mt-1 w-full">{{ old('address',$droppoint->address) }}</x-textarea>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="notes" :value="__('Notes')" />
                        <x-textarea id="notes" name="notes" rows="2" class="block mt-1 w-full">{{ old('notes',$droppoint->notes) }}</x-textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="department" :value="__('Department')" />
                        <select id="department" name="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="0">No Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" @if(isset($droppoint->department->id)) {{ $department->id == $droppoint->department->id ? 'selected' : '' }} @endif>{{ $department->code }} - {{ $department->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('department')" class="mt-2" />
                    </div>
                    <div id="site-select" class="{{ isset($droppoint->site->id) ? '' : 'hidden' }}">
                        <x-input-label for="site" :value="__('Site')" />
                        <select id="site" name="site" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="0">No Site</option>
                            @foreach($sites as $site)
                                <option value="{{ $site->id }}" @if(isset($droppoint->site->id)) {{ $site->id == $droppoint->site->id ? 'selected' : '' }} @endif>{{ $site->code }} - {{ $site->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('site')" class="mt-2" />
                    </div>
                    <x-primary-button class="w-32">
                        {{ __('Save') }}
                    </x-primary-button>
                    <x-danger-button as="a" :href="route('droppoints.index')" class="w-32">
                        {{ __('Back') }}
                    </x-danger-button>
                </form>
            </div>
        </div>
    </x-container>
</x-app-layout>
<script type="text/javascript">
$(document).ready(function() {
    $('#department').change(function(){ var data = $(this).val(); if(data == 2){ $('#site-select').removeClass('hidden'); }else{ $('#site-select').addClass('hidden'); $('#site').prop('selectedIndex',0); } });
});
</script>