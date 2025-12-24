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
        Schema::create('mcq_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('record_id')
                ->constrained('records')
                ->cascadeOnDelete()
                ;

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ;

            $table->foreignId('mcq_id')
                ->constrained('mcqs')
                ->cascadeOnDelete()
                ;

            $table->enum('select_answer', ['a', 'b', 'c', 'd']);

            $table->boolean('is_correct')
                ->default(0);


            $table->timestamps();


            $table->index(['record_id', 'is_correct']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mcq_records');
    }
};