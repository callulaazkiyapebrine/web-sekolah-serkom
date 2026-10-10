
@extends('admin')

@section('title', 'Kelola Data Siswa - MAN 2 Tasikmalaya')

@section('content')

<div class="container-fluid py-4 siswa-page">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 siswa-header">
        <div>
            <h4 class="fw-bold mb-1">Data Siswa</h4>
            <p class="text-muted mb-0">
                Kelola informasi dan data siswa sekolah.
            </p>
        </div>

        @if(Auth::user()->role == 'admin')
        <a href="{{ route('admin.siswa.addEdit') }}" class="btn btn-siswa">
            <i data-feather="plus" class="me-1"></i>
            Tambah Siswa Baru
        </a>
        @endif
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
    <div class="alert alert-success siswa-alert" id="successAlert">
        <i data-feather="check-circle" class="me-2"></i>
        {{ session('success') }}
    </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
    <div class="alert alert-danger siswa-alert" id="errorAlert">
        <i data-feather="x-circle" class="me-2"></i>
        {{ session('error') }}
    </div>
    @endif

    {{-- CARD TABEL --}}
    <div class="card siswa-card">

        <div class="card-header siswa-card-header">
            <h5 class="mb-0">Daftar Siswa</h5>
            <span>Informasi siswa yang terdaftar di sekolah</span>
        </div>

        <div class="card-body">

            {{-- KONTROL TABEL: TIDAK IKUT SCROLL --}}
            <div class="siswa-table-controls">
                <div class="siswa-length-control">
                    <label for="jumlahSiswa">Tampilkan</label>

                    <select id="jumlahSiswa" class="form-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                    <span>data</span>
                </div>

                <div class="siswa-search-control">
                    <label for="cariSiswa">Cari siswa</label>

                    <div class="siswa-search-box">
                        <i data-feather="search"></i>
                        <input
                            type="search"
                            id="cariSiswa"
                            placeholder="Cari NISN atau nama siswa..."
                            autocomplete="off">
                    </div>
                </div>
            </div>

            {{-- HANYA TABEL YANG BISA SCROLL HORIZONTAL --}}
            <div class="siswa-table-scroll">
                <table id="dataSiswa" class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>Tahun Masuk</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($siswas as $item)
                        <tr>
                            <td class="text-center nomor-column"></td>

                            <td class="nisn-column">
                                {{ $item->nisn }}
                            </td>

                            <td class="nama-siswa">
                                {{ $item->nama_siswa }}
                            </td>

                            <td>
                                @if($item->jenis_kelamin === 'laki-laki')
                                <span class="badge-jk">Laki-laki</span>
                                @else
                                <span class="badge-jk">Perempuan</span>
                                @endif
                            </td>

                            <td>
                                {{ $item->tahun_masuk ?? '-' }}
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-1 aksi-wrapper">

                                    {{-- DETAIL --}}
                                    <a
                                        href="{{ route('admin.siswa.show', Crypt::encrypt($item->id_siswa)) }}"
                                        class="action-btn view-btn"
                                        title="Lihat detail">
                                        <i data-feather="eye"></i>
                                    </a>

                                    @if(Auth::user()->role == 'admin')

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.siswa.addEdit', Crypt::encrypt($item->id_siswa)) }}"
                                        class="action-btn edit-btn"
                                        title="Edit siswa">
                                        <i data-feather="edit-3"></i>
                                    </a>

                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('admin.siswa.delete', Crypt::encrypt($item->id_siswa)) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-btn delete-btn"
                                            title="Hapus siswa">
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
            <div class="siswa-table-footer">
                <div id="infoSiswa" class="siswa-table-info"></div>
                <div id="paginationSiswa" class="siswa-pagination"></div>
            </div>

        </div>
    </div>
</div>

<style>
    /* HALAMAN */
    .siswa-page {
        padding-top: 5px !important;
        color: #1f2937;
    }

    /* HEADER */
    .siswa-header h4 {
        color: #0b5d3b;
        font-size: 28px;
        font-weight: 700;
    }

    .siswa-header p {
        color: #64746a !important;
        font-size: 14px;
    }

    /* TOMBOL TAMBAH */
    .siswa-page .btn-siswa {
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

    .siswa-page .btn-siswa:hover {
        background: #0b5d3b;
        border-color: #0b5d3b;
        color: #fff;
    }

    .siswa-page .btn-siswa svg {
        width: 17px;
        height: 17px;
    }

    /* ALERT */
    .siswa-alert {
        display: flex;
        align-items: center;
        border-radius: 9px;
        font-size: 13px;
    }

    .siswa-alert svg {
        width: 17px;
        height: 17px;
        flex-shrink: 0;
    }

    /* CARD */
    .siswa-card {
        border: 1px solid #dce9df;
        border-radius: 14px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 5px 20px rgba(11, 93, 59, .05);
    }

    .siswa-card-header {
        background: #fff;
        padding: 18px 22px;
        border-bottom: 1px solid #e5eee8;
    }

    .siswa-card-header h5 {
        color: #0b5d3b;
        font-weight: 700;
        font-size: 16px;
    }

    .siswa-card-header span {
        display: block;
        color: #7a887f;
        font-size: 13px;
        margin-top: 4px;
    }

    .siswa-card .card-body {
        padding: 22px;
    }

    /* KONTROL SEARCH DAN JUMLAH DATA */
    .siswa-table-controls {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .siswa-length-control,
    .siswa-search-control {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #64746a;
        font-size: 13px;
    }

    .siswa-length-control {
        white-space: nowrap;
    }

    .siswa-length-control .form-select {
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

    .siswa-length-control .form-select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, .10);
    }

    .siswa-search-control {
        flex-direction: column;
        align-items: flex-start;
        gap: 6px;
        min-width: 280px;
    }

    .siswa-search-control label {
        font-weight: 600;
        color: #49574e;
    }

    .siswa-search-box {
        position: relative;
        width: 290px;
        max-width: 100%;
    }

    .siswa-search-box > svg {
        position: absolute;
        top: 50%;
        left: 12px;
        width: 16px;
        height: 16px;
        color: #829087;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .siswa-search-box input {
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

    .siswa-search-box input:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, .10);
    }

    /* AREA SCROLL TABEL */
    .siswa-table-scroll {
        width: 100%;
        overflow-x: auto;
        overflow-y: hidden;
        border: 1px solid #e5eee8;
        border-radius: 9px;
        scrollbar-width: thin;
        scrollbar-color: #b9d5c3 #f2f7f3;
    }

    .siswa-table-scroll::-webkit-scrollbar {
        height: 8px;
    }

    .siswa-table-scroll::-webkit-scrollbar-track {
        background: #f2f7f3;
        border-radius: 8px;
    }

    .siswa-table-scroll::-webkit-scrollbar-thumb {
        background: #b9d5c3;
        border-radius: 8px;
    }

    /* TABEL */
    #dataSiswa {
        width: 100% !important;
        min-width: 900px;
        table-layout: fixed !important;
        border-collapse: separate;
        border-spacing: 0;
        margin: 0 !important;
    }

    #dataSiswa th:nth-child(1),
    #dataSiswa td:nth-child(1) {
        width: 65px !important;
    }

    #dataSiswa th:nth-child(2),
    #dataSiswa td:nth-child(2) {
        width: 150px !important;
    }

    #dataSiswa th:nth-child(3),
    #dataSiswa td:nth-child(3) {
        width: 260px !important;
    }

    #dataSiswa th:nth-child(4),
    #dataSiswa td:nth-child(4) {
        width: 170px !important;
    }

    #dataSiswa th:nth-child(5),
    #dataSiswa td:nth-child(5) {
        width: 135px !important;
    }

    #dataSiswa th:nth-child(6),
    #dataSiswa td:nth-child(6) {
        width: 120px !important;
    }

    #dataSiswa thead th {
        background: #198754 !important;
        color: #fff !important;
        font-size: 13px;
        font-weight: 600;
        padding: 14px 12px !important;
        border: none !important;
        white-space: nowrap;
        vertical-align: middle;
    }

    #dataSiswa tbody td {
        padding: 13px 12px !important;
        color: #49574e;
        font-size: 13px;
        border-bottom: 1px solid #edf2ee;
        vertical-align: middle;
        line-height: 1.6;
        overflow-wrap: anywhere;
        background: #fff;
    }

    #dataSiswa tbody tr:hover td {
        background: #f5faf7 !important;
    }

    #dataSiswa tbody tr:last-child td {
        border-bottom: none;
    }

    #dataSiswa .nomor-column {
        color: #64746a;
        font-weight: 600;
    }

    #dataSiswa .nisn-column {
        white-space: nowrap;
        font-family: Arial, sans-serif;
        letter-spacing: .2px;
    }

    #dataSiswa .nama-siswa {
        color: #244b35 !important;
        font-weight: 600;
    }

    #dataSiswa td:nth-child(4),
    #dataSiswa td:nth-child(5) {
        white-space: nowrap;
    }

    /* BADGE JENIS KELAMIN */
    .badge-jk {
        display: inline-block;
        background: #e8f6ee;
        color: #166b3b;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* TOMBOL AKSI */
    #dataSiswa .aksi-wrapper {
        white-space: nowrap;
    }

    #dataSiswa .action-btn {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #dce9df;
        border-radius: 8px;
        background: #fff;
        color: #64746a;
        cursor: pointer;
        text-decoration: none;
        transition: .2s;
    }

    #dataSiswa .action-btn svg {
        width: 15px;
        height: 15px;
    }

    #dataSiswa .action-btn:hover {
        transform: translateY(-1px);
    }

    #dataSiswa .view-btn:hover {
        color: #198754;
        border-color: #198754;
        background: #e8f6ee;
    }

    #dataSiswa .edit-btn:hover {
        color: #b7791f;
        border-color: #e8c77b;
        background: #fff9e8;
    }

    #dataSiswa .delete-btn:hover {
        color: #dc3545;
        border-color: #f1aeb5;
        background: #fff0f1;
    }

    /* FOOTER TABEL */
    .siswa-table-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 18px;
    }

    .siswa-table-info {
        color: #64746a;
        font-size: 13px;
    }

    .siswa-pagination {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 4px;
    }

    .siswa-pagination .page-btn {
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

    .siswa-pagination .page-btn:hover:not(:disabled) {
        background: #e8f6ee;
        color: #0b5d3b;
        border-color: #b9d9c4;
    }

    .siswa-pagination .page-btn.active {
        background: #198754;
        color: #fff;
        border-color: #198754;
    }

    .siswa-pagination .page-btn:disabled {
        opacity: .4;
        cursor: not-allowed;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .siswa-header {
            align-items: flex-start !important;
            flex-wrap: wrap;
            gap: 12px;
        }

        .siswa-header h4 {
            font-size: 23px;
        }

        .siswa-card .card-body {
            padding: 14px;
        }

        .siswa-table-controls {
            align-items: stretch;
            flex-direction: column;
            gap: 15px;
        }

        .siswa-search-control,
        .siswa-search-box {
            width: 100%;
            min-width: 0;
        }

        .siswa-table-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        .siswa-pagination {
            justify-content: flex-start;
        }
    }

    @media (max-width: 420px) {
        .siswa-page .btn-siswa {
            font-size: 12px;
            padding: 8px 10px;
        }

        .siswa-card-header {
            padding: 16px;
        }

        .siswa-card .card-body {
            padding: 12px;
        }

        .siswa-table-info {
            font-size: 12px;
        }
    }
</style>

@push('scripts')
<script>
    $(document).ready(function () {

        // CEGAH DATATABLES DIINISIALISASI BERULANG
        if ($.fn.DataTable.isDataTable('#dataSiswa')) {
            $('#dataSiswa').DataTable().destroy();
        }

        const tabelSiswa = $('#dataSiswa').DataTable({
            searching: true,
            ordering: true,
            paging: true,
            pagingType: 'simple_numbers',
            pageLength: 10,
            lengthChange: true,
            lengthMenu: [10, 25, 50, 100],
            autoWidth: false,

            // HANYA TABEL; KONTROL DIBUAT TERPISAH
            dom: 't',

            order: [[2, 'asc']],

            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
                {
                    targets: 1,
                    className: 'nisn-column'
                },
                {
                    targets: 5,
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                }
            ],

            language: {
                zeroRecords: 'Data siswa tidak ditemukan',
                emptyTable: 'Belum ada data siswa'
            },

            drawCallback: function () {
                const api = this.api();
                const info = api.page.info();

                // NOMOR URUT MENGIKUTI HALAMAN DATATABLES
                api.rows({
                    page: 'current'
                }).every(function (rowIdx, tableLoop, rowLoop) {
                    $(this.node()).find('.nomor-column').text(info.start + rowLoop + 1);
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
                    teksInfo += ' (disaring dari ' + info.recordsTotal + ' total data)';
                }

                $('#infoSiswa').text(teksInfo);

                // PAGINATION CUSTOM
                const pagination = $('#paginationSiswa');
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
            }
        });

        // SEARCH TERPISAH DARI AREA SCROLL
        $('#cariSiswa').on('input', function () {
            tabelSiswa.search(this.value).draw();
        });

        // PILIH JUMLAH DATA
        $('#jumlahSiswa').on('change', function () {
            tabelSiswa.page.len(parseInt(this.value, 10)).draw();
        });

        // ALERT OTOMATIS HILANG SETELAH 3 DETIK
        setTimeout(function () {
            $('#successAlert, #errorAlert').fadeOut(300, function () {
                $(this).remove();
            });
        }, 3000);

        // IKON
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>
@endpush

@endsection
