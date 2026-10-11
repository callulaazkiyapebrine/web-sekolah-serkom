@extends('public.layouts.app')

@section('title', $prestasi->nama_prestasi . ' - Prestasi MAN 2 Tasikmalaya')

@section('content')

<style>
    .detail-prestasi {
        padding: 80px 0;
        background: #f8faf9;
    }

    .detail-back {
        display: inline-block;
        margin-bottom: 25px;
        color: #087f5b;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
    }

    .detail-back:hover {
        color: #056b4c;
    }

    .detail-box {
        display: grid;
        grid-template-columns: 1.1fr .9fr;
        max-width: 1000px;
        margin: auto;
        overflow: hidden;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 35px rgba(0, 70, 45, .08);
    }

    .detail-foto {
        min-height: 520px;
        background: #e8f5ee;
    }

    .detail-foto img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
    }

    .detail-no-foto {
        height: 100%;
        min-height: 520px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
    }

    .detail-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 45px;
    }

    .detail-label {
        margin-bottom: 12px;
        color: #087f5b;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .detail-title {
        margin-bottom: 18px;
        color: #1f2937;
        font-size: 32px;
        font-weight: 700;
        line-height: 1.3;
    }

    .detail-date {
        margin-bottom: 22px;
        color: #087f5b;
        font-size: 14px;
        font-weight: 600;
    }

    .detail-pemenang {
        display: inline-block;
        width: fit-content;
        margin-bottom: 20px;
        padding: 6px 12px;
        border-radius: 20px;
        color: #087f5b;
        background: #e8f5ee;
        font-size: 12px;
        font-weight: 700;
    }

    .detail-keterangan {
        color: #5f6b65;
        font-size: 15px;
        line-height: 1.8;
    }

    .detail-button {
        display: inline-block;
        width: fit-content;
        margin-top: 30px;
        padding: 10px 18px;
        border-radius: 10px;
        color: #fff;
        background: #087f5b;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: .3s ease;
    }

    .detail-button:hover {
        color: #fff;
        background: #056b4c;
        transform: translateY(-2px);
    }

    @media (max-width: 767px) {

        .detail-prestasi {
            padding: 55px 0;
        }

        .detail-box {
            grid-template-columns: 1fr;
        }

        .detail-foto,
        .detail-no-foto {
            min-height: 330px;
            height: 330px;
        }

        .detail-content {
            padding: 30px 25px;
        }

        .detail-title {
            font-size: 27px;
        }
    }
</style>


<section class="detail-prestasi">

    <div class="container">


        {{-- DETAIL --}}

        <div class="detail-box">


            {{-- GAMBAR --}}

            <div class="detail-foto">

                @if($prestasi->gambar)

                    <img
                        src="{{ asset('storage/' . $prestasi->gambar) }}"
                        alt="{{ $prestasi->nama_prestasi }}"
                    >

                @else

                    <div class="detail-no-foto">
                        Tidak ada gambar
                    </div>

                @endif

            </div>


            {{-- TULISAN --}}

            <div class="detail-content">

                <div class="detail-label">
                    Prestasi Sekolah
                </div>


                {{-- PEMENANG --}}

                @if($prestasi->nama_pemenang)

                    <span class="detail-pemenang">
                        🏆 {{ $prestasi->nama_pemenang }}
                    </span>

                @endif


                {{-- NAMA PRESTASI --}}

                <h1 class="detail-title">
                    {{ $prestasi->nama_prestasi }}
                </h1>


                {{-- TANGGAL --}}

                @if($prestasi->tanggal)

                    <div class="detail-date">
                        📅
                        {{ \Carbon\Carbon::parse($prestasi->tanggal)->format('d F Y') }}
                    </div>

                @endif


                {{-- KETERANGAN --}}

                @if($prestasi->keterangan)

                    <div class="detail-keterangan">
                        {!! nl2br(e($prestasi->keterangan)) !!}
                    </div>

                @endif


                {{-- BUTTON --}}

                <a
                    href="{{ route('public.prestasi') }}"
                    class="detail-button"
                >
                    ← Lihat Semua Prestasi
                </a>

            </div>

        </div>

    </div>

</section>

@endsection