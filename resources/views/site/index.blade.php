<x-app-layout>
    @slot('title','Sites')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sites') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">List Site Project PT MRIA</h1>
                        <p class="mt-2 text-sm text-gray-700">A list of all the site project PT MRIA.</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <x-primary-button as="a" href="{{ route('sites.create')}}">
                            {{ __('Add Site') }}
                        </x-primary-button>
                    </div>
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
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">#</th>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Owner</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">District</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Regency</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Province</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($sites as $site)
                            <tr>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                    <a href="{{ route('sites.show', $site->id) }}" class="text-indigo-600 hover:text-indigo-900">{{ $site->name }}</a>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $site->owner }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $site->district }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $site->regency }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $site->province }}</td>
                            </tr>
                            @endforeach
                            <!-- More people... -->
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
    $('#listSite').DataTable({
        ordering : false,
        dom: "<'sm:flex text-sm bg-gray-50 bg-gray-100/75'<'sm:basis-1/2 text-sm p-2'l><'sm:flex sm:basis-1/2 justify-end text-sm p-2'f>>"+'rtip',
        lengthMenu: [[5, 25, 50, -1], [5, 25, 50, "All"]],
    } );
    $('#listSite_info').addClass('px-3 pt-1 text-xs italic');
    $('.dt-empty').addClass('p-3 text-center');
});
</script>
