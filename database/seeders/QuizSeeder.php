<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Category;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        // Map categories to quizzes
        $data = [
            'PHP' => [
                'PHP Basics',
                'Advanced PHP',
            ],
            'Laravel' => [
                'Laravel Basics',
                'Laravel Eloquent',
                'Laravel Middleware',
            ],
            'JavaScript' => [
                'JavaScript Basics',
                'ES6 Concepts',
            ],
            'MySQL' => [
                'MySQL Fundamentals',
                'MySQL Joins',
            ],
            'HTML & CSS' => [
                'HTML Basics',
                'CSS Flexbox',
            ],
        ];

        foreach ($data as $categoryName => $quizzes) {
            $category = Category::where('name', $categoryName)->first();

            if (!$category) {
                $this->command->warn("Category {$categoryName} not found. Skipping...");
                continue;
            }

            foreach ($quizzes as $quizName) {
                Quiz::updateOrCreate(
                    [
                        'name' => $quizName,
                        'category_id' => $category->id,
                    ],
                    []
                );
            }
        }
    }
}
