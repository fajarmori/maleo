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
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name',$employee->name)" autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="nik" :value="__('NIK')" />
                        <x-text-input id="nik" class="block mt-1 w-full" type="number" name="nik" :value="old('nik',$employee->nik)" autofocus />
                        <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="born" :value="__('Born Place')" />
                        <x-text-input id="born" class="block mt-1 w-full" type="text" name="born" :value="old('born',$employee->born)" autofocus />
                        <x-input-error :messages="$errors->get('born')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="birthday" :value="__('Birthday')" />
                        <x-text-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday',$employee->birthday)" autofocus />
                        <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="phone" :value="__('Phone/Whatsapp')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone',$employee->phone)" placeholder="Starting from country code (62)" autofocus />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="address" :value="__('Address')" />
                        <x-textarea id="address" rows="2" class="block mt-1 w-full"  name="address" placeholder="Input same identity">{{ old('address',$employee->address) }}</x-textarea>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    @if($page_meta['method'] == 'put')
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email',$employee->detail->email)" autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="occupation" :value="__('Occupation')" />
                        <select id="occupation" name="occupation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @if(!isset($employee->detail->occupation->id))
                                <option value="NULL" selected>Choose occupation</option>
                            @endif
                            @foreach($occupations as $occupation)
                                <option value="{{ $occupation->id }}" @if(isset($employee->detail->occupation->id)) {{ $occupation->id == $employee->detail->occupation->id ? 'selected' : '' }} @endif>{{ $occupation->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="resign" :value="__('Resign')" />
                        <x-text-input id="resign" class="block mt-1 w-full" type="date" name="resign" :value="old('resign',$employee->detail->resign)" autofocus />
                        <x-input-error :messages="$errors->get('resign')" class="mt-2" />
                    </div>
                    @endif

                    <x-primary-button class="w-32">
                        {{ __('Save') }}
                    </x-primary-button>
                    <x-danger-button as="a" :href="route('employees.index')" class="w-32">
                        {{ __('Back') }}
                    </x-danger-button>
                </form>
            </div>
        </div>
    </x-container>
</x-app-layout>
