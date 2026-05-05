<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->remember)) {

            $request->session()->regenerate();

            return $this->redirectByRole(Auth::user()->role);
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:admin,teacher,student'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        Auth::login($user);

        return $this->redirectByRole($user->role);
    }

    private function redirectByRole($role)
    {
<<<<<<< HEAD
        if ($role == 'admin') {
            return redirect('/admin/dashboard');
        }

        if ($role == 'teacher') {
            return redirect('/teacher/dashboard');
        }

        return redirect('/student/dashboard'); // default student
=======
        return match ($role) {
            'admin' => redirect('/admin/dashboard'),
            'teacher' => redirect('/teacher/dashboard'),
            default => redirect('/student/dashboard'),
        };
>>>>>>> c0775043053153af588941b7cef0d7aab53e5f67
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}