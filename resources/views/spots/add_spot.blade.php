@extends ('layouts.master')

@section('title')
    Add Spot
@endsection

@section('content')
<h1>Add New Spot</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

<form method="post" action="{{route('spots.store')}}" enctype="multipart/form-data">
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
        <label>Region</label>
        <input type="text" name="region" value="{{old('region')}}">
    </p>
    <p>
        <label>Latitude</label>
        <input type="text" name="latitude" value="{{old('latitude')}}">
    </p>
    <p>
        <label>Longitude</label>
        <input type="text" name="longitude" value="{{old('longitude')}}">
    </p>
    <p>
        <label>Description</label>
        <textarea name="description">{{old('description')}}</textarea>
    </p>
    <p>
        <label>Tags</label><br>
        @foreach ($tags as $tag)
            <label>
                <input type="checkbox" name="tags[]" value="{{$tag->id}}"
                    @if (collect(old('tags', []))->contains($tag->id)) checked @endif>
                {{$tag->name}}
            </label><br>
        @endforeach
        @if ($tags->isEmpty())
            <em>No tags yet - <a href="{{route('tags.create')}}">create one</a>.</em>
        @endif
    </p>
    <p>
        <label>
            <input type="checkbox" name="is_private" value="1" {{old('is_private') ? 'checked' : ''}}>
            Keep this spot private (only visible to me)
        </label>
    </p>
    <input type="submit" value="Add Spot">
</form>
@endsection
