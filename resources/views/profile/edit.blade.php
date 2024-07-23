<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">{{ __('Information Account') }}</h2>
                            <p class="mt-1 text-sm text-gray-600">{{ __('If you will change information account, contact your administrator.') }}</p>
                        </header>
                        <div class="mt-3">
                            <h4>{{ __('Your Name') }}</h4>
                            <p class="mt-1 text-sm text-gray-600">{{ $user->name }}</p>
                        </div>
                        <div class="mt-3">
                            <h4>{{ __('Email') }}</h4>
                            <p class="mt-1 text-sm text-gray-600">{{ $user->email }}</p>
                        </div>
                        <div class="mt-3">
                            <h4>{{ __('Role') }}</h4>
                            <p class="mt-1 text-sm text-gray-600">@switch($user->type) @case(0) Super Admin (Full Access) @break @case(1) Admin (Create, Read, Update, Delete) @break @default User (View) @endswitch</p>
                            <p class="mt-1 text-sm text-gray-600">{{  $user->department_id === 2 ? $user->site->name : $user->department->name }}</p>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
