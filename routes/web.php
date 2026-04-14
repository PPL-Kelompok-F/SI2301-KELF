<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// redirect root
Route::get('/', function () {
    return redirect('/login');
});

// login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {return view('Dashboard');});
    Route::get('/admin/dashboard', function () {return "Dashboard Admin";});
    Route::get('/teacher/dashboard', function () {return "Dashboard Teacher";});
    Route::post('/logout', [AuthController::class, 'logout']);
});
