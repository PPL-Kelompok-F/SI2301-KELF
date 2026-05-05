@extends('layouts.student.app')

@section('content')

<a href="/student/dashboard"
   class="inline-block mb-4 text-indigo-500 hover:underline">
    ← Kembali ke Dashboard
</a>

<div class="bg-white p-6 rounded-xl shadow">
    <h1 class="text-2xl font-bold mb-3">{{ $course->title }}</h1>

    <p class="text-gray-600 mb-6">
        {{ $course->description }}
    </p>

    <a href="/student/courses/{{ $course->id }}/materi"
       class="bg-indigo-600 text-white px-4 py-2 rounded-lg">
        Tonton Video Pembelajaran
    </a>
</div>

@endsection