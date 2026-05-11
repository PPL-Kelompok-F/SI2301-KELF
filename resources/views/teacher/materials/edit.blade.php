@extends('layouts.teacher.app')

@section('content')

@php
    $fileUrl = asset('storage/' . $material->file_path);
@endphp

<div class="max-w-2xl bg-white p-6 rounded-xl shadow">
    <h1 class="text-2xl font-bold mb-1">Edit Materi</h1>
    <p class="text-sm text-gray-500 mb-6">Perbarui judul, deskripsi, atau ganti file materi.</p>

    <form method="POST" action="{{ route('teacher.materials.update', $material) }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium mb-1">Judul</label>
            <input type="text"
                   name="judul"
                   value="{{ old('judul', $material->judul) }}"
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
                      class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-green-200">{{ old('deskripsi', $material->deskripsi) }}</textarea>
            @error('deskripsi')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="bg-gray-50 border rounded-lg p-3">
            <p class="text-sm text-gray-500 mb-1">File saat ini</p>
            <a href="{{ $fileUrl }}" target="_blank" class="font-medium text-green-600 hover:underline">
                {{ $material->file_name }}
            </a>
            <p class="text-xs text-gray-500 mt-1">{{ $material->tipe_file }}</p>
        </div>

        <div>
            <label class="block font-medium mb-1">Ganti File Materi</label>
            <input type="file"
                   name="file_materi"
                   accept="application/pdf,video/mp4,video/webm"
                   class="w-full border rounded-lg px-3 py-2">
            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti file.</p>
            @error('file_materi')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2 pt-2">
            <button type="submit"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                Simpan Perubahan
            </button>

            <a href="{{ route('teacher.materials.index') }}"
               class="bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300">
                Batal
            </a>
        </div>
    </form>
</div>

@endsection
