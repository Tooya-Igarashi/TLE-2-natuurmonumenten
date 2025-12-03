<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Difficulty;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $challenges = Challenge::all();
        $difficulty = Difficulty::all();
        return view('admin.dashboard', compact('challenges', 'difficulty'));
    }

    public function show(Challenge $challenge)
    {
        $challenge->load('steps');
        return view('admin.show', compact('challenge'));
    }

    public function edit(Challenge $challenge)
    {
        $challenge->load('steps');
        $difficulties = \App\Models\Difficulty::all();
        $badges = \App\Models\Badge::all();
        return view('admin.edit', compact('challenge', 'difficulties', 'badges'));
    }

    public function update(Request $request, Challenge $challenge)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'difficulty_id' => 'required|exists:difficulties,id',
            'badge_id' => 'nullable|exists:badges,id',
            'published' => 'boolean',
            'duration' => 'nullable|date_format:H:i',
            'steps.*' => 'nullable|string|max:500',
            'image' => 'nullable|image|max:2048',
        ]);

        $challenge->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'difficulty_id' => $request->input('difficulty_id'),
            'badge_id' => $request->input('badge_id'),
            'published' => $request->boolean('published', false),
            'duration' => $request->input('duration'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.edit', $challenge)->with('success', 'Challenge updated.');
    }
}
