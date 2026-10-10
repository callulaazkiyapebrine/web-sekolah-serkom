@extends('admin')

@section('title', 'Dashboard Admin - MAN 2 TASIKMALAYA')

@section('content')

<style>
    /* =========================
       DASHBOARD TEMA HIJAU
    ========================= */

    .dashboard-content {
        margin-top: -20px;
    }

    /* =========================
       WELCOME CARD
    ========================= */

    .welcome-card {
        background: linear-gradient(135deg,
                #198754,
                #0b5d3b);
        border-radius: 12px;
    }

    /* =========================
       STATISTIK CARD
    ========================= */

    .dashboard-card {
        border-radius: 12px;
        transition: all 0.2s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-3px);
    }

    /* Icon statistik */
    .stat-icon {
        background: #e8f5ee !important;
        color: #198754 !important;
    }

    .stat-icon i {
        color: #198754 !important;
    }

    /* Angka statistik */
    .text-green {
        color: #198754 !important;
    }

    /* =========================
       TOMBOL MENU CEPAT
    ========================= */

    .btn-green {
        background-color: #198754 !important;
        border-color: #198754 !important;
        color: #fff !important;
        transition: all 0.2s ease;
    }

    .btn-green:hover {
        background-color: #146c43 !important;
        border-color: #146c43 !important;
        color: #fff !important;
        transform: translateY(-2px);
    }

    .btn-green i {
        color: #fff !important;
    }

    /* =========================
       STATUS SISTEM
    ========================= */

    .badge-green {
        background-color: #198754 !important;
        color: #fff !important;
    }

    .badge-green i {
        color: #fff !important;
    }

    /* =========================
       CARD HEADER
    ========================= */

    .dashboard-header {
        border-radius: 12px 12px 0 0;
    }
</style>


<div class="container-fluid p-0 dashboard-content">
{{-- =========================
     SELAMAT DATANG
========================== --}}
<div class="row mb-5">
    <div class="col-12">
        <div class="card border-0 shadow-sm welcome-card">
            <div class="card-body px-4 py-4 text-white">

                <h2 class="fw-bold mb-2 text-white">
                    Selamat Datang,
                    {{ Auth::user()->role == 'admin'
                        ? 'Admin'
                        : ucfirst(Auth::user()->username) }}!
                </h2>

                <p class="mb-0">
                    Selamat datang di halaman administrator
                    <strong>MAN 2 Tasikmalaya</strong>.
                    Silakan gunakan menu yang tersedia untuk
                    mengelola sistem sekolah.
                </p>

            </div>
        </div>
    </div>
</div>

    {{-- =========================
         STATISTIK
    ========================== --}}
    <div class="row g-4 mb-5">

        {{-- SISWA --}}
        <div class="col-12 col-md-6 col-xl-4">

            <div class="card border-0 shadow-sm h-100 dashboard-card">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="text-muted mb-2">
                                Total Siswa
                            </h6>

                            <h2 class="fw-bold text-green mb-1">
                                {{ $jumlahSiswa ?? 0 }}
                            </h2>

                            <small class="text-muted">
                                Siswa terdaftar
                            </small>

                        </div>

                        <div class="rounded-circle p-3 stat-icon">

                            <i data-feather="users"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- GURU --}}
        <div class="col-12 col-md-6 col-xl-4">

            <div class="card border-0 shadow-sm h-100 dashboard-card">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="text-muted mb-2">
                                Total Guru
                            </h6>

                            <h2 class="fw-bold text-green mb-1">
                                {{ $jumlahGuru ?? 0 }}
                            </h2>

                            <small class="text-muted">
                                Guru terdaftar
                            </small>

                        </div>

                        <div class="rounded-circle p-3 stat-icon">

                            <i data-feather="user-check"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- BERITA --}}
        <div class="col-12 col-md-6 col-xl-4">

            <div class="card border-0 shadow-sm h-100 dashboard-card">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="text-muted mb-2">
                                Total Berita
                            </h6>

                            <h2 class="fw-bold text-green mb-1">
                                {{ $jumlahBerita ?? 0 }}
                            </h2>

                            <small class="text-muted">
                                Berita dipublikasikan
                            </small>

                        </div>

                        <div class="rounded-circle p-3 stat-icon">

                            <i data-feather="file-text"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- EKSTRAKURIKULER --}}
        <div class="col-12 col-md-6 col-xl-4">

            <div class="card border-0 shadow-sm h-100 dashboard-card">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="text-muted mb-2">
                                Total Ekstrakurikuler
                            </h6>

                            <h2 class="fw-bold text-green mb-1">
                                {{ $jumlahEkstrakurikuler ?? 0 }}
                            </h2>

                            <small class="text-muted">
                                Kegiatan Ekstrakurikuler
                            </small>

                        </div>

                        <div class="rounded-circle p-3 stat-icon">

                            <i data-feather="image"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- PRESTASI --}}
        <div class="col-12 col-md-6 col-xl-4">

            <div class="card border-0 shadow-sm h-100 dashboard-card">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="text-muted mb-2">
                                Total Prestasi
                            </h6>

                            <h2 class="fw-bold text-green mb-1">
                                {{ $jumlahPrestasi ?? 0 }}
                            </h2>

                            <small class="text-muted">
                                Prestasi Tercatat
                            </small>

                        </div>

                        <div class="rounded-circle p-3 stat-icon">

                            <i data-feather="image"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- GALERI --}}
        <div class="col-12 col-md-6 col-xl-4">

            <div class="card border-0 shadow-sm h-100 dashboard-card">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="text-muted mb-2">
                                Total Galeri
                            </h6>

                            <h2 class="fw-bold text-green mb-1">
                                {{ $jumlahGaleri ?? 0 }}
                            </h2>

                            <small class="text-muted">
                                Foto dalam galeri
                            </small>

                        </div>

                        <div class="rounded-circle p-3 stat-icon">

                            <i data-feather="image"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>


    {{-- =========================
         MENU CEPAT
    ========================== --}}
    <div class="row mb-5">

        <div class="col-12">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 pt-4 px-4 dashboard-header">

                    <h5 class="fw-bold mb-1">
                        Menu Cepat
                    </h5>

                    <p class="text-muted mb-0">
                        Kelola data sekolah
                    </p>

                </div>

                <div class="card-body px-4 pb-4">

                    <div class="row g-3">

                        {{-- PROFIL SEKOLAH --}}
                        <div class="col-12 col-md-6">

                            <a href="{{ route('admin.profil.index') }}"
                                class="btn btn-green w-100 py-3">

                                <i data-feather="user-check"
                                    class="me-2">
                                </i>

                                Kelola Data Profil

                            </a>

                        </div>


                        {{-- GURU --}}
                        <div class="col-12 col-md-6">

                            <a href="{{ route('admin.guru.index') }}"
                                class="btn btn-green w-100 py-3">

                                <i data-feather="user-check"
                                    class="me-2">
                                </i>

                                Kelola Data Guru

                            </a>

                        </div>

                        {{-- SISWA --}}
                        <div class="col-12 col-md-6">

                            <a href="{{ route('admin.siswa.index') }}"
                                class="btn btn-green w-100 py-3">

                                <i data-feather="users"
                                    class="me-2">
                                </i>

                                Kelola Data Siswa

                            </a>

                        </div>

                        {{-- USER --}}
                        <div class="col-12 col-md-6">

                            <a href="{{ route('admin.user.index') }}"
                                class="btn btn-green w-100 py-3">

                                <i data-feather="image"
                                    class="me-2">
                                </i>

                                Kelola User

                            </a>

                        </div>

                        {{-- BERITA --}}
                        <div class="col-12 col-md-6">

                            <a href="{{ route('admin.berita.index') }}"
                                class="btn btn-green w-100 py-3">

                                <i data-feather="file-text"
                                    class="me-2">
                                </i>

                                Kelola Berita

                            </a>

                        </div>

                        {{-- EKSTRAKURIKULER --}}
                        <div class="col-12 col-md-6">

                            <a href="{{ route('admin.ekstrakurikuler.index') }}"
                                class="btn btn-green w-100 py-3">

                                <i data-feather="file-text"
                                    class="me-2">
                                </i>

                                Kelola Ekstrakurikuler

                            </a>

                        </div>


                        {{-- PRESTASI --}}
                        <div class="col-12 col-md-6">

                            <a href="{{ route('admin.prestasi.index') }}"
                                class="btn btn-green w-100 py-3">

                                <i data-feather="image"
                                    class="me-2">
                                </i>

                                Kelola Prestasi

                            </a>

                        </div>

                        {{-- GALERI --}}
                        <div class="col-12 col-md-6">

                            <a href="{{ route('admin.galeri.index') }}"
                                class="btn btn-green w-100 py-3">

                                <i data-feather="image"
                                    class="me-2">
                                </i>

                                Kelola Galeri

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection