<!DOCTYPE html>
<html>
<head>
    <title>Register - BelajarIn</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">

        <h2 class="text-2xl font-bold mb-2">Create Account</h2>
        <p class="text-gray-500 text-sm mb-6">
            Start your learning journey 🚀
        </p>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-2 rounded mb-3">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- NAME -->
            <div class="mb-4">
                <label>Name</label>
                <input type="text" name="name"
                    class="w-full mt-1 px-4 py-2 border rounded-lg" required>
            </div>

            <!-- ROLE -->
            <div class="mb-4">
                <label class="block mb-2">Register as</label>

                <select name="role"
                    class="w-full px-4 py-2 border rounded-lg">
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                </select>
            </div>

            <!-- EMAIL -->
            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email"
                    class="w-full mt-1 px-4 py-2 border rounded-lg" required>
            </div>

            <!-- PASSWORD -->
            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password"
                    class="w-full mt-1 px-4 py-2 border rounded-lg" required>
            </div>

            <!-- CONFIRM -->
            <div class="mb-4">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full mt-1 px-4 py-2 border rounded-lg" required>
            </div>

            <!-- BUTTON -->
            <button class="w-full bg-black text-white py-2 rounded-lg">
                Register
            </button>

        </form>

        <p class="text-center text-sm mt-4">
            Already have an account?
            <a href="/login" class="text-indigo-500">Login</a>
        </p>

    </div>

</div>

</body>
</html>