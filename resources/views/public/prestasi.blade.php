@extends('public.layouts.app')
@section('title', 'Prestasi - ' . ($profilSekolah->nama_sekolah ?? 'Sekolah'))

@section('content')

<style>
    .prestasi-section {
        padding: 80px 0;
        background: #f8faf9;
        min-height: 600px;
    }

    .prestasi-header {
        max-width: 700px;
        margin: 0 auto 50px;
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

    .prestasi-link {
        display: block;
        color: inherit;
        text-decoration: none;
    }

    .prestasi-card {
        position: relative;
        height: 390px;
        overflow: hidden;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .06);
        transition: .35s ease;
    }

    .prestasi-link:hover .prestasi-card {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(0, 107, 60, .14);
    }

    .prestasi-foto {
        width: 100%;
        height: 210px;
        overflow: hidden;
        background: #e8f5ee;
    }

    .prestasi-foto img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        transition: .5s ease;
    }

    .prestasi-link:hover .prestasi-foto img {
        transform: scale(1.05);
    }

    .prestasi-no-foto {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #087f5b;
        background: #e8f5ee;
        font-size: 45px;
    }

    .prestasi-body {
        position: relative;
        padding: 25px 22px 20px;
    }

    .prestasi-icon {
        position: absolute;
        top: -27px;
        left: 22px;
        width: 54px;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 5px solid #fff;
        border-radius: 50%;
        color: #087f5b;
        background: #e8f5ee;
        font-size: 22px;
    }

    .prestasi-nomor {
        margin-bottom: 8px;
        color: #087f5b;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .prestasi-body h3 {
        margin-bottom: 10px;
        color: #1f2937;
        font-size: 20px;
        font-weight: 700;
        line-height: 1.4;
    }

    .prestasi-pemenang {
        margin-bottom: 13px;
        color: #087f5b;
        font-size: 14px;
        font-weight: 600;
    }

    .prestasi-keterangan {
        margin-bottom: 15px;
        color: #6b7280;
        font-size: 13px;
        line-height: 1.6;
    }

    .prestasi-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 13px;
        border-top: 1px solid #edf2ef;
    }

    .prestasi-tanggal {
        color: #6b7280;
        font-size: 12px;
    }

    .prestasi-arrow {
        color: #087f5b;
        font-size: 20px;
        font-weight: 700;
        transition: .3s ease;
    }

    .prestasi-link:hover .prestasi-arrow {
        transform: translateX(5px);
    }

    .prestasi-kosong {
        padding: 60px 20px;
        text-align: center;
        background: #fff;
        border: 1px dashed #b9dcc9;
        border-radius: 18px;
    }

    .prestasi-kosong .icon {
        margin-bottom: 15px;
        font-size: 45px;
    }

    .prestasi-kosong h3 {
        margin-bottom: 8px;
        color: #1f2937;
    }

    .prestasi-kosong p {
        margin: 0;
        color: #6b7280;
    }

    @media (max-width: 767px) {

        .prestasi-section {
            padding: 55px 0;
        }

        .prestasi-header h1 {
            font-size: 29px;
        }

        .prestasi-card {
            height: 370px;
        }

        .prestasi-foto {
            height: 195px;
        }

        .prestasi-body {
            padding: 25px 18px 18px;
        }

        .prestasi-icon {
            left: 18px;
        }

    }
</style>


<section class="prestasi-section">

    <div class="container">


        {{-- HEADER --}}

        <div class="prestasi-header">

            <span class="label">
                Pencapaian Sekolah
            </span>
            <h1>
                Prestasi {{ $profilSekolah->nama_sekolah ?? 'Sekolah' }}
            </h1>

            <p>
                Berbagai pencapaian dan prestasi yang diraih
                oleh siswa-siswi {{ $profilSekolah->nama_sekolah ?? 'sekolah ini' }}.
            </p>

        </div>


        {{-- DATA PRESTASI --}}

        @if(isset($prestasi) && $prestasi->count())

        <div class="row g-4">

            @foreach($prestasi as $item)

            <div class="col-12 col-md-6 col-lg-4">

            <a href="{{ route('public.prestasi.show', [
    'id' => \Illuminate\Support\Facades\Crypt::encrypt($item->id_prestasi)
]) }}" class="prestasi-link">
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
                                🏆
                            </div>

                            @endif

                        </div>


                        {{-- ISI --}}

                        <div class="prestasi-body">


                            {{-- ICON --}}

                            <div class="prestasi-icon">
                                🏆
                            </div>


                            {{-- NOMOR --}}

                            <div class="prestasi-nomor">
                                Prestasi {{ $loop->iteration }}
                            </div>


                            {{-- NAMA PRESTASI --}}

                            <h3>
                                {{ $item->nama_prestasi }}
                            </h3>


                            {{-- PEMENANG --}}

                            @if($item->nama_pemenang)

                            <div class="prestasi-pemenang">
                                👤 {{ $item->nama_pemenang }}
                            </div>

                            @endif


                            {{-- KETERANGAN --}}

                            @if($item->keterangan)

                            <div class="prestasi-keterangan">
                                {{ \Illuminate\Support\Str::limit($item->keterangan, 80) }}
                            </div>

                            @endif


                            {{-- FOOTER --}}

                            <div class="prestasi-footer">

                                <div class="prestasi-tanggal">

                                    📅

                                    {{ $item->tanggal 
                                                ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') 
                                                : '-' }}

                                </div>

                                <div class="prestasi-arrow">
                                    →
                                </div>

                            </div>


                        </div>

                    </div>

                </a>

            </div>

            @endforeach

        </div>


        @else


        {{-- KOSONG --}}

        <div class="prestasi-kosong">

            <div class="icon">
                🏆
            </div>

            <h3>
                Belum Ada Prestasi
            </h3>

            <p>
                Data prestasi sekolah belum tersedia.
            </p>

        </div>

        @endif


    </div>

</section>

@endsection 