@extends('admin')

@section('title', 'Detail Ekstrakurikuler - MAN 2 Tasikmalaya')

@section('content')

<style>
    .detail-eskul {
        max-width: 1100px;
        margin: 0 auto;
        padding-top: 4px;
        color: #26352c;
    }

    .eskul-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
    }

    .eskul-header h2 {
        color: #0b5d3b;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .eskul-header p {
        color: #78847c;
        margin: 0;
        font-size: .95rem;
    }

    .btn-kembali-eskul {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 18px;
        border: 1px solid #0b5d3b;
        border-radius: 9px;
        color: #0b5d3b;
        background: white;
        text-decoration: none;
        font-size: .9rem;
        font-weight: 600;
        white-space: nowrap;
        transition: .2s;
    }

    .btn-kembali-eskul:hover {
        background: #0b5d3b;
        color: white;
    }

    .btn-kembali-eskul i {
        width: 16px;
        height: 16px;
    }

    .eskul-card {
        background: white;
        border: 1px solid #e5ebe6;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(20, 60, 35, .05);
    }

    .eskul-card-header {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 28px 32px;
        background: #f1f7f2;
        border-bottom: 1px solid #e2ebe4;
    }

    .eskul-avatar {
        width: 64px;
        height: 64px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #dceee1;
        color: #0b5d3b;
        border-radius: 14px;
    }

    .eskul-avatar i {
        width: 30px;
        height: 30px;
    }

    .eskul-label {
        display: inline-block;
        color: #0b5d3b;
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .4px;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    .eskul-title {
        color: #173d29;
        font-size: 1.7rem;
        line-height: 1.4;
        font-weight: 700;
        margin: 0;
        overflow-wrap: anywhere;
    }

    .eskul-cover-wrapper {
        display: flex;
        justify-content: center;
        padding: 24px 32px 0;
        background: white;
    }

    .eskul-cover {
        display: block;
        width: auto;
        max-width: 100%;
        height: auto;
        max-height: 400px;
        object-fit: contain;
        object-position: center;
        border-radius: 11px;
    }

    .eskul-cover-placeholder {
        width: 100%;
        min-height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f7f2;
        color: #0b5d3b;
        border-radius: 11px;
    }

    .eskul-cover-placeholder i {
        width: 42px;
        height: 42px;
    }

    .eskul-card-body {
        padding: 30px 32px;
    }

    .eskul-section-title {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #0b5d3b;
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .eskul-section-title i {
        width: 18px;
        height: 18px;
    }

    .eskul-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .eskul-info-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 20px;
        background: #f8faf8;
        border: 1px solid #e8eee9;
        border-radius: 11px;
        min-width: 0;
    }

    .eskul-info-icon {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #dceee1;
        color: #0b5d3b;
        border-radius: 10px;
    }

    .eskul-info-icon i {
        width: 19px;
        height: 19px;
    }

    .eskul-info-label {
        color: #78847c;
        font-size: .84rem;
        margin-bottom: 6px;
    }

    .eskul-info-value {
        color: #26352c;
        font-size: .98rem;
        font-weight: 600;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .eskul-description {
        margin-top: 22px;
        padding: 22px;
        background: #f8faf8;
        border: 1px solid #e8eee9;
        border-radius: 11px;
    }

    .eskul-description-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        color: #0b5d3b;
        font-size: .95rem;
        font-weight: 700;
    }

    .eskul-description-title i {
        width: 18px;
        height: 18px;
    }

    .eskul-description-content {
        color: #374151;
        font-size: .95rem;
        line-height: 1.9;
        overflow-wrap: anywhere;
    }

    .eskul-card-footer {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        padding: 18px 32px;
        background: #fbfcfb;
        border-top: 1px solid #e8eee9;
    }

    @media (max-width: 576px) {
        .detail-eskul {
            padding: 10px 0;
        }

        .eskul-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .eskul-header h2 {
            font-size: 1.5rem;
        }

        .eskul-card-header {
            align-items: flex-start;
            gap: 14px;
            padding: 22px 18px;
        }

        .eskul-avatar {
            width: 50px;
            height: 50px;
        }

        .eskul-avatar i {
            width: 24px;
            height: 24px;
        }

        .eskul-title {
            font-size: 1.35rem;
        }

        .eskul-cover-wrapper {
            padding: 18px 18px 0;
        }

        .eskul-cover {
            max-height: 280px;
        }

        .eskul-card-body {
            padding: 22px 18px;
        }

        .eskul-info-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .eskul-info-item {
            padding: 16px;
        }

        .eskul-description {
            padding: 16px;
        }

        .eskul-card-footer {
            padding: 16px 18px;
        }
    }
</style>

<div class="container-fluid pt-2 pb-4">
    <div class="detail-eskul">

        {{-- HEADER --}}
        <div class="eskul-header">
            <div>
                <h2>Detail Ekstrakurikuler</h2>
                <p>Informasi lengkap ekstrakurikuler sekolah.</p>
            </div>

            <a href="{{ route('admin.ekstrakurikuler.index') }}"
                class="btn-kembali-eskul">
                <i data-feather="arrow-left"></i>
                Kembali
            </a>
        </div>

        {{-- KARTU DETAIL --}}
        <div class="eskul-card">

            {{-- IDENTITAS EKSTRAKURIKULER --}}
            <div class="eskul-card-header">
                <div class="eskul-avatar">
                    <i data-feather="users"></i>
                </div>

                <div>
                    <span class="eskul-label">Informasi Ekstrakurikuler</span>

                    <h1 class="eskul-title">
                        {{ $ekstrakurikuler->nama_eskul }}
                    </h1>
                </div>
            </div>

            {{-- GAMBAR --}}
            <div class="eskul-cover-wrapper">
                @if($ekstrakurikuler->gambar)
                <img
                    src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}"
                    alt="{{ $ekstrakurikuler->nama_eskul }}"
                    class="eskul-cover">
                @else
                <div class="eskul-cover-placeholder">
                    <i data-feather="image"></i>
                </div>
                @endif
            </div>

            <div class="eskul-card-body">

                <h5 class="eskul-section-title">
                    <i data-feather="info"></i>
                    Informasi Ekstrakurikuler
                </h5>

                <div class="eskul-info-grid">

                    {{-- NAMA EKSTRAKURIKULER --}}
                    <div class="eskul-info-item">
                        <div class="eskul-info-icon">
                            <i data-feather="users"></i>
                        </div>

                        <div>
                            <div class="eskul-info-label">
                                Nama Ekstrakurikuler
                            </div>

                            <div class="eskul-info-value">
                                {{ $ekstrakurikuler->nama_eskul }}
                            </div>
                        </div>
                    </div>

                    {{-- PEMBINA --}}
                    <div class="eskul-info-item">
                        <div class="eskul-info-icon">
                            <i data-feather="user"></i>
                        </div>

                        <div>
                            <div class="eskul-info-label">Pembina</div>

                            <div class="eskul-info-value">
                                {{ $ekstrakurikuler->pembina ?: '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- JADWAL LATIHAN --}}
                    <div class="eskul-info-item">
                        <div class="eskul-info-icon">
                            <i data-feather="calendar"></i>
                        </div>

                        <div>
                            <div class="eskul-info-label">Jadwal Latihan</div>

                            <div class="eskul-info-value">
                                {{ $ekstrakurikuler->jadwal_latihan ?: '-' }}
                            </div>
                        </div>
                    </div>

                </div>

                {{-- DESKRIPSI --}}
                <div class="eskul-description">
                    <div class="eskul-description-title">
                        <i data-feather="align-left"></i>
                        Deskripsi Ekstrakurikuler
                    </div>

                    <div class="eskul-description-content">
                        @if($ekstrakurikuler->deskripsi)
                        {!! nl2br(e($ekstrakurikuler->deskripsi)) !!}
                        @else
                        <span class="text-muted">
                            Belum ada deskripsi ekstrakurikuler.
                        </span>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection