@extends('layouts.teacher.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Grade Submission</h2>

<div class="bg-white p-4 rounded shadow mb-4">

    <p><b>Student:</b> {{ $submission->student->name }}</p>
    <p><b>Assignment:</b> {{ $submission->assignment->title }}</p>

    <p class="mt-3 font-bold">Answer:</p>
    <p class="bg-gray-100 p-3 rounded">{{ $submission->answer }}</p>

    @if($submission->file)
        <p class="mt-3">
            <a href="{{ asset('storage/submissions/'.$submission->file) }}"
               class="text-blue-500 underline">
               Download File
            </a>
        </p>
    @endif

</div>

<form method="POST" action="{{ url('/teacher/submissions/'.$submission->id.'/grade') }}" class="bg-white p-4 rounded shadow">
    @csrf

    <div class="mb-4">
        <label class="block font-bold mb-1">Score (0 - 100)</label>
        <input type="number"
               name="score"
               class="w-full border p-2 rounded"
               required>
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-1">Feedback</label>
        <textarea name="feedback"
                  class="w-full border p-2 rounded"
                  required></textarea>
    </div>

    <button class="bg-green-500 text-white px-4 py-2 rounded">
        Submit Grade
    </button>

</form>

@endsection

<script>
setInterval(() => {
    location.reload();
}, 60000);
</script>