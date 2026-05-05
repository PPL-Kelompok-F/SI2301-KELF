@extends('layouts.student.app')

@section('page-title', 'Video Pembelajaran')

@section('content')

<a href="/student/courses/{{ $course->id }}"
   class="inline-block mb-4 text-indigo-500 hover:underline">
    ← Kembali ke Course
</a>

<div class="bg-white p-6 rounded-xl shadow mb-6">
    <h1 class="text-2xl font-bold mb-2">{{ $course->title }}</h1>
    <p class="text-gray-600">{{ $course->description }}</p>
</div>

<h2 class="text-xl font-bold mb-4">Daftar Video Pembelajaran</h2>

@if($materis->isEmpty())
    <div class="bg-white p-6 rounded-xl shadow text-center text-gray-500">
        Belum ada video pembelajaran.
    </div>
@endif

<div class="space-y-4">
@foreach($materis as $index => $m)
    <div class="bg-white p-4 rounded-xl shadow flex justify-between items-center">
        <div>
            <p class="text-sm text-gray-400">Video {{ $index + 1 }}</p>
            <h3 class="font-bold text-lg">{{ $m->title }}</h3>

            @if(!empty($m->description))
                <p class="text-sm text-gray-500 mt-1">
                    {{ \Illuminate\Support\Str::limit($m->description, 90) }}
                </p>
            @endif
        </div>

        <a href="/student/materi/{{ $m->id }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
            ▶ Tonton
        </a>
    </div>
@endforeach
</div>

@endsection