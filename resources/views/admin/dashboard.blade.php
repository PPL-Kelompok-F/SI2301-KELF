@extends('layouts.admin.app')

@section('content')

<div class="grid grid-cols-3 gap-4">

    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-gray-500">Total Users</h2>
        <p class="text-2xl font-bold">250</p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-gray-500">Teachers</h2>
        <p class="text-2xl font-bold">15</p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-gray-500">Students</h2>
        <p class="text-2xl font-bold">235</p>
    </div>

</div>

@endsection