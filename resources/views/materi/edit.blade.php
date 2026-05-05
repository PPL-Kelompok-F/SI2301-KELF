@extends('layouts.teacher.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Edit Materi</h1>

<form method="POST"
      action="/teacher/materi/{{ $materi->id }}/update"
      onsubmit="return confirm('Yakin ingin menyimpan perubahan?')">
    @csrf

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Judul</label>
        <input type="text" name="title"
               value="{{ $materi->title }}"
               class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Link YouTube</label>
        <input type="text" name="video_url"
               value="{{ $materi->video_url }}"
               class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Deskripsi</label>
        <textarea name="description"
                  class="w-full border p-2 rounded"
                  rows="4">{{ $materi->description }}</textarea>
    </div>

    <button type="submit"
            class="bg-indigo-500 text-white px-4 py-2 rounded">
        Update
    </button>

</form>

@endsection