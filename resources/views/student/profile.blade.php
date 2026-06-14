@extends('layouts.student.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Profil Student</h1>
        <a href="/student/dashboard" class="text-sm text-gray-500 hover:text-gray-700">← Kembali ke Dashboard</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-gray-50 p-4 rounded-xl flex items-center space-x-6">
            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://picsum.photos/100' }}" 
                 class="w-20 h-20 rounded-full object-cover border-2 border-indigo-500 shadow-md">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Profil Baru</label>
                <input type="file" name="avatar" accept="image/*" 
                       class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <p class="text-xs text-gray-400 mt-1">Format: JPG, JPEG, PNG (Maks. 2MB)</p>
                @error('avatar')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap / Username</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            <p class="text-xs text-gray-400 mt-1">Wajib menggunakan domain resmi seperti @gmail.com</p>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="border-t border-gray-200 pt-6">
            <h2 class="text-lg font-bold text-gray-800 mb-2">Keamanan & Password</h2>
            <p class="text-xs text-gray-400 mb-4">Kosongkan kolom di bawah jika Anda tidak ingin mengubah password saat ini.</p>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Password Lama</label>
            <input type="password" name="current_password" placeholder="Masukkan password saat ini"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            @error('current_password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Password Baru</label>
                <input type="password" name="new_password" placeholder="Minimal 6 karakter"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                @error('new_password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password Baru</label>
                <input type="password" name="new_password_confirmation" placeholder="Ulangi password baru"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-2.5 rounded-lg shadow transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection