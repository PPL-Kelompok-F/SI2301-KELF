@extends('layouts.teacher.app')

@section('content')

<div class="grid grid-cols-3 gap-4 mb-6">

    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-gray-500">My Classrooms</h2>

        <p class="text-2xl font-bold">
            {{ $totalCourses }}
        </p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-gray-500">Assignments</h2>

        <p class="text-2xl font-bold">
            {{ $totalAssignments }}
        </p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-gray-500">Submissions</h2>

        <p class="text-2xl font-bold">
            {{ $totalSubmissions }}
        </p>
    </div>

</div>

<!-- ========================= -->
<!-- CLASSROOM LIST -->
<!-- ========================= -->

<div class="bg-white shadow rounded p-4">

    <h2 class="font-bold text-lg mb-4">
        My Classrooms
    </h2>

    @forelse($classrooms as $classroom)

        <div class="border rounded p-3 mb-3">

            <h3 class="font-bold text-lg">
                {{ $classroom->name }}
            </h3>

            <p class="text-gray-500 text-sm">
                {{ $classroom->description }}
            </p>

        </div>

    @empty

        <p class="text-gray-500">
            Belum ada classroom.
        </p>

    @endforelse

</div>

@endsection