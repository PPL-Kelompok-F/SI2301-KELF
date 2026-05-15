<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    public function index()
    {
        $teacherId = auth()->id();

        $classrooms = Classroom::where('teacher_id', $teacherId)
            ->latest()
            ->get();

        return view('teacher.classrooms.index', compact('classrooms'));
    }
}