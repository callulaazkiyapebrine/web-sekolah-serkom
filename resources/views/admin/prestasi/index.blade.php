@extends('admin')

@section('title', 'Kelola Prestasi - MAN 2 Tasikmalaya')

@section('content')

<div class="container-fluid py-4 prestasi-page">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 prestasi-header">
        <div>
            <h4 class="fw-bold mb-1">Data Prestasi</h4>
            <p class="text-muted mb-0">
                Kelola informasi prestasi dan pencapaian siswa sekolah.
            </p>
        </div>

        <a href="{{ route('admin.prestasi.addEdit') }}" class="btn btn-prestasi">
            <i data-feather="plus" class="me-1"></i>
            Tambah Prestasi Baru
        </a>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success prestasi-alert" id="successAlert">
            <i data-feather="check-circle" class="me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger prestasi-alert" id="errorAlert">
            <i data-feather="x-circle" class="me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- VALIDATION ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger prestasi-alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- CARD TABEL --}}
    <div class="card prestasi-card">

        <div class="card-header prestasi-card-header">
            <h5 class="mb-0">Daftar Prestasi</h5>
            <span>Informasi prestasi dan pencapaian yang terdaftar</span>
        </div>

        <div class="card-body">

            {{-- KONTROL TABEL --}}
            <div class="prestasi-controls">

                <div class="prestasi-length">
                    <label for="jumlahPrestasi">Tampilkan</label>

                    <select id="jumlahPrestasi">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                    <span>data</span>
                </div>

                <div class="prestasi-search">
                    <label for="cariPrestasi">Cari:</label>

                    <input
                        type="search"
                        id="cariPrestasi"
                        placeholder="Cari prestasi..."
                        autocomplete="off">
                </div>

            </div>

            {{-- AREA SCROLL TABEL SAJA --}}
            <div class="prestasi-table-wrapper">
                <table id="dataPrestasi" class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="text-center nomor-column">No</th>
                            <th>Nama Prestasi</th>
                            <th>Nama Pemenang</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th class="text-center gambar-column">Gambar</th>
                            <th class="text-center aksi-column">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($prestasi as $item)
                            <tr>
                                {{-- NOMOR --}}
                                <td class="text-center nomor-column">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- NAMA PRESTASI --}}
                                <td class="nama-prestasi">
                                    {{ $item->nama_prestasi ?? '-' }}
                                </td>

                                {{-- NAMA PEMENANG --}}
                                <td class="pemenang-prestasi">
                                    {{ $item->nama_pemenang ?? '-' }}
                                </td>

                                {{-- KETERANGAN --}}
                                <td class="keterangan-prestasi">
                                    {{ \Illuminate\Support\Str::limit($item->keterangan ?? '-', 70) }}
                                </td>

                                {{-- TANGGAL --}}
                                <td class="tanggal-prestasi">
                                    @if($item->tanggal)
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                {{-- GAMBAR --}}
                                <td class="text-center gambar-column">
                                    @if($item->gambar)
                                        <img
                                            src="{{ asset('storage/' . $item->gambar) }}"
                                            alt="{{ $item->nama_prestasi }}"
                                            class="foto-prestasi">
                                    @else
                                        <span class="text-muted">Tidak ada gambar</span>
                                    @endif
                                </td>

                                {{-- AKSI --}}
                                <td class="text-center aksi-column">
                                    <div class="prestasi-action-group">

                                        {{-- LIHAT --}}
                                        <a
                                            href="{{ route('admin.prestasi.show', Crypt::encrypt($item->id_prestasi)) }}"
                                            class="action-btn view-btn"
                                            title="Lihat"
                                            aria-label="Lihat prestasi">
                                            <i data-feather="eye"></i>
                                        </a>

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.prestasi.addEdit', Crypt::encrypt($item->id_prestasi)) }}"
                                            class="action-btn edit-btn"
                                            title="Edit"
                                            aria-label="Edit prestasi">
                                            <i data-feather="edit-3"></i>
                                        </a>

                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.prestasi.delete', Crypt::encrypt($item->id_prestasi)) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn delete-btn"
                                                title="Hapus"
                                                aria-label="Hapus prestasi">
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
            <div class="prestasi-footer">
                <div id="infoPrestasi"></div>
                <div id="paginationPrestasi"></div>
            </div>

        </div>
    </div>

</div>

<style>
    /* HALAMAN */
    .prestasi-page {
        padding-top: 5px !important;
        color: #1f2937;
    }

    /* HEADER */
    .prestasi-header h4 {
        color: #0b5d3b;
        font-size: 28px;
        font-weight: 700;
    }

    .prestasi-header p {
        color: #64746a !important;
        font-size: 14px;
    }

    /* TOMBOL TAMBAH */
    .prestasi-page .btn-prestasi {
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

    .prestasi-page .btn-prestasi:hover {
        background: #0b5d3b;
        border-color: #0b5d3b;
        color: #fff;
    }

    .prestasi-page .btn-prestasi svg {
        width: 17px;
        height: 17px;
    }

    /* ALERT */
    .prestasi-alert {
        display: flex;
        align-items: center;
        border-radius: 9px;
        font-size: 13px;
    }

    /* CARD */
    .prestasi-card {
        width: 100%;
        min-width: 0;
        border: 1px solid #dce9df;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 5px 20px rgba(11, 93, 59, .05);
    }

    .prestasi-card-header {
        background: #fff;
        padding: 18px 22px;
        border-bottom: 1px solid #e5eee8;
        border-radius: 14px 14px 0 0;
    }

    .prestasi-card-header h5 {
        color: #0b5d3b;
        font-weight: 700;
        font-size: 16px;
    }

    .prestasi-card-header span {
        display: block;
        margin-top: 4px;
        color: #7a887f;
        font-size: 13px;
    }

    .prestasi-card .card-body {
        padding: 22px;
        min-width: 0;
    }

    /* KONTROL TABEL */
    .prestasi-controls {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        width: 100%;
        margin-bottom: 18px;
    }

    .prestasi-length,
    .prestasi-search {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #49574e;
        font-size: 14px;
    }

    .prestasi-length {
        flex-shrink: 0;
    }

    .prestasi-length label,
    .prestasi-search label {
        margin: 0;
        white-space: nowrap;
    }

    .prestasi-length select {
        height: 36px;
        padding: 5px 9px;
        border: 1px solid #d5e2d9;
        border-radius: 7px;
        background: #fff;
        color: #49574e;
        outline: none;
    }

    .prestasi-search {
        justify-content: flex-end;
        margin-left: auto;
    }

    .prestasi-search input {
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

    .prestasi-search input:focus,
    .prestasi-length select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, .12);
    }

    /* AREA SCROLL TABEL SAJA */
    .prestasi-table-wrapper {
        display: block;
        width: 100%;
        max-width: 100%;
        min-width: 0;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
    }

    /* TABEL */
    #dataPrestasi {
        width: 100%;
        min-width: 1150px;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        table-layout: auto;
    }

    #dataPrestasi thead th {
        padding: 14px 12px !important;
        background: #198754 !important;
        color: #fff !important;
        border: none !important;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        vertical-align: middle;
    }

    #dataPrestasi tbody td {
        padding: 13px 12px !important;
        color: #49574e;
        border-bottom: 1px solid #edf2ee;
        font-size: 14px;
        line-height: 1.6;
        vertical-align: middle;
    }

    #dataPrestasi tbody tr {
        transition: background-color .2s ease;
    }

    #dataPrestasi tbody tr:hover td {
        background: #f5faf7 !important;
    }

    #dataPrestasi tbody tr:last-child td {
        border-bottom: none;
    }

    /* LEBAR KOLOM */
    #dataPrestasi .nomor-column {
        width: 60px;
        min-width: 60px;
        text-align: center;
        white-space: nowrap;
    }

    #dataPrestasi .nama-prestasi {
        min-width: 190px;
        color: #244b35 !important;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    #dataPrestasi .pemenang-prestasi {
        min-width: 170px;
        overflow-wrap: anywhere;
    }

    #dataPrestasi .keterangan-prestasi {
        min-width: 250px;
        max-width: 350px;
        overflow-wrap: anywhere;
    }

    #dataPrestasi .tanggal-prestasi {
        width: 150px;
        min-width: 150px;
        white-space: nowrap;
    }

    #dataPrestasi .gambar-column {
        width: 125px;
        min-width: 125px;
        white-space: nowrap;
    }

    #dataPrestasi .aksi-column {
        width: 150px;
        min-width: 150px;
        text-align: center;
        white-space: nowrap;
    }

    /* GAMBAR */
    .foto-prestasi {
        display: inline-block;
        width: 58px;
        height: 45px;
        object-fit: cover;
        border: 1px solid #e2eee7;
        border-radius: 7px;
        transition: transform .2s ease;
    }

    .foto-prestasi:hover {
        transform: scale(1.06);
    }

    /* TOMBOL AKSI */
    #dataPrestasi .prestasi-action-group {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        min-width: 120px;
        white-space: nowrap;
    }

    #dataPrestasi .prestasi-action-group form {
        display: inline-flex;
        flex: 0 0 auto;
        align-items: center;
        justify-content: center;
        margin: 0;
        padding: 0;
    }

    #dataPrestasi .action-btn {
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

    #dataPrestasi .action-btn svg {
        display: block;
        flex-shrink: 0;
        width: 16px;
        height: 16px;
    }

    #dataPrestasi .action-btn:hover {
        transform: translateY(-1px);
    }

    #dataPrestasi .view-btn:hover {
        color: #198754;
        border-color: #198754;
        background: #e8f6ee;
    }

    #dataPrestasi .edit-btn:hover {
        color: #b7791f;
        border-color: #e8c77b;
        background: #fff9e8;
    }

    #dataPrestasi .delete-btn:hover {
        color: #dc3545;
        border-color: #f1aeb5;
        background: #fff0f1;
    }

    /* FOOTER */
    .prestasi-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 18px;
    }

    #infoPrestasi {
        color: #64746a;
        font-size: 13px;
    }

    #paginationPrestasi {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 4px;
    }

    #paginationPrestasi .paginate-btn {
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

    #paginationPrestasi .paginate-btn.active {
        background: #198754;
        color: #fff;
        border-color: #198754;
    }

    #paginationPrestasi .paginate-btn:hover:not(:disabled):not(.active) {
        background: #e8f6ee;
        color: #0b5d3b;
        border-color: #cce5d5;
    }

    #paginationPrestasi .paginate-btn:disabled {
        color: #adb5bd;
        cursor: default;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .prestasi-header {
            align-items: flex-start !important;
            flex-wrap: wrap;
            gap: 12px;
        }

        .prestasi-header h4 {
            font-size: 23px;
        }

        .prestasi-card .card-body {
            padding: 14px;
        }

        .prestasi-controls {
            flex-direction: column;
            align-items: flex-start;
            gap: 14px;
        }

        .prestasi-search {
            width: 100%;
            margin-left: 0;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .prestasi-search input {
            width: 230px;
        }

        .prestasi-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        #paginationPrestasi {
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

        // CEGAH INISIALISASI DATATABLES BERULANG
        if ($.fn.DataTable.isDataTable('#dataPrestasi')) {
            $('#dataPrestasi').DataTable().destroy();
        }

        const tabelPrestasi = $('#dataPrestasi').DataTable({
            searching: true,
            ordering: true,
            paging: true,
            pageLength: 10,
            lengthChange: false,

            // Kontrol dibuat terpisah dari area tabel
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
                    width: '170px'
                },
                {
                    targets: 3,
                    width: '250px'
                },
                {
                    targets: 4,
                    width: '150px'
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
                emptyTable: 'Belum ada data prestasi',
                zeroRecords: 'Data prestasi tidak ditemukan'
            },

            drawCallback: function () {
                const api = this.api();
                const info = api.page.info();

                // INFORMASI DATA
                if (info.recordsDisplay === 0) {
                    $('#infoPrestasi').text('Tidak ada data yang ditampilkan');
                } else {
                    $('#infoPrestasi').text(
                        'Menampilkan ' +
                        (info.start + 1) + '–' +
                        info.end + ' dari ' +
                        info.recordsDisplay + ' data'
                    );
                }

                // PAGINATION
                const pagination = $('#paginationPrestasi');
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

                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            }
        });

        // SEARCH
        $('#cariPrestasi').on('input', function () {
            tabelPrestasi.search(this.value).draw();
        });

        // JUMLAH DATA
        $('#jumlahPrestasi').on('change', function () {
            tabelPrestasi.page.len(Number(this.value)).draw();
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
