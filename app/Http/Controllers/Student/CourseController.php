<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CourseController extends Controller
{
    public function courses()
    {
        // PROTEKSI ROLE
        if (!auth()->check() || auth()->user()->role !== 'student') {
            abort(403);
        }

        $allCourses = Schema::hasTable('courses')
            ? DB::table('courses')->get()
            : collect();

        $materials = Schema::hasTable('materials')
            ? Material::with('teacher')->latest()->get()
            : collect();

        return view('student.courses', compact('allCourses', 'materials'));
    }
}
