<?php

namespace App\Http\Controllers;

use App\Models\Quiz;

class DashboardController extends Controller
{
    public function index()
    {
        // minimal: load quizzes for current user (adjust query as needed)
        $quizzes = Quiz::where('created_by', auth()->id())->get();

        return view('dashboard', compact('quizzes'));
    }
}