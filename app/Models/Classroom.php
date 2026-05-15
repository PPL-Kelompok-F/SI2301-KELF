<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = [
        'name',
        'teacher',
        'description'
    ];

    // RELASI: classroom punya banyak assignment
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}