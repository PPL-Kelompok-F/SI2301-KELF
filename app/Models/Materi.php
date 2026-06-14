<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar'
    ];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}