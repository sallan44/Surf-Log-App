<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ocean-900 leading-tight">Tag Detail</h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-sand-200 p-6 space-y-4">
            <h1 class="text-2xl font-bold text-ocean-900">{{ $tag->name }}</h1>

            <div class="flex items-center gap-3">
                <a href="{{ route('tags.edit', $tag) }}">
                    <x-secondary-button>Edit Tag</x-secondary-button>
                </a>
                <form method="post" action="{{ route('tags.destroy', $tag) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <x-danger-button type="submit">Delete Tag</x-danger-button>
                </form>
            </div>

            <div class="pt-4 border-t border-sand-100">
                <h2 class="font-semibold text-ocean-900 mb-2">Spots tagged "{{ $tag->name }}"</h2>

                @forelse ($spots as $spot)
                    <p class="py-1">
                        <a href="{{ route('spots.show', $spot) }}" class="text-ocean-700 hover:text-ocean-900 underline">{{ $spot->name }}</a>
                        @if ($spot->is_private)
                            <span class="ml-1 inline-block bg-sand-200 text-sand-800 text-xs font-medium rounded-full px-2 py-0.5">private</span>
                        @endif
                    </p>
                @empty
                    <p class="text-gray-500">No spots you can see are tagged with this yet.</p>
                @endforelse
            </div>

            <a href="{{ route('tags.index') }}" class="inline-block text-sm text-ocean-700 hover:text-ocean-900 underline">&larr; Back to Tags</a>
        </div>
    </div>
</x-app-layout>
