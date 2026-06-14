<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        Quiz::insert([

            // Materi 1 - Warna

            [
                'materi_id' => 1,
                'question' => 'Warna daun adalah?',
                'option_a' => 'Hijau',
                'option_b' => 'Merah',
                'option_c' => 'Biru',
                'option_d' => 'Hitam',
                'correct_answer' => 'A',
            ],

            [
                'materi_id' => 1,
                'question' => 'Warna langit cerah adalah?',
                'option_a' => 'Ungu',
                'option_b' => 'Biru',
                'option_c' => 'Hitam',
                'option_d' => 'Pink',
                'correct_answer' => 'B',
            ],

            [
                'materi_id' => 1,
                'question' => 'Warna pisang matang adalah?',
                'option_a' => 'Kuning',
                'option_b' => 'Hitam',
                'option_c' => 'Abu-abu',
                'option_d' => 'Coklat',
                'correct_answer' => 'A',
            ],

            // Materi 2 - Hewan

            [
                'materi_id' => 2,
                'question' => 'Hewan yang berbunyi meong?',
                'option_a' => 'Ayam',
                'option_b' => 'Sapi',
                'option_c' => 'Kucing',
                'option_d' => 'Kambing',
                'correct_answer' => 'C',
            ],

            [
                'materi_id' => 2,
                'question' => 'Hewan yang bisa terbang?',
                'option_a' => 'Burung',
                'option_b' => 'Ikan',
                'option_c' => 'Kelinci',
                'option_d' => 'Kucing',
                'correct_answer' => 'A',
            ],

            [
                'materi_id' => 2,
                'question' => 'Hewan yang hidup di air?',
                'option_a' => 'Ikan',
                'option_b' => 'Ayam',
                'option_c' => 'Sapi',
                'option_d' => 'Kuda',
                'correct_answer' => 'A',
            ],

        ]);
    }
}