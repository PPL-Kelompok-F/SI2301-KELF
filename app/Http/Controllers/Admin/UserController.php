<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->role !== 'admin') {
                abort(403);
            }

            return $next($request);
        });
    }

    // tampilkan semua user
    public function index()
    {
        // proteksi admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $users = User::latest()->get();

        return view('admin.users', compact('users'));
    }

    // update role user
    public function updateRole(Request $request, $id)
    {
        // proteksi admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'role' => 'required|in:admin,teacher,student'
        ]);

        $user = User::findOrFail($id);

        // cegah admin ubah role dirinya sendiri
        if ($user->id == Auth::id()) {
            return back()->with('error', 'Tidak bisa mengubah role akun sendiri');
        }

        // cegah update jika role yang dipilih sama dengan role sebelumnya
        if ($user->role === $request->role) {
            return back()->with('error', 'Role tidak berubah');
        }

        $user->update([
            'role' => $request->role
        ]);

        return back()->with('success', 'Role user berhasil diubah');
    }
}