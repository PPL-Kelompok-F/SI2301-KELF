<!DOCTYPE html>
<html>
<head>
    <title>Login - BelajarIn</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex">

    <!-- LEFT -->
    <div class="hidden md:flex w-1/2 relative">
        <!-- <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e" -->
             class="absolute w-full h-full object-cover">

        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <div class="relative text-white p-10 flex flex-col justify-end">
            <h1 class="text-3xl font-bold mb-2">
                Edit Smarter. Export Faster.
            </h1>
            <p class="text-sm text-gray-200">
                Create Anywhere. Build your LMS.
            </p>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="w-full md:w-1/2 flex items-center justify-center">

        <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">

            <h2 class="text-2xl font-bold mb-2">Welcome Back!</h2>
            <p class="text-gray-500 text-sm mb-6">
                Login to start your learning
            </p>

            <!-- ERROR -->
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

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- ROLE -->
                <div class="mb-4">
                    <label class="text-sm mb-2 block">Sign in as</label>

                    <div class="grid grid-cols-2 gap-2">

                        <button type="button"
                            onclick="setRole(event, 'student')"
                            class="role-btn bg-indigo-500 text-white py-2 rounded-lg">
                            Student
                        </button>

                        <button type="button"
                            onclick="setRole(event, 'teacher')"
                            class="role-btn bg-gray-100 py-2 rounded-lg">
                            Teacher
                        </button>

                    </div>
                </div>

                <!-- HIDDEN ROLE -->
                <input type="hidden" name="role" id="role" value="student">

                <!-- EMAIL -->
                <div class="mb-4">
                    <label class="text-sm">Email</label>
                    <input type="email" name="email"
                        class="w-full mt-1 px-4 py-2 border rounded-lg"
                        required>
                </div>

                <!-- PASSWORD -->
                <div class="mb-4">
                    <label class="text-sm">Password</label>
                    <input type="password" name="password"
                        class="w-full mt-1 px-4 py-2 border rounded-lg"
                        required>
                </div>

                <!-- REMEMBER -->
                <div class="flex justify-between items-center mb-4 text-sm">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full bg-black text-white py-2 rounded-lg">
                    Login
                </button>

            </form>

            <!-- REGISTER -->
            <p class="text-center text-sm mt-4">
                Don't have an account?
                <a href="/register" class="text-indigo-500 font-medium">
                    Sign up here
                </a>
            </p>

        </div>
    </div>

</div>

<!-- SCRIPT FIX -->
<script>
function setRole(e, role) {
    document.getElementById('role').value = role;

    document.querySelectorAll('.role-btn').forEach(btn => {
        btn.classList.remove('bg-indigo-500', 'text-white');
        btn.classList.add('bg-gray-100');
    });

    e.target.classList.remove('bg-gray-100');
    e.target.classList.add('bg-indigo-500', 'text-white');
}
</script>

</body>
</html>