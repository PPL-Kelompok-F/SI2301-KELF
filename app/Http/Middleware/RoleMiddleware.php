<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // harus login dulu
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRole = Auth::user()->role;

        // cek apakah role user ada di daftar role yang diizinkan
        if (!in_array($userRole, $roles, true)) {
            abort(403, 'Akses ditolak!');
        }

        return $next($request);
    }
}