<x-app-layout>
    @slot('title','Employees Journey')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees Journey') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <x-danger-button as="a" :href="route('employees.index')">
                        {{ __('Back') }}
                    </x-danger-button>
                </div>
            </div>
        </div>
        <div class="flow-root mb-6">
            <div class="-mx-1 -my-1 overflow-x-auto">
                <div class="inline-block min-w-full p-1 align-middle">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                        <table id="listJourney" class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">#</th>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Journey</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Detail</th>
                                @if(auth()->user()->type !== 2)
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($journeys as $journey)
                            <tr>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-900 sm:pl-6">
                                    <div class="font-medium">{{ $journey->event }} - {{ $journey->site }}</div>
                                    <div class="font-medium">{{ $journey->employee->name }} (MRIA-{{ substr(10000+$journey->employee->mria, -4) }})</div>
                                    <div><span class="font-medium">Rute :</span> {{ $journey->origin }} - {{ $journey->destination }}</div>
                                    <div class="italic"></div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div><span class="font-medium">Pengajuan :</span> {{ $journey->application }}</div>
                                    <div><span class="font-medium">Tanggal :</span> {{ \Carbon\Carbon::parse($journey->date)->locale('ID')->isoFormat('dddd, DD-MM-Y') }}</div>
                                    <div><span class="font-medium">Via :</span> {{ $journey->transportation }}</div>
                                </td>
                                @if(auth()->user()->type !== 2)
                                <td class="whitespace-nowrap flex px-3 py-4 text-sm text-gray-500">
                                    <x-primary-button as="a" href="{{ route('journeys.edit', $journey->id)}}" class="text-xs !mb-0">
                                        {{ __('Edit') }}
                                    </x-primary-button>
                                    <x-secondary-button as="a" href="https://wa.me/6285195140509?text={!! str_replace(' ','%20',$journey->event) !!}%20%2A{!! str_replace(' ','%20',$journey->site) !!}%2A%0Apengajuan%20{{ $journey->application }}%0Arute%20%3A%20%2A{!! str_replace(' ','%20',$journey->origin) !!}%20-%20{!! str_replace(' ','%20',$journey->destination) !!}%2A%0Atanggal%20%3A%20%2A{!! str_replace(',','%2C',str_replace(' ','%20',\Carbon\Carbon::parse($journey->date)->locale('ID')->isoFormat('dddd, DD-MM-Y'))) !!}%2A%0Avia%20%3A%20%2A{!! str_replace(' ','%20',$journey->transportation) !!}%2A%0Anama%20%3A%20%2A{!! str_replace(' ','%20',$journey->employee->name) !!}%2A" target="_blank" class="text-xs !mb-0">
                                        {{ __('Send WA') }}
                                    </x-secondary-button>
                                    <form onsubmit="return confirm('Apakah anda yakin menghapus data {{ $journey->employee->name }} (MRIA-{{ substr(10000+$journey->employee->mria, -4) }}) tanggal {{ \Carbon\Carbon::parse($journey->date)->locale('ID')->isoFormat('DD-MM-Y') }} ?');" action="{{ route('journeys.destroy', $journey->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <x-dark-button class="text-xs !mb-0">
                                            {{ __('Delete') }}
                                        </x-dark-button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>     
    </x-container>
</x-app-layout>
<script type="text/javascript">
$(document).ready(function() {
    $('#listJourney').DataTable({
        ordering : false,
        dom: "<'sm:flex text-sm bg-gray-50 bg-gray-100/75'<'sm:basis-1/2 text-sm p-2'l><'sm:flex sm:basis-1/2 justify-end text-sm p-2'f>>"+'rtip',
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
    } );
    $('#listJourney_info').addClass('px-3 pt-1 text-xs italic');
    $('.dt-empty').addClass('p-3 text-center');
});
</script>
