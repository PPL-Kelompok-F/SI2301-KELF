@extends('layouts.student.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">
    Assignments Page
</h1>

<p class="mb-4">Ini halaman daftar tugas</p>

@if(session('success'))
    <div class="bg-green-200 p-2 mb-2 rounded">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-200 p-2 mb-2 rounded">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white p-4 rounded shadow">

    <table class="w-full">

        <thead>
            <tr class="border-b">
                <th>Title</th>
                <th>Class</th>
                <th>Deadline</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        @foreach($assignments as $a)
            <tr class="border-b">

                <td>{{ $a->title }}</td>
                <td>{{ $a->classroom->name ?? '-' }}</td>
                <td>{{ $a->deadline }}</td>

                <td>
                    <a href="/student/submissions/{{ $a->id }}/create"
                       class="text-blue-500">
                        Submit
                    </a>
                </td>

            </tr>
        @endforeach

        </tbody>

    </table>

</div>

@endsection