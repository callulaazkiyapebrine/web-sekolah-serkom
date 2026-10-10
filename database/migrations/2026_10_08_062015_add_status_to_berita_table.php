<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->enum('status', ['publish', 'draft'])
                ->default('draft')
                ->after('tanggal');
        });
    }

    public function down()
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};