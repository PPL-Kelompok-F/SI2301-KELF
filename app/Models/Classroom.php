<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = [
        'name',
        'teacher_id',
        'description'
    ];

    // ===============================
    // RELASI KE TEACHER
    // ===============================
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // ===============================
    // RELASI ASSIGNMENTS
    // ===============================
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}