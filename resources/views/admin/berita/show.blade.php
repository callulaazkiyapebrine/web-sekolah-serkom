@extends('admin')

@section('title', 'Detail Berita - MAN 2 Tasikmalaya')

@section('content')

<style>
    .detail-berita {
        max-width: 1100px;
        margin: 0 auto;
        padding-top: 4px;
        color: #26352c;
    }

    /* HEADER */
    .berita-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 28px;
    }

    .berita-heading {
        margin: 0 0 6px;
        color: #0b5d3b;
        font-size: 25px;
        font-weight: 700;
    }

    .berita-subtitle {
        margin: 0;
        color: #78847c;
        font-size: 14px;
    }

    /* TOMBOL KEMBALI */
    .btn-kembali-berita {
        display: inline-flex;
        align-items: center;
        justify-content: center;
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
        transition: .2s ease;
    }

    .btn-kembali-berita:hover {
        background: #0b5d3b;
        color: #fff;
    }

    .btn-kembali-berita i {
        width: 16px;
        height: 16px;
    }

    /* KARTU */
    .berita-card {
        overflow: hidden;
        border: 1px solid #e5ebe6;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 5px 20px rgba(20, 60, 35, .05);
    }

    .berita-card-header {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 28px 32px;
        border-bottom: 1px solid #e2ebe4;
        background: #f1f7f2;
    }

    .berita-avatar {
        display: flex;
        flex-shrink: 0;
        width: 64px;
        height: 64px;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: #dceee1;
        color: #0b5d3b;
    }

    .berita-avatar i {
        width: 30px;
        height: 30px;
    }

    .berita-label {
        display: inline-block;
        margin-bottom: 7px;
        color: #0b5d3b;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .7px;
        text-transform: uppercase;
    }

    .berita-title {
        margin: 0;
        color: #173b2a;
        font-size: 25px;
        font-weight: 700;
        line-height: 1.4;
        overflow-wrap: anywhere;
    }

    /* GAMBAR */
    .berita-cover-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 26px 32px;
        background: #fff;
        border-bottom: 1px solid #e8eee9;
    }

    .berita-cover {
        display: block;
        width: auto;
        max-width: 100%;
        height: auto;
        max-height: 360px;
        object-fit: contain;
        object-position: center;
        border-radius: 11px;
    }

    .berita-cover-placeholder {
        display: flex;
        width: 100%;
        min-height: 180px;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #f1f7f2;
        color: #0b5d3b;
    }

    .berita-cover-placeholder i {
        width: 42px;
        height: 42px;
    }

    /* ISI KARTU */
    .berita-card-body {
        padding: 30px 32px;
    }

    .berita-section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0 0 18px;
        color: #0b5d3b;
        font-size: 14px;
        font-weight: 700;
    }

    .berita-section-title i {
        width: 18px;
        height: 18px;
    }

    /* INFORMASI */
    .berita-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .berita-info-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        min-width: 0;
        padding: 20px;
        border: 1px solid #e8eee9;
        border-radius: 11px;
        background: #f8faf8;
    }

    .berita-info-icon {
        display: flex;
        flex-shrink: 0;
        width: 42px;
        height: 42px;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #dceee1;
        color: #0b5d3b;
    }

    .berita-info-icon i {
        width: 19px;
        height: 19px;
    }

    .berita-info-text {
        min-width: 0;
    }

    .berita-info-label {
        margin-bottom: 6px;
        color: #78847c;
        font-size: 13px;
    }

    .berita-info-value {
        color: #26352c;
        font-size: 14px;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    /* STATUS */
    .berita-status {
        display: inline-block;
        padding: 5px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .berita-status-publish {
        background: #dcefe2;
        color: #0b5d3b;
    }

    .berita-status-draft {
        background: #fff0d5;
        color: #8a5a00;
    }

    /* ISI BERITA */
    .berita-isi {
        margin-top: 26px;
        padding: 22px;
        border: 1px solid #e8eee9;
        border-radius: 11px;
        background: #f8faf8;
    }

    .berita-isi-label {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        color: #0b5d3b;
        font-size: 14px;
        font-weight: 700;
    }

    .berita-isi-label i {
        width: 18px;
        height: 18px;
    }

    .berita-isi-content {
        color: #37483d;
        font-size: 14px;
        line-height: 1.9;
        overflow-wrap: anywhere;
        white-space: normal;
    }

    .berita-isi-kosong {
        color: #78847c;
        font-style: italic;
    }

    /* FOOTER */
    .berita-card-footer {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        padding: 18px 32px;
        border-top: 1px solid #e2ebe4;
        background: #fbfcfb;
    }

    .btn-edit-berita {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 16px;
        border: 1px solid #198754;
        border-radius: 9px;
        background: #198754;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: .2s ease;
    }

    .btn-edit-berita:hover {
        background: #0b5d3b;
        border-color: #0b5d3b;
        color: #fff;
    }

    .btn-edit-berita i {
        width: 16px;
        height: 16px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .detail-berita {
            padding: 10px 0;
        }

        .berita-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .berita-heading {
            font-size: 22px;
        }

        .berita-card-header {
            gap: 14px;
            padding: 22px 20px;
        }

        .berita-avatar {
            width: 52px;
            height: 52px;
        }

        .berita-avatar i {
            width: 25px;
            height: 25px;
        }

        .berita-title {
            font-size: 21px;
        }

        .berita-cover-wrapper {
            padding: 22px 20px;
        }

        .berita-cover {
            max-height: 300px;
        }

        .berita-card-body {
            padding: 24px 20px;
        }

        .berita-card-footer {
            padding: 16px 20px;
        }
    }

    @media (max-width: 576px) {
        .berita-info-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .berita-info-item {
            padding: 16px;
        }

        .berita-card-header {
            align-items: flex-start;
            padding: 22px 18px;
        }

        .berita-avatar {
            width: 50px;
            height: 50px;
        }

        .berita-avatar i {
            width: 24px;
            height: 24px;
        }

        .berita-title {
            font-size: 19px;
        }

        .berita-cover-wrapper {
            padding: 20px 18px;
        }

        .berita-cover {
            max-height: 260px;
        }

        .berita-card-body {
            padding: 22px 18px;
        }

        .berita-isi {
            padding: 16px;
        }

        .berita-card-footer {
            padding: 16px 18px;
        }
    }
</style>

<div class="container-fluid pt-2 pb-4">
    <div class="detail-berita">

        {{-- HEADER --}}
        <div class="berita-header">
            <div>
                <h1 class="berita-heading">Detail Berita</h1>
                <p class="berita-subtitle">
                    Informasi lengkap berita sekolah.
                </p>
            </div>

            <a href="{{ route('admin.berita.index') }}"
                class="btn-kembali-berita">
                <i data-feather="arrow-left"></i>
                Kembali
            </a>
        </div>

        {{-- KARTU DETAIL --}}
        <div class="berita-card">

            {{-- JUDUL BERITA --}}
            <div class="berita-card-header">
                <div class="berita-avatar">
                    <i data-feather="file-text"></i>
                </div>

                <div>
                    <span class="berita-label">Informasi Berita</span>
                    <h2 class="berita-title">
                        {{ $berita->judul }}
                    </h2>
                </div>
            </div>

            {{-- GAMBAR BERITA --}}
            <div class="berita-cover-wrapper">
                @if($berita->gambar)
                    <img
                        src="{{ asset('storage/' . $berita->gambar) }}"
                        alt="{{ $berita->judul }}"
                        class="berita-cover">
                @else
                    <div class="berita-cover-placeholder">
                        <i data-feather="image"></i>
                    </div>
                @endif
            </div>

            {{-- INFORMASI BERITA --}}
            <div class="berita-card-body">

                <h3 class="berita-section-title">
                    <i data-feather="info"></i>
                    Informasi Berita
                </h3>

                <div class="berita-info-grid">

                    {{-- TANGGAL --}}
                    <div class="berita-info-item">
                        <div class="berita-info-icon">
                            <i data-feather="calendar"></i>
                        </div>

                        <div class="berita-info-text">
                            <div class="berita-info-label">
                                Tanggal Berita
                            </div>

                            <div class="berita-info-value">
                                @if($berita->tanggal)
                                    {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- STATUS --}}
                    <div class="berita-info-item">
                        <div class="berita-info-icon">
                            <i data-feather="check-circle"></i>
                        </div>

                        <div class="berita-info-text">
                            <div class="berita-info-label">
                                Status Publikasi
                            </div>

                            <div class="berita-info-value">
                                @if(strtolower($berita->status ?? '') === 'publish')
                                    <span class="berita-status berita-status-publish">
                                        Publish
                                    </span>
                                @else
                                    <span class="berita-status berita-status-draft">
                                        {{ ucfirst($berita->status ?? 'Draft') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- PEMBUAT BERITA --}}
                    <div class="berita-info-item">
                        <div class="berita-info-icon">
                            <i data-feather="user"></i>
                        </div>

                        <div class="berita-info-text">
                            <div class="berita-info-label">
                                Dibuat Oleh
                            </div>

                            <div class="berita-info-value">
                                {{ $berita->user->username ?? $berita->user->name ?? '-' }}
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ISI BERITA --}}
                <div class="berita-isi">
                    <div class="berita-isi-label">
                        <i data-feather="align-left"></i>
                        Isi Berita
                    </div>

                    <div class="berita-isi-content">
                        @if($berita->isi)
                            {!! nl2br(e($berita->isi)) !!}
                        @else
                            <span class="berita-isi-kosong">
                                Belum ada isi berita.
                            </span>
                        @endif
                    </div>
                </div>

            </div>

            {{-- TOMBOL AKSI --}}
            <div class="berita-card-footer">
                <a
                    href="{{ route('admin.berita.addEdit', \Illuminate\Support\Facades\Crypt::encrypt($berita->id_berita)) }}"
                    class="btn-edit-berita">
                    <i data-feather="edit-3"></i>
                    Edit Berita
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
