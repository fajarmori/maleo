<x-app-layout>
    @slot('title','Delivery Item')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Delivery Item') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <x-primary-button as="a" href="{{ route('deliveryitems.export')}}">
                        {{ __('Download Data') }}
                    </x-primary-button>
                    <x-danger-button as="a" href="{{ route('scm')}}">
                        {{ __('Back') }}
                    </x-danger-button>
                </div>
            </div>
        </div>
        <div class="flow-root mb-6">
            <div class="-mx-1 -my-1 overflow-x-auto">
                <div class="inline-block min-w-full p-1 align-middle">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                        <table id="listDeliveryNote" class="table-fix divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">#</th>
                                    @if(auth()->user()->type !== 2)
                                    @endif
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Delivery Note</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name Item</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Quantity | Price</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Bale | Weight</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Purchace | Request</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Description</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($deliveryitems as $deliveryitem)
                                <tr>
                                    <td class="whitespace-normal text-wrap px-3 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900">
                                        <a href="{{ route('deliverynotes.show', $deliveryitem->deliverynote_id) }}" class="text-indigo-600 hover:text-indigo-900">{{ $deliveryitem->deliverynote->letter }}</a>
                                    </td>
                                    <td class="px-3 py-4 text-sm font-medium">
                                        <a href="{{ route('deliveryitems.edit', $deliveryitem->id) }}" class="text-indigo-600 hover:text-indigo-900">{{ $deliveryitem->name }}</a>
                                        <div class="whitespace-nowrap text-gray-500 italic">{{ $deliveryitem->code }}</div>
                                    </td>
                                    <td class="whitespace-normal text-wrap px-3 py-4 text-sm text-gray-500">
                                        <div class="text-gray-500">{{ $deliveryitem->quantity }} {{ $deliveryitem->unit }}</div>
                                        <div class="text-gray-500">Rp {{ number_format($deliveryitem->price) }}</div>
                                    </td>
                                    <td class="whitespace-normal text-wrap px-3 py-4 text-sm text-gray-500">
                                        <div class="text-gray-500">{{ $deliveryitem->bale }}</div>
                                        <div class="text-gray-500">{{ $deliveryitem->weight }} Kg</div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="text-gray-500">{{ isset($deliveryitem->purchase_order)?'PO: '.$deliveryitem->purchase_order:'-' }}</div>
                                        <div class="text-gray-500">{{ isset($deliveryitem->date_request)?'DR: '.$deliveryitem->date_request:'-' }}</div>
                                    </td>
                                    <td class="px-3 py-4 text-sm text-gray-500">
                                        <div class="whitespace-normal text-wrap line-clamp-1">{{ $deliveryitem->description }}</div>
                                        <div>Maker: {{ $deliveryitem->user->name??'-' }} | <span class="italic"> for: <span class="uppercase">{{ isset($deliveryitem->department_id) ? $deliveryitem->department_id === 2 ? $deliveryitem->site->name : $deliveryitem->department->code : '-' }}</span></span></div>
                                    </td>
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
    $('#listDeliveryNote').DataTable({ ordering : false, dom: "<'sm:flex text-sm bg-gray-50 bg-gray-100/75'<'text-sm p-2'l><'sm:flex sm:pl-5 justify-end text-sm p-2'f>>"+'rtip', lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]], } );
    $('#listDeliveryNote_info').addClass('px-3 pt-1 text-xs italic');
    $('.dt-empty').addClass('p-3 text-center');
});
</script>