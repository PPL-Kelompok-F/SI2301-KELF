<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;
use App\Http\Controllers\Student\MateriController;

use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

// redirect root
Route::get('/', function () {
    return redirect('/login');
});

// ================= AUTH =================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout']);


// ================= STUDENT =================
Route::middleware('auth')->prefix('student')->group(function () {

    Route::get('/dashboard', [StudentDashboardController::class, 'index']);
    Route::get('/courses', [StudentCourseController::class, 'courses']);

    // TAMBAHAN (DETAIL COURSE)
    Route::get('/courses/{id}', [StudentCourseController::class, 'show']);

    // VIDEO (FR003)
    Route::get('/courses/{id}/materi', [MateriController::class, 'index']);
    Route::get('/materi/{id}', [MateriController::class, 'show']);

    Route::view('/quiz', 'pages.quiz');
    Route::view('/assignment', 'pages.assignment');
    Route::view('/forum', 'pages.forum');
    Route::view('/qna', 'pages.qna');
    Route::view('/report', 'pages.report');
    Route::view('/payment', 'pages.payment');
    Route::view('/profile', 'pages.profile');

    // enroll course
    Route::post('/courses/enroll', function (Illuminate\Http\Request $request) {

        $userId = auth()->id();
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

    Route::get('/courses/{id}', [StudentCourseController::class, 'show']);

    Route::get('/courses/{id}/materi', [MateriController::class, 'index']);
    Route::get('/courses/{id}/materi/create', [MateriController::class, 'create']);
    Route::post('/courses/{id}/materi/store', [MateriController::class, 'store']);
    Route::get('/materi/{id}/edit', [MateriController::class, 'edit']);
    Route::post('/materi/{id}/update', [MateriController::class, 'update']);
    Route::post('/materi/{id}/delete', [MateriController::class, 'destroy']);

    Route::get('/materi/{id}', [MateriController::class, 'show']);
});


// ================= ADMIN =================
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);
});