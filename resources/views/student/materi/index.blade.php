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

<h2 class="text-xl font-bold mb-4">Video Pembelajaran</h2>

@if($materis->isEmpty())
    <p class="text-gray-500">Belum ada video pembelajaran.</p>
@endif

@foreach($materis as $m)
    <div class="bg-white p-4 rounded-xl shadow mb-4">
        <h3 class="font-bold">{{ $m->title }}</h3>

        <a href="/student/materi/{{ $m->id }}"
           class="inline-block mt-3 bg-indigo-600 text-white px-4 py-2 rounded-lg">
            Tonton Video
        </a>
    </div>
@endforeach

@endsection