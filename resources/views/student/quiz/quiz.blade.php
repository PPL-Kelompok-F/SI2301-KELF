@extends('layouts.student.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="mb-8">

        <h1 class="text-3xl font-bold">
            {{ $materi->judul }}
        </h1>

        <p class="text-gray-500 mt-2">
            Jawablah semua pertanyaan berikut.
        </p>

    </div>

    <form method="POST"
        action="{{ route('student.quiz.submit',$materi->id) }}">

        @csrf

        @foreach($materi->quizzes as $index => $quiz)

        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">

            <h3 class="font-semibold text-lg mb-5">
                {{ $index + 1 }}. {{ $quiz->question }}
            </h3>

            <div class="space-y-3">

                <label class="flex items-center gap-3 p-3 border rounded-xl hover:bg-gray-50 cursor-pointer">
                    <input type="radio"
                        name="question_{{ $quiz->id }}"
                        value="A"
                        required>

                    {{ $quiz->option_a }}
                </label>

                <label class="flex items-center gap-3 p-3 border rounded-xl hover:bg-gray-50 cursor-pointer">
                    <input type="radio"
                        name="question_{{ $quiz->id }}"
                        value="B">

                    {{ $quiz->option_b }}
                </label>

                <label class="flex items-center gap-3 p-3 border rounded-xl hover:bg-gray-50 cursor-pointer">
                    <input type="radio"
                        name="question_{{ $quiz->id }}"
                        value="C">

                    {{ $quiz->option_c }}
                </label>

                <label class="flex items-center gap-3 p-3 border rounded-xl hover:bg-gray-50 cursor-pointer">
                    <input type="radio"
                        name="question_{{ $quiz->id }}"
                        value="D">

                    {{ $quiz->option_d }}
                </label>

            </div>

        </div>

        @endforeach

        <button
            class="bg-black text-white px-8 py-3 rounded-xl hover:bg-gray-800">

            Selesai Quiz

        </button>

    </form>

</div>

@endsection