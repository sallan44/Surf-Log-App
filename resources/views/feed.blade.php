<x-app-layout>
    <div class="max-w-2xl mx-auto py-8 space-y-4">
        <h1 class="text-2xl font-bold">Recent Sessions</h1>

        @forelse ($sessions as $session)
            <div class="border rounded p-4 space-y-2">
                <div class="flex justify-between text-sm text-gray-500">
                    <span>{{ $session->user->name }}</span>
                    <span>{{ $session->session_date }}</span>
                </div>

                <div>
                    <h2 class="font-semibold">
                        {{ $session->spot->name }}
                        <span class="text-sm text-gray-500">({{ $session->spot->region }})</span>
                    </h2>
                    <p class="text-sm text-gray-600">{{ $session->spot->latitude }}, {{ $session->spot->longitude }}</p>
                    @if ($session->spot->description)
                        <p class="text-sm mt-1">{{ $session->spot->description }}</p>
                    @endif
                </div>

                <p class="text-sm">
                    Board: {{ $session->board->name }} ({{ $session->board->type }}, {{ $session->board->length_ft }}ft)
                </p>

                <p class="text-sm">
                    Rating: {{ $session->rating }}/5
                    @if ($session->wave_count) &middot; {{ $session->wave_count }} waves @endif
                </p>

                @if ($session->notes)
                    <p class="mt-2">{{ $session->notes }}</p>
                @endif

                @if ($session->spot->tags->isNotEmpty())
                    <div class="mt-2">
                        @foreach ($session->spot->tags as $tag)
                            <span class="inline-block bg-gray-200 rounded px-2 py-1 text-xs mr-1">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <p class="text-gray-500">No public sessions logged yet.</p>
        @endforelse

        {{ $sessions->links() }}

    </div>
</x-app-layout>