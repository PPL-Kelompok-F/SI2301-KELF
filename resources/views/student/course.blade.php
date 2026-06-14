@extends('layouts.student.app')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-2" style="font-family:'Sora',sans-serif;">
            Kursus Tersedia
        </h1>
        <p class="text-sm text-gray-500 max-w-2xl">
            Jelajahi course terbaik dan mulai belajar hari ini. Klik detail untuk melihat materi lengkap atau ambil jika kamu belum mendaftar.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach($allCourses as $course)
            @php
                $isEnrolled = DB::table('enrollments')
                    ->where('user_id', auth()->id())
                    ->where('course_id', $course->id)
                    ->exists();
            @endphp

            <div class="group overflow-hidden rounded-[28px] border border-gray-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
                <div class="h-1.5 bg-gradient-to-r from-indigo-400 to-indigo-600"></div>
                <div class="p-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-indigo-500 mb-3">
                        Course
                    </p>
                    <h3 class="text-xl font-extrabold text-gray-900 mb-3" style="font-family:'Sora',sans-serif;">
                        {{ $course->title }}
                    </h3>
                    <p class="text-sm text-gray-500 leading-6 mb-6">
                        {{ Str::limit($course->description, 100) }}
                    </p>

                    <div class="space-y-3">
                        <a href="/student/courses/{{ $course->id }}"
                           class="inline-flex w-full items-center justify-center rounded-2xl border border-indigo-100 bg-indigo-50 px-4 py-3 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-100">
                            Detail
                        </a>

                        @if($isEnrolled)
                            <button disabled
                                class="inline-flex w-full items-center justify-center rounded-2xl bg-gray-300 px-4 py-3 text-sm font-semibold text-gray-700 cursor-not-allowed">
                                Sudah Diambil
                            </button>
                        @else
                            <form method="POST" action="/student/courses/enroll">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}">

                                <button type="submit"
                                    class="inline-flex w-full items-center justify-center rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700">
                                    Ambil
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection