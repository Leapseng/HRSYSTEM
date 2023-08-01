<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded']) }}>
    {{ $slot }}
</button>
