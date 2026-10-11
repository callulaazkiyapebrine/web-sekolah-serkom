@extends('public.layouts.app')

@section('content')

<style>
    .guru-section {
        padding: 80px 0;
        background: #f8faf9;
    }

    .guru-header {
        max-width: 700px;
        margin: 0 auto 50px;
        text-align: center;
    }

    .guru-header .label {
        display: inline-block;
        margin-bottom: 10px;
        color: #006b3c;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .guru-header h1 {
        margin-bottom: 12px;
        color: #1f2937;
        font-size: 36px;
        font-weight: 700;
    }

    .guru-header p {
        margin: 0;
        color: #6b7280;
        font-size: 16px;
        line-height: 1.7;
    }

    .guru-card {
        height: 100%;
        overflow: hidden;
        background: #ffffff;
        border: 1px solid #e5eee9;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .guru-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 15px 35px rgba(0, 107, 60, 0.12);
    }

    .guru-foto {
        width: 100%;
        height: 280px;
        overflow: hidden;
        background: #e8f5ee;
    }

    .guru-foto img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.4s ease;
    }

    .guru-card:hover .guru-foto img {
        transform: scale(1.05);
    }

    .guru-info {
        padding: 22px;
        text-align: center;
    }

    .guru-info h3 {
        margin: 0 0 7px;
        color: #1f2937;
        font-size: 19px;
        font-weight: 700;
    }

    .guru-info p {
        margin: 0 0 18px;
        color: #006b3c;
        font-size: 14px;
        font-weight: 600;
    }

    .guru-kosong {
        padding: 60px 20px;
        text-align: center;
        background: #ffffff;
        border: 1px dashed #b9dcc9;
        border-radius: 18px;
    }

    .guru-kosong .icon {
        margin-bottom: 15px;
        font-size: 45px;
    }

    .guru-kosong h3 {
        margin-bottom: 8px;
        color: #1f2937;
        font-size: 22px;
    }

    .guru-kosong p {
        margin: 0;
        color: #6b7280;
    }

    @media (max-width: 575.98px) {

        .guru-section {
            padding: 55px 0;
        }

        .guru-header h1 {
            font-size: 28px;
        }

        .guru-header p {
            font-size: 15px;
        }

        .guru-foto {
            height: 300px;
        }

    }
</style>


<section id="daftar-guru" class="guru-section">

    <div class="container">

        {{-- HEADER --}}
        <div class="guru-header">

            <span class="label">
                Guru & Staf
            </span>

            <h1> Guru & Staf {{ $profilSekolah->nama_sekolah ?? 'Sekolah' }} </h1>
            <p> Kenali tenaga pendidik yang menjadi bagian dari keluarga besar {{ $profilSekolah->nama_sekolah ?? 'sekolah ini' }}. </p>

        </div>


        {{-- DATA GURU --}}
        @if($guru->count())

        <div class="row g-4">

            @foreach($guru as $dataGuru)

            <div class="col-md-6 col-lg-3">

                <div class="guru-card">

                    {{-- FOTO --}}
                    <div class="guru-foto">

                        @if($dataGuru->foto)

                        <img
                            src="{{ asset('storage/' . $dataGuru->foto) }}"
                            alt="{{ $dataGuru->nama_guru }}">

                        @else

                        <div class="d-flex align-items-center justify-content-center h-100">

                            <span class="text-muted">
                                Tidak ada foto
                            </span>

                        </div>

                        @endif

                    </div>


                    {{-- INFORMASI --}}
                    <div class="guru-info">

                        <h3>
                            {{ $dataGuru->nama_guru }}
                        </h3>

                        <p>
                            {{ $dataGuru->mapel ?? 'Guru' }}
                        </p>


                        {{-- DETAIL PUBLIC --}}
                        <a href="{{ route('public.guru.show', ['id' => Crypt::encrypt($dataGuru->id_guru)]) }}"
                            class="btn btn-success btn-sm">
                            Lihat Detail 
                        </a>
                    </div>

                </div>

            </div>

            @endforeach

        </div>

        @else

        {{-- JIKA BELUM ADA DATA --}}
        <div class="guru-kosong">

            <div class="icon">
                👨‍🏫
            </div>

            <h3>
                Data Guru Belum Tersedia
            </h3>

            <p>
                Data guru dan staf belum ditambahkan.
            </p>

        </div>

        @endif

    </div>

</section>

@endsection