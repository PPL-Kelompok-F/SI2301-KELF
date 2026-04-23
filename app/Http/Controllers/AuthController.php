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
            'role' => 'required'
        ]);

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
        if ($role == 'teacher') {
            return redirect('/teacher/dashboard');
        }

        return redirect('/dashboard');
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