<x-home-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task') }}
        </h2>

        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="px-4 py-4">Name</th>
                                <th class="px-4 py-4">Description</th>
                                <th class="px-4 py-4">Deadline</th>
                                <th class="px-4 py-4">File</th>
                                <th class="px-4 py-4">Submission</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td class="border px-4 py-4">{{ $task->name }}</td>
                                    <td class="border px-4 py-4">{{ $task->description }}</td>
                                    <td class="border px-4 py-4">{{ Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</td>
                                    <td class="border px-4 py-4">
                                        @if($task->file)
                                        @php
                                        $extension = pathinfo($task->file, PATHINFO_EXTENSION);
                                        @endphp
                                        <a href="{{ route('task.download', ['file' => $task->file]) }}" target="_blank">View File ({{ strtoupper($extension) }})</a>
                                        @else
                                            No file attached.
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group flex justify-center space-x-4" role="group" aria-label="Basic example">
                                            <form id="form{{ $task->id }}" method="POST" action="{{ route('task.submission') }}" enctype="multipart/form-data" class="flex" onsubmit="toggleButton(this)">
                                                @csrf
                                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                <input type="hidden" name="submission_key" value="{{ $task->id }}_{{ auth()->id() }}">
                                                <input type="file" name="file" id="file" class="mt-1 block">
                                                <x-success-button type="submit" class="btn btn-success">Turn in</x-success-button>
                                            </form>
                                        </div>
                                        @error('file')
                                            <p class="text-red-600">{{ $message }}</p>
                                        @enderror
                                    </td>
                                    
                                    
                                    
                                    
                                    
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function toggleButton(form, event) {
            // Prevent the default form submission behavior (page reload)
            event.preventDefault();
    
            // Get the submit button inside the form
            const submitButton = form.querySelector('[type="submit"]');
    
            // Disable the button to prevent multiple submissions
            submitButton.disabled = true;
    
            // Change the button text to "Turned In"
            submitButton.textContent = "Turned In";
    
            // Submit the form asynchronously using JavaScript
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => {
                if (response.ok) {
                    // If the submission is successful, handle the response here (if needed)
                    console.log('Form submitted successfully!');
                } else {
                    // If the submission fails, enable the button again and display an error message (if needed)
                    submitButton.disabled = false;
                    submitButton.textContent = "Turn in";
                    console.log('Form submission failed!');
                }
            }).catch(error => {
                // If an error occurs during form submission, enable the button again and display an error message (if needed)
                submitButton.disabled = false;
                submitButton.textContent = "Turn in";
                console.log('An error occurred during form submission:', error);
            });
        }
    </script>
    

</x-home-layout>
