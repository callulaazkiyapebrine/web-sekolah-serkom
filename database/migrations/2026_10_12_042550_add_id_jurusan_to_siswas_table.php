
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Pastikan jurusan IPA dan IPS tersedia

        foreach (['IPA', 'IPS'] as $nama) {
            $jurusan = DB::table('jurusans')
                ->where('nama_jurusan', $nama)
                ->first();

            if (!$jurusan) {
                DB::table('jurusans')->insert([
                    'nama_jurusan' => $nama,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }


        // Tambahkan kolom relasi tanpa menghapus kolom lama
        Schema::table('siswas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jurusan')
                ->nullable()
                ->after('jurusan');

            $table->foreign('id_jurusan')
                ->references('id_jurusan')
                ->on('jurusans')
                ->restrictOnDelete();
        });

        // Hubungkan siswa yang jurusannya IPA
        $idIpa = DB::table('jurusans')
            ->where('nama_jurusan', 'IPA')
            ->value('id_jurusan');

        DB::table('siswas')
            ->where('jurusan', 'ipa')
            ->update(['id_jurusan' => $idIpa]);

        // Hubungkan siswa yang jurusannya IPS
        $idIps = DB::table('jurusans')
            ->where('nama_jurusan', 'IPS')
            ->value('id_jurusan');

        DB::table('siswas')
            ->where('jurusan', 'ips')
            ->update(['id_jurusan' => $idIps]);
    }

    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign(['id_jurusan']);
            $table->dropColumn('id_jurusan');
        });
    }
};
