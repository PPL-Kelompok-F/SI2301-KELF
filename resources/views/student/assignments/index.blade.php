@extends('layouts.student.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Assignments</h1>
        <p class="text-gray-600">Lihat tugas yang diberikan guru dan unggah jawabanmu dengan cepat.</p>
    </div>
    <div class="rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-700">
        {{ count($assignments) }} tugas
    </div>
</div>

@if(session('success'))
    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-3 text-green-700">{{ session('success') }}</div>
@endif

<div class="space-y-4">
    @forelse($assignments as $assignment)
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:shadow-md">
            <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $assignment->title }}</h2>
                        <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-600">{{ $assignment->teacher->name ?? '-' }}</span>
                    </div>
                    <p class="mt-2 text-sm leading-6 text-gray-600">{{ $assignment->description }}</p>
                    <div class="mt-3 flex flex-wrap gap-3 text-sm text-gray-600">
                        <span class="rounded-full bg-orange-50 px-2.5 py-1 text-orange-700">Deadline: {{ \Carbon\Carbon::parse($assignment->deadline)->format('d M Y H:i') }}</span>
                        <span class="rounded-full bg-indigo-50 px-2.5 py-1 text-indigo-700">Status: {{ $assignment->my_submission ? $assignment->my_submission->status : 'belum dikumpulkan' }}</span>
                    </div>
                </div>
                <a href="{{ route('student.assignments.show', $assignment) }}" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                    Lihat Detail
                </a>
            </div>
        </div>
    @empty
        <div class="rounded-2xl border border-dashed border-gray-300 bg-white p-8 text-center text-gray-600">Belum ada assignment.</div>
    @endforelse
</div>
@endsection
