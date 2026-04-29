@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Profile</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white p-6 rounded-xl shadow max-w-lg">

    <!-- FORM UPDATE -->
    <form id="updateForm" method="POST" action="/profile">
        @csrf

        <div class="mb-4">
            <label>Name</label>
            <input type="text" name="name"
                value="{{ old('name', $user->name) }}"
                value="{{ $user->name }}"
                class="w-full border rounded px-3 py-2">
                class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email"

                value="{{ old('email', $user->email) }}"
                value="{{ $user->email }}"
                class="w-full border rounded px-3 py-2">
                class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1">New Password</label>
            <label class="block mb-1">New Password (optional)</label>
            <label>Password</label>
            <input type="password" name="password"
                class="w-full border px-3 py-2 rounded">
        </div>
    </form>

    <!-- BUTTON AREA -->
    <div class="flex justify-between mt-6">

        <!-- LOGOUT -->
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="text-red-500 hover:text-red-700">
                Logout
            </button>
        </form>

        <!-- UPDATE -->
        <button type="submit" form="updateForm"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Update Profile
        </button>

    <!-- UPDATE -->
    <button type="submit" form="updateForm"
        class="bg-blue-500 text-white px-4 py-2 rounded">
        Update Profile
    </button>

</div>
        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Update Profile
        </button>

    </form>
    </div>

</div>

@endsection