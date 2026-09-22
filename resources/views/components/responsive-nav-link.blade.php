@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-ocean-500 text-start text-base font-medium text-ocean-800 bg-ocean-50 focus:outline-none focus:text-ocean-900 focus:bg-ocean-100 focus:border-ocean-700 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-ocean-800 hover:bg-sand-50 hover:border-sand-300 focus:outline-none focus:text-ocean-800 focus:bg-sand-50 focus:border-sand-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
