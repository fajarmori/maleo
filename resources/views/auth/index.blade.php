<x-app-layout>
    @slot('title','User Application')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Application') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <x-danger-button as="a" :href="route('application')">
                        {{ __('Back') }}
                    </x-danger-button>
                    @if(auth()->user()->type === 0)
                    <x-primary-button as="a" href="{{ route('register')}}">
                        {{ __('Add User') }}
                    </x-primary-button>
                    @endif
                </div>
            </div>
        </div>
        <div class="flow-root mb-6">
            <div class="-mx-1 -my-1 overflow-x-auto">
                <div class="inline-block min-w-full p-1 align-middle">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                        <table id="listUser" class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">#</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name User</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                @if(auth()->user()->type === 0)
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($users as $user)
                            <tr>
                                <td class="whitespace-normal text-wrap px-3 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="whitespace-normal text-wrap px-3 py-4 text-sm text-gray-500">
                                    <div class="font-medium text-gray-900">{{  $user->name }}</div>
                                    <div class="italic">{{ $user->email }}</div>
                                </td>
                                <td class="whitespace-normal text-wrap px-3 py-4 text-sm text-gray-500">
                                    <div class="font-medium text-gray-900">@switch($user->type) @case(0) Super Admin @break @case(1) Admin @break @default User @endswitch</div>
                                    <div class="italic">{{ $user->department->code }} | {{ $user->department->name }}</div>
                                </td>
                                <td class="whitespace-normal text-wrap px-3 py-4 text-sm text-gray-500">{{ $user->email_verified_at ? 'Verified' : 'Unverified' }}</td>
                                @if(auth()->user()->type === 0)
                                <td class="whitespace-normal text-wrap flex px-3 py-4 text-sm text-gray-500">
                                    @if($user->id !== auth()->user()->id || $user->email !== 'admin@mria.co.id')
                                    <x-primary-button as="a" href="{{ route('user.edit', $user->id) }}" class="text-xs !mb-0">
                                        {{ __('Edit') }}
                                    </x-primary-button>
                                    <form onsubmit="return confirm('Apakah anda yakin menghapus data {{ $user->name }} ?');" action="{{ route('user.destroy', $user->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <x-dark-button class="text-xs !mb-0">
                                            {{ __('Delete') }}
                                        </x-dark-button>
                                    </form>
                                    @endif
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
    $('#listUser').DataTable({ ordering : false, dom: "<'sm:flex text-sm bg-gray-50 bg-gray-100/75'<'sm:basis-1/2 text-sm p-2'l><'sm:flex sm:basis-1/2 justify-end text-sm p-2'f>>"+'rtip', lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]] } );
    $('#listUser_info').addClass('px-3 pt-1 text-xs italic');
    $('.dt-empty').addClass('p-3 text-center');
});
</script>