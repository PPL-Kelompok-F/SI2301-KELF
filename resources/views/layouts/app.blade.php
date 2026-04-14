<!DOCTYPE html>
<html>
<head>
    <title>BelajarIn</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="flex">

    <!-- SIDEBAR -->
    <div class="w-64 h-screen bg-white shadow-md fixed p-5">

        <h2 class="text-xl font-bold mb-6">📘 BelajarIn</h2>

        <nav class="space-y-2">
            <a href="#" class="block bg-indigo-500 text-white px-4 py-2 rounded-lg">Dashboard</a>
            <a href="#" class="block text-gray-600 hover:bg-gray-100 px-4 py-2 rounded-lg">Courses</a>
            <a href="#" class="block text-gray-600 hover:bg-gray-100 px-4 py-2 rounded-lg">Quiz</a>
            <a href="#" class="block text-gray-600 hover:bg-gray-100 px-4 py-2 rounded-lg">Discussion</a>
            <a href="#" class="block text-gray-600 hover:bg-gray-100 px-4 py-2 rounded-lg">Profile</a>
        </nav>

    </div>

    <!-- CONTENT -->
    <div class="ml-64 w-full p-6">
        @yield('content')
    </div>

</div>

</body>
</html>