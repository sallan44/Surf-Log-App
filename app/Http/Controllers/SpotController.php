<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpotController extends Controller
{

    public function index(Request $request)
    {
        $spots = Spot::where('user_id', $request->user()->id)->orderBy('name')->paginate(10);
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
            'photo'       => 'nullable|image|max:5120', // 5MB
        ]);

        $tagIds = $validated['tags'] ?? [];
        unset($validated['tags'], $validated['photo']);

        $spot = new Spot($validated);
        $spot->is_private = $request->boolean('is_private');
        $spot->user_id = $request->user()->id;

        if ($request->hasFile('photo')) {
            $spot->photo_path = $request->file('photo')->store('spots', 'public');
        }

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
            'name'         => 'required|string|max:255',
            'region'       => 'nullable|string|max:255',
            'latitude'     => 'nullable|numeric|between:-90,90',
            'longitude'    => 'nullable|numeric|between:-180,180',
            'description'  => 'nullable|string',
            'tags'         => 'nullable|array',
            'tags.*'       => 'integer|exists:tags,id',
            'photo'        => 'nullable|image|max:5120',
            'remove_photo' => 'nullable|boolean',
        ]);

        $tagIds = $validated['tags'] ?? [];
        unset($validated['tags'], $validated['photo'], $validated['remove_photo']);

        $spot->fill($validated);
        $spot->is_private = $request->boolean('is_private');

        if ($request->hasFile('photo')) {
            // replacing - delete the old file so orphans don't pile up in storage
            if ($spot->photo_path) {
                Storage::disk('public')->delete($spot->photo_path);
            }
            $spot->photo_path = $request->file('photo')->store('spots', 'public');
        } elseif ($request->boolean('remove_photo') && $spot->photo_path) {
            Storage::disk('public')->delete($spot->photo_path);
            $spot->photo_path = null;
        }

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