<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        $profilSekolah = ProfilSekolah::first();

        return view('admin.profil.index', [
            'title' => 'Profil Sekolah',
            'profilSekolah' => $profilSekolah,
        ]);
    }

    public function edit()
    {
        $profilSekolah = ProfilSekolah::first();

        if (!$profilSekolah) {
            return redirect()
                ->route('admin.profil.index')
                ->with('error', 'Data profil sekolah belum tersedia.');
        }

        return view('admin.profil.edit', [
            'title' => 'Edit Profil Sekolah',
            'profilSekolah' => $profilSekolah,
        ]);
    }

    public function save(Request $request)
    {
        $profilSekolah = ProfilSekolah::first();

        if (!$profilSekolah) {
            return redirect()
                ->route('admin.profil.index')
                ->with('error', 'Data profil sekolah belum tersedia.');
        }

        $data = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'slogan' => 'nullable',
            'instagram' => 'nullable|max:150',
            'tiktok' => 'nullable|max:150',
            'youtube' => 'nullable|max:150',
            'facebook' => 'nullable|max:150',
            'kepala_sekolah' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'npsn' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'kontak' => 'nullable|string|max:100',
            'visi_misi' => 'nullable|string',
            'tahun_berdiri' => 'nullable|string|max:10',
            'deskripsi' => 'nullable|string',
        ]);

        // FOTO
        if ($request->hasFile('foto')) {

            if (
                $profilSekolah->foto &&
                Storage::disk('public')->exists($profilSekolah->foto)
            ) {
                Storage::disk('public')->delete($profilSekolah->foto);
            }

            $data['foto'] = $request
                ->file('foto')
                ->store('images', 'public');
        }

        // LOGO
        if ($request->hasFile('logo')) {

            if (
                $profilSekolah->logo &&
                Storage::disk('public')->exists($profilSekolah->logo)
            ) {
                Storage::disk('public')->delete($profilSekolah->logo);
            }

            $data['logo'] = $request
                ->file('logo')
                ->store('images', 'public');
        }

        $profilSekolah->update($data);

        return redirect()
            ->route('admin.profil.index')
            ->with('success', 'Profil sekolah berhasil diperbarui.');
    }
public function publicProfil()
{
    $profilSekolah = ProfilSekolah::first();

    $guru = Guru::all();
    $siswa = Siswa::all();
    $beritas = Berita::all();
    $galeri = Galeri::all();
    $ekstrakurikuler = Ekstrakurikuler::all();

    return view('public.profil', compact(
        'profilSekolah',
        'guru',
        'siswa',
        'beritas',
        'galeri',
        'ekstrakurikuler'
    ));
}
}
