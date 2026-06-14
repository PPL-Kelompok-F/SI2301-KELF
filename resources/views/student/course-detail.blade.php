@extends('layouts.student.app')

@section('title', $course->title)

@section('content')

<div class="max-w-5xl mx-auto">

    <!-- HEADER -->
    <h1 class="text-2xl font-bold mb-4">{{ $course->title }}</h1>
    <p class="mb-6 text-gray-600">
        {{ $course->description }}
    </p>

    <h2 class="font-bold mb-3">Daftar Lesson</h2>

    @foreach($lessons as $lesson)
        <div class="bg-white p-4 mb-2 rounded shadow">
            <a href="/student/lesson/{{ $lesson->id }}"
            class="font-semibold text-blue-500">
                {{ $lesson->title }}
            </a>
        </div>
    @endforeach

    <!-- LESSON LIST -->

</div>

@endsection

