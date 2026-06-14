<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classroom;

class CourseController extends Controller
{
    public function index()
    {
        $teacherId = auth()->id();

        if (!$teacherId) {
            abort(403, 'Unauthorized');
        }

        $courses = Classroom::where('teacher_id', $teacherId)
            ->latest()
            ->get();

        return view('teacher.courses.index', compact('courses'));
    }
}