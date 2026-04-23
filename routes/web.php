<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
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


Route::middleware('auth')->group(function () {

    Route::view('/dashboard', 'dashboard');
    Route::view('/courses', 'pages.courses');
    Route::view('/quiz', 'pages.quiz');
    Route::view('/assignment', 'pages.assignment');
    Route::view('/forum', 'pages.forum');
    Route::view('/qna', 'pages.qna');
    Route::view('/report', 'pages.report');
    Route::view('/payment', 'pages.payment');
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile', [ProfileController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});