@extends('layouts.teacher.app')

@section('page-title', 'Course Detail')

@section('content')

<a href="/teacher/dashboard"
   class="inline-block mb-4 text-indigo-500 hover:underline">
    ← Kembali ke Dashboard
</a>

<h1 class="text-2xl font-bold mb-2">
    {{ $course->title }}
</h1>

<p class="text-gray-600 mb-6">
    {{ $course->description }}
</p>

<a href="/teacher/courses/{{ $course->id }}/materi/create"
   class="bg-green-500 text-white px-4 py-2 rounded mb-6 inline-block">
    + Tambah Materi
</a>

<h2 class="text-xl font-bold mb-3">Video Pembelajaran</h2>

@if($materis->isEmpty())
    <p class="text-gray-500">Belum ada video untuk course ini.</p>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
@foreach($materis as $m)
    <div class="bg-white p-4 rounded-xl shadow">
        <h3 class="font-bold text-lg">{{ $m->title }}</h3>

        <div class="flex gap-3 mt-3">
            <a href="/teacher/materi/{{ $m->id }}"
               class="text-blue-500">Tonton</a>

            <a href="/teacher/materi/{{ $m->id }}/edit"
               class="text-yellow-500">Edit</a>

            <form method="POST"
                  action="/teacher/materi/{{ $m->id }}/delete"
                  onsubmit="return confirm('Yakin mau hapus materi ini?')">
                @csrf
                <button type="submit" class="text-red-500">
                    Delete
                </button>
            </form>
        </div>
    </div>
@endforeach
</div>

@endsection