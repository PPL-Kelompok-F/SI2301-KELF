<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StreakController extends Controller
{
    public function index()
    {
        $leaderboard = DB::table('users')
            ->leftJoin('streaks', 'users.id', '=', 'streaks.user_id')
            ->select(
                'users.id',
                'users.name',
                DB::raw('COALESCE(streaks.streak_count,0) as streak')
            )
            ->orderByDesc('streak')
            ->get();

        $myRank = $leaderboard
            ->pluck('id')
            ->search(auth()->id());

        return view('student.streak', [
            'leaderboard' => $leaderboard,
            'myRank' => $myRank !== false ? $myRank + 1 : '-'
        ]);
    }
}