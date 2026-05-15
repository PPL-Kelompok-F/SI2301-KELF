<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->string('late_info')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('submissions', function ($table) {
            $table->dropColumn('late_info');
        });
    }
};
