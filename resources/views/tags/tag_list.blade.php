@extends ('layouts.master')

@section('title')
    Tags
@endsection

@section('content')
<h1>Tags</h1>

<a href="{{route('tags.create')}}">Add New Tag</a><p>

@forelse ($tags as $tag)
    <p><a href="{{route('tags.show', $tag)}}">{{$tag->name}}</a></p>
@empty
    <p>No tags yet.</p>
@endforelse

@endsection
