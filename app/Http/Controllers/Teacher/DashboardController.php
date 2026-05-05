<?php

namespace App\Http\Controllers\Teacher;

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
        return view('teacher.dashboard');
    }
}
=======
        if (!auth()->check() || auth()->user()->role !== 'teacher') {
            abort(403);
        }

        return view('teacher.dashboard');
    }
}
>>>>>>> c0775043053153af588941b7cef0d7aab53e5f67
