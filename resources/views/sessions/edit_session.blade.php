@extends ('layouts.master')

@section('title')
    Edit Session
@endsection

@section('content')
<h1>Edit Session</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

<form method="post" action="{{route('sessions.update', $session)}}">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <p>
        <label>Spot</label>
        <select name="spot_id">
            @foreach ($spots as $spot)
                <option value="{{$spot->id}}" {{old('spot_id', $session->spot_id) == $spot->id ? 'selected' : ''}}>
                    {{$spot->name}}@if($spot->is_private) (private) @endif
                </option>
            @endforeach
        </select>
    </p>
    <p>
        <label>Board</label>
        <select name="board_id">
            @foreach ($boards as $board)
                <option value="{{$board->id}}" {{old('board_id', $session->board_id) == $board->id ? 'selected' : ''}}>
                    {{$board->name}}
                </option>
            @endforeach
        </select>
    </p>
    <p>
        <label>Date</label>
        <input type="date" name="session_date" value="{{old('session_date', $session->session_date)}}">
    </p>
    <p>
        <label>Rating (1-5)</label>
        <input type="number" name="rating" min="1" max="5" value="{{old('rating', $session->rating)}}">
    </p>
    <p>
        <label>Wave count</label>
        <input type="number" name="wave_count" min="0" value="{{old('wave_count', $session->wave_count)}}">
    </p>
    <p>
        <label>Notes</label>
        <textarea name="notes">{{old('notes', $session->notes)}}</textarea>
    </p>
    <input type="submit" value="Update Session">
</form>
@endsection
