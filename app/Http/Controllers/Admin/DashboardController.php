<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use Illuminate\Http\Request;
=======
>>>>>>> c0775043053153af588941b7cef0d7aab53e5f67

class DashboardController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        return view('admin.dashboard');
    }
}
=======
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('admin.dashboard');
    }
}
>>>>>>> c0775043053153af588941b7cef0d7aab53e5f67
