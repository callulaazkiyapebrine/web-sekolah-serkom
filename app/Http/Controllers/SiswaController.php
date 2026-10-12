<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with('jurusan')
            ->orderBy('nama_siswa', 'asc')
            ->paginate(10);

        return view('admin.siswa.index', compact('siswas'));
    }

    public function addEdit($id = null)
    {
        try {
            if ($id) {
                $siswa = Siswa::findOrFail(
                    Crypt::decrypt($id)
                );
            } else {
                $siswa = null;
            }
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }

        $jurusans = Jurusan::orderBy('nama_jurusan')->get();

        return view(
            'admin.siswa.form',
            compact('siswa', 'jurusans')
        );
    }

    public function save(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|max:10',
            'nama_siswa' => 'required|string|max:40',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tahun_masuk' => 'required|integer',
            'id_jurusan' => [
                'required',
                Rule::exists('jurusans', 'id_jurusan'),
            ],
        ], [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.max' => 'NISN maksimal 10 karakter.',

            'nama_siswa.required' => 'Nama siswa wajib diisi.',
            'nama_siswa.max' => 'Nama siswa maksimal 40 karakter.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',

            'tahun_masuk.required' => 'Tahun masuk wajib diisi.',
            'tahun_masuk.integer' => 'Tahun masuk harus berupa angka.',

            'id_jurusan.required' => 'Jurusan wajib dipilih.',
            'id_jurusan.exists' => 'Jurusan yang dipilih tidak tersedia.',
        ]);

        try {
            if ($request->filled('id_siswa')) {
                $id = Crypt::decrypt($request->id_siswa);
                $siswa = Siswa::findOrFail($id);
            } else {
                $siswa = new Siswa();
            }

            $siswa->nisn = $request->nisn;
            $siswa->nama_siswa = $request->nama_siswa;
            $siswa->jenis_kelamin = $request->jenis_kelamin;
            $siswa->tahun_masuk = $request->tahun_masuk;
            $siswa->id_jurusan = $request->id_jurusan;

            $siswa->save();

            return redirect()
                ->route('admin.siswa.index')
                ->with(
                    'success',
                    $request->filled('id_siswa')
                        ? 'Data siswa berhasil diperbarui.'
                        : 'Data siswa berhasil disimpan.'
                );
        } catch (\Exception $e) {
            report($e);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data siswa gagal disimpan.');
        }
    }

    public function show($id)
    {
        try {
            $id = Crypt::decrypt($id);

            $siswa = Siswa::with('jurusan')->findOrFail($id);

            return view('admin.siswa.show', compact('siswa'));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        try {
            $siswa = Siswa::findOrFail(
                Crypt::decrypt($id)
            );

            $siswa->delete();

            return redirect()
                ->route('admin.siswa.index')
                ->with('success', 'Data siswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }
    }

    public function publicSiswa()
    {
        $siswa = Siswa::with('jurusan')->get();

        return view('public.siswa', compact('siswa'));
    }
}
