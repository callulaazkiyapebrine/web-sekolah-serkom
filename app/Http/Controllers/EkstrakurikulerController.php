<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class EkstrakurikulerController extends Controller
{
    public function index()
    {
        $ekstrakurikulers = Ekstrakurikuler::orderBy('nama_eskul', 'asc')
            ->paginate(10);

        return view(
            'admin.ekstrakurikuler.index',
            compact('ekstrakurikulers')
        );
    }

    public function addEdit($id = null)
    {
        try {

            if ($id) {

                $ekstrakurikuler = Ekstrakurikuler::findOrFail(
                    Crypt::decrypt($id)
                );
            } else {

                $ekstrakurikuler = null;
            }
        } catch (\Exception $e) {

            return redirect()
                ->route('admin.ekstrakurikuler.index')
                ->with(
                    'error',
                    'Data ekstrakurikuler tidak ditemukan.'
                );
        }

        return view(
            'admin.ekstrakurikuler.form',
            compact('ekstrakurikuler')
        );
    }

    public function save(Request $request)
    {
        $request->validate([

            'nama_eskul' => 'required|string|max:100',
            'pembina' => 'required|string|max:100',
            'jadwal_latihan' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'gambar' => $request->filled('id_eskul')
                ? 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
                : 'required|image|mimes:jpeg,png,jpg,webp|max:2048',

        ], [

            'nama_eskul.required' => 'Nama ekstrakurikuler wajib diisi.',
            'pembina.required' => 'Nama guru pembina wajib diisi.',
            'jadwal_latihan.required' => 'Jadwal latihan wajib diisi.',
            'deskripsi.required' => 'Deskripsi ekstrakurikuler wajib diisi.',
            'gambar.required' => 'Gambar ekstrakurikuler wajib dipilih.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',

        ]);

        try {

            if ($request->filled('id_eskul')) {

                $id = Crypt::decrypt($request->id_eskul);

                $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
            } else {

                $ekstrakurikuler = new Ekstrakurikuler();
            }

            $ekstrakurikuler->nama_eskul = $request->nama_eskul;
            $ekstrakurikuler->pembina = $request->pembina;
            $ekstrakurikuler->jadwal_latihan = $request->jadwal_latihan;
            $ekstrakurikuler->deskripsi = $request->deskripsi;

            if ($request->hasFile('gambar')) {

                // Hapus gambar lama
                if (
                    $ekstrakurikuler->gambar &&
                    Storage::disk('public')->exists(
                        $ekstrakurikuler->gambar
                    )
                ) {
                    Storage::disk('public')->delete(
                        $ekstrakurikuler->gambar
                    );
                }

                // Simpan gambar baru
                $ekstrakurikuler->gambar = $request
                    ->file('gambar')
                    ->store('ekstrakurikuler', 'public');
            }

            $ekstrakurikuler->save();

            return redirect()
                ->route('admin.ekstrakurikuler.index')
                ->with(
                    'success',
                    $request->filled('id_eskul')
                        ? 'Data ekstrakurikuler berhasil diperbarui.'
                        : 'Data ekstrakurikuler berhasil disimpan.'
                );
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Data ekstrakurikuler gagal disimpan.'
                );
        }
    }

    public function show($id)
    {
        try {

            $id = Crypt::decrypt($id);

            $ekstrakurikuler =
                Ekstrakurikuler::findOrFail($id);

            return view(
                'admin.ekstrakurikuler.show',
                compact('ekstrakurikuler')
            );
        } catch (\Exception $e) {

            return redirect()
                ->route('admin.ekstrakurikuler.index')
                ->with(
                    'error',
                    'Data ekstrakurikuler tidak ditemukan.'
                );
        }
    }

    public function destroy($id)
    {
        try {

            $ekstrakurikuler =
                Ekstrakurikuler::findOrFail(
                    Crypt::decrypt($id)
                );

            if (
                $ekstrakurikuler->gambar &&
                Storage::disk('public')->exists(
                    $ekstrakurikuler->gambar
                )
            ) {

                Storage::disk('public')->delete(
                    $ekstrakurikuler->gambar
                );
            }

            $ekstrakurikuler->delete();

            return redirect()
                ->route('admin.ekstrakurikuler.index')
                ->with(
                    'success',
                    'Data ekstrakurikuler berhasil dihapus.'
                );
        } catch (\Exception $e) {

            return redirect()
                ->route('admin.ekstrakurikuler.index')
                ->with(
                    'error',
                    'Data ekstrakurikuler tidak ditemukan.'
                );
        }
    }

   public function publicEkstrakurikuler()
{
    $ekstrakurikuler = Ekstrakurikuler::all();
    $profilSekolah = ProfilSekolah::first();

    return view(
        'public.ekstrakurikuler',
        compact('ekstrakurikuler', 'profilSekolah')
    );
}

public function publicShow($slug)
{
    try {
        $ekstrakurikuler = Ekstrakurikuler::where(
            'slug',
            $slug
        )->firstOrFail();

        $profilSekolah = ProfilSekolah::first();

        return view(
            'public.ekstrakurikuler.show',
            compact('ekstrakurikuler', 'profilSekolah')
        );
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        abort(404);
    }
}
}
