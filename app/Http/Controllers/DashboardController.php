<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $courses = DB::table('enrollments')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->where('enrollments.user_id', $user->id)
            ->select('courses.*', 'enrollments.progress')
            ->get();

        $streak = DB::table('streaks')
            ->where('user_id', $user->id)
            ->value('streak_count');

        $report = DB::table('reports')
            ->where('user_id', $user->id)
            ->first();

        return view('dashboard', compact('user', 'courses', 'streak', 'report'));
    }
}