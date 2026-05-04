@extends('layouts.teacher.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Halo Teacher, {{ $user->name }}
</h1>

<div class="grid grid-cols-3 gap-4 mb-6">

    <!-- <div class="bg-white p-4 rounded-xl shadow">
        Streak
        <h2 class="text-2xl font-bold">
            {{ $streak ?? 0 }} Hari
        </h2>
    </div> -->

    <div class="bg-white p-4 rounded-xl shadow">
        Course
        <h2 class="text-2xl font-bold">
            {{ $courses->count() }}
        </h2>
    </div>
<!-- 
    <div class="bg-white p-4 rounded-xl shadow">
        Avg Score
        <h2 class="text-2xl font-bold">
            {{ round($avgScore ?? 0) }}
        </h2>
    </div> -->

</div>

<h2 class="font-bold mb-3">All Courses</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

@foreach($courses as $course)
    <div class="bg-white p-4 rounded-xl shadow">

        <h3 class="font-bold text-lg mb-1">
            {{ $course->title }}
        </h3>

        <p class="text-sm text-gray-500 mb-3">
            {{ \Illuminate\Support\Str::limit($course->description, 60) }}
        </p>

        <a href="/teacher/courses/{{ $course->id }}"
           class="block text-center bg-indigo-500 text-white py-2 rounded-lg">
            Lihat Course
        </a>

    </div>
@endforeach

</div>

</div>

@endsection