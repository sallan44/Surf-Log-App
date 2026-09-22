<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ocean-900 leading-tight">Recent Sessions</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-8 px-4 sm:px-0 space-y-4">
        @forelse ($sessions as $session)
            <div class="flex gap-4 border border-sand-200 bg-white rounded-xl shadow-sm p-4">
                <img src="{{ $session->spot->photo_url }}" alt="{{ $session->spot->name }}" class="h-20 w-20 sm:h-24 sm:w-24 shrink-0 rounded-lg object-cover">

                <div class="min-w-0 flex-1 space-y-2">
                    <div class="flex justify-between text-sm text-gray-500">
                        <span>{{ $session->user->name }}</span>
                        <span>{{ $session->session_date }}</span>
                    </div>

                    <div>
                        <h2 class="font-semibold text-ocean-900">
                            {{ $session->spot->name }}
                            <span class="text-sm text-gray-500 font-normal">({{ $session->spot->region }})</span>
                        </h2>
                        @if ($session->spot->description)
                            <p class="text-sm text-gray-600 mt-1">{{ $session->spot->description }}</p>
                        @endif
                    </div>

                    <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500">
                        <x-star-rating :rating="$session->rating" />
                        <span>Board: {{ $session->board->name }}</span>
                        @if ($session->wave_count) <span>&middot; {{ $session->wave_count }} waves</span> @endif
                    </div>

                    @if ($session->notes)
                        <p class="text-sm text-gray-700">{{ $session->notes }}</p>
                    @endif

                    @if ($session->spot->tags->isNotEmpty())
                        <div class="flex flex-wrap gap-1">
                            @foreach ($session->spot->tags as $tag)
                                <span class="inline-block bg-ocean-50 text-ocean-800 rounded-full px-2 py-0.5 text-xs">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-gray-500">No public sessions logged yet.</p>
        @endforelse

        {{ $sessions->links()}}

    </div>
</x-app-layout>