<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class AdminController extends Controller
{
    public function admin(){
        $quizzes = Quiz::orderBy('id')->get();
        return view('admin', compact('quizzes'));
    }
}
