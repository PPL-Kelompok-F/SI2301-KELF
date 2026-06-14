@extends('layouts.student.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('forum.index') }}" class="text-indigo-500 hover:text-indigo-700 font-medium mb-4 inline-block">&larr; Kembali ke Forum</a>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Pertanyaan Utama -->
    <div class="bg-white p-6 rounded-xl shadow mb-6 border-l-4 border-indigo-500">
        <h1 class="text-2xl font-bold mb-2">{{ $post->title }}</h1>
        <p class="text-sm text-gray-500 mb-4">Ditanyakan oleh: <span class="font-bold">{{ $post->user->name }}</span> &bull; {{ $post->created_at->diffForHumans() }}</p>
        <div class="text-gray-800 text-lg whitespace-pre-wrap">{{ $post->content }}</div>
    </div>

    <h3 class="font-bold text-xl mb-4">Balasan ({{ $post->replies->count() }})</h3>
    
    <!-- Daftar Balasan -->
    <div class="space-y-4 mb-8">
        @forelse($post->replies as $reply)
        <div class="bg-white p-5 rounded-xl shadow-sm border {{ $reply->user->isTeacher() ? 'border-green-400' : 'border-gray-200' }}">
            <p class="font-semibold text-sm mb-3 flex items-center {{ $reply->user->isTeacher() ? 'text-green-700' : 'text-gray-700' }}">
                {{ $reply->user->name }} 
                @if($reply->user->isTeacher()) 
                    <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full ml-2">Teacher</span> 
                @elseif($reply->user->isAdmin())
                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full ml-2">Admin</span> 
                @endif
                <span class="text-gray-400 text-xs ml-auto font-normal">{{ $reply->created_at->diffForHumans() }}</span>
            </p>
            <div class="text-gray-800 whitespace-pre-wrap">{{ $reply->content }}</div>
        </div>
        @empty
        <p class="text-gray-500 italic">Belum ada balasan. Jadilah yang pertama membalas!</p>
        @endforelse
    </div>

    <!-- Form Balasan -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-bold mb-4 text-lg">Tulis Balasan</h3>
        <form action="{{ route('forum.reply', $post->id) }}" method="POST">
            @csrf
            <textarea name="content" rows="4" placeholder="Ketik balasanmu di sini..." required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 mb-4"></textarea>
            <button type="submit" class="bg-indigo-500 text-white px-6 py-2 rounded-lg hover:bg-indigo-600 transition">Kirim Balasan</button>
        </form>
    </div>
</div>
@endsection