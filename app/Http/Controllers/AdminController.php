<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Difficulty;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        $challenge = Challenge::all();
        $difficulty = Difficulty::all();
        return view('admin.dashboard', compact('challenge'), compact('difficulty'));
    }

    public function show(Challenge $challenge)
    {
        return view('admin.show', compact('challenge'));
    }
}
