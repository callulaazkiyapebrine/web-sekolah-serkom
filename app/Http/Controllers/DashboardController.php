<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Prestasi;
use App\Models\AlbumGaleri;
use App\Models\Pengumuman;

class DashboardController extends Controller
{
    /**
     * ADMIN DASHBOARD
     */
    public function index()
    {
        $profilSekolah = ProfilSekolah::first();

        $jumlahSiswa = Siswa::count();
        $jumlahGuru = Guru::count();
        $jumlahBerita = Berita::count();
        $jumlahEkstrakurikuler = Ekstrakurikuler::count();

        // Hitung album galeri yang digunakan oleh sistem baru
        $jumlahGaleri = AlbumGaleri::count();

        $jumlahPrestasi = Prestasi::count();

        $siswas = Siswa::orderBy('id_siswa', 'desc')
            ->take(5)
            ->get();

        $beritas = Berita::orderBy('id_berita', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'profilSekolah',
            'jumlahSiswa',
            'jumlahGuru',
            'jumlahBerita',
            'jumlahEkstrakurikuler',
            'jumlahGaleri',
            'jumlahPrestasi',
            'siswas',
            'beritas'
        ));
    }

    /**
     * PUBLIC / LANDING PAGE
     */

public function publicDashboard()
{
    $profilSekolah = ProfilSekolah::first();

    $guru = Guru::orderBy('nama_guru', 'asc')->get();

    $siswa = Siswa::get();

    $beritas = Berita::where('status', 'publish')
        ->orderBy('id_berita', 'desc')
        ->take(6)
        ->get();

    $pengumumans = Pengumuman::orderBy('id_pengumuman', 'desc')
        ->take(6)
        ->get();

    $ekstrakurikuler = Ekstrakurikuler::orderBy('id_eskul', 'desc')
        ->take(6)
        ->get();

    $prestasi = Prestasi::orderBy('id_prestasi', 'desc')
        ->take(6)
        ->get();

    $galeri = AlbumGaleri::with([
        'media' => function ($query) {
            $query->orderBy('id_media', 'asc');
        }
    ])
        ->withCount('media')
        ->orderBy('tanggal', 'desc')
        ->take(6)
        ->get();

    return view('public.dashboard', compact(
        'profilSekolah',
        'guru',
        'siswa',
        'beritas',
        'pengumumans',
        'ekstrakurikuler',
        'galeri',
        'prestasi'
    ));
}
}