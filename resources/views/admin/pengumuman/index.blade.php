
@extends('admin')

@section('title', 'Kelola Pengumuman - MAN 2 Tasikmalaya')

@section('content')

<style>
    .pengumuman-page {
        padding-top: 5px !important;
        color: #1f2937;
    }

    .pengumuman-header {
        gap: 16px;
    }

    .pengumuman-header h4 {
        color: #0b5d3b;
        font-size: 26px;
        font-weight: 700;
    }

    .pengumuman-header p {
        color: #64746a !important;
        font-size: 14px;
        line-height: 1.6;
    }

    .btn-pengumuman {
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
        text-decoration: none;
        white-space: nowrap;
        transition: .2s;
    }

    .btn-pengumuman:hover {
        background: #0b5d3b;
        border-color: #0b5d3b;
        color: #fff;
    }

    .btn-pengumuman svg {
        width: 17px;
        height: 17px;
    }

    .pengumuman-alert {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 15px;
        border-radius: 9px;
        font-size: 13px;
    }

    .pengumuman-card {
        width: 100%;
        border: 1px solid #dce9df;
        border-radius: 13px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 5px 20px rgba(11, 93, 59, .05);
    }

    .pengumuman-card-header {
        padding: 18px 20px;
        background: #fff;
        border-bottom: 1px solid #e5eee8;
    }

    .pengumuman-card-header h5 {
        color: #0b5d3b;
        font-size: 16px;
        font-weight: 700;
    }

    .pengumuman-card-header span {
        display: block;
        margin-top: 5px;
        color: #7a887f;
        font-size: 12px;
    }

    .pengumuman-card .card-body {
        padding: 20px;
    }

    /* SEARCH DAN JUMLAH DATA */
    .pengumuman-table-controls {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 17px;
    }

    .pengumuman-length,
    .pengumuman-search {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #64746a;
        font-size: 13px;
    }

    .pengumuman-length select {
        height: 36px;
        padding: 5px 28px 5px 10px;
        border: 1px solid #d5e2d9;
        border-radius: 7px;
        background: #fff;
        color: #49574e;
        outline: none;
    }

    .pengumuman-search input {
        width: 250px;
        max-width: 100%;
        height: 36px;
        padding: 7px 11px;
        border: 1px solid #d5e2d9;
        border-radius: 7px;
        background: #fff;
        outline: none;
        font-size: 13px;
        box-sizing: border-box;
    }

    .pengumuman-search input:focus,
    .pengumuman-length select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, .10);
    }

    /* TABEL */
    .pengumuman-table-wrap {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #e5eee8;
        border-radius: 8px;
    }

    #dataPengumuman {
        width: 100% !important;
        min-width: 1050px;
        margin: 0 !important;
        border-collapse: collapse !important;
        table-layout: fixed;
    }

    #dataPengumuman thead th {
        padding: 13px 12px !important;
        background: #198754 !important;
        color: #fff !important;
        border: none !important;
        font-size: 12px;
        font-weight: 600;
        text-align: left;
        vertical-align: middle;
        white-space: nowrap;
    }

    #dataPengumuman tbody td {
        padding: 13px 12px !important;
        color: #49574e;
        font-size: 13px;
        line-height: 1.6;
        border-bottom: 1px solid #edf2ee !important;
        vertical-align: middle;
        overflow-wrap: anywhere;
    }

    #dataPengumuman tbody tr:hover td {
        background: #f5faf7 !important;
    }

    #dataPengumuman tbody tr:last-child td {
        border-bottom: none !important;
    }

    /* PROPORSI KOLOM */
    #dataPengumuman th:nth-child(1),
    #dataPengumuman td:nth-child(1) {
        width: 60px;
        text-align: center;
    }

    #dataPengumuman th:nth-child(2),
    #dataPengumuman td:nth-child(2) {
        width: 200px;
    }

    #dataPengumuman th:nth-child(3),
    #dataPengumuman td:nth-child(3) {
        width: 350px;
        white-space: normal;
    }

    #dataPengumuman th:nth-child(4),
    #dataPengumuman td:nth-child(4) {
        width: 125px;
        white-space: nowrap;
    }

    #dataPengumuman th:nth-child(5),
    #dataPengumuman td:nth-child(5) {
        width: 110px;
        text-align: center;
    }

    #dataPengumuman th:nth-child(6),
    #dataPengumuman td:nth-child(6) {
        width: 140px;
        text-align: center;
    }

    .judul-pengumuman {
        color: #244b35 !important;
        font-weight: 600;
    }

    .isi-pengumuman {
        color: #64746a !important;
        line-height: 1.7;
        white-space: normal;
        overflow-wrap: anywhere;
    }

    /* STATUS */
    .status-badge {
        display: inline-block;
        padding: 5px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-publish {
        background: #e5f6eb;
        color: #198754;
    }

    .status-draft {
        background: #fff3cd;
        color: #856404;
    }

    /* TOMBOL AKSI */
    #dataPengumuman .aksi-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        flex-wrap: nowrap;
    }

    #dataPengumuman .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 33px;
        width: 33px;
        height: 33px;
        padding: 0;
        border: 1px solid #dce9df;
        border-radius: 7px;
        background: #fff;
        color: #64746a;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
    }

    #dataPengumuman .action-btn svg {
        width: 15px;
        height: 15px;
    }

    #dataPengumuman .action-btn:hover {
        transform: translateY(-1px);
    }

    #dataPengumuman .view-btn:hover {
        color: #198754;
        border-color: #198754;
        background: #e8f6ee;
    }

    #dataPengumuman .edit-btn:hover {
        color: #b7791f;
        border-color: #e8c77b;
        background: #fff9e8;
    }

    #dataPengumuman .delete-btn:hover {
        color: #dc3545;
        border-color: #f1aeb5;
        background: #fff0f1;
    }

    #dataPengumuman .delete-btn {
        margin: 0;
    }

    /* FOOTER DAN PAGINATION */
    .pengumuman-table-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 17px;
    }

    #infoPengumuman {
        color: #64746a;
        font-size: 12px;
    }

    #paginationPengumuman {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 4px;
    }

    #paginationPengumuman .page-btn {
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

    #paginationPengumuman .page-btn:hover:not(:disabled) {
        border-color: #cce5d5;
        background: #e8f6ee;
        color: #0b5d3b;
    }

    #paginationPengumuman .page-btn.active {
        border-color: #198754;
        background: #198754;
        color: #fff;
    }

    #paginationPengumuman .page-btn:disabled {
        opacity: .45;
        cursor: default;
    }

    #paginationPengumuman .page-btn svg {
        width: 14px;
        height: 14px;
    }

    #dataPengumuman_wrapper .dataTables_length,
    #dataPengumuman_wrapper .dataTables_filter,
    #dataPengumuman_wrapper .dataTables_info,
    #dataPengumuman_wrapper .dataTables_paginate {
        display: none !important;
    }

    #dataPengumuman_wrapper {
        width: 100%;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .pengumuman-header {
            align-items: flex-start !important;
            flex-direction: column;
        }

        .pengumuman-header h4 {
            font-size: 23px;
        }

        .pengumuman-card .card-body {
            padding: 14px;
        }

        .pengumuman-table-controls {
            align-items: stretch;
            flex-direction: column;
            gap: 12px;
        }

        .pengumuman-search {
            align-items: flex-start;
            flex-direction: column;
            gap: 6px;
        }

        .pengumuman-search input {
            width: 100%;
        }

        .pengumuman-table-footer {
            align-items: center;
            flex-direction: column;
        }

        #infoPengumuman {
            text-align: center;
        }

        #paginationPengumuman {
            justify-content: center;
        }
    }
</style>

<div class="container-fluid py-4 pengumuman-page">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 pengumuman-header">
        <div>
            <h4 class="mb-1">Data Pengumuman</h4>
            <p class="mb-0">Kelola informasi dan pengumuman sekolah.</p>
        </div>

        @if(Auth::user()->role == 'admin')
            <a href="{{ route('admin.pengumuman.addEdit') }}" class="btn-pengumuman">
                <i data-feather="plus"></i>
                Tambah Pengumuman
            </a>
        @endif
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success pengumuman-alert" id="successAlert">
            <i data-feather="check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger pengumuman-alert" id="errorAlert">
            <i data-feather="x-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- CARD TABEL --}}
    <div class="card pengumuman-card">

        <div class="pengumuman-card-header">
            <h5 class="mb-0">Daftar Pengumuman</h5>
            <span>Informasi pengumuman yang terdaftar.</span>
        </div>

        <div class="card-body">

            {{-- SEARCH --}}
            <div class="pengumuman-table-controls">

                <div class="pengumuman-length">
                    <label for="jumlahPengumuman" class="mb-0">Tampilkan</label>

                    <select id="jumlahPengumuman">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                    <span>data</span>
                </div>

                <div class="pengumuman-search">
                    <label for="cariPengumuman" class="mb-0">Cari pengumuman</label>
                    <input
                        type="search"
                        id="cariPengumuman"
                        placeholder="Cari judul, isi, atau tanggal..."
                        autocomplete="off">
                </div>

            </div>

            {{-- TABEL --}}
            <div class="pengumuman-table-wrap">

                <table id="dataPengumuman" class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Pengumuman</th>
                            <th>Isi Pengumuman</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($pengumuman as $item)
                            <tr>
                                <td class="nomor-column">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="judul-pengumuman">
                                    {{ $item->judul ?: '-' }}
                                </td>

                                <td class="isi-pengumuman">
                                    {{ $item->isi ?: '-' }}
                                </td>

                                <td>
                                    @if($item->tanggal)
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    @if($item->status == 'publish')
                                        <span class="status-badge status-publish">
                                            Publish
                                        </span>
                                    @else
                                        <span class="status-badge status-draft">
                                            Draft
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="aksi-wrapper">

                                        {{-- DETAIL --}}
                                        <a
                                            href="{{ route('admin.pengumuman.show', Crypt::encrypt($item->id_pengumuman)) }}"
                                            class="action-btn view-btn"
                                            title="Lihat Detail">
                                            <i data-feather="eye"></i>
                                        </a>

                                        @if(Auth::user()->role == 'admin')

                                            {{-- EDIT --}}
                                            <a
                                                href="{{ route('admin.pengumuman.addEdit', Crypt::encrypt($item->id_pengumuman)) }}"
                                                class="action-btn edit-btn"
                                                title="Edit Pengumuman">
                                                <i data-feather="edit-3"></i>
                                            </a>

                                            {{-- HAPUS --}}
                                            <form
                                                action="{{ route('admin.pengumuman.delete', Crypt::encrypt($item->id_pengumuman)) }}"
                                                method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="action-btn delete-btn"
                                                    title="Hapus Pengumuman">
                                                    <i data-feather="trash-2"></i>
                                                </button>
                                            </form>

                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    Belum ada data pengumuman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

            {{-- INFO DAN PAGINATION --}}
            <div class="pengumuman-table-footer">
                <div id="infoPengumuman"></div>
                <div id="paginationPengumuman"></div>
            </div>

        </div>
    </div>

</div>

@push('scripts')
<script>
    $(document).ready(function () {

        if ($.fn.DataTable.isDataTable('#dataPengumuman')) {
            $('#dataPengumuman').DataTable().destroy();
        }

        var tabelPengumuman = $('#dataPengumuman').DataTable({
            searching: true,
            ordering: true,
            paging: true,
            pageLength: 10,
            lengthChange: false,
            autoWidth: false,
            pagingType: 'simple_numbers',
            dom: 't',

            language: {
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_–_END_ dari _TOTAL_ data',
                infoEmpty: 'Menampilkan 0 data',
                zeroRecords: 'Data pengumuman tidak ditemukan',
                emptyTable: 'Belum ada data pengumuman',
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
                    targets: [4, 5],
                    orderable: false,
                    searchable: false
                }
            ],

            drawCallback: function () {
                var api = this.api();
                var info = api.page.info();
                var $pagination = $('#paginationPengumuman');

                // Nomor urut sesuai halaman
                api.column(0, {
                    page: 'current'
                }).nodes().each(function (cell, i) {
                    cell.innerHTML = info.start + i + 1;
                });

                // Informasi jumlah data
                if (info.recordsDisplay === 0) {
                    $('#infoPengumuman').text('Menampilkan 0 data');
                } else {
                    $('#infoPengumuman').text(
                        'Menampilkan ' +
                        (info.start + 1) +
                        '–' +
                        info.end +
                        ' dari ' +
                        info.recordsDisplay +
                        ' data'
                    );

                    if (info.recordsDisplay !== info.recordsTotal) {
                        $('#infoPengumuman').append(
                            ' (disaring dari ' +
                            info.recordsTotal +
                            ' total data)'
                        );
                    }
                }

                // Pagination khusus
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

        // Pencarian judul, isi, dan tanggal
        $('#cariPengumuman').on('input', function () {
            tabelPengumuman.search(this.value).draw();
        });

        // Jumlah data per halaman
        $('#jumlahPengumuman').on('change', function () {
            tabelPengumuman.page.len(parseInt(this.value, 10)).draw();
        });

        // Alert hilang otomatis
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
