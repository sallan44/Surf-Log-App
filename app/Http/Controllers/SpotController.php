<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SpotController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show']),
        ];
    }

    public function index(Request $request)
    {
        $spots = Spot::where(function ($query) use ($request) {$query->where('is_private', false)->orWhere('user_id', $request->user()->id);})->orderBy('name')->get();
        return view('spots.spot_list', ['spots' => $spots]);
    }

    public function show(Spot $spot)
    {
        $this->authorize('view', $spot);
        return view('spots.spot_detail', ['spot' => $spot->load('tags')]);
    }

    public function create()
    {
        return view('spots.add_spot', ['tags' => Tag::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'region'      => 'nullable|string|max:255',
            'latitude'    => 'nullable|numeric|between:-90,90',
            'longitude'   => 'nullable|numeric|between:-180,180',
            'description' => 'nullable|string',
            'tags'        => 'nullable|array',
            'tags.*'      => 'integer|exists:tags,id',
        ]);

        $tagIds = $validated['tags'] ?? [];
        unset($validated['tags']);

        $spot = new Spot($validated);
        $spot->is_private = $request->boolean('is_private');
        $spot->user_id = $request->user()->id; // set explicitly - never trust this from form input
        $spot->save();

        $spot->tags()->sync($tagIds);

        return redirect()->route('spots.show', $spot);
    }

    public function edit(Spot $spot)
    {
        $this->authorize('update', $spot);
        return view('spots.edit_spot', ['spot' => $spot, 'tags' => Tag::orderBy('name')->get()]);
    }

    public function update(Request $request, Spot $spot)
    {
        $this->authorize('update', $spot);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'region'      => 'nullable|string|max:255',
            'latitude'    => 'nullable|numeric|between:-90,90',
            'longitude'   => 'nullable|numeric|between:-180,180',
            'description' => 'nullable|string',
            'tags'        => 'nullable|array',
            'tags.*'      => 'integer|exists:tags,id',
        ]);

        $tagIds = $validated['tags'] ?? [];
        unset($validated['tags']);

        $spot->fill($validated);
        $spot->is_private = $request->boolean('is_private');
        $spot->save();

        $spot->tags()->sync($tagIds);

        return redirect()->route('spots.show', $spot);
    }

    public function destroy(Spot $spot)
    {
        $this->authorize('delete', $spot);
        $spot->delete();
        return redirect()->route('spots.index');
    }
}