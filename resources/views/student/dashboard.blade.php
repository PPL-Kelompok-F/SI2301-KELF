@extends('layouts.student.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Halo, {{ $user->name }}
</h1>

<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-4 rounded-xl shadow">
        <span class="text-gray-500 text-sm">Streak</span>
        <h2 class="text-2xl font-bold text-orange-500">
            {{ $streak ?? 0 }} Hari 🔥
        </h2>
    </div>

    <div class="bg-white p-4 rounded-xl shadow">
        <span class="text-gray-500 text-sm">Course Diikuti</span>
        <h2 class="text-2xl font-bold text-indigo-600">
            {{ $courses->count() }}
        </h2>
    </div>

    <div class="bg-white p-4 rounded-xl shadow">
        <span class="text-gray-500 text-sm">Rata-rata Skor</span>
        <h2 class="text-2xl font-bold text-green-600">
            {{ round($avgScore ?? 0) }}
        </h2>
    </div>
</div>

<<<<<<< HEAD:resources/views/dashboard.blade.php
<div class="flex justify-between items-center mb-4">
    <h2 class="font-bold text-xl">Kursus Saya</h2>
    <a href="/courses" class="text-indigo-600 text-sm font-semibold">Cari Kursus Lain →</a>
</div>
=======
<h2 class="font-bold mb-3">My Courses</h2>
>>>>>>> main:resources/views/student/dashboard.blade.php

@if($courses->isEmpty())
    <div class="bg-white p-8 rounded-xl shadow text-center">
        <p class="text-gray-500 mb-4">Kamu belum mengambil kursus apapun.</p>
        <a href="/courses" class="bg-indigo-500 text-white px-6 py-2 rounded-lg">Jelajahi Kursus</a>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
@foreach($courses as $course)
<<<<<<< HEAD:resources/views/dashboard.blade.php
    @php
        // Mengambil materi pertama dari course ini untuk tombol "Lanjut Belajar"
        $firstLesson = DB::table('lessons')
            ->where('course_id', $course->id)
            ->orderBy('order_number', 'asc')
            ->first();
    @endphp

    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
        <h3 class="font-bold text-lg mb-1 h-14 overflow-hidden">
            {{ $course->title }}
        </h3>

        <div class="mt-4 mb-1 flex justify-between text-xs font-semibold">
            <span>Progress</span>
            <span>{{ $courseProgress[$course->id] ?? 0 }}%</span>
=======
    <div 
        onclick="window.location='/student/courses/{{ $course->id }}'"
        class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition cursor-pointer">

        <h3 class="font-bold text-lg mb-1">
            {{ $course->title }}
        </h3>

        <p class="text-sm text-gray-500 mb-3">
            {{ \Illuminate\Support\Str::limit($course->description, 60) }}
        </p>

        <div class="mb-2 text-sm">
            Progress: {{ $courseProgress[$course->id] ?? 0 }}%
>>>>>>> main:resources/views/student/dashboard.blade.php
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2 mb-6">
            <div class="bg-indigo-600 h-2 rounded-full transition-all duration-500"
                 style="width: {{ $courseProgress[$course->id] ?? 0 }}%">
            </div>
        </div>

<<<<<<< HEAD:resources/views/dashboard.blade.php
        @if($firstLesson)
            <a href="/lesson/{{ $firstLesson->id }}"
               class="block text-center bg-indigo-600 text-white py-2.5 rounded-lg font-semibold hover:bg-indigo-700 transition">
                Lanjut Belajar
            </a>
        @else
            <button disabled class="w-full bg-gray-300 text-gray-500 py-2.5 rounded-lg cursor-not-allowed">
                Materi Belum Tersedia
            </button>
        @endif
    </div>
@endforeach
=======
        <a href="/student/courses/{{ $course->id }}"
           class="block text-center bg-indigo-500 text-white py-2 rounded-lg hover:bg-indigo-600">
            Lanjut Belajar
        </a>

    </div>
@endforeach

>>>>>>> main:resources/views/student/dashboard.blade.php
</div>

@endsection