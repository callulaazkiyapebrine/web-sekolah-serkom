@extends('public.layouts.app')

@section('title', $ekstrakurikuler->nama_eskul . ' - MAN 2 Tasikmalaya')

@section('content')

<style>
    .detail-eskul-section {
        padding: 70px 0;
        background: #f8faf9;
        min-height: 650px;
    }

    .detail-eskul-card {
        max-width: 1100px;
        margin: 0 auto;
        padding: 35px;
        background: #ffffff;
        border: 1px solid #e5eee9;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
    }

    /* =========================
       FOTO
    ========================= */

    .detail-eskul-foto {
        width: 100%;
        height: 450px;
        overflow: hidden;
        background: #e8f5ee;
        border-radius: 16px;
    }

    .detail-eskul-foto img {
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
       CONTENT
    ========================= */

    .detail-eskul-content {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 10px 5px 10px 25px;
    }

    .detail-eskul-label {
        display: inline-block;
        margin-bottom: 10px;
        color: #006b3c;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .detail-eskul-content h1 {
        margin: 0 0 20px;
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

    /* =========================
       INFORMASI
    ========================= */

    .detail-eskul-info {
        margin-bottom: 20px;
    }

    .detail-eskul-info p {
        margin-bottom: 10px;
        color: #6b7280;
        font-size: 15px;
    }

    .detail-eskul-info strong {
        color: #006b3c;
        font-weight: 700;
    }

    /* =========================
       DESKRIPSI
    ========================= */

    .detail-eskul-deskripsi {
        color: #4b5563;
        font-size: 16px;
        line-height: 1.9;
    }

    /* =========================
       BUTTON
    ========================= */

    .btn-kembali {
        align-self: flex-start;
        margin-top: 20px;
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

        .detail-eskul-section {
            padding: 50px 0;
        }

        .detail-eskul-card {
            padding: 25px;
        }

        .detail-eskul-content {
            padding: 25px 5px 5px;
        }

        .detail-eskul-foto {
            height: 350px;
        }

        .detail-eskul-content h1 {
            font-size: 29px;
        }

    }

    @media (max-width: 575.98px) {

        .detail-eskul-section {
            padding: 35px 0;
        }

        .detail-eskul-card {
            padding: 18px;
            border-radius: 15px;
        }

        .detail-eskul-foto {
            height: 260px;
            border-radius: 12px;
        }

        .detail-eskul-content {
            padding: 22px 2px 2px;
        }

        .detail-eskul-content h1 {
            font-size: 25px;
        }

        .detail-eskul-deskripsi {
            font-size: 15px;
            line-height: 1.8;
        }

    }
</style>


<section class="detail-eskul-section">

    <div class="container">

        <div class="detail-eskul-card">

            <div class="row align-items-center g-4">

                {{-- ==========================================
                     FOTO EKSTRAKURIKULER
                =========================================== --}}

                <div class="col-lg-6">

                    <div class="detail-eskul-foto">

                        @if($ekstrakurikuler->gambar)

                            <img
                                src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}"
                                alt="{{ $ekstrakurikuler->nama_eskul }}">

                        @else

                            <div class="detail-no-foto">
                                Tidak ada gambar
                            </div>

                        @endif

                    </div>

                </div>


                {{-- ==========================================
                     INFORMASI
                =========================================== --}}

                <div class="col-lg-6">

                    <div class="detail-eskul-content">

                        <span class="detail-eskul-label">
                            Ekstrakurikuler
                        </span>


                        {{-- NAMA --}}

                        <h1>
                            {{ $ekstrakurikuler->nama_eskul }}
                        </h1>


                        <div class="detail-garis"></div>


                        {{-- INFORMASI --}}

                        <div class="detail-eskul-info">

                            <p>
                                <strong>Pembina:</strong>
                                {{ $ekstrakurikuler->pembina }}
                            </p>

                            <p>
                                <strong>Jadwal Latihan:</strong>
                                {{ $ekstrakurikuler->jadwal_latihan }}
                            </p>

                        </div>


                        {{-- DESKRIPSI --}}

                        <div class="detail-eskul-deskripsi">

                            {!! nl2br(e($ekstrakurikuler->deskripsi)) !!}

                        </div>


                        {{-- KEMBALI --}}

                        <a
                            href="{{ route('public.ekstrakurikuler') }}"
                            class="btn btn-success btn-kembali">

                            ← Kembali ke Ekstrakurikuler

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection