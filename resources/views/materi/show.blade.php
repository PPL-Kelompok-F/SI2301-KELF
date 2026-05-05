@extends('layouts.teacher.app')

@section('content')

<a href="javascript:history.back()"
   class="inline-block mb-4 text-indigo-500 hover:underline">
    ← Kembali
</a>

<div class="bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-4">
        {{ $materi->title }}
    </h1>

    @if($embed)
        <div class="relative w-full aspect-video bg-black rounded-lg overflow-hidden">
            <iframe
                class="absolute top-0 left-0 w-full h-full"
                src="{{ $embed }}"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
            </iframe>
        </div>
    @else
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            Link video tidak valid.
        </div>
    @endif

</div>

@endsection