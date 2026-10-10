@extends('admin')

@section('title', 'Detail Guru')

@section('content')

<style>
    .detail-guru {
        max-width: 1100px;
        margin: 0 auto;
        color: #26352c;
    }

    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 28px;
    }

    .detail-heading {
        margin: 0 0 6px;
        color: #0b5d3b;
        font-size: 25px;
        font-weight: 700;
    }

    .detail-subtitle {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
    }

    .detail-guru {
    max-width: 1100px;
    margin: 0 auto;
    padding-top: 4px;
    color: #26352c;
}


    /* TOMBOL KEMBALI */
    .btn-kembali {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 18px;
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

    .btn-kembali:hover {
        background: #0b5d3b;
        border-color: #0b5d3b;
        color: #fff;
    }

    .btn-kembali i {
        width: 16px;
        height: 16px;
    }


    .detail-card {
        overflow: hidden;
        border: 1px solid #e5ebe6;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 5px 20px rgba(15, 23, 42, .04);
    }

    .guru-layout {
        display: grid;
        grid-template-columns: 350px minmax(0, 1fr);
    }

    /* FOTO MEMENUHI PANEL */


    .guru-photo-panel {
        width: 100%;
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: transparent;
        border-radius: 16px;
        overflow: hidden;
    }

    .guru-photo {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border: none;
    }

    .guru-photo img {
        display: block;
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
        object-position: center;
        border: none;
        border-radius: 12px;
    }



    .guru-photo-placeholder {
        display: flex;
        width: 100%;
        height: 100%;
        min-height: 500px;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 12px;
        color: #0b5d3b;
        font-size: 13px;
        text-align: center;
    }

    .guru-photo-placeholder i {
        width: 42px;
        height: 42px;
    }

    .guru-info {
        padding: 36px;
        min-width: 0;
    }

    .detail-label {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 15px;
        padding: 7px 12px;
        border-radius: 6px;
        background: #e8f2ec;
        color: #0b5d3b;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .7px;
        text-transform: uppercase;
    }

    .guru-name {
        margin: 0 0 10px;
        color: #172b23;
        font-size: 29px;
        font-weight: 750;
        line-height: 1.4;
        overflow-wrap: anywhere;
    }

    .guru-description {
        margin-bottom: 28px;
        color: #6b7280;
        font-size: 14px;
        line-height: 1.7;
    }

    .detail-divider {
        margin: 24px 0;
        border: 0;
        border-top: 1px solid #e5e7eb;
        opacity: 1;
    }

    .detail-section-title {
        margin-bottom: 16px;
        color: #0b5d3b;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .5px;
        text-transform: uppercase;
    }

    .guru-info-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .guru-info-item {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        padding: 15px;
        border: 1px solid #e5ebe6;
        border-radius: 10px;
        background: #fafcfb;
    }

    .guru-info-icon {
        display: flex;
        flex-shrink: 0;
        width: 38px;
        height: 38px;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #e8f2ec;
        color: #0b5d3b;
    }

    .guru-info-icon i {
        width: 18px;
        height: 18px;
    }

    .info-label {
        margin-bottom: 5px;
        color: #6b7280;
        font-size: 12px;
    }

    .info-value {
        color: #1f2937;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .detail-footer {
        display: flex;
        justify-content: flex-start;
        padding: 18px 36px;
        border-top: 1px solid #e5ebe6;
        background: #fafcfb;
    }

    @media (max-width: 768px) {
        .detail-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .detail-heading {
            font-size: 22px;
        }

        .guru-layout {
            grid-template-columns: 1fr;
        }

        .guru-photo-panel {
            min-height: 0;
            height: 360px;
        }

        .guru-photo {
            min-height: 0;
            height: 100%;
        }

        .guru-photo img {
            min-height: 0;
            height: 100%;
        }

        .guru-photo-placeholder {
            min-height: 360px;
        }

        .guru-info {
            padding: 25px 20px;
        }

        .guru-name {
            font-size: 24px;
        }

        .detail-footer {
            padding: 16px 20px;
        }
    }

    @media (max-width: 480px) {
        .guru-photo-panel {
            height: 300px;
        }

        .guru-photo-placeholder {
            min-height: 300px;
        }

        .btn-kembali {
            padding: 9px 14px;
        }
    }
</style>

<div class="container-fluid pt-2 pb-4">
    <div class="detail-guru">

        {{-- HEADER --}}
        <div class="detail-header">
            <div>
                <h1 class="detail-heading">Detail Guru</h1>
                <p class="detail-subtitle">
                    Informasi lengkap tenaga pendidik sekolah.
                </p>
            </div>

            @if(auth()->check())
            <a href="{{ route('admin.guru.index') }}"
                class="btn-kembali">
                <i data-feather="arrow-left"></i>
                Kembali
            </a>
            @else
            <a href="{{ route('public.guru') }}#daftar-guru"
                class="btn-kembali">
                <i data-feather="arrow-left"></i>
                Kembali
            </a>
            @endif
        </div>

        {{-- DETAIL GURU --}}
        <div class="detail-card">
            <div class="guru-layout">

                {{-- FOTO GURU --}}
                <div class="guru-photo-panel">
                    <div class="guru-photo">
                        @if($guru->foto)
                        <img
                            src="{{ asset('storage/' . $guru->foto) }}"
                            alt="{{ $guru->nama_guru }}">
                        @else
                        <div class="guru-photo-placeholder">
                            <i data-feather="user"></i>
                            <span>Foto belum tersedia</span>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- INFORMASI GURU --}}
                <div class="guru-info">

                    <div class="detail-label">
                        <i data-feather="users"
                            style="width:14px;height:14px;"></i>
                        Tenaga Pendidik
                    </div>

                    <h2 class="guru-name">
                        {{ $guru->nama_guru }}
                    </h2>

                    <p class="guru-description">
                        Informasi profil dan data tenaga pendidik sekolah.
                    </p>

                    <hr class="detail-divider">

                    <div class="detail-section-title">
                        Informasi Guru
                    </div>

                    <div class="guru-info-list">

                        {{-- NAMA GURU --}}
                        <div class="guru-info-item">
                            <div class="guru-info-icon">
                                <i data-feather="user"></i>
                            </div>

                            <div>
                                <div class="info-label">Nama Guru</div>
                                <div class="info-value">
                                    {{ $guru->nama_guru }}
                                </div>
                            </div>
                        </div>

                        {{-- NIP --}}
                        <div class="guru-info-item">
                            <div class="guru-info-icon">
                                <i data-feather="credit-card"></i>
                            </div>

                            <div>
                                <div class="info-label">NIP</div>
                                <div class="info-value">
                                    {{ $guru->nip ?: '-' }}
                                </div>
                            </div>
                        </div>

                        {{-- MATA PELAJARAN --}}
                        <div class="guru-info-item">
                            <div class="guru-info-icon">
                                <i data-feather="book-open"></i>
                            </div>

                            <div>
                                <div class="info-label">Mata Pelajaran</div>
                                <div class="info-value">
                                    {{ $guru->mapel ?: '-' }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection