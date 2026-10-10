<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PengumumanController extends Controller
{
    /* =========================================================
       ADMIN - DATA PENGUMUMAN
    ========================================================= */

 
public function index()
{
    $pengumuman = Pengumuman::orderBy('id_pengumuman', 'asc')
        ->get();

    return view(
        'admin.pengumuman.index',
        compact('pengumuman')
    );
}



    /* =========================================================
       ADMIN - TAMBAH / EDIT PENGUMUMAN
    ========================================================= */

    public function addEdit($id = null)
    {
        try {
            if ($id) {
                $pengumuman = Pengumuman::findOrFail(
                    Crypt::decrypt($id)
                );
            } else {
                $pengumuman = null;
            }
        } catch (\Throwable $e) {
            return redirect()
                ->route('admin.pengumuman.index')
                ->with('error', 'Data pengumuman tidak ditemukan.');
        }

        return view(
            'admin.pengumuman.form',
            compact('pengumuman')
        );
    }


    /* =========================================================
       ADMIN - SIMPAN PENGUMUMAN
    ========================================================= */

    public function save(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'status' => 'required|in:draft,publish',
        ], [
            'judul.required' => 'Judul pengumuman wajib diisi.',
            'judul.max' => 'Judul maksimal 200 karakter.',
            'isi.required' => 'Isi pengumuman wajib diisi.',
            'tanggal.required' => 'Tanggal pengumuman wajib diisi.',
            'status.required' => 'Status pengumuman wajib dipilih.',
            'status.in' => 'Status pengumuman tidak valid.',
        ]);

        try {
            if ($request->filled('id_pengumuman')) {
                // EDIT PENGUMUMAN
                $id = Crypt::decrypt($request->id_pengumuman);

                $pengumuman = Pengumuman::findOrFail($id);
            } else {
                // TAMBAH PENGUMUMAN
                $pengumuman = new Pengumuman();
            }

            $pengumuman->judul = $request->judul;
            $pengumuman->isi = $request->isi;
            $pengumuman->tanggal = $request->tanggal;
            $pengumuman->status = $request->status;

            $pengumuman->save();

            return redirect()
                ->route('admin.pengumuman.index')
                ->with(
                    'success',
                    $request->filled('id_pengumuman')
                        ? 'Data pengumuman berhasil diperbarui.'
                        : 'Data pengumuman berhasil disimpan.'
                );
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pengumuman gagal disimpan. Silakan periksa kembali data.'
                );
        }
    }


    /* =========================================================
       ADMIN - DETAIL PENGUMUMAN
    ========================================================= */

    public function show($id)
    {
        try {
            $pengumuman = Pengumuman::findOrFail(
                Crypt::decrypt($id)
            );

            return view(
                'admin.pengumuman.show',
                compact('pengumuman')
            );
        } catch (\Throwable $e) {
            return redirect()
                ->route('admin.pengumuman.index')
                ->with('error', 'Data pengumuman tidak ditemukan.');
        }
    }


    /* =========================================================
       ADMIN - HAPUS PENGUMUMAN
    ========================================================= */

    public function destroy($id)
    {
        try {
            $pengumuman = Pengumuman::findOrFail(
                Crypt::decrypt($id)
            );

            $pengumuman->delete();

            return redirect()
                ->route('admin.pengumuman.index')
                ->with('success', 'Data pengumuman berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()
                ->route('admin.pengumuman.index')
                ->with('error', 'Data pengumuman gagal dihapus atau tidak ditemukan.');
        }
    }


    /* =========================================================
       PUBLIC - DAFTAR PENGUMUMAN
       HANYA PUBLISH
    ========================================================= */

    public function publicPengumuman()
    {
        $pengumumans = Pengumuman::where('status', 'publish')
            ->orderBy('id_pengumuman', 'desc')
            ->get();

        $profilSekolah = ProfilSekolah::first();

        return view(
            'public.pengumuman',
            compact(
                'pengumumans',
                'profilSekolah'
            )
        );
    }


    /* =========================================================
       PUBLIC - DETAIL PENGUMUMAN
       HANYA PUBLISH
    ========================================================= */

    public function publicShow($id)
    {
        try {
            $pengumuman = Pengumuman::where('status', 'publish')
                ->findOrFail(Crypt::decrypt($id));

            $profilSekolah = ProfilSekolah::first();

            return view(
                'public.pengumuman.show',
                compact(
                    'pengumuman',
                    'profilSekolah'
                )
            );
        } catch (\Throwable $e) {
            abort(404);
        }
    }
}
