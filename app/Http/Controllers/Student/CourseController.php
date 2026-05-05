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

    // detail course teacher + list materi
    public function show($id)
    {
        $course = DB::table('courses')->where('id', $id)->first();

        if (!$course) {
            abort(404);
        }

        $materis = DB::table('materis')
            ->where('course_id', $id)
            ->get();

        if (request()->path() === 'teacher/courses/' . $id) {
            return view('teacher.course.show', compact('course', 'materis'));
        }

        return view('student.course-show', compact('course', 'materis'));
    }
}