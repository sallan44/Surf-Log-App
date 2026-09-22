<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ocean-900 leading-tight">Tags</h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-4">
        <a href="{{ route('tags.create') }}">
            <x-primary-button>Add New Tag</x-primary-button>
        </a>

        <div class="bg-white rounded-xl shadow-sm border border-sand-200 p-6">
            @forelse ($tags as $tag)
                <a href="{{ route('tags.show', $tag) }}" class="inline-block bg-ocean-50 text-ocean-800 text-sm font-medium rounded-full px-3 py-1 mr-2 mb-2 hover:bg-ocean-100">{{ $tag->name }}</a>
            @empty
                <p class="text-gray-500">No tags yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
