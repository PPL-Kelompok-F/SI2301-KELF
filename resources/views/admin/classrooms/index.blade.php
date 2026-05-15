@extends('layouts.admin.app')

@section('content')

<!-- HEADER -->
<div class="flex justify-between items-center mb-6">

    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            Manajemen Kelas
        </h1>

        <p class="text-gray-500">
            Kelola seluruh kelas pembelajaran
        </p>

    </div>

    <a href="/admin/classrooms/create"
       class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg shadow">

        + Tambah Kelas

    </a>

</div>

<!-- ALERT -->
@if(session('success'))

<div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded-lg mb-5">

    {{ session('success') }}

</div>

@endif


<!-- TABLE -->
<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-100 text-gray-700">

            <tr>

                <th class="p-4 text-left">
                    No
                </th>

                <th class="p-4 text-left">
                    Nama Kelas
                </th>

                <th class="p-4 text-left">
                    Mentor
                </th>

                <th class="p-4 text-left">
                    Deskripsi
                </th>

                <th class="p-4 text-center">
                    Aksi
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($classrooms as $classroom)

            <tr class="border-t hover:bg-gray-50 transition">

                <td class="p-4">

                    {{ $loop->iteration }}

                </td>

                <td class="p-4 font-semibold text-gray-800">

                    {{ $classroom->name }}

                </td>

                <td class="p-4">

                    {{ $classroom->teacher->name }}

                </td>

                <td class="p-4 text-gray-600">

                    {{ $classroom->description }}

                </td>

                <td class="p-4">

                    <div class="flex justify-center gap-2 flex-wrap">

                        <!-- DETAIL -->
                        <a href="/admin/classrooms/{{ $classroom->id }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg shadow">

                            Detail

                        </a>

                        <!-- EDIT -->
                        <a href="/admin/classrooms/{{ $classroom->id }}/edit"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg shadow">

                            Edit

                        </a>

                        <!-- DELETE -->
                        <form action="/admin/classrooms/{{ $classroom->id }}/delete"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    onclick="return confirm('Yakin ingin menghapus kelas ini?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow">

                                Hapus

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="5"
                    class="text-center p-8 text-gray-500">

                    Belum ada data kelas

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection