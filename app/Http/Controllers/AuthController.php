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

    // ================= LOGIN =================
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:admin,teacher,student',
        ]);

        // CEK AKUN TERDAFTAR ATAU TIDAK
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Akun tidak ditemukan');
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $authUser = Auth::user();

            // CEGAH USER LOGIN DENGAN ROLE YANG TIDAK SESUAI
            // Contoh: student/teacher mencoba login sebagai admin
            if ($authUser->role !== $request->role) {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->with('error', 'Role tidak sesuai dengan akun ini');
            }

            return match ($authUser->role) {
                'admin' => redirect('/admin/dashboard'),
                'teacher' => redirect('/teacher/dashboard'),
                default => redirect('/student/dashboard'),
            };
        }

        return back()->with('error', 'Email atau password salah');
    }

    // ================= REGISTER =================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:teacher,student'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        Auth::login($user);

        return redirect('/login')->with('success', 'Register berhasil, silakan login');
    }

    // ================= LOGOUT =================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}