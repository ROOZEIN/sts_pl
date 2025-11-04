<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example Quiz
        $quizId = DB::table('quizzes')->insertGetId([
            'title' => 'Sample Quiz',
            'description' => 'This is a sample quiz description.',
            'difficulty' => 'Easy',
            'created_by' => 1, // Ensure user ID 1 exists
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Example Questions and Options
        $questions = [
            [
                'question_text' => 'What is the capital of France?',
                'points' => 5,
                'options' => [
                    ['option_text' => 'Berlin', 'is_correct' => false],
                    ['option_text' => 'Madrid', 'is_correct' => false],
                    ['option_text' => 'Paris', 'is_correct' => true],
                    ['option_text' => 'Rome', 'is_correct' => false],
                ],
            ],
            [
                'question_text' => 'What is 2 + 2?',
                'points' => 3,
                'options' => [
                    ['option_text' => '3', 'is_correct' => false],
                    ['option_text' => '4', 'is_correct' => true],
                    ['option_text' => '5', 'is_correct' => false],
                    ['option_text' => '6', 'is_correct' => false],
                ],
            ],
        ];

        foreach ($questions as $questionData) {
            $questionId = DB::table('questions')->insertGetId([
                'quiz_id' => $quizId,
                'question_text' => $questionData['question_text'],
                'points' => $questionData['points'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($questionData['options'] as $optionData) {
                DB::table('options')->insert([
                    'question_id' => $questionId,
                    'option_text' => $optionData['option_text'],
                    'is_correct' => $optionData['is_correct'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
