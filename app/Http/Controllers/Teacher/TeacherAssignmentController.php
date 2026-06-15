<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TeacherAssignmentController extends Controller
{
    public function index(): View
    {
        $this->ensureTeacher();

        $assignments = Assignment::with('teacher', 'submissions.student')
            ->where('teacher_id', Auth::id())
            ->latest()
            ->get();

        return view('teacher.assignments.index', compact('assignments'));
    }

    public function create(): View
    {
        $this->ensureTeacher();

        return view('teacher.assignments.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->ensureTeacher();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'deadline' => ['required', 'date'],
            'file' => ['nullable', 'file', 'max:20480'],
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'deadline' => $validated['deadline'],
            'teacher_id' => Auth::id(),
        ];

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('assignments', 'public');
        }

        Assignment::create($data);

        return redirect()->route('teacher.assignments.index')->with('success', 'Assignment berhasil dibuat.');
    }

    public function show(Assignment $assignment): View
    {
        $this->ensureTeacher();

        abort_unless((int) $assignment->teacher_id === (int) Auth::id(), 403);

        $assignment->load('submissions.student');

        return view('teacher.assignments.show', compact('assignment'));
    }

    public function submissions(Assignment $assignment): View
    {
        $this->ensureTeacher();

        abort_unless((int) $assignment->teacher_id === (int) Auth::id(), 403);

        $assignment->load('submissions.student');

        return view('teacher.assignments.show', compact('assignment'));
    }

    private function ensureTeacher(): void
    {
        if (!Auth::check() || Auth::user()->role !== 'teacher') {
            abort(403);
        }
    }
}
