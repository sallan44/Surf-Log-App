@extends ('layouts.master')

@section('title')
    My Boards
@endsection

@section('content')
<h1>My Boards</h1>

<a href="{{route('boards.create')}}">Add New Board</a><p>

@foreach ($boards as $board)
    <p><a href="{{route('boards.show', $board)}}">{{$board->name}}</a> ({{$board->type}})</p>
@endforeach
@endsection
