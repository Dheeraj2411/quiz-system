<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\Admin;

class McqSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::where('name', 'admin')->first();

        if (!$admin) {
            $this->command->error('Admin not found. Run AdminSeeder first.');
            return;
        }

        // Category → Quiz → MCQs
        $data = [
            'PHP' => [
                'PHP Basics' => [
                    [
                        'question' => 'What does PHP stand for?',
                        'a' => 'Personal Home Page',
                        'b' => 'Private Home Page',
                        'c' => 'Pre Hypertext Processor',
                        'd' => 'Public Hypertext Processor',
                        'correct_ans' => 'a',
                    ],
                    [
                        'question' => 'Which symbol is used for variables in PHP?',
                        'a' => '#',
                        'b' => '$',
                        'c' => '@',
                        'd' => '&',
                        'correct_ans' => 'b',
                    ],
                    [
                        'question' => 'Which function outputs text in PHP?',
                        'a' => 'print()',
                        'b' => 'echo',
                        'c' => 'write()',
                        'd' => 'display()',
                        'correct_ans' => 'b',
                    ],
                    [
                        'question' => 'Which operator is used for concatenation in PHP?',
                        'a' => '+',
                        'b' => '.',
                        'c' => '&',
                        'd' => '::',
                        'correct_ans' => 'b',
                    ],
                ],
            ],

            'Laravel' => [
                'Laravel Basics' => [
                    [
                        'question' => 'Which file contains web routes?',
                        'a' => 'routes/api.php',
                        'b' => 'routes/web.php',
                        'c' => 'app/routes.php',
                        'd' => 'routes/console.php',
                        'correct_ans' => 'b',
                    ],
                    [
                        'question' => 'Which command creates a model?',
                        'a' => 'php artisan make:model',
                        'b' => 'php artisan model',
                        'c' => 'php artisan new:model',
                        'd' => 'php artisan create:model',
                        'correct_ans' => 'a',
                    ],
                    [
                        'question' => 'Which ORM does Laravel use?',
                        'a' => 'Doctrine',
                        'b' => 'Hibernate',
                        'c' => 'Eloquent',
                        'd' => 'ActiveRecord',
                        'correct_ans' => 'c',
                    ],
                    [
                        'question' => 'Which method retrieves all records?',
                        'a' => 'getAll()',
                        'b' => 'fetch()',
                        'c' => 'all()',
                        'd' => 'select()',
                        'correct_ans' => 'c',
                    ],
                ],
            ],

            'JavaScript' => [
                'JavaScript Basics' => [
                    [
                        'question' => 'Which keyword declares a variable?',
                        'a' => 'var',
                        'b' => 'int',
                        'c' => 'string',
                        'd' => 'define',
                        'correct_ans' => 'a',
                    ],
                    [
                        'question' => 'Which symbol is used for comments?',
                        'a' => '<!-- -->',
                        'b' => '#',
                        'c' => '//',
                        'd' => '**',
                        'correct_ans' => 'c',
                    ],
                    [
                        'question' => 'Which method converts JSON to object?',
                        'a' => 'JSON.parse()',
                        'b' => 'JSON.stringify()',
                        'c' => 'JSON.convert()',
                        'd' => 'JSON.object()',
                        'correct_ans' => 'a',
                    ],
                    [
                        'question' => 'Which company developed JavaScript?',
                        'a' => 'Microsoft',
                        'b' => 'Netscape',
                        'c' => 'Google',
                        'd' => 'Oracle',
                        'correct_ans' => 'b',
                    ],
                ],
            ],

            'MySQL' => [
                'MySQL Fundamentals' => [
                    [
                        'question' => 'Which command retrieves data?',
                        'a' => 'GET',
                        'b' => 'FETCH',
                        'c' => 'SELECT',
                        'd' => 'SHOW',
                        'correct_ans' => 'c',
                    ],
                    [
                        'question' => 'Which clause filters records?',
                        'a' => 'GROUP BY',
                        'b' => 'ORDER BY',
                        'c' => 'WHERE',
                        'd' => 'LIMIT',
                        'correct_ans' => 'c',
                    ],
                    [
                        'question' => 'Which key uniquely identifies a row?',
                        'a' => 'Foreign Key',
                        'b' => 'Primary Key',
                        'c' => 'Index',
                        'd' => 'Composite Key',
                        'correct_ans' => 'b',
                    ],
                ],
            ],
        ];


        foreach ($data as $categoryName => $quizzes) {
            $category = Category::where('name', $categoryName)->first();

            if (!$category) {
                $this->command->warn("Category {$categoryName} not found.");
                continue;
            }

            foreach ($quizzes as $quizName => $mcqs) {
                $quiz = Quiz::where('name', $quizName)
                    ->where('category_id', $category->id)
                    ->first();

                if (!$quiz) {
                    $this->command->warn("Quiz {$quizName} not found.");
                    continue;
                }

                foreach ($mcqs as $mcq) {
                    Mcq::updateOrCreate(
                        [
                            'quiz_id' => $quiz->id,
                            'question' => $mcq['question'],
                        ],
                        [
                            'admin_id' => $admin->id,
                            'a' => $mcq['a'],
                            'b' => $mcq['b'],
                            'c' => $mcq['c'],
                            'd' => $mcq['d'],
                            'correct_ans' => $mcq['correct_ans'],
                        ]
                    );
                }
            }
        }
    }
}
