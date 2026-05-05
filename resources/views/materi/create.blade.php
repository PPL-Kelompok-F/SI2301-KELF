@extends('layouts.teacher.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Tambah Materi</h1>

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/teacher/courses/{{ $course_id }}/materi/store">
    @csrf

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Judul</label>
        <input type="text" name="title"
               value="{{ old('title') }}"
               class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Link YouTube</label>
        <input type="text" name="video_url"
               value="{{ old('video_url') }}"
               class="w-full border p-2 rounded"
               placeholder="https://www.youtube.com/watch?v=..."
               required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Deskripsi</label>
        <textarea name="description"
                  class="w-full border p-2 rounded"
                  rows="4"
                  placeholder="Masukkan deskripsi materi...">{{ old('description') }}</textarea>
    </div>

    <button class="bg-indigo-500 text-white px-4 py-2 rounded">
        Simpan
    </button>

</form>

@endsection