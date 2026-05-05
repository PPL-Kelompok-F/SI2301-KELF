<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function courses()
    {
        $allCourses = DB::table('courses')->get();

        return view('student.courses', compact('allCourses'));
    }
}