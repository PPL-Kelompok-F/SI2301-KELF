@extends('layouts.student.app')

@section('content')
<div class="space-y-4">
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $assignment->title }}</h1>
                <p class="mt-2 text-gray-700">{{ $assignment->description }}</p>
            </div>
            <div class="rounded-full bg-orange-50 px-3 py-1 text-sm font-medium text-orange-700">
                Deadline: {{ \Carbon\Carbon::parse($assignment->deadline)->format('d M Y H:i') }}
            </div>
        </div>
        @if($assignment->file)
            <a href="{{ asset('storage/' . $assignment->file) }}" class="mt-4 inline-flex items-center text-sm font-semibold text-blue-600">📎 Unduh file assignment</a>
        @endif
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        <h2 class="mb-2 text-xl font-semibold text-gray-800">Kumpulkan Assignment</h2>
        <p class="mb-4 text-sm text-gray-600">Unggah jawaban Anda di sini. File yang dikirim akan tampil di halaman ini.</p>
        @if($submission)
            <div class="rounded-xl border border-green-200 bg-green-50 p-4">
                <p class="font-semibold text-green-700">Status submission: {{ $submission->status }}</p>
                @if($submission->file)
                    <a href="{{ asset('storage/' . $submission->file) }}" class="mt-2 inline-block text-sm font-semibold text-blue-600">📄 Lihat file submission</a>
                @endif

                <div class="mt-4 flex flex-wrap gap-3">
                    <form action="{{ route('student.assignments.storeSubmission', $assignment) }}" method="POST" enctype="multipart/form-data" class="flex flex-wrap items-center gap-2">
                        @csrf
                        <input type="file" name="file" required class="rounded border border-gray-300 bg-white px-3 py-2">
                        <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Perbarui Jawaban</button>
                    </form>

                    <form action="{{ route('student.assignments.destroySubmission', $assignment) }}" method="POST" onsubmit="return confirm('Hapus submission ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-lg bg-red-600 px-4 py-2 text-white hover:bg-red-700">Hapus Submission</button>
                    </form>
                </div>
            </div>
        @else
            <form action="{{ route('student.assignments.storeSubmission', $assignment) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-4">
                    <label class="mb-1 block font-semibold text-gray-700">Upload file jawaban</label>
                    <input type="file" name="file" required class="w-full rounded border border-gray-300 bg-white px-3 py-2">
                    <p class="mt-2 text-sm text-gray-500">Format file: PDF, DOCX, JPG, PNG. Maksimal 20MB.</p>
                </div>
                <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Upload Jawaban</button>
            </form>
        @endif
    </div>
</div>
@endsection
