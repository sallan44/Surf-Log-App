@props(['label', 'value'])

<div {{ $attributes->merge(['class' => 'rounded-xl border border-sand-200 bg-white p-4 text-center']) }}>
    <div class="text-3xl font-bold text-ocean-700">{{ $value }}</div>
    <div class="text-sm text-sand-700">{{ $label }}</div>
</div>
