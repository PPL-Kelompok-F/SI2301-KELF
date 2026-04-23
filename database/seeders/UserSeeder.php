<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::create([
            'name' => 'Admin LMS',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);

        // TEACHER
        User::create([
            'name' => 'Teacher LMS',
            'email' => 'teacher@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'teacher'
        ]);

        // STUDENT 1
        User::create([
            'name' => 'Student One',
            'email' => 'student1@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'student'
        ]);

        // STUDENT 2
        User::create([
            'name' => 'Student Two',
            'email' => 'student2@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'student'
        ]);
    }
}