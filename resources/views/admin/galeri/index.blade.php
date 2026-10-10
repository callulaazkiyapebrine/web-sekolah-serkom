@extends('admin')

@section('title', 'Kelola Album Galeri - MAN 2 Tasikmalaya')

@section('content')

<style>
    .galeri-page {
        padding-top: 5px !important;
        color: #1f2937;
    }

    .galeri-header {
        gap: 16px;
    }

    .galeri-header h4 {
        color: #0b5d3b;
        font-size: 26px;
        font-weight: 700;
    }

    .galeri-header p {
        color: #64746a !important;
        font-size: 14px;
        line-height: 1.6;
    }

    .btn-galeri {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 10px 15px;
        background: #198754;
        color: #fff;
        border: 1px solid #198754;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        text-decoration: none;
        transition: .2s;
    }

    .btn-galeri:hover {
        background: #0b5d3b;
        border-color: #0b5d3b;
        color: #fff;
    }

    .galeri-alert {
        display: flex;
        align-items: center;
        gap: 8px;
        border-radius: 9px;
        font-size: 13px;
        padding: 12px 15px;
    }

    .galeri-card {
        width: 100%;
        border: 1px solid #dce9df;
        border-radius: 13px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 5px 20px rgba(11, 93, 59, .05);
    }

    .galeri-card-header {
        padding: 18px 20px;
        background: #fff;
        border-bottom: 1px solid #e5eee8;
    }

    .galeri-card-header h5 {
        color: #0b5d3b;
        font-size: 16px;
        font-weight: 700;
    }

    .galeri-card-header span {
        display: block;
        margin-top: 5px;
        color: #7a887f;
        font-size: 12px;
    }

    .galeri-card .card-body {
        padding: 20px;
    }

    /* KONTROL TABEL DI LUAR AREA SCROLL */
    .galeri-table-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 17px;
    }

    .galeri-length,
    .galeri-search {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #64746a;
        font-size: 13px;
    }

    .galeri-length select {
        height: 36px;
        padding: 5px 28px 5px 10px;
        border: 1px solid #d5e2d9;
        border-radius: 7px;
        background-color: #fff;
        color: #49574e;
        outline: none;
    }

    .galeri-search input {
        width: 230px;
        max-width: 100%;
        height: 36px;
        padding: 7px 11px;
        border: 1px solid #d5e2d9;
        border-radius: 7px;
        outline: none;
        font-size: 13px;
        box-sizing: border-box;
    }

    .galeri-search input:focus,
    .galeri-length select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, .10);
    }

    /* AREA SCROLL TABEL */
    .galeri-table-wrap {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #e5eee8;
        border-radius: 8px;
    }

    #dataGaleri {
        width: 100% !important;
        min-width: 1050px;
        margin: 0 !important;
        border-collapse: collapse !important;
        table-layout: fixed;
    }

    #dataGaleri thead th {
        padding: 13px 10px !important;
        background: #198754 !important;
        color: #fff !important;
        border: none !important;
        font-size: 12px;
        font-weight: 600;
        text-align: center;
        vertical-align: middle;
        white-space: normal;
        overflow-wrap: break-word;
    }

    #dataGaleri tbody td {
        padding: 13px 10px !important;
        color: #49574e;
        font-size: 13px;
        line-height: 1.6;
        vertical-align: middle;
        border-bottom: 1px solid #edf2ee !important;
        overflow-wrap: anywhere;
        word-break: normal;
    }

    #dataGaleri tbody tr:hover td {
        background: #f5faf7 !important;
    }

    #dataGaleri tbody tr:last-child td {
        border-bottom: none !important;
    }

    /* PROPORSI KOLOM */
    #dataGaleri th:nth-child(1),
    #dataGaleri td:nth-child(1) {
        width: 55px;
        text-align: center;
    }

    #dataGaleri th:nth-child(2),
    #dataGaleri td:nth-child(2) {
        width: 175px;
    }

    #dataGaleri th:nth-child(3),
    #dataGaleri td:nth-child(3) {
        width: 245px;
    }

    #dataGaleri th:nth-child(4),
    #dataGaleri td:nth-child(4) {
        width: 140px;
        text-align: center;
    }

    #dataGaleri th:nth-child(5),
    #dataGaleri td:nth-child(5) {
        width: 135px;
        text-align: center;
    }

    #dataGaleri th:nth-child(6),
    #dataGaleri td:nth-child(6),
    #dataGaleri th:nth-child(7),
    #dataGaleri td:nth-child(7) {
        width: 85px;
        text-align: center;
    }

    #dataGaleri th:nth-child(8),
    #dataGaleri td:nth-child(8) {
        width: 130px;
        text-align: center;
    }

    .judul-galeri {
        color: #244b35 !important;
        font-weight: 600;
    }

    .keterangan-galeri {
        color: #64746a !important;
    }

    /* BADGE KATEGORI */
    .badge-kategori {
        display: inline-block;
        max-width: 100%;
        padding: 5px 8px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        line-height: 1.5;
        text-align: center;
        white-space: normal;
    }

    .kategori-foto {
        color: #166b3b;
        background: #e8f6ee;
    }

    .kategori-video {
        color: #4559a5;
        background: #eef2ff;
    }

    .kategori-campuran {
        color: #805515;
        background: #fff4d6;
    }

    .kategori-kosong {
        color: #64746a;
        background: #f0f2f1;
    }

    /* JUMLAH MEDIA */
    .badge-jumlah {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        min-width: 38px;
        padding: 5px 7px;
        border-radius: 6px;
        background: #e8f6ee;
        color: #166b3b;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-video {
        background: #eef2ff;
        color: #4559a5;
    }

    .badge-jumlah svg {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
    }

    /* TOMBOL AKSI */
    #dataGaleri .aksi-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
        flex-wrap: nowrap;
    }

    #dataGaleri .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 32px;
        width: 32px;
        height: 32px;
        padding: 0;
        border: 1px solid #dce9df;
        border-radius: 7px;
        background: #fff;
        color: #64746a;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
    }

    #dataGaleri .action-btn svg {
        width: 15px;
        height: 15px;
    }

    #dataGaleri .action-btn:hover {
        transform: translateY(-1px);
    }

    #dataGaleri .view-btn:hover {
        color: #198754;
        border-color: #198754;
        background: #e8f6ee;
    }

    #dataGaleri .edit-btn:hover {
        color: #b7791f;
        border-color: #e8c77b;
        background: #fff9e8;
    }

    #dataGaleri .delete-btn:hover {
        color: #dc3545;
        border-color: #f1aeb5;
        background: #fff0f1;
    }

    #dataGaleri .delete-btn {
        margin: 0;
    }

    /* INFORMASI DAN PAGINATION */
    .galeri-table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-top: 17px;
    }

    #infoGaleri {
        color: #64746a;
        font-size: 12px;
    }

    #paginationGaleri {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 4px;
    }

    #paginationGaleri .page-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 32px;
        padding: 5px 9px;
        border: 1px solid transparent;
        border-radius: 6px;
        background: #fff;
        color: #49574e;
        font-size: 12px;
        cursor: pointer;
        transition: .2s;
    }

    #paginationGaleri .page-btn:hover:not(:disabled) {
        border-color: #cce5d5;
        background: #e8f6ee;
        color: #0b5d3b;
    }

    #paginationGaleri .page-btn.active {
        border-color: #198754;
        background: #198754;
        color: #fff;
    }

    #paginationGaleri .page-btn:disabled {
        opacity: .45;
        cursor: default;
    }

    #paginationGaleri .page-btn svg {
        width: 14px;
        height: 14px;
    }

    /* HILANGKAN KONTROL BAWAAN DATATABLES */
    #dataGaleri_wrapper .dataTables_length,
    #dataGaleri_wrapper .dataTables_filter,
    #dataGaleri_wrapper .dataTables_info,
    #dataGaleri_wrapper .dataTables_paginate {
        display: none !important;
    }

    #dataGaleri_wrapper {
        width: 100%;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .galeri-header {
            align-items: flex-start !important;
            flex-direction: column;
        }

        .galeri-header h4 {
            font-size: 23px;
        }

        .galeri-card .card-body {
            padding: 14px;
        }

        .galeri-table-controls {
            align-items: stretch;
            flex-direction: column;
            gap: 12px;
        }

        .galeri-search {
            align-items: flex-start;
            flex-direction: column;
            gap: 6px;
        }

        .galeri-search input {
            width: 100%;
        }

        .galeri-table-footer {
            align-items: center;
            flex-direction: column;
        }

        #infoGaleri {
            text-align: center;
        }

        #paginationGaleri {
            justify-content: center;
        }
    }
</style>

<div class="container-fluid py-4 galeri-page">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 galeri-header">
        <div>
            <h4 class="mb-1">Data Album Galeri</h4>
            <p class="mb-0">
                Kelola album dokumentasi foto dan video kegiatan sekolah.
            </p>
        </div>

        <a href="{{ route('admin.galeri.addEdit') }}" class="btn-galeri">
            <i data-feather="plus"></i>
            Tambah Album
        </a>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success galeri-alert" id="successAlert">
            <i data-feather="check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger galeri-alert" id="errorAlert">
            <i data-feather="x-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- TABEL --}}
    <div class="card galeri-card">

        <div class="galeri-card-header">
            <h5 class="mb-0">Daftar Album</h5>
            <span>Satu album dapat berisi banyak foto dan video.</span>
        </div>

        <div class="card-body">

            {{-- SEARCH DAN JUMLAH DATA DI LUAR AREA SCROLL --}}
            <div class="galeri-table-controls">

                <div class="galeri-length">
                    <label for="jumlahGaleri" class="mb-0">Tampilkan</label>

                    <select id="jumlahGaleri">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                    <span>data</span>
                </div>

                <div class="galeri-search">
                    <label for="cariGaleri" class="mb-0">Cari album</label>
                    <input
                        type="search"
                        id="cariGaleri"
                        placeholder="Cari judul atau keterangan..."
                        autocomplete="off">
                </div>

            </div>

            {{-- AREA SCROLL HANYA UNTUK TABEL --}}
            <div class="galeri-table-wrap">

                <table id="dataGaleri" class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Album</th>
                            <th>Keterangan</th>
                            <th>Tanggal Kegiatan</th>
                            <th>Kategori</th>
                            <th>Foto</th>
                            <th>Video</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($galeri as $item)
                            <tr>
                                <td class="nomor-column text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="judul-galeri">
                                    {{ $item->judul ?: '-' }}
                                </td>

                                <td class="keterangan-galeri">
                                    {{ \Illuminate\Support\Str::limit($item->keterangan ?: '-', 70) }}
                                </td>

                                <td class="text-center">
                                    @if($item->tanggal)
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if(($item->jumlah_foto ?? 0) > 0 && ($item->jumlah_video ?? 0) > 0)
                                        <span class="badge-kategori kategori-campuran">
                                            Foto &amp; Video
                                        </span>
                                    @elseif(($item->jumlah_foto ?? 0) > 0)
                                        <span class="badge-kategori kategori-foto">
                                            Foto
                                        </span>
                                    @elseif(($item->jumlah_video ?? 0) > 0)
                                        <span class="badge-kategori kategori-video">
                                            Video
                                        </span>
                                    @else
                                        <span class="badge-kategori kategori-kosong">
                                            Belum ada media
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <span class="badge-jumlah">
                                        <i data-feather="image"></i>
                                        {{ $item->jumlah_foto ?? 0 }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    <span class="badge-jumlah badge-video">
                                        <i data-feather="video"></i>
                                        {{ $item->jumlah_video ?? 0 }}
                                    </span>
                                </td>

                                <td>
                                    <div class="aksi-wrapper">

                                        <a
                                            href="{{ route('admin.galeri.show', Crypt::encrypt($item->id_album)) }}"
                                            class="action-btn view-btn"
                                            title="Detail Album">
                                            <i data-feather="eye"></i>
                                        </a>

                                        <a
                                            href="{{ route('admin.galeri.addEdit', Crypt::encrypt($item->id_album)) }}"
                                            class="action-btn edit-btn"
                                            title="Edit Album">
                                            <i data-feather="edit-3"></i>
                                        </a>

                                        <form
                                            action="{{ route('admin.galeri.delete', Crypt::encrypt($item->id_album)) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus album beserta semua media di dalamnya?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn delete-btn"
                                                title="Hapus Album">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    Belum ada album galeri.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

            {{-- FOOTER TABEL --}}
            <div class="galeri-table-footer">
                <div id="infoGaleri"></div>
                <div id="paginationGaleri"></div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {

        if ($.fn.DataTable.isDataTable('#dataGaleri')) {
            $('#dataGaleri').DataTable().destroy();
        }

        var tabelGaleri = $('#dataGaleri').DataTable({
            searching: true,
            ordering: true,
            paging: true,
            pagingType: 'simple_numbers',
            pageLength: 10,
            lengthChange: false,
            autoWidth: false,
            dom: 't',

            language: {
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_–_END_ dari _TOTAL_ data',
                infoEmpty: 'Menampilkan 0 data',
                zeroRecords: 'Album galeri tidak ditemukan',
                emptyTable: 'Belum ada album galeri',
                infoFiltered: '(disaring dari _MAX_ total data)',
                paginate: {
                    previous: '‹',
                    next: '›'
                }
            },

            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    searchable: false
                },
                {
                    targets: [4, 5, 6, 7],
                    orderable: false,
                    searchable: false
                },
                {
                    targets: [0, 3, 4, 5, 6, 7],
                    className: 'text-center'
                }
            ],

            drawCallback: function () {
                var api = this.api();
                var info = api.page.info();
                var $pagination = $('#paginationGaleri');

                // Nomor urut mengikuti halaman DataTables.
                api.column(0, { page: 'current' }).nodes().each(function (cell, i) {
                    cell.innerHTML = info.start + i + 1;
                });

                // Informasi jumlah data.
                if (info.recordsDisplay === 0) {
                    $('#infoGaleri').text('Menampilkan 0 data');
                } else {
                    $('#infoGaleri').text(
                        'Menampilkan ' +
                        (info.start + 1) +
                        '–' +
                        info.end +
                        ' dari ' +
                        info.recordsDisplay +
                        ' data'
                    );

                    if (info.recordsDisplay !== info.recordsTotal) {
                        $('#infoGaleri').append(
                            ' (disaring dari ' + info.recordsTotal + ' total data)'
                        );
                    }
                }

                // Pagination khusus.
                $pagination.empty();

                var totalHalaman = info.pages;
                var halamanAktif = info.page;

                var tombolSebelumnya = $('<button>', {
                    type: 'button',
                    class: 'page-btn',
                    html: '<i data-feather="chevron-left"></i>',
                    title: 'Halaman sebelumnya',
                    disabled: halamanAktif === 0
                });

                tombolSebelumnya.on('click', function () {
                    if (halamanAktif > 0) {
                        api.page('previous').draw('page');
                    }
                });

                $pagination.append(tombolSebelumnya);

                for (var i = 0; i < totalHalaman; i++) {
                    (function (nomorHalaman) {
                        var tombol = $('<button>', {
                            type: 'button',
                            class: 'page-btn' +
                                (nomorHalaman === halamanAktif ? ' active' : ''),
                            text: nomorHalaman + 1,
                            'aria-label': 'Halaman ' + (nomorHalaman + 1)
                        });

                        tombol.on('click', function () {
                            api.page(nomorHalaman).draw('page');
                        });

                        $pagination.append(tombol);
                    })(i);
                }

                var tombolBerikutnya = $('<button>', {
                    type: 'button',
                    class: 'page-btn',
                    html: '<i data-feather="chevron-right"></i>',
                    title: 'Halaman berikutnya',
                    disabled: halamanAktif >= totalHalaman - 1
                });

                tombolBerikutnya.on('click', function () {
                    if (halamanAktif < totalHalaman - 1) {
                        api.page('next').draw('page');
                    }
                });

                $pagination.append(tombolBerikutnya);

                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            }
        });

        // Search berada di luar tabel sehingga tidak ikut bergeser.
        $('#cariGaleri').on('input', function () {
            tabelGaleri.search(this.value).draw();
        });

        // Pilihan jumlah data.
        $('#jumlahGaleri').on('change', function () {
            tabelGaleri.page.len(parseInt(this.value, 10)).draw();
        });

        // Notifikasi menghilang otomatis.
        setTimeout(function () {
            $('#successAlert, #errorAlert').fadeOut(300, function () {
                $(this).remove();
            });
        }, 3000);

        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>
@endpush

@endsection
