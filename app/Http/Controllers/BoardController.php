<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index(Request $request)
    {
        $boards = Board::where('user_id', $request->user()->id)->orderBy('name')->get();
        return view('boards.board_list', ['boards' => $boards]);
    }

    public function show(Board $board)
    {
        $this->authorize('view', $board);
        return view('boards.board_detail', ['board' => $board]);
    }

    public function create()
    {
        return view('boards.add_board');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'type'      => 'nullable|in:shortboard,longboard,fish,gun,other',
            'length_ft' => 'nullable|numeric|between:4,12',
        ]);

        $board = new Board($validated);
        $board->user_id = $request->user()->id;
        $board->save();

        return redirect()->route('boards.show', $board);
    }

    public function edit(Board $board)
    {
        $this->authorize('update', $board);
        return view('boards.edit_board', ['board' => $board]);
    }

    public function update(Request $request, Board $board)
    {
        $this->authorize('update', $board);

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'type'      => 'nullable|in:shortboard,longboard,fish,gun,other',
            'length_ft' => 'nullable|numeric|between:4,12',
        ]);

        $board->update($validated);

        return redirect()->route('boards.show', $board);
    }

    public function destroy(Board $board)
    {
        $this->authorize('delete', $board);

        $board->delete();

        return redirect()->route('boards.index');
    }
}