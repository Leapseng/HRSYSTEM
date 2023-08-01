 <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data" class="p-6" id="add-name-form">
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('New Employee') }}
                            </h2>

                            <!-- Your other form fields go here -->

                            <div class="mt-6">
                                <x-input-label for="name" value="{{ __('Name') }}" class="sr-only" />
            
                                <x-text-input
                                    id="name"
                                    name="name"
                                    type="text"
                                    class="mt-1 block w-3/4"
                                    placeholder="{{ __('Name') }}"
                                    required
                                />
            
                                <x-input-error :messages="$errors->taskCreation->get('name')" class="mt-2" />
                            </div>
            
                            <div class="mt-6">
                                <x-input-label for="email" value="{{ __('Email') }}" class="sr-only" />
            
                                <x-text-input
                                    id="email"
                                    name="email"
                                    type="email"
                                    class="mt-1 block w-3/4"
                                    placeholder="{{ __('Email') }}"
                                    required
                                />
            
                                <x-input-error :messages="$errors->taskCreation->get('email')" class="mt-2" />
                            </div>
            
                            <div class="mt-6">
                                <x-input-label for="image" value="{{ __('Image') }}" class="sr-only" />
                    
                                <input
                                    id="image"
                                    name="image"
                                    type="file"
                                    class="mt-1 block w-3/4"
                                />
                    
                                <x-input-error :messages="$errors->taskCreation->get('image')" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
            
                                <x-text-input
                                    id="password"
                                    name="password"
                                    type="tel"
                                    class="mt-1 block w-3/4"
                                    placeholder="{{ __('Password') }}"
                                    required
                                />
            
                                <x-input-error :messages="$errors->taskCreation->get('password')" class="mt-2" />
                            </div>
            
                            <div class="mt-6">
                                <x-input-label for="phone" value="{{ __('Phone Number') }}" class="sr-only" />
            
                                <x-text-input
                                    id="phone"
                                    name="phone"
                                    type="tel"
                                    class="mt-1 block w-3/4"
                                    placeholder="{{ __('Phone Number') }}"
                                    pattern="[0-9]+"
                                    required
                                />
            
                                <x-input-error :messages="$errors->taskCreation->get('phone')" class="mt-2" />
                            </div>
            
                            <div class="mt-6">
                                <x-input-label for="address" value="{{ __('Address') }}" class="sr-only" />
            
                                <textarea
                                    id="address"
                                    name="address"
                                    class="mt-1 block w-3/4 h-32 resize-none"
                                    placeholder="{{ __('Address') }}"
                                    required
                                ></textarea>
            
                                <x-input-error :messages="$errors->taskCreation->get('address')" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <x-input-label for="department" value="{{ __('Department') }}" class="sr-only" />
                                <select id="department" name="department" class="mt-1 block w-3/4">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->taskCreation->get('department')" class="mt-2" />
                            </div>

                            <div class="mt-6" id="job_dropdown_container">
                                <x-input-label for="job" value="{{ __('Job') }}" class="sr-only" />
                                <select id="job" name="job" class="mt-1 block w-3/4">
                                    <option value="">Select Job</option>
                                </select>
                                <x-input-error :messages="$errors->taskCreation->get('job')" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <x-input-label for="role" value="{{ __('Role') }}" class="sr-only" />
            
                                <select id="role" name="role" class="mt-1 block w-3/4">
                                    <option value="Staff">Staff</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Admin">Admin</option>
                                </select>
            
                                <x-input-error :messages="$errors->taskCreation->get('role')" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                                <x-success-button class="ml-3" type="submit">
                                    {{ __('Add') }}
                                </x-success-button>
                            </div>
                        </form>
                    </div>
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
