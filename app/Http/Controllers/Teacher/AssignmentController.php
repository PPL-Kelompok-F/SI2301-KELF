<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::where('teacher_id', auth()->id())
            ->with('classroom')
            ->latest()
            ->get();

        return view('teacher.assignments.index', compact('assignments'));
    }

    public function create()
    {
        $classrooms = Classroom::where('teacher_id', auth()->id())->get();
        return view('teacher.assignments.create', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'title' => 'required|min:3',
            'description' => 'required|min:5',
            'deadline' => 'required|date|after_or_equal:now',
            'file' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:5120'
        ]);

        $fileName = null;

        if ($request->hasFile('file')) {
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('assignments', $fileName, 'public');
        }

        Assignment::create([
            'classroom_id' => $request->classroom_id,
            'teacher_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'file' => $fileName,
            'status' => 'published'
        ]);

        return redirect()->route('teacher.assignments.index')
            ->with('success', 'Assignment created');
    }

    public function show($id)
    {
        $assignment = Assignment::with(['classroom','submissions.student'])
            ->where('teacher_id', auth()->id())
            ->findOrFail($id);

        return view('teacher.assignments.show', compact('assignment'));
    }

    public function edit($id)
    {
        $assignment = Assignment::where('teacher_id', auth()->id())
            ->findOrFail($id);

        $classrooms = Classroom::where('teacher_id', auth()->id())->get();

        return view('teacher.assignments.edit', compact('assignment','classrooms'));
    }

    public function update(Request $request, $id)
    {
        $assignment = Assignment::where('teacher_id', auth()->id())
            ->findOrFail($id);

        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'title' => 'required|min:3',
            'description' => 'required|min:5',
            'deadline' => 'required|date|after_or_equal:now',
            'file' => 'nullable|mimes:pdf,doc,docx,ppt,pptx|max:5120'
        ]);

        $fileName = $assignment->file;

        if ($request->hasFile('file')) {
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('assignments', $fileName, 'public');
        }

        $assignment->update([
            'classroom_id' => $request->classroom_id,
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'file' => $fileName
        ]);

        return redirect()->route('teacher.assignments.index')
            ->with('success', 'Updated');
    }

    public function destroy($id)
    {
        $assignment = Assignment::where('teacher_id', auth()->id())
            ->findOrFail($id);

        if ($assignment->file) {
            Storage::disk('public')->delete('assignments/'.$assignment->file);
        }

        $assignment->delete();

        return back()->with('success', 'Deleted');
    }

    public function close($id)
    {
        $assignment = Assignment::where('teacher_id', auth()->id())
            ->findOrFail($id);

        $assignment->status = 'closed';
        $assignment->save();

        return back()->with('success', 'Closed');
    }

    public function updateStatus($id)
    {
        $assignment = Assignment::where('teacher_id', auth()->id())
            ->findOrFail($id);

        $assignment->status = $assignment->status === 'draft' ? 'published' : 'draft';
        $assignment->save();

        return back();
    }
}