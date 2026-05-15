<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    // ===============================
    // TAMPILKAN SEMUA KELAS
    // ===============================
    public function index()
    {
        $classrooms = Classroom::latest()->get();

        return view('admin.classrooms.index', compact('classrooms'));
    }

    // ===============================
    // FORM TAMBAH
    // ===============================
    public function create()
    {
        return view('admin.classrooms.create');
    }

    // ===============================
    // SIMPAN DATA
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'teacher' => 'required',
            'description' => 'nullable'
        ]);

        Classroom::create([
            'name' => $request->name,
            'teacher' => $request->teacher,
            'description' => $request->description
        ]);

        return redirect('/admin/classrooms')
            ->with('success', 'Kelas berhasil ditambahkan');
    }

    // ===============================
    // DETAIL KELAS
    // ===============================
    public function show($id)
    {
        $classroom = Classroom::findOrFail($id);

        return view('admin.classrooms.show', compact('classroom'));
    }

    // ===============================
    // FORM EDIT
    // ===============================
    public function edit($id)
    {
        $classroom = Classroom::findOrFail($id);

        return view('admin.classrooms.edit', compact('classroom'));
    }

    // ===============================
    // UPDATE DATA
    // ===============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'teacher' => 'required',
            'description' => 'nullable'
        ]);

        $classroom = Classroom::findOrFail($id);

        $classroom->update([
            'name' => $request->name,
            'teacher' => $request->teacher,
            'description' => $request->description
        ]);

        return redirect('/admin/classrooms')
            ->with('success', 'Kelas berhasil diupdate');
    }

    // ===============================
    // HAPUS DATA
    // ===============================
    public function destroy($id)
    {
        $classroom = Classroom::findOrFail($id);

        $classroom->delete();

        return redirect('/admin/classrooms')
            ->with('success', 'Kelas berhasil dihapus');
    }
}