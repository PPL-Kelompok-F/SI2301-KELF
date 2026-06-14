@extends('layouts.admin.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold">Users</h1>
        <p class="text-sm text-gray-500">Lihat semua pengguna dan ubah peran mereka.</p>
    </div>
</div>

<div class="bg-white shadow rounded overflow-hidden">
    <table class="min-w-full text-left divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($user->role) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="/admin/users/{{ $user->id }}/role" method="POST" class="flex gap-2 items-center">
                            @csrf
                            <select name="role" class="border rounded px-3 py-2">
                                <option value="student" @if($user->role === 'student') selected @endif>Student</option>
                                <option value="teacher" @if($user->role === 'teacher') selected @endif>Teacher</option>
                                <option value="admin" @if($user->role === 'admin') selected @endif>Admin</option>
                            </select>
                            <button type="submit" class="bg-blue-600 text-white px-3 py-2 rounded">Update</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection