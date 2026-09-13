<?php

namespace App\Http\Controllers;

use App\Models\SurfSession;

class FeedController extends Controller
{
    public function index()
    {
        $sessions = SurfSession::whereHas('spot', fn ($query) => $query->where('is_private', false))
            ->with(['spot.tags', 'board', 'user'])
            ->orderBy('session_date', 'desc')
            ->get();

        return view('feed', ['sessions' => $sessions]);
    }
}