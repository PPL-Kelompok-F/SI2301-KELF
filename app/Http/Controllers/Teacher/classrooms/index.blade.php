@extends('layouts.teacher.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    My Classrooms
</h1>

<div class="grid grid-cols-2 gap-4">

    @forelse($classrooms as $classroom)

        <div class="bg-white p-5 rounded shadow">

            <h2 class="font-bold text-lg">
                {{ $classroom->name }}
            </h2>

            <p class="text-gray-500 mt-2">
                {{ $classroom->description }}
            </p>

        </div>

    @empty

        <div class="bg-white p-5 rounded shadow">

            Belum ada classroom.

        </div>

    @endforelse

</div>

@endsection