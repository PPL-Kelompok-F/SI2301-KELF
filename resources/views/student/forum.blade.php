@extends('layouts.student.app')

@section('content')

<div class="max-w-5xl mx-auto">

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded shadow p-6 mb-6">

        <h2 class="text-2xl font-bold mb-4">
            Forum Diskusi
        </h2>

        <form method="POST" action="/student/forum">

            @csrf

            <div class="mb-4">
                <label class="font-medium">
                    Judul
                </label>

                <input
                    type="text"
                    name="title"
                    class="w-full border p-2 rounded mt-1"
                    required>
            </div>

            <div class="mb-4">
                <label class="font-medium">
                    Isi Diskusi
                </label>

                <textarea
                    name="content"
                    rows="4"
                    class="w-full border p-2 rounded mt-1"
                    required></textarea>
            </div>

            <button
                class="bg-blue-500 text-white px-4 py-2 rounded">
                Buat Diskusi
            </button>

        </form>

    </div>

    <h3 class="font-bold text-xl mb-4">
        Semua Diskusi
    </h3>

    <div class="space-y-4">

        @forelse($posts as $post)

            <div class="bg-white rounded shadow p-5">

                <div class="flex justify-between">

                    <h4 class="font-bold text-lg">
                        {{ $post->title }}
                    </h4>

                    <span class="text-sm text-gray-500">
                        {{ $post->created_at->format('d M Y H:i') }}
                    </span>

                </div>

                <p class="text-sm text-gray-500 mt-1">
                    Oleh {{ $post->user->name }}
                </p>

                <hr class="my-3">

                <p>
                    {{ $post->content }}
                </p>

            </div>

        @empty

            <div class="bg-white p-5 rounded shadow">
                Belum ada diskusi.
            </div>

        @endforelse

    </div>

</div>

@endsection