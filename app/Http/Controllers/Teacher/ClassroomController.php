<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Support\Facades\DB;

class ClassroomController extends Controller
{
    public function index()
    {
        $teacherId = auth()->id();

        $classrooms = Classroom::where('teacher_id', $teacherId)
            ->latest()
            ->get();

        $totalCourses = $classrooms->count();
        $totalAssignments = DB::table('assignments')
            ->where('teacher_id', $teacherId)
            ->count();
        $totalSubmissions = DB::table('submissions')
            ->join('assignments', 'submissions.assignment_id', '=', 'assignments.id')
            ->where('assignments.teacher_id', $teacherId)
            ->count();

        return view('teacher.classrooms.index', compact(
            'classrooms',
            'totalCourses',
            'totalAssignments',
            'totalSubmissions'
        ));
    }
}