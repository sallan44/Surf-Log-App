@props(['href', 'image', 'alt' => ''])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'flex items-center gap-4 rounded-lg border border-sand-200 bg-white p-3 shadow-sm transition hover:border-ocean-300 hover:shadow-md']) }}>
    <img src="{{ $image }}" alt="{{ $alt }}" class="h-20 w-20 sm:h-24 sm:w-24 shrink-0 rounded-lg object-cover">
    <div class="min-w-0 flex-1">
        {{ $slot }}
    </div>
</a>
