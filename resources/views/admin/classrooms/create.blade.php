@extends('layouts.admin.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Tambah Kelas
</h1>

<div class="bg-white p-6 rounded shadow">

    <form action="/admin/classrooms/store" method="POST">

        @csrf

        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Nama Kelas
            </label>

            <input type="text"
                   name="name"
                   class="w-full border p-3 rounded"
                   required>

        </div>

        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Nama Teacher
            </label>

            <input type="text"
                   name="teacher"
                   class="w-full border p-3 rounded"
                   required>

        </div>

        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Deskripsi
            </label>

            <textarea name="description"
                      rows="4"
                      class="w-full border p-3 rounded"></textarea>

        </div>

        <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded">

            Simpan

        </button>

    </form>

</div>

@endsection