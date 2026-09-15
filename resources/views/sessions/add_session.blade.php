@extends ('layouts.master')

@section('title')
    Log Session
@endsection

@section('content')
<h1>Log New Session</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

<form method="post" action="{{route('sessions.store')}}">
    {{csrf_field()}}
    <p>
        <label>Spot</label>
        @if ($spots->isEmpty())
            <em>You don't have any spots yet - <a href="{{route('spots.create')}}">add one first</a>.</em>
        @else
            <select name="spot_id">
                @foreach ($spots as $spot)
                    <option value="{{$spot->id}}" {{old('spot_id') == $spot->id ? 'selected' : ''}}>
                        {{$spot->name}}@if($spot->is_private) (private) @endif
                    </option>
                @endforeach
            </select>
        @endif
    </p>
    <p>
        <label>Board</label>
        @if ($boards->isEmpty())
            <em>You don't have any boards yet - <a href="{{route('boards.create')}}">add one first</a>.</em>
        @else
            <select name="board_id">
                @foreach ($boards as $board)
                    <option value="{{$board->id}}" {{old('board_id') == $board->id ? 'selected' : ''}}>
                        {{$board->name}}
                    </option>
                @endforeach
            </select>
        @endif
    </p>
    <p>
        <label>Date</label>
        <input type="date" name="session_date" value="{{old('session_date')}}">
    </p>
    <p>
        <label>Rating (1-5)</label>
        <input type="number" name="rating" min="1" max="5" value="{{old('rating')}}">
    </p>
    <p>
        <label>Wave count</label>
        <input type="number" name="wave_count" min="0" value="{{old('wave_count')}}">
    </p>
    <p>
        <label>Notes</label>
        <textarea name="notes">{{old('notes')}}</textarea>
    </p>
    <input type="submit" value="Log Session">
</form>
@endsection
