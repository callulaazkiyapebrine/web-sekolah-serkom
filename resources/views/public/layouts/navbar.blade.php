@php
$profilSekolah = \App\Models\ProfilSekolah::first();
@endphp

<style>
    /* =====================================================
       NAVBAR
    ===================================================== */

    .navbar {
        background: #ffffff;
        min-height: 70px;
        padding: 6px 35px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
        position: relative;
        z-index: 1000;
    }


    /* =====================================================
       LOGO + NAMA SEKOLAH
    ===================================================== */

    .navbar-brand {
        padding: 0;
        margin-right: 100px;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .navbar-brand img {
        height: 38px;
        width: 38px;
        object-fit: contain;
    }

    .navbar-school-name {
        color: #00552f;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 18px !important;
        font-weight: 650;
        line-height: 1.2;
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }


    /* =====================================================
       MENU
    ===================================================== */

    .navbar-nav {
        align-items: center;
        gap: 2px;
    }

    .navbar-nav .nav-link {
        position: relative;
        color: #374151;
        font-size: 16px;
        font-weight: 500;
        padding: 10px 13px !important;
        transition: all .25s ease;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        color: #006b3c;
    }

    .navbar-nav .nav-link.active {
        font-weight: 600;
    }

    .navbar-nav .nav-link.active::after {
        content: "";
        position: absolute;
        left: 13px;
        right: 13px;
        bottom: 1px;
        height: 2px;
        background: #006b3c;
        border-radius: 20px;
    }


    /* =====================================================
       DROPDOWN
    ===================================================== */

    .navbar .dropdown-menu {
        border: none;
        border-radius: 10px;
        padding: 8px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .10);
    }

    .navbar .dropdown-item {
        padding: 9px 12px;
        border-radius: 7px;
        font-size: 14px;
    }

    .navbar .dropdown-item:hover {
        background: #f0f8f4;
        color: #198754;
    }


    /* =====================================================
       MOBILE
    ===================================================== */

    @media (max-width: 991px) {

        .navbar {
            min-height: 64px;
            padding: 6px 20px;
        }

        .navbar-brand {
            margin-right: 0;
        }

        .navbar-brand img {
            height: 32px;
            width: 32px;
        }

        .navbar-school-name {
            font-size: 15px !important;
            max-width: 230px;
        }

        .navbar-nav {
            align-items: flex-start;
            margin-top: 8px;
        }

        .navbar-nav .nav-link {
            width: 100%;
            padding: 9px 5px !important;
        }

        .navbar-nav .nav-link.active::after {
            left: 5px;
            right: auto;
            width: 35px;
        }

    }
</style>


<nav class="navbar navbar-expand-lg">

    <div class="container-fluid">


        {{-- =================================================
            LOGO + NAMA SEKOLAH
        ================================================== --}}

        <a
            class="navbar-brand"
            href="{{ route('public.dashboard') }}">

            @if($profilSekolah && $profilSekolah->logo)

            <img
                src="{{ asset('storage/' . $profilSekolah->logo) }}"
                alt="{{ $profilSekolah->nama_sekolah }}">

            @endif

            <span class="navbar-school-name">
                {{ $profilSekolah->nama_sekolah ?? 'MAN 2 Tasikmalaya' }}
            </span>

        </a>


        {{-- =================================================
            TOGGLE MOBILE
        ================================================== --}}

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">

            <span class="navbar-toggler-icon"></span>

        </button>


        <div
            class="collapse navbar-collapse"
            id="navbarSupportedContent">


            @php

            $tentangActive = request()->routeIs(
            'public.profil',
            'public.guru'
            );

            $aktivitasActive = request()->routeIs(
            'public.ekstrakurikuler',
            'public.galeri'
            );

            @endphp


            <ul class="navbar-nav mb-2 mb-lg-0">


                {{-- =================================================
                    BERANDA
                ================================================== --}}

                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('public.dashboard') ? 'active' : '' }}"
                        href="{{ route('public.dashboard') }}">

                        Beranda

                    </a>

                </li>


                {{-- =================================================
                    TENTANG
                ================================================== --}}

                <li class="nav-item dropdown">

                    <a
                        class="nav-link dropdown-toggle {{ $tentangActive ? 'active' : '' }}"
                        href="#"
                        data-bs-toggle="dropdown">

                        Tentang

                    </a>


                    <ul class="dropdown-menu">

                        <li>

                            <a
                                class="dropdown-item"
                                href="{{ route('public.profil') }}">

                                Profil Sekolah

                            </a>

                        </li>


                        <li>

                            <a
                                class="dropdown-item"
                                href="{{ route('public.guru') }}">

                                Guru

                            </a>

                        </li>

                    </ul>

                </li>


                {{-- =================================================
                    BERITA
                ================================================== --}}

                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('public.berita') ? 'active' : '' }}"
                        href="{{ route('public.berita') }}">

                        Berita

                    </a>

                </li>


                {{-- =================================================
                    PENGUMUMAN
                ================================================== --}}

                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('public.pengumuman', 'public.pengumuman.show') ? 'active' : '' }}"
                        href="{{ route('public.pengumuman') }}">

                        Pengumuman

                    </a>

                </li>


                {{-- =================================================
                    PRESTASI
                ================================================== --}}

                <li class="nav-item">

                    <a
                        class="nav-link {{ request()->routeIs('public.prestasi') ? 'active' : '' }}"
                        href="{{ route('public.prestasi') }}">

                        Prestasi

                    </a>

                </li>


                {{-- =================================================
                    AKTIVITAS
                ================================================== --}}

                <li class="nav-item dropdown">

                    <a
                        class="nav-link dropdown-toggle {{ $aktivitasActive ? 'active' : '' }}"
                        href="#"
                        data-bs-toggle="dropdown">

                        Aktivitas

                    </a>


                    <ul class="dropdown-menu">

                        <li>

                            <a
                                class="dropdown-item"
                                href="{{ route('public.ekstrakurikuler') }}">

                                Ekstrakurikuler

                            </a>

                        </li>


                        <li>

                            <a
                                class="dropdown-item"
                                href="{{ route('public.galeri') }}">

                                Galeri

                            </a>

                        </li>

                    </ul>

                </li>

            </ul>


        </div>

    </div>

</nav>