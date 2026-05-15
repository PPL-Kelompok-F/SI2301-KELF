<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // ================= TEACHER =================
        // Teacher untuk testing/demo
        User::firstOrCreate(
            ['email' => 'teacher@gmail.com'],
            [
                'name' => 'Teacher LMS',
                'password' => Hash::make('123456'),
                'role' => 'teacher',
            ]
        );


        // ================= STUDENT 1 =================
        User::firstOrCreate(
            ['email' => 'student1@gmail.com'],
            [
                'name' => 'Student One',
                'password' => Hash::make('123456'),
                'role' => 'student',
            ]
        );


        // ================= STUDENT 2 =================
        User::firstOrCreate(
            ['email' => 'student2@gmail.com'],
            [
                'name' => 'Student Two',
                'password' => Hash::make('123456'),
                'role' => 'student',
            ]
        );
    }
}