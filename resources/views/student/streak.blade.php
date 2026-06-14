@extends('layouts.student.app')

@section('content')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&display=swap');

    .rank-badge {
        display: inline-flex; align-items: center; justify-content: center;
        width: 32px; height: 32px; border-radius: 50%;
        font-family: 'Sora', sans-serif; font-weight: 800; font-size: 13px;
    }
    .rank-1 { background: #fefce8; color: #d97706; border: 1px solid #fde68a; }
    .rank-2 { background: #f8fafc; color: #64748b; border: 1px solid #cbd5e1; }
    .rank-3 { background: #fff7ed; color: #ea580c; border: 1px solid #fed7aa; }
    .rank-n { background: #f3f4f6; color: #9ca3af; border: 1px solid #e5e7eb; font-size: 12px; }

    .leaderboard-row { border-top: 1px solid #f3f4f6; transition: background .15s; }
    .leaderboard-row.rank-1 { background: #fff9db; }
    .leaderboard-row.rank-2 { background: #eff6ff; }
    .leaderboard-row.rank-3 { background: #ecfdf5; }

    .leaderboard-row:hover { background: #f9fafb; }
    .leaderboard-row.is-me { background: #ffedd5; border-top: 1px solid #fcd34d; }
    .leaderboard-row.is-me td { color: #92400e; }

    .you-tag {
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 700; color: #ffffff;
        background: #4f46e5; border: 1px solid #c7d2fe;
        border-radius: 9999px; padding: 3px 10px; margin-left: 8px;
        vertical-align: middle;
        letter-spacing: .04em;
    }
</style>
@endpush

<div class="max-w-3xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-gray-900 mb-1" style="font-family:'Sora',sans-serif;">
            Leaderboard Streak
        </h1>
        <p class="text-sm text-gray-400">
            Peringkat berdasarkan streak belajar terpanjang
        </p>
    </div>

    {{-- MY RANK CARD --}}
    <div class="flex items-center justify-between bg-white rounded-2xl p-5 mb-6 border border-gray-200 shadow-sm">
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-1">
                Peringkat Kamu
            </p>
            <p class="text-4xl font-extrabold text-indigo-500" style="font-family:'Sora',sans-serif;">
                #{{ $myRank }}
            </p>
        </div>
        <div class="flex items-center justify-center w-14 h-14 rounded-full bg-orange-50 border border-orange-200 text-orange-500 text-2xl">
            <i class="fa-solid fa-fire"></i>
        </div>
    </div>

    {{-- LEADERBOARD TABLE --}}
    <div class="rounded-2xl overflow-hidden bg-white border border-gray-200 shadow-sm">
        <table class="w-full">

            <thead class="bg-gray-50">
                <tr>
                    <th class="p-4 text-left text-xs font-semibold uppercase tracking-widest text-gray-400">Rank</th>
                    <th class="p-4 text-left text-xs font-semibold uppercase tracking-widest text-gray-400">Nama</th>
                    <th class="p-4 text-left text-xs font-semibold uppercase tracking-widest text-gray-400">Streak</th>
                </tr>
            </thead>

            <tbody>
                @foreach($leaderboard as $index => $user)
                <tr class="leaderboard-row {{ $user->id == auth()->id() ? 'is-me' : '' }} {{ $index < 3 ? 'rank-'.($index + 1) : '' }}">

                    <td class="p-4">
                        @if($index == 0)
                            <span class="rank-badge rank-1">
                                <i class="fa-solid fa-trophy" style="font-size:13px;"></i>
                            </span>
                        @elseif($index == 1)
                            <span class="rank-badge rank-2">
                                <i class="fa-solid fa-medal" style="font-size:13px;"></i>
                            </span>
                        @elseif($index == 2)
                            <span class="rank-badge rank-3">
                                <i class="fa-solid fa-award" style="font-size:13px;"></i>
                            </span>
                        @else
                            <span class="rank-badge rank-n">#{{ $index + 1 }}</span>
                        @endif
                    </td>

                    <td class="p-4 text-sm text-gray-700">
                        {{ $user->name }}
                        @if($user->id == auth()->id())
                            <span class="you-tag">KAMU</span>
                        @endif
                    </td>

                    <td class="p-4">
                        <span class="streak-val">
                            <i class="fa-solid fa-fire" style="font-size:12px;"></i>
                            {{ $user->streak }} hari
                        </span>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

@endsection