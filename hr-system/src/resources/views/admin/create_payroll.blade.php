<x-app-layout>
    <style>
        /* Hide spinners on number input fields */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield; /* Firefox */
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Payroll') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Payroll Information') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('payroll.store') }}" class="p-6">
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('New Payroll') }}
                            </h2>

                            <div class="mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end"></label>
                                <div class="col-md-6">
                                    <select id="user_id" class="form-control" name="user_id" required>
                                        @foreach($user as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mt-6">
                                <x-input-label for="salary" value="{{ __('Salary') }}" class="sr-only" />
                                <x-text-input
                                    id="salary"
                                    name="salary"
                                    type="number"
                                    class="mt-1 block w-3/4 salary-input"
                                    placeholder="{{ __('Salary') }}"
                                    required
                                />
                                <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <x-input-label for="payroll_date" value="{{ __('Payroll Date') }}" class="sr-only" />
                                <x-date-input
                                    name="payroll_date"
                                    label="Payroll Date" 
                                    :name="'payroll_date'"
                                    :value="old('payroll_date')"
                                    class="mt-1 block w-3/4 date-input"
                                    required
                                />
                                <x-input-error :messages="$errors->get('payroll_date')" class="mt-2" />
                            </div>
                            
                            

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-data="" x-on:click.prevent="window.location.href = '{{ route('admin.payroll') }}'">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                                <x-success-button class="ml-3" type="submit">
                                    {{ __('Add Payroll') }}
                                </x-success-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Allow only numeric input for salary field
        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('salary-input')) {
                e.target.value = e.target.value.replace(/[^\d.-]/g, '');
            }
        });

        
    </script>


</x-app-layout>
