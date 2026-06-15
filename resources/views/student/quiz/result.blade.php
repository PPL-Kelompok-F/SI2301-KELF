@extends('layouts.student.app')

@section('content')

<div class="max-w-4xl mx-auto pb-10">

    <div class="bg-white rounded-3xl shadow-sm p-10 text-center mb-8">
        <div class="text-6xl mb-4">
            🎉
        </div>
        <h1 class="text-3xl font-bold mb-2">
            Quiz Selesai
        </h1>
        <p class="text-gray-500 mb-8">
            {{ $materi->judul }}
        </p>

        <div class="bg-gray-50 rounded-2xl p-8 max-w-sm mx-auto">
            <div class="text-6xl font-bold text-indigo-600">
                {{ $result->score }}
            </div>
            <div class="text-gray-500 mt-2">
                dari {{ $result->total_questions }} soal
            </div>
            <div class="mt-4 text-lg font-semibold">
                {{ round(
                    ($result->score / max($result->total_questions,1))
                    * 100
                ) }}%
            </div>
        </div>

        <div class="mt-8 flex gap-4 justify-center">
            <a href="{{ route('student.quiz.show',$materi->id) }}"
                class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-medium hover:bg-indigo-700 transition">
                Kerjakan Lagi
            </a>
            <a href="{{ route('student.quiz') }}"
                class="bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-medium hover:bg-gray-300 transition">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm p-10">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-4">Review & Pembahasan</h2>

        <div class="space-y-6">
            @foreach ($materi->quizzes as $index => $quiz)
                @php
                    $jawabanSiswa = $userAnswers[$quiz->id] ?? '-';
                    $isCorrect = $jawabanSiswa == $quiz->correct_answer;
                @endphp

                <div class="border-2 {{ $isCorrect ? 'border-green-100 bg-green-50/30' : 'border-red-100 bg-red-50/30' }} rounded-2xl p-6 text-left">
                    
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full {{ $isCorrect ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} font-bold">
                            {{ $index + 1 }}
                        </div>
                        <div class="flex-grow">
                            <p class="text-lg font-medium text-gray-800 mb-4">{{ $quiz->question }}</p>
                            
                            <ul class="space-y-2 text-gray-600 mb-6">
                                <li>A. {{ $quiz->option_a }}</li>
                                <li>B. {{ $quiz->option_b }}</li>
                                <li>C. {{ $quiz->option_c }}</li>
                                <li>D. {{ $quiz->option_d }}</li>
                            </ul>

                            <div class="flex flex-col sm:flex-row sm:gap-8 mb-4 bg-white p-4 rounded-xl border border-gray-100">
                                <div>
                                    <span class="text-sm text-gray-500 block">Jawaban Kamu:</span>
                                    <span class="font-bold {{ $isCorrect ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $jawabanSiswa }} 
                                        @if($jawabanSiswa != '-')
                                            @if($isCorrect) (Benar) @else (Salah) @endif
                                        @else
                                            (Tidak Dijawab)
                                        @endif
                                    </span>
                                </div>
                                <div class="mt-2 sm:mt-0">
                                    <span class="text-sm text-gray-500 block">Jawaban Benar:</span>
                                    <span class="font-bold text-green-600">{{ $quiz->correct_answer }}</span>
                                </div>
                            </div>

                            @if($quiz->explanation)
                                <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4 mt-4">
                                    <h4 class="text-indigo-800 font-semibold mb-1 text-sm uppercase tracking-wider">Pembahasan</h4>
                                    <p class="text-indigo-900 text-sm leading-relaxed">
                                        {{ $quiz->explanation }}
                                    </p>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

@endsection