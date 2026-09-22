<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ocean-900 leading-tight">Session Detail</h2>
    </x-slot>

    <x-hero-backdrop :image="$session->spot->photo_url" :alt="$session->spot->name">
        <h1 class="text-2xl sm:text-3xl font-bold text-white drop-shadow">{{ $session->spot->name }}</h1>
        <p class="text-sand-100">{{ $session->session_date }}</p>
    </x-hero-backdrop>

    <div class="max-w-3xl mx-auto -mt-8 relative px-4 sm:px-0 pb-12">
        <div class="bg-white rounded-xl shadow-lg border border-sand-200 p-6 space-y-4">
            <div class="flex flex-wrap items-center gap-4">
                <x-star-rating :rating="$session->rating" />
                <span class="text-sm text-gray-500">Board: {{ $session->board->name }}</span>
                @if ($session->wave_count)
                    <span class="text-sm text-gray-500">{{ $session->wave_count }} waves</span>
                @endif
            </div>

            @if ($session->notes)
                <p class="text-gray-700">{{ $session->notes }}</p>
            @endif

            @if ($conditions)
                <div class="p-3 bg-ocean-50 rounded-lg">
                    <h3 class="font-semibold text-sm text-ocean-900">Swell &amp; tide that day</h3>
                    <p class="text-sm text-ocean-800">
                        Swell: {{ $conditions['swell_height'] }}m @ {{ $conditions['swell_period'] }}s from {{ $conditions['swell_direction'] }}&deg;
                    </p>
                    <p class="text-sm text-ocean-800">Sea level: {{ $conditions['sea_level'] }}m</p>
                </div>
            @else
                <p class="text-sm text-gray-500">Swell/tide data unavailable for this session.</p>
            @endif

            @if ($wind)
                <div class="p-3 bg-sand-100 rounded-lg">
                    <h3 class="font-semibold text-sm text-sand-900">Wind that day</h3>
                    <p class="text-sm text-sand-800">
                        {{ $wind['wind_speed'] }} km/h from {{ $wind['wind_direction'] }}&deg;
                        @if ($wind['wind_gusts']) (gusting {{ $wind['wind_gusts'] }} km/h) @endif
                    </p>
                </div>
            @else
                <p class="text-sm text-gray-500">Wind data unavailable for this session.</p>
            @endif

            <div class="flex items-center gap-3 pt-2 border-t border-sand-100">
                <a href="{{ route('sessions.edit', $session) }}">
                    <x-secondary-button>Edit Session</x-secondary-button>
                </a>
                <form method="post" action="{{ route('sessions.destroy', $session) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <x-danger-button type="submit">Delete Session</x-danger-button>
                </form>
            </div>

            <a href="{{ route('sessions.index') }}" class="inline-block text-sm text-ocean-700 hover:text-ocean-900 underline">&larr; Back to My Sessions</a>
        </div>
    </div>
</x-app-layout>
