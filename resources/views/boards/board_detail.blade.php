<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ocean-900 leading-tight">Board Detail</h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-sand-200 p-6">
            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                <x-circle-thumb :image="$board->photo_url" :alt="$board->name" size="xl" />

                <div class="text-center sm:text-left">
                    <h1 class="text-2xl font-bold text-ocean-900">{{ $board->name }}</h1>
                    @if ($board->type)
                        <p class="text-sand-700 capitalize">{{ $board->type }}</p>
                    @endif
                    @if ($board->length_ft)
                        <p class="text-gray-600 text-sm mt-1">{{ $board->length_ft }} ft</p>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-3 mt-6 pt-4 border-t border-sand-100">
                <a href="{{ route('boards.edit', $board) }}">
                    <x-secondary-button>Edit Board</x-secondary-button>
                </a>
                <form method="post" action="{{ route('boards.destroy', $board) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <x-danger-button type="submit">Delete Board</x-danger-button>
                </form>
            </div>

            <a href="{{ route('boards.index') }}" class="inline-block mt-4 text-sm text-ocean-700 hover:text-ocean-900 underline">&larr; Back to My Boards</a>
        </div>
    </div>
</x-app-layout>
