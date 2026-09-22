@props(['image', 'alt' => ''])

<div {{ $attributes->merge(['class' => 'relative h-64 sm:h-80 w-full overflow-hidden rounded-b-2xl border-b-4 border-sand-300 shadow-md']) }}>
    <img src="{{ $image }}" alt="{{ $alt }}" class="absolute inset-0 h-full w-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-ocean-950/80 via-ocean-900/20 to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 p-4 sm:p-6 pb-10 sm:pb-10">
        {{ $slot }}
    </div>
</div>
