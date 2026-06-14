<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'materi_id',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    public function results()
    {
        return $this->hasMany(QuizResult::class);
    }
}