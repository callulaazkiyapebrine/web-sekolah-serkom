@extends('admin')

@section('title', 'Kelola Data Ekstrakurikuler - MAN 2 Tasikmalaya')

@section('content')

<div class="container-fluid py-4 eskul-page">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 eskul-header">
        <div>
            <h4 class="fw-bold mb-1">Data Ekstrakurikuler</h4>
            <p class="text-muted mb-0">
                Kelola kegiatan dan informasi ekstrakurikuler sekolah.
            </p>
        </div>

        <a href="{{ route('admin.ekstrakurikuler.addEdit') }}" class="btn btn-eskul">
            <i data-feather="plus" class="me-1"></i>
            Tambah Ekstrakurikuler Baru
        </a>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success eskul-alert" id="successAlert">
            <i data-feather="check-circle" class="me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger eskul-alert" id="errorAlert">
            <i data-feather="x-circle" class="me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- VALIDATION ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger eskul-alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- CARD TABEL --}}
    <div class="card eskul-card">

        <div class="card-header eskul-card-header">
            <h5 class="mb-0">Daftar Ekstrakurikuler</h5>
            <span>Informasi kegiatan ekstrakurikuler yang terdaftar</span>
        </div>

        <div class="card-body">

            {{-- KONTROL TABEL --}}
            <div class="eskul-controls">

                <div class="eskul-length">
                    <label for="jumlahEskul">Tampilkan</label>

                    <select id="jumlahEskul">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                    <span>data</span>
                </div>

                <div class="eskul-search">
                    <label for="cariEskul">Cari:</label>

                    <input
                        type="search"
                        id="cariEskul"
                        placeholder="Cari ekstrakurikuler..."
                        autocomplete="off">
                </div>

            </div>

            {{-- AREA SCROLL TABEL --}}
            <div class="eskul-table-wrapper">
                <table id="dataEskul" class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="text-center nomor-column">No</th>
                            <th>Nama Ekstrakurikuler</th>
                            <th>Pembina</th>
                            <th>Jadwal Latihan</th>
                            <th>Deskripsi</th>
                            <th class="text-center gambar-column">Gambar</th>
                            <th class="text-center aksi-column">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($ekstrakurikulers as $item)
                            <tr>
                                {{-- NOMOR OTOMATIS DATATABLES --}}
                                <td class="text-center nomor-column"></td>

                                {{-- NAMA --}}
                                <td class="nama-eskul">
                                    {{ $item->nama_eskul }}
                                </td>

                                {{-- PEMBINA --}}
                                <td class="pembina-eskul">
                                    {{ $item->pembina ?? '-' }}
                                </td>

                                {{-- JADWAL --}}
                                <td class="jadwal-eskul">
                                    {{ $item->jadwal_latihan ?? '-' }}
                                </td>

                                {{-- DESKRIPSI --}}
                                <td class="deskripsi-eskul">
                                    {{ \Illuminate\Support\Str::limit($item->deskripsi ?? '-', 80) }}
                                </td>

                                {{-- GAMBAR --}}
                                <td class="text-center gambar-column">
                                    @if($item->gambar)
                                        <img
                                            src="{{ asset('storage/' . $item->gambar) }}"
                                            alt="Gambar {{ $item->nama_eskul }}"
                                            class="foto-eskul">
                                    @else
                                        <span class="text-muted">Tidak ada gambar</span>
                                    @endif
                                </td>

                                {{-- AKSI --}}
                                <td class="text-center aksi-column">
                                    <div class="eskul-action-group">

                                        {{-- DETAIL --}}
                                        <a
                                            href="{{ route('admin.ekstrakurikuler.show', Crypt::encrypt($item->id_eskul)) }}"
                                            class="action-btn view-btn"
                                            title="Lihat"
                                            aria-label="Lihat ekstrakurikuler">
                                            <i data-feather="eye"></i>
                                        </a>

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.ekstrakurikuler.addEdit', Crypt::encrypt($item->id_eskul)) }}"
                                            class="action-btn edit-btn"
                                            title="Edit"
                                            aria-label="Edit ekstrakurikuler">
                                            <i data-feather="edit-3"></i>
                                        </a>

                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.ekstrakurikuler.delete', Crypt::encrypt($item->id_eskul)) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ekstrakurikuler ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn delete-btn"
                                                title="Hapus"
                                                aria-label="Hapus ekstrakurikuler">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- INFORMASI DAN PAGINATION --}}
            <div class="eskul-footer">
                <div id="infoEskul"></div>
                <div id="paginationEskul"></div>
            </div>

        </div>
    </div>

</div>

<style>
    /* HALAMAN */
    .eskul-page {
        padding-top: 5px !important;
        color: #1f2937;
    }

    /* HEADER */
    .eskul-header h4 {
        color: #0b5d3b;
        font-size: 28px;
        font-weight: 700;
    }

    .eskul-header p {
        color: #64746a !important;
        font-size: 14px;
    }

    /* TOMBOL TAMBAH */
    .eskul-page .btn-eskul {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        background: #198754;
        color: #fff;
        border: 1px solid #198754;
        border-radius: 8px;
        padding: 9px 15px;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
        transition: .2s;
    }

    .eskul-page .btn-eskul:hover {
        background: #0b5d3b;
        border-color: #0b5d3b;
        color: #fff;
    }

    .eskul-page .btn-eskul svg {
        width: 17px;
        height: 17px;
    }

    /* ALERT */
    .eskul-alert {
        display: flex;
        align-items: center;
        border-radius: 9px;
        font-size: 13px;
    }

    /* CARD */
    .eskul-card {
        width: 100%;
        min-width: 0;
        border: 1px solid #dce9df;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 5px 20px rgba(11, 93, 59, .05);
    }

    .eskul-card-header {
        background: #fff;
        padding: 18px 22px;
        border-bottom: 1px solid #e5eee8;
        border-radius: 14px 14px 0 0;
    }

    .eskul-card-header h5 {
        color: #0b5d3b;
        font-weight: 700;
        font-size: 16px;
    }

    .eskul-card-header span {
        display: block;
        margin-top: 4px;
        color: #7a887f;
        font-size: 13px;
    }

    .eskul-card .card-body {
        padding: 22px;
        min-width: 0;
    }

    /* KONTROL TABEL */
    .eskul-controls {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        width: 100%;
        margin-bottom: 20px;
    }

    .eskul-length,
    .eskul-search {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #49574e;
        font-size: 14px;
    }

    .eskul-length {
        flex-shrink: 0;
    }

    .eskul-length label,
    .eskul-search label {
        margin: 0;
        white-space: nowrap;
    }

    .eskul-length select {
        height: 36px;
        padding: 5px 9px;
        border: 1px solid #d5e2d9;
        border-radius: 7px;
        background: #fff;
        color: #49574e;
        outline: none;
    }

    .eskul-search {
        justify-content: flex-end;
        margin-left: auto;
    }

    .eskul-search input {
        width: 230px;
        max-width: 100%;
        height: 38px;
        padding: 7px 12px;
        margin: 0;
        border: 1px solid #d5e2d9;
        border-radius: 8px;
        background: #fff;
        color: #49574e;
        outline: none;
        box-sizing: border-box;
    }

    .eskul-search input:focus,
    .eskul-length select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, .12);
    }

    /* HANYA TABEL YANG BISA DIGESER */
    .eskul-table-wrapper {
        display: block;
        width: 100%;
        max-width: 100%;
        min-width: 0;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
    }

    /* TABEL */
    #dataEskul {
        width: 100%;
        min-width: 1200px;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        table-layout: auto;
    }

    #dataEskul thead th {
        padding: 14px 12px !important;
        background: #198754 !important;
        color: #fff !important;
        border: none !important;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        vertical-align: middle;
    }

    #dataEskul tbody td {
        padding: 13px 12px !important;
        color: #49574e;
        border-bottom: 1px solid #edf2ee;
        font-size: 14px;
        line-height: 1.6;
        vertical-align: middle;
    }

    #dataEskul tbody tr {
        transition: background-color .2s ease;
    }

    #dataEskul tbody tr:hover td {
        background: #f5faf7 !important;
    }

    #dataEskul tbody tr:last-child td {
        border-bottom: none;
    }

    /* LEBAR KOLOM */
    #dataEskul .nomor-column {
        width: 60px;
        min-width: 60px;
        text-align: center;
        white-space: nowrap;
    }

    #dataEskul .nama-eskul {
        min-width: 190px;
        color: #244b35 !important;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    #dataEskul .pembina-eskul {
        min-width: 150px;
        overflow-wrap: anywhere;
    }

    #dataEskul .jadwal-eskul {
        min-width: 150px;
        white-space: nowrap;
    }

    #dataEskul .deskripsi-eskul {
        min-width: 250px;
        max-width: 350px;
        overflow-wrap: anywhere;
    }

    #dataEskul .gambar-column {
        min-width: 125px;
        white-space: nowrap;
    }

    #dataEskul .aksi-column {
        width: 150px;
        min-width: 150px;
        white-space: nowrap;
        text-align: center;
    }

    /* GAMBAR */
    .foto-eskul {
        display: inline-block;
        width: 58px;
        height: 45px;
        object-fit: cover;
        border: 1px solid #e2eee7;
        border-radius: 7px;
        transition: transform .2s ease;
    }

    .foto-eskul:hover {
        transform: scale(1.06);
    }

    /* TOMBOL AKSI */
    #dataEskul .eskul-action-group {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        min-width: 120px;
        white-space: nowrap;
    }

    #dataEskul .eskul-action-group form {
        display: inline-flex;
        flex: 0 0 auto;
        align-items: center;
        justify-content: center;
        margin: 0;
        padding: 0;
    }

    #dataEskul .action-btn {
        display: inline-flex;
        flex: 0 0 35px;
        align-items: center;
        justify-content: center;
        width: 35px;
        min-width: 35px;
        height: 35px;
        padding: 0;
        border: 1px solid #dce9df;
        border-radius: 8px;
        background: #fff;
        color: #64746a;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
        box-sizing: border-box;
    }

    #dataEskul .action-btn svg {
        display: block;
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }

    #dataEskul .action-btn:hover {
        transform: translateY(-1px);
    }

    #dataEskul .view-btn:hover {
        color: #198754;
        border-color: #198754;
        background: #e8f6ee;
    }

    #dataEskul .edit-btn:hover {
        color: #b7791f;
        border-color: #e8c77b;
        background: #fff9e8;
    }

    #dataEskul .delete-btn:hover {
        color: #dc3545;
        border-color: #f1aeb5;
        background: #fff0f1;
    }

    /* FOOTER */
    .eskul-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 18px;
    }

    #infoEskul {
        color: #64746a;
        font-size: 13px;
    }

    #paginationEskul {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 4px;
    }

    #paginationEskul .paginate-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 34px;
        padding: 5px 10px;
        border: 1px solid transparent;
        border-radius: 6px;
        background: #fff;
        color: #49574e;
        font-size: 13px;
        cursor: pointer;
    }

    #paginationEskul .paginate-btn.active {
        background: #198754;
        color: #fff;
        border-color: #198754;
    }

    #paginationEskul .paginate-btn:hover:not(:disabled):not(.active) {
        background: #e8f6ee;
        color: #0b5d3b;
        border-color: #cce5d5;
    }

    #paginationEskul .paginate-btn:disabled {
        color: #adb5bd;
        cursor: default;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .eskul-header {
            align-items: flex-start !important;
            flex-wrap: wrap;
            gap: 12px;
        }

        .eskul-header h4 {
            font-size: 23px;
        }

        .eskul-card .card-body {
            padding: 14px;
        }

        .eskul-controls {
            flex-direction: column;
            align-items: flex-start;
            gap: 14px;
        }

        .eskul-search {
            width: 100%;
            margin-left: 0;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .eskul-search input {
            width: 230px;
        }

        .eskul-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        #paginationEskul {
            justify-content: flex-start;
        }
    }
</style>

{{-- DATATABLES --}}
<link rel="stylesheet"
      href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {

        // HINDARI INISIALISASI DATATABLES BERULANG
        if ($.fn.DataTable.isDataTable('#dataEskul')) {
            $('#dataEskul').DataTable().destroy();
        }

        const tabelEskul = $('#dataEskul').DataTable({
            searching: true,
            ordering: true,
            paging: true,
            pageLength: 10,
            lengthChange: false,

            // Kontrol dibuat sendiri di luar area tabel
            dom: 't',

            autoWidth: false,

            columnDefs: [
                {
                    targets: 0,
                    width: '60px',
                    orderable: false,
                    searchable: false
                },
                {
                    targets: 1,
                    width: '190px'
                },
                {
                    targets: 2,
                    width: '150px'
                },
                {
                    targets: 3,
                    width: '150px'
                },
                {
                    targets: 4,
                    width: '250px'
                },
                {
                    targets: 5,
                    width: '125px',
                    orderable: false,
                    searchable: false
                },
                {
                    targets: 6,
                    width: '150px',
                    orderable: false,
                    searchable: false
                }
            ],

            language: {
                emptyTable: 'Belum ada data ekstrakurikuler',
                zeroRecords: 'Data ekstrakurikuler tidak ditemukan'
            },

            drawCallback: function () {
                const api = this.api();
                const info = api.page.info();

                // NOMOR URUT OTOMATIS
                api.column(0, { page: 'current' }).nodes().each(function (cell, i) {
                    cell.innerHTML = info.start + i + 1;
                });

                // INFORMASI DATA
                if (info.recordsDisplay === 0) {
                    $('#infoEskul').text('Tidak ada data yang ditampilkan');
                } else {
                    $('#infoEskul').text(
                        'Menampilkan ' +
                        (info.start + 1) + '–' +
                        info.end + ' dari ' +
                        info.recordsDisplay + ' data'
                    );
                }

                // PAGINATION
                const pagination = $('#paginationEskul');
                pagination.empty();

                function buatTombol(teks, halaman, disabled, aktif) {
                    const tombol = $('<button>', {
                        type: 'button',
                        class: 'paginate-btn' +
                            (aktif ? ' active' : ''),
                        text: teks,
                        disabled: disabled
                    });

                    if (!disabled && !aktif) {
                        tombol.on('click', function () {
                            api.page(halaman).draw('page');
                        });
                    }

                    pagination.append(tombol);
                }

                buatTombol(
                    '‹',
                    info.page - 1,
                    info.page === 0,
                    false
                );

                for (let i = 0; i < info.pages; i++) {
                    buatTombol(
                        String(i + 1),
                        i,
                        false,
                        i === info.page
                    );
                }

                buatTombol(
                    '›',
                    info.page + 1,
                    info.page >= info.pages - 1 || info.pages === 0,
                    false
                );

                // PERBARUI IKON SETELAH TABEL DIRENDER
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            }
        });

        // SEARCH TERPISAH
        $('#cariEskul').on('input', function () {
            tabelEskul.search(this.value).draw();
        });

        // PILIH JUMLAH DATA
        $('#jumlahEskul').on('change', function () {
            tabelEskul.page.len(Number(this.value)).draw();
        });

        // ALERT HILANG OTOMATIS
        setTimeout(function () {
            $('#successAlert, #errorAlert').fadeOut(300, function () {
                $(this).remove();
            });
        }, 3000);

        // IKON AWAL
        if (typeof feather !== 'undefined') {
            feather.replace();
        }

    });
</script>

@endsection
