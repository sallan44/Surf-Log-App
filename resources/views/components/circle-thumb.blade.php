@props(['image', 'alt' => '', 'size' => 'md'])

@php
$sizes = [
    'sm' => 'w-16 h-16 ring-2',
    'md' => 'w-20 h-20 ring-2',
    'lg' => 'w-40 h-40 ring-4',
    'xl' => 'w-48 h-48 ring-4',
];
$sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<img
    src="{{ $image }}"
    alt="{{ $alt }}"
    {{ $attributes->merge(['class' => "$sizeClass rounded-full object-cover ring-sand-200 shadow shrink-0"]) }}
>
