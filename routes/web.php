<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;

// ================== REDIRECT ==================
Route::get('/', function () {
    return redirect('/login');
});


// ================== AUTH ==================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); // ✅ TAMBAH INI
Route::post('/login', [AuthController::class, 'login']); // ✅ cukup satu
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');


// ================== SEMUA USER (LOGIN WAJIB) ==================
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::view('/profile', 'pages.profile');

});


// ================== SISWA ==================
Route::middleware(['auth', 'role:siswa'])->group(function () {

    Route::get('/courses', [CourseController::class, 'courses']);
    Route::view('/quiz', 'pages.quiz');
    Route::view('/payment', 'pages.payment');

});


// ================== SISWA & MENTOR ==================
Route::middleware(['auth', 'role:siswa,mentor'])->group(function () {

    Route::view('/assignment', 'pages.assignment');
    Route::view('/forum', 'pages.forum');
    Route::view('/qna', 'pages.qna');

});


// ================== ADMIN ONLY ==================
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/courses', [AdminCourseController::class, 'index']);
    Route::get('/admin/courses/create', [AdminCourseController::class, 'create']);
    Route::post('/admin/courses', [AdminCourseController::class, 'store']);
    Route::get('/admin/courses/{id}/edit', [AdminCourseController::class, 'edit']);
    Route::post('/admin/courses/{id}', [AdminCourseController::class, 'update']);
    Route::delete('/admin/courses/{id}', [AdminCourseController::class, 'destroy']);

    Route::view('/report', 'pages.report');
});


// ================== ENROLL COURSE ==================
Route::post('/courses/enroll', function (Illuminate\Http\Request $request) {

    $userId = Auth::id();

    if (!$userId) {
        return redirect('/login');
    }

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

    return back()->with('success', 'Berhasil ambil course 🚀');
})->middleware('auth'); // ✅ tambah middleware