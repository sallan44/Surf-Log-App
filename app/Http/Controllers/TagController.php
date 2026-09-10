<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('tags.tag_list', ['tags' => Tag::orderBy('name')->get()]);
    }

    public function show(Request $request, Tag $tag)
    {
        $spots = $tag->spots()->where(function ($query) use ($request) {$query->where('is_private', false)->orWhere('user_id', $request->user()->id);})->orderBy('name')->get();
        return view('tags.tag_detail', ['tag' => $tag, 'spots' => $spots]);
    }

    public function create()
    {
        return view('tags.add_tag');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        $tag = Tag::create($validated);

        return redirect()->route('tags.show', $tag);
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit_tag', ['tag' => $tag]);
    }

    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
        ]);

        $tag->update($validated);

        return redirect()->route('tags.show', $tag);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete(); // spot_tag rows for it cascade automatically

        return redirect()->route('tags.index');
    }
}