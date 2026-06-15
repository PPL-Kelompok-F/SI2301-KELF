@extends('layouts.teacher.app')

@section('content')
<div class="space-y-4">
    <div class="rounded bg-white p-6 shadow">
        <h1 class="text-2xl font-bold">{{ $assignment->title }}</h1>
        <p class="mt-2 text-gray-700">{{ $assignment->description }}</p>
        <p class="mt-2 text-sm text-gray-600">Deadline: {{ \Carbon\Carbon::parse($assignment->deadline)->format('d M Y H:i') }}</p>
    </div>

    <div class="rounded bg-white p-6 shadow">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-xl font-semibold">Daftar Submission</h2>
            <span class="rounded bg-gray-100 px-3 py-1 text-sm text-gray-700">{{ $assignment->submissions->count() }} pengumpulan</span>
        </div>
        @forelse($assignment->submissions as $submission)
            <div class="flex items-center justify-between border-b py-3">
                <div>
                    <p class="font-semibold">{{ $submission->student->name ?? 'Student' }}</p>
                    <p class="text-sm text-gray-600">Status: {{ $submission->status }}</p>
                </div>
                @if($submission->file)
                    <a href="{{ asset('storage/' . $submission->file) }}" class="text-blue-600">Lihat File</a>
                @else
                    <span class="text-sm text-gray-500">Belum ada file</span>
                @endif
            </div>
        @empty
            <p class="text-gray-600">Belum ada submission.</p>
        @endforelse
    </div>
</div>
@endsection
