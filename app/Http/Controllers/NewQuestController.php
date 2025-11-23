<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NewQuestController extends Controller
{
    public function newquest()
    {
        return view('newquest');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'nullable|array',
            'questions.*.title' => 'nullable|string',
            'questions.*.text' => 'nullable|string',
            'questions.*.options' => 'nullable|array',
            'questions.*.options.*' => 'nullable|string',
            'questions.*.multi' => 'nullable',
            'questions.*.required' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $quizId = DB::table('quizzes')->insertGetId([
                'title' => $validated['title'],
                'user_id' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (!empty($validated['questions'])) {
                foreach ($validated['questions'] as $qIndex => $q) {
                    $questionId = DB::table('questions')->insertGetId([
                        'quiz_id' => $quizId,
                        'question_text' => $q['text'] ?? $q['title'] ?? '',
                        'title' => $q['title'] ?? null,
                        'is_multiple' => !empty($q['multi']) ? 1 : 0,
                        'is_required' => !empty($q['required']) ? 1 : 0,
                        'position' => $qIndex,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    if (!empty($q['options']) && is_array($q['options'])) {
                        foreach ($q['options'] as $optIndex => $optText) {
                            DB::table('options')->insert([
                                'question_id' => $questionId,
                                'option_text' => $optText,
                                'is_correct' => 0,
                                'position' => $optIndex,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            // redirect to admin page after successful publish
            return redirect()->route('admin')->with('success', 'Quiz published.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors('Could not save quiz: ' . $e->getMessage())->withInput();
        }
    }
}
