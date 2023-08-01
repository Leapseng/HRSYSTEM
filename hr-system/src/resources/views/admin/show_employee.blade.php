<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-semibold">{{ $employee->name }}</h1>
                    <br>
                    <br>
                    <p class="text-gray-600">Email: {{ $employee->email }}</p>
                    <br>
                    <p class="text-gray-600">Phone: {{ $employee->phone }}</p>
                    <br>
                    <p class="text-gray-600">Address: {{ $employee->address }}</p>
                    <br>
                    <p class="text-gray-600">Department: {{ \App\Models\admin\Department::getDepartmentTitle($employee->department) }}</p>
                    <br>
                    <p class="text-gray-600">Job Title: {{ \App\Models\admin\Job::getJobTitle($employee->job) }}</p>
                    <br>
                    <p class="text-gray-600">Role: {{ $employee->role }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
