<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $materis = Materi::withCount('quizzes')
        ->get()
        ->map(function ($materi) use ($userId) {
            $firstQuiz = $materi->quizzes()->first();

            if ($firstQuiz) {
                $materi->user_result = QuizResult::where('user_id', $userId)
                    ->where('quiz_id', $firstQuiz->id)
                    ->first();
            } else {
                $materi->user_result = null;
            }

            return $materi;
        });

        return view('student.quiz.index', compact('materis'));
    }

    public function show(Materi $materi)
    {
        $materi->load('quizzes');

        return view('student.quiz.quiz', compact(
            'materi'
        ));
    }

    public function submit(Request $request, Materi $materi)
    {
        $materi->load('quizzes');

        $score = 0;
        $totalQuestions = $materi->quizzes->count();
        
        $userAnswers = []; 

        foreach ($materi->quizzes as $quiz) {
            $answer = $request->input('question_'.$quiz->id);
            // Ambil jawaban terbaru dari input form, jika kosong beri tanda '-'
            $userAnswers[$quiz->id] = $answer ?? '-'; 

            if ($answer == $quiz->correct_answer) {
                $score++;
            }
        }

        // Ambil ID soal pertama sebagai jangkar QuizResult sesuai struktur tabelmu
        $firstQuizId = $materi->quizzes->first()->id;

        // Update skor terakhir ke database
        QuizResult::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'quiz_id' => $firstQuizId,
            ],
            [
                'score' => $score,
                'total_questions' => $totalQuestions,
            ]
        );

        // Hapus session lama terlebih dahulu agar tidak terjadi crash data lawas
        session()->forget('userAnswers');

        // Simpan jawaban yang BARU SAJA dijawab ke dalam session secara permanen/flash
        session(['userAnswers' => $userAnswers]);

        return redirect()->route(
            'student.quiz.result',
            $materi->id
        );
    }

    public function result(Materi $materi)
    {
        $firstQuiz = $materi->quizzes()->first();

        if (!$firstQuiz) {
            abort(404);
        }

        $result = QuizResult::where(
            'user_id',
            auth()->id()
        )
        ->where(
            'quiz_id',
            $firstQuiz->id
        )
        ->first();

        if (!$result) {
            abort(404);
        }

        // Menggunakan session()->get() agar datanya tetap tersimpan meskipun halaman di-refresh
        $userAnswers = session()->get('userAnswers', []);

        return view(
            'student.quiz.result',
            compact(
                'materi',
                'result',
                'userAnswers'
            )
        );
    }
}