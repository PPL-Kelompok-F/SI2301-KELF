<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // ambil semua course (teacher bisa lihat semua)
        $courses = DB::table('courses')->get();

        return view('teacher.dashboard', compact('user', 'courses'));
    }
}