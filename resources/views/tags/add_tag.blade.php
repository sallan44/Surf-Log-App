@extends ('layouts.master')

@section('title')
    Add Tag
@endsection

@section('content')
<h1>Add New Tag</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

<form method="post" action="{{route('tags.store')}}">
    {{csrf_field()}}
    <p>
        <label>Name</label>
        <input type="text" name="name" value="{{old('name')}}">
    </p>
    <input type="submit" value="Add Tag">
</form>
@endsection
