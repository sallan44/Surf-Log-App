@extends ('layouts.master')

@section('title')
    Spot List
@endsection

@section('content')
<h1>Surf Spots</h1>

<a href="{{route('spots.create')}}">Add New Spot</a><p>

@foreach ($spots as $spot)
    <p>
        <a href="{{route('spots.show', $spot)}}">{{$spot->name}}</a>
        @if ($spot->is_private)
            <em>(private)</em>
        @endif
    </p>
@endforeach

{{ $spots->links() }}

@endsection
