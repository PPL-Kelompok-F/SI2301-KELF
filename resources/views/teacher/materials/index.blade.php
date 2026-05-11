@extends('layouts.teacher.app')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold">Manajemen Materi</h1>
        <p class="text-sm text-gray-500">Kelola video dan PDF untuk siswa.</p>
    </div>

    <a href="{{ route('teacher.materials.create') }}"
       class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
        Tambah Materi
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    @forelse($materials as $material)
        @php
            $fileUrl = asset('storage/' . $material->file_path);
        @endphp

        <div class="bg-white p-4 rounded-xl shadow">
            <div class="flex items-start justify-between gap-3 mb-3">
                <div>
                    <h2 class="font-bold text-lg">{{ $material->judul }}</h2>
                    <p class="text-xs text-gray-500">
                        {{ $material->isPdf() ? 'PDF' : 'Video' }} - {{ $material->created_at->format('d M Y') }}
                    </p>
                </div>

                <span class="text-xs px-2 py-1 rounded-full {{ $material->isPdf() ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
                    {{ $material->isPdf() ? 'PDF' : 'VIDEO' }}
                </span>
            </div>

            <p class="text-sm text-gray-600 mb-4">
                {{ \Illuminate\Support\Str::limit($material->deskripsi, 110) ?: 'Tidak ada deskripsi.' }}
            </p>

            <a href="{{ $fileUrl }}"
               target="_blank"
               class="block text-center bg-gray-100 py-2 rounded-lg hover:bg-gray-200 mb-3">
                Buka File
            </a>

            <div class="flex gap-2">
                <a href="{{ route('teacher.materials.edit', $material) }}"
                   class="flex-1 text-center bg-yellow-400 text-white py-2 rounded-lg hover:bg-yellow-500">
                    Edit
                </a>

                <form method="POST"
                      action="{{ route('teacher.materials.destroy', $material) }}"
                      class="flex-1"
                      onsubmit="return confirm('Hapus materi ini?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="bg-white p-6 rounded-xl shadow text-center text-gray-500 md:col-span-2 xl:col-span-3">
            Belum ada materi. Klik tombol Tambah Materi untuk membuat materi pertama.
        </div>
    @endforelse
</div>

@endsection
