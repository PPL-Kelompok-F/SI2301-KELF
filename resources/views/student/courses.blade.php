@extends('layouts.student.app')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold">Courses</h1>
    <p class="text-sm text-gray-500">Pilih materi belajar dari guru.</p>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-4">
        {{ session('error') }}
    </div>
@endif

<h2 class="font-bold mb-3">Materi Belajar</h2>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 mb-8">
    @forelse($materials as $material)
        @php
            $fileUrl = asset('storage/' . $material->file_path);
        @endphp

        <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-start justify-between gap-3 mb-3">
                <div>
                    <h3 class="font-bold text-lg">{{ $material->judul }}</h3>
                    <p class="text-xs text-gray-500">
                        Dari {{ optional($material->teacher)->name ?? 'Teacher' }}
                    </p>
                </div>

                <span class="text-xs px-2 py-1 rounded-full {{ $material->isPdf() ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
                    {{ $material->isPdf() ? 'PDF' : 'VIDEO' }}
                </span>
            </div>

            <p class="text-sm text-gray-600 mb-4">
                {{ $material->deskripsi ?: 'Tidak ada deskripsi.' }}
            </p>

            @if($material->isVideo())
                <video controls class="w-full rounded-lg bg-black mb-3">
                    <source src="{{ $fileUrl }}" type="{{ $material->tipe_file }}">
                    Browser tidak mendukung video ini.
                </video>

                <a href="{{ $fileUrl }}"
                   target="_blank"
                   class="block text-center bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                    Buka Video
                </a>
            @else
                <div class="bg-red-50 text-red-600 rounded-lg p-4 text-center mb-3">
                    Materi PDF
                </div>

                <div class="flex gap-2">
                    <a href="{{ $fileUrl }}"
                       target="_blank"
                       class="flex-1 text-center bg-red-500 text-white py-2 rounded-lg hover:bg-red-600">
                        Buka PDF
                    </a>

                    <a href="{{ $fileUrl }}"
                       download="{{ $material->file_name }}"
                       class="flex-1 text-center bg-gray-200 py-2 rounded-lg hover:bg-gray-300">
                        Download
                    </a>
                </div>
            @endif
        </div>
    @empty
        <div class="bg-white p-6 rounded-xl shadow text-center text-gray-500 md:col-span-2 xl:col-span-3">
            Belum ada materi dari guru.
        </div>
    @endforelse
</div>

@if($allCourses->isNotEmpty())
    <h2 class="font-bold mb-3">Course Tersedia</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($allCourses as $course)
            <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="font-bold text-lg mb-1">
                    {{ $course->title }}
                </h3>

                <p class="text-sm text-gray-500 mb-3">
                    {{ \Illuminate\Support\Str::limit($course->description, 60) }}
                </p>

                <form method="POST" action="/student/courses/enroll">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">

                    <button class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">
                        Ambil Course
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endif

@endsection
