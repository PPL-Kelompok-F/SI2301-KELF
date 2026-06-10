<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
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
