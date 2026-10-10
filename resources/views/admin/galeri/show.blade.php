@extends('admin')

@section('title', 'Detail Album Galeri')

@section('content')

<style>
    .detail-galeri {
        max-width: 1100px;
        margin: 0 auto;
        color: #26352c;
    }

    .galeri-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
    }

    .galeri-heading {
        margin: 0 0 6px;
        color: #0b5d3b;
        font-size: 25px;
        font-weight: 700;
    }

    .galeri-subtitle {
        margin: 0;
        color: #78847c;
        font-size: 14px;
    }

    .btn-kembali-galeri {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 17px;
        border: 1px solid #0b5d3b;
        border-radius: 9px;
        background: #fff;
        color: #0b5d3b;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-kembali-galeri:hover {
        background: #0b5d3b;
        color: #fff;
    }

    .galeri-card {
        overflow: hidden;
        border: 1px solid #e5ebe6;
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 5px 20px rgba(20, 60, 35, .05);
    }

    .galeri-card-header {
        display: flex;
        align-items: center;
        gap: 17px;
        padding: 26px 30px;
        border-bottom: 1px solid #e2ebe4;
        background: #f1f7f2;
    }

    .galeri-avatar {
        display: flex;
        flex-shrink: 0;
        width: 58px;
        height: 58px;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #dceee1;
        color: #0b5d3b;
    }

    .galeri-avatar svg {
        width: 27px;
        height: 27px;
    }

    .galeri-label {
        margin-bottom: 6px;
        color: #0b5d3b;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .8px;
        text-transform: uppercase;
    }

    .galeri-title {
        margin: 0;
        color: #173b2a;
        font-size: 24px;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .galeri-card-body {
        padding: 28px 30px;
    }

    .galeri-section-title {
        margin: 0 0 17px;
        color: #0b5d3b;
        font-size: 15px;
        font-weight: 700;
    }

    .galeri-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 15px;
    }

    .galeri-info-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        min-width: 0;
        padding: 17px;
        border: 1px solid #e8eee9;
        border-radius: 11px;
        background: #f8faf8;
    }

    .galeri-info-icon {
        display: flex;
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #dceee1;
        color: #0b5d3b;
    }

    .galeri-info-icon svg {
        width: 19px;
        height: 19px;
    }

    .galeri-info-label {
        margin-bottom: 6px;
        color: #78847c;
        font-size: 12px;
    }

    .galeri-info-value {
        color: #26352c;
        font-size: 14px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .galeri-divider {
        margin: 27px 0;
        border: 0;
        border-top: 1px solid #e5ebe6;
        opacity: 1;
    }

    .galeri-keterangan {
        padding: 18px;
        border: 1px solid #e8eee9;
        border-radius: 11px;
        background: #f8faf8;
        color: #37483d;
        font-size: 14px;
        line-height: 1.8;
        overflow-wrap: anywhere;
    }

    .galeri-kosong {
        padding: 35px 20px;
        border: 1px dashed #cbd9ce;
        border-radius: 12px;
        color: #78847c;
        text-align: center;
        font-size: 14px;
    }

    .galeri-media-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .galeri-media-item {
        min-width: 0;
        overflow: hidden;
        border: 1px solid #e5ebe6;
        border-radius: 12px;
        background: #fff;
    }

    .galeri-media-preview {
        display: flex;
        height: 210px;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #f1f7f2;
    }

    .galeri-media-preview img,
    .galeri-media-preview video {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .galeri-video-link {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 12px;
        width: 100%;
        height: 100%;
        padding: 20px;
        color: #0b5d3b;
        text-align: center;
        text-decoration: none;
        overflow-wrap: anywhere;
    }

    .galeri-video-link svg {
        width: 40px;
        height: 40px;
    }

    .galeri-media-caption {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        padding: 13px;
        border-top: 1px solid #e8eee9;
    }

    .galeri-media-caption > span:first-child {
        color: #526157;
        font-size: 12px;
    }

    .galeri-badge {
        display: inline-flex;
        align-items: center;
        flex-shrink: 0;
        padding: 5px 9px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-foto {
        background: #dceee1;
        color: #0b5d3b;
    }

    .badge-video {
        background: #eef2ff;
        color: #4559a5;
    }

    .badge-campuran {
        background: #fff4d6;
        color: #805515;
    }

    @media (max-width: 768px) {
        .galeri-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .galeri-heading {
            font-size: 22px;
        }

        .galeri-card-header,
        .galeri-card-body {
            padding: 22px 18px;
        }

        .galeri-title {
            font-size: 20px;
        }

        .galeri-info-grid {
            grid-template-columns: 1fr;
        }

        .galeri-media-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .galeri-media-preview {
            height: 170px;
        }
    }

    @media (max-width: 480px) {
        .galeri-media-grid {
            grid-template-columns: 1fr;
        }

        .galeri-media-preview {
            height: 220px;
        }
    }
</style>

<div class="container-fluid pt-2 pb-4">
    <div class="detail-galeri">

        {{-- HEADER --}}
        <div class="galeri-header">
            <div>
                <h1 class="galeri-heading">Detail Album Galeri</h1>
                <p class="galeri-subtitle">
                    Informasi album dan dokumentasi kegiatan sekolah.
                </p>
            </div>

            <a href="{{ route('admin.galeri.index') }}"
               class="btn-kembali-galeri">
                <i data-feather="arrow-left"></i>
                Kembali
            </a>
        </div>

        <div class="galeri-card">

            {{-- JUDUL ALBUM --}}
            <div class="galeri-card-header">
                <div class="galeri-avatar">
                    <i data-feather="folder"></i>
                </div>

                <div>
                    <div class="galeri-label">Album Galeri</div>
                    <h2 class="galeri-title">{{ $album->judul }}</h2>
                </div>
            </div>

            <div class="galeri-card-body">

                {{-- INFORMASI ALBUM --}}
                <h3 class="galeri-section-title">Informasi Album</h3>

                <div class="galeri-info-grid">

                    <div class="galeri-info-item">
                        <div class="galeri-info-icon">
                            <i data-feather="file-text"></i>
                        </div>

                        <div>
                            <div class="galeri-info-label">Judul Album</div>
                            <div class="galeri-info-value">
                                {{ $album->judul ?: '-' }}
                            </div>
                        </div>
                    </div>

                    <div class="galeri-info-item">
                        <div class="galeri-info-icon">
                            <i data-feather="calendar"></i>
                        </div>

                        <div>
                            <div class="galeri-info-label">Tanggal Kegiatan</div>
                            <div class="galeri-info-value">
                                @if($album->tanggal)
                                    {{ \Carbon\Carbon::parse($album->tanggal)->translatedFormat('d F Y') }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="galeri-info-item">
                        <div class="galeri-info-icon">
                            <i data-feather="layers"></i>
                        </div>

                        <div>
                            <div class="galeri-info-label">Kategori Album</div>
                            <div class="galeri-info-value">
                                @php
                                    $jumlahFoto = $album->media->where('kategori', 'foto')->count();
                                    $jumlahVideo = $album->media->where('kategori', 'video')->count();
                                @endphp

                                @if($jumlahFoto > 0 && $jumlahVideo > 0)
                                    <span class="galeri-badge badge-campuran">Foto &amp; Video</span>
                                @elseif($jumlahFoto > 0)
                                    <span class="galeri-badge badge-foto">Foto</span>
                                @elseif($jumlahVideo > 0)
                                    <span class="galeri-badge badge-video">Video</span>
                                @else
                                    Belum ada media
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="galeri-info-item">
                        <div class="galeri-info-icon">
                            <i data-feather="image"></i>
                        </div>

                        <div>
                            <div class="galeri-info-label">Jumlah Foto</div>
                            <div class="galeri-info-value">
                                {{ $jumlahFoto }} foto
                            </div>
                        </div>
                    </div>

                    <div class="galeri-info-item">
                        <div class="galeri-info-icon">
                            <i data-feather="video"></i>
                        </div>

                        <div>
                            <div class="galeri-info-label">Jumlah Video</div>
                            <div class="galeri-info-value">
                                {{ $jumlahVideo }} video
                            </div>
                        </div>
                    </div>

                </div>

                <hr class="galeri-divider">

                {{-- KETERANGAN --}}
                <h3 class="galeri-section-title">Keterangan Album</h3>

                <div class="galeri-keterangan">
                    @if($album->keterangan)
                        {!! nl2br(e($album->keterangan)) !!}
                    @else
                        <span class="text-secondary">
                            Belum ada keterangan untuk album ini.
                        </span>
                    @endif
                </div>

                <hr class="galeri-divider">

                {{-- DOKUMENTASI --}}
                <h3 class="galeri-section-title">Dokumentasi Album</h3>

                @if($album->media->isNotEmpty())

                    <div class="galeri-media-grid">

                        @foreach($album->media as $media)

                            <div class="galeri-media-item">

                                <div class="galeri-media-preview">

                                    {{-- FOTO --}}
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

                                    {{-- VIDEO --}}
                                    @elseif($media->kategori === 'video')

                                        @if(\Illuminate\Support\Str::startsWith($media->file, ['http://', 'https://']))

                                            <a
                                                href="{{ $media->file }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="galeri-video-link">

                                                <i data-feather="play-circle"></i>
                                                <span>Buka video dari link</span>
                                            </a>

                                        @else

                                            <video controls preload="metadata">
                                                <source src="{{ asset('storage/' . $media->file) }}">
                                                Browser tidak mendukung pemutar video.
                                            </video>

                                        @endif

                                    @endif

                                </div>

                                {{-- LABEL KATEGORI SETIAP MEDIA --}}
                                <div class="galeri-media-caption">

                                    <span>Media {{ $loop->iteration }}</span>

                                    @if($media->kategori === 'foto')
                                        <span class="galeri-badge badge-foto">
                                            Foto
                                        </span>
                                    @else
                                        <span class="galeri-badge badge-video">
                                            Video
                                        </span>
                                    @endif

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="galeri-kosong">
                        <i data-feather="image"></i>
                        <p class="mt-2 mb-0">
                            Belum ada foto atau video dalam album ini.
                        </p>
                    </div>

                @endif

            </div>
        </div>
    </div>
</div>

@endsection
