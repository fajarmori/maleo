@php
$departmentID = auth()->user()->detail->occupation->department_id??6;
@endphp

<x-app-layout>
    @slot('title','Delivery Note')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Delivery Note') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <x-danger-button as="a" href="{{ $departmentID !== 6 ? auth()->user()->type !== 2 ? route('project') : route('scm') : route('scm') }}">
                        {{ __('Back') }}
                    </x-danger-button>
                    @if(auth()->user()->type !== 2)
                        @if($departmentID === 6)
                        <x-primary-button as="a" href="{{ route('deliverynotes.create')}}">
                            {{ __('Add Delivery Note') }}
                        </x-primary-button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="flow-root mb-6">
            <div class="-mx-1 -my-1 overflow-x-auto">
                <div class="inline-block min-w-full p-1 align-middle">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                        <table id="listDeliveryNote" class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">#</th>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Number Delivery Note</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Origin</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Destination</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Quantity Item</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($deliverynotes as $deliverynote)
                            <tr>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                    <a href="{{ route('deliverynotes.show', $deliverynote->id) }}" class="text-indigo-600 hover:text-indigo-900">{{ $deliverynote->letter }}</a>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $deliverynote->date }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $deliverynote->sender->name }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $deliverynote->recipient->name }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $deliverynote->items->count() }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ !$deliverynote->date_recipient ? 'Shipping' : 'Delivered | '.$deliverynote->date_recipient }}</td>
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
    $('#listDeliveryNote').DataTable({
        ordering : false,
        dom: "<'sm:flex text-sm bg-gray-50 bg-gray-100/75'<'sm:basis-1/2 text-sm p-2'l><'sm:flex sm:basis-1/2 justify-end text-sm p-2'f>>"+'rtip',
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
    } );
    $('#listDeliveryNote_info').addClass('px-3 pt-1 text-xs italic');
    $('.dt-empty').addClass('p-3 text-center');
});
</script>
