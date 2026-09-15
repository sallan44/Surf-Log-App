@extends ('layouts.master')

@section('title')
    Board Detail
@endsection

@section('content')
<h1>{{$board->name}}</h1>
<img src="{{ $board->photo_url }}" alt="{{ $board->name }}" class="w-full h-48 object-cover rounded">
<p>Type: {{$board->type}}</p>
<p>Length: {{$board->length_ft}} ft</p>

<p>
    <a href="{{route('boards.edit', $board)}}">Edit Board</a>
    <form method="post" action="{{route('boards.destroy', $board)}}" style="display:inline">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <button type="submit">Delete Board</button>
    </form>
</p>

<a href="{{route('boards.index')}}">Back to My Boards</a>
@endsection
