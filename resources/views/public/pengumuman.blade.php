@extends('public.layouts.app')

@section('title', 'Pengumuman - ' . ($profilSekolah->nama_sekolah ?? 'Sekolah'))

@section('content')

<style>
    .pengumuman-section {
        padding: 80px 0;
        background: #f8faf9;
        min-height: 600px;
    }

    .pengumuman-header {
        max-width: 700px;
        margin: 0 auto 50px;
        text-align: center;
    }

    .pengumuman-header .label {
        display: inline-block;
        margin-bottom: 10px;
        color: #087f5b;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .pengumuman-header h1 {
        margin-bottom: 12px;
        color: #1f2937;
        font-size: 36px;
        font-weight: 700;
    }

    .pengumuman-header p {
        margin: 0;
        color: #6b7280;
        line-height: 1.7;
    }

    .pengumuman-card {
        height: 100%;
        padding: 25px;
        background: #fff;
        border: 1px solid #e5eee9;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .05);
        transition: .35s ease;
        overflow-wrap: break-word;
    }

    .pengumuman-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(0, 107, 60, .12);
    }

    .pengumuman-tanggal {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 15px;
        padding: 6px 12px;
        color: #087f5b;
        background: #e8f5ee;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .pengumuman-tanggal svg {
        width: 14px;
        height: 14px;
    }

    .pengumuman-card h3 {
        margin-bottom: 12px;
        color: #1f2937;
        font-size: 20px;
        font-weight: 700;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }

    .pengumuman-ringkasan {
        margin-bottom: 20px;
        color: #6b7280;
        font-size: 14px;
        line-height: 1.8;
        overflow-wrap: anywhere;
    }

    .pengumuman-detail {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 15px;
        color: #fff;
        background: #087f5b;
        border: 1px solid #087f5b;
        border-radius: 8px;
        font-size: 13px;
        text-decoration: none;
        transition: .3s ease;
    }

    .pengumuman-detail:hover {
        color: #fff;
        background: #056644;
        border-color: #056644;
    }

    .pengumuman-kosong {
        padding: 60px 20px;
        text-align: center;
        background: #fff;
        border: 1px dashed #b9dcc9;
        border-radius: 18px;
    }

    .pengumuman-kosong .icon {
        margin-bottom: 15px;
        font-size: 45px;
    }

    .pengumuman-kosong h3 {
        margin-bottom: 8px;
        color: #1f2937;
        font-size: 22px;
        font-weight: 700;
    }

    .pengumuman-kosong p {
        margin: 0;
        color: #6b7280;
    }

    @media (max-width: 767px) {
        .pengumuman-section {
            padding: 55px 0;
        }

        .pengumuman-header h1 {
            font-size: 29px;
        }

        .pengumuman-card {
            padding: 22px;
        }

        .pengumuman-card h3 {
            font-size: 19px;
        }
    }
</style>

<section class="pengumuman-section">
    <div class="container">

        {{-- HEADER --}}
        <div class="pengumuman-header">
            <span class="label">Informasi Sekolah</span>

            <h1>
                Pengumuman {{ $profilSekolah->nama_sekolah ?? 'Sekolah' }}
            </h1>

            <p>
                Dapatkan informasi dan pemberitahuan terbaru dari
                {{ $profilSekolah->nama_sekolah ?? 'sekolah kami' }}.
            </p>
        </div>

        {{-- DATA PENGUMUMAN --}}
      @if(isset($pengumumans) && $pengumumans->count() > 0)

            <div class="row g-4">
                @foreach($pengumumans as $dataPengumuman)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="pengumuman-card">

                            {{-- TANGGAL --}}
                            <div class="pengumuman-tanggal">
                                <i data-feather="calendar"></i>

                                {{ $dataPengumuman->tanggal
                                    ? \Carbon\Carbon::parse($dataPengumuman->tanggal)->translatedFormat('d F Y')
                                    : '-' }}
                            </div>

                            {{-- JUDUL --}}
                            <h3>{{ $dataPengumuman->judul }}</h3>

                            {{-- RINGKASAN --}}
                            <div class="pengumuman-ringkasan">
                                {{ \Illuminate\Support\Str::limit(strip_tags($dataPengumuman->isi), 140) }}
                            </div>

                            {{-- DETAIL --}}
                            <a
                                href="{{ route('public.pengumuman.show', [
                                    'id' => \Illuminate\Support\Facades\Crypt::encrypt($dataPengumuman->id_pengumuman)
                                ]) }}"
                                class="pengumuman-detail"
                            >
                                Baca Selengkapnya
                                <i data-feather="arrow-right"></i>
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>

        @else

            {{-- JIKA BELUM ADA DATA --}}
            <div class="pengumuman-kosong">
                <div class="icon">📢</div>

                <h3>Belum Ada Pengumuman</h3>

                <p>
                    Informasi pengumuman sekolah akan ditampilkan di sini.
                </p>
            </div>

        @endif

    </div>
</section>

@endsection
