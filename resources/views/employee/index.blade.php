<x-app-layout>
    @slot('title','Employees')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="mb-6 bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    <x-primary-button as="a" href="{{ route('employees.create')}}" :class="auth()->user()->type === 2 ? 'hidden' : ''">
                        {{ __('Add Employee') }}
                    </x-primary-button>
                    <x-primary-button as="a" href="{{ route('journeys.index')}}">
                        {{ __('Journey') }}
                    </x-primary-button>
                    <x-primary-button as="a" href="{{ route('occupations.index')}}">
                        {{ __('Occupation') }}
                    </x-primary-button>
                    <x-primary-button as="a" href="{{ route('departments.index')}}">
                        {{ __('Department') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
        <div class="flow-root mb-6">
            <div class="-mx-1 -my-1 overflow-x-auto">
                <div class="inline-block min-w-full p-1 align-middle">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                        <table id="listEmployee" class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">#</th>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">NIK MRIA</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Full Name</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Phone</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($employees as $employee)
                            <tr class="{{$employee->detail->resign ? 'bg-red-200' : ''}}">
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                    <a href="{{ route('employees.show', $employee->slug) }}" class="text-indigo-600 hover:text-indigo-900">MRIA-{{ substr(10000+$employee->mria,-4) }}</a>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $employee->name }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $employee->phone }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $employee->detail->resign ? 'Resign' : 'Active'}}</td>
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
    $('#listEmployee').DataTable({
        ordering : false,
        dom: "<'sm:flex text-sm bg-gray-50 bg-gray-100/75'<'sm:basis-1/2 text-sm p-2'l><'sm:flex sm:basis-1/2 justify-end text-sm p-2'f>>"+'rtip',
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
    } );
    $('#listEmployee_info').addClass('px-3 pt-1 text-xs italic');
    $('.dt-empty').addClass('p-3 text-center');
});
</script>
