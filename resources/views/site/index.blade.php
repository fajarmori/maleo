<x-app-layout>
    @slot('title','Sites')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sites') }}
        </h2>
    </x-slot>

    <x-container>
        @if(auth()->user()->type !== 2)
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <x-danger-button as="a" :href="route('gait')">
                        {{ __('Back') }}
                    </x-danger-button>
                    <x-primary-button as="a" href="{{ route('sites.create')}}">
                        {{ __('Add Site') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
        @endif
        <div class="flow-root mb-6">
            <div class="-mx-1 -my-1 overflow-x-auto">
                <div class="inline-block min-w-full p-1 align-middle">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                        <table id="listSite" class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">#</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Code</th>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Owner</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Address</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($sites as $site)
                            <tr>
                                <td class="whitespace-normal text-wrap px-3 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="whitespace-normal text-wrap px-3 py-4 text-sm font-semibold">{{ $site->code }}</td>
                                <td class="whitespace-normal text-wrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                    @if(auth()->user()->type === 0 || auth()->user()->department_id === 3)
                                    <div class="font-semibold"><a href="{{ route('sites.show', $site->id) }}" class="text-indigo-600 hover:text-indigo-900">{{ $site->name }}</a></div>
                                    @else
                                    <div>{{ $site->name }}</div>
                                    @endif
                                    <div class="italic">{{ $site->user->email??'-' }}</div>
                                </td>
                                <td class="whitespace-normal text-wrap px-3 py-4 text-sm">
                                    <div>{{ $site->owner }}</div>
                                    <div class="italic">{{ $site->description }}</div>
                                </td>
                                <td class="whitespace-normal text-wrap px-3 py-4 text-sm text-gray-500">
                                    <div>{{ $site->district }}, {{ $site->regency }}</div>
                                    <div class="italic">{{ $site->province }}</div>
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
    $('#listSite').DataTable({ ordering : false, dom: "<'sm:flex text-sm bg-gray-50 bg-gray-100/75'<'sm:basis-1/2 text-sm p-2'l><'sm:flex sm:basis-1/2 justify-end text-sm p-2'f>>"+'rtip', lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]], } );
    $('#listSite_info').addClass('px-3 pt-1 text-xs italic');
    $('.dt-empty').addClass('p-3 text-center');
});
</script>