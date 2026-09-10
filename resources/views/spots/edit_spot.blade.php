@extends ('layouts.master')

@section('title')
    Edit Spot
@endsection

@section('content')
<h1>Edit Spot</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

<form method="post" action="{{route('spots.update', $spot)}}">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <p>
        <label>Name</label>
        <input type="text" name="name" value="{{old('name', $spot->name)}}">
    </p>
    <p>
        <label>Region</label>
        <input type="text" name="region" value="{{old('region', $spot->region)}}">
    </p>
    <p>
        <label>Latitude</label>
        <input type="text" name="latitude" value="{{old('latitude', $spot->latitude)}}">
    </p>
    <p>
        <label>Longitude</label>
        <input type="text" name="longitude" value="{{old('longitude', $spot->longitude)}}">
    </p>
    <p>
        <label>Description</label>
        <textarea name="description">{{old('description', $spot->description)}}</textarea>
    </p>
    <p>
        <label>Tags</label><br>
        @php $currentTagIds = old('tags', $spot->tags->pluck('id')->all()); @endphp
        @foreach ($tags as $tag)
            <label>
                <input type="checkbox" name="tags[]" value="{{$tag->id}}"
                    @if (collect($currentTagIds)->contains($tag->id)) checked @endif>
                {{$tag->name}}
            </label><br>
        @endforeach
    </p>
    <p>
        <label>
            <input type="checkbox" name="is_private" value="1" {{old('is_private', $spot->is_private) ? 'checked' : ''}}>
            Keep this spot private (only visible to me)
        </label>
    </p>
    <input type="submit" value="Update Spot">
</form>
@endsection
