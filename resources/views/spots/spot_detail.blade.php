@extends ('layouts.master')

@section('title')
    Spot Detail
@endsection

@section('content')

<h1>{{$spot->name}}</h1>
<p>{{$spot->region}}</p>
<p>{{$spot->description}}</p>

@if ($spot->is_private)
    <p><em>This is a private spot - only visible to you.</em></p>
@endif

@if ($spot->tags->isNotEmpty())
    <p>Tags: {{ $spot->tags->pluck('name')->join(', ') }}</p>
@endif

{{-- Hiding these when you're not the owner is just UX - the SpotPolicy enforces it server-side either way --}}
@if ($spot->user_id === auth()->id())
    <p>
        <a href="{{route('spots.edit', $spot)}}">Edit Spot</a>
        <form method="post" action="{{route('spots.destroy', $spot)}}" style="display:inline">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit">Delete Spot</button>
        </form>
    </p>
@endif

<a href="{{route('spots.index')}}">Back to Spot List</a>
@endsection
