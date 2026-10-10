@extends('public.layouts.app')

@section('content')

<style>
    .detail-guru-section {
        padding: 40px 0;
        background: #f8faf9;
        min-height: 500px;
    }

    .detail-guru-card {
        max-width: 750px;
        margin: 0 auto;
        background: #ffffff;
        border: 1px solid #e5eee9;
        border-radius: 15px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, .05);
    }

    .detail-guru-foto {
        width: 220px;
        height: 270px;
        object-fit: cover;
        border-radius: 12px;
        display: block;
        margin: 0 auto;
    }

    .detail-guru-label {
        color: #006b3c;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .detail-guru-nama {
        color: #1f2937;
        font-size: 27px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .detail-guru-info {
        color: #6b7280;
        font-size: 15px;
        line-height: 1.6;
    }

    .detail-guru-info p {
        margin-bottom: 15px;
    }

    .detail-guru-info strong {
        color: #1f2937;
    }

    .detail-guru-card .btn {
        border-radius: 8px;
        font-size: 14px;
        padding: 8px 15px;
    }

    @media (max-width: 767px) {

        .detail-guru-section {
            padding: 30px 15px;
        }

        .detail-guru-card {
            max-width: 100%;
        }

        .detail-guru-foto {
            width: 180px;
            height: 220px;
        }

        .detail-guru-nama {
            font-size: 23px;
        }

        .detail-guru-info {
            font-size: 14px;
        }
    }
</style>


<section class="detail-guru-section">

    <div class="container">

        <div class="detail-guru-card p-4 p-md-5">

            <div class="row align-items-center g-4">

                {{-- FOTO --}}
                <div class="col-md-5 text-center">

                    @if($guru->foto)

                        <img
                            src="{{ asset('storage/' . $guru->foto) }}"
                            alt="{{ $guru->nama_guru }}"
                            class="detail-guru-foto">

                    @else

                        <div class="detail-guru-foto d-flex align-items-center justify-content-center bg-light mx-auto">

                            <span class="text-muted">
                                Tidak ada foto
                            </span>

                        </div>

                    @endif

                </div>


                {{-- INFORMASI --}}
                <div class="col-md-7">

                    <div class="detail-guru-label mb-2">
                        Guru & Staf
                    </div>

                    <h1 class="detail-guru-nama">
                        {{ $guru->nama_guru }}
                    </h1>

                    <div class="detail-guru-info">

                        <p>
                            <strong>NIP</strong><br>
                            {{ $guru->nip ?: '-' }}
                        </p>

                        <p>
                            <strong>Mata Pelajaran</strong><br>
                            {{ $guru->mapel ?: '-' }}
                        </p>

                    </div>


                    {{-- KEMBALI --}}
                    <a
                        href="{{ route('public.guru') }}"
                        class="btn btn-success mt-2">

                        ← Kembali ke Daftar Guru

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection