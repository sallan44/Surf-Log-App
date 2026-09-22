<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ocean-900 leading-tight">Edit Spot</h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8">
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

            <form method="post" action="{{ route('spots.update', $spot) }}" enctype="multipart/form-data" class="space-y-5">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div>
                    <x-input-label for="name" value="Name" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $spot->name) }}" />
                </div>

                <div>
                    <x-input-label value="Current Photo" />
                    <img src="{{ $spot->photo_url }}" alt="{{ $spot->name }}" class="mt-2 h-32 w-32 rounded-lg object-cover border border-sand-200">

                    @if ($spot->photo_path)
                        <label class="mt-2 inline-flex items-center gap-2 text-sm text-gray-700">
                            <input type="checkbox" name="remove_photo" value="1" class="rounded border-sand-300 text-ocean-600 focus:ring-ocean-500">
                            Remove photo (revert to default)
                        </label>
                    @endif

                    <x-input-label value="Replace with new photo" class="mt-3" />
                    <input type="file" name="photo" accept="image/*" class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:uppercase file:tracking-widest file:bg-ocean-50 file:text-ocean-800 hover:file:bg-ocean-100">
                </div>

                <div>
                    <x-input-label for="region" value="Region" />
                    <x-text-input id="region" name="region" type="text" class="mt-1 block w-full" value="{{ old('region', $spot->region) }}" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="latitude" value="Latitude" />
                        <x-text-input id="latitude" name="latitude" type="text" class="mt-1 block w-full" value="{{ old('latitude', $spot->latitude) }}" />
                    </div>
                    <div>
                        <x-input-label for="longitude" value="Longitude" />
                        <x-text-input id="longitude" name="longitude" type="text" class="mt-1 block w-full" value="{{ old('longitude', $spot->longitude) }}" />
                    </div>
                </div>

                <div>
                    <x-input-label for="description" value="Description" />
                    <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-sand-300 focus:border-ocean-500 focus:ring-ocean-500 rounded-md shadow-sm">{{ old('description', $spot->description) }}</textarea>
                </div>

                <div>
                    <x-input-label value="Tags" />
                    @php $currentTagIds = old('tags', $spot->tags->pluck('id')->all()); @endphp
                    <div class="mt-2 flex flex-wrap gap-3">
                        @foreach ($tags as $tag)
                            <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                    class="rounded border-sand-300 text-ocean-600 focus:ring-ocean-500"
                                    @if (collect($currentTagIds)->contains($tag->id)) checked @endif>
                                {{ $tag->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="is_private" value="1" class="rounded border-sand-300 text-ocean-600 focus:ring-ocean-500" {{ old('is_private', $spot->is_private) ? 'checked' : '' }}>
                        Keep this spot private (only visible to me)
                    </label>
                </div>

                <x-primary-button>Update Spot</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
