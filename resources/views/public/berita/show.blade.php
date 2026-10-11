@extends('public.layouts.app')

@section('title', $berita->judul . ' - MAN 2 Tasikmalaya')

@section('content')

<style>
    /* =========================================
       DETAIL BERITA
    ========================================= */

    .detail-berita-section {
        padding: 70px 0;
        background: #f8faf9;
        min-height: 650px;
    }

    .detail-berita-card {
        max-width: 1100px;
        margin: 0 auto;
        padding: 35px;
        background: #ffffff;
        border: 1px solid #e5eee9;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
    }

    /* =========================================
       BARIS FOTO DAN TEKS
    ========================================= */

    .detail-berita-row {
        align-items: stretch;
    }

    .detail-berita-kolom-foto,
    .detail-berita-kolom-konten {
        display: flex;
        flex-direction: column;
    }

    /* =========================================
       FOTO BERITA
    ========================================= */

    .detail-berita-foto {
        flex: 1;
        width: 100%;
        min-height: 450px;
        overflow: hidden;
        border-radius: 16px;
        background: #e8f5ee;
    }

    .detail-berita-foto img {
        width: 100%;
        height: 100%;
        min-height: 450px;
        object-fit: cover;
        object-position: center;
        display: block;
    }

    .detail-no-foto {
        width: 100%;
        height: 100%;
        min-height: 450px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        font-size: 15px;
        text-align: center;
        padding: 20px;
    }

    /* =========================================
       KONTEN BERITA
    ========================================= */

    .detail-berita-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        padding: 10px 5px 10px 25px;
        min-width: 0;
    }

    .detail-berita-label {
        display: inline-block;
        margin-bottom: 10px;
        color: #006b3c;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .detail-berita-judul {
        margin: 0 0 20px;
        color: #1f2937;
        font-size: 34px;
        font-weight: 700;
        line-height: 1.3;
        overflow-wrap: anywhere;
    }

    .detail-garis {
        width: 55px;
        height: 4px;
        margin-bottom: 20px;
        background: #006b3c;
        border-radius: 20px;
        flex-shrink: 0;
    }

    .detail-berita-tanggal {
        margin-bottom: 15px;
        color: #6b7280;
        font-size: 14px;
        line-height: 1.7;
    }

    .detail-berita-tanggal strong {
        color: #374151;
    }

    .detail-berita-isi {
        color: #4b5563;
        font-size: 16px;
        line-height: 1.9;
        overflow-wrap: anywhere;
    }

    .detail-berita-isi p {
        margin-bottom: 18px;
    }

    /* =========================================
       TOMBOL KEMBALI
    ========================================= */

    .btn-kembali {
        align-self: flex-start;
        margin-top: 25px;
        padding: 10px 18px;
        border-radius: 8px;
        background: #006b3c;
        border-color: #006b3c;
    }

    .btn-kembali:hover {
        background: #00552f;
        border-color: #00552f;
    }

    /* =========================================
       RESPONSIVE TABLET
    ========================================= */

    @media (max-width: 991.98px) {
        .detail-berita-section {
            padding: 50px 0;
        }

        .detail-berita-card {
            padding: 25px;
        }

        .detail-berita-row {
            align-items: flex-start;
        }

        .detail-berita-kolom-foto,
        .detail-berita-kolom-konten {
            display: block;
        }

        .detail-berita-foto {
            height: 350px;
            min-height: 350px;
        }

        .detail-berita-foto img {
            height: 350px;
            min-height: 350px;
        }

        .detail-no-foto {
            height: 350px;
            min-height: 350px;
        }

        .detail-berita-content {
            padding: 25px 5px 5px;
        }

        .detail-berita-judul {
            font-size: 29px;
        }
    }

    /* =========================================
       RESPONSIVE HP
    ========================================= */

    @media (max-width: 575.98px) {
        .detail-berita-section {
            padding: 35px 0;
        }

        .detail-berita-card {
            padding: 18px;
            border-radius: 15px;
        }

        .detail-berita-foto {
            height: 260px;
            min-height: 260px;
            border-radius: 12px;
        }

        .detail-berita-foto img {
            height: 260px;
            min-height: 260px;
        }

        .detail-no-foto {
            height: 260px;
            min-height: 260px;
        }

        .detail-berita-content {
            padding: 22px 2px 2px;
        }

        .detail-berita-judul {
            font-size: 25px;
        }

        .detail-berita-isi {
            font-size: 15px;
            line-height: 1.8;
        }
    }
</style>

<section class="detail-berita-section">
    <div class="container">

        <div class="detail-berita-card">

            <div class="row detail-berita-row g-4">

                {{-- FOTO BERITA --}}
                <div class="col-lg-6 detail-berita-kolom-foto">

                    <div class="detail-berita-foto">

                        @if ($berita->gambar)
                            <img
                                src="{{ asset('storage/' . $berita->gambar) }}"
                                alt="{{ $berita->judul }}"
                            >
                        @else
                            <div class="detail-no-foto">
                                Tidak ada gambar berita
                            </div>
                        @endif

                    </div>

                </div>

                {{-- KONTEN BERITA --}}
                <div class="col-lg-6 detail-berita-kolom-konten">

                    <div class="detail-berita-content">

                        <span class="detail-berita-label">
                            Berita Sekolah
                        </span>

                        <h1 class="detail-berita-judul">
                            {{ $berita->judul }}
                        </h1>

                        <div class="detail-garis"></div>

                        <div class="detail-berita-tanggal">
                            <strong>Tanggal:</strong>
                            {{ $berita->tanggal
                                ? \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y')
                                : '-' }}
                        </div>

                        <div class="detail-berita-isi">
                            {!! nl2br(e($berita->isi)) !!}
                        </div>

                        <a
                            href="{{ route('public.berita') }}"
                            class="btn btn-success btn-kembali"
                        >
                            &larr; Kembali ke Berita
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection
