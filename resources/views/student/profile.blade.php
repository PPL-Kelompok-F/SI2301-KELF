@extends('layouts.student.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">Profile Settings</h1>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR SESSION --}}
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- VALIDATION ERROR --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- LEFT -->
        <div class="bg-white p-6 rounded-2xl shadow text-center">

            @if($user->photo)
                <img src="{{ asset('storage/'.$user->photo) }}"
                    class="w-32 h-32 rounded-full object-cover mx-auto mb-4 border">
            @else
                <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center mx-auto mb-4">
                    No Photo
                </div>
            @endif

            <h2 class="font-semibold text-lg">{{ $user->name }}</h2>
            <p class="text-gray-500 text-sm">{{ $user->email }}</p>

        </div>

        <!-- RIGHT -->
        <div class="md:col-span-2 bg-white p-6 rounded-2xl shadow">

            <form method="POST"
                  action="{{ url('/student/profile') }}"
                  enctype="multipart/form-data">

                @csrf

                <!-- NAME -->
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Name</label>

                    <input type="text"
                           name="name"
                           value="{{ old('name', $user->name) }}"
                           class="w-full border rounded-lg px-3 py-2">
                </div>

                <!-- EMAIL -->
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Email</label>

                    <input type="email"
                           name="email"
                           value="{{ old('email', $user->email) }}"
                           class="w-full border rounded-lg px-3 py-2">
                </div>

                <!-- PHOTO -->
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Photo</label>

                    <input type="file"
                           name="photo"
                           class="w-full border rounded-lg px-3 py-2">

                    @error('photo')
                        <div class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <hr class="my-6">

                <h2 class="font-semibold mb-4 text-lg">
                    Change Password
                </h2>

                <!-- OLD PASSWORD -->
                <div class="mb-4">
                    <label>Password Lama</label>

                    <input type="password"
                           name="old_password"
                           class="w-full border rounded-lg px-3 py-2">
                </div>

                <!-- NEW PASSWORD -->
                <div class="mb-4">
                    <label>Password Baru</label>

                    <input type="password"
                           name="password"
                           class="w-full border rounded-lg px-3 py-2">
                </div>

                <!-- CONFIRM -->
                <div class="mb-6">
                    <label>Konfirmasi Password</label>

                    <input type="password"
                           name="password_confirmation"
                           class="w-full border rounded-lg px-3 py-2">
                </div>

                <!-- BUTTON -->
                <button type="submit"
                        class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-2 rounded-lg">
                    Save Changes
                </button>

            </form>

        </div>

    </div>

</div>

@endsection