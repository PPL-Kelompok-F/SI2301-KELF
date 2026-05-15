<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with('classroom')
            ->latest()
            ->get();

        return view('student.submissions.index', compact('assignments'));
    }

    public function create($id)
    {
        $assignment = Assignment::findOrFail($id);

        return view('student.submissions.create', compact('assignment'));
    }

    public function store(Request $request, $id)
    {
        $assignment = Assignment::findOrFail($id);

        $already = Submission::where('assignment_id', $id)
            ->where('student_id', auth()->id())
            ->first();

        if ($already) {
            return back()->with('error', 'Kamu sudah submit tugas ini');
        }

        $request->validate([
            'answer' => 'required|min:5',
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048'
        ]);

        $fileName = null;

        if ($request->hasFile('file')) {
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();

            $request->file('file')->storeAs(
                'submissions',
                $fileName,
                'public'
            );
        }

        // 🔥 FIX REALTIME TIMEZONE
        $now = now()->timezone('Asia/Jakarta');
        $deadline = \Carbon\Carbon::parse($assignment->deadline)->timezone('Asia/Jakarta');

        $submitStatus = $now->gt($deadline) ? 'late' : 'ontime';

        Submission::create([
            'assignment_id' => $assignment->id,
            'student_id' => auth()->id(),
            'answer' => $request->answer,
            'file' => $fileName,
            'status' => 'submitted',
            'submitted_at' => $now,
            'submit_status' => $submitStatus
        ]);

        return redirect('/student/assignment')
            ->with('success', 'Assignment submitted (' . $submitStatus . ')');
    }
}