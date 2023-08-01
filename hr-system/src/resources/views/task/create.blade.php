<x-home-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Assign To:</label>
                            <select id="user_id" name="user_id" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring focus:ring-opacity-50 focus:outline-none focus:border-blue-300">
                                @foreach($user as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Task Title:</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring focus:ring-opacity-50 focus:outline-none focus:border-blue-300">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date:</label>
                            <input type="date" name="due_date" id="due_date" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring focus:ring-opacity-50 focus:outline-none focus:border-blue-300">
                            @error('due_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring focus:ring-opacity-50 focus:outline-none focus:border-blue-300"></textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700">File:</label>
                            <input type="file" name="file" id="file" class="mt-1 block">
                            @error('file')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>
