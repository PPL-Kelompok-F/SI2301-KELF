<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<<< HEAD:database/migrations/2026_04_30_092426_add_photo_to_users_table.php
return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('photo')->nullable();
========
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('student');
            }
>>>>>>>> c0775043053153af588941b7cef0d7aab53e5f67:database/migrations/2026_05_01_141226_add_role_to_users_table.php
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
<<<<<<<< HEAD:database/migrations/2026_04_30_092426_add_photo_to_users_table.php
            $table->dropColumn('photo');
========
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
>>>>>>>> c0775043053153af588941b7cef0d7aab53e5f67:database/migrations/2026_05_01_141226_add_role_to_users_table.php
        });
    }
};