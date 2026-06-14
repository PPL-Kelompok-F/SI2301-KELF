<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function show($id)
    {
        $course = DB::table('courses')->where('id', $id)->first();

        if (!$course) {
            abort(404); // kalau ID gak ada
        }

        $lessons = DB::table('lessons')
            ->where('course_id', $id)
            ->get();

        return view('student.course-detail', compact('course', 'lessons'));
    }
    
    public function courses()
    {
        $allCourses = DB::table('courses')->get();

        return view('student.courses', compact('allCourses'));
    }
    
    
}