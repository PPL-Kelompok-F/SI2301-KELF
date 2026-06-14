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
    // 🔥 FIX: pastiin jadi Carbon biar bisa format jam
    $deadline = \Carbon\Carbon::parse($assignment->deadline)->timezone('Asia/Jakarta');
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

    <!-- DEADLINE (🔥 FIX UTAMA: DATE + JAM) -->
    <div class="mb-3">

        <label class="block font-semibold">
            Deadline (Date & Time)
        </label>

    <input type="datetime-local"
        name="deadline"
        value="{{ \Carbon\Carbon::parse($assignment->deadline)->format('Y-m-d\TH:i') }}"
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