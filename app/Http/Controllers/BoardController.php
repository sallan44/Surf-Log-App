<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoardController extends Controller
{
    public function index(Request $request)
    {
        $boards = Board::where('user_id', $request->user()->id)->orderBy('name')->paginate(10);
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
            'photo'     => 'nullable|image|max:5120',
        ]);

        // unset($validated['photo']);

        $board = new Board($validated);
        $board->user_id = $request->user()->id;

        if ($request->hasFile('photo')) {
            $board->photo_path = $request->file('photo')->store('boards', 'public');
        }

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
            'photo'        => 'nullable|image|max:5120',
            'remove_photo' => 'nullable|boolean',
        ]);

        $board->update($validated);

        if ($request->hasFile('photo')) {
        // replacing - delete the old file so orphans don't pile up in storage
            if ($board->photo_path) {
                Storage::disk('public')->delete($board->photo_path);
            }
            $board->photo_path = $request->file('photo')->store('boards', 'public');
        } elseif ($request->boolean('remove_photo') && $board->photo_path) {
            Storage::disk('public')->delete($board->photo_path);
            $board->photo_path = null;
        }

        return redirect()->route('boards.show', $board);
    }

    public function destroy(Board $board)
    {
        $this->authorize('delete', $board);

        $board->delete();

        return redirect()->route('boards.index');
    }
}