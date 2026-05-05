@extends('layouts.teacher.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Tambah Materi</h1>

<form method="POST" action="/teacher/courses/{{ $course_id }}/materi/store">
    @csrf

    <div class="mb-4">
        <label>Judul</label>
        <input type="text" name="title"
               class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label>Link YouTube</label>
        <input type="text" name="video_url"
               class="w-full border p-2 rounded"
               placeholder="https://www.youtube.com/watch?v=..."
               required>
    </div>

    <button class="bg-indigo-500 text-white px-4 py-2 rounded">
        Simpan
    </button>

</form>

@endsection