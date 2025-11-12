<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function show($id)
    {
        // redirect to first question (keeps compatibility with your routes)
        return redirect()->route('quiz.question', ['id' => $id, 'index' => 1]);
    }

    public function question($id, $index = 1)
    {
        $quiz = Quiz::with(['questions.options' => function ($q) {
            $q->orderBy('id');
        }])->findOrFail($id);

        // ensure deterministic ordering and re-index
        $questions = $quiz->questions->sortBy('id')->values();
        $total = $questions->count();

        if ($total === 0) {
            abort(404, 'No questions found for this quiz.');
        }

        $index = (int) $index;
        $index = $index < 1 ? 1 : ($index > $total ? $total : $index);

        $question = $questions[$index - 1];

        // debug log to confirm navigation works
        \Log::info("Quiz question load", ['quiz_id' => $quiz->id, 'index' => $index, 'question_id' => $question->id]);

        $answers = session("quiz_answers.{$quiz->id}", []);
        $saved = $answers[$question->id] ?? null;

        $statuses = [];
        foreach ($questions as $q) {
            $ans = $answers[$q->id] ?? null;
            if ($ans === null) {
                $statuses[$q->id] = 'unanswered';
            } else {
                $opt = $q->options->firstWhere('id', $ans);
                $statuses[$q->id] = ($opt && $opt->is_correct) ? 'correct' : 'wrong';
            }
        }

        return view('quiz_question', compact('quiz', 'question', 'questions', 'index', 'total', 'saved', 'statuses'));
    }

    public function answer(Request $request, $id, $index)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($id);
        $questions = $quiz->questions->values();
        $total = $questions->count();
        $index = max(1, min((int)$index, $total));
        $question = $questions[$index - 1];

        $request->validate([
            'option_id' => 'nullable|integer',
        ]);

        if ($request->filled('option_id')) {
            session()->put("quiz_answers.{$quiz->id}.{$question->id}", (int) $request->input('option_id'));
        } else {
            session()->forget("quiz_answers.{$quiz->id}.{$question->id}");
        }

        if ($request->input('action') === 'prev') {
            $prev = max(1, $index - 1);
            return redirect()->route('quiz.question', ['id' => $quiz->id, 'index' => $prev]);
        }

        if ($index < $total) {
            return redirect()->route('quiz.question', ['id' => $quiz->id, 'index' => $index + 1]);
        }

        return redirect()->route('quiz.results', ['id' => $quiz->id]);
    }

    public function results($id)
    {
        $quiz = Quiz::with(['questions.options'])->findOrFail($id);
        $answers = session("quiz_answers.{$quiz->id}", []);
        $score = 0;
        $max = 0;

        foreach ($quiz->questions as $q) {
            $max += $q->points ?? 1;
            $selected = $answers[$q->id] ?? null;
            if ($selected) {
                $opt = $q->options->firstWhere('id', $selected);
                if ($opt && $opt->is_correct) {
                    $score += $q->points ?? 1;
                }
            }
        }

        return view('quiz_results', compact('quiz', 'score', 'max'));
    }
}