
@extends('admin')

@section('title', 'Kelola Data Guru - MAN 2 Tasikmalaya')

@section('content')

<div class="container-fluid py-4 guru-page">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 guru-header">
        <div>
            <h4 class="fw-bold mb-1">Data Guru</h4>
            <p class="text-muted mb-0">Kelola informasi dan data guru sekolah.</p>
        </div>

        @if(Auth::user()->role == 'admin')
        <a href="{{ route('admin.guru.addEdit') }}" class="btn btn-guru">
            <i data-feather="plus" class="me-1"></i>
            Tambah Guru Baru
        </a>
        @endif
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
    <div class="alert alert-success guru-alert" id="successAlert">
        <i data-feather="check-circle" class="me-2"></i>
        {{ session('success') }}
    </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
    <div class="alert alert-danger guru-alert" id="errorAlert">
        <i data-feather="x-circle" class="me-2"></i>
        {{ session('error') }}
    </div>
    @endif

    {{-- CARD TABEL --}}
    <div class="card guru-card">

        <div class="card-header guru-card-header">
            <h5 class="mb-1">Daftar Guru</h5>
            <span>Informasi guru yang terdaftar</span>
        </div>

        <div class="card-body">

            {{-- KONTROL TABEL --}}
            <div class="guru-table-controls">

                <div class="guru-length-control">
                    <label for="jumlahGuru">Tampilkan</label>

                    <select id="jumlahGuru" class="form-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                    <span>data</span>
                </div>

                <div class="guru-search-control">
                    <label for="cariGuru">Cari guru</label>

                    <div class="guru-search-box">
                        <i data-feather="search"></i>
                        <input
                            type="search"
                            id="cariGuru"
                            placeholder="Cari nama, NIP, atau mata pelajaran..."
                            autocomplete="off">
                    </div>
                </div>

            </div>

            {{-- AREA SCROLL KHUSUS TABEL --}}
            <div class="guru-table-scroll">
                <table id="dataGuru" class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Guru</th>
                            <th>NIP</th>
                            <th>Mata Pelajaran</th>
                            <th class="text-center">Foto</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($guru as $item)
                        <tr>
                            <td class="text-center nomor-column"></td>

                            <td class="nama-guru">
                                {{ $item->nama_guru }}
                            </td>

                            <td class="nip-column">
                                {{ $item->nip ?? '-' }}
                            </td>

                            <td class="mapel-column">
                                {{ $item->mapel ?? '-' }}
                            </td>

                            <td class="text-center">
                                @if($item->foto)
                                <img
                                    src="{{ asset('storage/' . $item->foto) }}"
                                    alt="{{ $item->nama_guru }}"
                                    class="foto-guru">
                                @else
                                <span class="teks-tanpa-foto">
                                    Tidak ada foto
                                </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="text-center">
                                <div class="guru-action-group">

                                    {{-- DETAIL --}}
                                    <a
                                        href="{{ route('admin.guru.show', Crypt::encrypt($item->id_guru)) }}"
                                        class="action-btn view-btn"
                                        title="Lihat"
                                        aria-label="Lihat data guru">
                                        <i data-feather="eye"></i>
                                    </a>

                                    @if(Auth::user()->role == 'admin')

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.guru.addEdit', Crypt::encrypt($item->id_guru)) }}"
                                        class="action-btn edit-btn"
                                        title="Edit"
                                        aria-label="Edit data guru">
                                        <i data-feather="edit-3"></i>
                                    </a>

                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('admin.guru.delete', Crypt::encrypt($item->id_guru)) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data guru ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-btn delete-btn"
                                            title="Hapus"
                                            aria-label="Hapus data guru">
                                            <i data-feather="trash-2"></i>
                                        </button>
                                    </form>

                                    @endif

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- INFO DAN PAGINATION --}}
            <div class="guru-table-footer">
                <div id="infoGuru" class="guru-table-info"></div>
                <div id="paginationGuru" class="guru-pagination"></div>
            </div>

        </div>
    </div>

</div>

<style>
    /* HALAMAN */
    .guru-page {
        padding-top: 5px !important;
        color: #1f2937;
    }

    .guru-header {
        gap: 18px;
    }

    .guru-header h4 {
        color: #0b5d3b;
        font-size: 27px;
        font-weight: 700;
    }

    .guru-header p {
        color: #64746a !important;
        font-size: 14px;
    }

    /* TOMBOL TAMBAH */
    .btn-guru {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        background: #198754;
        color: #fff;
        border: 1px solid #198754;
        border-radius: 8px;
        padding: 10px 15px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        transition: .2s ease;
    }

    .btn-guru:hover {
        background: #0b5d3b;
        border-color: #0b5d3b;
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-guru svg {
        width: 17px;
        height: 17px;
    }

    /* ALERT */
    .guru-alert {
        display: flex;
        align-items: center;
        border: none;
        border-radius: 9px;
        padding: 13px 16px;
        font-size: 14px;
    }

    .guru-alert svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }

    /* CARD */
    .guru-card {
        border: 1px solid #e0eae3;
        border-radius: 13px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 18px rgba(11, 93, 59, .05);
    }

    .guru-card-header {
        background: #fff;
        padding: 19px 22px;
        border-bottom: 1px solid #e8efe9;
    }

    .guru-card-header h5 {
        color: #0b5d3b;
        font-size: 16px;
        font-weight: 700;
    }

    .guru-card-header span {
        color: #7a887f;
        font-size: 13px;
    }

    .guru-card .card-body {
        padding: 22px;
    }

    /* SEARCH DAN PILIH JUMLAH DATA */
    .guru-table-controls {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .guru-length-control {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #64746a;
        font-size: 13px;
        white-space: nowrap;
    }

    .guru-length-control .form-select {
        width: 76px;
        min-width: 76px;
        height: 38px;
        padding: 6px 28px 6px 10px;
        border: 1px solid #d5e2d9;
        border-radius: 8px;
        color: #49574e;
        font-size: 13px;
        box-shadow: none;
    }

    .guru-length-control .form-select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, .10);
    }

    .guru-search-control {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 6px;
        min-width: 280px;
        color: #49574e;
        font-size: 13px;
    }

    .guru-search-control label {
        font-weight: 600;
    }

    .guru-search-box {
        position: relative;
        width: 310px;
        max-width: 100%;
    }

    .guru-search-box > svg {
        position: absolute;
        top: 50%;
        left: 12px;
        width: 16px;
        height: 16px;
        color: #829087;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .guru-search-box input {
        width: 100%;
        height: 39px;
        padding: 8px 12px 8px 37px;
        border: 1px solid #d5e2d9;
        border-radius: 8px;
        outline: none;
        background: #fff;
        color: #34483b;
        font-size: 13px;
        box-sizing: border-box;
        transition: .2s;
    }

    .guru-search-box input:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, .10);
    }

    /* AREA SCROLL TABEL */
    .guru-table-scroll {
        width: 100%;
        overflow-x: auto;
        overflow-y: hidden;
        border: 1px solid #e5eee8;
        border-radius: 9px;
        scrollbar-width: thin;
        scrollbar-color: #b9d5c3 #f2f7f3;
    }

    .guru-table-scroll::-webkit-scrollbar {
        height: 8px;
    }

    .guru-table-scroll::-webkit-scrollbar-track {
        background: #f2f7f3;
        border-radius: 8px;
    }

    .guru-table-scroll::-webkit-scrollbar-thumb {
        background: #b9d5c3;
        border-radius: 8px;
    }

    /* TABEL */
    #dataGuru {
        width: 100% !important;
        min-width: 950px;
        table-layout: fixed !important;
        border-collapse: separate;
        border-spacing: 0;
        margin: 0 !important;
    }

    #dataGuru th:nth-child(1),
    #dataGuru td:nth-child(1) {
        width: 65px !important;
    }

    #dataGuru th:nth-child(2),
    #dataGuru td:nth-child(2) {
        width: 220px !important;
    }

    #dataGuru th:nth-child(3),
    #dataGuru td:nth-child(3) {
        width: 180px !important;
    }

    #dataGuru th:nth-child(4),
    #dataGuru td:nth-child(4) {
        width: 210px !important;
    }

    #dataGuru th:nth-child(5),
    #dataGuru td:nth-child(5) {
        width: 120px !important;
    }

    #dataGuru th:nth-child(6),
    #dataGuru td:nth-child(6) {
        width: 155px !important;
    }

    #dataGuru thead th {
        background: #198754 !important;
        color: #fff !important;
        font-size: 13px;
        font-weight: 600;
        padding: 14px 12px !important;
        border: none !important;
        white-space: nowrap;
        vertical-align: middle;
    }

    #dataGuru tbody td {
        padding: 13px 12px !important;
        color: #49574e;
        font-size: 13px;
        border-bottom: 1px solid #edf2ee !important;
        vertical-align: middle;
        line-height: 1.6;
        overflow-wrap: anywhere;
        background: #fff;
    }

    #dataGuru tbody tr:hover td {
        background: #f5faf7 !important;
    }

    #dataGuru tbody tr:last-child td {
        border-bottom: none !important;
    }

    #dataGuru .nomor-column {
        color: #748278 !important;
        font-weight: 600;
    }

    #dataGuru .nama-guru {
        color: #244b35 !important;
        font-weight: 600;
    }

    #dataGuru .nip-column {
        white-space: nowrap;
        font-family: Arial, sans-serif;
        letter-spacing: .2px;
    }

    #dataGuru .mapel-column {
        min-width: 0;
    }

    /* FOTO GURU */
    .foto-guru {
        display: inline-block;
        width: 60px;
        height: 48px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e0eae3;
        background: #f5faf7;
    }

    .teks-tanpa-foto {
        display: inline-block;
        color: #829087;
        font-size: 12px;
        white-space: nowrap;
    }

    /* TOMBOL AKSI */
    #dataGuru .guru-action-group {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        white-space: nowrap;
    }

    #dataGuru .guru-action-group form {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        padding: 0;
    }

    #dataGuru .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 32px;
        height: 32px;
        padding: 0;
        border: 1px solid #dce9df;
        border-radius: 8px;
        background: #fff;
        color: #64746a;
        cursor: pointer;
        text-decoration: none;
        transition: .2s ease;
    }

    #dataGuru .action-btn svg {
        display: block;
        width: 15px;
        height: 15px;
    }

    #dataGuru .view-btn:hover {
        color: #198754;
        border-color: #198754;
        background: #e8f6ee;
    }

    #dataGuru .edit-btn:hover {
        color: #b7791f;
        border-color: #e8c77b;
        background: #fff9e8;
    }

    #dataGuru .delete-btn:hover {
        color: #dc3545;
        border-color: #f1aeb5;
        background: #fff0f1;
    }

    /* INFO DAN PAGINATION */
    .guru-table-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 18px;
    }

    .guru-table-info {
        color: #64746a;
        font-size: 13px;
    }

    .guru-pagination {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 4px;
    }

    .guru-pagination .page-btn {
        min-width: 34px;
        height: 34px;
        padding: 5px 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #dce9df;
        border-radius: 7px;
        background: #fff;
        color: #49574e;
        font-size: 13px;
        cursor: pointer;
        transition: .2s;
    }

    .guru-pagination .page-btn:hover:not(:disabled) {
        background: #e8f6ee;
        color: #0b5d3b;
        border-color: #b9d9c4;
    }

    .guru-pagination .page-btn.active {
        background: #198754;
        color: #fff;
        border-color: #198754;
    }

    .guru-pagination .page-btn:disabled {
        opacity: .4;
        cursor: not-allowed;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .guru-header {
            align-items: flex-start !important;
            flex-wrap: wrap;
            gap: 14px;
        }

        .guru-header h4 {
            font-size: 23px;
        }

        .btn-guru {
            padding: 9px 12px;
            font-size: 12px;
        }

        .guru-card .card-body {
            padding: 14px;
        }

        .guru-card-header {
            padding: 16px;
        }

        .guru-table-controls {
            align-items: stretch;
            flex-direction: column;
            gap: 15px;
        }

        .guru-search-control,
        .guru-search-box {
            width: 100%;
            min-width: 0;
        }

        .guru-table-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        .guru-pagination {
            justify-content: flex-start;
        }
    }

    @media (max-width: 420px) {
        .guru-card .card-body {
            padding: 12px;
        }

        .guru-table-info {
            font-size: 12px;
        }
    }
</style>

@push('scripts')
<script>
    $(document).ready(function () {

        // CEGAH INISIALISASI DATATABLES BERULANG
        if ($.fn.DataTable.isDataTable('#dataGuru')) {
            $('#dataGuru').DataTable().destroy();
        }

        const tabelGuru = $('#dataGuru').DataTable({
            searching: true,
            ordering: true,
            paging: true,
            pageLength: 10,
            lengthChange: true,
            lengthMenu: [10, 25, 50, 100],
            autoWidth: false,

            // Search, jumlah data, info, dan pagination dibuat terpisah
            dom: 't',

            // Urutkan nama guru dari A sampai Z
            order: [[1, 'asc']],

            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    targets: 4,
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    targets: 5,
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                }
            ],

            language: {
                zeroRecords: 'Data guru tidak ditemukan',
                emptyTable: 'Belum ada data guru'
            },

            drawCallback: function () {
                const api = this.api();
                const info = api.page.info();

                // NOMOR URUT SESUAI HALAMAN
                api.rows({
                    page: 'current'
                }).every(function (rowIdx, tableLoop, rowLoop) {
                    $(this.node())
                        .find('.nomor-column')
                        .text(info.start + rowLoop + 1);
                });

                // INFORMASI JUMLAH DATA
                let teksInfo = '';

                if (info.recordsDisplay === 0) {
                    teksInfo = 'Menampilkan 0 data';
                } else {
                    teksInfo = 'Menampilkan ' +
                        (info.start + 1) + '–' +
                        info.end + ' dari ' +
                        info.recordsDisplay + ' data';
                }

                if (info.recordsDisplay < info.recordsTotal) {
                    teksInfo += ' (disaring dari ' +
                        info.recordsTotal + ' total data)';
                }

                $('#infoGuru').text(teksInfo);

                // PAGINATION CUSTOM
                const pagination = $('#paginationGuru');
                pagination.empty();

                if (info.pages <= 1) {
                    return;
                }

                function buatTombol(label, halaman, disabled, active) {
                    const tombol = $('<button>', {
                        type: 'button',
                        class: 'page-btn' + (active ? ' active' : ''),
                        text: label,
                        disabled: disabled,
                        'aria-label': 'Halaman ' + label
                    });

                    tombol.on('click', function () {
                        if (!disabled) {
                            api.page(halaman).draw('page');
                        }
                    });

                    pagination.append(tombol);
                }

                buatTombol('‹', info.page - 1, info.page === 0, false);

                let awal = Math.max(0, info.page - 2);
                let akhir = Math.min(info.pages - 1, info.page + 2);

                if (info.page <= 1) {
                    akhir = Math.min(info.pages - 1, 4);
                }

                if (info.page >= info.pages - 2) {
                    awal = Math.max(0, info.pages - 5);
                }

                for (let i = awal; i <= akhir; i++) {
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
                    info.page >= info.pages - 1,
                    false
                );

                // PERBARUI IKON FEATHER
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            }
        });

        // SEARCH TERPISAH DARI TABEL
        $('#cariGuru').on('input', function () {
            tabelGuru.search(this.value).draw();
        });

        // PILIH JUMLAH DATA
        $('#jumlahGuru').on('change', function () {
            tabelGuru.page.len(parseInt(this.value, 10)).draw();
        });

        // ALERT OTOMATIS HILANG SETELAH 3 DETIK
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
@endpush

@endsection
