<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\CourseController;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// ================== REDIRECT ==================
Route::get('/', function () {
    return redirect('/login');
});


// ================== AUTH ==================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// // dashboard
// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', function () {return view('Dashboard');});
//     Route::get('/admin/dashboard', function () {return "Dashboard Admin";});
//     Route::get('/teacher/dashboard', function () {return "Dashboard Teacher";});
//     Route::post('/logout', [AuthController::class, 'logout']);
// });
//Sign in
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout']);


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

    Route::view('/courses', 'pages.courses');
    Route::view('/assignment', 'pages.assignment');
    Route::view('/forum', 'pages.forum');
    Route::view('/qna', 'pages.qna');

});


// ================== ADMIN ONLY ==================
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/courses', [CourseController::class, 'index']);
    Route::get('/admin/courses/create', [CourseController::class, 'create']);
    Route::post('/admin/courses', [CourseController::class, 'store']);
    Route::get('/admin/courses/{id}/edit', [CourseController::class, 'edit']);
    Route::post('/admin/courses/{id}', [CourseController::class, 'update']);
    Route::delete('/admin/courses/{id}', [CourseController::class, 'destroy']);
    Route::view('/report', 'pages.report');
    Route::view('/payment', 'pages.payment');
    Route::view('/profile', 'pages.profile');
    

});

use Illuminate\Support\Facades\DB;

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

    return back()->with('success', 'Berhasil ambil course 🚀');
});

