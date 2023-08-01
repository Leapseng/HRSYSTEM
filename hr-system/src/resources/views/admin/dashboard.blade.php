<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-4">
                <!-- Rectangle 1: Employee Count -->
                <div class="p-4 bg-white shadow rounded">
                    <div class="text-xl font-semibold mb-2">Total Employees</div>
                    <div class="text-4xl font-bold">{{ $employeeCount }}</div>
                </div>

                <!-- Rectangle 2: Task Count -->
                <div class="p-4 bg-white shadow rounded">
                    <div class="text-xl font-semibold mb-2">Total Tasks</div>
                    <div class="text-4xl font-bold">{{ $taskCount }}</div>
                </div>

                <!-- Rectangle 3: Loan Count -->
                <div class="p-4 bg-white shadow rounded">
                    <div class="text-xl font-semibold mb-2">Total Loans</div>
                    <div class="text-4xl font-bold">{{ $loanCount }}</div>
                </div>

                <!-- Rectangle 4: Department Count -->
                <div class="p-4 bg-white shadow rounded">
                    <div class="text-xl font-semibold mb-2">Total Departments</div>
                    <div class="text-4xl font-bold">{{ $departmentCount }}</div>
                </div>

                <!-- Rectangle 5: Job Count -->
                <div class="p-4 bg-white shadow rounded">
                    <div class="text-xl font-semibold mb-2">Total Jobs</div>
                    <div class="text-4xl font-bold">{{ $jobCount }}</div>
                </div>

                <!-- Rectangle 6: Attendance Count -->
                <div class="p-4 bg-white shadow rounded">
                    <div class="text-xl font-semibold mb-2">Total Attendance</div>
                    <div class="text-4xl font-bold">{{ $attendanceCount }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
