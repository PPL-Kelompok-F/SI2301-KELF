<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403, 'Akses ditolak. Hanya teacher yang dapat mengakses.');
        }

        $materis = Materi::all();
        return view('materi.index', compact('materis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403, 'Akses ditolak. Hanya teacher yang dapat mengakses.');
        }

        return view('materi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403, 'Akses ditolak. Hanya teacher yang dapat mengakses.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tipe' => 'required|in:gambar,video,teks',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,avi,mov|max:10240',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('materi', 'public');
        }

        Materi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tipe' => $request->tipe,
            'file' => $filePath,
        ]);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403, 'Akses ditolak. Hanya teacher yang dapat mengakses.');
        }

        $materi = Materi::findOrFail($id);
        return view('materi.edit', compact('materi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403, 'Akses ditolak. Hanya teacher yang dapat mengakses.');
        }

        $materi = Materi::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tipe' => 'required|in:gambar,video,teks',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,avi,mov|max:10240',
        ]);

        $filePath = $materi->file;
        if ($request->hasFile('file')) {
            if ($filePath) {
                Storage::disk('public')->delete($filePath);
            }
            $filePath = $request->file('file')->store('materi', 'public');
        }

        $materi->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tipe' => $request->tipe,
            'file' => $filePath,
        ]);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->role !== 'teacher') {
            abort(403, 'Akses ditolak. Hanya teacher yang dapat mengakses.');
        }

        $materi = Materi::findOrFail($id);
        if ($materi->file) {
            Storage::disk('public')->delete($materi->file);
        }
        $materi->delete();

        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
