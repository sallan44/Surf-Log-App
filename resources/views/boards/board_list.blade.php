<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ocean-900 leading-tight">My Boards</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">
        <a href="{{ route('boards.create') }}">
            <x-primary-button>Add New Board</x-primary-button>
        </a>

        <div class="space-y-3">
            @foreach ($boards as $board)
                <a href="{{ route('boards.show', $board) }}" class="flex items-center gap-4 rounded-lg border border-sand-200 bg-white p-3 shadow-sm transition hover:border-ocean-300 hover:shadow-md">
                    <x-circle-thumb :image="$board->photo_url" :alt="$board->name" size="sm" />
                    <div class="min-w-0 flex-1">
                        <span class="font-semibold text-ocean-900 truncate block">{{ $board->name }}</span>
                        @if ($board->type)
                            <p class="text-sm text-gray-500 capitalize">{{ $board->type }}</p>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

        {{ $boards->links() }}
    </div>
</x-app-layout>
