@extends('layouts.student.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Forum Diskusi</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(auth()->user()->isStudent())
    <div class="bg-white p-6 rounded-xl shadow mb-8">
        <h2 class="font-bold mb-4 text-lg">Punya Pertanyaan?</h2>
        <form action="{{ route('forum.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <input type="text" name="title" placeholder="Judul Pertanyaan..." required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="mb-4">
                <textarea name="content" rows="3" placeholder="Jelaskan pertanyaanmu di sini..." required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
            </div>
            <button type="submit" class="bg-indigo-500 text-white px-6 py-2 rounded-lg hover:bg-indigo-600 transition">Posting Pertanyaan</button>
        </form>
    </div>
    @endif

    <div class="space-y-4">
        @forelse($posts as $post)
        <a href="{{ route('forum.show', $post->id) }}" class="block bg-white p-5 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="font-bold text-lg text-indigo-600">{{ $post->title }}</h3>
            <p class="text-sm text-gray-500 mb-2">Ditanyakan oleh: <span class="font-semibold">{{ $post->user->name }}</span> ({{ ucfirst($post->user->role) }}) &bull; {{ $post->created_at->diffForHumans() }}</p>
            <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($post->content, 150) }}</p>
        </a>
        @empty
        <div class="bg-white p-5 rounded-xl shadow text-center text-gray-500">
            Belum ada diskusi di forum ini.
        </div>
        @endforelse
    </div>
</div>
@endsection