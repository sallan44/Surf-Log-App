<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ocean-900 leading-tight">Add New Board</h2>
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

            <form method="post" action="{{ route('boards.store') }}" enctype="multipart/form-data" class="space-y-5">
                {{ csrf_field() }}

                <div>
                    <x-input-label for="name" value="Name" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name') }}" />
                </div>

                <div>
                    <x-input-label value="Photo (optional)" />
                    <input type="file" name="photo" accept="image/*" class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:uppercase file:tracking-widest file:bg-ocean-50 file:text-ocean-800 hover:file:bg-ocean-100">
                </div>

                <div>
                    <x-input-label for="type" value="Type" />
                    <select id="type" name="type" class="mt-1 block w-full border-sand-300 focus:border-ocean-500 focus:ring-ocean-500 rounded-md shadow-sm">
                        <option value="">-- Select --</option>
                        @foreach (['shortboard', 'longboard', 'fish', 'gun', 'other'] as $type)
                            <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-input-label for="length_ft" value="Length (ft)" />
                    <x-text-input id="length_ft" name="length_ft" type="text" class="mt-1 block w-full" value="{{ old('length_ft') }}" />
                </div>

                <x-primary-button>Add Board</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
