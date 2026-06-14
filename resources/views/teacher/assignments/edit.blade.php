@extends('layouts.teacher.app')

@section('content')

<h2 class="text-xl font-bold mb-4">
    Edit Assignment
</h2>

@if ($errors->any())

<div class="bg-red-200 p-3 mb-4 rounded">

    <ul class="list-disc ml-5">

        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach

    </ul>

</div>

@endif

@php
    // Use Carbon for consistent formatting.
    $deadlineStart = optional($assignment->deadline_start) ? \Carbon\Carbon::parse($assignment->deadline_start)->timezone('Asia/Jakarta') : null;
    $deadlineEnd = optional($assignment->deadline_end) ? \Carbon\Carbon::parse($assignment->deadline_end)->timezone('Asia/Jakarta') : null;
@endphp

<form method="POST"
      action="{{ route('teacher.assignments.update', $assignment->id) }}"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <!-- CLASS -->
    <div class="mb-3">

        <label class="block font-semibold">
            Class
        </label>

        <select name="classroom_id"
                class="w-full border p-2 rounded">

            @foreach($classrooms as $c)

                <option value="{{ $c->id }}"
                    {{ $assignment->classroom_id == $c->id ? 'selected' : '' }}>

                    {{ $c->name }}

                </option>

            @endforeach

        </select>

    </div>

    <!-- TITLE -->
    <div class="mb-3">

        <label class="block font-semibold">
            Title
        </label>

        <input type="text"
               name="title"
               value="{{ $assignment->title }}"
               class="w-full border p-2 rounded">

    </div>

    <!-- DESCRIPTION -->
    <div class="mb-3">

        <label class="block font-semibold">
            Description
        </label>

        <textarea name="description"
                  class="w-full border p-2 rounded">{{ $assignment->description }}</textarea>

    </div>

    <!-- DEADLINE START -->
    <div class="mb-3">

        <label class="block font-semibold">
            Deadline Start
        </label>

        <input type="datetime-local"
            name="deadline_start"
            value="{{ old('deadline_start', optional($assignment->deadline_start)->format('Y-m-d\TH:i')) }}"
            min="{{ date('Y-m-d\TH:i') }}"
            class="w-full border p-2 rounded">

    </div>

    <!-- DEADLINE END -->
    <div class="mb-3">

        <label class="block font-semibold">
            Deadline End
        </label>

        <input type="datetime-local"
            name="deadline_end"
            value="{{ old('deadline_end', optional($assignment->deadline_end)->format('Y-m-d\TH:i')) }}"
            min="{{ date('Y-m-d\TH:i') }}"
            class="w-full border p-2 rounded">

    </div>

    <!-- FILE -->
    <div class="mb-4">

        <label class="block font-semibold mb-2">
            Replace File
        </label>

        <input type="file"
               name="file"
               class="w-full border p-2 rounded">

        @if($assignment->file)

            <a href="{{ asset('storage/assignments/'.$assignment->file) }}"
               class="text-blue-500 text-sm">

                Download Current File

            </a>

        @endif

    </div>

    <button class="bg-yellow-500 text-white px-4 py-2 rounded">

        Update Assignment

    </button>

</form>

@endsection