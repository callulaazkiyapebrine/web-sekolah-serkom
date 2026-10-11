<?php

namespace App\Http\Controllers;

use App\Models\AlbumGaleri;
use App\Models\MediaGaleri;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    // Menampilkan daftar album di halaman admin.
    public function index()
    {
        $galeri = AlbumGaleri::withCount([
            'media as jumlah_foto' => function ($query) {
                $query->where('kategori', 'foto');
            },
            'media as jumlah_video' => function ($query) {
                $query->where('kategori', 'video');
            },
        ])
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.galeri.index', compact('galeri'));
    }

    // Form tambah dan edit album.
    public function addEdit($id = null)
    {
        $album = null;

        if ($id) {
            try {
                $id = Crypt::decrypt($id);

                $album = AlbumGaleri::with('media')
                    ->findOrFail($id);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.galeri.index')
                    ->with('error', 'Album tidak ditemukan.');
            }
        }

        return view('admin.galeri.form', compact('album'));
    }

    public function save(Request $request, $id = null)
    {
        $album = null;

        // Mengambil album lama saat edit.
        if ($request->filled('id_album')) {
            try {
                $idAlbum = Crypt::decrypt($request->input('id_album'));

                $album = AlbumGaleri::findOrFail($idAlbum);
            } catch (\Exception $e) {
                return back()
                    ->withInput()
                    ->with('error', 'Album tidak ditemukan.');
            }
        }

        // Validasi data album dan media.
        $request->validate([
            'judul' => ['required', 'string', 'max:100'],
            'tanggal' => ['required', 'date'],
            'keterangan' => ['nullable', 'string'],

            'foto_files' => ['nullable', 'array'],
            'foto_files.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],

            'video_files' => ['nullable', 'array'],
            'video_files.*' => [
                'file',
                'mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/webm,video/x-matroska',
                'mimes:mp4,mov,avi,wmv,webm,mkv',
                'max:102400',
            ],

            // Form Blade mengirim video_urls[] sebagai array.
            'video_urls' => ['nullable', 'array'],
            'video_urls.*' => ['nullable', 'string', 'max:2000'],

            'hapus_media' => ['nullable', 'array'],
            'hapus_media.*' => ['required', 'string'],
        ], [
            'judul.required' => 'Judul album wajib diisi.',
            'judul.max' => 'Judul album maksimal 100 karakter.',
            'tanggal.required' => 'Tanggal kegiatan wajib diisi.',

            'foto_files.*.image' => 'Semua file foto harus berupa gambar.',
            'foto_files.*.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'foto_files.*.max' => 'Ukuran setiap foto maksimal 10 MB.',

            'video_files.*.mimes' => 'Video harus berformat MP4, MOV, AVI, WMV, WEBM, atau MKV.',
            'video_files.*.max' => 'Ukuran setiap video maksimal 100 MB.',
        ]);

        // Mengambil link video dari setiap kolom input.
        $daftarLink = collect($request->input('video_urls', []))
            ->filter(fn($url) => is_string($url) && trim($url) !== '')
            ->map(fn($url) => trim($url))
            ->values();

        // Memastikan setiap link video valid dan menggunakan HTTP/HTTPS.
        foreach ($daftarLink as $url) {
            if (
                !filter_var($url, FILTER_VALIDATE_URL) ||
                !in_array(
                    strtolower((string) parse_url($url, PHP_URL_SCHEME)),
                    ['http', 'https'],
                    true
                )
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'video_urls' => 'Setiap link video harus berupa URL HTTP atau HTTPS yang valid.',
                    ]);
            }
        }

        $fileBaru = [];
        $fileLamaUntukDihapus = [];

        DB::beginTransaction();

        try {
            // Jika ID tidak dikirim, buat album baru.
            if (!$album) {
                $album = new AlbumGaleri();
            }

            // Simpan informasi album.
            $album->judul = $request->judul;
            $album->tanggal = $request->tanggal;
            $album->keterangan = $request->keterangan;
            $album->save();

            // Simpan foto baru jika ada.
            foreach ($request->file('foto_files', []) as $foto) {
                $path = $foto->store('galeri', 'public');

                if (!$path) {
                    throw new \Exception('Foto gagal disimpan.');
                }

                $fileBaru[] = $path;

                $album->media()->create([
                    'kategori' => 'foto',
                    'file' => $path,
                ]);
            }

            // Simpan file video baru jika ada.
            foreach ($request->file('video_files', []) as $video) {
                $path = $video->store('galeri', 'public');

                if (!$path) {
                    throw new \Exception('Video gagal disimpan.');
                }

                $fileBaru[] = $path;

                $album->media()->create([
                    'kategori' => 'video',
                    'file' => $path,
                ]);
            }

            // Simpan link video baru jika ada.
            foreach ($daftarLink as $url) {
                $album->media()->create([
                    'kategori' => 'video',
                    'file' => $url,
                ]);
            }

            // Hapus hanya media yang dicentang dan milik album ini.
            foreach ($request->input('hapus_media', []) as $encryptedId) {
                try {
                    $mediaId = Crypt::decrypt($encryptedId);
                } catch (\Exception $e) {
                    throw new \Exception('ID media tidak valid.');
                }

                $media = MediaGaleri::where('id_album', $album->id_album)
                    ->where('id_media', $mediaId)
                    ->first();

                if (!$media) {
                    continue;
                }

                // Link video tidak boleh dianggap sebagai file lokal.
                if (
                    $media->file &&
                    !Str::startsWith($media->file, ['http://', 'https://'])
                ) {
                    $fileLamaUntukDihapus[] = $media->file;
                }

                $media->delete();
            }

            DB::commit();

            // Hapus file fisik setelah transaksi database berhasil.
            foreach (array_unique($fileLamaUntukDihapus) as $path) {
                Storage::disk('public')->delete($path);
            }

            return redirect()
                ->route('admin.galeri.index')
                ->with(
                    'success',
                    $request->filled('id_album')
                        ? 'Album berhasil diperbarui.'
                        : 'Album berhasil ditambahkan.'
                );
        } catch (\Exception $e) {
            DB::rollBack();

            // Bersihkan file baru jika penyimpanan gagal.
            foreach ($fileBaru as $path) {
                Storage::disk('public')->delete($path);
            }

            report($e);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Album gagal disimpan. Periksa kembali data dan konfigurasi database.'
                );
        }
    }
    // Detail album di halaman admin.
    public function show($id)
    {
        try {
            $id = Crypt::decrypt($id);

            $album = AlbumGaleri::with('media')
                ->findOrFail($id);

            return view('admin.galeri.show', compact('album'));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.galeri.index')
                ->with('error', 'Album tidak ditemukan.');
        }
    }

    // Menghapus album beserta seluruh data medianya.
    public function destroy($id)
    {
        try {
            $id = Crypt::decrypt($id);

            $album = AlbumGaleri::with('media')
                ->findOrFail($id);

            $fileUntukDihapus = [];

            foreach ($album->media as $media) {
                if (
                    $media->file &&
                    !Str::startsWith(
                        $media->file,
                        ['http://', 'https://']
                    )
                ) {
                    $fileUntukDihapus[] = $media->file;
                }
            }

            // Foreign key cascade menghapus data media terkait.
            $album->delete();

            // Hapus file fisik, bukan link video.
            foreach (array_unique($fileUntukDihapus) as $path) {
                Storage::disk('public')->delete($path);
            }

            return redirect()
                ->route('admin.galeri.index')
                ->with('success', 'Album berhasil dihapus.');
        } catch (\Exception $e) {
            report($e);

            return redirect()
                ->route('admin.galeri.index')
                ->with('error', 'Album gagal dihapus.');
        }
    }


    // Menampilkan seluruh album di halaman publik.
    public function publicGaleri()
    {
        $galeri = AlbumGaleri::with([
            'media' => function ($query) {
                $query->orderBy('id_media', 'asc');
            },
        ])
            ->withCount('media')
            ->orderBy('tanggal', 'desc')
            ->paginate(12);

        $profilSekolah = \App\Models\ProfilSekolah::first();

        return view('public.galeri', compact(
            'galeri',
            'profilSekolah'
        ));
    }


    // Detail album di halaman publik.
    public function publicShow($id)
    {
        try {
            $id = Crypt::decrypt($id);

            $album = AlbumGaleri::with('media')
                ->findOrFail($id);

            $profilSekolah = \App\Models\ProfilSekolah::first();

            return view('public.galeri.show', compact(
                'album',
                'profilSekolah'
            ));
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
