<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilSekolahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('profil_sekolahs')->insert([
            'nama_sekolah' => 'SMK YPC Tasikmalaya',
            'kepala_sekolah' => 'Drs Ujang Sanusi',
            'foto' => 'default.jpg',
            'logo' => 'default-logo.png',
            'npsn' => '20224567',
            'alamat' => 'Tasikmalaya, Jawa Barat',
            'kontak' => '081234567890',
            'visi_misi' => 'Mewujudkan sekolah yang unggul, berkarakter, dan kompeten.',
            'tahun_berdiri' => 2000,
            'deskripsi' => 'SMK YPC Tasikmalaya merupakan sekolah menengah kejuruan yang memberikan pendidikan dan keterampilan kepada peserta didik.',
        ]);
    }
}
