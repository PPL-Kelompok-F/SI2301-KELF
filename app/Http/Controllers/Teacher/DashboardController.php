<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Submission;

class DashboardController extends Controller
{
    public function index()
    {
        if (!auth()->check() || auth()->user()->role !== 'teacher') {
            abort(403);
        }

        $teacherId = auth()->id();

        // classroom milik teacher login
        $classrooms = Classroom::where('teacher_id', $teacherId)->get();

        // total classroom
        $totalCourses = $classrooms->count();

        // assignment teacher login
        $totalAssignments = Assignment::where('teacher_id', $teacherId)->count();

        // total submission
        $totalSubmissions = Submission::whereHas('assignment', function ($query) use ($teacherId) {

            $query->where('teacher_id', $teacherId);

        })->count();

        return view('teacher.dashboard', compact(
            'totalCourses',
            'totalAssignments',
            'totalSubmissions',
            'classrooms'
        ));
    }
}