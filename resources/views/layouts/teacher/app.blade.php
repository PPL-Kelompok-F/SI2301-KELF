<!DOCTYPE html>
<html>
<head>
    <title>Teacher - BelajarIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100">

<div x-data="{ show: false }" class="flex h-screen">

    <!-- SIDEBAR -->
    <nav @mouseover="show = true"
         @mouseleave="show = false"
         class="flex flex-col justify-between bg-gray-800 text-gray-100 transition-all duration-300"
         :class="show ? 'w-56' : 'w-16'">

        <!-- BRAND -->
        <div class="flex items-center h-16 font-bold space-x-2 px-2">
            <span class="text-green-400 text-xl">👨‍🏫</span>
            <span x-show="show">Teacher</span>
        </div>

        <!-- MENU -->
        <div class="flex flex-col space-y-2 px-2">

            <a href="/teacher/dashboard"
               class="flex items-center space-x-2 px-2 py-2 rounded hover:bg-green-500"
               :class="{'justify-center': !show}">
                <span>🏠</span>
                <span x-show="show">Dashboard</span>
            </a>

            <a href="#"
               class="flex items-center space-x-2 px-2 py-2 rounded hover:bg-green-500"
               :class="{'justify-center': !show}">
                <span>📚</span>
                <span x-show="show">Manage Courses</span>
            </a>

            <a href="#"
               class="flex items-center space-x-2 px-2 py-2 rounded hover:bg-green-500"
               :class="{'justify-center': !show}">
                <span>📝</span>
                <span x-show="show">Assignments</span>
            </a>

        </div>

        <!-- BOTTOM -->
        <div class="flex flex-col space-y-2 px-2 mb-4">

            <a href="#"
               class="flex items-center space-x-2 px-2 py-2 rounded hover:bg-green-500"
               :class="{'justify-center': !show}">
                <span>👤</span>
                <span x-show="show">Profile</span>
            </a>

            <form method="POST" action="/logout">
                @csrf
                <button type="submit"
                        class="w-full flex items-center space-x-2 px-2 py-2 rounded hover:bg-red-500"
                        :class="{'justify-center': !show}">
                    <span>🚪</span>
                    <span x-show="show">Logout</span>
                </button>
            </form>

        </div>

    </nav>

    <!-- CONTENT -->
    <div class="flex-1">

        <!-- TOPBAR -->
        <div class="flex justify-between items-center px-6 py-3 bg-white shadow">
            <h1 class="font-bold">Teacher Dashboard</h1>

            <div class="flex items-center gap-3">
                <span>{{ auth()->user()->name }}</span>
                <img src="https://picsum.photos/100" class="w-8 h-8 rounded-full">
            </div>
        </div>

        <!-- MAIN -->
        <div class="p-6">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>