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
                <div class="flex items-center">
                    <x-primary-button as="a" href="{{ route('sites.edit', $site->id)}}" class="w-32">
                        {{ __('Edit Site') }}
                    </x-primary-button>
                    <x-danger-button as="a" href="{{ route('sites.index')}}" class="w-32">
                        {{ __('Back') }}
                    </x-danger-button>
                    <form onsubmit="return confirm('Apakah anda yakin menghapus data {{$site->name}} ?');" action="{{ route('sites.destroy', $site->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <x-dark-button class="w-32">
                            {{ __('Delete') }}
                        </x-dark-button>
                    </form>
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
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Owner</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">:</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $site->owner }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Address</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">:</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $site->district }}, {{ $site->regency }}, {{ $site->province }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Description</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">:</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $site->description }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>