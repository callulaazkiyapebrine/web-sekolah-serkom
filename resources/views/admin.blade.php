<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description"
        content="Admin Dashboard SMK YPC Tasikmalaya">

    <title>
        @yield('title', 'Dashboard Admin - SMK YPC Tasikmalaya')
    </title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .sidebar,
        .sidebar-content {
            background: linear-gradient(135deg,
                    #198754,
                    #0b5d3b) !important;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            min-height: 60px;
            padding: 15px 20px !important;
            overflow: hidden;
        }

        .sidebar-brand .d-flex {
            width: 100%;
            min-width: 0;
            align-items: center !important;
        }

        .sidebar-brand img {
            width: 40px !important;
            height: 40px !important;
            flex-shrink: 0;
        }

        .sidebar-brand span {
            display: block;
            min-width: 0;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;

            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 600;
            line-height: 1.2;
            letter-spacing: 0.2px;
            color: #fff;

            text-align: left;
        }

        .sidebar-header {
            color: rgba(255, 255, 255, 0.75) !important;
        }

        .sidebar-link {
            display: flex !important;
            align-items: center !important;
        }

        .sidebar-link span {
            line-height: 1.2;
        }

        .sidebar-link i {
            flex-shrink: 0;
        }


        /* Hilangkan garis biru saat menu sidebar diklik */
        .sidebar .sidebar-link:focus,
        .sidebar .sidebar-link:active,
        .sidebar .sidebar-item:focus,
        .sidebar .sidebar-item:active {
            outline: none !important;
            box-shadow: none !important;
        }

        /* Hilangkan garis biru pada menu aktif */
        .sidebar .sidebar-item.active>.sidebar-link {
            box-shadow: none !important;
            outline: none !important;
            border-color: transparent !important;
        }



        /* Hover */
        .sidebar-item:not(.active) .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.12) !important;
            color: #fff !important;
        }

        /* Active */
        .sidebar-item.active>.sidebar-link {
            background: rgba(255, 255, 255, 0.18) !important;
            color: #fff !important;
            border-left: 4px solid #fff;
        }

        .sidebar-item.active>.sidebar-link i {
            color: #fff !important;
        }

        .sidebar-brand-text {
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.3px;
            color: #ffffff;
            line-height: 1.2;
        }

        /* Hilangkan warna biru pada dropdown */
        .dropdown-menu .dropdown-item:hover,
        .dropdown-menu .dropdown-item:focus,
        .dropdown-menu .dropdown-item:active {
            background-color: #f1f3f5 !important;
            color: #212529 !important;
            box-shadow: none !important;
        }

        /* My Profile saat diklik */
        .dropdown-menu .dropdown-item:not(.text-danger):active {
            background-color: #f1f3f5 !important;
            color: #212529 !important;
        }

        /* Logout tetap merah */
        .dropdown-menu .dropdown-item.text-danger:active {
            background-color: #f1f3f5 !important;
            color: #dc3545 !important;
        }

        /* ================= DATATABLES ================= */

        .dataTables_wrapper {
            width: 100%;
            margin-top: 10px;
        }

        /* Search + jumlah data */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 15px;
        }

        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label {
            color: #555;
            font-size: 14px;
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 14px;
            outline: none;
        }

        .dataTables_wrapper .dataTables_filter input {
            margin-left: 6px;
        }

        .dataTables_wrapper .dataTables_length select:focus,
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #198754;
            box-shadow: 0 0 0 2px rgba(25, 135, 84, 0.1);
        }


        /* ================= TABLE ================= */

        .table {
            width: 100% !important;
            margin-bottom: 0 !important;
            vertical-align: middle;
        }

        .table thead th {
            background: #198754 !important;
            color: #fff !important;

            border: none !important;

            padding: 12px 14px !important;

            font-size: 13px;
            font-weight: 600;

            white-space: nowrap;
        }

        .table tbody td {
            padding: 11px 14px !important;

            font-size: 13px;

            color: #444;

            vertical-align: middle;

            border-bottom: 1px solid #eeeeee;
        }

        .table tbody tr:hover {
            background: #f5faf7;
        }


        /* ================= NOMOR ================= */

        .table tbody td:first-child {
            font-weight: 600;
            color: #555;
        }


        /* ================= FOTO DALAM TABLE ================= */

        .table img {
            max-width: 55px;
            max-height: 55px;

            object-fit: cover;

            border-radius: 6px;
        }


        /* ================= TOMBOL AKSI ================= */

        .table .btn {
            font-size: 12px;
            padding: 5px 9px;

            border-radius: 5px;
        }

        .table .btn i {
            font-size: 13px;
        }


        /* ================= FOOT DATATABLE ================= */

        .dataTables_wrapper .dataTables_info {
            color: #777;
            font-size: 13px;

            padding-top: 15px;
        }

        .dataTables_wrapper .dataTables_paginate {
            padding-top: 10px;
        }


        /* ================= PAGINATION ================= */

        .dataTables_wrapper .pagination {
            margin: 0;
            gap: 3px;
        }

        .dataTables_wrapper .page-link {
            color: #198754;

            border: 1px solid #dee2e6;

            border-radius: 5px !important;

            font-size: 13px;

            padding: 6px 10px;
        }

        .dataTables_wrapper .page-link:hover {
            color: #fff;
            background: #198754;
            border-color: #198754;
        }

        .dataTables_wrapper .page-item.active .page-link {
            background: #198754;
            border-color: #198754;
            color: #fff;
        }


        /* ================= WRAPPER TABLE ================= */

        .table-responsive {
            border-radius: 8px;
            overflow-x: auto;
        }

        /* FOOTER */
        .footer p {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 700;
            color: #748178;
        }

        .footer strong {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #748178;
        }




        /* ================= MOBILE ================= */

        @media (max-width: 768px) {

            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                width: 100%;
                text-align: left !important;
                margin-bottom: 10px;
            }

            .dataTables_wrapper .dataTables_filter input {
                width: 100%;
                margin: 5px 0 0;
            }

            .table thead th,
            .table tbody td {
                padding: 9px 10px !important;
                font-size: 12px;
            }

            .dataTables_wrapper .dataTables_info {
                margin-bottom: 10px;
            }

            .dataTables_wrapper .dataTables_paginate {
                text-align: left !important;
            }

        }
    </style>
</head>

<body>

    <div class="wrapper">

        {{-- ================= SIDEBAR ================= --}}
        <nav id="sidebar" class="sidebar js-sidebar">

            <div class="sidebar-content js-simplebar">

                <a class="sidebar-brand"
                    href="{{ route('admin.dashboard') }}">

                    <div class="d-flex align-items-center gap-2">

                        @if($profilSekolah && $profilSekolah->logo)

                        <img src="{{ asset('storage/' . $profilSekolah->logo) }}"
                            alt="Logo">

                        @endif

                        <span>
                            {{ $profilSekolah->nama_sekolah ?? 'MAN 2 Tasikmalaya' }}
                        </span>

                    </div>

                </a>



                <ul class="sidebar-nav">

                    {{-- MENU UTAMA --}}
                    <li class="sidebar-header">
                        MENU UTAMA
                    </li>

                    {{-- DASHBOARD --}}
                    <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                            <i class="align-middle" data-feather="sliders"></i>
                            <span class="align-middle">Dashboard</span>
                        </a>
                    </li>


                    {{-- DATA SEKOLAH --}}
                    <li class="sidebar-header">
                        DATA SEKOLAH
                    </li>

                    {{-- PROFIL SEKOLAH --}}
                    <li class="sidebar-item {{ request()->routeIs('admin.profil.index') || request()->routeIs('admin.profil-sekolah*') || request()->routeIs('admin.profil.edit') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.profil.index') }}">
                            <i class="align-middle" data-feather="home"></i>
                            <span class="align-middle">Profil Sekolah</span>
                        </a>
                    </li>

                    {{-- GURU --}}
                    <li class="sidebar-item {{ request()->routeIs('admin.guru.*') || request()->routeIs('guru.show') || request()->routeIs('guru.destroy') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.guru.index') }}">
                            <i class="align-middle" data-feather="users"></i>
                            <span class="align-middle">Guru</span>
                        </a>
                    </li>

                    {{-- SISWA --}}
                    <li class="sidebar-item {{ request()->routeIs('admin.siswa.*') || request()->routeIs('siswa.show') || request()->routeIs('siswa.destroy') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.siswa.index') }}">
                            <i class="align-middle" data-feather="user-plus"></i>
                            <span class="align-middle">Siswa</span>
                        </a>
                    </li>


                    {{-- INFORMASI SEKOLAH --}}
                    <li class="sidebar-header">
                        INFORMASI SEKOLAH
                    </li>

                    {{-- BERITA --}}
                    <li class="sidebar-item {{ request()->routeIs('admin.berita.*') || request()->routeIs('berita.show') || request()->routeIs('berita.destroy') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.berita.index') }}">
                            <i class="align-middle" data-feather="book-open"></i>
                            <span class="align-middle">Berita</span>
                        </a>
                    </li>

                    {{-- PENGUMUMAN --}}
                    <li class="sidebar-item {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}"> <a class="sidebar-link" href="{{ route('admin.pengumuman.index') }}"> <i class="align-middle" data-feather="bell"></i> <span class="align-middle">Pengumuman</span> </a> </li>

                    {{-- EKSTRAKURIKULER --}}
                    <li class="sidebar-item {{ request()->routeIs('admin.ekstrakurikuler.*') || request()->routeIs('ekstrakurikuler.show') || request()->routeIs('ekstrakurikuler.destroy') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.ekstrakurikuler.index') }}">
                            <i class="align-middle" data-feather="grid"></i>
                            <span class="align-middle">Ekstrakurikuler</span>
                        </a>
                    </li>

                    {{-- PRESTASI --}}
                    <li class="sidebar-item {{ request()->routeIs('admin.prestasi.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.prestasi.index') }}">
                            <i class="align-middle" data-feather="award"></i>
                            <span class="align-middle">Prestasi</span>
                        </a>
                    </li>

                    {{-- GALERI --}}
                    <li class="sidebar-item {{ request()->routeIs('admin.galeri.*') || request()->routeIs('galeri.show') || request()->routeIs('galeri.destroy') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.galeri.index') }}">
                            <i class="align-middle" data-feather="image"></i>
                            <span class="align-middle">Galeri</span>
                        </a>
                    </li>


                    {{-- MANAJEMEN AKUN --}}
                    <li class="sidebar-header">
                        MANAJEMEN AKUN
                    </li>

                    {{-- USER --}}
                    <li class="sidebar-item {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.user.index') }}">
                            <i class="align-middle" data-feather="user-check"></i>
                            <span class="align-middle">User</span>
                        </a>
                    </li>

                </ul>

                <div class="sidebar-cta">



                </div>

            </div>

        </nav>


        {{-- ================= MAIN ================= --}}
        <div class="main">


            {{-- ================= NAVBAR ================= --}}
            <nav class="navbar navbar-expand navbar-light navbar-bg">

                <a class="sidebar-toggle js-sidebar-toggle">

                    <i class="hamburger align-self-center"></i>

                </a>


                <div class="navbar-collapse collapse">

                    <ul class="navbar-nav navbar-align">

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle"
                                href="#"
                                data-bs-toggle="dropdown">

                                <span class="text-dark">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>

                            </a>


                            <div class="dropdown-menu dropdown-menu-end">

                                <a class="dropdown-item"
                                    href="{{ route('admin.profil.index') }}">
                                    <i data-feather="user" class="me-2"></i>
                                    My Profile
                                </a>

                                <div class="dropdown-divider"></div>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf

                                    <button type="submit" class="dropdown-item text-danger">
                                        <i data-feather="log-out" class="me-2"></i>
                                        Logout
                                    </button>
                                </form>

                            </div>


                        </li>

                    </ul>

                </div>

            </nav>


            {{-- ================= CONTENT ================= --}}
            <main class="content">

                @yield('content')

            </main>


            {{-- ================= FOOTER ================= --}}
            <footer class="footer">

                <div class="container-fluid">

                    <div class="row text-muted">

                        <div class="col-6 text-start">

                            <p class="mb-0">

                                <strong>
                                    MAN 2 TASIKMALAYA
                                </strong>

                            </p>

                        </div>


                        <div class="col-6 text-end">

                            <p class="mb-0">
                                Sistem Informasi Sekolah
                            </p>

                        </div>

                    </div>

                </div>

            </footer>

        </div>

    </div>

    <script src="{{ asset('js/jquery-4.0.0.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('DataTables/js/dataTables.bootstrap5.min.js') }}"></script>


    @stack('scripts')
    @yield('scripts')

</body>

</html>