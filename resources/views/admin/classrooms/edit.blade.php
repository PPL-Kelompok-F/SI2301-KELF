@extends('layouts.admin.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Kelas</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/admin/classrooms/{{ $classroom->id }}/update" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-2">Nama Kelas</label>
            <input type="text" name="name" value="{{ old('name', $classroom->name) }}" class="w-full border rounded px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block mb-2">Guru</label>
            <select name="teacher_id" class="w-full border rounded px-4 py-2">
                <option value="">Pilih Guru</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" @if(old('teacher_id', $classroom->teacher_id) == $teacher->id) selected @endif>
                        {{ $teacher->name }} ({{ $teacher->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-4 py-2" rows="4">{{ old('description', $classroom->description) }}</textarea>
        </div>

        <button class="bg-indigo-600 text-white px-5 py-3 rounded">Update Kelas</button>
    </form>
</div>
@endsection