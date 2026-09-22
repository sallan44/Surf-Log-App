<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ocean-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white rounded-xl shadow-sm border border-sand-200 p-6">
                <h1 class="text-2xl font-bold text-ocean-900">{{ auth()->user()->name }}</h1>
                <p class="text-sand-700">{{ auth()->user()->email }}</p>
                @if (auth()->user()->created_at)
                    <p class="text-sm text-gray-500 mt-1">Member since {{ auth()->user()->created_at->format('M Y') }}</p>
                @endif
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                <x-stat-card label="Sessions" :value="auth()->user()->surfSessions()->count()" />
                <x-stat-card label="Spots" :value="auth()->user()->spots()->count()" />
                <x-stat-card label="Boards" :value="auth()->user()->boards()->count()" />
            </div>

            <div>
                <h2 class="text-sm font-semibold text-sand-700 uppercase tracking-wide mb-3">Quick Access</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <a href="{{ route('sessions.index') }}" class="flex flex-col items-center justify-center py-6 rounded-xl border-2 border-ocean-200 bg-white hover:border-ocean-500 hover:bg-ocean-50 transition text-ocean-800 font-semibold">
                        Sessions
                    </a>
                    <a href="{{ route('spots.index') }}" class="flex flex-col items-center justify-center py-6 rounded-xl border-2 border-ocean-200 bg-white hover:border-ocean-500 hover:bg-ocean-50 transition text-ocean-800 font-semibold">
                        Spots
                    </a>
                    <a href="{{ route('boards.index') }}" class="flex flex-col items-center justify-center py-6 rounded-xl border-2 border-ocean-200 bg-white hover:border-ocean-500 hover:bg-ocean-50 transition text-ocean-800 font-semibold">
                        Boards
                    </a>
                    <a href="{{ route('tags.index') }}" class="flex flex-col items-center justify-center py-6 rounded-xl border-2 border-ocean-200 bg-white hover:border-ocean-500 hover:bg-ocean-50 transition text-ocean-800 font-semibold">
                        Tags
                    </a>
                    <a href="{{ route('feed') }}" class="flex flex-col items-center justify-center py-6 rounded-xl border-2 border-ocean-200 bg-white hover:border-ocean-500 hover:bg-ocean-50 transition text-ocean-800 font-semibold">
                        Feed
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center py-6 rounded-xl border-2 border-ocean-200 bg-white hover:border-ocean-500 hover:bg-ocean-50 transition text-ocean-800 font-semibold">
                        Profile
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
