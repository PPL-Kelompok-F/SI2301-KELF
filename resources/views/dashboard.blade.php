@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Halo, {{ $user->name }}
</h1>

<!-- STATS -->
<div class="grid grid-cols-3 gap-4 mb-6">

    <div class="bg-white p-4 rounded-xl shadow">
        Streak
        <h2 class="text-2xl font-bold">
            {{ $streak ?? 0 }} Hari
        </h2>
    </div>

    <div class="bg-white p-4 rounded-xl shadow">
        Course
        <h2 class="text-2xl font-bold">
            {{ $courses->count() }}
        </h2>
    </div>

    <div class="bg-white p-4 rounded-xl shadow">
        Avg Score
        <h2 class="text-2xl font-bold">
            {{ round($avgScore ?? 0) }}
        </h2>
    </div>

</div>

<!-- COURSES -->
<h2 class="font-bold mb-3">My Courses</h2>

@if($courses->isEmpty())
    <p class="text-gray-500 mb-4">Belum ambil course</p>
@endif

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

@foreach($courses as $course)
    <div 
        onclick="window.location='/courses/{{ $course->id }}'"
        class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition cursor-pointer">

        <!-- TITLE -->
        <h3 class="font-bold text-lg mb-1">
            {{ $course->title }}
        </h3>

        <!-- DESC -->
        <p class="text-sm text-gray-500 mb-3">
            {{ Str::limit($course->description, 60) }}
        </p>

        <!-- PROGRESS -->
        <div class="mb-2 text-sm">
            Progress: {{ $courseProgress[$course->id] ?? 0 }}%
        </div>

        <div class="w-full bg-gray-200 rounded-full h-2 mb-3">
            <div class="bg-indigo-500 h-2 rounded-full"
                 style="width: {{ $courseProgress[$course->id] ?? 0 }}%">
            </div>
        </div>

        
        <!-- BUTTON -->
        <a href="/courses/{{ $course->id }}"
           class="block text-center bg-indigo-500 text-white py-2 rounded-lg hover:bg-indigo-600">
            Lanjut Belajar
        </a>

    </div>
@endforeach
@endsection