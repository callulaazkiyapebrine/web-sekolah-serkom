<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN - DAFTAR GURU
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $guru = Guru::orderBy('nama_guru', 'asc')
            ->paginate(10);

        return view('admin.guru.index', compact('guru'));
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - TAMBAH / EDIT
    |--------------------------------------------------------------------------
    */
    public function addEdit($id = null)
    {
        $guru = null;

        if ($id) {
            try {
                $realId = Crypt::decrypt($id);
                $guru = Guru::findOrFail($realId);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.guru.index')
                    ->with('error', 'Data guru tidak ditemukan.');
            }
        }

        return view('admin.guru.form', compact('guru'));
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - SIMPAN / UPDATE
    |--------------------------------------------------------------------------
    */

    /*
|--------------------------------------------------------------------------
| ADMIN - SIMPAN / UPDATE
|--------------------------------------------------------------------------
*/
    public function save(Request $request)
    {
        // Cek apakah ini proses edit atau tambah
        $guru = null;

        if ($request->filled('id_guru')) {
            try {
                $id = Crypt::decrypt($request->id_guru);
                $guru = Guru::findOrFail($id);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.guru.index')
                    ->with('error', 'Data guru tidak ditemukan.');
            }
        }

        // Validasi data
        $request->validate([
            'nama_guru' => 'required|string|max:100',
            'nip'       => 'nullable|string|max:50',
            'mapel'     => 'nullable|string|max:100',
            'foto'      => ($guru ? 'nullable' : 'required')
                . '|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_guru.required' => 'Nama guru wajib diisi.',
            'foto.required'      => 'Foto guru wajib diisi.',
            'foto.image'         => 'File harus berupa gambar.',
            'foto.mimes'         => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max'           => 'Ukuran foto maksimal 2 MB.',
        ]);

        // Jika bukan edit, buat data guru baru
        if (!$guru) {
            $guru = new Guru();
        }

        // Simpan data guru
        $guru->nama_guru = $request->nama_guru;
        $guru->nip = $request->nip;
        $guru->mapel = $request->mapel;

        // Ganti foto hanya jika ada foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama ketika foto baru diunggah
            if (
                $guru->foto &&
                Storage::disk('public')->exists($guru->foto)
            ) {
                Storage::disk('public')->delete($guru->foto);
            }

            $guru->foto = $request->file('foto')
                ->store('guru', 'public');
        }

        $guru->save();

        return redirect()
            ->route('admin.guru.index')
            ->with(
                'success',
                $request->filled('id_guru')
                    ? 'Data guru berhasil diperbarui.'
                    : 'Data guru berhasil ditambahkan.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - DETAIL
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        try {

            try {
                $realId = Crypt::decrypt($id);
            } catch (\Exception $e) {
                $realId = $id;
            }

            $guru = Guru::findOrFail($realId);

            return view('admin.guru.show', compact('guru'));
        } catch (\Exception $e) {

            return redirect()
                ->route('admin.guru.index')
                ->with('error', 'Data guru tidak ditemukan.');
        }
    }


    /*
    |--------------------------------------------------------------------------
    | PUBLIC - DAFTAR GURU
    |--------------------------------------------------------------------------
    */
    public function publicGuru()
    {
        $guru = Guru::orderBy('nama_guru', 'asc')->get();

        $profilSekolah = ProfilSekolah::first();

        return view('public.guru', [
            'guru' => $guru,
            'profilSekolah' => $profilSekolah
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | PUBLIC - DETAIL GURU
    |--------------------------------------------------------------------------
    */

    public function publicShow($id)
    {
        try {
            $idGuru = \Illuminate\Support\Facades\Crypt::decrypt($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }

        $guru = Guru::findOrFail($idGuru);

        $profilSekolah = ProfilSekolah::first();

        return view('public.guru.show', [
            'guru' => $guru,
            'profilSekolah' => $profilSekolah
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - HAPUS
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        try {

            $realId = Crypt::decrypt($id);

            $guru = Guru::findOrFail($realId);


            /*
            |--------------------------------------------------------------------------
            | HAPUS FOTO
            |--------------------------------------------------------------------------
            */
            if (
                $guru->foto &&
                Storage::disk('public')->exists($guru->foto)
            ) {
                Storage::disk('public')->delete($guru->foto);
            }


            /*
            |--------------------------------------------------------------------------
            | HAPUS DATA
            |--------------------------------------------------------------------------
            */
            $guru->delete();


            return redirect()
                ->route('admin.guru.index')
                ->with(
                    'success',
                    'Data guru berhasil dihapus.'
                );
        } catch (\Exception $e) {

            return redirect()
                ->route('admin.guru.index')
                ->with(
                    'error',
                    'Data guru tidak ditemukan.'
                );
        }
    }
}
