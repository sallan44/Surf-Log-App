@extends ('layouts.master')

@section('title')
    Tag Detail
@endsection

@section('content')
<h1>{{$tag->name}}</h1>

<p>
    <a href="{{route('tags.edit', $tag)}}">Edit Tag</a>
    <form method="post" action="{{route('tags.destroy', $tag)}}" style="display:inline">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <button type="submit">Delete Tag</button>
    </form>
</p>

<h2>Spots tagged "{{$tag->name}}"</h2>

@forelse ($spots as $spot)
    <p>
        <a href="{{route('spots.show', $spot)}}">{{$spot->name}}</a>
        @if ($spot->is_private)
            <em>(private)</em>
        @endif
    </p>
@empty
    <p>No spots you can see are tagged with this yet.</p>
@endforelse

<a href="{{route('tags.index')}}">Back to Tags</a>
@endsection
