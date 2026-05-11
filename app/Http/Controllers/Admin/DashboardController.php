<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // PROTEKSI ROLE
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('admin.dashboard');
    }
}
