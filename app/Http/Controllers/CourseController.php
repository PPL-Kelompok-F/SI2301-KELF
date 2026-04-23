<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CourseController extends Controller
{
    public function courses()
    {
        $allCourses = DB::table('courses')->get();

        return view('pages.courses', compact('allCourses'));
    }
}
