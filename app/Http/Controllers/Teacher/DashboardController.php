<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $courses = DB::table('courses')->get();
        $courseCount = $courses->count();
        $materiCount = DB::table('materis')->count();

        return view('teacher.dashboard', compact(
            'user',
            'courses',
            'courseCount',
            'materiCount'
        ));
    }
}