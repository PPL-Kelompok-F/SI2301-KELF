<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    // Menampilkan halaman detail video (untuk Student)
    public function show($id)
    {
        $lesson = DB::table('lessons')->where('id', $id)->first();

        if (!$lesson) {
            return abort(404, 'Materi tidak ditemukan');
        }

        return view('pages.lesson-detail', compact('lesson'));
    }

    // Menampilkan form upload/tambah video (untuk Teacher/Admin)
    public function create()
    {
        $courses = DB::table('courses')->get(); // Mengambil daftar course untuk dropdown
        return view('pages.lesson-create', compact('courses'));
    }

    // Menyimpan data video ke database
    public function store(Request $request)
    {
        $url = $request->video_url;
        
        // Logika sederhana mengubah URL YouTube biasa ke format Embed
        $video_id = "";
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
            $video_id = $match[1];
        }

        $embedUrl = "https://www.youtube.com/embed/" . $video_id;

        DB::table('lessons')->insert([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'video_url' => $embedUrl,
            'duration' => $request->duration, // dalam menit
            'order_number' => $request->order_number,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/dashboard')->with('success', 'Video materi berhasil diupload!');
    }

    public function complete($id)
    {
        $userId = auth()->id();

        // Cek apakah data progress sudah ada atau belum
        $exists = DB::table('lesson_progress')
            ->where('user_id', $userId)
            ->where('lesson_id', $id)
            ->exists();

        if (!$exists) {
            // Masukkan data baru ke tabel lesson_progress
            DB::table('lesson_progress')->insert([
                'user_id' => $userId,
                'lesson_id' => $id,
                'is_completed' => 1, // Status selesai
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            return back()->with('success', 'Materi berhasil diselesaikan! Progress kamu bertambah.');
        }

        return back()->with('info', 'Materi ini sudah kamu selesaikan sebelumnya.');
    }
}