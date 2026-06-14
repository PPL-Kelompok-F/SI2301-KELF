<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Classroom;
use App\Models\User;

class ClassroomController extends Controller
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

    // ===============================
    // LIST CLASSROOM
    // ===============================
    public function index()
    {
        $classrooms = Classroom::with('teacher')
            ->latest()
            ->get();

        return view('admin.classrooms.index', compact('classrooms'));
    }

    // ===============================
    // FORM CREATE
    // ===============================
    public function create()
    {
        $teachers = User::where('role', 'teacher')->get();

        return view('admin.classrooms.create', compact('teachers'));
    }

    // ===============================
    // STORE
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'teacher_id' => 'required|exists:users,id',
            'description' => 'nullable'
        ]);

        Classroom::create([
            'name' => $request->name,
            'teacher_id' => $request->teacher_id,
            'description' => $request->description
        ]);

        return redirect('/admin/classrooms')
            ->with('success', 'Kelas berhasil dibuat');
    }

    // ===============================
    // DETAIL
    // ===============================
    public function show($id)
    {
        $classroom = Classroom::with('teacher')
            ->findOrFail($id);

        return view('admin.classrooms.show', compact('classroom'));
    }

    // ===============================
    // EDIT
    // ===============================
    public function edit($id)
    {
        $classroom = Classroom::findOrFail($id);

        $teachers = User::where('role', 'teacher')->get();

        return view('admin.classrooms.edit', compact(
            'classroom',
            'teachers'
        ));
    }

    // ===============================
    // UPDATE
    // ===============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'teacher_id' => 'required|exists:users,id',
            'description' => 'nullable'
        ]);

        $classroom = Classroom::findOrFail($id);

        $classroom->update([
            'name' => $request->name,
            'teacher_id' => $request->teacher_id,
            'description' => $request->description
        ]);

        return redirect('/admin/classrooms')
            ->with('success', 'Kelas berhasil diupdate');
    }

    // ===============================
    // DELETE
    // ===============================
    public function destroy($id)
    {
        $classroom = Classroom::findOrFail($id);

        $classroom->delete();

        return back()->with('success', 'Kelas berhasil dihapus');
    }
}