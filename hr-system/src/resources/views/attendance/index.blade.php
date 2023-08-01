<x-home-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance') }}
        </h2>
        <div class="flex justify-end">

            <form method="POST" action="{{ route('attendance.store') }}">
                @csrf
                <x-success-button type="submit">Check in</x-success-button>
            </form>
                                
        </div>
    </x-slot>

    @if (session('success'))
    <div class="alert alert-success" style="background-color: green; color: white;">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function(){
            document.querySelector('.alert-success').style.display = 'none';
        }, 3000);
    </script>
@endif


@if (session('error'))
    <div class="alert alert-danger" style="background-color: red; color: white;">
        {{ session('error') }}
    </div>

    <script>
        setTimeout(function(){
            document.querySelector('.alert-danger').style.display = 'none';
        }, 3000);
    </script>
@endif

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
                                <th class="border border-gray-400 px-4 py-2">Date</th>
                                <th class="border border-gray-400 px-4 py-2">Time in</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendanceData as $attendance)
                                <tr class="border-b border-gray-200">
                                    <td class="border border-gray-400 px-4 py-2">{{ Carbon\Carbon::parse($attendance->created_at)->format('d-m-Y') }}</td>
                                    <td class="border border-gray-400 px-4 py-2">{{ Carbon\Carbon::parse($attendance->created_at)->format('H:i') }}</td>
                                    
                                    
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
        document.addEventListener("DOMContentLoaded", function() {
            var attendanceSubmitButton = document.getElementById("attendance-submit");
        
            // Disable the button after it is clicked
            attendanceSubmitButton.addEventListener("click", function() {
                attendanceSubmitButton.disabled = true;
            });
        
            // Enable the button at 6 AM
            var now = new Date();
            var sixAM = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 6, 0, 0);
            var timeUntilSixAM = sixAM.getTime() - now.getTime();
        
            setTimeout(function() {
                attendanceSubmitButton.disabled = false;
            }, timeUntilSixAM);
        });
        </script>
</x-home-layout>
