<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;

// ================== REDIRECT ==================
Route::get('/', function () {
    return redirect('/login');
});


// ================== AUTH ==================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


// ================== SEMUA USER (LOGIN WAJIB) ==================
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::view('/profile', 'pages.profile');

});


// ================== SISWA ==================
Route::middleware(['auth', 'role:siswa'])->group(function () {

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

});