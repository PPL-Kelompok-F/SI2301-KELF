<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MaterialController extends Controller
{
    public function index(): View
    {
        $this->ensureTeacher();

        $materials = Material::with('teacher')
            ->where('uploaded_by', auth()->id())
            ->latest()
            ->get();

        return view('teacher.materials.index', compact('materials'));
    }

    public function create(): View
    {
        $this->ensureTeacher();

        return view('teacher.materials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->ensureTeacher();

        $validated = $request->validate($this->rules(true));
        $file = $request->file('file_materi');
        $path = $file->store('materials', 'public');

        Material::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'tipe_file' => $file->getMimeType(),
            'uploaded_by' => auth()->id(),
        ]);

        return redirect()
            ->route('teacher.materials.index')
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(Material $material): View
    {
        $this->ensureTeacher();
        $this->ensureOwner($material);

        return view('teacher.materials.edit', compact('material'));
    }

    public function update(Request $request, Material $material): RedirectResponse
    {
        $this->ensureTeacher();
        $this->ensureOwner($material);

        $validated = $request->validate($this->rules(false));

        $data = [
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
        ];

        if ($request->hasFile('file_materi')) {
            Storage::disk('public')->delete($material->file_path);

            $file = $request->file('file_materi');
            $data['file_path'] = $file->store('materials', 'public');
            $data['file_name'] = $file->getClientOriginalName();
            $data['tipe_file'] = $file->getMimeType();
        }

        $material->update($data);

        return redirect()
            ->route('teacher.materials.index')
            ->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Material $material): RedirectResponse
    {
        $this->ensureTeacher();
        $this->ensureOwner($material);

        Storage::disk('public')->delete($material->file_path);
        $material->delete();

        return redirect()
            ->route('teacher.materials.index')
            ->with('success', 'Materi berhasil dihapus.');
    }

    private function rules(bool $fileRequired): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'file_materi' => [
                $fileRequired ? 'required' : 'nullable',
                'file',
                'mimetypes:video/mp4,video/webm,application/pdf',
            ],
        ];
    }

    private function ensureTeacher(): void
    {
        if (!auth()->check() || auth()->user()->role !== 'teacher') {
            abort(403);
        }
    }

    private function ensureOwner(Material $material): void
    {
        if ((int) $material->uploaded_by !== (int) auth()->id()) {
            abort(403);
        }
    }
}
