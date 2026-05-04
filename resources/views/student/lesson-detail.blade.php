@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-4">
        <a href="/dashboard" class="text-indigo-600 font-semibold">← Kembali ke Dashboard</a>
        
        @php
            // Cari materi selanjutnya berdasarkan order_number
            $nextLesson = DB::table('lessons')
                ->where('course_id', $lesson->course_id)
                ->where('order_number', '>', $lesson->order_number)
                ->orderBy('order_number', 'asc')
                ->first();
        @endphp

        @if($nextLesson)
            <a href="/lesson/{{ $nextLesson->id }}" class="text-sm bg-gray-100 px-4 py-2 rounded-lg hover:bg-gray-200 transition">
                Materi Berikutnya: {{ $nextLesson->title }} →
            </a>
        @endif
    </div>
    
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <div class="aspect-video bg-black">
            <iframe 
                class="w-full h-[500px]"
                src="{{ $lesson->video_url }}" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>
        </div>

        <div class="p-8">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-6">
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $lesson->title }}</h1>
                    <p class="text-gray-500">Materi ke-{{ $lesson->order_number }} • Durasi: {{ $lesson->duration }} Menit</p>
                    <div class="mt-4 text-gray-700 leading-relaxed">
                        <p>Simak materi video di atas dengan seksama. Setelah selesai, jangan lupa klik tombol konfirmasi di samping untuk memperbarui progress belajarmu di dashboard.</p>
                    </div>
                </div>

                <div class="w-full md:w-72">
                    @php
                        $isDone = DB::table('lesson_progress')
                            ->where('user_id', auth()->id())
                            ->where('lesson_id', $lesson->id)
                            ->where('is_completed', 1)
                            ->exists();
                    @endphp

                    <div class="bg-indigo-50 p-6 rounded-2xl border border-indigo-100 text-center">
                        @if($isDone)
                            <div class="text-green-600 font-bold mb-3 flex flex-col items-center">
                                <span class="text-4xl mb-2">✅</span>
                                Materi Selesai
                            </div>
                            <p class="text-xs text-indigo-700">Kamu sudah menyelesaikan materi ini!</p>
                        @else
                            <h4 class="font-bold text-indigo-900 mb-4">Selesaikan Materi?</h4>
                            <form action="/lesson/{{ $lesson->id }}/complete" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700 shadow-md shadow-indigo-200 transition active:scale-95">
                                    Tandai Selesai
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection