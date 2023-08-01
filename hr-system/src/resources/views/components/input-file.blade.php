@props(['name', 'label', 'defaultFileName' => 'No file chosen'])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <div class="mt-1 flex items-center">
        <span class="inline-block w-32 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 cursor-pointer hover:text-gray-500">
            Browse...
        </span>
        <input
            type="file"
            name="{{ $name }}"
            id="{{ $name }}"
            class="absolute inset-0 opacity-0 z-50"
            {{ $attributes }}
        >
        <span class="ml-3" id="file-name">{{ $defaultFileName }}</span>
    </div>
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputFile = document.getElementById('{{ $name }}');
        const fileNameDisplay = document.getElementById('file-name');

        inputFile.addEventListener('change', function () {
            if (this.files.length > 0) {
                const fileName = this.files[0].name;
                fileNameDisplay.textContent = fileName;
            }
        });
    });
</script>
@endpush
