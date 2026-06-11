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

        foreach ($materi->quizzes as $quiz) {

            $answer = $request->input('question_'.$quiz->id);

            if ($answer == $quiz->correct_answer) {
                print_r('benar');
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

        return view(
            'student.quiz.result',
            compact(
                'materi',
                'result'
            )
        );
    }
}