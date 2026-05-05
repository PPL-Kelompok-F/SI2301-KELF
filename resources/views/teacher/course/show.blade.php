@extends('layouts.teacher.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">
    {{ $course->title }}
</h1>

<p class="mb-6 text-gray-600">
    {{ $course->description }}
</p>

<a href="/teacher/courses/{{ $course->id }}/materi"
   class="bg-indigo-500 text-white px-4 py-2 rounded-lg">
    Lihat Video Pembelajaran
</a>

@endsection