@extends('layouts.admin.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow rounded p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold">{{ $classroom->name }}</h1>
            <p class="text-sm text-gray-500">Guru: {{ $classroom->teacher->name ?? '-' }}</p>
        </div>
        <a href="/admin/classrooms/{{ $classroom->id }}/edit" class="px-4 py-2 bg-indigo-600 text-white rounded">Edit</a>
    </div>

    <div class="space-y-4">
        <div>
            <h2 class="font-semibold">Deskripsi</h2>
            <p class="text-gray-700">{{ $classroom->description ?? 'Tidak ada deskripsi.' }}</p>
        </div>

        <div>
            <h2 class="font-semibold">Created At</h2>
            <p class="text-gray-600">{{ $classroom->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>
</div>
@endsection