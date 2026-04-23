<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // tampil semua user
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    // update role
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,mentor,siswa'
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Role berhasil diupdate!');
    }
}