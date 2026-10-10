
@extends('admin')

@section('title', isset($album) ? 'Edit Album Galeri' : 'Tambah Album Galeri')

@section('content')

<style>
    .album-form {
        max-width: 1000px;
        margin: 0 auto;
        color: #26352c;
    }

    .album-heading {
        margin-bottom: 5px;
        color: #0b5d3b;
        font-size: 25px;
        font-weight: 700;
    }

    .album-subtitle {
        margin-bottom: 25px;
        color: #78847c;
        font-size: 14px;
    }

    .album-card {
        margin-bottom: 22px;
        overflow: hidden;
        border: 1px solid #e5ebe6;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 4px 16px rgba(20, 60, 35, .04);
    }

    .album-card-header {
        padding: 18px 24px;
        border-bottom: 1px solid #e5ebe6;
        background: #f1f7f2;
        color: #0b5d3b;
        font-weight: 700;
    }

    .album-card-body {
        padding: 24px;
    }

    .album-form .form-label {
        margin-bottom: 8px;
        color: #37483d;
        font-size: 13px;
        font-weight: 600;
    }

    .album-form .form-control,
    .album-form .form-select {
        min-height: 43px;
        border-color: #dce5de;
        border-radius: 8px;
        font-size: 14px;
    }

    .album-form .form-control:focus,
    .album-form .form-select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, .1);
    }

    .album-help {
        display: block;
        margin-top: 7px;
        color: #78847c;
        font-size: 12px;
        line-height: 1.6;
    }

    .kategori-pilihan {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .kategori-option {
        position: relative;
    }

    .kategori-option input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .kategori-label {
        display: flex;
        align-items: center;
        gap: 14px;
        min-height: 90px;
        padding: 18px;
        border: 1px solid #dce5de;
        border-radius: 11px;
        background: #fff;
        cursor: pointer;
        transition: .2s;
    }

    .kategori-option input:checked + .kategori-label {
        border-color: #198754;
        background: #f1f8f3;
        box-shadow: 0 0 0 2px rgba(25, 135, 84, .08);
    }

    .kategori-option input:focus-visible + .kategori-label {
        outline: 2px solid #198754;
        outline-offset: 3px;
    }

    .kategori-icon {
        display: flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        border-radius: 10px;
        background: #dceee1;
        color: #0b5d3b;
    }

    .kategori-name {
        margin-bottom: 4px;
        color: #173b2a;
        font-size: 15px;
        font-weight: 700;
    }

    .kategori-description {
        color: #78847c;
        font-size: 12px;
        line-height: 1.5;
    }

    .media-input-section {
        padding: 20px;
        border: 1px solid #e2ebe4;
        border-radius: 11px;
        background: #f8faf8;
    }

    .media-input-title {
        margin-bottom: 16px;
        color: #0b5d3b;
        font-size: 15px;
        font-weight: 700;
    }

    .media-input-section .btn-sm {
        font-size: 12px;
        font-weight: 600;
    }

    .media-existing-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 15px;
    }

    .media-existing-item {
        min-width: 0;
        overflow: hidden;
        border: 1px solid #e5ebe6;
        border-radius: 10px;
        background: #fff;
    }

    .media-existing-preview {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 165px;
        overflow: hidden;
        background: #f1f7f2;
    }

    .media-existing-preview img,
    .media-existing-preview video {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .media-existing-preview a {
        color: #0b5d3b;
        text-align: center;
        text-decoration: none;
        overflow-wrap: anywhere;
    }

    .media-existing-info {
        padding: 12px;
        font-size: 12px;
    }

    .media-existing-info .form-check {
        margin-top: 10px;
    }

    .badge-foto {
        background: #dceee1;
        color: #0b5d3b;
    }

    .badge-video {
        background: #eef2ff;
        color: #4559a5;
    }

    .btn-simpan-album {
        padding: 11px 20px;
        border: 1px solid #0b5d3b;
        border-radius: 8px;
        background: #0b5d3b;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-simpan-album:hover {
        background: #08472d;
        color: #fff;
    }

    .btn-batal-album {
        padding: 11px 20px;
        border: 1px solid #d5dfd7;
        border-radius: 8px;
        background: #fff;
        color: #526157;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-batal-album:hover {
        background: #f3f6f3;
        color: #26352c;
    }

    @media (max-width: 768px) {
        .album-card-body {
            padding: 18px;
        }

        .kategori-pilihan {
            grid-template-columns: 1fr;
        }

        .media-existing-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 480px) {
        .media-existing-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container-fluid pt-2 pb-4">
    <div class="album-form">

        <h1 class="album-heading">
            {{ isset($album) ? 'Edit Album Galeri' : 'Tambah Album Galeri' }}
        </h1>

        <p class="album-subtitle">
            Kelola informasi album dan dokumentasi kegiatan sekolah.
        </p>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Periksa kembali data berikut:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('admin.galeri.save') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            @if(isset($album) && $album)
                <input
                    type="hidden"
                    name="id_album"
                    value="{{ old('id_album', Crypt::encrypt($album->id_album)) }}">
            @endif

            {{-- INFORMASI ALBUM --}}
            <div class="album-card">
                <div class="album-card-header">
                    <i data-feather="folder" class="me-2"></i>
                    Informasi Album
                </div>

                <div class="album-card-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">
                            Judul Album <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="judul"
                            id="judul"
                            class="form-control"
                            value="{{ old('judul', $album->judul ?? '') }}"
                            placeholder="Contoh: Kegiatan Hari Kemerdekaan"
                            maxlength="100"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">
                            Tanggal Kegiatan <span class="text-danger">*</span>
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            id="tanggal"
                            class="form-control"
                            value="{{ old('tanggal', isset($album) && $album ? $album->tanggal : '') }}"
                            required>
                    </div>

                    <div>
                        <label for="keterangan" class="form-label">
                            Keterangan Album
                        </label>

                        <textarea
                            name="keterangan"
                            id="keterangan"
                            class="form-control"
                            rows="4"
                            placeholder="Tuliskan keterangan kegiatan...">{{ old('keterangan', $album->keterangan ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- KATEGORI MEDIA --}}
            <div class="album-card">
                <div class="album-card-header">
                    <i data-feather="layers" class="me-2"></i>
                    Tambahkan Media
                </div>

                <div class="album-card-body">
                    <p class="text-secondary small mb-3">
                        Pilih Foto atau Video, kemudian tentukan media yang ingin ditambahkan.
                    </p>

                    @php
                        $kategoriDipilih = old('kategori_media', '');
                    @endphp

                    <div class="kategori-pilihan">

                        <div class="kategori-option">
                            <input
                                type="radio"
                                name="kategori_media"
                                id="kategori_foto"
                                value="foto"
                                {{ $kategoriDipilih === 'foto' ? 'checked' : '' }}>

                            <label for="kategori_foto" class="kategori-label">
                                <span class="kategori-icon">
                                    <i data-feather="image"></i>
                                </span>

                                <span>
                                    <span class="kategori-name d-block">Foto</span>
                                    <span class="kategori-description">
                                        Pilih beberapa foto sekaligus atau tambah kelompok foto.
                                    </span>
                                </span>
                            </label>
                        </div>

                        <div class="kategori-option">
                            <input
                                type="radio"
                                name="kategori_media"
                                id="kategori_video"
                                value="video"
                                {{ $kategoriDipilih === 'video' ? 'checked' : '' }}>

                            <label for="kategori_video" class="kategori-label">
                                <span class="kategori-icon">
                                    <i data-feather="video"></i>
                                </span>

                                <span>
                                    <span class="kategori-name d-block">Video</span>
                                    <span class="kategori-description">
                                        Tambahkan melalui link atau upload file video.
                                    </span>
                                </span>
                            </label>
                        </div>

                    </div>

                    {{-- INPUT FOTO --}}
                    <div
                        id="bagian-foto"
                        class="media-input-section mb-3"
                        style="display: none;">

                        <h3 class="media-input-title">
                            <i data-feather="image" class="me-1"></i>
                            Tambahkan Foto
                        </h3>

                        <div id="daftar-foto">
                            <div class="mb-3 kelompok-foto">
                                <label class="form-label">Pilih Foto</label>

                                <input
                                    type="file"
                                    name="foto_files[]"
                                    class="form-control"
                                    accept=".jpg,.jpeg,.png,.webp"
                                    multiple>

                                <small class="album-help">
                                    Kamu bisa memilih beberapa foto sekaligus.
                                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 10 MB per foto.
                                </small>
                            </div>
                        </div>

                        <button
                            type="button"
                            class="btn btn-outline-secondary btn-sm"
                            id="tambah-foto">
                            <i data-feather="plus" class="me-1"></i>
                            Tambah Kelompok Foto
                        </button>
                    </div>

                    {{-- INPUT VIDEO --}}
                    <div
                        id="bagian-video"
                        class="media-input-section"
                        style="display: none;">

                        <h3 class="media-input-title">
                            <i data-feather="video" class="me-1"></i>
                            Tambahkan Video
                        </h3>

                        <div class="mb-3">
                            <label for="metode-video" class="form-label">
                                Pilih Cara Menambahkan Video
                            </label>

                            <select id="metode-video" class="form-select">
                                <option value="">-- Pilih metode video --</option>
                                <option value="link">Link Video</option>
                                <option value="file">Upload File Video</option>
                            </select>
                        </div>

                        {{-- LINK VIDEO --}}
                        <div id="bagian-link-video" style="display: none;">
                            <label class="form-label">Daftar Link Video</label>

                            <div id="daftar-link-video">
                                <div class="input-group mb-2 kelompok-link">
                                    <input
                                        type="url"
                                        name="video_urls[]"
                                        class="form-control"
                                        placeholder="https://www.youtube.com/watch?v=...">

                                    <button
                                        type="button"
                                        class="btn btn-outline-danger hapus-link">
                                        Hapus
                                    </button>
                                </div>
                            </div>

                            <button
                                type="button"
                                class="btn btn-outline-success btn-sm"
                                id="tambah-link-video">
                                <i data-feather="plus" class="me-1"></i>
                                Tambah Link Video
                            </button>

                            <small class="album-help">
                                Satu link per kolom. Gunakan URL HTTP/HTTPS yang valid.
                                Link YouTube dapat ditambahkan di sini.
                            </small>
                        </div>

                        {{-- FILE VIDEO --}}
                        <div id="bagian-file-video" style="display: none;">
                            <label class="form-label">Pilih File Video</label>

                            <div id="daftar-file-video">
                                <div class="mb-3 kelompok-file-video">
                                    <input
                                        type="file"
                                        name="video_files[]"
                                        class="form-control"
                                        accept=".mp4,.mov,.avi,.wmv,.webm,.mkv"
                                        multiple>

                                    <small class="album-help">
                                        Bisa memilih beberapa video sekaligus.
                                        Format MP4, MOV, AVI, WMV, WEBM, atau MKV.
                                        Maksimal 100 MB per video.
                                    </small>
                                </div>
                            </div>

                            <button
                                type="button"
                                class="btn btn-outline-secondary btn-sm"
                                id="tambah-file-video">
                                <i data-feather="plus" class="me-1"></i>
                                Tambah Kelompok File Video
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            {{-- MEDIA YANG SUDAH TERSIMPAN --}}
            @if(isset($album) && $album && $album->media->isNotEmpty())
                <div class="album-card">
                    <div class="album-card-header">
                        <i data-feather="archive" class="me-2"></i>
                        Media dalam Album
                    </div>

                    <div class="album-card-body">
                        <p class="text-secondary small mb-3">
                            Centang media yang ingin dihapus.
                            Media yang tidak dicentang akan tetap disimpan.
                        </p>

                        <div class="media-existing-grid">
                            @foreach($album->media as $media)
                                <div class="media-existing-item">
                                    <div class="media-existing-preview">
                                        @if($media->kategori === 'foto')
                                            <a
                                                href="{{ asset('storage/' . $media->file) }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                style="display:block;width:100%;height:100%;">

                                                <img
                                                    src="{{ asset('storage/' . $media->file) }}"
                                                    alt="Foto {{ $album->judul }}"
                                                    loading="lazy">
                                            </a>

                                        @elseif($media->kategori === 'video')
                                            @if(\Illuminate\Support\Str::startsWith($media->file, ['http://', 'https://']))
                                                <a
                                                    href="{{ $media->file }}"
                                                    target="_blank"
                                                    rel="noopener noreferrer">
                                                    <i data-feather="play-circle"></i>
                                                    <span class="d-block">Buka Link Video</span>
                                                </a>
                                            @else
                                                <video controls preload="metadata">
                                                    <source src="{{ asset('storage/' . $media->file) }}">
                                                    Browser tidak mendukung pemutar video.
                                                </video>
                                            @endif
                                        @endif
                                    </div>

                                    <div class="media-existing-info">
                                        <div class="d-flex justify-content-between align-items-center gap-2">
                                            <span>Media {{ $loop->iteration }}</span>

                                            @if($media->kategori === 'foto')
                                                <span class="badge badge-foto">Foto</span>
                                            @else
                                                <span class="badge badge-video">Video</span>
                                            @endif
                                        </div>

                                        <div class="form-check">
                                            <input
                                                type="checkbox"
                                                name="hapus_media[]"
                                                class="form-check-input"
                                                id="hapus_media_{{ $media->id_media }}"
                                                value="{{ Crypt::encrypt($media->id_media) }}">

                                            <label
                                                class="form-check-label text-danger"
                                                for="hapus_media_{{ $media->id_media }}">
                                                Hapus media ini
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            {{-- TOMBOL --}}
            <div class="d-flex flex-wrap justify-content-end gap-2">
                <a
                    href="{{ route('admin.galeri.index') }}"
                    class="btn-batal-album">
                    Batal
                </a>

                <button type="submit" class="btn-simpan-album">
                    <i data-feather="save" class="me-1"></i>
                    {{ isset($album) ? 'Simpan Perubahan' : 'Simpan Album' }}
                </button>
            </div>

        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const kategoriFoto = document.getElementById('kategori_foto');
    const kategoriVideo = document.getElementById('kategori_video');

    const bagianFoto = document.getElementById('bagian-foto');
    const bagianVideo = document.getElementById('bagian-video');

    const metodeVideo = document.getElementById('metode-video');
    const bagianLinkVideo = document.getElementById('bagian-link-video');
    const bagianFileVideo = document.getElementById('bagian-file-video');

    const daftarFoto = document.getElementById('daftar-foto');
    const daftarLinkVideo = document.getElementById('daftar-link-video');
    const daftarFileVideo = document.getElementById('daftar-file-video');

    function tampilkanMetodeVideo() {
        const pakaiLink = metodeVideo.value === 'link';
        const pakaiFile = metodeVideo.value === 'file';

        bagianLinkVideo.style.display = pakaiLink ? 'block' : 'none';
        bagianFileVideo.style.display = pakaiFile ? 'block' : 'none';

        // Bersihkan pilihan metode yang tidak digunakan.
        if (!pakaiLink) {
            daftarLinkVideo.querySelectorAll('input').forEach(input => {
                input.value = '';
            });
        }

        if (!pakaiFile) {
            daftarFileVideo.querySelectorAll('input[type="file"]').forEach(input => {
                input.value = '';
            });
        }
    }

    function tampilkanKategori() {
        const pilihFoto = kategoriFoto.checked;
        const pilihVideo = kategoriVideo.checked;

        bagianFoto.style.display = pilihFoto ? 'block' : 'none';
        bagianVideo.style.display = pilihVideo ? 'block' : 'none';

        if (!pilihFoto) {
            daftarFoto.querySelectorAll('input[type="file"]').forEach(input => {
                input.value = '';
            });
        }

        if (!pilihVideo) {
            metodeVideo.value = '';
            tampilkanMetodeVideo();
        }
    }

    // TAMBAH KELOMPOK FOTO
    document.getElementById('tambah-foto').addEventListener('click', function () {
        const kelompok = document.createElement('div');
        kelompok.className = 'mb-3 kelompok-foto';

        kelompok.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label class="form-label mb-0">Pilih Foto Tambahan</label>
                <button type="button" class="btn btn-outline-danger btn-sm hapus-foto">
                    Hapus
                </button>
            </div>
            <input
                type="file"
                name="foto_files[]"
                class="form-control"
                accept=".jpg,.jpeg,.png,.webp"
                multiple>
            <small class="album-help">
                Bisa memilih beberapa foto sekaligus. Maksimal 10 MB per foto.
            </small>
        `;

        daftarFoto.appendChild(kelompok);
    });

    daftarFoto.addEventListener('click', function (event) {
        const tombol = event.target.closest('.hapus-foto');

        if (tombol) {
            tombol.closest('.kelompok-foto').remove();
        }
    });

    // TAMBAH LINK VIDEO
    document.getElementById('tambah-link-video').addEventListener('click', function () {
        const kelompok = document.createElement('div');
        kelompok.className = 'input-group mb-2 kelompok-link';

        kelompok.innerHTML = `
            <input
                type="url"
                name="video_urls[]"
                class="form-control"
                placeholder="https://www.youtube.com/watch?v=...">
            <button
                type="button"
                class="btn btn-outline-danger hapus-link">
                Hapus
            </button>
        `;

        daftarLinkVideo.appendChild(kelompok);
    });

    daftarLinkVideo.addEventListener('click', function (event) {
        const tombol = event.target.closest('.hapus-link');

        if (!tombol) return;

        const semuaLink = daftarLinkVideo.querySelectorAll('.kelompok-link');

        if (semuaLink.length > 1) {
            tombol.closest('.kelompok-link').remove();
        } else {
            tombol.closest('.kelompok-link').querySelector('input').value = '';
        }
    });

    // TAMBAH KELOMPOK FILE VIDEO
    document.getElementById('tambah-file-video').addEventListener('click', function () {
        const kelompok = document.createElement('div');
        kelompok.className = 'mb-3 kelompok-file-video';

        kelompok.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label class="form-label mb-0">Pilih File Video Tambahan</label>
                <button type="button" class="btn btn-outline-danger btn-sm hapus-file-video">
                    Hapus
                </button>
            </div>
            <input
                type="file"
                name="video_files[]"
                class="form-control"
                accept=".mp4,.mov,.avi,.wmv,.webm,.mkv"
                multiple>
            <small class="album-help">
                Bisa memilih beberapa video sekaligus. Maksimal 100 MB per video.
            </small>
        `;

        daftarFileVideo.appendChild(kelompok);
    });

    daftarFileVideo.addEventListener('click', function (event) {
        const tombol = event.target.closest('.hapus-file-video');

        if (tombol) {
            tombol.closest('.kelompok-file-video').remove();
        }
    });

    kategoriFoto.addEventListener('change', tampilkanKategori);
    kategoriVideo.addEventListener('change', tampilkanKategori);
    metodeVideo.addEventListener('change', tampilkanMetodeVideo);

    tampilkanKategori();
    tampilkanMetodeVideo();

    if (typeof feather !== 'undefined') {
        feather.replace();
    }
});
</script>

@endsection
