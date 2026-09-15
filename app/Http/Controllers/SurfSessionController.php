<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Spot;
use App\Models\SurfSession;
use Illuminate\Http\Request;

class SurfSessionController extends Controller
{

    public function index(Request $request)
    {
        $sessions = SurfSession::where('user_id', $request->user()->id)
        ->with(['spot', 'board'])
        ->orderBy('session_date', 'desc')
        ->get();

        return view('sessions.session_list', ['sessions' => $sessions]);
    }

    public function show(SurfSession $surfSession)
    {
        $this->authorize('view', $surfSession);
        return view('sessions.session_detail', ['session' => $surfSession->load(['spot', 'board'])]);
    }

    public function create(Request $request)
    {
        return view('sessions.add_session', [
            'spots'  => $this->accessibleSpots($request),
            'boards' => Board::where('user_id', $request->user()->id)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateSession($request);

        if ($error = $this->rejectInaccessibleSpotOrBoard($request, $validated)) {
            return $error;
        }

        $session = new SurfSession($validated);
        $session->user_id = $request->user()->id;
        $session->save();

        return redirect()->route('sessions.show', $session);
    }

    public function edit(Request $request, SurfSession $surfSession)
    {
        $this->authorize('update', $surfSession);

        return view('sessions.edit_session', [
            'session' => $surfSession,
            'spots'   => $this->accessibleSpots($request),
            'boards'  => Board::where('user_id', $request->user()->id)->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, SurfSession $surfSession)
    {
        $this->authorize('update', $surfSession);

        $validated = $this->validateSession($request);

        if ($error = $this->rejectInaccessibleSpotOrBoard($request, $validated)) {
            return $error;
        }

        $surfSession->update($validated);

        return redirect()->route('sessions.show', $surfSession);
    }

    public function destroy(SurfSession $surfSession)
    {
        $this->authorize('delete', $surfSession);

        $surfSession->delete();

        return redirect()->route('sessions.index');
    }

    private function validateSession(Request $request): array
    {
        return $request->validate([
            'spot_id'      => 'required|integer|exists:spots,id',
            'board_id'     => 'required|integer|exists:boards,id',
            'session_date' => 'required|date|before_or_equal:today',
            'rating'       => 'required|integer|between:1,5',
            'wave_count'   => 'nullable|integer|min:0',
            'notes'        => 'nullable|string',
        ]);
    }

    // exists:spots,id / exists:boards,id only prove the rows exist - not that this user may use them
    private function rejectInaccessibleSpotOrBoard(Request $request, array $validated)
    {
        $spot = Spot::findOrFail($validated['spot_id']);
        if ($spot->is_private && $spot->user_id !== $request->user()->id) {
            return back()->withErrors(['spot_id' => 'You cannot log a session at that spot.'])->withInput();
        }

        $board = Board::findOrFail($validated['board_id']);
        if ($board->user_id !== $request->user()->id) {
            return back()->withErrors(['board_id' => "You cannot log a session with someone else's board."])->withInput();
        }

        return null;
    }

    private function accessibleSpots(Request $request)
    {
        return Spot::where(function ($query) use ($request) {
                $query->where('is_private', false)
                      ->orWhere('user_id', $request->user()->id);
            })
            ->orderBy('name')
            ->get();
    }
}