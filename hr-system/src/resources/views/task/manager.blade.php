<x-home-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task') }}
        </h2>
        <div class="flex justify-end">

            <x-success-button x-data="" x-on:click.prevent="window.location.href = '{{ route('task.create') }}'">
                {{ __('New Task') }}
            </x-success-button>
                                
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Task Name</th>
                                <th class="px-4 py-2">Description</th>
                                <th class="px-4 py-2">File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td class="border px-4 py-2">{{ $task->user->name }}</td>
                                    <td class="border px-4 py-2">{{ $task->name }}</td>
                                    <td class="border px-4 py-2">{{ $task->description }}</td>
                                    <td class="border px-4 py-2">
                                        @if ($task->submission)
                                            @php
                                            $extension = pathinfo($task->submission->file, PATHINFO_EXTENSION);
                                            @endphp
                                            <a href="{{ route('submission.download', ['file' => $task->submission->file]) }}" target="_blank">View File ({{ strtoupper($extension) }})</a>
                                        @else
                                            No file submitted.
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-home-layout>
