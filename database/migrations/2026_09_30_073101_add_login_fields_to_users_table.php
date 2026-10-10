<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 30)->unique()->after('id');
            $table->string('email', 100)->unique()->after('username');
            $table->string('password', 100)->after('email');
            $table->enum('role', ['admin', 'operator'])->default('operator')->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['username']);
            $table->dropUnique(['email']);
            $table->dropColumn(['username', 'email', 'password', 'role']);
        });
    }
};
