<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /* =========================================================
       ADMIN - DATA BERITA
    ========================================================= */

    public function index()
    {
        $berita = Berita::orderBy('id_berita', 'asc')
            ->paginate(10);

        return view(
            'admin.berita.index',
            compact('berita')
        );
    }


    /* =========================================================
       ADMIN - TAMBAH / EDIT BERITA
    ========================================================= */

    public function addEdit($id = null)
    {
        try {

            if ($id) {

                $berita = Berita::findOrFail(
                    Crypt::decrypt($id)
                );
            } else {

                $berita = null;
            }
        } catch (\Exception $e) {

            return redirect()
                ->route('admin.berita.index')
                ->with(
                    'error',
                    'Data berita tidak ditemukan.'
                );
        }

        return view(
            'admin.berita.form',
            compact('berita')
        );
    }


    /* =========================================================
       ADMIN - SIMPAN BERITA
    ========================================================= */

    public function save(Request $request)
    {
        $request->validate([

            'judul' => 'required|string|max:50',

            'isi' => 'required|string',

            'tanggal' => 'required|date',

            'status' => 'required|in:publish,draft',

            'gambar' => $request->filled('id_berita')
                ? 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
                : 'required|image|mimes:jpeg,png,jpg,webp|max:2048',

        ], [

            'judul.required' => 'Judul berita wajib diisi.',

            'judul.max' => 'Judul maksimal 50 karakter.',

            'isi.required' => 'Isi berita wajib diisi.',

            'tanggal.required' => 'Tanggal publikasi wajib diisi.',

            'status.required' => 'Status berita wajib dipilih.',

            'status.in' => 'Status berita tidak valid.',

            'gambar.required' => 'Gambar berita wajib dipilih.',

            'gambar.image' => 'Gambar harus berupa file gambar.',

            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',

            'gambar.max' => 'Ukuran gambar maksimal 2MB.',

        ]);


        try {

            /* =================================================
               EDIT BERITA
            ================================================= */

            if ($request->filled('id_berita')) {

                $id = Crypt::decrypt(
                    $request->id_berita
                );

                $berita = Berita::findOrFail($id);
            }

            /* =================================================
               TAMBAH BERITA
            ================================================= */ else {

                $berita = new Berita();

                // User yang membuat berita
                $berita->id_user = Auth::id();
            }


            /* =================================================
               DATA BERITA
            ================================================= */

            $berita->judul = $request->judul;

            $berita->isi = $request->isi;

            $berita->tanggal = $request->tanggal;

            // Simpan status Draft / Publish
            $berita->status = $request->status;


            /* =================================================
               GAMBAR
            ================================================= */

            if ($request->hasFile('gambar')) {

                // Hapus gambar lama jika ada
                if (
                    $berita->gambar &&
                    Storage::disk('public')->exists(
                        $berita->gambar
                    )
                ) {

                    Storage::disk('public')->delete(
                        $berita->gambar
                    );
                }


                // Simpan gambar baru
                $berita->gambar = $request
                    ->file('gambar')
                    ->store('berita', 'public');
            }


            /* =================================================
               SIMPAN
            ================================================= */

            $berita->save();


            return redirect()
                ->route('admin.berita.index')
                ->with(
                    'success',
                    $request->filled('id_berita')
                        ? 'Data berita berhasil diperbarui.'
                        : 'Data berita berhasil disimpan.'
                );
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Data berita gagal disimpan.'
                );
        }
    }


    /* =========================================================
       ADMIN - DETAIL BERITA
    ========================================================= */

    public function show($id)
    {
        try {

            $id = Crypt::decrypt($id);

            $berita = Berita::with('user')
                ->findOrFail($id);

            return view(
                'admin.berita.show',
                compact('berita')
            );
        } catch (\Exception $e) {

            return redirect()
                ->route('admin.berita.index')
                ->with(
                    'error',
                    'Data berita tidak ditemukan.'
                );
        }
    }


    /* =========================================================
       ADMIN - HAPUS BERITA
    ========================================================= */

    public function destroy($id)
    {
        try {

            $berita = Berita::findOrFail(
                Crypt::decrypt($id)
            );


            // Hapus gambar dari storage
            if (
                $berita->gambar &&
                Storage::disk('public')->exists(
                    $berita->gambar
                )
            ) {

                Storage::disk('public')->delete(
                    $berita->gambar
                );
            }


            // Hapus data berita
            $berita->delete();


            return redirect()
                ->route('admin.berita.index')
                ->with(
                    'success',
                    'Data berita berhasil dihapus.'
                );
        } catch (\Exception $e) {

            return redirect()
                ->route('admin.berita.index')
                ->with(
                    'error',
                    'Data berita tidak ditemukan.'
                );
        }
    }


    /* =========================================================
       PUBLIC - DAFTAR BERITA
       HANYA PUBLISH
    ========================================================= */

    public function publicBerita()
    {
        $beritas = Berita::where('status', 'publish')
            ->orderBy('id_berita', 'desc')
            ->get();

        $profilSekolah = ProfilSekolah::first();

        return view(
            'public.berita',
            compact(
                'beritas',
                'profilSekolah'
            )
        );
    }


    /* =========================================================
       PUBLIC - DETAIL BERITA
       HANYA PUBLISH
    ========================================================= */

    public function publicShow($slug)
    {
        $berita = Berita::where('status', 'publish')
            ->where('slug', $slug)
            ->firstOrFail();

        $profilSekolah = ProfilSekolah::first();

        return view(
            'public.berita.show',
            [
                'berita' => $berita,
                'profilSekolah' => $profilSekolah
            ]
        );
    }
}
