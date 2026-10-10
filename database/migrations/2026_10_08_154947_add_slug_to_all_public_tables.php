```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | TAMBAH KOLOM SLUG
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('gurus', 'slug')) {
            Schema::table('gurus', function (Blueprint $table) {
                $table->string('slug', 100)->nullable()->unique()->after('nama_guru');
            });
        }

        if (!Schema::hasColumn('ekstrakurikulers', 'slug')) {
            Schema::table('ekstrakurikulers', function (Blueprint $table) {
                $table->string('slug', 100)->nullable()->unique()->after('nama_eskul');
            });
        }

        if (!Schema::hasColumn('berita', 'slug')) {
            Schema::table('berita', function (Blueprint $table) {
                $table->string('slug', 100)->nullable()->unique()->after('judul');
            });
        }

        if (!Schema::hasColumn('prestasis', 'slug')) {
            Schema::table('prestasis', function (Blueprint $table) {
                $table->string('slug', 100)->nullable()->unique()->after('nama_prestasi');
            });
        }

        if (!Schema::hasColumn('galeris', 'slug')) {
            Schema::table('galeris', function (Blueprint $table) {
                $table->string('slug', 100)->nullable()->unique()->after('judul');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | ISI SLUG GURU
        |--------------------------------------------------------------------------
        */

        $gurus = DB::table('gurus')
            ->whereNull('slug')
            ->get();

        foreach ($gurus as $guru) {

            $slugDasar = Str::slug($guru->nama_guru);
            $slug = $slugDasar;
            $nomor = 1;

            while (
                DB::table('gurus')
                    ->where('slug', $slug)
                    ->where('id_guru', '!=', $guru->id_guru)
                    ->exists()
            ) {
                $slug = $slugDasar . '-' . $nomor;
                $nomor++;
            }

            DB::table('gurus')
                ->where('id_guru', $guru->id_guru)
                ->update([
                    'slug' => $slug
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | ISI SLUG EKSTRAKURIKULER
        |--------------------------------------------------------------------------
        */

        $eskuls = DB::table('ekstrakurikulers')
            ->whereNull('slug')
            ->get();

        foreach ($eskuls as $eskul) {

            $slugDasar = Str::slug($eskul->nama_eskul);
            $slug = $slugDasar;
            $nomor = 1;

            while (
                DB::table('ekstrakurikulers')
                    ->where('slug', $slug)
                    ->where('id_eskul', '!=', $eskul->id_eskul)
                    ->exists()
            ) {
                $slug = $slugDasar . '-' . $nomor;
                $nomor++;
            }

            DB::table('ekstrakurikulers')
                ->where('id_eskul', $eskul->id_eskul)
                ->update([
                    'slug' => $slug
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | ISI SLUG BERITA
        |--------------------------------------------------------------------------
        */

        $berita = DB::table('berita')
            ->whereNull('slug')
            ->get();

        foreach ($berita as $item) {

            $slugDasar = Str::slug($item->judul);
            $slug = $slugDasar;
            $nomor = 1;

            while (
                DB::table('berita')
                    ->where('slug', $slug)
                    ->where('id_berita', '!=', $item->id_berita)
                    ->exists()
            ) {
                $slug = $slugDasar . '-' . $nomor;
                $nomor++;
            }

            DB::table('berita')
                ->where('id_berita', $item->id_berita)
                ->update([
                    'slug' => $slug
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | ISI SLUG PRESTASI
        |--------------------------------------------------------------------------
        */

        $prestasi = DB::table('prestasis')
            ->whereNull('slug')
            ->get();

        foreach ($prestasi as $item) {

            $slugDasar = Str::slug($item->nama_prestasi);

            /*
            Jika nama_prestasi kosong, gunakan nama_pemenang
            */
            if (!$slugDasar && !empty($item->nama_pemenang)) {
                $slugDasar = Str::slug($item->nama_pemenang);
            }

            $slug = $slugDasar;
            $nomor = 1;

            while (
                DB::table('prestasis')
                    ->where('slug', $slug)
                    ->where('id_prestasi', '!=', $item->id_prestasi)
                    ->exists()
            ) {
                $slug = $slugDasar . '-' . $nomor;
                $nomor++;
            }

            DB::table('prestasis')
                ->where('id_prestasi', $item->id_prestasi)
                ->update([
                    'slug' => $slug
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | ISI SLUG GALERI
        |--------------------------------------------------------------------------
        */

        $galeri = DB::table('galeris')
            ->whereNull('slug')
            ->get();

        foreach ($galeri as $item) {

            $slugDasar = Str::slug($item->judul);
            $slug = $slugDasar;
            $nomor = 1;

            while (
                DB::table('galeris')
                    ->where('slug', $slug)
                    ->where('id_galeri', '!=', $item->id_galeri)
                    ->exists()
            ) {
                $slug = $slugDasar . '-' . $nomor;
                $nomor++;
            }

            DB::table('galeris')
                ->where('id_galeri', $item->id_galeri)
                ->update([
                    'slug' => $slug
                ]);
        }
    }


    public function down(): void
    {
        if (Schema::hasColumn('gurus', 'slug')) {
            Schema::table('gurus', function (Blueprint $table) {
                $table->dropUnique(['slug']);
                $table->dropColumn('slug');
            });
        }

        if (Schema::hasColumn('ekstrakurikulers', 'slug')) {
            Schema::table('ekstrakurikulers', function (Blueprint $table) {
                $table->dropUnique(['slug']);
                $table->dropColumn('slug');
            });
        }

        if (Schema::hasColumn('berita', 'slug')) {
            Schema::table('berita', function (Blueprint $table) {
                $table->dropUnique(['slug']);
                $table->dropColumn('slug');
            });
        }

        if (Schema::hasColumn('prestasis', 'slug')) {
            Schema::table('prestasis', function (Blueprint $table) {
                $table->dropUnique(['slug']);
                $table->dropColumn('slug');
            });
        }

        if (Schema::hasColumn('galeris', 'slug')) {
            Schema::table('galeris', function (Blueprint $table) {
                $table->dropUnique(['slug']);
                $table->dropColumn('slug');
            });
        }
    }
};
