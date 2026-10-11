@extends('public.layouts.app')

@section('title', 'Prestasi - ' . ($profilSekolah->nama_sekolah ?? 'Sekolah'))

@section('content')

<style>
    /* =========================================
       PRESTASI
    ========================================= */

    .prestasi-section {
        padding: 70px 0;
        background: #f8faf9;
        min-height: 600px;
    }

    /* HEADER */

    .prestasi-header {
        max-width: 700px;
        margin: 0 auto 45px;
        text-align: center;
    }

    .prestasi-header .label {
        display: inline-block;
        margin-bottom: 10px;
        color: #087f5b;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .prestasi-header h1 {
        margin-bottom: 12px;
        color: #1f2937;
        font-size: 36px;
        font-weight: 700;
    }

    .prestasi-header p {
        margin: 0;
        color: #6b7280;
        line-height: 1.7;
    }

    /* CARD */

    .prestasi-card {
        height: 100%;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        background: #fff;
        border: 1px solid #edf2ef;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .05);
        transition: .3s ease;
    }

    .prestasi-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 16px 35px rgba(0, 107, 60, .12);
    }

    /* GAMBAR */

    .prestasi-foto {
        width: 100%;
        height: 230px;
        overflow: hidden;
        flex-shrink: 0;
        background: #e8f5ee;
    }

    .prestasi-foto img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: .4s ease;
    }

    .prestasi-card:hover .prestasi-foto img {
        transform: scale(1.05);
    }

    .prestasi-no-foto {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        color: #087f5b;
        background: #e8f5ee;
        font-size: 15px;
    }

    /* ISI CARD */

    .prestasi-body {
        display: flex;
        flex-direction: column;
        flex: 1;
        padding: 22px;
    }

    .prestasi-tanggal {
        margin-bottom: 10px;
        color: #087f5b;
        font-size: 13px;
        font-weight: 600;
    }

    .prestasi-body h3 {
        margin-bottom: 10px;
        color: #1f2937;
        font-size: 20px;
        font-weight: 700;
        line-height: 1.4;
        overflow-wrap: anywhere;
    }

    .prestasi-pemenang {
        margin-bottom: 10px;
        color: #087f5b;
        font-size: 14px;
        font-weight: 600;
    }

    .prestasi-keterangan {
        margin-bottom: 18px;
        color: #6b7280;
        font-size: 14px;
        line-height: 1.7;
    }

    /* TOMBOL */

    .prestasi-aksi {
        margin-top: auto;
        padding-top: 5px;
    }

    .prestasi-aksi .btn {
        padding: 9px 17px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        transition: .3s ease;
    }

    .prestasi-aksi .btn:hover {
        background: #0b5d3b;
        border-color: #0b5d3b;
        transform: translateY(-2px);
    }

    /* DATA KOSONG */

    .prestasi-kosong {
        padding: 60px 20px;
        text-align: center;
        background: #fff;
        border: 1px dashed #b9dcc9;
        border-radius: 18px;
    }

    .prestasi-kosong h3 {
        margin-bottom: 8px;
        color: #1f2937;
        font-size: 22px;
        font-weight: 700;
    }

    .prestasi-kosong p {
        margin: 0;
        color: #6b7280;
    }

    /* RESPONSIVE */

    @media (max-width: 767px) {
        .prestasi-section {
            padding: 55px 0;
        }

        .prestasi-header h1 {
            font-size: 29px;
        }

        .prestasi-foto {
            height: 230px;
        }

        .prestasi-body {
            padding: 20px;
        }
    }
</style>

<section class="prestasi-section">
    <div class="container">

        {{-- HEADER --}}

        <div class="prestasi-header">
            <span class="label">Pencapaian Sekolah</span>

            <h1>
                Prestasi {{ $profilSekolah->nama_sekolah ?? 'Sekolah' }}
            </h1>

            <p>
                Berbagai pencapaian dan prestasi yang diraih oleh
                siswa-siswi {{ $profilSekolah->nama_sekolah ?? 'sekolah ini' }}.
            </p>
        </div>

        {{-- DATA PRESTASI --}}

        @if(isset($prestasi) && $prestasi->count())

            <div class="row g-4">

                @foreach($prestasi as $item)

                    <div class="col-12 col-md-6 col-lg-4">

                        <div class="prestasi-card">

                            {{-- GAMBAR --}}

                            <div class="prestasi-foto">

                                @if($item->gambar)

                                    <img
                                        src="{{ asset('storage/' . $item->gambar) }}"
                                        alt="{{ $item->nama_prestasi }}"
                                        loading="lazy">

                                @else

                                    <div class="prestasi-no-foto">
                                        Gambar belum tersedia
                                    </div>

                                @endif

                            </div>

                            {{-- ISI --}}

                            <div class="prestasi-body">

                                {{-- TANGGAL --}}

                                <div class="prestasi-tanggal">
                                    {{ $item->tanggal
                                        ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y')
                                        : 'Tanggal tidak tersedia' }}
                                </div>

                                {{-- NAMA PRESTASI --}}

                                <h3>
                                    {{ $item->nama_prestasi }}
                                </h3>

                                {{-- PEMENANG --}}

                                @if($item->nama_pemenang)

                                    <div class="prestasi-pemenang">
                                        {{ $item->nama_pemenang }}
                                    </div>

                                @endif

                                {{-- KETERANGAN --}}

                                @if($item->keterangan)

                                    <div class="prestasi-keterangan">
                                        {{ \Illuminate\Support\Str::limit($item->keterangan, 100) }}
                                    </div>

                                @else

                                    <div class="prestasi-keterangan">
                                        Informasi prestasi sekolah.
                                    </div>

                                @endif

                                {{-- TOMBOL BACA SELENGKAPNYA --}}

                                <div class="prestasi-aksi">

                                    <a
                                        href="{{ route('public.prestasi.show', [
                                            'id' => \Illuminate\Support\Facades\Crypt::encrypt($item->id_prestasi)
                                        ]) }}"
                                        class="btn btn-success">

                                        Baca Selengkapnya

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            {{-- DATA KOSONG --}}

            <div class="prestasi-kosong">

                <h3>Belum Ada Prestasi</h3>

                <p>
                    Data prestasi sekolah belum tersedia.
                </p>

            </div>

        @endif

    </div>
</section>

@endsection
