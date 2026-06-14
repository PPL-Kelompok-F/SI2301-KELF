<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - BelajarIn</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
        <h2 class="text-2xl font-bold mb-2">Admin Login</h2>
        <p class="text-gray-500 text-sm mb-6">Login menggunakan akun admin khusus.</p>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-2 rounded mb-3">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-600 p-2 rounded mb-3">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="mb-4">
                <label class="text-sm">Email</label>
                <input type="email" name="email" class="w-full mt-1 px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="text-sm">Password</label>
                <input type="password" name="password" class="w-full mt-1 px-4 py-2 border rounded-lg" required>
            </div>
            <div class="flex items-center justify-between mb-4 text-sm">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>
            <button type="submit" class="w-full bg-black text-white py-2 rounded-lg">Login</button>
        </form>

        <p class="text-center text-sm mt-4">
            Kembali ke <a href="/login" class="text-indigo-500">Login umum</a>
        </p>
    </div>
</div>
</body>
</html>
