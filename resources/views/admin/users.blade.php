@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Manajemen Role User</h1>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
    {{ session('success') }}
</div>
@endif

<div class="bg-white p-4 rounded-xl shadow">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b">
                <th class="text-left p-2">Nama</th>
                <th class="text-left p-2">Email</th>
                <th class="text-left p-2">Role</th>
                <th class="text-left p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
        <tr class="border-b">
            <td class="p-2">{{ $user->name }}</td>
            <td class="p-2">{{ $user->email }}</td>

            <td class="p-2">
                <form action="/admin/users/{{ $user->id }}/role" method="POST">
                    @csrf

                    <select name="role" class="border rounded px-2 py-1">
                        <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
                        <option value="mentor" {{ $user->role == 'mentor' ? 'selected' : '' }}>Mentor</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
            </td>

            <td class="p-2">
                    <button class="bg-blue-500 text-white px-3 py-1 rounded">
                        Update
                    </button>
                </form>
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>
</div>

@endsection