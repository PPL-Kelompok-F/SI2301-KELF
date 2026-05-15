@extends('layouts.student.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">
    Assignment List
</h2>

@if(session('success'))
    <div class="bg-green-200 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-200 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="grid grid-cols-1 gap-4">

@foreach($assignments as $assignment)

@php
$deadline = \Carbon\Carbon::parse($assignment->deadline)->timezone('Asia/Jakarta');
$isLate = now()->timezone('Asia/Jakarta')->gt($deadline);
@endphp

<div class="bg-white p-4 rounded shadow">

    <div class="flex justify-between items-center">

        <div>

            <h3 class="text-lg font-bold">
                {{ $assignment->title }}
            </h3>

            <p class="text-gray-600">
                {{ $assignment->classroom->name }}
            </p>

            <p class="text-sm text-gray-500 mt-2">
                Deadline: {{ $deadline->format('d M Y H:i') }}
            </p>

            <div class="mt-2">

                @if($isLate)
                    <span class="bg-red-200 text-red-700 px-2 py-1 rounded text-sm">
                        CLOSED
                    </span>
                @else
                    <span class="bg-green-200 text-green-700 px-2 py-1 rounded text-sm">
                        OPEN
                    </span>
                @endif

            </div>

        </div>

        <div>

            @if($isLate)
                <button class="bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed">
                    Closed
                </button>
            @else
                <a href="/student/submissions/{{ $assignment->id }}/create"
                   class="bg-blue-500 text-white px-4 py-2 rounded">
                    Submit
                </a>
            @endif

        </div>

    </div>

</div>

@endforeach

</div>

@endsection

<script>
setInterval(() => {
    location.reload();
}, 60000); // 60 detik = 1 menit
</script>