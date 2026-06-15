<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\StudentAssignmentController;

use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\MaterialController as TeacherMaterialController;
use App\Http\Controllers\Teacher\TeacherAssignmentController;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| STUDENT ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {

    Route::get('/dashboard', [StudentDashboardController::class, 'index']);

    Route::get('/courses', [StudentCourseController::class, 'courses']);

    // Views student
    Route::view('/quiz', 'student.quiz');
    Route::get('/assignments', [StudentAssignmentController::class, 'index'])->name('student.assignments.index');
    Route::get('/assignments/{assignment}', [StudentAssignmentController::class, 'show'])->name('student.assignments.show');
    Route::post('/assignments/{assignment}/submit', [StudentAssignmentController::class, 'storeSubmission'])->name('student.assignments.storeSubmission');
    Route::delete('/assignments/{assignment}/submit', [StudentAssignmentController::class, 'destroySubmission'])->name('student.assignments.destroySubmission');
    Route::view('/forum', 'student.forum');
    Route::view('/qna', 'student.qna');
    Route::view('/report', 'student.report');
    Route::view('/payment', 'student.payment');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile', [ProfileController::class, 'update']);

    // Enroll course
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
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Berhasil ambil course ini');
    });
});

/*
|--------------------------------------------------------------------------
| TEACHER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function () {

    Route::get('/dashboard', [TeacherDashboardController::class, 'index']);

    Route::resource('materials', TeacherMaterialController::class)
        ->except(['show'])
        ->names('teacher.materials');

    Route::get('/assignments', [TeacherAssignmentController::class, 'index'])->name('teacher.assignments.index');
    Route::get('/assignments/create', [TeacherAssignmentController::class, 'create'])->name('teacher.assignments.create');
    Route::post('/assignments', [TeacherAssignmentController::class, 'store'])->name('teacher.assignments.store');
    Route::get('/assignments/{assignment}', [TeacherAssignmentController::class, 'show'])->name('teacher.assignments.show');
    Route::get('/assignments/{assignment}/submissions', [TeacherAssignmentController::class, 'submissions'])->name('teacher.assignments.submissions');
});