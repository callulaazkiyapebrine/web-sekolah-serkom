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
    Schema::table('profil_sekolahs', function (Blueprint $table) {
        $table->string('slogan', 100)->after('nama_sekolah');
        $table->string('instagram', 150)->nullable()->after('slogan');
        $table->string('tiktok', 150)->nullable()->after('instagram');
        $table->string('youtube', 150)->nullable()->after('tiktok');
        $table->string('facebook', 150)->nullable()->after('youtube');
    });
}

public function down(): void
{
    Schema::table('profil_sekolahs', function (Blueprint $table) {
        $table->dropColumn([
            'slogan',
            'instagram',
            'tiktok',
            'youtube',
            'facebook'
        ]);
    });
}
};
