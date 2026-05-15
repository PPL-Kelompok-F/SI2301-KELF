@extends('layouts.teacher.app')

@section('content')

@php
$stats = [
    'draft' => $assignments->where('status','draft')->count(),
    'published' => $assignments->where('status','published')->count(),
    'closed' => $assignments->where('status','closed')->count(),
];
@endphp

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Assignment Management</h2>

    <a href="{{ route('teacher.assignments.create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded">
        + Add Assignment
    </a>
</div>

@if(session('success'))
    <div class="bg-green-200 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="bg-red-200 p-3 rounded mb-4">{{ session('error') }}</div>
@endif

<div class="grid grid-cols-3 gap-4 mb-6">

    <div class="bg-yellow-100 p-4 rounded">
        <h2>Draft</h2>
        <p class="text-2xl font-bold">{{ $stats['draft'] }}</p>
    </div>

    <div class="bg-green-100 p-4 rounded">
        <h2>Published</h2>
        <p class="text-2xl font-bold">{{ $stats['published'] }}</p>
    </div>

    <div class="bg-red-100 p-4 rounded">
        <h2>Closed</h2>
        <p class="text-2xl font-bold">{{ $stats['closed'] }}</p>
    </div>

</div>

<div class="grid gap-4">

@forelse($assignments as $assignment)

@php
$deadline = \Carbon\Carbon::parse($assignment->deadline)->timezone('Asia/Jakarta');
$isClosed = now()->timezone('Asia/Jakarta')->gt($deadline) || $assignment->status === 'closed';
@endphp

<div class="bg-white p-4 rounded shadow flex justify-between">

    <div>
        <h3 class="text-lg font-bold">{{ $assignment->title }}</h3>
        <p class="text-gray-600">{{ $assignment->classroom->name }}</p>

        <p class="text-sm text-gray-500 mt-1">
            Deadline: {{ $deadline->format('d M Y H:i') }}
        </p>

        <span class="text-sm {{ $isClosed ? 'text-red-600' : 'text-green-600' }}">
            {{ $isClosed ? 'CLOSED' : 'ACTIVE' }}
        </span>
    </div>

    <div class="flex gap-2 items-start">

        <a href="{{ route('teacher.assignments.show',$assignment->id) }}"
           class="bg-blue-500 text-white px-3 py-1 rounded">
            View
        </a>

        <a href="{{ route('teacher.assignments.edit',$assignment->id) }}"
           class="bg-yellow-500 text-white px-3 py-1 rounded">
            Edit
        </a>

        <form method="POST" action="{{ route('teacher.assignments.close',$assignment->id) }}">
            @csrf
            <button class="bg-gray-600 text-white px-3 py-1 rounded">
                Close
            </button>
        </form>

        <form method="POST" action="{{ route('teacher.assignments.destroy',$assignment->id) }}">
            @csrf
            @method('DELETE')
            <button class="bg-red-600 text-white px-3 py-1 rounded">
                Delete
            </button>
        </form>

    </div>

</div>

@empty
<div class="text-center text-gray-500">No assignments found</div>
@endforelse

</div>

@endsection