@extends('layouts.teacher.app')

@section('content')

<div class="max-w-2xl bg-white p-6 rounded-xl shadow">
    <h1 class="text-2xl font-bold mb-1">Tambah Materi</h1>
    <p class="text-sm text-gray-500 mb-6">Upload materi video atau PDF untuk siswa.</p>

    <form method="POST" action="{{ route('teacher.materials.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium mb-1">Judul</label>
            <input type="text"
                   name="judul"
                   value="{{ old('judul') }}"
                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-green-200"
                   required>
            @error('judul')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">Deskripsi</label>
            <textarea name="deskripsi"
                      rows="4"
                      class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-green-200">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-medium mb-1">File Materi</label>
            <input type="file"
                   name="file_materi"
                   accept="application/pdf,video/mp4,video/webm"
                   class="w-full border rounded-lg px-3 py-2"
                   required>
            <p class="text-xs text-gray-500 mt-1">Format yang diperbolehkan: PDF, MP4, WEBM.</p>
            @error('file_materi')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2 pt-2">
            <button type="submit"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                Simpan
            </button>

            <a href="{{ route('teacher.materials.index') }}"
               class="bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300">
                Batal
            </a>
        </div>
    </form>
</div>

@endsection
