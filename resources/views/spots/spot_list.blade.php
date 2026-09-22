<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ocean-900 leading-tight">Surf Spots</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">
        <a href="{{ route('spots.create') }}">
            <x-primary-button>Add New Spot</x-primary-button>
        </a>

        <div class="space-y-3">
            @foreach ($spots as $spot)
                <x-thumb-card :href="route('spots.show', $spot)" :image="$spot->photo_url" :alt="$spot->name">
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-ocean-900 truncate">{{ $spot->name }}</span>
                        @if ($spot->is_private)
                            <span class="shrink-0 inline-block bg-sand-200 text-sand-800 text-xs font-medium rounded-full px-2 py-0.5">private</span>
                        @endif
                    </div>
                    @if ($spot->region)
                        <p class="text-sm text-gray-500 truncate">{{ $spot->region }}</p>
                    @endif
                </x-thumb-card>
            @endforeach
        </div>

        {{ $spots->links() }}
    </div>
</x-app-layout>
