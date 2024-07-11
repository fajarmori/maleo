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
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name',$user->name)" autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        <div id="list-name" class="relative z-10"></div>
                    </div>
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email',$user->email)" autofocus  />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="type" :value="__('Level')" />
                        <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="2" {{ $user->type == 2 ? 'selected':'' }}>User (View)</option>
                                <option value="1" {{ $user->type == 1 ? 'selected':'' }}>Admin (Create, Read, Update, Delete)</option>
                                <option value="0" {{ $user->type == 0 ? 'selected':'' }}>Super Admin (Full Access)</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>
                    <x-primary-button class="w-32">
                        {{ __('Save') }}
                    </x-primary-button>
                    <x-danger-button as="a" :href="route('user.index')" class="w-32">
                        {{ __('Back') }}
                    </x-danger-button>
                </form>
            </div>
        </div>
    </x-container>
</x-app-layout>
<script type="text/javascript">
$(document).ready(function() {
    $('#name').on('keyup',function() {
        var query = $(this).val();
        $.ajax({
            url:"{{ route('getemployees') }}",
            type:"GET",
            data:{'name':query},
            success:function (data) { 
                $('#list-name').html(data);
            }
        })
    });
    $('#list-name').on('click', 'li', function(){
        var value = $(this).text();
        $('#name').val(value);
        $('#list-name').html("");
    });
})
</script>
