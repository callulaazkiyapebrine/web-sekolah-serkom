@extends('public.layouts.app')

@section('title', 'Berita - ' . ($profilSekolah->nama_sekolah ?? 'Sekolah'))

@section('content')

<style>
    /* ===============================
       SECTION BERITA
    =============================== */

    .berita-section {
        padding: 70px 0;
        background: #f8faf9;
        min-height: 600px;
    }

    /* ===============================
       HEADER
    =============================== */

    .berita-header {
        max-width: 700px;
        margin: 0 auto 50px;
        text-align: center;
    }

    .berita-header .label {
        display: inline-block;
        margin-bottom: 10px;
        color: #006b3c;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .berita-header h1 {
        margin-bottom: 12px;
        color: #1f2937;
        font-size: 36px;
        font-weight: 700;
    }

    .berita-header p {
        margin: 0;
        color: #6b7280;
        font-size: 16px;
        line-height: 1.7;
    }

    /* ===============================
       CARD BERITA
    =============================== */

    .berita-card {
        height: 100%;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e5eee9;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .05);
        transition: .3s ease;
    }

    .berita-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 15px 35px rgba(0, 107, 60, .12);
    }

    /* ===============================
       GAMBAR BERITA
    =============================== */

    .berita-foto {
        width: 100%;
        height: 230px;
        overflow: hidden;
        background: #e8f5ee;
    }

    .berita-foto img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: .4s ease;
    }

    .berita-card:hover .berita-foto img {
        transform: scale(1.05);
    }

    .berita-no-foto {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        color: #6b7280;
        background: #e8f5ee;
    }

    /* ===============================
       INFORMASI BERITA
    =============================== */

    .berita-info {
        padding: 22px;
    }

    .berita-tanggal {
        margin-bottom: 10px;
        color: #6b7280;
        font-size: 13px;
    }

    .berita-info h3 {
        margin-bottom: 0;
        color: #1f2937;
        font-size: 20px;
        font-weight: 700;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }

    /* ===============================
       JIKA BELUM ADA BERITA
    =============================== */

    .berita-kosong {
        padding: 60px 20px;
        text-align: center;
        background: #fff;
        border: 1px dashed #b9dcc9;
        border-radius: 18px;
    }

    .berita-kosong .icon {
        margin-bottom: 15px;
        font-size: 45px;
    }

    .berita-kosong h3 {
        margin-bottom: 8px;
        color: #1f2937;
    }

    .berita-kosong p {
        margin: 0;
        color: #6b7280;
    }

    /* ===============================
       RESPONSIVE
    =============================== */

    @media (max-width: 575.98px) {

        .berita-section {
            padding: 45px 0;
        }

        .berita-header h1 {
            font-size: 28px;
        }

        .berita-foto {
            height: 260px;
        }

    }
</style>

<section class="berita-section">

    <div class="container">

        {{-- HEADER --}}
        <div class="berita-header">

            <span class="label">
                Informasi Sekolah
            </span>

            <h1>
                Berita {{ $profilSekolah->nama_sekolah ?? 'Sekolah' }}
            </h1>

            <p>
                Informasi dan berita terbaru seputar kegiatan
                {{ $profilSekolah->nama_sekolah ?? 'sekolah ini' }}.
            </p>

        </div>

        {{-- DATA BERITA --}}
        @if(isset($beritas) && $beritas->count() > 0)

            <div class="row g-4">

                @foreach($beritas as $berita)

                    <div class="col-12 col-md-6 col-lg-4">

                        {{-- CARD --}}
                        <div class="berita-card">

                            {{-- GAMBAR --}}
                            <div class="berita-foto">

                                @if($berita->gambar)

                                    <img
                                        src="{{ asset('storage/' . $berita->gambar) }}"
                                        alt="{{ $berita->judul }}"
                                        loading="lazy"
                                    >

                                @else

                                    <div class="berita-no-foto">
                                        Tidak ada foto
                                    </div>

                                @endif

                            </div>

                            {{-- INFORMASI --}}
                            <div class="berita-info">

                                <div class="berita-tanggal">
                                    {{ $berita->created_at
                                        ? $berita->created_at->format('d M Y')
                                        : '-' }}
                                </div>

                                <h3>
                                    {{ $berita->judul }}
                                </h3>

                                {{-- TOMBOL BACA SELENGKAPNYA --}}
                                @if(!empty($berita->slug))

                                    <a
                                        href="{{ route('public.berita.show', ['slug' => $berita->slug]) }}"
                                        class="btn btn-success btn-sm mt-3"
                                    >
                                        Baca Selengkapnya
                                    </a>

                                @endif

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            {{-- BELUM ADA BERITA --}}
            <div class="berita-kosong">

                <div class="icon">
                    📰
                </div>

                <h3>
                    Belum Ada Berita
                </h3>

                <p>
                    Berita sekolah belum tersedia.
                </p>

            </div>

        @endif

    </div>

</section>

@endsection
