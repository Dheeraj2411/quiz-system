<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mcqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')
                ->constrained('quizzes')
                ->cascadeOnDelete();

            $table->foreignId('admin_id')
                ->constrained('admins')
                ->cascadeOnDelete();

            $table->text('question');
            $table->string('a');
            $table->string('b');
            $table->string('c');
            $table->string('d');
            $table->enum('correct_ans', ['a', 'b', 'c', 'd']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcqs');
    }
};
