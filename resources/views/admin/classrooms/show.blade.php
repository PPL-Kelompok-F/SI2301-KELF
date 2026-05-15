@extends('layouts.admin.app')

@section('content')

<!-- HEADER -->
<div class="flex justify-between items-center mb-6">

    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            Detail Kelas
        </h1>

        <p class="text-gray-500">
            Informasi lengkap kelas pembelajaran
        </p>

    </div>

    <a href="/admin/classrooms"
       class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-lg shadow">

        ← Kembali

    </a>

</div>


<!-- CARD DETAIL -->
<div class="bg-white rounded-2xl shadow-lg overflow-hidden">

    <!-- TOP -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 text-white">

        <h2 class="text-3xl font-bold">
            {{ $classroom->name }}
        </h2>

        <p class="mt-2 text-blue-100">
            Kelas pembelajaran dalam sistem BelajarIn
        </p>

    </div>


    <!-- CONTENT -->
    <div class="p-8 space-y-8">

        <!-- NAMA KELAS -->
        <div>

            <h3 class="text-sm uppercase tracking-wide text-gray-500 mb-2">
                Nama Kelas
            </h3>

            <div class="bg-gray-100 p-4 rounded-xl">

                <p class="text-xl font-semibold text-gray-800">
                    {{ $classroom->name }}
                </p>

            </div>

        </div>


        <!-- TEACHER -->
        <div>

            <h3 class="text-sm uppercase tracking-wide text-gray-500 mb-2">
                Mentor / Teacher
            </h3>

            <div class="bg-gray-100 p-4 rounded-xl flex items-center gap-4">

                <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white text-xl font-bold">

                    {{ strtoupper(substr($classroom->teacher, 0, 1)) }}

                </div>

                <div>

                    <p class="text-lg font-semibold text-gray-800">
                        {{ $classroom->teacher }}
                    </p>

                    <p class="text-gray-500 text-sm">
                        Pengajar kelas
                    </p>

                </div>

            </div>

        </div>


        <!-- DESKRIPSI -->
        <div>

            <h3 class="text-sm uppercase tracking-wide text-gray-500 mb-2">
                Deskripsi Kelas
            </h3>

            <div class="bg-gray-100 p-5 rounded-xl">

                @if($classroom->description)

                    <p class="text-gray-700 leading-relaxed">
                        {{ $classroom->description }}
                    </p>

                @else

                    <p class="text-gray-400 italic">
                        Belum ada deskripsi kelas.
                    </p>

                @endif

            </div>

        </div>


        <!-- INFORMASI TAMBAHAN -->
        <div class="grid grid-cols-2 gap-6">

            <div class="bg-blue-50 p-5 rounded-xl border border-blue-100">

                <p class="text-sm text-blue-500 mb-1">
                    Dibuat Pada
                </p>

                <p class="font-semibold text-gray-800">
                    {{ $classroom->created_at->format('d M Y H:i') }}
                </p>

            </div>

            <div class="bg-green-50 p-5 rounded-xl border border-green-100">

                <p class="text-sm text-green-500 mb-1">
                    Terakhir Diupdate
                </p>

                <p class="font-semibold text-gray-800">
                    {{ $classroom->updated_at->format('d M Y H:i') }}
                </p>

            </div>

        </div>


        <!-- ACTION BUTTON -->
        <div class="flex gap-3 pt-4">

            <a href="/admin/classrooms/{{ $classroom->id }}/edit"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg shadow">

                ✏️ Edit Kelas

            </a>

            <form action="/admin/classrooms/{{ $classroom->id }}/delete"
                  method="POST">

                @csrf
                @method('DELETE')

                <button type="submit"
                        onclick="return confirm('Yakin ingin menghapus kelas ini?')"
                        class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg shadow">

                    🗑 Hapus

                </button>

            </form>

        </div>

    </div>

</div>

@endsection