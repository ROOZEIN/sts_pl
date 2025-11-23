<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\NewQuestController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;
use Psy\Command\EditCommand;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/quest', [QuestController::class, 'questview'])->name('quest');
    Route::get('/point', [PointController::class, 'points'])->name('point');
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    Route::get('/edit', [EditController::class, 'edit'])->name('edit');
    Route::get('/newquest', [NewQuestController::class, 'newquest'])->name('newquest');
    Route::post('/newquest', [NewQuestController::class, 'store'])->name('newquest.store');
    Route::get('/quiz/{id}/question/{index?}', [QuizController::class, 'question'])->name('quiz.question');
    Route::post('/quiz/{id}/question/{index}/answer', [QuizController::class, 'answer'])->name('quiz.answer');
    Route::get('/quiz/{id}/results', [QuizController::class, 'results'])->name('quiz.results');
    Route::get('/quiz/{id}', [QuizController::class, 'show'])->name('quiz.show');
    // show edit page
    Route::get('/quest/{id}/edit', [QuestController::class, 'edit'])->name('quest.edit');
    // update handler
    Route::put('/quest/{id}', [QuestController::class, 'update'])->name('quest.update');
});

require __DIR__.'/auth.php';
