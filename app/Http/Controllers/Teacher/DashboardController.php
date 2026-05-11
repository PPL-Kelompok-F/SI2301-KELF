<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // PROTEKSI ROLE
        if (!auth()->check() || auth()->user()->role !== 'teacher') {
            abort(403);
        }

        return view('teacher.dashboard');
    }
}