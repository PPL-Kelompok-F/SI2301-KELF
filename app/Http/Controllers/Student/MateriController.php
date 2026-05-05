<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MateriController extends Controller
{
    public function index($course_id)
    {
        $materis = DB::table('materis')
            ->where('course_id', $course_id)
            ->get();

        $course = DB::table('courses')
            ->where('id', $course_id)
            ->first();

        if (!$course) {
            abort(404);
        }

        if (request()->is('student/*')) {
            $isEnrolled = DB::table('enrollments')
                ->where('user_id', auth()->id())
                ->where('course_id', $course_id)
                ->exists();

            if (!$isEnrolled) {
                return redirect('/student/courses/' . $course_id)
                    ->with('error', 'Kamu harus enroll course terlebih dahulu');
            }

            return view('student.materi.index', compact('materis', 'course'));
        }

        return view('materi.index', compact('materis', 'course_id'));
    }

    public function show($id)
    {
        $materi = DB::table('materis')->where('id', $id)->first();

        if (!$materi) {
            abort(404);
        }

        $url = $materi->video_url;
        $videoId = null;

        if (str_contains($url, 'youtu.be')) {
            $path = parse_url($url, PHP_URL_PATH);
            $videoId = trim($path, '/');
        } else {
            parse_str(parse_url($url, PHP_URL_QUERY), $query);
            $videoId = $query['v'] ?? null;
        }

        $embed = $videoId
            ? "https://www.youtube.com/embed/" . $videoId
            : null;

        return view('materi.show', compact('materi', 'embed'));
    }

    public function create($course_id)
    {
        return view('materi.create', compact('course_id'));
    }

    public function store($course_id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'video_url' => 'required'
        ]);

        DB::table('materis')->insert([
            'title' => $request->title,
            'description' => $request->description,
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
            'description' => $request->description,
            'video_url' => $request->video_url,
            'updated_at' => now()
        ]);

        return redirect('/teacher/courses/' . $materi->course_id)
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

        return redirect('/teacher/courses/' . $courseId)
            ->with('success', 'Materi berhasil dihapus');
    }
}