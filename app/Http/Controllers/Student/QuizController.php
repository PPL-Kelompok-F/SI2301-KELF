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
        $materis = Materi::with([
            'quizzes'
        ])->withCount('quizzes')
        ->get();

        return view('student.quiz.index', compact(
            'materis'
        ));
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
        
        // 1. Siapkan array untuk menampung jawaban siswa
        $userAnswers = []; 

        foreach ($materi->quizzes as $quiz) {

            $answer = $request->input('question_'.$quiz->id);
            
            // 2. Masukkan jawaban ke dalam array
            $userAnswers[$quiz->id] = $answer; 

            if ($answer == $quiz->correct_answer) {
                $score++;
            }
        }

        QuizResult::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'quiz_id' => $materi->quizzes->first()->id,
            ],
            [
                'score' => $score,
                'total_questions' => $totalQuestions,
            ]
        );

        // 3. DI SINI TEMPATNYA -> Bawa jawaban pakai ->with()
        return redirect()->route(
            'student.quiz.result',
            $materi->id
        )->with('userAnswers', $userAnswers);
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

        // 4. DAN DI SINI TEMPATNYA -> Tangkap jawaban dari Session
        $userAnswers = session('userAnswers', []);

        // 5. Jangan lupa tambahkan 'userAnswers' di compact
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