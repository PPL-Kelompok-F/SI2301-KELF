<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('classroom_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('teacher_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('title');
            $table->text('description')->nullable();

            // ✅ WAJIB DATETIME (biar jam ikut)
            $table->dateTime('deadline');

            // FILE TUGAS
            $table->string('file')->nullable();

            $table->string('status')->default('draft');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};