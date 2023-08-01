<x-home-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Loan Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('loan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="loan_amount" value="{{ __('Loan Amount') }}" class="sr-only" />
                            <x-text-input
                                id="loan_amount"
                                name="loan_amount"
                                type="number"
                                class="mt-1 block w-full"
                                placeholder="{{ __('Enter Loan Amount') }}"
                                required
                            />
                            <x-input-error :messages="$errors->get('loan_amount')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="reason" value="{{ __('Reason') }}" class="sr-only" />
                            <x-textarea
                                id="reason"
                                name="reason"
                                class="mt-1 block w-full"
                                placeholder="{{ __('Enter Reason for Loan') }}"
                                required
                            ></x-textarea>
                            <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                        </div>

                        <div class="mt-6">
                            <x-input-label for="file" value="{{ __('File') }}" class="sr-only" />
                
                            <input
                                id="file"
                                name="file"
                                type="file"
                                class="mt-1 block w-3/4"
                            />
                
                            <x-input-error :messages="$errors->taskCreation->get('file')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-success-button>{{ __('Submit') }}</x-success-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>
