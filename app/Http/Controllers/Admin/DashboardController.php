<?php

namespace App\Http\Controllers\Admin\DashboardController;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
}

        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('admin.dashboard');
    }
}
