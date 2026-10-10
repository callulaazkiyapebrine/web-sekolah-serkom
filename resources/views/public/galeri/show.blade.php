@extends('public.layouts.app')

@section('title', $album->judul . ' - Galeri MAN 2 Tasikmalaya')

@section('content')

<style>
    /* ==============================
       DETAIL GALERI
    ============================== */

    .detail-galeri {
        padding: 35px 0 45px;
        background: #f8faf9;
        min-height: 500px;
    }

    .detail-galeri .container {
        max-width: 1140px;
    }

    /* ==============================
       HEADER ALBUM
    ============================== */

    .detail-header {
        position: relative;
        overflow: hidden;
        padding: 30px 25px;
        margin-bottom: 28px;
        border: 1px solid #e0ebe3;
        border-radius: 14px;
        background: linear-gradient(135deg, #eaf5ed 0%, #ffffff 85%);
        text-align: center;
    }

    .detail-label {
        display: inline-block;
        margin-bottom: 10px;
        color: #087f5b;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .detail-title {
        margin: 0 0 12px;
        color: #1f2937;
        font-size: clamp(25px, 3vw, 34px);
        font-weight: 750;
        line-height: 1.3;
        overflow-wrap: anywhere;
    }

    .detail-date {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 12px;
        border: 1px solid #dce9df;
        border-radius: 8px;
        background: #fff;
        color: #087f5b;
        font-size: 12px;
        font-weight: 600;
    }

    .detail-date i {
        width: 15px;
        height: 15px;
    }

    .detail-keterangan {
        max-width: 680px;
        margin: 13px auto 0;
        color: #657168;
        font-size: 14px;
        line-height: 1.7;
        overflow-wrap: anywhere;
    }

    /* ==============================
       PEMISAH
    ============================== */

    .detail-divider {
        height: 1px;
        margin: 24px 0;
        background: #e2e9e4;
    }

    /* ==============================
       GRID FOTO DAN VIDEO
    ============================== */

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .detail-media-card {
        min-width: 0;
        overflow: hidden;
        border: 1px solid #e4eae5;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 2px 7px rgba(25, 60, 40, .03);
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .detail-media-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 9px 22px rgba(25, 60, 40, .09);
    }

    .detail-media {
        position: relative;
        width: 100%;
        aspect-ratio: 4 / 3;
        overflow: hidden;
        background: #e9f1eb;
    }

    .detail-media img,
    .detail-media video,
    .detail-media iframe {
        display: block;
        width: 100%;
        height: 100%;
        border: 0;
    }

    .detail-media img {
        object-fit: cover;
        transition: transform .35s ease;
    }

    .detail-media-card:hover .detail-media img {
        transform: scale(1.035);
    }

    .detail-media video {
        object-fit: contain;
        background: #111;
    }

    .detail-media iframe {
        position: absolute;
        inset: 0;
    }

    /* ==============================
       VIDEO DENGAN TAUTAN
    ============================== */

    .detail-media-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        height: 100%;
        padding: 15px;
        color: #657168;
        text-align: center;
        font-size: 13px;
    }

    .detail-media-placeholder>i {
        width: 32px;
        height: 32px;
        color: #087f5b;
    }

    .detail-video-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 9px 13px;
        border-radius: 7px;
        background: #087f5b;
        color: #fff;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        transition: background .2s ease;
    }

    .detail-video-link:hover {
        background: #056b4c;
        color: #fff;
    }

    .detail-video-link i {
        width: 15px;
        height: 15px;
    }

    /* ==============================
       LABEL MEDIA
    ============================== */

    .detail-media-info {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 11px 14px;
        color: #53675a;
        font-size: 12px;
        font-weight: 600;
    }

    .detail-media-info i {
        width: 16px;
        height: 16px;
        color: #087f5b;
    }

    /* ==============================
       ALBUM KOSONG
    ============================== */

    .detail-empty {
        padding: 35px 15px;
        border: 1px dashed #d6e3d9;
        border-radius: 12px;
        background: #fff;
        color: #6b7280;
        text-align: center;
    }

    .detail-empty i {
        width: 35px;
        height: 35px;
        margin-bottom: 10px;
        color: #087f5b;
    }

    .detail-empty p {
        margin: 0;
        font-size: 13px;
    }

    /* ==============================
       TOMBOL LIHAT SEMUA ALBUM
    ============================== */

    .detail-footer {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        margin: 28px 0 0;
    }

    .detail-footer .detail-button {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 7px;
        min-height: 40px;
        padding: 9px 17px;
        margin: 0;
        border: 1px solid #198754;
        border-radius: 8px;
        background: #198754;
        color: #fff;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: none;
        transform: none;
        transition: background-color 0.2s ease,
            border-color 0.2s ease;
    }

    .detail-footer .detail-button:hover {
        background: #146c43;
        border-color: #146c43;
        color: #fff;
        box-shadow: none;
        transform: none;
    }

    .detail-footer .detail-button i {
        width: 16px;
        height: 16px;
        transition: none;
    }



    /* TOMBOL LIHAT SEMUA ALBUM */
    .detail-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 11px 20px;
        border: 1px solid #198754;
        border-radius: 7px;
        background: #198754;
        color: #fff;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        box-shadow: 0 3px 8px rgba(25, 135, 84, 0.18);
        transition: all 0.25s ease;
    }

    .detail-button i {
        width: 16px;
        height: 16px;
        transition: transform 0.25s ease;
    }

    /* EFEK SAAT KURSOR DIARAHKAN */
    .detail-button:hover {
        background: #146c43;
        border-color: #146c43;
        color: #fff;
        box-shadow: 0 6px 15px rgba(25, 135, 84, 0.28);
        transform: translateY(-3px);
    }

    .detail-button:hover i {
        transform: translateX(-4px);
    }

    /* EFEK SAAT DITEKAN */
    .detail-button:active {
        transform: translateY(-1px) scale(0.98);
        box-shadow: 0 2px 5px rgba(25, 135, 84, 0.2);
    }

    /* AKSESIBILITAS */
    .detail-button:focus-visible {
        outline: 3px solid rgba(25, 135, 84, 0.3);
        outline-offset: 3px;
    }

    /* ==============================
       TABLET
    ============================== */

    @media (max-width: 991px) {
        .detail-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
        }
    }

    /* ==============================
       HP
    ============================== */

    @media (max-width: 575px) {
        .detail-galeri {
            padding: 24px 0 32px;
        }

        .detail-header {
            padding: 24px 16px;
            margin-bottom: 22px;
            border-radius: 11px;
        }

        .detail-title {
            font-size: 25px;
        }

        .detail-keterangan {
            font-size: 13px;
        }

        .detail-divider {
            margin: 18px 0;
        }

        .detail-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .detail-footer {
            margin-top: 23px;
        }
    }
</style>

<section class="detail-galeri">
    <div class="container">

        {{-- INFORMASI ALBUM --}}
        <div class="detail-header">

            <div class="detail-label">
                Dokumentasi Kegiatan
            </div>

            <h1 class="detail-title">
                {{ $album->judul }}
            </h1>

            @if($album->tanggal)
            <div class="detail-date">
                <i data-feather="calendar"></i>
                {{ \Carbon\Carbon::parse($album->tanggal)->translatedFormat('d F Y') }}
            </div>
            @endif

            @if($album->keterangan)
            <div class="detail-keterangan">
                {!! nl2br(e($album->keterangan)) !!}
            </div>
            @endif

        </div>

        <div class="detail-divider"></div>

        {{-- FOTO DAN VIDEO ALBUM --}}
        @if($album->media->count())

        <div class="detail-grid">

            @foreach($album->media as $media)

            <div class="detail-media-card">

                <div class="detail-media">

                    @if($media->kategori === 'foto')

                    <img
                        src="{{ asset('storage/' . $media->file) }}"
                        alt="{{ $album->judul }}"
                        loading="lazy">

                    @elseif($media->kategori === 'video')

                    @php
                    $urlVideo = trim($media->file);
                    $videoId = null;

                    if (preg_match(
                    '~(?:youtube\.com/(?:watch\?(?:[^#]*&)?v=|embed/|shorts/)|youtu\.be/)([a-zA-Z0-9_-]{11})~',
                    $urlVideo,
                    $cocok
                    )) {
                    $videoId = $cocok[1];
                    }

                    $isUrl = \Illuminate\Support\Str::startsWith(
                    $urlVideo,
                    ['http://', 'https://']
                    );
                    @endphp

                    @if($isUrl && $videoId)

                    <iframe
                        src="https://www.youtube.com/embed/{{ $videoId }}"
                        title="{{ $album->judul }}"
                        loading="lazy"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>

                    @elseif($isUrl)

                    <div class="detail-media-placeholder">
                        <i data-feather="video"></i>

                        <span>
                            Video tersedia melalui tautan
                        </span>

                        <a
                            href="{{ $urlVideo }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="detail-video-link">
                            <i data-feather="external-link"></i>
                            Tonton Video
                        </a>
                    </div>

                    @else

                    <video controls preload="metadata">
                        <source src="{{ asset('storage/' . $urlVideo) }}">
                        Browser kamu tidak mendukung pemutaran video.
                    </video>

                    @endif

                    @endif

                </div>

                <div class="detail-media-info">
                    @if($media->kategori === 'foto')
                    <i data-feather="image"></i>
                    Foto Kegiatan
                    @else
                    <i data-feather="video"></i>
                    Video Kegiatan
                    @endif
                </div>

            </div>

            @endforeach

        </div>

        @else

        <div class="detail-empty">
            <i data-feather="image"></i>
            <p>Belum ada foto atau video dalam album ini.</p>
        </div>

        @endif

        {{-- SATU TOMBOL DI BAGIAN BAWAH --}}
        <div class="detail-footer">
            <a href="{{ route('public.galeri') }}" class="detail-button">
                <i data-feather="arrow-left"></i>
                Lihat Semua Album
            </a>
        </div>

    </div>
</section>

@endsection