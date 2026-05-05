<?php

<<<<<<< HEAD
namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
=======
namespace App\Http\Student\ProfileControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
>>>>>>> c0775043053153af588941b7cef0d7aab53e5f67
use App\Http\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $user = Auth::user();
        return view('student.profile', compact('user'));
=======
        /** @var User $user */
        $user = Auth::user() ?? abort(403);

        return view('pages.profile', compact('user'));
>>>>>>> c0775043053153af588941b7cef0d7aab53e5f67
    }

    public function update(Request $request)
    {
<<<<<<< HEAD
=======
        /** @var User $user */
>>>>>>> c0775043053153af588941b7cef0d7aab53e5f67
        $user = Auth::user() ?? abort(403);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
<<<<<<< HEAD
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

        // update password (harus pakai password lama)
        if ($request->filled('password')) {

            if (!Hash::check($request->old_password, $user->password)) {
                return back()->with('error', 'Password lama salah!');
            }

            $request->validate([
                'password' => 'min:6|confirmed'
            ]);

=======
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
>>>>>>> c0775043053153af588941b7cef0d7aab53e5f67
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile berhasil diupdate!');
    }
}