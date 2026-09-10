@extends ('layouts.master')

@section('title')
    Edit Board
@endsection

@section('content')
<h1>Edit Board</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

<form method="post" action="{{route('boards.update', $board)}}">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <p>
        <label>Name</label>
        <input type="text" name="name" value="{{old('name', $board->name)}}">
    </p>
    <p>
        <label>Type</label>
        <select name="type">
            <option value="">-- Select --</option>
            @foreach (['shortboard', 'longboard', 'fish', 'gun', 'other'] as $type)
                <option value="{{$type}}" {{old('type', $board->type) == $type ? 'selected' : ''}}>
                    {{ucfirst($type)}}
                </option>
            @endforeach
        </select>
    </p>
    <p>
        <label>Length (ft)</label>
        <input type="text" name="length_ft" value="{{old('length_ft', $board->length_ft)}}">
    </p>
    <input type="submit" value="Update Board">
</form>
@endsection
