<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestController extends Controller
{
    public function questview(){
        return view('quest');
    }

    // show edit page
    public function edit($id)
    {
        $quest = DB::table('quests')->where('id', $id)->first();
        if (! $quest) {
            abort(404);
        }

        $questions = DB::table('questions')->where('quest_id', $id)->orderBy('position')->get()->map(function($q){
            $q->options = DB::table('options')->where('question_id', $q->id)->orderBy('position')->get();
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
            DB::table('quests')->where('id', $id)->update([
                'title' => $data['title'],
                'updated_at' => now(),
            ]);

            // remove existing questions & options (simple approach)
            $existingQuestions = DB::table('questions')->where('quest_id', $id)->pluck('id')->toArray();
            if (!empty($existingQuestions)) {
                DB::table('options')->whereIn('question_id', $existingQuestions)->delete();
                DB::table('questions')->whereIn('id', $existingQuestions)->delete();
            }

            // insert new questions + options
            if (!empty($data['questions'])) {
                foreach ($data['questions'] as $qi => $q) {
                    $questionId = DB::table('questions')->insertGetId([
                        'quest_id' => $id,
                        'question_text' => $q['text'] ?? '',
                        'position' => $qi,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    if (!empty($q['options']) && is_array($q['options'])) {
                        foreach ($q['options'] as $oi => $opt) {
                            DB::table('options')->insert([
                                'question_id' => $questionId,
                                'option_text' => $opt,
                                'position' => $oi,
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
}
