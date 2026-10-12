@extends('public.layouts.app')

@section('title', 'Ekstrakurikuler - MAN 2 Tasikmalaya')

@section('content')

<style>
    .eskul-section {
        padding: 70px 0;
        background: #f8faf9;
        min-height: 600px;
    }

    .eskul-header {
        max-width: 700px;
        margin: 0 auto 50px;
        text-align: center;
    }

    .eskul-header .label {
        display: inline-block;
        margin-bottom: 10px;
        color: #006b3c;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .eskul-header h1 {
        margin-bottom: 12px;
        color: #1f2937;
        font-size: 36px;
        font-weight: 700;
    }

    .eskul-header p {
        margin: 0;
        color: #6b7280;
        font-size: 16px;
        line-height: 1.7;
    }

    .eskul-card {
        height: 100%;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e5eee9;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .05);
        transition: .3s ease;
    }

    .eskul-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 15px 35px rgba(0, 107, 60, .12);
    }

    .eskul-foto {
        width: 100%;
        height: 230px;
        overflow: hidden;
        background: #e8f5ee;
    }

    .eskul-foto img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: .4s ease;
    }

    .eskul-card:hover .eskul-foto img {
        transform: scale(1.05);
    }

    .eskul-no-foto {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
    }

    .eskul-info {
        padding: 22px;
    }

    .eskul-info h3 {
        margin-bottom: 12px;
        color: #1f2937;
        font-size: 20px;
        font-weight: 700;
    }

    .eskul-info p {
        margin-bottom: 8px;
        color: #6b7280;
        font-size: 14px;
        line-height: 1.7;
    }

    .eskul-info strong {
        color: #006b3c;
    }

    .eskul-deskripsi {
        margin-top: 12px;
    }

    .eskul-kosong {
        padding: 60px 20px;
        text-align: center;
        background: #fff;
        border: 1px dashed #b9dcc9;
        border-radius: 18px;
    }

    .eskul-kosong .icon {
        margin-bottom: 15px;
        font-size: 45px;
    }

    @media (max-width: 575.98px) {

        .eskul-section {
            padding: 45px 0;
        }

        .eskul-header h1 {
            font-size: 28px;
        }

        .eskul-foto {
            height: 260px;
        }

    }
</style>


<section class="eskul-section">

    <div class="container">

        {{-- HEADER --}}
        <div class="eskul-header">

            <span class="label">
                Aktivitas & Prestasi
            </span>

            <h1> Ekstrakurikuler {{ $profilSekolah->nama_sekolah ?? 'Sekolah' }} </h1>
            <p> Berbagai kegiatan ekstrakurikuler untuk mengembangkan bakat, minat, dan potensi peserta didik. </p>
        </div>


        {{-- DATA EKSTRAKURIKULER --}}
        @if(isset($ekstrakurikuler) && $ekstrakurikuler->count())

        <div class="row g-4">

            @foreach($ekstrakurikuler as $eskul)

            <div class="col-12 col-md-6 col-lg-4">

                <div class="eskul-card">

                    {{-- GAMBAR --}}
                    <div class="eskul-foto">

                        @if($eskul->gambar)

                        <img
                            src="{{ asset('storage/' . $eskul->gambar) }}"
                            alt="{{ $eskul->nama_eskul }}"
                            loading="lazy">

                        @else

                        <div class="eskul-no-foto">
                            Tidak ada gambar
                        </div>

                        @endif

                    </div>


                    {{-- INFORMASI --}}
                    <div class="eskul-info">

                        <h3>
                            {{ $eskul->nama_eskul }}
                        </h3>

                        <p>
                            <strong>Pembina:</strong>
                            {{ $eskul->pembina }}
                        </p>

                        <p>
                            <strong>Jadwal:</strong>
                            {{ $eskul->jadwal_latihan }}
                        </p>

                        <p class="eskul-deskripsi">
                            {{ \Illuminate\Support\Str::limit(
                                        $eskul->deskripsi,
                                        120
                                    ) }}
                        </p>

                        @if(!empty($eskul->slug))
                        <a href="{{ route('public.ekstrakurikuler.show', ['slug' => $eskul->slug]) }}"
                            class="btn btn-success btn-sm mt-2">
                            Lihat Detail
                        </a>
                        @endif


                    </div>

                </div>

            </div>

            @endforeach

        </div>

        @else

        <div class="eskul-kosong">

            <div class="icon">
                🏆
            </div>

            <h3>
                Belum Ada Ekstrakurikuler
            </h3>

            <p class="text-muted mb-0">
                Data ekstrakurikuler belum tersedia.
            </p>

        </div>

        @endif

    </div>

</section>

@endsection