@extends('layouts.student.app')
@foreach($allCourses as $course)

@php
    $isEnrolled = DB::table('enrollments')
        ->where('user_id', auth()->id())
        ->where('course_id', $course->id)
        ->exists();
@endphp

<div class="bg-white p-4 rounded-xl shadow">

    <h3 class="font-bold">{{ $course->title }}</h3>

    <p class="text-sm text-gray-500 mb-3">
        {{ Str::limit($course->description, 60) }}
    </p>

    <div class="flex gap-2">

        <!-- DETAIL -->
        <a href="student/courses/{{ $course->id }}"
           class="flex-1 text-center bg-gray-200 py-2 rounded-lg">
            Detail
        </a>

        <!-- BUTTON -->
        @if($isEnrolled)
            <button disabled
                class="flex-1 bg-gray-400 text-white py-2 rounded-lg cursor-not-allowed">
                Sudah Diambil
            </button>
        @else
            <form method="POST" action="/student/courses/enroll" class="flex-1">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">

                <button class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">
                    Ambil
                </button>
            </form>
        @endif

    </div>

</div>
@endforeach