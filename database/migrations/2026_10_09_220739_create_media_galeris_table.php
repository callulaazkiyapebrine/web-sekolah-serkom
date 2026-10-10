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
    Schema::create('media_galeris', function (Blueprint $table) {
        $table->id('id_media');
        $table->unsignedBigInteger('id_album');
        $table->enum('kategori', ['foto', 'video']);
        $table->text('file');
        $table->timestamps();

        $table->foreign('id_album')
            ->references('id_album')
            ->on('album_galeris')
            ->cascadeOnDelete();
    });
}

public function down(): void
{
    Schema::dropIfExists('media_galeris');
}
};
