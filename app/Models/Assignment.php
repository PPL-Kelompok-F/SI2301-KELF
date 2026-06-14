<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'classroom_id',
        'teacher_id',
        'title',
        'description',
        'deadline_start',
        'deadline_end',
        'file',
        'status'
    ];

    protected $casts = [
        'deadline_start' => 'datetime',
        'deadline_end' => 'datetime',
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'assignment_id');
    }
}