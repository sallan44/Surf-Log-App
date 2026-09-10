@extends ('layouts.master')

@section('title')
    Edit Tag
@endsection

@section('content')
<h1>Edit Tag</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

<form method="post" action="{{route('tags.update', $tag)}}">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <p>
        <label>Name</label>
        <input type="text" name="name" value="{{old('name', $tag->name)}}">
    </p>
    <input type="submit" value="Update Tag">
</form>
@endsection
