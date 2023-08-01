<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">Attendance List</h3>
                </div>
    
                <div class="p-6">
                    @if ($attendanceData->isEmpty())
                        <p>No Attendance found.</p>
                    @else
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border border-gray-400 px-4 py-2">#</th>
                                    <th class="border border-gray-400 px-4 py-2">Name</th>
                                    <th class="border border-gray-400 px-4 py-2">Time in</th>
                                    <th class="border border-gray-400 px-4 py-2">Date</th>
                                    <th class="border border-gray-400 px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendanceData as $attendance)
                                    <tr class="border-b border-gray-200">
                                        <td class="border border-gray-400 px-4 py-2">{{ $attendance->id }}</td>
                                        <td class="border border-gray-400 px-4 py-2">{{ $attendance->name }}</td>
                                        <td class="border border-gray-400 px-4 py-2">{{ Carbon\Carbon::parse($attendance->created_at)->format('H:i') }}</td>
                                        <td class="border border-gray-400 px-4 py-2">{{ Carbon\Carbon::parse($attendance->created_at)->format('d-m-Y') }}</td>
                                        <td class="border border-gray-400 px-4 py-2">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <form id="form{{ $attendance->id }}" method="POST" action="{{ route('attendance.destroy', ['attendance' => $attendance->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-danger-button type="button" onclick="onDelete('form{{ $attendance->id }}')" class="btn btn-danger">Delete</x-danger-button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    
    <script>
        function onDelete(formId) {
            if (confirm('Are you sure?')) {
                document.getElementById(formId).submit();
            }
        }
    </script>
</x-app-layout>
