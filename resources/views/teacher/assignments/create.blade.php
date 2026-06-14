@extends('layouts.teacher.app')

@section('content')

<h2 class="text-xl font-bold mb-4">Create Assignment</h2>

@if ($errors->any())
    <div class="bg-red-200 p-3 mb-4 rounded">
        <ul class="list-disc ml-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST"
      action="{{ route('teacher.assignments.store') }}"
      enctype="multipart/form-data">

    @csrf

    {{-- CLASSROOM --}}
    <select name="classroom_id" class="w-full border p-2 mb-2">
        <option value="">-- Select Class --</option>
        @foreach($classrooms as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
        @endforeach
    </select>

    {{-- TITLE --}}
    <input type="text"
           name="title"
           class="w-full border p-2 mb-2"
           placeholder="Title">

    {{-- DESCRIPTION --}}
    <textarea name="description"
              class="w-full border p-2 mb-2"
              placeholder="Description"></textarea>

    {{-- DEADLINE START --}}
    <label class="text-sm">Deadline Start</label>
    <input type="datetime-local"
           name="deadline_start"
           value="{{ old('deadline_start') }}"
           min="{{ date('Y-m-d\TH:i') }}"
           class="w-full border p-2 mb-2">

    {{-- DEADLINE END --}}
    <label class="text-sm">Deadline End</label>
    <input type="datetime-local"
           name="deadline_end"
           value="{{ old('deadline_end') }}"
           min="{{ date('Y-m-d\TH:i') }}"
           class="w-full border p-2 mb-2">

    {{-- FILE --}}
    <input type="file"
           name="file"
           class="w-full border p-2 mb-2">

    <button class="bg-green-500 text-white px-4 py-2 rounded">
        Save Assignment
    </button>

</form>

@endsection