<x-app-layout>
    @slot('title','Drop Point Delivery')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Drop Point Delivery') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <x-danger-button as="a" href="{{ route('scm')}}">
                        {{ __('Back') }}
                    </x-danger-button>
                    @if(auth()->user()->type !== 2)
                    <x-primary-button as="a" href="{{ route('droppoints.create')}}">
                        {{ __('Add Drop Point') }}
                    </x-primary-button>
                    @endif
                </div>
            </div>
        </div>
        <div class="flow-root mb-6">
            <div class="-mx-1 -my-1 overflow-x-auto">
                <div class="inline-block min-w-full p-1 align-middle">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                        <table id="listDropPoint" class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">#</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Manage</th>
                                @if(auth()->user()->type !== 2)
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($droppoints as $droppoint)
                            <tr>
                                <td class="whitespace-normal text-wrap px-3 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="whitespace-normal text-wrap px-3 py-4 text-sm align-top">
                                    <div class="font-medium text-gray-900">{{ $droppoint->name }}</div>
                                    <div class="text-gray-500">{{ $droppoint->address }}</div>
                                    <div class="text-gray-500 italic">{{ $droppoint->notes ?? '' }}</div>
                                </td>
                                <td class="whitespace-normal text-wrap px-3 py-4 text-sm align-top">
                                    <div class="font-medium text-gray-900">{{ $droppoint->department->name ?? '-' }}</div>
                                    <div class="text-gray-500">{{ $droppoint->site->name ?? '' }}</div>
                                </td>
                                @if(auth()->user()->type !== 2)
                                <td class="whitespace-normal text-wrap flex px-3 py-4 text-sm text-gray-500">
                                    <x-primary-button as="a" href="{{ route('droppoints.edit', $droppoint->id)}}" class="text-xs !mb-0">
                                        {{ __('Edit') }}
                                    </x-primary-button>
                                    <form onsubmit="return confirm('Apakah anda yakin menghapus data {{$droppoint->name}} ?');" action="{{ route('droppoints.destroy', $droppoint->id) }}" method="POST">
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
    $('#listDropPoint').DataTable({ ordering : false, dom: "<'sm:flex text-sm bg-gray-50 bg-gray-100/75'<'sm:basis-1/2 text-sm p-2'l><'sm:flex sm:basis-1/2 justify-end text-sm p-2'f>>"+'rtip', lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]], });
    $('#listDropPoint_info').addClass('px-3 pt-1 text-xs italic');
    $('.dt-empty').addClass('p-3 text-center');
});
</script>