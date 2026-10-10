<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR PRESTASI ADMIN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $prestasi = Prestasi::orderBy('tanggal', 'asc')
            ->paginate(10);

        return view('admin.prestasi.index', compact('prestasi'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH / EDIT
    |--------------------------------------------------------------------------
    */

    public function addEdit($id = null)
    {
        $prestasi = null;

        if ($id) {
            try {
                $id = Crypt::decrypt($id);
                $prestasi = Prestasi::findOrFail($id);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.prestasi.index')
                    ->with('error', 'Data prestasi tidak ditemukan.');
            }
        }

        return view('admin.prestasi.form', compact('prestasi'));
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN PRESTASI
    |--------------------------------------------------------------------------
    */

    public function save(Request $request)
    {
        $request->validate([
            'nama_prestasi' => 'required|string|max:255',
            'nama_pemenang' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
            'gambar' => $request->filled('id_prestasi')
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {
            if ($request->filled('id_prestasi')) {
                $id = Crypt::decrypt($request->id_prestasi);
                $prestasi = Prestasi::findOrFail($id);
            } else {
                $prestasi = new Prestasi();
            }

            $prestasi->nama_prestasi = $request->nama_prestasi;
            $prestasi->nama_pemenang = $request->nama_pemenang;
            $prestasi->tanggal = $request->tanggal;
            $prestasi->keterangan = $request->keterangan;

            if ($request->hasFile('gambar')) {
                if (
                    $prestasi->gambar &&
                    Storage::disk('public')->exists($prestasi->gambar)
                ) {
                    Storage::disk('public')->delete($prestasi->gambar);
                }

                $file = $request->file('gambar');

                $namaFile = time() . '_' . $file->getClientOriginalName();

                $prestasi->gambar = $file->storeAs(
                    'prestasi',
                    $namaFile,
                    'public'
                );
            }

            $prestasi->save();

            return redirect()
                ->route('admin.prestasi.index')
                ->with(
                    'success',
                    $request->filled('id_prestasi')
                        ? 'Data prestasi berhasil diperbarui.'
                        : 'Data prestasi berhasil ditambahkan.'
                );
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL PRESTASI ADMIN
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $prestasi = Prestasi::findOrFail($id);

            return view('admin.prestasi.show', compact('prestasi'));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.prestasi.index')
                ->with('error', 'Data prestasi tidak ditemukan.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS PRESTASI
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $prestasi = Prestasi::findOrFail($id);

            if (
                $prestasi->gambar &&
                Storage::disk('public')->exists($prestasi->gambar)
            ) {
                Storage::disk('public')->delete($prestasi->gambar);
            }

            $prestasi->delete();

            return redirect()
                ->route('admin.prestasi.index')
                ->with('success', 'Data prestasi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.prestasi.index')
                ->with('error', 'Data prestasi gagal dihapus.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DAFTAR PRESTASI PUBLIK
    |--------------------------------------------------------------------------
    */

    public function publicPrestasi()
    {
        $prestasi = Prestasi::orderBy('tanggal', 'desc')->get();

        $profilSekolah = ProfilSekolah::first();

        return view(
            'public.prestasi',
            compact('prestasi', 'profilSekolah')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL PRESTASI PUBLIK
    |--------------------------------------------------------------------------
    */

    public function publicShow($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            abort(404);
        }

        $prestasi = Prestasi::findOrFail($id);
        $profilSekolah = ProfilSekolah::first();

        return view(
            'public.prestasi.show',
            compact('prestasi', 'profilSekolah')
        );
    }
}
