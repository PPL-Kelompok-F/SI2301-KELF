@extends('layouts.teacher.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Student Submissions (Grading)</h2>

@if(session('success'))
    <div class="bg-green-200 p-2 mb-3">
        {{ session('success') }}
    </div>
@endif

<table class="w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th>Student</th>
            <th>Assignment</th>
            <th>Status</th>
            <th>Score</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($submissions as $s)
        <tr class="border-b">
            <td>{{ $s->student->name }}</td>
            <td>{{ $s->assignment->title }}</td>
            <td>{{ $s->status }}</td>
            <td>{{ $s->score ?? '-' }}</td>
            <td>
                <a href="{{ url('/teacher/submissions/'.$s->id) }}"
                   class="text-blue-500">
                    Grade
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection