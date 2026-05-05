@extends('layouts.student.app')

@section('page-title', 'Detail Course')

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

<div class="bg-white p-6 rounded-xl shadow mb-6">
    <span class="text-sm text-indigo-600 font-semibold">Course</span>

    <h1 class="text-3xl font-bold mt-1 mb-3">
        {{ $course->title }}
    </h1>

    <p class="text-gray-600 mb-6 leading-relaxed">
        {{ $course->description }}
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-indigo-50 p-4 rounded-lg">
            <p class="text-sm text-gray-500">Materi Video</p>
            <h2 class="text-xl font-bold">{{ $materis->count() }}</h2>
        </div>

        <div class="bg-green-50 p-4 rounded-lg">
            <p class="text-sm text-gray-500">Status</p>
            <h2 class="text-xl font-bold">Siap Belajar</h2>
        </div>

        <div class="bg-orange-50 p-4 rounded-lg">
            <p class="text-sm text-gray-500">Level</p>
            <h2 class="text-xl font-bold">Pemula</h2>
        </div>
    </div>

    <a href="/student/courses/{{ $course->id }}/materi"
       class="inline-block bg-indigo-600 text-white px-5 py-3 rounded-lg font-semibold hover:bg-indigo-700">
        Tonton Video Pembelajaran
    </a>
</div>

@endsection