@extends('public.layouts.app')

@section('title', ($pengumuman->judul ?? 'Detail Pengumuman') . ' - ' . ($profilSekolah->nama_sekolah ?? 'Sekolah'))

@section('content')

<style>
    .detail-pengumuman-section {
        padding: 70px 0;
        background: #f8faf9;
        min-height: 650px;
    }

    .detail-pengumuman-card {
        max-width: 1100px;
        margin: 0 auto;
        padding: 35px;
        background: #fff;
        border: 1px solid #e5eee9;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
    }

    .detail-pengumuman-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        min-height: 400px;
        padding: 30px;
        color: #087f5b;
        background: linear-gradient(145deg, #e8f5ee, #f5faf7);
        border-radius: 16px;
        text-align: center;
    }

    .detail-pengumuman-icon i {
        font-size: 100px;
    }

    .detail-pengumuman-icon p {
        margin: 20px 0 0;
        color: #527363;
        font-size: 15px;
    }

    .detail-pengumuman-content {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 10px 5px 10px 25px;
    }

    .detail-pengumuman-label {
        display: inline-block;
        margin-bottom: 10px;
        color: #087f5b;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .detail-pengumuman-tanggal {
        margin-bottom: 15px;
        color: #198754;
        font-size: 14px;
        font-weight: 600;
    }

    .detail-pengumuman-judul {
        margin: 0 0 22px;
        color: #1f2937;
        font-size: 34px;
        font-weight: 700;
        line-height: 1.3;
        overflow-wrap: anywhere;
    }

    .detail-pengumuman-garis {
        width: 55px;
        height: 4px;
        margin-bottom: 25px;
        background: #087f5b;
        border-radius: 20px;
    }

    .detail-pengumuman-status {
        margin-bottom: 20px;
        color: #6b7280;
        font-size: 14px;
    }

    .detail-pengumuman-isi {
        color: #4b5563;
        font-size: 16px;
        line-height: 1.9;
        overflow-wrap: anywhere;
    }

    .detail-pengumuman-isi p {
        margin-bottom: 18px;
    }

    .btn-kembali-pengumuman {
        align-self: flex-start;
        margin-top: 25px;
        padding: 10px 18px;
        color: #fff;
        background: #087f5b;
        border: 1px solid #087f5b;
        border-radius: 8px;
    }

    .btn-kembali-pengumuman:hover {
        color: #fff;
        background: #056644;
        border-color: #056644;
    }

    @media (max-width: 991.98px) {
        .detail-pengumuman-section {
            padding: 50px 0;
        }

        .detail-pengumuman-card {
            padding: 25px;
        }

        .detail-pengumuman-content {
            padding: 25px 5px 5px;
        }

        .detail-pengumuman-icon {
            min-height: 300px;
        }

        .detail-pengumuman-judul {
            font-size: 29px;
        }
    }

    @media (max-width: 575.98px) {
        .detail-pengumuman-section {
            padding: 35px 0;
        }

        .detail-pengumuman-card {
            padding: 18px;
            border-radius: 15px;
        }

        .detail-pengumuman-icon {
            min-height: 230px;
        }

        .detail-pengumuman-icon i {
            font-size: 75px;
        }

        .detail-pengumuman-content {
            padding: 22px 2px 2px;
        }

        .detail-pengumuman-judul {
            font-size: 25px;
        }

        .detail-pengumuman-isi {
            font-size: 15px;
            line-height: 1.8;
        }
    }
</style>

<section class="detail-pengumuman-section">
    <div class="container">

        <div class="detail-pengumuman-card">
            <div class="row align-items-center g-4">

                {{-- KOLOM ILUSTRASI --}}
                <div class="col-lg-6">
                    <div class="detail-pengumuman-icon">
                        <div>
                            <i data-feather="bell"></i>
                            <p>Informasi Resmi Sekolah</p>
                        </div>
                    </div>
                </div>

                {{-- KOLOM INFORMASI --}}
                <div class="col-lg-6">
                    <div class="detail-pengumuman-content">

                        <span class="detail-pengumuman-label">
                            Pengumuman Sekolah
                        </span>

                        {{-- TANGGAL --}}
                        <div class="detail-pengumuman-tanggal">
                            <i data-feather="calendar" class="me-1"></i>
                            {{ $pengumuman->tanggal
                                ? \Carbon\Carbon::parse($pengumuman->tanggal)->translatedFormat('d F Y')
                                : '-' }}
                        </div>

                        {{-- JUDUL --}}
                        <h1 class="detail-pengumuman-judul">
                            {{ $pengumuman->judul }}
                        </h1>

                        <div class="detail-pengumuman-garis"></div>

                        {{-- STATUS --}}
                        <div class="detail-pengumuman-status">
                            Status:
                            @if($pengumuman->status == 'publish')
                                <span class="badge bg-success">Publish</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </div>

                        {{-- ISI --}}
                        <div class="detail-pengumuman-isi">
                            {!! nl2br(e($pengumuman->isi)) !!}
                        </div>

                        {{-- KEMBALI --}}
                        <a href="{{ route('public.pengumuman') }}"
                           class="btn btn-success btn-kembali-pengumuman">
                            ← Kembali ke Pengumuman
                        </a>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
