@extends('admin')

@section('title', 'Detail Prestasi - MAN 2 Tasikmalaya')

@section('content')

<style>
    .detail-prestasi {
        max-width: 1100px;
        margin: 0 auto;
        padding-top: 4px;
        color: #26352c;
    }

    .prestasi-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
    }

    .prestasi-header h2 {
        color: #0b5d3b;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .prestasi-header p {
        color: #78847c;
        margin: 0;
        font-size: .95rem;
    }

    .btn-kembali-prestasi {
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

    .btn-kembali-prestasi:hover {
        background: #0b5d3b;
        color: white;
    }

    .btn-kembali-prestasi i {
        width: 16px;
        height: 16px;
    }

    .prestasi-card {
        background: white;
        border: 1px solid #e5ebe6;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(20, 60, 35, .05);
    }

    .prestasi-card-header {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 28px 32px;
        background: #f1f7f2;
        border-bottom: 1px solid #e2ebe4;
    }

    .prestasi-avatar {
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

    .prestasi-avatar i {
        width: 30px;
        height: 30px;
    }

    .prestasi-label {
        display: inline-block;
        color: #0b5d3b;
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .4px;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    .prestasi-title {
        color: #173d29;
        font-size: 1.7rem;
        line-height: 1.4;
        font-weight: 700;
        margin: 0;
        overflow-wrap: anywhere;
    }

    .prestasi-cover-wrapper {
        display: flex;
        justify-content: center;
        padding: 24px 32px 0;
        background: white;
    }

    .prestasi-cover {
        display: block;
        width: auto;
        max-width: 100%;
        height: auto;
        max-height: 400px;
        object-fit: contain;
        object-position: center;
        border-radius: 11px;
    }

    .prestasi-placeholder {
        width: 100%;
        min-height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 12px;
        background: #f1f7f2;
        color: #0b5d3b;
        border-radius: 11px;
    }

    .prestasi-placeholder i {
        width: 42px;
        height: 42px;
    }

    .prestasi-placeholder span {
        font-size: .9rem;
        font-weight: 500;
    }

    .prestasi-card-body {
        padding: 30px 32px;
    }

    .prestasi-section-title {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #0b5d3b;
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .prestasi-section-title i {
        width: 18px;
        height: 18px;
    }

    .prestasi-info {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .prestasi-info-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 20px;
        background: #f8faf8;
        border: 1px solid #e8eee9;
        border-radius: 11px;
        min-width: 0;
    }

    .prestasi-info-icon {
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

    .prestasi-info-icon i {
        width: 19px;
        height: 19px;
    }

    .prestasi-info-label {
        color: #78847c;
        font-size: .84rem;
        margin-bottom: 6px;
    }

    .prestasi-info-value {
        color: #26352c;
        font-size: .98rem;
        font-weight: 600;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .prestasi-description {
        margin-top: 22px;
        padding: 22px;
        background: #f8faf8;
        border: 1px solid #e8eee9;
        border-radius: 11px;
    }

    .prestasi-description-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        color: #0b5d3b;
        font-size: .95rem;
        font-weight: 700;
    }

    .prestasi-description-title i {
        width: 18px;
        height: 18px;
    }

    .prestasi-content {
        color: #4b5a50;
        font-size: .95rem;
        line-height: 1.9;
        overflow-wrap: anywhere;
    }

    .prestasi-empty {
        color: #89948c;
        font-style: italic;
    }

    .prestasi-card-footer {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        padding: 18px 32px;
        background: #fbfcfb;
        border-top: 1px solid #e8eee9;
    }

    @media (max-width: 576px) {
        .detail-prestasi {
            padding: 10px 0;
        }

        .prestasi-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .prestasi-header h2 {
            font-size: 1.5rem;
        }

        .prestasi-card-header {
            align-items: flex-start;
            gap: 14px;
            padding: 22px 18px;
        }

        .prestasi-avatar {
            width: 50px;
            height: 50px;
        }

        .prestasi-avatar i {
            width: 24px;
            height: 24px;
        }

        .prestasi-title {
            font-size: 1.35rem;
        }

        .prestasi-cover-wrapper {
            padding: 18px 18px 0;
        }

        .prestasi-cover {
            max-height: 280px;
        }

        .prestasi-card-body {
            padding: 22px 18px;
        }

        .prestasi-info {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .prestasi-info-item {
            padding: 16px;
        }

        .prestasi-description {
            padding: 16px;
        }

        .prestasi-card-footer {
            padding: 16px 18px;
        }
    }
</style>

<div class="container-fluid pt-2 pb-4">
    <div class="detail-prestasi">

        {{-- HEADER --}}
        <div class="prestasi-header">
            <div>
                <h2>Detail Prestasi</h2>
                <p>Informasi lengkap prestasi sekolah.</p>
            </div>

            <a href="{{ route('admin.prestasi.index') }}"
                class="btn-kembali-prestasi">
                <i data-feather="arrow-left"></i>
                Kembali
            </a>
        </div>

        {{-- KARTU DETAIL --}}
        <div class="prestasi-card">

            {{-- IDENTITAS PRESTASI --}}
            <div class="prestasi-card-header">
                <div class="prestasi-avatar">
                    <i data-feather="award"></i>
                </div>

                <div>
                    <span class="prestasi-label">Informasi Prestasi</span>

                    <h1 class="prestasi-title">
                        {{ $prestasi->nama_prestasi }}
                    </h1>
                </div>
            </div>

            {{-- GAMBAR PRESTASI --}}
            <div class="prestasi-cover-wrapper">
                @if($prestasi->gambar)
                <img
                    src="{{ asset('storage/' . $prestasi->gambar) }}"
                    alt="{{ $prestasi->nama_prestasi }}"
                    class="prestasi-cover">
                @else
                <div class="prestasi-placeholder">
                    <i data-feather="award"></i>
                    <span>Gambar prestasi belum tersedia</span>
                </div>
                @endif
            </div>

            <div class="prestasi-card-body">

                <h5 class="prestasi-section-title">
                    <i data-feather="info"></i>
                    Informasi Prestasi
                </h5>

                <div class="prestasi-info">

                    {{-- NAMA PRESTASI --}}
                    <div class="prestasi-info-item">
                        <div class="prestasi-info-icon">
                            <i data-feather="award"></i>
                        </div>

                        <div>
                            <div class="prestasi-info-label">
                                Nama Prestasi
                            </div>

                            <div class="prestasi-info-value">
                                {{ $prestasi->nama_prestasi }}
                            </div>
                        </div>
                    </div>

                    {{-- NAMA PEMENANG --}}
                    <div class="prestasi-info-item">
                        <div class="prestasi-info-icon">
                            <i data-feather="user"></i>
                        </div>

                        <div>
                            <div class="prestasi-info-label">
                                Nama Pemenang
                            </div>

                            <div class="prestasi-info-value">
                                {{ $prestasi->nama_pemenang ?: 'Belum diisi' }}
                            </div>
                        </div>
                    </div>

                    {{-- TANGGAL --}}
                    <div class="prestasi-info-item">
                        <div class="prestasi-info-icon">
                            <i data-feather="calendar"></i>
                        </div>

                        <div>
                            <div class="prestasi-info-label">
                                Tanggal Prestasi
                            </div>

                            <div class="prestasi-info-value">
                                {{ $prestasi->tanggal ? \Carbon\Carbon::parse($prestasi->tanggal)->translatedFormat('d F Y') : 'Belum diisi' }}
                            </div>
                        </div>
                    </div>

                </div>

                {{-- KETERANGAN --}}
                <div class="prestasi-description">
                    <div class="prestasi-description-title">
                        <i data-feather="file-text"></i>
                        Keterangan Prestasi
                    </div>

                    <div class="prestasi-content">
                        @if($prestasi->keterangan)
                        {!! nl2br(e($prestasi->keterangan)) !!}
                        @else
                        <span class="prestasi-empty">
                            Belum ada keterangan prestasi.
                        </span>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection