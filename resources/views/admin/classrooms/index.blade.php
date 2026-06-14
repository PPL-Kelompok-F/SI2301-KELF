@extends('layouts.admin.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold">Classrooms</h1>
        <p class="text-sm text-gray-500">Kelola kelas dan guru terkait.</p>
    </div>
    <a href="/admin/classrooms/create" class="px-4 py-2 bg-blue-600 text-white rounded">Tambah Kelas</a>
</div>

<div class="bg-white shadow rounded overflow-hidden">
    <table class="min-w-full text-left divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kelas</th>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Guru</th>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($classrooms as $classroom)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $classroom->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $classroom->teacher->name ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ \Illuminate\Support\Str::limit($classroom->description, 80) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap space-x-2">
                        <a href="/admin/classrooms/{{ $classroom->id }}" class="text-blue-600">Lihat</a>
                        <a href="/admin/classrooms/{{ $classroom->id }}/edit" class="text-indigo-600">Edit</a>
                        <form action="/admin/classrooms/{{ $classroom->id }}/delete" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection