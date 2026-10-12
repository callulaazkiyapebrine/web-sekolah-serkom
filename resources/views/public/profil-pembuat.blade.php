@extends('public.layouts.app')

@section('title', 'Profil Pembuat Website - MAN 2 Tasikmalaya')

@section('content')

<style>
    .profil-pembuat-section {
        padding: 70px 0;
        background: #f8faf9;
        min-height: 650px;
    }

    .profil-pembuat-card {
        max-width: 1100px;
        margin: 0 auto;
        padding: 35px;
        background: #fff;
        border: 1px solid #e5eee9;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
    }

    .profil-pembuat-foto {
        width: 100%;
        height: 420px;
        overflow: hidden;
        background: #e8f5ee;
        border-radius: 16px;
    }

    .profil-pembuat-foto img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .profil-no-foto {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        color: #6b7280;
        font-size: 15px;
    }

    .profil-pembuat-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
        padding: 10px 5px 10px 25px;
    }

    .profil-pembuat-label {
        display: inline-block;
        margin-bottom: 10px;
        color: #006b3c;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .profil-pembuat-content h1 {
        margin: 0 0 15px;
        color: #1f2937;
        font-size: 32px;
        font-weight: 700;
        line-height: 1.4;
        overflow-wrap: anywhere;
    }

    .profil-pembuat-garis {
        width: 55px;
        height: 4px;
        margin-bottom: 22px;
        background: #006b3c;
        border-radius: 20px;
    }

    .profil-pembuat-info {
        margin-bottom: 20px;
    }

    .profil-pembuat-info p {
        margin-bottom: 12px;
        color: #6b7280;
        font-size: 14px;
        line-height: 1.7;
    }

    .profil-pembuat-info strong {
        color: #006b3c;
        font-weight: 700;
    }

    .profil-pembuat-deskripsi {
        margin-top: 5px;
        color: #4b5563;
        font-size: 15px;
        line-height: 1.9;
        text-align: justify;
    }

    .profil-pembuat-deskripsi h5 {
        margin-bottom: 10px;
        color: #006b3c;
        font-size: 17px;
        font-weight: 700;
    }

    /* TOMBOL */
    .btn-profil-kembali {
        align-self: flex-start;
        margin-top: 20px;
        padding: 10px 18px;
        border-radius: 8px;
        background: #006b3c;
        border-color: #006b3c;
        color: #fff;
        text-decoration: none;
    }

    .btn-profil-kembali:hover {
        background: #00552f;
        border-color: #00552f;
        color: #fff;
    }

    /* TABLET */
    @media (max-width: 991.98px) {
        .profil-pembuat-section {
            padding: 50px 0;
        }

        .profil-pembuat-card {
            padding: 25px;
        }

        .profil-pembuat-content {
            padding: 25px 5px 5px;
        }


        .profil-pembuat-foto {
            height: 350px;
        }

        
        .profil-pembuat-content h1 {
            font-size: 28px;
        }
    }

    /* HP */
    @media (max-width: 575.98px) {
        .profil-pembuat-section {
            padding: 35px 0;
        }

        .profil-pembuat-card {
            padding: 18px;
            border-radius: 15px;
        }

        .profil-pembuat-foto {
            height: 280px;
            border-radius: 12px;
        }

        .profil-pembuat-content {
            padding: 22px 2px 2px;
        }

        .profil-pembuat-content h1 {
            font-size: 25px;
        }

        .profil-pembuat-deskripsi {
            font-size: 14px;
            line-height: 1.8;
        }

        .btn-profil-kembali {
            width: 100%;
            text-align: center;
        }
    }
</style>

<section class="profil-pembuat-section">

    <div class="container">

        <div class="profil-pembuat-card">

            <div class="row align-items-center g-4">

                <div class="col-lg-5">

                    <div class="profil-pembuat-foto">

                        <img
                            src="{{ asset('img/profil-pembuat.jpeg') }}"
                            alt="Foto Callula Azkiya Pebrine">
                          

                        <div class="profil-no-foto" style="display: none;">
                            Foto belum tersedia
                        </div>

                    </div>

                </div>

                <div class="col-lg-7">

                    <div class="profil-pembuat-content">

                        <span class="profil-pembuat-label">
                            Profil Pembuat Website
                        </span>

                        <h1>Callula Azkiya Pebrine</h1>

                        <div class="profil-pembuat-garis"></div>

                        <div class="profil-pembuat-info">

                            <p>
                                <strong>Tempat, Tanggal Lahir:</strong>
                                Bogor, 14 Februari 2009
                            </p>

                            <p>
                                <strong>Hobi:</strong>
                                Mendengarkan Musik
                            </p>

                            <p>
                                <strong>Kelas:</strong>
                                XI RPL 2
                            </p>

                            <p>
                                <strong>Sekolah:</strong>
                                SMK YPC Tasikmalaya
                            </p>

                            <p>
                                <strong>Jurusan:</strong>
                                Pengembangan Perangkat Lunak dan Gim
                            </p>

                        </div>

                        <div class="profil-pembuat-deskripsi">

                            <h5>Tentang Saya</h5>

                            <p>
                                Saya merupakan siswa jurusan Pengembangan
                                Perangkat Lunak dan Gim yang memiliki
                                ketertarikan pada teknologi, pemrograman,
                                dan pengembangan website. Website MAN 2
                                Tasikmalaya ini menjadi salah satu proyek
                                pembelajaran untuk menerapkan keterampilan
                                yang telah saya pelajari.
                            </p>

                        </div>

                        {{-- KEMBALI --}}

                        <a
                            href="{{ route('public.dashboard') }}"
                            class="btn btn-success btn-profil-kembali">

                            ← Kembali ke Beranda

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
