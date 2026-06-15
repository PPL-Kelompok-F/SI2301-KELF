<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StudentAssignmentController extends Controller
{
    public function index(): View
    {
        $this->ensureStudent();

        $assignments = Assignment::with('teacher')
            ->latest()
            ->get();

        foreach ($assignments as $assignment) {
            $assignment->my_submission = $assignment->submissionForUser(Auth::id());
        }

        return view('student.assignments.index', compact('assignments'));
    }

    public function show(Assignment $assignment): View
    {
        $this->ensureStudent();

        $assignment->load('teacher');
        $submission = $assignment->submissionForUser(Auth::id());

        return view('student.assignments.show', compact('assignment', 'submission'));
    }

    public function submit(Assignment $assignment): View
    {
        $this->ensureStudent();

        $submission = $assignment->submissionForUser(Auth::id());

        return view('student.assignments.show', compact('assignment', 'submission'));
    }

    public function storeSubmission(Request $request, Assignment $assignment): RedirectResponse
    {
        $this->ensureStudent();

        $validated = $request->validate([
            'file' => ['required', 'file', 'max:20480'],
        ]);

        $path = $request->file('file')->store('submissions', 'public');

        $submission = AssignmentSubmission::where('assignment_id', $assignment->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($submission) {
            $submission->update([
                'file' => $path,
                'status' => 'submitted',
            ]);
        } else {
            AssignmentSubmission::create([
                'assignment_id' => $assignment->id,
                'user_id' => Auth::id(),
                'file' => $path,
                'status' => 'submitted',
            ]);
        }

        return redirect()->route('student.assignments.show', $assignment)->with('success', 'Submission berhasil diperbarui.');
    }

    public function destroySubmission(Assignment $assignment): RedirectResponse
    {
        $this->ensureStudent();

        $submission = AssignmentSubmission::where('assignment_id', $assignment->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($submission) {
            $submission->delete();
        }

        return redirect()->route('student.assignments.show', $assignment)->with('success', 'Submission berhasil dihapus.');
    }

    private function ensureStudent(): void
    {
        if (!Auth::check() || Auth::user()->role !== 'student') {
            abort(403);
        }
    }
}
