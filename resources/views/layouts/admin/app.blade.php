<!DOCTYPE html>
<html>
<head>
    <title>BelajarIn - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100">
<div x-data="{ open:false }">
    <button
        @click="open=!open"
        class="fixed bottom-5 right-5 w-14 h-14 rounded-full bg-blue-600 text-white shadow-lg z-50">
        <i class="fa-solid fa-user-shield text-xl"></i>
    </button>

    <div x-show="open"
         class="fixed bottom-24 right-5 w-72 bg-white rounded-xl shadow-xl p-4 z-50">
        <h3 class="font-bold mb-3">Aksesibilitas</h3>
        <div class="space-y-3">
            <button onclick="document.documentElement.style.fontSize = (parseFloat(getComputedStyle(document.documentElement).fontSize) + 2) + 'px'"
                    class="w-full bg-gray-100 p-2 rounded">
                <i class="fa-solid fa-magnifying-glass"></i> Perbesar Font
            </button>
            <button onclick="speechSynthesis.cancel(); const speech = new SpeechSynthesisUtterance(document.body.innerText); speech.lang='id-ID'; speechSynthesis.speak(speech);"
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
    <nav @mouseenter="show = true"
         @mouseleave="show = false"
         class="flex flex-col justify-between bg-gray-900 text-gray-100 transition-all duration-300 overflow-hidden"
         :class="show ? 'w-60' : 'w-16'">
        <div>
            <div class="flex items-center h-16 px-5 gap-3 font-bold">
                <span class="text-blue-400 text-lg w-5 flex-shrink-0 flex justify-center">
                    <i class="fa-solid fa-shield-halved"></i>
                </span>
                <span x-show="show" x-transition.opacity>BelajarIn Admin</span>
            </div>
            <div class="flex flex-col gap-1 px-2">
                <a href="/admin/dashboard"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-md text-gray-300 hover:bg-blue-500 hover:text-white transition-colors">
                    <span class="w-5 flex justify-center flex-shrink-0"><i class="fa-solid fa-house"></i></span>
                    <span x-show="show" x-transition.opacity>Dashboard</span>
                </a>
                <a href="/admin/classrooms"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-md text-gray-300 hover:bg-blue-500 hover:text-white transition-colors">
                    <span class="w-5 flex justify-center flex-shrink-0"><i class="fa-solid fa-school"></i></span>
                    <span x-show="show" x-transition.opacity>Classrooms</span>
                </a>
                <a href="/admin/users"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-md text-gray-300 hover:bg-blue-500 hover:text-white transition-colors">
                    <span class="w-5 flex justify-center flex-shrink-0"><i class="fa-solid fa-users"></i></span>
                    <span x-show="show" x-transition.opacity>Users</span>
                </a>
            </div>
        </div>

        <div class="flex flex-col gap-1 px-2 mb-4">
            <div class="px-3 py-3 text-gray-300">
                <div class="font-semibold">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="text-xs text-gray-400">{{ auth()->user()->email ?? '' }}</div>
            </div>
            <hr class="border-gray-700 my-1">
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

    <div class="flex-1 bg-gray-100">
        <div class="flex justify-between items-center px-6 py-3 bg-white shadow">
            <h1 class="font-bold">Admin Dashboard</h1>
            <div class="flex items-center gap-3">
                <span>{{ auth()->user()->name ?? 'Admin' }}</span>
            </div>
        </div>
        <div class="p-6">
            @if(session('success') || session('error'))
                <div x-data="{ open: true }" x-show="open" x-transition class="mb-6">
                    <div class="flex items-start justify-between gap-4 rounded-3xl border p-4 text-sm shadow-sm
                        {{ session('success') ? 'bg-emerald-50 border-emerald-200 text-emerald-700' : 'bg-red-50 border-red-200 text-red-700' }}">
                        <div class="flex items-start gap-3">
                            <span class="mt-1 text-lg">
                                <i class="fa-solid {{ session('success') ? 'fa-circle-check' : 'fa-triangle-exclamation' }}"></i>
                            </span>
                            <div>
                                <p class="font-semibold">{{ session('success') ? 'Berhasil' : 'Gagal' }}</p>
                                <p>{{ session('success') ?? session('error') }}</p>
                            </div>
                        </div>
                        <button type="button" @click="open = false" class="text-current opacity-70 hover:opacity-100">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
