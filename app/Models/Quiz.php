<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Quiz extends Model
{


    protected $fillable = [
        'name',
        'category_id',
    ];
    public function mcqs()
    {
        return $this->hasMany(Mcq::class);
    }

    public function categories()
    {
        return $this->BelongsTo(Category::class);
    }
    public function records(){
        return $this->hasMany(Record::class);
    }
}
