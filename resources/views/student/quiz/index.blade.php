@extends('layouts.student.app')

@section('content')

    <h1 class="text-2xl font-bold mb-6">
        Quiz Pembelajaran
    </h1>

    <div class="grid lg:grid-cols-3 gap-6">

        @foreach($materis as $materi)

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                <div class="p-6">

                    <h2 class="text-xl font-bold mb-2">
                        {{ $materi->judul }}
                    </h2>

                    <p class="text-gray-500 text-sm mb-4">
                        {{ $materi->deskripsi }}
                    </p>

                    <div class="flex justify-between text-sm text-gray-500 mb-6">
                        <span>{{ $materi->quizzes_count }} Soal</span>
                    </div>
                    @php

                        $firstQuiz = $materi->quizzes->first();

                        $result = null;

                        if ($firstQuiz) {
                            $result = \App\Models\QuizResult::where(
                                'user_id',
                                auth()->id()
                            )
                                ->where(
                                    'quiz_id',
                                    $firstQuiz->id
                                )
                                ->first();
                        }

                    @endphp

                    @if($result)

                        <div class="mb-4">

                            <div class="bg-green-50 border border-green-200 rounded-xl p-3">

                                <p class="text-sm text-green-700">
                                    Nilai Terakhir
                                </p>

                                <p class="text-2xl font-bold text-green-600">
                                    {{ round(($result->score / $result->total_questions) * 100) }}%
                                </p>

                                <p class="text-xs text-green-600">
                                    {{ $result->score }} / {{ $result->total_questions }} benar
                                </p>

                            </div>

                        </div>

                    @endif

                    <a href="{{ route('student.quiz.show', $materi->id) }}"
                        class="w-full inline-block text-center bg-black text-white py-3 rounded-xl hover:bg-gray-800 transition">

                        Mulai Quiz

                    </a>

                </div>

            </div>

        @endforeach

    </div>

@endsection