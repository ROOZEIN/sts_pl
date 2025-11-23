<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function show($id) { return redirect()->route('quiz.question', ['id'=>$id,'index'=>1]); }

    public function question($id, $index = 1)
    {
        $quiz = Quiz::with(['questions' => fn($q)=>$q->orderBy('id'), 'questions.options' => fn($q)=>$q->orderBy('id')])
                    ->findOrFail($id);

        $questions = $quiz->questions->values();
        $total = $questions->count();
        if ($total === 0) abort(404);

        $index = max(1, min((int)$index, $total));
        $question = $questions[$index - 1];

        $answers = session("quiz_answers.{$quiz->id}", []);
        $saved = $answers[$question->id] ?? null;

        $statuses = $questions->mapWithKeys(fn($q) => [
            $q->id => ($answers[$q->id] ?? null)
                ? (($q->options->firstWhere('id', $answers[$q->id])?->is_correct) ? 'correct' : 'wrong')
                : 'unanswered'
        ])->toArray();

        return view('quiz_question', compact('quiz','question','questions','index','total','saved','statuses'));
    }

    public function answer(Request $r, $id, $index)
    {
        $r->validate(['option_id' => 'nullable|integer']);
        $quiz = Quiz::with('questions.options')->findOrFail($id);
        $questions = $quiz->questions->sortBy('id')->values();
        $index = max(1, min((int)$index, $questions->count()));
        $question = $questions[$index - 1];

        if ($r->filled('option_id')) session()->put("quiz_answers.{$id}.{$question->id}", (int)$r->option_id);
        else session()->forget("quiz_answers.{$id}.{$question->id}");

        if ($r->action === 'prev') return redirect()->route('quiz.question', ['id'=>$id,'index'=>max(1,$index-1)]);
        if ($index < $questions->count()) return redirect()->route('quiz.question', ['id'=>$id,'index'=>$index+1]);

        return redirect()->route('quiz.results', $id);
    }

    public function results($id)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($id);
        $answers = session("quiz_answers.{$id}", []);
        $score = 0; $max = 0;
        foreach ($quiz->questions as $q) {
            $max += $q->points ?: 1;
            if (($sel = $answers[$q->id] ?? null) && ($opt = $q->options->firstWhere('id', $sel)) && $opt->is_correct) {
                $score += $q->points ?: 1;
            }
        }
        return view('quiz_results', compact('quiz','score','max'));
    }
}