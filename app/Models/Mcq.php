<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mcq extends Model
{
    function quizzes()
    {
        return $this->BelongsTo(Quiz::class);
    }
}
