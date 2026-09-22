<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-ocean-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-ocean-600 focus:bg-ocean-600 active:bg-ocean-800 focus:outline-none focus:ring-2 focus:ring-ocean-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
