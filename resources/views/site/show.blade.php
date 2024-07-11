<x-app-layout>
    @slot('title','Detail Site Project')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Site Project') }}
        </h2>
    </x-slot>
    
    <x-container>
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <x-danger-button as="a" href="{{ route('sites.index')}}">
                        {{ __('Back') }}
                    </x-danger-button>
                    @if(auth()->user()->type !== 2)
                    <x-primary-button as="a" href="{{ route('sites.edit', $site->id)}}">
                        {{ __('Edit') }}
                    </x-primary-button>
                    <form onsubmit="return confirm('Apakah anda yakin menghapus data {{$site->name}} ?');" action="{{ route('sites.destroy', $site->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <x-dark-button class="w-full">
                            {{ __('Delete') }}
                        </x-dark-button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="flow-root mb-6">
            <div class="-mx-1 -my-1 overflow-x-auto">
                <div class="inline-block min-w-full p-1 align-middle">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                        <table id="listSite" class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-3 py-4 w-32 text-left text-sm font-semibold text-gray-900">Name Site</th>
                                    <th scope="col" class="px-3 py-4 w-8 text-left text-sm font-semibold text-gray-900">:</th>
                                    <th scope="col" class="px-3 py-4 text-left text-sm font-semibold text-gray-900">{{ $site->name }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-semibold">Code</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-semibold">:</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-semibold">{{ $site->code }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-semibold">Owner</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-semibold">:</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-semibold">{{ $site->owner }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Description</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">:</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $site->description }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Address</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">:</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $site->district }}, {{ $site->regency }}, {{ $site->province }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Email</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">:</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $site->user->email??'-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>