<!DOCTYPE html>
<html>
<head>
    <title>BelajarIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>


<script>


function increaseFont() {

    let size =
        parseFloat(
            getComputedStyle(document.documentElement)
            .fontSize
        );

    document.documentElement.style.fontSize =
        (size + 2) + 'px';
}

function toggleMotion() {
    document.body.classList.toggle('reduce-motion');
}

function readPage() {

    if (!('speechSynthesis' in window)) {
        alert('Browser tidak mendukung text-to-speech');
        return;
    }

    speechSynthesis.cancel();

    const speech = new SpeechSynthesisUtterance(
        document.body.innerText
    );

    speech.lang = 'id-ID';

    speechSynthesis.speak(speech);
}

document.addEventListener('DOMContentLoaded', () => {

    if(localStorage.getItem('darkMode') === 'true'){
        document.body.classList.add('dark-mode');
    }

    if(localStorage.getItem('highContrast') === 'true'){
        document.body.classList.add('high-contrast');
    }

    if(localStorage.getItem('reduceMotion') === 'true'){
        document.body.classList.add('reduce-motion');
    }

});

// Dark Mode
function toggleDarkMode() {

    document.body.classList.toggle('dark-mode');

    localStorage.setItem(
        'darkMode',
        document.body.classList.contains('dark-mode')
    );
}

// High Contrast
function toggleContrast() {

    document.body.classList.toggle('high-contrast');

    localStorage.setItem(
        'highContrast',
        document.body.classList.contains('high-contrast')
    );
}

// Reduce Motion
function toggleMotion() {

    document.body.classList.toggle('reduce-motion');

    localStorage.setItem(
        'reduceMotion',
        document.body.classList.contains('reduce-motion')
    );
}


</script>

<body class="bg-gray-100">

<div x-data="{ open:false }">

    <!-- Floating Button -->
    <button
        @click="open=!open"
        class="fixed bottom-5 right-5 w-14 h-14 rounded-full bg-blue-600 text-white shadow-lg z-50">

        <i class="fa-solid fa-universal-access text-xl"></i>

    </button>

    <!-- Panel -->
    <div x-show="open"
         class="fixed bottom-24 right-5 w-72 bg-white rounded-xl shadow-xl p-4 z-50">

        <h3 class="font-bold mb-3">
            Aksesibilitas
        </h3>

        <div class="space-y-3">

            <button onclick="increaseFont()"
                    class="w-full bg-gray-100 p-2 rounded">
                <i class="fa-solid fa-magnifying-glass"></i> Perbesar Font
            </button>

            <button onclick="readPage()"
                    class="w-full bg-gray-100 p-2 rounded">
                <i class="fa-solid fa-headphones"></i> Suarakan Halaman
            </button>

            <button onclick="speechSynthesis.cancel()"
                    class="w-full bg-red-100 p-2 rounded">
                <i class="fa-solid fa-stop"></i> Hentikan Suara
            </button>
        </div>

    </div>

</div>

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