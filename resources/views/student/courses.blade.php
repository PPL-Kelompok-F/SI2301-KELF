@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Available Courses
</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

@foreach($allCourses as $course)
    <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">

        <!-- TITLE -->
        <h3 class="font-bold text-lg mb-1">
            {{ $course->title }}
        </h3>

        <!-- DESC -->
        <p class="text-sm text-gray-500 mb-3">
            {{ Str::limit($course->description, 60) }}
        </p>

        <!-- BUTTON GROUP -->
        <div class="flex gap-2">

            <!-- DETAIL -->
            <a href="/courses/{{ $course->id }}"
               class="flex-1 text-center bg-gray-200 py-2 rounded-lg hover:bg-gray-300">
                Detail
            </a>

            <!-- ENROLL -->
            <form method="POST" action="/courses/enroll" class="flex-1">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">

                <button class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">
                    Ambil
                </button>
            </form>

        </div>

    </div>
@endforeach

</div>

@endsection