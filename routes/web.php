<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// redirect root
Route::get('/', function () {
    return redirect('/login');
});

// login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

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


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/courses', [CourseController::class, 'courses']);
    Route::view('/quiz', 'pages.quiz');
    Route::view('/assignment', 'pages.assignment');
    Route::view('/forum', 'pages.forum');
    Route::view('/qna', 'pages.qna');
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

