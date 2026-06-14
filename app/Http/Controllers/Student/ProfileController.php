<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        // Ganti dari return view('pages.profile', ...) menjadi:
        return view('student.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
                // Validasi agar domain harus sesuai (misal: gmail.com atau yahoo.com)
                'regex:/^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com)$/i',
            ],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            // Harus mengisi password lama jika ingin mengganti password baru
            'current_password' => 'nullable|required_with:new_password|current_password',
            'new_password' => 'nullable|min:6|confirmed',
        ], [
            'email.regex' => 'Domain email harus menggunakan @gmail.com atau @yahoo.com.',
            'current_password.current_password' => 'Password lama yang Anda masukkan salah.',
            'current_password.required_with' => 'Masukkan password lama terlebih dahulu jika ingin mengganti password.',
        ]);

        // Update teks
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password jika form password diisi
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        // Update foto profil jika ada file yang diunggah
        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika sebelumnya sudah ada
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            // Simpan foto baru ke folder storage/app/public/avatars
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}