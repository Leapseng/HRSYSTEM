<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job') }}
        </h2>
        <div class="flex justify-end">
            <x-success-button x-data="" x-on:click.prevent="window.location.href = '{{ route('job.create') }}'">
                {{ __('Add Job') }}
            </x-success-button>
            </div>
            
            
            
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">{{ __('Job Title List') }}</h3>
                </div>
    
                @if ($jobs->isEmpty())
                    <p class="p-6 text-gray-900">{{ __('No Job Title found.') }}</p>
                @else
                    <div class="p-6">
                        <table class="table border-collapse">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-4 py-2">#</th>
                                    <th scope="col" class="px-4 py-2">{{ __('Department') }}</th>
                                    <th scope="col" class="px-4 py-2">{{ __('Job Title') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobs as $job)
                                <tr class="table-row-padding">
                                    <td class="border px-4 py-2">{{ $job->id }}</td>
                                    <td class="border px-4 py-2">{{ $job->department->name }}</td>
                                    <td class="border px-4 py-2">{{ $job->title }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
</x-app-layout>
