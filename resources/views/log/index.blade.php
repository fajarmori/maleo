<x-app-layout>
    @slot('title','Log Activity User')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Log Activity User') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="flow-root mb-6">
            <div class="-mx-1 -my-1 overflow-x-auto">
                <div class="inline-block min-w-full p-1 align-middle">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                        <table id="listJourney" class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-3 text-left text-sm font-semibold text-gray-900">#</th>
                                <th scope="col" class="px-3 text-left text-sm font-semibold text-gray-900">Date Time</th>
                                <th scope="col" class="px-3 text-left text-sm font-semibold text-gray-900">Name User</th>
                                <th scope="col" class="px-3 text-left text-sm font-semibold text-gray-900">email</th>
                                <th scope="col" class="px-3 text-left text-sm font-semibold text-gray-900">Activity</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($logs as $log)
                            <tr>
                                <td class="whitespace-normal text-wrap px-3 py-2 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="whitespace-normal text-wrap px-3 py-2 text-sm text-gray-500">{{ \Carbon\Carbon::parse($log->created_at)->locale('ID')->isoFormat('Y-MM-DD HH:mm:ss') }}</td>
                                <td class="whitespace-normal text-wrap px-3 py-2 text-sm">{{ $log->user->name }}</td>
                                <td class="whitespace-normal text-wrap px-3 py-2 text-sm text-gray-500">{{ $log->user->email }}</td>
                                <td class="whitespace-normal text-wrap px-3 py-2 text-sm text-gray-500">{{ $log->log }}</td>
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
    $('#listJourney').DataTable({ ordering : false, dom: "<'sm:flex text-sm bg-gray-50 bg-gray-100/75'<'sm:basis-1/2 text-sm p-2'l><'sm:flex sm:basis-1/2 justify-end text-sm p-2'f>>"+'rtip', lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]], });
    $('#listJourney_info').addClass('px-3 pt-1 text-xs italic');
    $('.dt-empty').addClass('p-3 text-center');
});
</script>
