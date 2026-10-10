@extends('admin')

@section('title', 'Profil Sekolah - MAN 2 Tasikmalaya')

@section('content')

<style>
    .profil-page {
        background: #f5faf7;
        min-height: 100vh;
        padding: 5px 30px 30px;
    }

    /* HEADER */
    .profil-header h4 {
        color: #0b5d3b;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .profil-header p {
        color: #64746a;
        font-size: 14px;
    }

    /* TOMBOL EDIT */
    .btn-edit {
        background: #198754;
        color: #fff;
        border: 1px solid #198754;
        border-radius: 8px;
        padding: 8px 16px;
        transition: 0.3s;
    }

    .btn-edit:hover {
        background: #0b5d3b;
        border-color: #0b5d3b;
        color: #fff;
    }

    /* PROFIL UTAMA */
    .profil-hero {
        background: linear-gradient(135deg, #0b5d3b, #198754);
        border-radius: 16px;
        overflow: hidden;
        color: #fff;
        box-shadow: 0 5px 20px rgba(11, 93, 59, 0.06);
    }

    .profil-foto {
        width: 100%;
        height: 100%;
        min-height: 420px;
        object-fit: cover;
        display: block;
    }

    .profil-foto-empty {
        min-height: 330px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.08);
    }

    .profil-content {
        padding: 30px;
    }

    .profil-logo {
        width: 75px;
        height: 75px;
        object-fit: contain;
        margin-bottom: 0;
        flex-shrink: 0;
    }

    .profil-nama {
        font-size: 25px;
        font-weight: 700;
        margin: 0 0 0 12px;
        line-height: 1.4;
        overflow-wrap: anywhere;
    }

    .profil-slogan {
        color: #b9f3d0;
        font-size: 14px;
        margin-top: 3px;
    }

    .profil-detail {
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        margin-top: 22px;
        padding-top: 20px;
    }

    .profil-detail small {
        display: block;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 4px;
    }

    .profil-detail strong {
        font-size: 15px;
        overflow-wrap: anywhere;
    }

    /* KARTU INFORMASI */
    .profil-box,
    .alamat-box {
        background: #fff;
        border: 1px solid #dce9df;
        border-radius: 14px;
        padding: 24px;
        box-shadow: 0 5px 20px rgba(11, 93, 59, 0.05);
    }

    .profil-box {
        height: 100%;
    }

    .profil-box-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .profil-box-title h5 {
        color: #0b5d3b;
        font-weight: 700;
        margin: 0;
    }

    .profil-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #e8f6ee;
        color: #198754;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        flex-shrink: 0;
    }

    /* TEKS */
    .profil-text,
    .alamat-text {
        color: #64746a;
        line-height: 1.8;
        margin: 0;
        overflow-wrap: anywhere;
    }

    .visi-misi-title {
        margin-bottom: 0;
    }

    .visi-misi-text {
        white-space: pre-line;
        margin-top: 10px;
    }

    /* MEDIA SOSIAL */
    .media-sosial {
        color: #198754;
        background: #fff;
        border: 1px solid #198754;
        border-radius: 8px;
        padding: 8px 14px;
        transition: 0.3s;
    }

    .media-sosial:hover {
        background: #198754;
        color: #fff;
    }

    /* RESPONSIF */
    @media (max-width: 768px) {
        .profil-page {
            padding: 15px;
        }

        .profil-content {
            padding: 22px;
        }

        .profil-foto {
            height: 280px;
            min-height: 280px;
        }

        .profil-foto-empty {
            min-height: 220px;
        }

        .profil-nama {
            font-size: 21px;
            margin-left: 0;
        }

        .profil-logo {
            width: 60px;
            height: 60px;
        }

        .profil-box,
        .alamat-box {
            padding: 20px;
        }
    }
</style>


<div class="profil-page">

    {{-- HEADER --}}
    <div class="profil-header d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                Profil Sekolah
            </h4>

            <p class="mb-0">
                Informasi dan identitas sekolah
            </p>
        </div>

        @if(Auth::user()->role == 'admin')

        <a href="{{ route('admin.profil.edit', $profilSekolah->id_profil) }}"
            class="btn btn-edit">

            <i class="bi bi-pencil me-1"></i>
            Edit Profil

        </a>

        @endif

    </div>


    {{-- PROFIL UTAMA --}}
    <div class="profil-hero mb-4">

        <div class="row g-0">

            {{-- FOTO SEKOLAH --}}
            <div class="col-lg-5">

                @if($profilSekolah->foto)

                <img src="{{ asset('storage/' . $profilSekolah->foto) }}"
                    class="profil-foto">

                @else

                <div class="profil-foto-empty">
                    <i class="bi bi-building" style="font-size: 70px;"></i>
                </div>

                @endif

            </div>


            {{-- INFORMASI UTAMA --}}
            <div class="col-lg-7">

                <div class="profil-content">

                    <div class="d-flex align-items-center gap-3">

                        @if($profilSekolah->logo)

                        <img src="{{ asset('storage/' . $profilSekolah->logo) }}"
                            class="profil-logo">

                        @endif

                        <div>
                            <div class="profil-nama">
                                {{ $profilSekolah->nama_sekolah }}
                            </div>

                        </div>

                    </div>

                    <div class="profil-detail">

                        <div class="row g-4">

                            <div class="col-md-12">

                                <small>
                                    Kepala Sekolah
                                </small>

                                <strong>
                                    {{ $profilSekolah->kepala_sekolah }}
                                </strong>

                            </div>

                            <div class="col-md-12">

                                <small>
                                    NPSN
                                </small>

                                <strong>
                                    NPSN {{ $profilSekolah->npsn }}
                                </strong>

                            </div>


                            <div class="col-md-12">

                                <small>
                                    Tahun Berdiri
                                </small>

                                <strong>
                                    {{ $profilSekolah->tahun_berdiri }}
                                </strong>

                            </div>


                            <div class="col-12">

                                <small>
                                    Kontak
                                </small>

                                <strong>
                                    {{ $profilSekolah->kontak }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ALAMAT FULL --}}
    <div class="alamat-box mb-4">

        <div class="profil-box-title">

            <h5>
                Alamat Sekolah
            </h5>

        </div>

        <p class="alamat-text">
            {{ $profilSekolah->alamat }}
        </p>

    </div>

    {{-- MEDIA SOSIAL --}}
    <div class="alamat-box mb-4">

        <div class="profil-box-title">

            <h5>
                Media Sosial
            </h5>

        </div>

        <div class="d-flex flex-wrap gap-2">

            @if($profilSekolah->instagram)
            <a href="{{ $profilSekolah->instagram }}"
                target="_blank"
                class="btn media-sosial">
                <i class="bi bi-instagram me-1"></i>
                Instagram
            </a>
            @endif

            @if($profilSekolah->tiktok)
            <a href="{{ $profilSekolah->tiktok }}"
                target="_blank"
                class="btn media-sosial">
                <i class="bi bi-tiktok me-1"></i>
                TikTok
            </a>
            @endif

            @if($profilSekolah->youtube)
            <a href="{{ $profilSekolah->youtube }}"
                target="_blank"
                class="btn media-sosial">
                <i class="bi bi-youtube me-1"></i>
                YouTube
            </a>
            @endif

            @if($profilSekolah->facebook)
            <a href="{{ $profilSekolah->facebook }}"
                target="_blank"
                class="btn media-sosial">
                <i class="bi bi-facebook me-1"></i>
                Facebook
            </a>
            @endif

        </div>

    </div>


    {{-- VISI MISI + DESKRIPSI --}}
    <div class="row g-4">

        {{-- VISI MISI --}}
        <div class="col-lg-6">

            <div class="profil-box">

                <div class="profil-box-title visi-misi-title">
                    <h5>Visi & Misi</h5>
                </div>

                <p class="profil-text visi-misi-text">
                    {{ $profilSekolah->visi_misi }}
                </p>

            </div>
        </div>


        {{-- DESKRIPSI --}}
        <div class="col-lg-6">

            <div class="profil-box">

                <div class="profil-box-title">

                    <h5>
                        Tentang Sekolah
                    </h5>

                </div>

                <p class="profil-text">
                    {{ $profilSekolah->deskripsi }}
                </p>

            </div>

        </div>

    </div>

</div>

@endsection