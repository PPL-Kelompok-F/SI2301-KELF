@extends('layouts.admin.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Edit Kelas
</h1>

<div class="bg-white p-6 rounded shadow">

    <form action="/admin/classrooms/{{ $classroom->id }}/update"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Nama Kelas
            </label>

            <input type="text"
                   name="name"
                   value="{{ $classroom->name }}"
                   class="w-full border p-3 rounded"
                   required>

        </div>

        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Nama Teacher
            </label>

            <input type="text"
                   name="teacher"
                   value="{{ $classroom->teacher }}"
                   class="w-full border p-3 rounded"
                   required>

        </div>

        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Deskripsi
            </label>

            <textarea name="description"
                      rows="4"
                      class="w-full border p-3 rounded">{{ $classroom->description }}</textarea>

        </div>

        <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded">

            Update

        </button>

    </form>

</div>

@endsection