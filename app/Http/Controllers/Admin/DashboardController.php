<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->role !== 'admin') {
                abort(403);
            }

            return $next($request);
        });
    }

    public function index()
    {
        $totalClasses = Classroom::count();
        $totalUsers = User::count();
        $totalTeachers = User::where('role', 'teacher')->count();
        $totalStudents = User::where('role', 'student')->count();

        return view('admin.dashboard', compact(
            'totalClasses',
            'totalUsers',
            'totalTeachers',
            'totalStudents'
        ));
    }
}