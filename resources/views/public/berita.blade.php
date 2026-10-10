@extends('public.layouts.app')

@section('title', 'Berita - ' . ($profilSekolah->nama_sekolah ?? 'Sekolah'))

@section('content')

<style>
    .berita-section {
        padding: 80px 0;
        background: #f8faf9;
        min-height: 600px;
    }

    .berita-header {
        max-width: 700px;
        margin: 0 auto 50px;
        text-align: center;
    }

    .berita-header .label {
        display: inline-block;
        margin-bottom: 10px;
        color: #087f5b;
        font-size: 13px;
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
        line-height: 1.7;
    }

    .berita-link {
        display: block;
        height: 100%;
        color: inherit;
        text-decoration: none;
    }

    .berita-card {
        position: relative;
        height: 300px;
        overflow: hidden;
        background: #e8f5ee;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .06);
        transition: .35s ease;
    }

    .berita-link:hover .berita-card {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(0, 107, 60, .15);
    }

    .berita-foto {
        width: 100%;
        height: 100%;
    }

    .berita-foto img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: .5s ease;
    }

    .berita-link:hover .berita-foto img {
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

    .berita-overlay {
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 15px;
        min-height: 150px;
        padding: 60px 22px 20px;
        color: #fff;
        background: linear-gradient(
            to top,
            rgba(0, 45, 28, .95),
            rgba(0, 45, 28, .60),
            transparent
        );
    }

    .berita-overlay-content {
        min-width: 0;
    }

    .berita-tanggal {
        margin-bottom: 7px;
        color: rgba(255, 255, 255, .78);
        font-size: 13px;
    }

    .berita-overlay h3 {
        margin: 0;
        color: #fff;
        font-size: 19px;
        font-weight: 700;
        line-height: 1.4;
    }

    .berita-arrow {
        display: flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        color: #087f5b;
        background: #fff;
        font-size: 20px;
        font-weight: 700;
        transition: .3s ease;
    }

    .berita-link:hover .berita-arrow {
        color: #fff;
        background: #087f5b;
        transform: translateX(4px);
    }

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

    @media (max-width: 767px) {
        .berita-section {
            padding: 55px 0;
        }

        .berita-header h1 {
            font-size: 29px;
        }

        .berita-card {
            height: 250px;
        }

        .berita-overlay {
            padding: 50px 18px 18px;
        }

        .berita-overlay h3 {
            font-size: 17px;
        }
    }
</style>

<section class="berita-section">
    <div class="container">

        <div class="berita-header">
            <span class="label">Informasi Sekolah</span>

            <h1>
                Berita {{ $profilSekolah->nama_sekolah ?? 'Sekolah' }}
            </h1>

            <p>
                Informasi dan berita terbaru seputar kegiatan
                {{ $profilSekolah->nama_sekolah ?? 'sekolah ini' }}.
            </p>
        </div>

        @if(isset($beritas) && $beritas->count() > 0)

            <div class="row g-4">

                @foreach($beritas as $berita)

                    <div class="col-12 col-md-6 col-lg-4">

                        @if(!empty($berita->slug))
                            <a
                                href="{{ route('public.berita.show', ['slug' => $berita->slug]) }}"
                                class="berita-link"
                            >
                        @else
                            <div class="berita-link">
                        @endif

                                <div class="berita-card">

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

                                    <div class="berita-overlay">

                                        <div class="berita-overlay-content">
                                            <div class="berita-tanggal">
                                                {{ $berita->created_at
                                                    ? $berita->created_at->format('d M Y')
                                                    : '-' }}
                                            </div>

                                            <h3>{{ $berita->judul }}</h3>
                                        </div>

                                        <span class="berita-arrow">→</span>

                                    </div>

                                </div>

                        @if(!empty($berita->slug))
                            </a>
                        @else
                            </div>
                        @endif

                    </div>

                @endforeach

            </div>

        @else

            <div class="berita-kosong">
                <div class="icon">📰</div>

                <h3>Belum Ada Berita</h3>

                <p>Berita sekolah belum tersedia.</p>
            </div>

        @endif

    </div>
</section>

@endsection
