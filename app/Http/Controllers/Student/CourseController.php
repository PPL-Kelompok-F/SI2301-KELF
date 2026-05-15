<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classroom;

class CourseController extends Controller
{
    public function courses()
    {
        $allCourses = Classroom::latest()->get();

        return view('student.courses', compact('allCourses'));
    }
}