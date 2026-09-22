<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ocean-900 leading-tight">My Sessions</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">
        <a href="{{ route('sessions.create') }}">
            <x-primary-button>Log New Session</x-primary-button>
        </a>

        <div class="space-y-3">
            @foreach ($sessions as $session)
                <x-thumb-card :href="route('sessions.show', $session)" :image="$session->spot->photo_url" :alt="$session->spot->name">
                    <span class="font-semibold text-ocean-900 truncate block">{{ $session->spot->name }}</span>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <span>{{ $session->session_date }}</span>
                        <x-star-rating :rating="$session->rating" />
                    </div>
                </x-thumb-card>
            @endforeach
        </div>

        {{ $sessions->links() }}
    </div>
</x-app-layout>
