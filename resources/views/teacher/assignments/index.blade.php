@extends('layouts.teacher.app')

@section('content')
<div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manage Assignments</h1>
        <p class="text-gray-600">Buat dan kelola assignment untuk student.</p>
    </div>
    <a href="{{ route('teacher.assignments.create') }}" class="inline-flex items-center justify-center rounded-lg bg-green-600 px-4 py-2 font-semibold text-white hover:bg-green-700">+ Buat Assignment</a>
</div>

@if(session('success'))
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-3 text-green-700">{{ session('success') }}</div>
@endif

<div class="space-y-4">
    @forelse($assignments as $assignment)
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:shadow-md">
            <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                <div class="flex-1">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $assignment->title }}</h2>
                    <p class="mt-2 text-sm leading-6 text-gray-600">{{ $assignment->description }}</p>
                    <div class="mt-3 flex flex-wrap gap-2 text-sm">
                        <span class="rounded-full bg-orange-50 px-2.5 py-1 text-orange-700">Deadline: {{ \Carbon\Carbon::parse($assignment->deadline)->format('d M Y H:i') }}</span>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <a href="{{ route('teacher.assignments.show', $assignment) }}" class="rounded-lg bg-green-600 px-4 py-2 text-center text-sm font-semibold text-white hover:bg-green-700">Lihat Submission</a>
                    @if($assignment->file)
                        <a href="{{ asset('storage/' . $assignment->file) }}" class="text-center text-sm font-semibold text-blue-600">📎 Unduh file</a>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="rounded-2xl border border-dashed border-gray-300 bg-white p-8 text-center text-gray-600">Belum ada assignment.</div>
    @endforelse
</div>
@endsection
