<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <div class="mt-1 relative rounded-md shadow-sm">
        <input
            type="date"
            name="{{ $name }}"
            id="{{ $name }}"
            class="form-input block w-full pr-10 sm:text-sm sm:leading-5"
            value="{{ old($name) }}"
            {{ $attributes }}
        >
    </div>
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
