<!DOCTYPE html>
<html>
<head>
    <title>BelajarIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gray-100">

<div x-data="{ show: false }" class="flex h-screen">

    <!-- SIDEBAR -->
    <nav @mouseenter="show = true"
         @mouseleave="show = false"
         class="flex flex-col justify-between bg-gray-800 text-gray-100 transition-all duration-300 overflow-hidden"
         :class="show ? 'w-56' : 'w-16'">

        <!-- BRAND -->
        <div>
            <div class="flex items-center h-16 px-5 gap-3 font-bold">
                <span class="text-blue-400 text-lg w-5 flex-shrink-0 flex justify-center">
                    <i class="fa-solid fa-user-graduate"></i>
                </span>
                <span x-show="show" x-transition.opacity>BelajarIn</span>
            </div>

            <!-- MENU -->
            <div class="flex flex-col gap-1 px-2">

                <a href="/student/dashboard"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-md text-gray-300 hover:bg-blue-500 hover:text-white transition-colors">
                    <span class="w-5 flex justify-center flex-shrink-0"><i class="fa-solid fa-house"></i></span>
                    <span x-show="show" x-transition.opacity>Dashboard</span>
                </a>

                <a href="/student/courses"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-md text-gray-300 hover:bg-blue-500 hover:text-white transition-colors">
                    <span class="w-5 flex justify-center flex-shrink-0"><i class="fa-solid fa-book-open"></i></span>
                    <span x-show="show" x-transition.opacity>Courses</span>
                </a>

                <a href="/student/assignment"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-md text-gray-300 hover:bg-blue-500 hover:text-white transition-colors">
                    <span class="w-5 flex justify-center flex-shrink-0"><i class="fa-solid fa-pen"></i></span>
                    <span x-show="show" x-transition.opacity>Assignment</span>
                </a>

            </div>
        </div>

        <!-- BOTTOM MENU -->
        <div class="flex flex-col gap-1 px-2 mb-4">

            <a href="/student/profile"
               class="flex items-center gap-2.5 px-3 py-2 rounded-md text-gray-300 hover:bg-blue-500 hover:text-white transition-colors">
                <span class="w-5 flex justify-center flex-shrink-0"><i class="fa-solid fa-circle-user"></i></span>
                <span x-show="show" x-transition.opacity>Profile</span>
            </a>

            <a href="/student/settings"
               class="flex items-center gap-2.5 px-3 py-2 rounded-md text-gray-300 hover:bg-blue-500 hover:text-white transition-colors">
                <span class="w-5 flex justify-center flex-shrink-0"><i class="fa-solid fa-gear"></i></span>
                <span x-show="show" x-transition.opacity>Settings</span>
            </a>

            <hr class="border-gray-700 my-1">

            <!-- LOGOUT -->
            <form method="POST" action="/logout">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-2.5 px-3 py-2 rounded-md text-gray-300 hover:bg-red-500 hover:text-white transition-colors">
                    <span class="w-5 flex justify-center flex-shrink-0"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                    <span x-show="show" x-transition.opacity>Logout</span>
                </button>
            </form>

        </div>

    </nav>

    <!-- CONTENT -->
    <div class="flex-1 bg-gray-100">

        <!-- TOPBAR -->
        <div class="flex justify-between items-center px-6 py-3 bg-white shadow">
            <h1 class="font-bold">Dashboard</h1>
            <div class="flex items-center gap-3">
                <span>{{ auth()->user()->name }}</span>
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