<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    // Hanya buat tabel jika tabel 'forum_posts' belum ada
    if (!Schema::hasTable('forum_posts')) {
        Schema::create('forum_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('content');
            $table->timestamps();
        });
    }
}

    public function down(): void
    {
        Schema::dropIfExists('forum_posts');
    }
};