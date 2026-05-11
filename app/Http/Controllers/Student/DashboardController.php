<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        // PROTEKSI ROLE
        if (!auth()->check() || auth()->user()->role !== 'student') {
            abort(403);
        }

        $user = auth()->user();

        // streak
        $streak = 0;

        if (Schema::hasTable('streaks')) {
            $streak = DB::table('streaks')
                ->where('user_id', $user->id)
                ->value('streak_count') ?? 0;
        }

        // Course yang diikuti
        $courses = collect();

        if (Schema::hasTable('enrollments') && Schema::hasTable('courses')) {
            $courses = DB::table('enrollments')
                ->join('courses', 'courses.id', '=', 'enrollments.course_id')
                ->where('enrollments.user_id', $user->id)
                ->select('courses.*')
                ->get();
        }

        // score average
        $avgScore = 0;

        if (Schema::hasTable('quiz_results')) {
            $avgScore = DB::table('quiz_results')
                ->where('user_id', $user->id)
                ->avg('score') ?? 0;
        }

        // Progress per course
        $courseProgress = [];

        if (Schema::hasTable('lessons') && Schema::hasTable('lesson_progress')) {

            foreach ($courses as $course) {

                $totalLessons = DB::table('lessons')
                    ->where('course_id', $course->id)
                    ->count();

                $completed = DB::table('lesson_progress')
                    ->where('user_id', $user->id)
                    ->whereIn('lesson_id', function ($q) use ($course) {
                        $q->select('id')
                            ->from('lessons')
                            ->where('course_id', $course->id);
                    })
                    ->count();

                $progress = $totalLessons > 0
                    ? round(($completed / $totalLessons) * 100)
                    : 0;

                $courseProgress[$course->id] = $progress;
            }
        }

        $allCourses = Schema::hasTable('courses')
            ? DB::table('courses')->get()
            : collect();

        return view('student.dashboard', compact(
            'user',
            'streak',
            'courses',
            'avgScore',
            'courseProgress',
            'allCourses'
        ));
    }
}