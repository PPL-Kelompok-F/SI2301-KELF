@extends('layouts.teacher.app')

@section('content')

@php
    $deadlineStart = \Carbon\Carbon::parse($assignment->deadline_start);
    $deadlineEnd = \Carbon\Carbon::parse($assignment->deadline_end);
    $isClosed = now()->greaterThan($deadlineEnd);
@endphp

<h2 class="text-2xl font-bold mb-4">
    {{ $assignment->title }}
</h2>

<div class="bg-white p-4 rounded shadow mb-5">

    <p>{{ $assignment->description }}</p>

    <p class="text-sm text-gray-500 mt-2">
        Starts: {{ $deadlineStart->format('d M Y H:i') }}
    </p>
    <p class="text-sm text-gray-500 mt-2">
        Starts: {{ $deadlineStart->format('d M Y H:i') }}
    </p>
    <p class="text-sm text-gray-500 mt-2">
        Ends: {{ $deadlineEnd->format('d M Y H:i') }}
    </p>

    @if($assignment->file)

<div class="mt-3">

    <p class="font-semibold">
        Assignment File:
    </p>

    <a href="{{ asset('storage/assignments/'.$assignment->file) }}"
       target="_blank"
       class="text-blue-500 underline">

        📄 Download / View File

    </a>

</div>

@endif

    <div class="mt-2">
        @if($isClosed)
            <span class="bg-red-200 text-red-700 px-2 py-1 rounded">CLOSED</span>
        @else
            <span class="bg-green-200 text-green-700 px-2 py-1 rounded">ACTIVE</span>
        @endif
    </div>

</div>

<h3 class="text-xl font-bold mb-3">Submissions</h3>

<table class="w-full border">

    <thead>
        <tr class="bg-gray-200">
            <th class="border p-2">Student</th>
            <th class="border p-2">Submitted At</th>
            <th class="border p-2">Status</th>
            <th class="border p-2">Score</th>
            <th class="border p-2">Action</th>
        </tr>
    </thead>

    <tbody>

        @forelse($assignment->submissions as $submission)

        @php
        $submittedAt = \Carbon\Carbon::parse($submission->submitted_at)->timezone('Asia/Jakarta');
        $isLate = $submittedAt->gt($deadlineEnd);

        <tr>
            <td class="border p-2">{{ $submission->student->name }}</td>
            <td class="border p-2">{{ $submittedAt->format('d M Y H:i') }}</td>

            <td class="border p-2">
                @if($isLate)
                    <span class="bg-red-200 text-red-700 px-2 py-1 rounded">LATE</span>
                @else
                    <span class="bg-green-200 text-green-700 px-2 py-1 rounded">ON TIME</span>
                @endif
            </td>

            <td class="border p-2">{{ $submission->score ?? '-' }}</td>

            <td class="border p-2">
                <a href="{{ route('teacher.submissions.show',$submission->id) }}"
                   class="bg-blue-500 text-white px-3 py-1 rounded">
                    Grade
                </a>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="5" class="text-center p-4 text-gray-500">No submissions</td>
        </tr>
        @endforelse

    </tbody>

</table>

@endsection