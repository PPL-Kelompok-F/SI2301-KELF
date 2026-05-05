<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MateriController extends Controller
{
    // =======================
    // LIST MATERI PER COURSE
    // =======================
    public function index($course_id)
    {
        $materis = DB::table('materis')
            ->where('course_id', $course_id)
            ->get();

        $course = DB::table('courses')
            ->where('id', $course_id)
            ->first();

        if (request()->is('student/*')) {
            return view('student.materi.index', compact('materis', 'course'));
        }

        return view('materi.index', compact('materis', 'course_id'));
    }

    // =======================
    // SHOW VIDEO
    // =======================
    public function show($id)
    {
        $materi = DB::table('materis')->where('id', $id)->first();

        if (!$materi) {
            abort(404);
        }

        $url = $materi->video_url;
        $videoId = null;

        // support youtu.be
        if (str_contains($url, 'youtu.be')) {
            $path = parse_url($url, PHP_URL_PATH);
            $videoId = trim($path, '/');
        } 
        // support youtube.com/watch?v=
        else {
            parse_str(parse_url($url, PHP_URL_QUERY), $query);
            $videoId = $query['v'] ?? null;
        }

        $embed = $videoId 
            ? "https://www.youtube.com/embed/" . $videoId 
            : null;

        return view('materi.show', compact('materi', 'embed'));
    }


    // =======================
    // FORM CREATE
    // =======================
    public function create($course_id)
    {
        return view('materi.create', compact('course_id'));
    }


    // =======================
    // STORE
    // =======================
    public function store($course_id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'video_url' => 'required'
        ]);

        DB::table('materis')->insert([
            'title' => $request->title,
            'video_url' => $request->video_url,
            'course_id' => $course_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/teacher/courses/' . $course_id)
            ->with('success', 'Materi berhasil ditambahkan');
    }


    public function edit($id)
    {
        $materi = DB::table('materis')->where('id', $id)->first();

        if (!$materi) {
            abort(404);
        }

        return view('materi.edit', compact('materi'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'video_url' => 'required'
        ]);

        $materi = DB::table('materis')->where('id', $id)->first();

        if (!$materi) {
            abort(404);
        }

        DB::table('materis')->where('id', $id)->update([
            'title' => $request->title,
            'video_url' => $request->video_url,
            'updated_at' => now()
        ]);

        return redirect('/teacher/courses/' . $materi->course_id . '/materi')
            ->with('success', 'Materi berhasil diupdate');
    }
    
    public function destroy($id)
    {
        $materi = DB::table('materis')->where('id', $id)->first();

        if (!$materi) {
            abort(404);
        }

        $courseId = $materi->course_id;

        DB::table('materis')->where('id', $id)->delete();

        return redirect('/teacher/courses/' . $courseId . '/materi')
            ->with('success', 'Materi berhasil dihapus');
    }

}