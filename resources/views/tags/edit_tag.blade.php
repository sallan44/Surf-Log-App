<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ocean-900 leading-tight">Edit Tag</h2>
    </x-slot>

    <div class="py-8 max-w-md mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-sand-200 p-6">
            @if ($errors->any())
                <div class="mb-4 rounded-md bg-red-50 border border-red-200 p-4">
                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('tags.update', $tag) }}" class="space-y-5">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div>
                    <x-input-label for="name" value="Name" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $tag->name) }}" />
                </div>

                <x-primary-button>Update Tag</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
