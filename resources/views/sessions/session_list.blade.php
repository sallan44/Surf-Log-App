@extends ('layouts.master')

@section('title')
    My Sessions
@endsection

@section('content')
<h1>My Sessions</h1>

<a href="{{route('sessions.create')}}">Log New Session</a><p>

@foreach ($sessions as $session)
    <p>
        <a href="{{route('sessions.show', $session)}}">
            {{$session->session_date}} - {{$session->spot->name}} ({{$session->rating}}/5)
        </a>
    </p>
@endforeach

{{ $sessions->links() }}

@endsection
