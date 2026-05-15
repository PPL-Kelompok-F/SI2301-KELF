<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('assignment_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('student_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->text('answer');
            $table->string('file')->nullable();

            $table->integer('score')->nullable();
            $table->text('feedback')->nullable();

            // status submit utama
            $table->string('status')->default('submitted');

            // waktu submit (INI YANG DIPAKAI UNTUK CEK LATE)
            $table->dateTime('submitted_at')->nullable();

            // ontime / late
            $table->string('submit_status')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};