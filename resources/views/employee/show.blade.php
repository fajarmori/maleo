<x-app-layout>
    @slot('title','Detail Employee')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Employee') }}
        </h2>
    </x-slot>
    
    <x-container>
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <x-danger-button as="a" href="{{ route('employees.index')}}">
                        {{ __('Back') }}
                    </x-danger-button>
                    <x-primary-button as="a" href="{{ route('employees.edit', $employee->slug)}}" :class="auth()->user()->type === 2 ? 'hidden' : ''">
                        {{ __('Edit') }}
                    </x-primary-button>
                    <x-primary-button as="a" href="{{ route('journeys.create', ['employee' => $employee->id])}}" :class="auth()->user()->type === 2 ? 'hidden' : ''">
                        {{ __('Add Journey') }}
                    </x-primary-button>
                    <form onsubmit="return confirm('Apakah anda yakin menghapus data MRIA-{{substr(10000+$employee->mria, -4)}} ?');" action="{{ route('employees.destroy', $employee->slug) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <x-dark-button class="w-full {{ auth()->user()->type === 2 ? 'hidden' : '' }}">
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
                            <thead class="{{ $employee->detail->resign ? 'bg-red-200' : 'bg-gray-200' }}">
                                <tr>
                                    <th scope="col" class="px-3 py-4 w-32 text-left text-sm font-semibold text-gray-900">Name Site</th>
                                    <th scope="col" class="px-3 py-4 w-8 text-left text-sm font-semibold text-gray-900">:</th>
                                    <th scope="col" class="px-3 py-4 text-left text-sm font-semibold text-gray-900">{{ $employee->name }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">NIK MRIA</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">:</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">MRIA-{{ substr(10000+$employee->mria, -4) }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Occupation</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">:</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">@if(isset($employee->detail->occupation->name)) {{ $employee->detail->occupation->name }} @else -  @endif</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Status</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">:</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $employee->detail->resign ? 'Resign - '.\Carbon\Carbon::parse($employee->detail->resign)->isoFormat('DD-MM-Y') : 'Active' }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">No Identity</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">:</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $employee->nik }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Place Birthday</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">:</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $employee->born }}, {{ \Carbon\Carbon::parse($employee->birthday)->isoFormat('DD-MM-Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Phone</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">:</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $employee->phone }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Email</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">:</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $employee->detail->email ? : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Address</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">:</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $employee->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>