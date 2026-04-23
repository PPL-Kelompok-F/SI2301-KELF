<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // 🔹 TAMPILKAN SEMUA KELAS
    public function index()
    {
        $courses = Course::latest()->get();
        return view('admin.courses.index', compact('courses'));
    }

    // 🔹 FORM TAMBAH
    public function create()
    {
        return view('admin.courses.create');
    }

    // 🔹 SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable'
        ]);

        Course::create($request->all());

        return redirect('/admin/courses')->with('success', 'Kelas berhasil dibuat');
    }

    // 🔹 FORM EDIT
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.edit', compact('course'));
    }

    // 🔹 UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable'
        ]);

        $course = Course::findOrFail($id);
        $course->update($request->all());

        return redirect('/admin/courses')->with('success', 'Kelas berhasil diupdate');
    }

    // 🔹 HAPUS
    public function destroy($id)
    {
        Course::destroy($id);

        return back()->with('success', 'Kelas berhasil dihapus');
    }
}