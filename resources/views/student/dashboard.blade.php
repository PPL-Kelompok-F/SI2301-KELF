@extends('layouts.student.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Halo, {{ $user->name }}</h1>
    <p class="mt-1 text-gray-600">Lanjutkan belajar dan pantau progres kursus Anda.</p>
</div>

<div class="mb-6 grid gap-4 md:grid-cols-3">
    <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
        <p class="text-sm text-gray-500">Streak</p>
        <h2 class="mt-1 text-2xl font-bold text-gray-800">{{ $streak ?? 0 }} Hari</h2>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
        <p class="text-sm text-gray-500">Course</p>
        <h2 class="mt-1 text-2xl font-bold text-gray-800">{{ $courses->count() }}</h2>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
        <p class="text-sm text-gray-500">Avg Score</p>
        <h2 class="mt-1 text-2xl font-bold text-gray-800">{{ round($avgScore ?? 0) }}</h2>
    </div>
</div>

<div class="mb-4 flex items-center justify-between">
    <h2 class="text-xl font-bold text-gray-800">My Courses</h2>
    <div class="flex gap-2">
        <a href="/student/courses" class="rounded-lg bg-gray-100 px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200">Lihat Semua Course</a>
        <a href="/student/assignments" class="rounded-lg bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700">Lihat Assignment</a>
    </div>
</div>

@if($courses->isEmpty())
    <div class="rounded-2xl border border-dashed border-gray-300 bg-white p-8 text-center text-gray-600">
        Belum ada course yang tersedia saat ini.
    </div>
@else
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @foreach($courses as $course)
            @php
                $courseTitle = $course->title ?? $course->judul ?? 'Course';
                $courseDescription = $course->description ?? $course->deskripsi ?? 'Tidak ada deskripsi.';
                $courseId = $course->id;
                $courseProgressValue = $courseProgress[$courseId] ?? 0;
            @endphp

            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                <h3 class="text-lg font-semibold text-gray-800">{{ $courseTitle }}</h3>
                <p class="mt-2 text-sm leading-6 text-gray-600">{{ \Illuminate\Support\Str::limit($courseDescription, 80) }}</p>

                <div class="mt-4 text-sm text-gray-600">
                    Progress: {{ $courseProgressValue }}%
                </div>

                <div class="mt-2 h-2 w-full rounded-full bg-gray-200">
                    <div class="h-2 rounded-full bg-indigo-500" style="width: {{ $courseProgressValue }}%"></div>
                </div>

                <a href="/student/courses"
                   class="mt-4 block rounded-lg bg-indigo-600 px-4 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-700">
                    Lihat Materi
                </a>
            </div>
        @endforeach
    </div>
@endif
@endsection