<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Department') }}
        </h2>

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
        <div class="flex justify-end">
            <x-success-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-name')">
                {{ __('Add Department') }}
            </x-success-button>
        </div>

        <x-modal name="add-name" :show="$errors->nameCreation->isNotEmpty()" focusable>
            <form method="POST" action="{{ route('department.store') }}" class="p-6" id="add-name-form">
                @csrf
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Add New Department') }}
                </h2>

                <div class="mt-6">
                    <x-input-label for="name" value="{{ __('Department') }}" class="sr-only" />

                    <x-text-input
                        id="name"
                        name="name"
                        type="text"
                        class="mt-1 block w-3/4"
                        placeholder="{{ __('Department') }}"
                        required
                    />

                    <x-input-error :messages="$errors->taskCreation->get('name')" class="mt-2" />
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
        </x-modal>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">{{ __('Department List') }}</h3>
                </div>
    
                @if ($departments->isEmpty())
                    <p class="p-6 text-gray-900">{{ __('No Department found.') }}</p>
                @else
                    <div class="p-6">
                        <table class="table border-collapse">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-4 py-2">#</th>
                                    <th scope="col" class="px-4 py-2">{{ __('Department') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $department)
                                <tr class="table-row-padding">
                                    <td class="border px-4 py-2">{{ $department->id }}</td>
                                    <td class="border px-4 py-2">{{ $department->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    </div>
</x-app-layout>
