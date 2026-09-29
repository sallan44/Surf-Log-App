<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ocean-900 leading-tight">Edit Session</h2>
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

            <form method="post" action="{{ route('sessions.update', $session) }}" class="space-y-5">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div>
                    <x-input-label for="spot_id" value="Spot" />
                    <select id="spot_id" name="spot_id" class="mt-1 block w-full border-sand-300 focus:border-ocean-500 focus:ring-ocean-500 rounded-md shadow-sm">
                        @foreach ($spots as $spot)
                            <option value="{{ $spot->id }}" {{ old('spot_id', $session->spot_id) == $spot->id ? 'selected' : '' }}>
                                {{ $spot->name }}@if($spot->is_private) (private) @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-input-label for="board_id" value="Board" />
                    <select id="board_id" name="board_id" class="mt-1 block w-full border-sand-300 focus:border-ocean-500 focus:ring-ocean-500 rounded-md shadow-sm">
                        @foreach ($boards as $board)
                            <option value="{{ $board->id }}" {{ old('board_id', $session->board_id) == $board->id ? 'selected' : '' }}>{{ $board->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-input-label for="session_date" value="Date" />
                    <x-text-input id="session_date" name="session_date" type="date" class="mt-1 block w-full" value="{{ old('session_date', $session->session_date) }}" />
                </div>

                <div>
                    <x-input-label for="start_time" value="Start Time" />
                    <x-text-input id="start_time" name="start_time" type="time" class="mt-1 block w-full" value="{{ old('start_time', $session->start_time) }}" />
                </div>

                <div>
                    <x-input-label for="rating" value="Rating (1-5)" />
                    <x-text-input id="rating" name="rating" type="number" min="1" max="5" class="mt-1 block w-full" value="{{ old('rating', $session->rating) }}" />
                </div>

                <div>
                    <x-input-label for="wave_count" value="Wave count" />
                    <x-text-input id="wave_count" name="wave_count" type="number" min="0" class="mt-1 block w-full" value="{{ old('wave_count', $session->wave_count) }}" />
                </div>

                <div>
                    <x-input-label for="notes" value="Notes" />
                    <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full border-sand-300 focus:border-ocean-500 focus:ring-ocean-500 rounded-md shadow-sm">{{ old('notes', $session->notes) }}</textarea>
                </div>

                <x-primary-button>Update Session</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
