<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // =========================
    // ROLE CHECK
    // =========================
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    // ================= RELATION =================

    // classroom milik teacher
    public function classrooms()
    {
        return $this->hasMany(Classroom::class, 'teacher_id');
    }

    // assignment milik teacher
    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'teacher_id');
    }

    // submission milik student
    public function submissions()
    {
        return $this->hasMany(Submission::class, 'student_id');
    }
}