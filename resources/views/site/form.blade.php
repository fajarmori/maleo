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
                        <x-input-label for="name" :value="__('Name Site')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name',$site->name)" autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="code" :value="__('Code')" />
                        <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" placeholder="Input 3-4 character unique" :value="old('code',$site->code)" minlength="3" maxlength="4" autofocus />
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="owner" :value="__('Owner')" />
                        <x-text-input id="owner" class="block mt-1 w-full" type="text" name="owner" :value="old('owner',$site->owner)" autofocus />
                        <x-input-error :messages="$errors->get('owner')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="description" :value="__('Job Description')" />
                        <x-textarea id="description" name="description" rows="2" class="block mt-1 w-full" placeholder="About site job description">{{ old('description',$site->description) }}</x-textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" placeholder="Choose suggested email site" :value="old('email',$site->user->email??'')" autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        <div id="list-email" class="relative z-10"></div>
                    </div>
                    <div>
                        <x-input-label for="district" :value="__('District')" />
                        <x-text-input id="district" class="block mt-1 w-full" type="text" name="district" :value="old('district',$site->district)" autofocus />
                        <x-input-error :messages="$errors->get('district')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="regency" :value="__('Regency')" />
                        <x-text-input id="regency" class="block mt-1 w-full" type="text" name="regency" :value="old('regency',$site->regency)" autofocus />
                        <x-input-error :messages="$errors->get('regency')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="province" :value="__('Province')" />
                        <x-text-input id="province" class="block mt-1 w-full" type="text" name="province" :value="old('province',$site->province)" autofocus />
                        <x-input-error :messages="$errors->get('province')" class="mt-2" />
                    </div>
                    <x-primary-button class="w-32">
                        {{ __('Save') }}
                    </x-primary-button>
                    <x-danger-button as="a" :href="$page_meta['method'] == 'post' ? route('sites.index') : route('sites.show',$site)" class="w-32">
                        {{ __('Back') }}
                    </x-danger-button>
                </form>
            </div>
        </div>
    </x-container>
</x-app-layout>
<script type="text/javascript">
$(document).ready(function() {
    $('#email').on('keyup',function() { var query = $(this).val(); $.ajax({ url:"{{ route('getemailsite') }}", type:'GET', data:{'email':query}, success:function (data) { $('#list-email').html(data); } }) });
    $('#list-email').on('click', 'li', function(){ var email = $(this).data('email'); $('#email').val(email); $('#list-email').html(''); });
    $('input').on('focus',function() { $('#list-email').html(''); });
})
</script>