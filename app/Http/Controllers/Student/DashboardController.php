<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
=======
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
>>>>>>> c0775043053153af588941b7cef0d7aab53e5f67

class DashboardController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $user = auth()->user();

        // streak
        $streak = DB::table('streaks')
            ->where('user_id', $user->id)
            ->value('streak_count');

        // Course yang diikuti
        $courses = DB::table('enrollments')
            ->join('courses', 'courses.id', '=', 'enrollments.course_id')
            ->where('enrollments.user_id', $user->id)
            ->select('courses.*')
            ->get();

        // score average
        $avgScore = DB::table('quiz_results')
            ->where('user_id', $user->id)
            ->avg('score');

        // Progress per course
        $courseProgress = [];

        foreach ($courses as $course) {

            $totalLessons = DB::table('lessons')
                ->where('course_id', $course->id)
                ->count();

            $completed = DB::table('lesson_progress')
                ->where('user_id', $user->id)
                ->whereIn('lesson_id', function($q) use ($course){
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
        $allCourses = DB::table('courses')->get();
=======
        // ✅ PROTEKSI ROLE (GANTI MIDDLEWARE)
        if (!auth()->check() || auth()->user()->role !== 'student') {
            abort(403);
        }

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

>>>>>>> c0775043053153af588941b7cef0d7aab53e5f67
        return view('student.dashboard', compact(
            'user',
            'streak',
            'courses',
            'avgScore',
            'courseProgress',
            'allCourses'
        ));
<<<<<<< HEAD


    }

}
=======
    }
}
>>>>>>> c0775043053153af588941b7cef0d7aab53e5f67
