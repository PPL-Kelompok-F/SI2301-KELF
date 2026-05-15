<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\ClassroomController as TeacherClassroomController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Teacher\AssignmentController;
use App\Http\Controllers\Student\SubmissionController;
use App\Http\Controllers\Teacher\GradingController;

// ================= ROOT =================
Route::get('/', fn() => redirect('/login'));

// ================= AUTH =================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// ================= STUDENT =================
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {

    Route::get('/dashboard', [StudentDashboardController::class, 'index']);
    Route::get('/courses', [StudentCourseController::class, 'courses']);

    Route::get('/assignment', [SubmissionController::class, 'index']);
    Route::get('/submissions/{id}/create', [SubmissionController::class, 'create']);
    Route::post('/submissions/{id}', [SubmissionController::class, 'store']);

    Route::view('/quiz', 'pages.quiz');
    Route::view('/forum', 'pages.forum');
    Route::view('/qna', 'pages.qna');
    Route::view('/report', 'pages.report');
    Route::view('/payment', 'pages.payment');
    Route::view('/profile', 'pages.profile');
});

// ================= TEACHER =================
Route::middleware(['auth', 'role:teacher'])
    ->prefix('teacher')
    ->group(function () {

        Route::get('/dashboard', [TeacherDashboardController::class, 'index']);

        // ================= ASSIGNMENTS =================
        Route::get('/assignments', [AssignmentController::class, 'index'])
            ->name('teacher.assignments.index');

        Route::get('/assignments/create', [AssignmentController::class, 'create'])
            ->name('teacher.assignments.create');

        Route::post('/assignments', [AssignmentController::class, 'store'])
            ->name('teacher.assignments.store');

        Route::get('/assignments/{id}', [AssignmentController::class, 'show'])
            ->name('teacher.assignments.show');

        Route::get('/assignments/{id}/edit', [AssignmentController::class, 'edit'])
            ->name('teacher.assignments.edit');

        Route::put('/assignments/{id}', [AssignmentController::class, 'update'])
            ->name('teacher.assignments.update');

        Route::delete('/teacher/assignments/{id}', [AssignmentController::class, 'destroy'])
            ->name('teacher.assignments.destroy');

        Route::post('/assignments/{id}/status', [AssignmentController::class, 'updateStatus'])
            ->name('teacher.assignments.status');
        
        Route::post('/teacher/assignments/{id}/close', [AssignmentController::class, 'close'])
            ->name('teacher.assignments.close');

        // ================= CLASSROOM =================
        Route::get('/classrooms', [TeacherClassroomController::class, 'index'])
            ->name('teacher.classrooms');

        // ================= GRADING =================

        Route::get('/submissions', [GradingController::class, 'index'])
            ->name('teacher.submissions.index');

        Route::get('/submissions/{id}', [GradingController::class, 'show'])
            ->name('teacher.submissions.show');

        Route::post('/submissions/{id}/grade', [GradingController::class, 'grade'])
            ->name('teacher.submissions.grade');
    });

// ================= ADMIN =================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/classrooms', [ClassroomController::class, 'index']);
    Route::get('/classrooms/create', [ClassroomController::class, 'create']);
    Route::post('/classrooms/store', [ClassroomController::class, 'store']);
    Route::get('/classrooms/{id}', [ClassroomController::class, 'show']);
    Route::get('/classrooms/{id}/edit', [ClassroomController::class, 'edit']);
    Route::put('/classrooms/{id}/update', [ClassroomController::class, 'update']);
    Route::delete('/classrooms/{id}/delete', [ClassroomController::class, 'destroy']);

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users/{id}/role', [UserController::class, 'updateRole']);
});