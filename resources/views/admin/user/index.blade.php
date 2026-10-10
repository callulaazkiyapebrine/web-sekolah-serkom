@extends('admin')

@section('title', 'Kelola Data User - MAN 2 Tasikmalaya')

@section('content')

<style>
    .user-page {
        padding-top: 5px !important;
        color: #1f2937;
    }

    .user-header {
        gap: 16px;
    }

    .user-header h4 {
        color: #0b5d3b;
        font-size: 26px;
        font-weight: 700;
    }

    .user-header p {
        color: #64746a !important;
        font-size: 14px;
        line-height: 1.6;
    }

    /* TOMBOL TAMBAH */
    .user-page .btn-user {
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

    .user-page .btn-user:hover {
        background: #0b5d3b;
        border-color: #0b5d3b;
        color: #fff;
    }

    .user-page .btn-user svg {
        width: 17px;
        height: 17px;
    }

    /* ALERT */
    .user-alert {
        display: flex;
        align-items: center;
        gap: 8px;
        border-radius: 9px;
        padding: 12px 15px;
        font-size: 13px;
    }

    /* CARD */
    .user-card {
        width: 100%;
        border: 1px solid #dce9df;
        border-radius: 13px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 5px 20px rgba(11, 93, 59, .05);
    }

    .user-card-header {
        padding: 18px 20px;
        background: #fff;
        border-bottom: 1px solid #e5eee8;
    }

    .user-card-header h5 {
        color: #0b5d3b;
        font-size: 16px;
        font-weight: 700;
    }

    .user-card-header span {
        display: block;
        margin-top: 5px;
        color: #7a887f;
        font-size: 12px;
    }

    .user-card .card-body {
        padding: 20px;
    }

    /* SEARCH DAN JUMLAH DATA */
    .user-table-controls {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 17px;
    }

    .user-length,
    .user-search {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #64746a;
        font-size: 13px;
    }

    .user-length select {
        height: 36px;
        padding: 5px 28px 5px 10px;
        border: 1px solid #d5e2d9;
        border-radius: 7px;
        background: #fff;
        color: #49574e;
        outline: none;
    }

    .user-search input {
        width: 230px;
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

    .user-search input:focus,
    .user-length select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, .10);
    }

    /* AREA SCROLL TABEL */
    .user-table-wrap {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #e5eee8;
        border-radius: 8px;
    }

    #dataUser {
        width: 100% !important;
        min-width: 650px;
        margin: 0 !important;
        border-collapse: collapse !important;
        table-layout: fixed;
    }

    #dataUser thead th {
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

    #dataUser tbody td {
        padding: 13px 12px !important;
        color: #49574e;
        font-size: 13px;
        line-height: 1.6;
        vertical-align: middle;
        border-bottom: 1px solid #edf2ee !important;
        overflow-wrap: anywhere;
    }

    #dataUser tbody tr:hover td {
        background: #f5faf7 !important;
    }

    #dataUser tbody tr:last-child td {
        border-bottom: none !important;
    }

    /* PROPORSI KOLOM */
    #dataUser th:nth-child(1),
    #dataUser td:nth-child(1) {
        width: 65px;
        text-align: center;
    }

    #dataUser th:nth-child(2),
    #dataUser td:nth-child(2) {
        width: auto;
    }

    #dataUser th:nth-child(3),
    #dataUser td:nth-child(3) {
        width: 150px;
    }

    #dataUser th:nth-child(4),
    #dataUser td:nth-child(4) {
        width: 160px;
        text-align: center;
    }

    .username-user {
        color: #244b35 !important;
        font-weight: 600;
    }

    /* BADGE ROLE */
    #dataUser .badge-role {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    #dataUser .badge-role svg {
        width: 13px;
        height: 13px;
    }

    #dataUser .role-admin {
        background: #e8f6ee;
        color: #166b3b;
    }

    #dataUser .role-operator {
        background: #f1f5f9;
        color: #475569;
    }

    /* TOMBOL AKSI */
    #dataUser .aksi-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
        flex-wrap: nowrap;
    }

    #dataUser .action-btn {
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

    #dataUser .action-btn svg {
        width: 15px;
        height: 15px;
    }

    #dataUser .action-btn:hover {
        transform: translateY(-1px);
    }

    #dataUser .view-btn:hover {
        color: #198754;
        border-color: #198754;
        background: #e8f6ee;
    }

    #dataUser .edit-btn:hover {
        color: #b7791f;
        border-color: #e8c77b;
        background: #fff9e8;
    }

    #dataUser .delete-btn:hover {
        color: #dc3545;
        border-color: #f1aeb5;
        background: #fff0f1;
    }

    #dataUser .delete-btn {
        margin: 0;
    }

    /* INFO DAN PAGINATION */
    .user-table-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 17px;
    }

    #infoUser {
        color: #64746a;
        font-size: 12px;
    }

    #paginationUser {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 4px;
    }

    #paginationUser .page-btn {
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

    #paginationUser .page-btn:hover:not(:disabled) {
        border-color: #cce5d5;
        background: #e8f6ee;
        color: #0b5d3b;
    }

    #paginationUser .page-btn.active {
        border-color: #198754;
        background: #198754;
        color: #fff;
    }

    #paginationUser .page-btn:disabled {
        opacity: .45;
        cursor: default;
    }

    #paginationUser .page-btn svg {
        width: 14px;
        height: 14px;
    }

    /* SEMBUNYIKAN KONTROL BAWAAN DATATABLES */
    #dataUser_wrapper .dataTables_length,
    #dataUser_wrapper .dataTables_filter,
    #dataUser_wrapper .dataTables_info,
    #dataUser_wrapper .dataTables_paginate {
        display: none !important;
    }

    #dataUser_wrapper {
        width: 100%;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .user-header {
            align-items: flex-start !important;
            flex-direction: column;
        }

        .user-header h4 {
            font-size: 23px;
        }

        .user-card .card-body {
            padding: 14px;
        }

        .user-table-controls {
            align-items: stretch;
            flex-direction: column;
            gap: 12px;
        }

        .user-search {
            align-items: flex-start;
            flex-direction: column;
            gap: 6px;
        }

        .user-search input {
            width: 100%;
        }

        .user-table-footer {
            align-items: center;
            flex-direction: column;
        }

        #infoUser {
            text-align: center;
        }

        #paginationUser {
            justify-content: center;
        }
    }
</style>

<div class="container-fluid py-4 user-page">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 user-header">
        <div>
            <h4 class="mb-1">Data User</h4>
            <p class="mb-0">
                Kelola akun administrator dan operator website sekolah.
            </p>
        </div>

        @if(Auth::user()->role == 'admin')
            <a href="{{ route('admin.user.addEdit') }}" class="btn-user">
                <i data-feather="plus"></i>
                Tambah User Baru
            </a>
        @endif
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success user-alert" id="successAlert">
            <i data-feather="check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger user-alert" id="errorAlert">
            <i data-feather="x-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- CARD TABEL --}}
    <div class="card user-card">

        <div class="user-card-header">
            <h5 class="mb-0">Daftar User</h5>
            <span>Informasi akun dan hak akses pengguna yang terdaftar.</span>
        </div>

        <div class="card-body">

            {{-- SEARCH DAN JUMLAH DATA --}}
            <div class="user-table-controls">

                <div class="user-length">
                    <label for="jumlahUser" class="mb-0">Tampilkan</label>

                    <select id="jumlahUser">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                    <span>data</span>
                </div>

                <div class="user-search">
                    <label for="cariUser" class="mb-0">Cari user</label>
                    <input
                        type="search"
                        id="cariUser"
                        placeholder="Cari username atau role..."
                        autocomplete="off">
                </div>

            </div>

            {{-- TABEL --}}
            <div class="user-table-wrap">

                <table id="dataUser" class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $item)
                            <tr>
                                <td class="nomor-column text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="username-user">
                                    {{ $item->username }}
                                </td>

                                <td>
                                    @if($item->role == 'admin')
                                        <span class="badge-role role-admin">
                                            <i data-feather="shield"></i>
                                            Admin
                                        </span>
                                    @else
                                        <span class="badge-role role-operator">
                                            <i data-feather="user"></i>
                                            Operator
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="aksi-wrapper">

                                        {{-- DETAIL --}}
                                        <a
                                            href="{{ route('admin.user.show', Crypt::encrypt($item->id)) }}"
                                            class="action-btn view-btn"
                                            title="Lihat Detail">
                                            <i data-feather="eye"></i>
                                        </a>

                                        @if(Auth::user()->role == 'admin')

                                            {{-- EDIT --}}
                                            <a
                                                href="{{ route('admin.user.addEdit', Crypt::encrypt($item->id)) }}"
                                                class="action-btn edit-btn"
                                                title="Edit User">
                                                <i data-feather="edit-3"></i>
                                            </a>

                                            {{-- HAPUS --}}
                                            @if($item->id != 1)
                                                <form
                                                    action="{{ route('admin.user.delete', Crypt::encrypt($item->id)) }}"
                                                    method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="action-btn delete-btn"
                                                        title="Hapus User">
                                                        <i data-feather="trash-2"></i>
                                                    </button>
                                                </form>
                                            @endif

                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    Belum ada data user.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

            {{-- INFO DAN PAGINATION --}}
            <div class="user-table-footer">
                <div id="infoUser"></div>
                <div id="paginationUser"></div>
            </div>

        </div>
    </div>

</div>

@push('scripts')
<script>
    $(document).ready(function () {

        // CEGAH DATATABLES DIINISIALISASI BERULANG
        if ($.fn.DataTable.isDataTable('#dataUser')) {
            $('#dataUser').DataTable().destroy();
        }

        var tabelUser = $('#dataUser').DataTable({
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
                zeroRecords: 'Data user tidak ditemukan',
                emptyTable: 'Belum ada data user',
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
                    targets: 3,
                    orderable: false,
                    searchable: false
                }
            ],

            drawCallback: function () {
                var api = this.api();
                var info = api.page.info();
                var $pagination = $('#paginationUser');

                // Nomor urut otomatis mengikuti halaman.
                api.column(0, { page: 'current' }).nodes().each(function (cell, i) {
                    cell.innerHTML = info.start + i + 1;
                });

                // Informasi jumlah data.
                if (info.recordsDisplay === 0) {
                    $('#infoUser').text('Menampilkan 0 data');
                } else {
                    $('#infoUser').text(
                        'Menampilkan ' +
                        (info.start + 1) +
                        '–' +
                        info.end +
                        ' dari ' +
                        info.recordsDisplay +
                        ' data'
                    );

                    if (info.recordsDisplay !== info.recordsTotal) {
                        $('#infoUser').append(
                            ' (disaring dari ' + info.recordsTotal + ' total data)'
                        );
                    }
                }

                // Tombol pagination.
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

        // SEARCH DI LUAR AREA TABEL
        $('#cariUser').on('input', function () {
            tabelUser.search(this.value).draw();
        });

        // PILIH JUMLAH DATA
        $('#jumlahUser').on('change', function () {
            tabelUser.page.len(parseInt(this.value, 10)).draw();
        });

        // ALERT HILANG OTOMATIS
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
