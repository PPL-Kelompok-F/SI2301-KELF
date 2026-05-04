@extends('layouts.student.app')

@section('content')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&display=swap');

    .dash-body { font-family: 'DM Sans', sans-serif; }

    .stat-card { transition: transform .2s, box-shadow .2s; }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.08); }

    .course-card { transition: transform .2s, box-shadow .2s; }
    .course-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(99,102,241,.12); }

    .streak-fire { display: inline-block; animation: flicker 1.5s ease-in-out infinite alternate; }
    @keyframes flicker {
        0%   { transform: scale(1) rotate(-3deg); }
        100% { transform: scale(1.15) rotate(3deg); }
    }

    .dot-done  { background: #f97316; border-color: #f97316; box-shadow: 0 0 10px #f9731655; }
    .dot-today { border-color: #6366f1; border-width: 2px; background: #eef2ff; }
    .dot-missed{ background: #f3f4f6; border-color: #e5e7eb; }

    .prog-bar-fill { transition: width .6s cubic-bezier(.4,0,.2,1); }
</style>
@endpush

<div class="dash-body">

    {{-- GREETING --}}
    <h1 class="text-2xl font-extrabold mb-6" style="font-family:'Sora',sans-serif;">
        Halo, <span class="text-indigo-500">{{ $user->name }}</span> 👋
    </h1>

    {{-- STAT CARDS --}}
    <div class="grid grid-cols-3 gap-4 mb-6">

        <div class="stat-card bg-white rounded-2xl p-5 shadow-sm border border-gray-100 relative overflow-hidden">
            <div class="absolute -top-4 -right-4 w-16 h-16 rounded-full bg-orange-100 opacity-60"></div>
            <p class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-1">🔥 Streak</p>
            <p class="text-3xl font-extrabold text-gray-900" style="font-family:'Sora',sans-serif;">
                {{ $streak ?? 0 }} <span class="text-lg font-semibold text-gray-400">hari</span>
            </p>
        </div>

        <div class="stat-card bg-white rounded-2xl p-5 shadow-sm border border-gray-100 relative overflow-hidden">
            <div class="absolute -top-4 -right-4 w-16 h-16 rounded-full bg-emerald-100 opacity-60"></div>
            <p class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-1">📚 Courses</p>
            <p class="text-3xl font-extrabold text-gray-900" style="font-family:'Sora',sans-serif;">
                {{ $courses->count() }}
            </p>
        </div>

        <div class="stat-card bg-white rounded-2xl p-5 shadow-sm border border-gray-100 relative overflow-hidden">
            <div class="absolute -top-4 -right-4 w-16 h-16 rounded-full bg-indigo-100 opacity-60"></div>
            <p class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-1">⭐ Avg Score</p>
            <p class="text-3xl font-extrabold text-gray-900" style="font-family:'Sora',sans-serif;">
                {{ round($avgScore ?? 0) }}
            </p>
        </div>

    </div>

    {{-- STREAK WIDGET (Duolingo style) --}}
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-indigo-100 mb-6">
        <div class="flex items-center justify-between mb-4">
            <p class="font-bold text-gray-700" style="font-family:'Sora',sans-serif;">Weekly Streak</p>
            <div class="flex items-center gap-2 bg-orange-50 border border-orange-200 rounded-xl px-4 py-2">
                <span class="streak-fire text-2xl">🔥</span>
                <div>
                    <p class="text-2xl font-extrabold text-orange-500 leading-none" style="font-family:'Sora',sans-serif;">
                        {{ $streak ?? 0 }}
                    </p>
                    <p class="text-xs text-orange-400">hari berturut</p>
                </div>
            </div>
        </div>

        {{-- 7-day dots --}}
        @php
            $days  = ['Sen','Sel','Rab','Kam','Jum','Sab','Min'];
            $today = now()->dayOfWeekIso; // 1=Mon … 7=Sun
        @endphp
        <div class="flex justify-between gap-2">
            @foreach($days as $i => $day)
                @php
                    $dayNum  = $i + 1;
                    $isDone  = $dayNum < $today;
                    $isToday = $dayNum === $today;
                @endphp
                <div class="flex flex-col items-center gap-1 flex-1">
                    <div class="w-9 h-9 rounded-full border-2 flex items-center justify-center text-sm font-bold
                        {{ $isDone  ? 'dot-done text-white'       : '' }}
                        {{ $isToday ? 'dot-today text-indigo-600' : '' }}
                        {{ (!$isDone && !$isToday) ? 'dot-missed text-gray-300' : '' }}">
                        {{ $isDone ? '✓' : ($isToday ? '🔥' : '') }}
                    </div>
                    <span class="text-xs {{ $isToday ? 'text-indigo-500 font-semibold' : 'text-gray-400' }}">
                        {{ $day }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- MY COURSES --}}
    <div class="flex items-baseline justify-between mb-3">
        <h2 class="font-bold text-gray-800" style="font-family:'Sora',sans-serif;">My Courses</h2>
        <a href="/student/courses" class="text-xs text-indigo-500 hover:underline">Lihat semua →</a>
    </div>

    @if($courses->isEmpty())
        <p class="text-gray-400 text-sm mb-4">Belum ambil course apapun.</p>
    @endif

    @php
        $accents = [
            ['from' => '#818cf8', 'to' => '#6366f1', 'light' => '#eef2ff', 'btn' => 'bg-indigo-500 hover:bg-indigo-600'],
            ['from' => '#34d399', 'to' => '#059669', 'light' => '#ecfdf5', 'btn' => 'bg-emerald-500 hover:bg-emerald-600'],
            ['from' => '#fb923c', 'to' => '#ef4444', 'light' => '#fff7ed', 'btn' => 'bg-orange-500 hover:bg-orange-600'],
        ];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($courses as $i => $course)
            @php $accent = $accents[$i % count($accents)]; @endphp

            <div class="course-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden cursor-pointer"
                 onclick="window.location='/student/courses/{{ $course->id }}'">

                {{-- Accent bar --}}
                <div class="h-1.5" style="background: linear-gradient(90deg, {{ $accent['from'] }}, {{ $accent['to'] }})"></div>

                <div class="p-5">
                    <h3 class="font-bold text-gray-900 mb-1" style="font-family:'Sora',sans-serif;">
                        {{ $course->title }}
                    </h3>
                    <p class="text-xs text-gray-400 mb-4 leading-relaxed">
                        {{ \Illuminate\Support\Str::limit($course->description, 60) }}
                    </p>

                    {{-- Progress --}}
                    <div class="flex justify-between text-xs mb-1">
                        <span class="text-gray-400">Progress</span>
                        <span class="font-semibold text-gray-700">{{ $courseProgress[$course->id] ?? 0 }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-1.5 mb-4">
                        <div class="prog-bar-fill h-1.5 rounded-full"
                             style="width: {{ $courseProgress[$course->id] ?? 0 }}%;
                                    background: linear-gradient(90deg, {{ $accent['from'] }}, {{ $accent['to'] }})">
                        </div>
                    </div>

                    <a href="/student/courses/{{ $course->id }}"
                       class="block text-center text-white text-sm font-semibold py-2.5 rounded-xl {{ $accent['btn'] }} transition-colors">
                        Lanjut Belajar →
                    </a>
                </div>
            </div>
        @endforeach
    </div>

</div>

@endsection