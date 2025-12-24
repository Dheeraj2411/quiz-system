<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\returnValue;

class Record extends Model
{
    function scopeWithQuiz($query){
     return $query->join('quizzes','records.quiz_id','=', 'quizzes.id')->select('quizzes.*','records.*');
    }
}
