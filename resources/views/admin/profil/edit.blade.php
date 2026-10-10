@extends('admin')

@section('title', 'Edit Profil Sekolah')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">
                Edit Profil Sekolah
            </h2>

            <p class="text-muted mb-0">
                Ubah informasi profil sekolah
            </p>
        </div>

        <a href="{{ route('admin.profil.index') }}"
            class="btn btn-secondary">

            <i data-feather="arrow-left"></i>

            Kembali

        </a>

    </div>


    {{-- =========================================================
        ALERT
    ========================================================== --}}

    @if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

    @endif


    @if(session('error'))

    <div class="alert alert-danger">
        {{ session('error') }}
    </div>

    @endif


    @if($errors->any())

    <div class="alert alert-danger">

        <strong>
            Periksa kembali data berikut:
        </strong>

        <ul class="mb-0 mt-2">

            @foreach($errors->all() as $error)

            <li>
                {{ $error }}
            </li>

            @endforeach

        </ul>

    </div>

    @endif


    {{-- =========================================================
        FORM
    ========================================================== --}}

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form
                action="{{ route('admin.profil.save') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf


                {{-- =================================================
                    LOGO
                ================================================== --}}

                <div class="mb-4">

                    <label class="form-label fw-bold">
                        Logo Sekolah
                    </label>


                    @if($profilSekolah->logo)

                    <div class="mb-3">

                        <img
                            src="{{ asset('storage/' . $profilSekolah->logo) }}"
                            alt="Logo Sekolah"
                            style="
                                    width: 120px;
                                    height: 120px;
                                    object-fit: contain;
                                    border: 1px solid #ddd;
                                    border-radius: 12px;
                                    padding: 8px;
                                ">

                    </div>

                    @endif


                    <input
                        type="file"
                        name="logo"
                        class="form-control"
                        accept="image/*">


                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti logo.
                    </small>

                </div>

                <div class="row">


                    {{-- =================================================
                        NAMA SEKOLAH
                    ================================================== --}}

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Nama Sekolah
                        </label>

                        <input
                            type="text"
                            name="nama_sekolah"
                            class="form-control"
                            value="{{ old('nama_sekolah', $profilSekolah->nama_sekolah) }}"
                            required>

                    </div>

                    {{-- =================================================
                        NPSN
                    ================================================== --}}

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            NPSN
                        </label>

                        <input
                            type="text"
                            name="npsn"
                            class="form-control"
                            value="{{ old('npsn', $profilSekolah->npsn) }}">

                    </div>

                    {{-- =================================================
                        MEDIA SOSIAL
                    ================================================== --}}

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Instagram
                        </label>

                        <input
                            type="text"
                            name="instagram"
                            class="form-control"
                            value="{{ old('instagram', $profilSekolah->instagram) }}"
                            placeholder="https://instagram.com/...">

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            TikTok
                        </label>

                        <input
                            type="text"
                            name="tiktok"
                            class="form-control"
                            value="{{ old('tiktok', $profilSekolah->tiktok) }}"
                            placeholder="https://tiktok.com/@...">

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            YouTube
                        </label>

                        <input
                            type="text"
                            name="youtube"
                            class="form-control"
                            value="{{ old('youtube', $profilSekolah->youtube) }}"
                            placeholder="https://youtube.com/...">

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Facebook
                        </label>

                        <input
                            type="text"
                            name="facebook"
                            class="form-control"
                            value="{{ old('facebook', $profilSekolah->facebook) }}"
                            placeholder="https://facebook.com/...">

                    </div>


                    {{-- =================================================
                        KEPALA SEKOLAH
                    ================================================== --}}

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Kepala Sekolah
                        </label>

                        <input
                            type="text"
                            name="kepala_sekolah"
                            class="form-control"
                            value="{{ old('kepala_sekolah', $profilSekolah->kepala_sekolah) }}">

                    </div>


                    {{-- =================================================
                        TAHUN BERDIRI
                    ================================================== --}}

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Tahun Berdiri
                        </label>

                        <input
                            type="text"
                            name="tahun_berdiri"
                            class="form-control"
                            value="{{ old('tahun_berdiri', $profilSekolah->tahun_berdiri) }}">

                    </div>


                    {{-- =================================================
                        KONTAK
                    ================================================== --}}

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-bold">
                            Kontak
                        </label>

                        <input
                            type="text"
                            name="kontak"
                            class="form-control"
                            value="{{ old('kontak', $profilSekolah->kontak) }}">

                    </div>


                    {{-- =================================================
                        ALAMAT
                    ================================================== --}}

                    <div class="col-12 mb-3">

                        <label class="form-label fw-bold">
                            Alamat
                        </label>

                        <textarea
                            name="alamat"
                            class="form-control"
                            rows="3">{{ old('alamat', $profilSekolah->alamat) }}</textarea>

                    </div>


                    {{-- =================================================
                        FOTO SEKOLAH
                    ================================================== --}}

                    <div class="col-12 mb-3">

                        <label class="form-label fw-bold">
                            Foto Sekolah
                        </label>


                        @if($profilSekolah->foto)

                        <div class="mb-3">

                            <img
                                src="{{ asset('storage/' . $profilSekolah->foto) }}"
                                alt="Foto Sekolah"
                                style="
                                        width: 250px;
                                        height: 150px;
                                        object-fit: cover;
                                        border-radius: 10px;
                                    ">

                        </div>

                        @endif


                        <input
                            type="file"
                            name="foto"
                            class="form-control"
                            accept="image/*">


                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti foto.
                        </small>

                    </div>


                    {{-- =================================================
                        DESKRIPSI
                    ================================================== --}}

                    <div class="col-12 mb-3">

                        <label class="form-label fw-bold">
                            Deskripsi Sekolah
                        </label>

                        <textarea
                            name="deskripsi"
                            class="form-control"
                            rows="5">{{ old('deskripsi', $profilSekolah->deskripsi) }}</textarea>

                    </div>


                    {{-- =================================================
                        VISI & MISI
                    ================================================== --}}

                    <div class="col-12 mb-4">

                        <label class="form-label fw-bold">
                            Visi & Misi
                        </label>


                        <textarea
                            name="visi_misi"
                            class="form-control"
                            rows="9"
                            placeholder="Masukkan visi dan misi sekolah">{{ old('visi_misi', $profilSekolah->visi_misi) }}</textarea>

                    </div>


                    {{-- =================================================
                    BUTTON
                ================================================== --}}

                    <div class="d-flex justify-content-end gap-2">

                        <a
                            href="{{ route('admin.profil.index') }}"
                            class="btn btn-secondary">

                            Batal

                        </a>

                        <button
                            type="submit"
                            class="btn btn-simpan">

                            <i data-feather="save"></i>

                            Simpan Perubahan

                        </button>

                    </div>


            </form>

        </div>

    </div>

</div>
<style>
    /* HALAMAN EDIT PROFIL */
    .container.py-4 {
        padding-top: 5px !important;
    }

    .container.py-4 h2 {
        color: #0b5d3b;
        font-weight: 700;
    }

    .container.py-4 .text-muted {
        color: #64746a !important;
    }

    /* KARTU FORM */
    .container.py-4 .card {
        border: 1px solid #dce9df !important;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(11, 93, 59, 0.06) !important;
    }

    /* LABEL INPUT */
    .container.py-4 .form-label {
        color: #294b38;
    }

    /* INPUT DAN TEXTAREA */
    .container.py-4 .form-control {
        border: 1px solid #d5e2d9;
        border-radius: 8px;
    }

    .container.py-4 .form-control:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.12);
    }

    /* TOMBOL SIMPAN */
    .btn-simpan {
        background: #198754;
        color: #fff;
        border: 1px solid #198754;
        padding: 8px 16px;
        border-radius: 8px;
        transition: 0.3s;
    }

    .btn-simpan:hover {
        background: #0b5d3b;
        border-color: #0b5d3b;
        color: #fff;
    }

    .btn-simpan i {
        width: 16px;
        height: 16px;
        margin-right: 5px;
        vertical-align: middle;
    }

    /* TOMBOL KEMBALI DAN BATAL */
    .container.py-4 .btn-secondary {
        background: #198754;
        color: #fff;
        border: 1px solid #198754;
        border-radius: 8px;
    }

    .container.py-4 .btn-secondary:hover {
        background: #0b5d3b;
        border-color: #0b5d3b;
        color: #fff;
    }

    /* RESPONSIF */
    @media (max-width: 768px) {
        .container.py-4 {
            padding-left: 15px;
            padding-right: 15px;
        }
    }
</style>

@endsection