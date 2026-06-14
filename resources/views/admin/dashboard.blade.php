@extends('layouts.admin.app')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-gray-500">Total Classes</h2>
        <p class="text-3xl font-bold">{{ $totalClasses }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-gray-500">Total Users</h2>
        <p class="text-3xl font-bold">{{ $totalUsers }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-gray-500">Teachers</h2>
        <p class="text-3xl font-bold">{{ $totalTeachers }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-gray-500">Students</h2>
        <p class="text-3xl font-bold">{{ $totalStudents }}</p>
    </div>
</div>

<div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-4">
    <div class="bg-white shadow rounded p-6">
        <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
        <div class="space-y-3">
            <a href="/admin/classrooms" class="block px-4 py-3 rounded bg-blue-600 text-white">Manage Classrooms</a>
            <a href="/admin/users" class="block px-4 py-3 rounded bg-gray-800 text-white">Manage Users</a>
        </div>
    </div>
    <div class="bg-white shadow rounded p-6">
        <h3 class="text-lg font-semibold mb-4">Admin Notes</h3>
        <p class="text-gray-600 text-sm">Gunakan menu di samping untuk membuat dan mengelola kelas, melihat daftar pengguna, dan menetapkan peran.</p>
    </div>
</div>

@endsection