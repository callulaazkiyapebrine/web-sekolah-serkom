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
        Schema::create('galeris', function (Blueprint $table) {
            $table->integer('id_galeri')->autoIncrement();
            $table->string('judul', 50);
            $table->string('slug', 100)->unique();
            $table->text('keterangan');
            $table->string('file', 100);
            $table->enum('kategori', ['foto', 'video']);
            $table->date('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeris');
    }
};
