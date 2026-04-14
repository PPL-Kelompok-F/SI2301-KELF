@extends('layouts.app')

@section('content')

<!-- TOP BAR -->
<div class="flex justify-between items-center mb-6">

    <!-- SEARCH -->
    <input type="text" placeholder="Search..."
        class="bg-gray-100 px-4 py-2 rounded-lg w-1/3">

    <!-- PROFILE -->
    <div class="flex items-center gap-4">
        <span class="text-xl">🔔</span>
        <div class="flex items-center gap-2">
            <img src="https://i.pravatar.cc/40" class="rounded-full">
            <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
        </div>
    </div>
</div>

<!-- WELCOME + PROGRESS -->
<div class="grid grid-cols-2 gap-4 mb-6">

    <!-- WELCOME -->
    <div class="bg-white p-5 rounded-xl shadow">
        <h3 class="text-lg font-semibold">
            Welcome back, {{ auth()->user()->name }} 👋
        </h3>
        <p class="text-gray-500 text-sm mt-2">
            You've learned 80% of your goal this week. Keep it up!
        </p>
    </div>

    <!-- PROGRESS -->
    <div class="bg-white p-5 rounded-xl shadow">
        <h4 class="text-sm text-gray-500">Your Progress</h4>

        <div class="w-full bg-gray-200 rounded-full h-2 mt-3">
            <div class="bg-indigo-500 h-2 rounded-full w-[65%]"></div>
        </div>

        <p class="text-right text-sm mt-1">65%</p>
    </div>

</div>

<!-- STREAK -->
<div class="bg-white p-5 rounded-xl shadow mb-6">
    <h4 class="font-semibold text-lg">🔥 5 Day Streak</h4>
    <p class="text-gray-500 text-sm">
        Stay consistent and reach your weekly goal
    </p>

    <div class="flex gap-3 mt-4">
        <div class="bg-orange-400 text-white px-3 py-1 rounded-full">Mon</div>
        <div class="bg-orange-400 text-white px-3 py-1 rounded-full">Tue</div>
        <div class="bg-orange-400 text-white px-3 py-1 rounded-full">Wed</div>
        <div class="bg-orange-400 text-white px-3 py-1 rounded-full">Thu</div>
        <div class="bg-orange-400 text-white px-3 py-1 rounded-full">Fri</div>
        <div class="bg-gray-200 px-3 py-1 rounded-full">Sat</div>
        <div class="bg-gray-200 px-3 py-1 rounded-full">Sun</div>
    </div>
</div>

<!-- COURSES -->
<div class="mb-6">

    <div class="flex justify-between mb-3">
        <h4 class="font-semibold text-lg">Active Courses</h4>
        <a href="#" class="text-indigo-500 text-sm">View All</a>
    </div>

    <div class="grid grid-cols-3 gap-4">

        <!-- COURSE CARD -->
        <div class="bg-white rounded-xl shadow p-3">
            <img src="https://via.placeholder.com/300x150" class="rounded-lg mb-2">

            <p class="text-xs text-gray-400">DESIGN</p>
            <h5 class="font-semibold">Advanced UI/UX</h5>

            <div class="w-full bg-gray-200 h-2 rounded mt-2">
                <div class="bg-indigo-500 h-2 rounded w-[45%]"></div>
            </div>

            <button class="mt-3 w-full bg-indigo-500 text-white py-2 rounded-lg">
                Continue Learning
            </button>
        </div>

        <div class="bg-white rounded-xl shadow p-3">
            <img src="https://via.placeholder.com/300x150" class="rounded-lg mb-2">

            <p class="text-xs text-gray-400">DEVELOPMENT</p>
            <h5 class="font-semibold">Full-Stack Web</h5>

            <div class="w-full bg-gray-200 h-2 rounded mt-2">
                <div class="bg-green-500 h-2 rounded w-[82%]"></div>
            </div>

            <button class="mt-3 w-full bg-indigo-500 text-white py-2 rounded-lg">
                Continue Learning
            </button>
        </div>

        <div class="bg-white rounded-xl shadow p-3">
            <img src="https://via.placeholder.com/300x150" class="rounded-lg mb-2">

            <p class="text-xs text-gray-400">DATA</p>
            <h5 class="font-semibold">Data Analytics</h5>

            <div class="w-full bg-gray-200 h-2 rounded mt-2">
                <div class="bg-yellow-400 h-2 rounded w-[12%]"></div>
            </div>

            <button class="mt-3 w-full bg-indigo-500 text-white py-2 rounded-lg">
                Continue Learning
            </button>
        </div>

    </div>

</div>

<!-- MONTHLY REPORT -->
<div class="bg-white p-5 rounded-xl shadow">

    <h4 class="font-semibold text-lg mb-4">Monthly Report</h4>

    <div class="grid grid-cols-3 text-center">
        <div>
            <h3 class="text-xl font-bold">24</h3>
            <p class="text-gray-500 text-sm">Lessons</p>
        </div>

        <div>
            <h3 class="text-xl font-bold">92%</h3>
            <p class="text-gray-500 text-sm">Quiz Score</p>
        </div>

        <div>
            <h3 class="text-xl font-bold">18h</h3>
            <p class="text-gray-500 text-sm">Study Time</p>
        </div>
    </div>

</div>

@endsection