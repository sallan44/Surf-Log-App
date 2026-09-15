@extends ('layouts.master')

@section('title')
    Session Detail
@endsection

@section('content')
<h1>{{$session->spot->name}} - {{$session->session_date}}</h1>
<p>Board: {{$session->board->name}}</p>
<p>Rating: {{$session->rating}}/5</p>
<p>Wave count: {{$session->wave_count}}</p>
<p>{{$session->notes}}</p>

@if ($conditions)
    <div class="mt-4 p-3 bg-blue-50 rounded">
        <h3 class="font-semibold text-sm">Swell & tide that day</h3>
        <p class="text-sm">
            Swell: {{ $conditions['swell_height'] }}m @ {{ $conditions['swell_period'] }}s from {{ $conditions['swell_direction'] }}&deg;
        </p>
        <p class="text-sm">Sea level: {{ $conditions['sea_level'] }}m</p>
    </div>
@else
    <p class="text-sm text-gray-500 mt-4">Swell/tide data unavailable for this session.</p>
@endif

@if ($wind)
    <div class="mt-2 p-3 bg-green-50 rounded">
        <h3 class="font-semibold text-sm">Wind that day</h3>
        <p class="text-sm">
            {{ $wind['wind_speed'] }} km/h from {{ $wind['wind_direction'] }}&deg;
            @if ($wind['wind_gusts']) (gusting {{ $wind['wind_gusts'] }} km/h) @endif
        </p>
    </div>
@else
    <p class="text-sm text-gray-500 mt-2">Wind data unavailable for this session.</p>
@endif

<p>
    <a href="{{route('sessions.edit', $session)}}">Edit Session</a>
    <form method="post" action="{{route('sessions.destroy', $session)}}" style="display:inline">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <button type="submit">Delete Session</button>
    </form>
</p>

<a href="{{route('sessions.index')}}">Back to My Sessions</a>
@endsection
