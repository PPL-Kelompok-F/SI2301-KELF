@extends('layouts.teacher.app')

@section('content')

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<a href="/teacher/courses/{{ $course_id }}/materi/create"
   class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">
   + Tambah Materi
</a>

<h1 class="text-2xl font-bold mb-4">Daftar Video</h1>

@if($materis->isEmpty())
    <p class="text-gray-500">Belum ada materi</p>
@endif

@foreach($materis as $m)
    <div class="mb-4 p-4 bg-white rounded shadow">
        <h2 class="font-bold">{{ $m->title }}</h2>

        <div class="flex gap-4 mt-2 text-sm">

            <a href="/teacher/materi/{{ $m->id }}"
               class="text-blue-500 hover:underline">
                ▶ Tonton
            </a>

            <a href="/teacher/materi/{{ $m->id }}/edit"
               class="text-yellow-500 hover:underline">
                ✏ Edit
            </a>

            <form method="POST"
                  action="/teacher/materi/{{ $m->id }}/delete"
                  onsubmit="return confirm('Yakin mau hapus materi ini?')">
                @csrf
                <button type="submit"
                        class="text-red-500 hover:underline">
                    🗑 Delete
                </button>
            </form>

        </div>
    </div>
@endforeach

@endsection