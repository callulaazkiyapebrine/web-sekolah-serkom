@extends('public.layouts.app')

@section('title', $berita->judul . ' - MAN 2 Tasikmalaya')

@section('content')

<style>
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

    /* =========================
       GAMBAR
    ========================= */

    .detail-berita-foto {
        width: 100%;
        height: 450px;
        overflow: hidden;
        border-radius: 16px;
        background: #e8f5ee;
    }

    .detail-berita-foto img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
    }

    .detail-no-foto {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        font-size: 15px;
    }

    /* =========================
       INFORMASI BERITA
    ========================= */

    .detail-berita-content {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 10px 5px 10px 25px;
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

    .detail-berita-tanggal {
        margin-bottom: 15px;
        color: #198754;
        font-size: 14px;
        font-weight: 600;
    }

    .detail-berita-judul {
        margin: 0 0 22px;
        color: #1f2937;
        font-size: 34px;
        font-weight: 700;
        line-height: 1.3;
    }

    .detail-garis {
        width: 55px;
        height: 4px;
        margin-bottom: 25px;
        background: #006b3c;
        border-radius: 20px;
    }

    .detail-berita-isi {
        color: #4b5563;
        font-size: 16px;
        line-height: 1.9;
    }

    .detail-berita-isi p {
        margin-bottom: 18px;
    }

    /* =========================
       TOMBOL KEMBALI
    ========================= */

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

    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 991.98px) {

        .detail-berita-section {
            padding: 50px 0;
        }

        .detail-berita-card {
            padding: 25px;
        }

        .detail-berita-content {
            padding: 25px 5px 5px;
        }

        .detail-berita-foto {
            height: 350px;
        }

        .detail-berita-judul {
            font-size: 29px;
        }

    }

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
            border-radius: 12px;
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

            <div class="row align-items-center g-4">

                {{-- ==========================================
                     KOLOM GAMBAR
                =========================================== --}}

                <div class="col-lg-6">

                    <div class="detail-berita-foto">

                        @if($berita->gambar)

                            <img
                                src="{{ asset('storage/' . $berita->gambar) }}"
                                alt="{{ $berita->judul }}">

                        @else

                            <div class="detail-no-foto">
                                Tidak ada gambar berita
                            </div>

                        @endif

                    </div>

                </div>


                {{-- ==========================================
                     KOLOM INFORMASI
                =========================================== --}}

                <div class="col-lg-6">

                    <div class="detail-berita-content">

                        <span class="detail-berita-label">
                            Berita Sekolah
                        </span>


                        {{-- TANGGAL --}}

                        <div class="detail-berita-tanggal">

                            {{ $berita->tanggal
                                ? \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y')
                                : '-' }}

                        </div>


                        {{-- JUDUL --}}

                        <h1 class="detail-berita-judul">

                            {{ $berita->judul }}

                        </h1>


                        <div class="detail-garis"></div>


                        {{-- ISI BERITA --}}

                        <div class="detail-berita-isi">

                            {!! nl2br(e($berita->isi)) !!}

                        </div>


                        {{-- KEMBALI --}}

                        <a
                            href="{{ route('public.berita') }}"
                            class="btn btn-success btn-kembali">

                            ← Kembali ke Berita

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection