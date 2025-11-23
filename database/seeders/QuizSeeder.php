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
            'title' => 'Cisco',
            'description' => 'Cisco Packet Tracer',
            'difficulty' => 'Sulit',
            'created_by' => null, // nullable foreign key; leave null if no user exists
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Example Questions and Options
        $questions = [
            [
                'question_text' => 'Apa yang IOT?',
                'points' => 5,
                'options' => [
                    ['option_text' => 'PC', 'is_correct' => false],
                    ['option_text' => 'Lampu', 'is_correct' => true],
                    ['option_text' => 'Server', 'is_correct' => false],
                    ['option_text' => 'Router', 'is_correct' => false],
                ],
            ],
            [
                'question_text' => 'Berapa 5 x 5?',
                'points' => 3,
                'options' => [
                    ['option_text' => '20', 'is_correct' => false],
                    ['option_text' => '45', 'is_correct' => false],
                    ['option_text' => '15', 'is_correct' => false],
                    ['option_text' => '25', 'is_correct' => true],
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
