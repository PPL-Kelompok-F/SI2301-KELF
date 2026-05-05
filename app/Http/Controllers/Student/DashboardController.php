<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $streak = 0;
        if (Schema::hasTable('streaks')) {
            $streak = DB::table('streaks')
                ->where('user_id', $user->id)
                ->value('streak_count') ?? 0;
        }

        $courses = collect();
        if (Schema::hasTable('enrollments') && Schema::hasTable('courses')) {
            $courses = DB::table('enrollments')
                ->join('courses', 'courses.id', '=', 'enrollments.course_id')
                ->where('enrollments.user_id', $user->id)
                ->select('courses.*')
                ->get();
        }

        $avgScore = 0;
        if (Schema::hasTable('quiz_results')) {
            $avgScore = DB::table('quiz_results')
                ->where('user_id', $user->id)
                ->avg('score') ?? 0;
        }

        $courseProgress = [];

        return view('student.dashboard', compact(
            'user',
            'streak',
            'courses',
            'avgScore',
            'courseProgress'
        ));
    }
}