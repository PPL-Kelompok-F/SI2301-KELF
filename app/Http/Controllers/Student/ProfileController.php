<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user() ?? abort(403);

        return view('student.profile', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user() ?? abort(403);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'photo' => 'nullable|image|max:4096',
        ]);

        // update basic
        $user->name = $request->name;
        $user->email = $request->email;

        // upload foto
        if ($request->hasFile('photo')) {

            // hapus foto lama
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }

            $path = $request->file('photo')->store('profile', 'public');

            $user->photo = $path;
        }

        // update password
        if ($request->filled('password')) {

            if (!Hash::check($request->old_password, $user->password)) {
                return back()->with('error', 'Password lama salah!');
            }

            $request->validate([
                'password' => 'min:6|confirmed'
            ]);

            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile berhasil diupdate!');
    }
}