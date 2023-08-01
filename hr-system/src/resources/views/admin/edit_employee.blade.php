<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('employee.update', ['employee' => $employee->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- User name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full" value="{{ $employee->name }}">
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full" value="{{ $employee->email }}">
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full">
                        </div>

                        <!-- Phone -->
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone:</label>
                            <input type="tel" name="phone" id="phone" class="mt-1 block w-full" value="{{ $employee->phone }}">
                        </div>

                        <!-- Address -->
                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700">Address:</label>
                            <textarea name="address" id="address" class="mt-1 block w-full">{{ $employee->address }}</textarea>
                        </div>

                        <!-- Department -->
                        <div class="mt-6">
                                <label for="department" class="block text-sm font-medium text-gray-700">Department:</label>
                                <x-input-label for="department" value="{{ __('Department') }}" class="sr-only" />
                                <select id="department" name="department" class="mt-1 block w-3/4">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        

                        <!-- Job -->
                         <div class="mt-6" id="job_dropdown_container">
                                <label for="department" class="block text-sm font-medium text-gray-700">Job:</label>
                                <x-input-label for="job" value="{{ __('Job') }}" class="sr-only" />
                                <select id="job" name="job" class="mt-1 block w-3/4">
                                    <option value="">Select Job</option>
                                </select>
                            </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700">Role:</label>
                            <select name="role" id="role" class="mt-1 block w-full">
                                <option value="Staff" @if($employee->role === 'Staff') selected @endif>Staff</option>
                                <option value="Manager" @if($employee->role === 'Manager') selected @endif>Manager</option>
                                <option value="Admin" @if($employee->role === 'Admin') selected @endif>Admin</option>
                            </select>
                        </div>

                        <!-- Submit button -->
                        <div>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var departmentSelect = document.getElementById('department');
            var jobSelect = document.getElementById('job');
    
            departmentSelect.addEventListener('change', function () {
                var departmentId = this.value;
    
                // Enable department select and reset options
                jobSelect.disabled = false;
                jobSelect.innerHTML = '<option value="">Select Job</option>';
    
                if (departmentId) {
                    // Fetch departments based on the selected faculty
                    fetch('/form/get-jobs?department_id=' + departmentId, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(function (job) {
                            var option = document.createElement('option');
                            option.value = job.id;
                            option.textContent = job.title;
                            jobSelect.appendChild(option);
                        });
                    });
                }
            });
        });
    </script>
</x-app-layout>
