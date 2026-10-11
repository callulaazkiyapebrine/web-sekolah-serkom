@extends('public.layouts.app')

@section('title', 'Beranda - ' . ($profilSekolah->nama_sekolah ?? ''))

@section('content')


<!-- ================= FOOTER CSS ================= -->

<style>
    /* =====================================================
   CAROUSEL
====================================================== */

    #carouselExampleFade {
        width: 100%;
        position: relative;
        overflow: hidden;
    }

    #carouselExampleFade .carousel-item {
        height: 520px;
        position: relative;
    }

    #carouselExampleFade .carousel-item img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* OVERLAY FOTO */

    #carouselExampleFade .carousel-item::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom,
                rgba(0, 70, 40, 0.15),
                rgba(0, 50, 30, 0.60));
        z-index: 1;
        pointer-events: none;
    }

    /* POSISI TEKS */

    #carouselExampleFade .carousel-caption {
        z-index: 2;
        bottom: 35%;
        left: 8%;
        right: 8%;
        text-align: center;
    }

    /* SELAMAT DATANG */

    #carouselExampleFade .carousel-caption .carousel-welcome {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 25px;
        font-weight: 600;
        line-height: 1.4;
        letter-spacing: 1px;
        margin: 0 0 12px;
    }

    /* NAMA SEKOLAH */

    #carouselExampleFade .carousel-caption h1 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 52px;
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: 1px;
        margin: 0 0 15px;
        text-transform: uppercase;
    }

    /* DESKRIPSI */

    #carouselExampleFade .carousel-caption .carousel-description {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 18px;
        font-weight: 400;
        line-height: 1.7;
        margin: 0;
    }

    /* PANAH KIRI DAN KANAN */

    #carouselExampleFade .carousel-control-prev,
    #carouselExampleFade .carousel-control-next {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 8%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        padding: 0;
        opacity: 0.85;
        z-index: 3;
    }

    #carouselExampleFade .carousel-control-prev {
        left: 0;
    }

    #carouselExampleFade .carousel-control-next {
        right: 0;
    }

    #carouselExampleFade .carousel-control-prev-icon,
    #carouselExampleFade .carousel-control-next-icon {
        width: 38px;
        height: 38px;
        background-size: 65% 65%;
    }

    /* RESPONSIVE HP */

    @media (max-width: 768px) {
        #carouselExampleFade .carousel-item {
            height: 400px;
        }

        #carouselExampleFade .carousel-caption {
            bottom: 28%;
            left: 7%;
            right: 7%;
        }

        #carouselExampleFade .carousel-caption .carousel-welcome {
            font-size: 18px;
            margin-bottom: 8px;
        }

        #carouselExampleFade .carousel-caption h1 {
            font-size: 30px;
            line-height: 1.2;
            margin-bottom: 10px;
        }

        #carouselExampleFade .carousel-caption .carousel-description {
            font-size: 13px;
            line-height: 1.6;
        }

        #carouselExampleFade .carousel-control-prev,
        #carouselExampleFade .carousel-control-next {
            width: 12%;
        }

        #carouselExampleFade .carousel-control-prev-icon,
        #carouselExampleFade .carousel-control-next-icon {
            width: 30px;
            height: 30px;
        }
    }
</style>



<!-- =====================================================
     CAROUSEL
====================================================== -->

<div
    id="carouselExampleFade"
    class="carousel slide carousel-fade"
    data-bs-ride="carousel"
    data-bs-interval="3000">

    <div class="carousel-inner">

        <!-- SLIDE 1 -->
        <div class="carousel-item active">

            <img
                src="{{ asset('img/mandutas.jpg') }}"
                class="d-block w-100"
                alt="{{ $profilSekolah->nama_sekolah }}">

            <div class="carousel-caption">

                <p class="carousel-welcome">
                    Selamat Datang di Website Resmi
                </p>

                <h1>
                    {{ $profilSekolah->nama_sekolah }}
                </h1>

                <p class="carousel-description">
                    Mengenal lebih dekat sekolah yang berilmu,
                    berakhlak, dan berprestasi.
                </p>

            </div>
        </div>

        <!-- SLIDE 2 -->
        <div class="carousel-item">

            <img
                src="{{ asset('img/foto-sekolah1.jpg') }}"
                class="d-block w-100"
                alt="{{ $profilSekolah->nama_sekolah }}">

            <div class="carousel-caption">

                <p class="carousel-welcome">
                    Selamat Datang di Website Resmi
                </p>

                <h1>
                    {{ $profilSekolah->nama_sekolah }}
                </h1>

                <p class="carousel-description">
                    Mengenal lebih dekat sekolah yang berilmu,
                    berakhlak, dan berprestasi.
                </p>

            </div>
        </div>

        <!-- SLIDE 3 -->
        <div class="carousel-item">

            <img
                src="{{ asset('img/foto-man.jpeg') }}"
                class="d-block w-100"
                alt="{{ $profilSekolah->nama_sekolah }}">

            <div class="carousel-caption">

                <p class="carousel-welcome">
                    Selamat Datang di Website Resmi
                </p>

                <h1>
                    {{ $profilSekolah->nama_sekolah }}
                </h1>

                <p class="carousel-description">
                    Mengenal lebih dekat sekolah yang berilmu,
                    berakhlak, dan berprestasi.
                </p>

            </div>
        </div>

    </div>

    <!-- TOMBOL BERIKUTNYA -->
    <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleFade"
        data-bs-slide="next">

        <span
            class="carousel-control-next-icon"
            aria-hidden="true">
        </span>

        <span class="visually-hidden">Next</span>
    </button>

</div>

<button
    class="carousel-control-prev"
    type="button"
    data-bs-target="#carouselExampleFade"
    data-bs-slide="prev">

    <span
        class="carousel-control-prev-icon"
        aria-hidden="true">
    </span>

    <span class="visually-hidden">
        Previous
    </span>

</button>



<!-- =====================================================
         STATISTIK SEKOLAH
    ====================================================== -->

<section class="school-stats">

    <div class="container">

        <div class="school-stats-wrapper">


            <!-- GURU -->

            <div class="school-stat">

                <strong>
                    {{ $guru->count() }}
                </strong>

                <span>
                    Guru & Staf
                </span>

            </div>


            <!-- SISWA -->

            <div class="school-stat">

                <strong>
                    {{ $siswa->count() }}
                </strong>

                <span>
                    Siswa
                </span>

            </div>


            <!-- PRESTASI -->

            <div class="school-stat">

                <strong>
                    {{ $prestasi->count() }}
                </strong>

                <span>
                    Prestasi
                </span>

            </div>


            <!-- EKSTRAKURIKULER -->

            <div class="school-stat">

                <strong>
                    {{ $ekstrakurikuler->count() }}
                </strong>

                <span>
                    Ekstrakurikuler
                </span>

            </div>

        </div>

    </div>

</section>


<!-- =====================================================
     SAMBUTAN KEPALA SEKOLAH
====================================================== -->

<section class="sambutan-section">

    <div class="container">

        <div class="row align-items-center g-5">


            <!-- FOTO -->

            <div class="col-lg-5">

                <div class="sambutan-foto">

                    <img
                        src="{{ asset('img/kepala-sekolah-man1.jpeg') }}"
                        alt="Kepala Sekolah {{ $profilSekolah->nama_sekolah }}">

                </div>

            </div>


            <!-- TEKS -->

            <div class="col-lg-7">

                <div class="sambutan-text">

                    <span class="sambutan-label">
                        Sambutan Kepala Sekolah
                    </span>

                    <h2>
                        Komitmen Kami untuk Pendidikan
                    </h2>

                    <div class="garis-hijau"></div>

                    <p>
                        Puji syukur ke hadirat Tuhan YME atas segala
                        rahmat dan karunia-Nya. Selamat datang di website
                        resmi {{ $profilSekolah->nama_sekolah }}.
                    </p>

                    <p>
                        Website ini kami hadirkan sebagai sarana informasi
                        dan komunikasi antara sekolah dengan orang tua,
                        peserta didik, serta masyarakat luas.
                    </p>

                    <p>
                        Melalui media ini, kami berharap seluruh informasi
                        mengenai kegiatan, prestasi, serta program pendidikan
                        dapat tersampaikan secara transparan, cepat, dan akurat.
                    </p>


                    <div class="kepala-nama">

                        <h4>
                            {{ $profilSekolah->kepala_sekolah }}
                        </h4>

                        <span>
                            Kepala Sekolah {{ $profilSekolah->nama_sekolah }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- =====================================================
         VISI & MISI
    ====================================================== -->

@php

$visiMisi = $profilSekolah->visi_misi ?? '';

$visi = '';
$misi = '';

if (preg_match(
'/VISI\s*:?(.*?)(?=\bMISI\b|$)/is',
$visiMisi,
$matchVisi
)) {

$visi = trim($matchVisi[1]);

}

if (preg_match(
'/MISI\s*:?(.*)$/is',
$visiMisi,
$matchMisi
)) {

$misi = trim($matchMisi[1]);

}

$misiList = preg_split(
'/\r\n|\r|\n/',
$misi
);

$misiList = array_values(
array_filter(
array_map('trim', $misiList)
)
);

@endphp


<section class="visi-misi-section">

    <div class="container">


        <div class="visi-misi-header">

            <span class="visi-misi-label">
                Visi & Misi
            </span>

            <h2>
                Arah dan Tujuan Pendidikan
            </h2>

            <p>
                Menjadi landasan dalam membentuk peserta didik
                yang unggul, berkarakter, dan berakhlak mulia.
            </p>

        </div>


        <div class="row g-4">


            <!-- VISI -->

            <div class="col-lg-5">

                <div class="visi-misi-card">

                    <div class="visi-misi-title">

                        <div class="visi-misi-icon">
                            V
                        </div>

                        <h3>
                            Visi
                        </h3>

                    </div>


                    @if($visi)

                    <p class="visi-text">
                        {{ $visi }}
                    </p>

                    @else

                    <p class="visi-text text-muted">
                        Visi sekolah belum tersedia.
                    </p>

                    @endif

                </div>

            </div>


            <!-- MISI -->

            <div class="col-lg-7">

                <div class="visi-misi-card">

                    <div class="visi-misi-title">

                        <div class="visi-misi-icon">
                            M
                        </div>

                        <h3>
                            Misi
                        </h3>

                    </div>


                    @if(count($misiList))

                    <ul class="misi-list">

                        @foreach($misiList as $index => $misiItem)

                        <li>

                            <span class="misi-number">
                                {{ sprintf('%02d', $index + 1) }}
                            </span>

                            <span>
                                {{ preg_replace('/^\d+[\.\)]\s*/', '', $misiItem) }}
                            </span>

                        </li>

                        @endforeach

                    </ul>

                    @else

                    <p class="visi-text text-muted">
                        Misi sekolah belum tersedia.
                    </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</section>



<!-- =====================================================
         KEUNGGULAN SEKOLAH
    ====================================================== -->

<section class="keunggulan-section">

    <div class="container">


        <div class="keunggulan-header">

            <span class="keunggulan-label">
                Keunggulan Kami
            </span>

            <h2> Mengapa {{ $profilSekolah->nama_sekolah ?? 'sekolah kami' }}? </h2>
            <p> Kami berkomitmen memberikan pendidikan terbaik untuk membentuk generasi yang unggul, berkarakter, dan berakhlak mulia.

            </p>

        </div>


        <div class="row g-4">


            <!-- CARD 1 -->

            <div class="col-md-6 col-lg-3">

                <div class="keunggulan-card">

                    <div class="keunggulan-icon">
                        🎓
                    </div>

                    <h3>
                        Pendidikan Berkualitas
                    </h3>

                    <p>
                        Menyelenggarakan pembelajaran yang bermutu
                        untuk meningkatkan potensi dan kemampuan
                        setiap peserta didik.
                    </p>

                </div>

            </div>


            <!-- CARD 2 -->

            <div class="col-md-6 col-lg-3">

                <div class="keunggulan-card">

                    <div class="keunggulan-icon">
                        🏆
                    </div>

                    <h3>
                        Berprestasi
                    </h3>

                    <p>
                        Mendorong peserta didik untuk meraih
                        prestasi akademik maupun nonakademik
                        di berbagai bidang.
                    </p>

                </div>

            </div>


            <!-- CARD 3 -->

            <div class="col-md-6 col-lg-3">

                <div class="keunggulan-card">

                    <div class="keunggulan-icon">
                        🕌
                    </div>

                    <h3>
                        Religius & Berkarakter
                    </h3>

                    <p>
                        Membentuk generasi yang memiliki iman,
                        akhlak mulia, disiplin, dan karakter
                        yang kuat.
                    </p>

                </div>

            </div>


            <!-- CARD 4 -->

            <div class="col-md-6 col-lg-3">

                <div class="keunggulan-card">

                    <div class="keunggulan-icon">
                        👥
                    </div>

                    <h3>
                        Kegiatan Siswa
                    </h3>

                    <p>
                        Mendukung pengembangan bakat dan minat
                        peserta didik melalui berbagai kegiatan
                        ekstrakurikuler.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =====================================================
     GURU & STAF
====================================================== -->

<section class="guru-section">
    <div class="container">

        <div class="guru-header">
            <span class="label">Guru & Staf</span>

            <h2>
                Guru & Staf {{ $profilSekolah->nama_sekolah ?? '' }}
            </h2>

            <p>
                Kenali tenaga pendidik yang menjadi bagian dari keluarga besar
                {{ $profilSekolah->nama_sekolah ?? 'sekolah kami' }}.
            </p>
        </div>

        @if(isset($guru) && $guru->count() > 0)

        <div class="row g-4">

            @foreach($guru->take(8) as $dataGuru)

            <div class="col-6 col-md-4 col-lg-3">

                <div class="guru-card h-100">

                    <div class="guru-foto">

                        @if($dataGuru->foto)

                        <img
                            src="{{ asset('storage/' . $dataGuru->foto) }}"
                            alt="{{ $dataGuru->nama_guru }}"
                            loading="lazy">

                        @else

                        <div class="d-flex align-items-center justify-content-center h-100">
                            <span class="text-muted">
                                Foto belum tersedia
                            </span>
                        </div>

                        @endif

                    </div>

                    <div class="guru-info">

                        <h3>
                            {{ $dataGuru->nama_guru }}
                        </h3>

                        <p>
                            {{ $dataGuru->mapel ?? 'Guru' }}
                        </p>

                        @if(!empty($dataGuru->id_guru))
                        <a
                            href="{{ route('public.guru.show', ['id' => Crypt::encrypt($dataGuru->id_guru)]) }}"
                            class="btn btn-success btn-sm">
                            Lihat Detail </a>
                        @endif

                    </div>

                </div>

            </div>

            @endforeach

        </div>

        <div class="ekstrakurikuler-more">
            <a href="{{ route('public.guru') }}" class="btn">
                Lihat Semua Guru <span>→</span>
            </a>
        </div>

        @else

        <div class="guru-kosong">
            <div class="icon">👨‍🏫</div>

            <h3>Data Guru Belum Tersedia</h3>

            <p>Data guru dan staf belum ditambahkan.</p>
        </div>

        @endif

    </div>
</section>


<!-- =====================================================
         BERITA
    ====================================================== -->

<section id="berita" class="berita-section">

    <div class="container">


        <div class="berita-header">

            <span class="label">
                Informasi Sekolah
            </span>

            <h2> Berita {{ $profilSekolah->nama_sekolah ?? '' }} </h2>
            <p> Informasi dan berita terbaru seputar kegiatan {{ $profilSekolah->nama_sekolah ?? 'sekolah' }}. </p>

        </div>


        @if($beritas->count())

        <div class="row g-4">

            @foreach($beritas as $berita)

            <div class="col-md-6 col-lg-4">

                <div class="berita-card">

                    <div class="berita-foto">

                        @if($berita->gambar)

                        <img
                            src="{{ asset('storage/' . $berita->gambar) }}"
                            alt="{{ $berita->judul }}">

                        @else

                        <div class="berita-no-foto">
                            Tidak ada foto
                        </div>

                        @endif

                    </div>


                    <div class="berita-info">

                        <div class="berita-tanggal">

                            {{ $berita->tanggal
                                            ? \Carbon\Carbon::parse($berita->tanggal)->format('d M Y')
                                            : '-' }}

                        </div>


                        <h3>
                            {{ $berita->judul }}
                        </h3>


                        <p>

                            {{ \Illuminate\Support\Str::limit(
                                            strip_tags($berita->isi ?? ''),
                                            120
                                        ) }}

                        </p>

                        @if(!empty($berita->slug))
                        <a
                            href="{{ route('public.berita.show', ['slug' => $berita->slug]) }}"
                            class="btn btn-success btn-sm">
                            Baca Selengkapnya
                        </a>
                        @endif


                    </div>

                </div>

            </div>

            @endforeach

        </div>
        <div class="berita-more">
            <a href="{{ route('public.berita') }}" class="btn">
                Lihat Semua Berita <span>→</span>
            </a>
        </div>
        @else

        <div class="berita-kosong">

            <div class="icon">
                📰
            </div>

            <h3>
                Belum Ada Berita
            </h3>

            <p>
                Berita sekolah belum tersedia.
            </p>

        </div>

        @endif

    </div>

</section>

{{-- ================= PRESTASI ================= --}}
<section class="prestasi-section">
    <div class="container">

        {{-- HEADER --}}
        <div class="prestasi-header">
            <span class="label">PRESTASI SEKOLAH</span>
            <h2>Prestasi Membanggakan</h2>
            <p>
                Berbagai pencapaian dan prestasi yang diraih
                oleh peserta didik MAN 2 Tasikmalaya.
            </p>
        </div>

        {{-- DAFTAR PRESTASI --}}
        <div class="row g-4">

            @forelse ($prestasi->take(3) as $item)
            <div class="col-lg-4 col-md-6">

                <div class="prestasi-card">

                    {{-- FOTO --}}
                    <div class="prestasi-foto">
                        @if ($item->gambar)
                        <img
                            src="{{ asset('storage/' . $item->gambar) }}"
                            alt="{{ $item->nama_prestasi }}"
                            loading="lazy">
                        @else
                        <div class="prestasi-no-foto">
                            <i class="bi bi-trophy"></i>
                            <span>Foto belum tersedia</span>
                        </div>
                        @endif
                    </div>

                    {{-- INFORMASI PRESTASI --}}
                    <div class="prestasi-info">

                        @if ($item->tanggal)
                        <div class="prestasi-tanggal">
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </div>
                        @endif

                        <h3>{{ $item->nama_prestasi }}</h3>

                        <p>
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 100) }}
                        </p>

                        {{-- TOMBOL DETAIL --}}
                        <a
                            href="{{ route('public.prestasi.show', [
        'id' => \Illuminate\Support\Facades\Crypt::encrypt($item->id_prestasi)
    ]) }}"
                            class="btn-detail-prestasi">
                            Lihat Selengkapnya
                        </a>

                    </div>

                </div>

            </div>
            @empty
            <div class="col-12">
                <div class="prestasi-kosong">
                    <div class="icon">
                        <i class="bi bi-trophy"></i>
                    </div>

                    <h3>Belum Ada Prestasi</h3>

                    <p>
                        Data prestasi sekolah akan ditampilkan di sini.
                    </p>
                </div>
            </div>
            @endforelse

        </div>

        {{-- TOMBOL SEMUA PRESTASI --}}
        @if ($prestasi->count() > 0)
        <div class="prestasi-more">
            <a href="{{ route('public.prestasi') }}" class="btn">
                Lihat Semua Prestasi
                <span>&rarr;</span>
            </a>
        </div>
        @endif

    </div>
</section>

{{-- =====================================================
     PENGUMUMAN
====================================================== --}}

<section id="pengumuman" class="pengumuman-section">

    <div class="container">

        <div class="pengumuman-header">

            <span class="label">
                Informasi Sekolah
            </span>

            <h2>
                Pengumuman {{ $profilSekolah->nama_sekolah ?? '' }}
            </h2>

            <p>
                Informasi penting dan pemberitahuan terbaru seputar kegiatan
                {{ $profilSekolah->nama_sekolah ?? 'sekolah' }}.
            </p>

        </div>

        @if(isset($pengumumans) && $pengumumans->count())

        <div class="row g-4">

            @foreach($pengumumans as $pengumuman)

            <div class="col-md-6 col-lg-4">

                <div class="pengumuman-card">

                    {{-- IKON PENGUMUMAN --}}
                    <div class="pengumuman-foto">

                        <div class="pengumuman-icon">
                            <i class="bi bi-megaphone-fill"></i>
                        </div>

                    </div>

                    {{-- INFORMASI PENGUMUMAN --}}
                    <div class="pengumuman-info">

                        <div class="pengumuman-tanggal">

                            {{ $pengumuman->tanggal
                                ? \Carbon\Carbon::parse($pengumuman->tanggal)->format('d M Y')
                                : '-' }}

                        </div>

                        <h3>
                            {{ $pengumuman->judul }}
                        </h3>

                        <p>
                            {{ \Illuminate\Support\Str::limit(
                                strip_tags($pengumuman->isi ?? ''),
                                120
                            ) }}
                        </p>

                        <a
                            href="{{ route('public.pengumuman.show', [
                                'id' => \Illuminate\Support\Facades\Crypt::encrypt($pengumuman->id_pengumuman)
                            ]) }}"
                            class="btn btn-success btn-sm">

                            Baca Selengkapnya

                        </a>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

        <div class="pengumuman-more">

            <a href="{{ route('public.pengumuman') }}" class="btn">
                Lihat Semua Pengumuman <span>→</span>
            </a>

        </div>

        @else

        <div class="pengumuman-kosong">

            <div class="icon">
                <i class="bi bi-megaphone"></i>
            </div>

            <h3>
                Belum Ada Pengumuman
            </h3>

            <p>
                Pengumuman sekolah belum tersedia.
            </p>

        </div>

        @endif

    </div>

</section>

<!-- =====================================================
         EKSTRAKURIKULER
    ====================================================== -->

<section class="eskul-section">

    <div class="container">


        <div class="eskul-header">

            <span class="label">
                Aktivitas Siswa
            </span>

            <h2>
                Ekstrakurikuler
            </h2>

            <p>
                Berbagai kegiatan ekstrakurikuler untuk mengembangkan
                bakat, minat, dan potensi peserta didik.
            </p>

        </div>


        @if(isset($ekstrakurikuler) && $ekstrakurikuler->count())

        <div class="row g-4">

            @foreach($ekstrakurikuler as $eskul)

            <div class="col-md-6 col-lg-4">

                <div class="eskul-card">

                    <div class="eskul-foto">

                        @if($eskul->gambar)

                        <img
                            src="{{ asset('storage/' . $eskul->gambar) }}"
                            alt="{{ $eskul->nama_eskul }}">

                        @else

                        <div class="eskul-no-foto">
                            Tidak ada gambar
                        </div>

                        @endif

                    </div>


                    <div class="eskul-info">

                        <h3>
                            {{ $eskul->nama_eskul }}
                        </h3>

                        <p>
                            Pembina: {{ $eskul->pembina }}
                        </p>

                        <escape>@if(!empty($eskul->slug))
                            <a
                                href="{{ route('public.ekstrakurikuler.show', ['slug' => $eskul->slug]) }}"
                                class="btn btn-success btn-sm">
                                Lihat Detail
                            </a>
                            @endif
                        </escape>

                    </div>

                </div>

            </div>

            @endforeach

        </div>
        <div class="ekstrakurikuler-more">
            <a href="{{ route('public.ekstrakurikuler') }}" class="btn">
                Lihat Semua Ekstrakurikuler <span>→</span>
            </a>
        </div>
        @else

        <div class="eskul-kosong">

            <h3>
                Belum Ada Ekstrakurikuler
            </h3>

            <p>
                Data ekstrakurikuler belum tersedia.
            </p>

        </div>

        @endif

    </div>

</section>

<!-- =====================================================
     GALERI
====================================================== -->

<section class="galeri-section">

    <div class="container">

        {{-- HEADER --}}

        <div class="galeri-header">

            <span class="label">
                Dokumentasi
            </span>

            <h2>
                Galeri {{ $profilSekolah->nama_sekolah ?? '' }}
            </h2>

            <p>
                Dokumentasi kegiatan, aktivitas, dan berbagai momen
                berkesan di {{ $profilSekolah->nama_sekolah ?? 'sekolah' }}.
            </p>

        </div>

        {{-- DATA GALERI --}}

        @if(isset($galeri) && $galeri->count())

        <div class="row g-4">

            @foreach($galeri as $album)

            @php
            $mediaSampul = $album->media->first();

            $idAlbum = \Illuminate\Support\Facades\Crypt::encrypt(
            $album->id_album
            );

            $urlVideo = $mediaSampul && $mediaSampul->kategori === 'video'
            ? $mediaSampul->file
            : '';

            $videoId = null;

            if ($urlVideo && preg_match(
            '~(?:youtube\.com/watch\?v=|youtu\.be/|youtube\.com/embed/|youtube\.com/shorts/)([a-zA-Z0-9_-]{11})~',
            $urlVideo,
            $cocok
            )) {
            $videoId = $cocok[1];
            }
            @endphp

            <div class="col-12 col-md-6 col-lg-4">

                <a
                    href="{{ route('public.galeri.show', ['id' => $idAlbum]) }}"
                    class="galeri-link">

                    <div class="galeri-card">

                        {{-- GAMBAR SAMPUL --}}

                        <div class="galeri-foto">

                            @if($mediaSampul && $mediaSampul->kategori === 'foto')

                            <img
                                src="{{ asset('storage/' . $mediaSampul->file) }}"
                                alt="{{ $album->judul }}"
                                loading="lazy">

                            @elseif($videoId)

                            <img
                                src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                alt="{{ $album->judul }}"
                                loading="lazy">

                            @elseif(
                            $mediaSampul &&
                            $mediaSampul->kategori === 'video' &&
                            \Illuminate\Support\Str::startsWith(
                            $mediaSampul->file,
                            ['http://', 'https://']
                            )
                            )

                            <div class="galeri-no-foto">

                                <span>🎬</span>

                                <small>
                                    Album berisi video
                                </small>

                            </div>

                            @elseif($mediaSampul && $mediaSampul->kategori === 'video')

                            <video preload="metadata" muted>
                                <source src="{{ asset('storage/' . $mediaSampul->file) }}">
                            </video>

                            @else

                            <div class="galeri-no-foto">

                                <span>🖼️</span>

                                <small>
                                    Belum ada media
                                </small>

                            </div>

                            @endif

                        </div>

                        {{-- INFORMASI ALBUM --}}

                        <div class="galeri-overlay">

                            <div class="galeri-info">

                                <h3>
                                    {{ $album->judul }}
                                </h3>

                                @if($album->tanggal)

                                <small>
                                    {{ \Carbon\Carbon::parse($album->tanggal)->translatedFormat('d M Y') }}
                                </small>

                                @endif

                                {{-- TOMBOL LIHAT GALERI --}}

                                <div class="mt-3">

                                    <span class="btn btn-success btn-sm">
                                        Lihat Galeri
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

            @endforeach

        </div>

        {{-- TOMBOL LIHAT SEMUA GALERI --}}

        <div class="galeri-more">

            <a
                href="{{ route('public.galeri') }}"
                class="btn">

                Lihat Semua Galeri <span>→</span>

            </a>

        </div>

        @else

        {{-- KONDISI GALERI KOSONG --}}

        <div class="galeri-kosong">

            <div class="icon">
                🖼️
            </div>

            <h3>
                Belum Ada Galeri
            </h3>

            <p>
                Dokumentasi kegiatan sekolah belum tersedia.
            </p>

        </div>

        @endif

    </div>

</section>

@endsection