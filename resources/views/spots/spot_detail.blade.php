<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ocean-900 leading-tight">Spot Detail</h2>
    </x-slot>

    <x-hero-backdrop :image="$spot->photo_url" :alt="$spot->name">
        <h1 class="text-2xl sm:text-3xl font-bold text-white drop-shadow">{{ $spot->name }}</h1>
        @if ($spot->region)
            <p class="text-sand-100">{{ $spot->region }}</p>
        @endif
    </x-hero-backdrop>

    <div class="max-w-3xl mx-auto -mt-8 relative px-4 sm:px-0 pb-12">
        <div class="bg-white rounded-xl shadow-lg border border-sand-200 p-6 space-y-4">
            @if ($spot->is_private)
                <span class="inline-block bg-sand-200 text-sand-800 text-xs font-medium rounded-full px-2.5 py-1">Private spot — only visible to you</span>
            @endif

            @if ($spot->description)
                <p class="text-gray-700">{{ $spot->description }}</p>
            @endif

            @if ($spot->tags->isNotEmpty())
                <div class="flex flex-wrap gap-2">
                    @foreach ($spot->tags as $tag)
                        <span class="inline-block bg-ocean-50 text-ocean-800 text-xs font-medium rounded-full px-2.5 py-1">{{ $tag->name }}</span>
                    @endforeach
                </div>
            @endif

            {{-- Hiding these when you're not the owner is just UX - the SpotPolicy enforces it server-side either way --}}
            @if ($spot->user_id === auth()->id())
                <div class="flex items-center gap-3 pt-2 border-t border-sand-100">
                    <a href="{{ route('spots.edit', $spot) }}">
                        <x-secondary-button>Edit Spot</x-secondary-button>
                    </a>
                    <form method="post" action="{{ route('spots.destroy', $spot) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <x-danger-button type="submit">Delete Spot</x-danger-button>
                    </form>
                </div>
            @endif

            <a href="{{ route('spots.index') }}" class="inline-block text-sm text-ocean-700 hover:text-ocean-900 underline">&larr; Back to Spot List</a>
        </div>
    </div>
</x-app-layout>
