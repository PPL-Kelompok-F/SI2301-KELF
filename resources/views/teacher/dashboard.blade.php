@extends('layouts.teacher.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Teacher Dashboard</h1>
    <p class="mt-1 text-gray-600">Kelola kelas, materi, dan tugas dengan cepat.</p>
</div>

<div class="mb-6 grid gap-4 md:grid-cols-3">
    <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
        <p class="text-sm text-gray-500">Total Courses</p>
        <p class="mt-1 text-2xl font-bold text-gray-800">5</p>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
        <p class="text-sm text-gray-500">Students</p>
        <p class="mt-1 text-2xl font-bold text-gray-800">120</p>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
        <p class="text-sm text-gray-500">Assignments</p>
        <p class="mt-1 text-2xl font-bold text-gray-800">8</p>
    </div>
</div>

<div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
    <h2 class="text-lg font-semibold text-gray-800">Aksi Cepat</h2>
    <div class="mt-4 flex flex-wrap gap-3">
        <a href="/teacher/materials" class="rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700">Kelola Materi</a>
        <a href="/teacher/assignments" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">Kelola Assignment</a>
        <a href="/teacher/assignments/create" class="rounded-lg bg-purple-600 px-4 py-2 text-sm font-semibold text-white hover:bg-purple-700">Buat Assignment</a>
    </div>
</div>
@endsection