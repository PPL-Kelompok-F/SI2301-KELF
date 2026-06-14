<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // LOGIN PAGE
    public function showLogin()
    {
        return view('auth.login');
    }

    // REGISTER PAGE
    public function showRegister()
    {
        return view('auth.register');
    }

    // LOGIN PROCESS
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:student,teacher'
        ]);

        if ($request->role === 'admin') {
            return back()->with('error', 'Gunakan halaman login admin di /admin/login');
        }

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role
        ], $request->remember)) {

            $request->session()->regenerate();

            return $this->redirectByRole(Auth::user()->role);
        }

        return back()->with('error', 'Login gagal atau role salah');
    }

    public function showAdminLogin()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        return view('admin.login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'admin'
        ], $request->remember)) {
            $request->session()->regenerate();

            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Login gagal atau akun admin tidak ditemukan');
    }

    // REGISTER PROCESS
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        // AUTO LOGIN
        Auth::login($user);

        return $this->redirectByRole($user->role);
    }

    // REDIRECT BY ROLE
    private function redirectByRole($role)
    {
        if ($role == 'admin') {
            return redirect('/admin/dashboard');
        }

        if ($role == 'teacher') {
            return redirect('/teacher/dashboard');
        }

        return redirect('/student/dashboard'); // default student
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
