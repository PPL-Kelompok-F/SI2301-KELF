@extends('layouts.student.app')

@section('content')

@php
$deadline = \Carbon\Carbon::parse($assignment->deadline)->timezone('Asia/Jakarta');
$isLate = now()->timezone('Asia/Jakarta')->gt($deadline);
@endphp

<h2 class="text-2xl font-bold mb-4">
    Submit Assignment
</h2>

<div class="bg-white p-4 rounded shadow mb-4">

    <h3 class="text-xl font-bold">
        {{ $assignment->title }}
    </h3>

    <p class="mt-2">
        {{ $assignment->description }}
    </p>
    @if($assignment->file)

<div class="mt-3">

    <p class="font-semibold">
        Assignment File:
    </p>

    <a href="{{ asset('storage/assignments/'.$assignment->file) }}"
       target="_blank"
       class="text-blue-500 underline">

    </a>

</div>

@endif

    <p class="mt-2 text-red-500">
        Deadline: {{ $deadline->format('d M Y H:i') }}
    </p>

    <div class="mt-2">

        @if($isLate)
            <span class="bg-red-200 text-red-700 px-2 py-1 rounded">
                CLOSED (Late Submission)
            </span>
        @else
            <span class="bg-green-200 text-green-700 px-2 py-1 rounded">
                OPEN
            </span>
        @endif

    </div>

</div>

@if($errors->any())
    <div class="bg-red-200 p-3 rounded mb-4">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if(session('error'))
    <div class="bg-red-200 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<form method="POST"
      action="/student/submissions/{{ $assignment->id }}"
      enctype="multipart/form-data"
      class="bg-white p-4 rounded shadow">

    @csrf

    <div class="mb-4">
        <label class="block font-bold mb-2">Answer</label>

        <textarea name="answer"
                  class="w-full border p-2 rounded"
                  rows="5"
                  required>{{ old('answer') }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2">Upload File</label>

        <input type="file"
               name="file"
               class="w-full border p-2 rounded">

        <p class="text-sm text-gray-500 mt-1">
            PDF / DOC / DOCX only
        </p>
    </div>

    <button class="bg-green-500 text-white px-4 py-2 rounded">
        Submit Assignment
    </button>

</form>

@endsection