<x-app-layout>
    @slot('title','Dashboard')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">Journey Employees PT MRIA</h1>
                    </div>
                </div>
            </div>
            <div class="flow-root">
                <div class="-mx-1 -my-1 overflow-x-auto">
                    <div class="inline-block min-w-full p-1 align-middle">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                            <table id="listJourney" class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">#</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Notification</th>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Journey</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Detail</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($journeys as $journey)
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-800 italic">{{ \Carbon\Carbon::parse($journey->date)->locale('ID')->diffForHumans() }}</td>
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
                                @endforeach
                                <!-- More people... -->
                                </tbody>
                            </table>
                        </div>
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
        dom: "<'sm:flex text-sm bg-gray-50 bg-gray-100/75'<'sm:basis-1/2 text-sm p-2'l><'sm:flex sm:basis-1/2 justify-end text-sm p-2'f>>"+'rti',
        lengthMenu: [[-1], ["All"]],
    } );
    $('#listJourney_info').addClass('px-3 py-2 text-xs italic bg-gray-50');
    $('.dt-empty').addClass('p-3 text-center');
});
</script>
