<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;

class GradingController extends Controller
{
    // LIST SUBMISSIONS (GRADING PAGE)
    public function index()
    {
        $submissions = Submission::with(['student', 'assignment'])
            ->latest()
            ->get();

        return view('teacher.submissions.index', compact('submissions'));
    }

    // DETAIL SUBMISSION
    public function show($id)
    {
        $submission = Submission::with(['student', 'assignment'])
            ->findOrFail($id);

        return view('teacher.submissions.show', compact('submission'));
    }

    // STORE GRADE
    public function grade(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);

        $request->validate([
            'score' => 'required|numeric|min:0|max:100',
            'feedback' => 'required|string|min:3'
        ]);

        $submission->update([
            'score' => $request->score,
            'feedback' => $request->feedback,
            'status' => 'graded'
        ]);

        return redirect()
            ->route('teacher.submissions.index')
            ->with('success', 'Submission graded successfully');
    }
}