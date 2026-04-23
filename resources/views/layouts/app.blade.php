<!DOCTYPE html>
<html>
<head>
    <title>BelajarIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex">

    <!-- SIDEBAR -->
    <div id="sidebar"
        class="bg-white h-screen p-5 shadow-md transition-all duration-300 w-64">

        <!-- LOGO -->
        <div class="flex justify-between items-center mb-6">
            <h2 id="logoText" class="text-xl font-bold">📘 BelajarIn</h2>
            <button onclick="toggleSidebar()">☰</button>
        </div>

        <!-- MENU -->
        <nav class="space-y-2 text-sm">

            @auth

                <a href="/dashboard" class="block px-3 py-2 rounded hover:bg-gray-100">Dashboard</a>

                {{-- SISWA & MENTOR --}}
                @if(auth()->user()->role == 'siswa' || auth()->user()->role == 'mentor')
                    <a href="/courses" class="block px-3 py-2 rounded hover:bg-gray-100">Courses</a>
                    <a href="/assignment" class="block px-3 py-2 rounded hover:bg-gray-100">Tugas</a>
                    <a href="/forum" class="block px-3 py-2 rounded hover:bg-gray-100">Forum</a>
                    <a href="/qna" class="block px-3 py-2 rounded hover:bg-gray-100">QnA</a>
                @endif

                {{-- SISWA ONLY --}}
                @if(auth()->user()->role == 'siswa')
                    <a href="/quiz" class="block px-3 py-2 rounded hover:bg-gray-100">Quiz</a>
                    <a href="/payment" class="block px-3 py-2 rounded hover:bg-gray-100">Payment</a>
                @endif

                {{-- ADMIN ONLY --}}
                @if(auth()->user()->role == 'admin')
                    <a href="/admin/users" class="block px-3 py-2 rounded hover:bg-gray-100">
                        Manajemen User
                    </a>

                    <a href="/report" class="block px-3 py-2 rounded hover:bg-gray-100">
                        Report
                    </a>
                @endif

                {{-- SEMUA ROLE --}}
                <a href="/profile" class="block px-3 py-2 rounded hover:bg-gray-100">Profile</a>

                {{-- LOGOUT --}}
                <form action="/logout" method="POST">
                    @csrf
                    <button class="w-full text-left px-3 py-2 rounded hover:bg-red-100 text-red-500">
                        Logout
                    </button>
                </form>

            @endauth

        </nav>

    </div>

    <!-- CONTENT -->
    <div id="mainContent" class="flex-1 p-6 transition-all duration-300">
        @yield('content')
    </div>

</div>

<!-- SCRIPT -->
<script>
function toggleSidebar() {
    let sidebar = document.getElementById('sidebar');
    let logo = document.getElementById('logoText');

    if (sidebar.classList.contains('w-64')) {
        sidebar.classList.remove('w-64');
        sidebar.classList.add('w-20');
        logo.style.display = 'none';
    } else {
        sidebar.classList.remove('w-20');
        sidebar.classList.add('w-64');
        logo.style.display = 'block';
    }
}
</script>

</body>
</html>