@extends('layouts.teacher.app')

@section('content')
<div class="max-w-2xl rounded bg-white p-6 shadow">
    <h1 class="mb-4 text-2xl font-bold">Buat Assignment</h1>

    <form action="{{ route('teacher.assignments.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="mb-1 block font-semibold">Judul</label>
            <input type="text" name="title" required class="w-full rounded border px-3 py-2">
        </div>

        <div>
            <label class="mb-1 block font-semibold">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full rounded border px-3 py-2"></textarea>
        </div>

        <div>
            <label class="mb-1 block font-semibold">Deadline</label>
            <input type="datetime-local" name="deadline" required class="w-full rounded border px-3 py-2">
        </div>

        <div>
            <label class="mb-1 block font-semibold">File (opsional)</label>
            <input type="file" name="file" class="w-full rounded border px-3 py-2">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded bg-green-600 px-4 py-2 text-white">Simpan</button>
            <a href="{{ route('teacher.assignments.index') }}" class="rounded bg-gray-300 px-4 py-2">Kembali</a>
        </div>
    </form>
</div>
@endsection
