<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;
use App\Http\Controllers\Student\StreakController;
use App\Http\Controllers\Student\AssignmentController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\QuizController;
use App\Http\Controllers\Student\PaymentController;
use App\Http\Controllers\Student\SettingsController;

use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController;
use App\Http\Controllers\Teacher\ClassroomController as TeacherClassroomController;
use App\Http\Controllers\Teacher\AssignmentController as TeacherAssignmentController;
use App\Http\Controllers\Teacher\GradingController;


use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\UserController;


// redirect root
Route::get('/', function () {
    return redirect('/login');
});

// login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// register
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

// logout
Route::post('/logout', [AuthController::class, 'logout']);

// admin-only login
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');

//Route per role

Route::middleware('auth')->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index']);
    Route::get('/courses', [StudentCourseController::class, 'courses']);
    Route::get('/courses/{id}', [StudentCourseController::class, 'show']);

    Route::get('/quiz', [QuizController::class, 'index'])->name('student.quiz');
    Route::get('/quiz/{materi}', [QuizController::class, 'show'])->name('student.quiz.show');
    Route::post('/quiz/{materi}', [QuizController::class, 'submit'])->name('student.quiz.submit');
    Route::get('/quiz/{materi}/result', [QuizController::class, 'result'])->name('student.quiz.result');

    Route::get('/assignment', [QuizController::class, 'index'])->name('student.assignment');
    Route::view('/report', 'student.report')->name('student.report');

    Route::get('/payment', [PaymentController::class, 'index'])->name('student.payment');
    Route::post('/payment', [PaymentController::class, 'store'])->name('student.payment.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('student.profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('student.profile.update');

    Route::get('/settings', [SettingsController::class, 'index'])->name('student.settings');

    Route::get('/streak', [StreakController::class, 'index']);

    //Untuk enroll course

    Route::post('/courses/enroll', function (Illuminate\Http\Request $request) {

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

Route::middleware('auth')->prefix('teacher')->group(function () {
    Route::get('/dashboard', [TeacherDashboardController::class, 'index']);

    // Simple teacher profile and settings pages
    Route::view('/profile', 'teacher.profile')->name('teacher.profile');
    Route::view('/settings', 'teacher.settings')->name('teacher.settings');

    // ================= ASSIGNMENTS =================
    Route::get('/assignments', [TeacherAssignmentController::class, 'index'])
        ->name('teacher.assignments.index');

    Route::get('/assignments/create', [TeacherAssignmentController::class, 'create'])
        ->name('teacher.assignments.create');

    Route::post('/assignments', [TeacherAssignmentController::class, 'store'])
        ->name('teacher.assignments.store');

    Route::get('/assignments/{id}', [TeacherAssignmentController::class, 'show'])
        ->name('teacher.assignments.show');

    Route::get('/assignments/{id}/edit', [TeacherAssignmentController::class, 'edit'])
        ->name('teacher.assignments.edit');

    Route::put('/assignments/{id}', [TeacherAssignmentController::class, 'update'])
        ->name('teacher.assignments.update');

    Route::delete('/assignments/{id}', [TeacherAssignmentController::class, 'destroy'])
        ->name('teacher.assignments.destroy');

    Route::post('/assignments/{id}/status', [TeacherAssignmentController::class, 'updateStatus'])
        ->name('teacher.assignments.status');

    Route::post('/assignments/{id}/close', [TeacherAssignmentController::class, 'close'])
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

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);
    // Tambahkan route lain untuk admin di sini
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

Route::middleware('auth')->group(function () {
    Route::get('/forum', [App\Http\Controllers\ForumController::class, 'index'])->name('forum.index');
    Route::post('/forum', [App\Http\Controllers\ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{id}', [App\Http\Controllers\ForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{id}/reply', [App\Http\Controllers\ForumController::class, 'reply'])->name('forum.reply');
});
