@extends('layouts.admin.app')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-2xl font-bold">
                Manajemen User
            </h1>

            <p class="text-gray-500 text-sm">
                Kelola role pengguna sistem
            </p>
        </div>

    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR --}}
    @if(session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">

        <table class="w-full border border-gray-200">

            <thead class="bg-gray-100">

                <tr>
                    <th class="p-3 border text-left">No</th>
                    <th class="p-3 border text-left">Nama</th>
                    <th class="p-3 border text-left">Email</th>
                    <th class="p-3 border text-left">Role</th>
                    <th class="p-3 border text-center">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($users as $index => $user)

                <tr class="hover:bg-gray-50">

                    <td class="p-3 border">
                        {{ $index + 1 }}
                    </td>

                    <td class="p-3 border font-semibold">
                        {{ $user->name }}
                    </td>

                    <td class="p-3 border">
                        {{ $user->email }}
                    </td>

                    <td class="p-3 border">

                        @if($user->role == 'admin')

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded text-sm">
                                Admin
                            </span>

                        @elseif($user->role == 'teacher')

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded text-sm">
                                Teacher
                            </span>

                        @else

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded text-sm">
                                Student
                            </span>

                        @endif

                    </td>

                    <td class="p-3 border">

                        @if(auth()->id() != $user->id)

                        <form method="POST"
                              action="/admin/users/{{ $user->id }}/role"
                              class="flex gap-2 items-center justify-center">

                            @csrf

                            <select name="role"
                                    class="border rounded px-3 py-2">

                                <option value="student"
                                    {{ $user->role == 'student' ? 'selected' : '' }}>
                                    Student
                                </option>

                                <option value="teacher"
                                    {{ $user->role == 'teacher' ? 'selected' : '' }}>
                                    Teacher
                                </option>

                                <option value="admin"
                                    {{ $user->role == 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>

                            </select>

                            <button type="submit"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">

                                Update

                            </button>

                        </form>

                        @else

                        <span class="text-gray-400 text-sm">
                            Akun Login
                        </span>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5"
                        class="text-center p-6 text-gray-500">

                        Belum ada user

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection