<x-app-layout>
    @slot('title','Register User')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register User') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('Name User')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        <div id="list-name" class="relative z-10"></div>
                    </div>
                    <div class="mt-4 hidden">
                        <x-input-label for="mria" :value="__('NIK MRIA')" />
                        <x-text-input id="mria" class="block mt-1 w-full" type="text" name="mria" :value="old('mria')" autofocus  />
                        <x-input-error :messages="$errors->get('mria')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="department" :value="__('Department')" />
                        <select id="department" name="department" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->code }} | {{ $department->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('department')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div class="flex items-center mt-4">
                        <x-primary-button class="w-32">
                            {{ __('Save') }}
                        </x-primary-button>
                        <x-danger-button as="a" :href="route('user.index')" class="w-32">
                            {{ __('Back') }}
                        </x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </x-container>
</x-app-layout>
<script type="text/javascript">
$(document).ready(function() {
    $('#name').on('keyup',function() { var query = $(this).val(); $.ajax({ url:"{{ route('getemployees') }}", type:'GET', data:{'name':query}, success:function (data) {  $('#list-name').html(data); }})});
    $('#list-name').on('click', 'li', function(){ var name = $(this).data('name'); var mria = $(this).data('mria'); $('#name').val(name); $('#mria').val(mria); $('#list-name').html(''); $('.hidden').removeClass('hidden'); });
    $('input').on('focus',function() { $('#list-name').html(''); });
});
</script>