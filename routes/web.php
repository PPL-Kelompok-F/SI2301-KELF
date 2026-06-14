<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;

// STUDENT
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;
use App\Http\Controllers\Student\MateriController;
use App\Http\Controllers\Student\StreakController;
use App\Http\Controllers\Student\AssignmentController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\QuizController;
use App\Http\Controllers\Student\PaymentController;
use App\Http\Controllers\Student\SettingsController;

// TEACHER
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController;
use App\Http\Controllers\Teacher\ClassroomController as TeacherClassroomController;
use App\Http\Controllers\Teacher\AssignmentController as TeacherAssignmentController;
use App\Http\Controllers\Teacher\GradingController;

// ADMIN
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\UserController;

// AUTH ROUTES
Route::get('/', fn() => redirect('/login'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout']);

// ================= STUDENT =================
Route::middleware('auth')->prefix('student')->group(function () {

    Route::get('/dashboard', [StudentDashboardController::class, 'index']);
    Route::get('/courses', [StudentCourseController::class, 'courses']);
    Route::get('/courses/{id}', [StudentCourseController::class, 'show']);

    // VIDEO MATERI
    Route::get('/courses/{id}/materi', [MateriController::class, 'index']);
    Route::get('/materi/{id}', [MateriController::class, 'show']);

    Route::get('/quiz', [QuizController::class, 'index']);
    Route::get('/quiz/{materi}', [QuizController::class, 'show']);
    Route::post('/quiz/{materi}', [QuizController::class, 'submit']);
    Route::get('/quiz/{materi}/result', [QuizController::class, 'result']);

    Route::view('/report', 'student.report');

    Route::get('/payment', [PaymentController::class, 'index']);
    Route::post('/payment', [PaymentController::class, 'store']);

    Route::get('/profile', [ProfileController::class, 'edit']);
    Route::post('/profile', [ProfileController::class, 'update']);

    Route::get('/settings', [SettingsController::class, 'index']);

    Route::get('/streak', [StreakController::class, 'index']);

    // enroll course
    Route::post('/courses/enroll', function (Request $request) {

        $userId = Auth::id();
        $courseId = $request->course_id;

        $exists = DB::table('enrollments')
            ->where('user_id', $userId)
            ->where('course_id', $courseId)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Kamu sudah mengambil course ini');
        }

        DB::table('enrollments')->insert([
            'user_id' => $userId,
            'course_id' => $courseId,
            'created_at' => now()
        ]);

        return back()->with('success', 'Berhasil ambil course ini');
    });
});

// ================= TEACHER =================
Route::middleware('auth')->prefix('teacher')->group(function () {

    Route::get('/dashboard', [TeacherDashboardController::class, 'index']);

    Route::get('/profile', fn() => view('teacher.profile'));
    Route::get('/settings', fn() => view('teacher.settings'));

    // ASSIGNMENTS
    Route::resource('/assignments', TeacherAssignmentController::class);

    // CLASSROOM
    Route::get('/classrooms', [TeacherClassroomController::class, 'index']);

    // GRADING
    Route::get('/submissions', [GradingController::class, 'index']);
    Route::get('/submissions/{id}', [GradingController::class, 'show']);
    Route::post('/submissions/{id}/grade', [GradingController::class, 'grade']);
});

// ================= ADMIN =================
Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index']);

    Route::get('/classrooms', [ClassroomController::class, 'index']);
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users/{id}/role', [UserController::class, 'updateRole']);
});

// FORUM
Route::middleware('auth')->group(function () {
    Route::get('/forum', [App\Http\Controllers\ForumController::class, 'index']);
    Route::post('/forum', [App\Http\Controllers\ForumController::class, 'store']);
    Route::get('/forum/{id}', [App\Http\Controllers\ForumController::class, 'show']);
    Route::post('/forum/{id}/reply', [App\Http\Controllers\ForumController::class, 'reply']);
});