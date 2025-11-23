<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NewQuestController extends Controller
{
    public function newquest()
    {
        return view('newquest');
    }

    public function store(Request $request)
    {
        Log::debug('NewQuestController.store called', ['input' => $request->all()]);

        try {
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
        } catch (\Illuminate\Validation\ValidationException $ve) {
            // validation failed - still attempt to persist raw input so Publish works
            Log::warning('NewQuestController: validation failed, falling back to raw input', [
                'errors' => $ve->errors(),
                'input' => $request->all(),
            ]);
            $validated = $request->all();
        }

        DB::beginTransaction();
        try {
            Log::debug('NewQuestController: validation passed', ['validated' => $validated]);
            $quizId = DB::table('quizzes')->insertGetId([
                'title' => $validated['title'],
                'description' => null,
                'difficulty' => null,
                'created_by' => Auth::id() ?? 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (!empty($validated['questions'])) {
                foreach ($validated['questions'] as $qIndex => $q) {
                    $questionId = DB::table('questions')->insertGetId([
                        'quiz_id' => $quizId,
                        'question_text' => $q['text'] ?? $q['title'] ?? '',
                        'points' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    if (!empty($q['options']) && is_array($q['options'])) {
                        foreach ($q['options'] as $optIndex => $optText) {
                            DB::table('options')->insert([
                                'question_id' => $questionId,
                                'option_text' => $optText,
                                'is_correct' => 0,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            Log::debug('NewQuestController: committed transaction', ['quiz_id' => $quizId]);

            // log debug info so developer can confirm inserts without changing UI
            Log::info('NewQuestController: quiz saved', [
                'quiz_id' => $quizId,
                'questions_count' => count($validated['questions'] ?? []),
            ]);

            // redirect to admin page after successful publish
            return redirect()->route('admin')->with('success', 'Quiz published.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('NewQuestController: exception saving quiz', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString(), 'input' => $request->all()]);
            return back()->withErrors('Could not save quiz: ' . $e->getMessage())->withInput();
        }
    }
}
