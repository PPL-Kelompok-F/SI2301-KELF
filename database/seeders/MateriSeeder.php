<?php

namespace Database\Seeders;

use App\Models\Materi;
use Illuminate\Database\Seeder;

class MateriSeeder extends Seeder
{
    public function run(): void
    {
        Materi::insert([
            [
                'judul' => 'Mengenal Warna',
                'deskripsi' => 'Belajar mengenal warna dasar.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Mengenal Hewan',
                'deskripsi' => 'Belajar mengenal berbagai hewan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Belajar Berhitung',
                'deskripsi' => 'Belajar angka dan penjumlahan sederhana.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Mengenal Anggota Tubuh',
                'deskripsi' => 'Belajar anggota tubuh manusia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Mengenal Buah',
                'deskripsi' => 'Belajar nama-nama buah.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}