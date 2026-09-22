@props(['rating', 'max' => 5])

@php
$filled = max(0, min((int) $rating, (int) $max));
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-0.5']) }}>
    @for ($i = 1; $i <= $max; $i++)
        <svg viewBox="0 0 20 20" class="h-4 w-4 {{ $i <= $filled ? 'text-coral-500' : 'text-sand-300' }}" fill="currentColor">
            <path d="M10 1.5l2.6 5.27 5.82.85-4.21 4.1 1 5.79L10 14.9l-5.21 2.61 1-5.79-4.21-4.1 5.82-.85L10 1.5z"/>
        </svg>
    @endfor
</span>
