<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $user = auth()->user();

        // ambil semua course (teacher bisa lihat semua)
        $courses = DB::table('courses')->get();

        return view('teacher.dashboard', compact('user', 'courses'));
=======
        if (!auth()->check() || auth()->user()->role !== 'teacher') {
            abort(403);
        }

        $teacherId = auth()->id();

        $totalCourses = DB::table('courses')
            ->where('teacher_id', $teacherId)
            ->count();

        $totalAssignments = DB::table('assignments')
            ->where('teacher_id', $teacherId)
            ->count();

        $totalSubmissions = DB::table('submissions')
            ->join('assignments', 'submissions.assignment_id', '=', 'assignments.id')
            ->where('assignments.teacher_id', $teacherId)
            ->count();

        $classrooms = DB::table('classrooms')
            ->where('teacher_id', $teacherId)
            ->get();

        return view('teacher.dashboard', compact(
            'totalCourses',
            'totalAssignments',
            'totalSubmissions',
            'classrooms'
        ));
>>>>>>> c5ac5ee8d327e910af4a80620487f5c09657d671
    }
}