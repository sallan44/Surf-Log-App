@extends ('layouts.master')

@section('title')
    Add Board
@endsection

@section('content')
<h1>Add New Board</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

<form method="post" action="{{route('boards.store')}}" enctype="multipart/form-data">
    {{csrf_field()}}
    <p>
        <label>Name</label>
        <input type="text" name="name" value="{{old('name')}}">
    </p>
    <p>
        <label>Photo (optional)</label>
        <input type="file" name="photo" accept="image/*">
    </p>
    <p>
        <label>Type</label>
        <select name="type">
            <option value="">-- Select --</option>
            @foreach (['shortboard', 'longboard', 'fish', 'gun', 'other'] as $type)
                <option value="{{$type}}" {{old('type') == $type ? 'selected' : ''}}>{{ucfirst($type)}}</option>
            @endforeach
        </select>
    </p>
    <p>
        <label>Length (ft)</label>
        <input type="text" name="length_ft" value="{{old('length_ft')}}">
    </p>
    <input type="submit" value="Add Board">
</form>
@endsection
