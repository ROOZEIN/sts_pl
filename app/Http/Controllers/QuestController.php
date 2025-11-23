<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;

class QuestController extends Controller
{
    // show grid of quizzes
    public function index()
    {
        $quizzes = Quiz::orderBy('id')->get();
        return view('quests_grid', compact('quizzes'));
    }

    // show/manage questions for a quiz
    public function questions(Quiz $quiz)
    {
        $quiz->load(['questions.options']);
        return view('quest_questions', compact('quiz'));
    }

    // store new question + options
    public function storeQuestion(Request $r, Quiz $quiz)
    {
        $r->validate([
            'question_text' => 'required|string',
            'points' => 'nullable|integer',
            'options' => 'required|array|min:2',
            'options.*.option_text' => 'required|string',
            'correct' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($r, $quiz) {
            $q = $quiz->questions()->create([
                'question_text' => $r->question_text,
                'points' => $r->points ?: 1,
            ]);

            foreach ($r->options as $i => $opt) {
                $q->options()->create([
                    'option_text' => $opt['option_text'],
                    'is_correct' => ($i == (int)$r->correct) ? 1 : 0,
                ]);
            }
        });

        return redirect()->route('quests.questions', $quiz->id)->with('success','Question added.');
    }

    // edit form
    public function editQuestion(Quiz $quiz, Question $question)
    {
        $quiz->load('questions');
        $question->load('options');
        return view('quest_question_edit', compact('quiz','question'));
    }

    // update question + options
    public function updateQuestion(Request $r, Quiz $quiz, Question $question)
    {
        $r->validate([
            'question_text' => 'required|string',
            'points' => 'nullable|integer',
            'options' => 'required|array|min:2',
            'options.*.option_text' => 'required|string',
            'correct' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($r, $question) {
            $question->update([
                'question_text' => $r->question_text,
                'points' => $r->points ?: 1,
            ]);

            // simple strategy: delete existing options and recreate (keeps code short)
            $question->options()->delete();
            foreach ($r->options as $i => $opt) {
                $question->options()->create([
                    'option_text' => $opt['option_text'],
                    'is_correct' => ($i == (int)$r->correct) ? 1 : 0,
                ]);
            }
        });

        return redirect()->route('quests.questions', $quiz->id)->with('success','Question updated.');
    }

    // delete
    public function destroyQuestion(Quiz $quiz, Question $question)
    {
        $question->options()->delete();
        $question->delete();
        return redirect()->route('quests.questions', $quiz->id)->with('success','Question deleted.');
    }

    // show create form
    public function create()
    {
        return view('quests_create');
    }

    // store new quiz
    public function store(Request $r)
    {
        $r->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'difficulty' => 'nullable|string',
        ]);

        $quiz = Quiz::create([
            'title' => $r->title,
            'description' => $r->description,
            'difficulty' => $r->difficulty,
            'created_by' => auth()->id() ?? 1,
        ]);

        return redirect()->route('quests.questions', $quiz->id)->with('success', 'Quiz created.');
    }

    // show edit page
    public function edit($id)
    {
        $quest = DB::table('quizzes')->where('id', $id)->first();
        if (! $quest) {
            abort(404);
        }

        $questions = DB::table('questions')->where('quiz_id', $id)->orderBy('id')->get()->map(function($q){
            $q->options = DB::table('options')->where('question_id', $q->id)->orderBy('id')->get();
            return $q;
        });

        return view('editquestion', compact('quest', 'questions'));
    }

    // handle update
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'nullable|array',
            'questions.*.text' => 'nullable|string',
            'questions.*.options' => 'nullable|array',
            'questions.*.options.*' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // update quest title
            DB::table('quizzes')->where('id', $id)->update([
                'title' => $data['title'],
                'updated_at' => now(),
            ]);

            // remove existing questions & options (simple approach)
            $existingQuestions = DB::table('questions')->where('quiz_id', $id)->pluck('id')->toArray();
            if (!empty($existingQuestions)) {
                DB::table('options')->whereIn('question_id', $existingQuestions)->delete();
                DB::table('questions')->whereIn('id', $existingQuestions)->delete();
            }

            // insert new questions + options
            if (!empty($data['questions'])) {
                foreach ($data['questions'] as $qi => $q) {
                    $questionId = DB::table('questions')->insertGetId([
                        'quiz_id' => $id,
                        'question_text' => $q['text'] ?? '',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    if (!empty($q['options']) && is_array($q['options'])) {
                        foreach ($q['options'] as $oi => $opt) {
                            $isCorrect = 0;
                            if (!empty($q['correct']) && is_array($q['correct'])) {
                                // accept either associative array of indexes or string values
                                $isCorrect = !empty($q['correct'][$oi]) ? 1 : 0;
                            }
                            DB::table('options')->insert([
                                'question_id' => $questionId,
                                'option_text' => $opt,
                                'is_correct' => $isCorrect,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }

            DB::commit();
            return redirect()->route('admin')->with('success', 'Quest updated.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Compatibility route used in routes/web.php
     */
    public function questview()
    {
        return $this->index();
    }
}
