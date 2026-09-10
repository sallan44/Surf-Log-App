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
