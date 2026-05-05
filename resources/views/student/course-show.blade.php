@extends('layouts.student.app')

@section('content')

@if(session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

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