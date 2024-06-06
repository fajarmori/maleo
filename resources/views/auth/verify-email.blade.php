<x-app-layout>
    @slot('title','Verify Email')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Verify Email') }} <span class="text-grey-500 font-normal italic">({{auth()->user()->email}})</span>
        </h2>
    </x-slot>

    <x-container class="">
        <div class="flex justify-center">
            <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg text-gray-900">
                <div class="mb-4 text-sm text-gray-600 text-justify">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif

                <div class="mt-4 flex items-center justify-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div>
                            <x-primary-button>
                                {{ __('Resend Verification Email') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <a href="{{ route('profile.edit') }}" class="underline text-gray-600">Edit Profile</a>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>
