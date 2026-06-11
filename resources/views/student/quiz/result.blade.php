@extends('layouts.student.app')

@section('content')

<div class="max-w-2xl mx-auto">

    <div class="bg-white rounded-3xl shadow-sm p-10 text-center">

        <div class="text-6xl mb-4">
            🎉
        </div>

        <h1 class="text-3xl font-bold mb-2">
            Quiz Selesai
        </h1>

        <p class="text-gray-500 mb-8">
            {{ $materi->judul }}
        </p>

        <div class="bg-gray-50 rounded-2xl p-8">

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
                class="bg-indigo-600 text-white px-6 py-3 rounded-xl">

                Kerjakan Lagi

            </a>

            <a href="{{ route('student.quiz') }}"
                class="bg-gray-200 px-6 py-3 rounded-xl">

                Kembali

            </a>

        </div>

    </div>

</div>

@endsection