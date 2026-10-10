@extends('admin')

@section('title', 'Kelola Data Berita - MAN 2 Tasikmalaya')

@section('content')

<div class="container-fluid py-4 berita-page">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 berita-header">
        <div>
            <h4 class="fw-bold mb-1">Data Berita</h4>
            <p class="text-muted mb-0">Kelola informasi dan publikasi berita sekolah.</p>
        </div>

        <a href="{{ route('admin.berita.addEdit') }}" class="btn btn-berita">
            <i data-feather="plus" class="me-1"></i>
            Tambah Berita Baru
        </a>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success berita-alert" id="successAlert">
            <i data-feather="check-circle" class="me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger berita-alert" id="errorAlert">
            <i data-feather="x-circle" class="me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- VALIDATION ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger berita-alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- CARD BERITA --}}
    <div class="card berita-card">

        <div class="card-header berita-card-header">
            <h5 class="mb-0">Daftar Berita</h5>
            <span>Informasi berita yang tersimpan dan dipublikasikan</span>
        </div>

        <div class="card-body">

            {{-- KONTROL DATATABLES --}}
            <div class="berita-controls">
                <div class="kontrol-jumlah">
                    <label for="jumlahBerita">Tampilkan</label>
                    <select id="jumlahBerita">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>data</span>
                </div>

                <div class="kontrol-search">
                    <label for="cariBerita">Cari:</label>
                    <input
                        type="search"
                        id="cariBerita"
                        placeholder="Cari berita..."
                        autocomplete="off">
                </div>
            </div>

            {{-- TABEL --}}
            <div class="berita-table-wrapper">
                <table id="dataBerita" class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th class="text-center">Gambar</th>
                            <th>Dibuat Oleh</th>
                            <th class="text-center kolom-aksi">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($berita as $item)
                            <tr>
                                {{-- NOMOR --}}
                                <td class="text-center nomor-column">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- JUDUL --}}
                                <td class="judul-berita">
                                    {{ $item->judul ?? '-' }}
                                </td>

                                {{-- ISI --}}
                                <td class="isi-berita">
                                    {{ \Illuminate\Support\Str::limit($item->isi ?? '-', 80) }}
                                </td>

                                {{-- TANGGAL --}}
                                <td class="tanggal-berita">
                                    @if($item->tanggal)
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                {{-- STATUS --}}
                                <td class="status-column">
                                    @if($item->status === 'publish')
                                        <span class="badge-status status-publish">
                                            Publish
                                        </span>
                                    @else
                                        <span class="badge-status status-draft">
                                            Draft
                                        </span>
                                    @endif
                                </td>

                                {{-- GAMBAR --}}
                                <td class="text-center gambar-column">
                                    @if($item->gambar)
                                        <img
                                            src="{{ asset('storage/' . $item->gambar) }}"
                                            alt="{{ $item->judul }}"
                                            class="berita-image">
                                    @else
                                        <span class="text-muted">Tidak ada gambar</span>
                                    @endif
                                </td>

                                {{-- DIBUAT OLEH --}}
                                <td class="dibuat-oleh">
                                    @if($item->user)
                                        <span class="badge-user">
                                            {{ ucfirst($item->user->role) }}
                                        </span>

                                        <div class="username">
                                            {{ $item->user->username }}
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                {{-- AKSI --}}
                                <td class="text-center kolom-aksi">
                                    <div class="grup-aksi">

                                        {{-- DETAIL --}}
                                        <a
                                            href="{{ route('admin.berita.show', Crypt::encrypt($item->id_berita)) }}"
                                            class="action-btn view-btn"
                                            title="Lihat"
                                            aria-label="Lihat berita">
                                            <i data-feather="eye"></i>
                                        </a>

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.berita.addEdit', Crypt::encrypt($item->id_berita)) }}"
                                            class="action-btn edit-btn"
                                            title="Edit"
                                            aria-label="Edit berita">
                                            <i data-feather="edit-3"></i>
                                        </a>

                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('admin.berita.delete', Crypt::encrypt($item->id_berita)) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn delete-btn"
                                                title="Hapus"
                                                aria-label="Hapus berita">
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
            <div class="berita-footer">
                <div id="infoBerita"></div>
                <div id="paginationBerita"></div>
            </div>

        </div>
    </div>
</div>

<style>
    /* HALAMAN */
    .berita-page {
        padding-top: 5px !important;
        color: #1f2937;
    }

    /* HEADER */
    .berita-header h4 {
        color: #0b5d3b;
        font-size: 28px;
        font-weight: 700;
    }

    .berita-header p {
        color: #64746a !important;
        font-size: 14px;
    }

    /* TOMBOL TAMBAH */
    .berita-page .btn-berita {
        display: inline-flex;
        align-items: center;
        justify-content: center;
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

    .berita-page .btn-berita:hover {
        background: #0b5d3b;
        border-color: #0b5d3b;
        color: #fff;
    }

    .berita-page .btn-berita svg {
        width: 17px;
        height: 17px;
    }

    /* ALERT */
    .berita-page .berita-alert {
        display: flex;
        align-items: center;
        border-radius: 9px;
        font-size: 13px;
    }

    /* CARD */
    .berita-page .berita-card {
        border: 1px solid #dce9df;
        border-radius: 14px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 5px 20px rgba(11, 93, 59, .05);
    }

    .berita-page .berita-card-header {
        background: #fff;
        padding: 18px 22px;
        border-bottom: 1px solid #e5eee8;
    }

    .berita-page .berita-card-header h5 {
        color: #0b5d3b;
        font-weight: 700;
        font-size: 16px;
    }

    .berita-page .berita-card-header span {
        display: block;
        margin-top: 4px;
        color: #7a887f;
        font-size: 13px;
    }

    .berita-page .berita-card .card-body {
        padding: 22px;
    }

    /* KONTROL: TIDAK IKUT SCROLL TABEL */
    .berita-controls {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        width: 100%;
        margin-bottom: 18px;
    }

    .kontrol-jumlah,
    .kontrol-search {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #49574e;
        font-size: 14px;
    }

    .kontrol-jumlah {
        flex-shrink: 0;
    }

    .kontrol-jumlah select {
        height: 36px;
        padding: 5px 9px;
        border: 1px solid #d5e2d9;
        border-radius: 7px;
        color: #49574e;
        background: #fff;
        outline: none;
    }

    .kontrol-search {
        justify-content: flex-end;
        margin-left: auto;
    }

    .kontrol-search label,
    .kontrol-jumlah label {
        margin: 0;
        white-space: nowrap;
    }

    .kontrol-search input {
        width: 230px;
        max-width: 100%;
        height: 38px;
        padding: 7px 12px;
        border: 1px solid #d5e2d9;
        border-radius: 8px;
        outline: none;
        background: #fff;
        color: #49574e;
        box-sizing: border-box;
    }

    .kontrol-search input:focus,
    .kontrol-jumlah select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, .12);
    }

    /* AREA SCROLL TABEL SAJA */
    .berita-table-wrapper {
        display: block;
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
    }

    /* TABEL */
    #dataBerita {
        width: 100%;
        min-width: 1200px;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        table-layout: auto;
    }

    /* HEADER TABEL */
    #dataBerita thead th {
        background: #198754 !important;
        background-color: #198754 !important;
        color: #fff !important;
        border: none !important;
        padding: 14px 12px !important;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        vertical-align: middle;
        opacity: 1 !important;
        box-shadow: none !important;
    }

    /* ISI TABEL */
    #dataBerita tbody td {
        padding: 13px 12px !important;
        color: #49574e;
        font-size: 14px;
        border-bottom: 1px solid #edf2ee;
        vertical-align: middle;
        line-height: 1.6;
    }

    #dataBerita tbody tr {
        transition: background-color .2s ease;
    }

    #dataBerita tbody tr:hover td {
        background: #f5faf7 !important;
    }

    #dataBerita tbody tr:last-child td {
        border-bottom: none;
    }

    /* KOLOM */
    #dataBerita .nomor-column {
        width: 55px;
        min-width: 55px;
        text-align: center;
        white-space: nowrap;
    }

    #dataBerita .judul-berita {
        min-width: 180px;
        color: #244b35 !important;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    #dataBerita .isi-berita {
        min-width: 240px;
        max-width: 350px;
        overflow-wrap: anywhere;
    }

    #dataBerita .tanggal-berita {
        width: 150px;
        min-width: 150px;
        white-space: nowrap;
    }

    #dataBerita .status-column {
        width: 110px;
        min-width: 110px;
        white-space: nowrap;
    }

    #dataBerita .gambar-column {
        min-width: 125px;
        white-space: nowrap;
    }

    #dataBerita .dibuat-oleh {
        min-width: 125px;
        overflow-wrap: anywhere;
    }

    #dataBerita thead th.kolom-aksi,
    #dataBerita tbody td.kolom-aksi {
        width: 160px;
        min-width: 160px;
        text-align: center;
        white-space: nowrap;
    }

    /* BADGE STATUS */
    #dataBerita .badge-status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    #dataBerita .status-publish {
        background: #e8f6ee;
        color: #166b3b;
    }

    #dataBerita .status-draft {
        background: #f1f3f5;
        color: #64748b;
    }

    /* GAMBAR */
    .berita-image {
        width: 58px;
        height: 45px;
        object-fit: cover;
        border-radius: 7px;
        border: 1px solid #e2eee7;
        transition: transform .2s ease;
    }

    .berita-image:hover {
        transform: scale(1.06);
    }

    /* PEMBUAT */
    .badge-user {
        display: inline-block;
        padding: 5px 9px;
        background: #e8f6ee;
        color: #166b3b;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    .username {
        margin-top: 5px;
        color: #64746a;
        font-size: 12px;
        overflow-wrap: anywhere;
    }

    /* TOMBOL AKSI */
    #dataBerita .grup-aksi {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        white-space: nowrap;
    }

    #dataBerita .grup-aksi form {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        padding: 0;
    }

    #dataBerita .action-btn {
        width: 36px;
        height: 36px;
        padding: 0;
        flex-shrink: 0;
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

    #dataBerita .action-btn svg {
        width: 16px;
        height: 16px;
    }

    #dataBerita .action-btn:hover {
        transform: translateY(-1px);
    }

    #dataBerita .view-btn:hover {
        color: #198754;
        border-color: #198754;
        background: #e8f6ee;
    }

    #dataBerita .edit-btn:hover {
        color: #b7791f;
        border-color: #e8c77b;
        background: #fff9e8;
    }

    #dataBerita .delete-btn:hover {
        color: #dc3545;
        border-color: #f1aeb5;
        background: #fff0f1;
    }

    /* FOOTER TABEL */
    .berita-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 18px;
    }

    #infoBerita {
        color: #64746a;
        font-size: 13px;
    }

    #paginationBerita {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 4px;
    }

    #paginationBerita .paginate_button {
        display: inline-block;
        padding: 6px 11px;
        border: 1px solid transparent;
        border-radius: 6px;
        color: #49574e;
        cursor: pointer;
        font-size: 13px;
    }

    #paginationBerita .paginate_button.current {
        background: #198754;
        color: #fff;
        border-color: #198754;
    }

    #paginationBerita .paginate_button:hover:not(.current):not(.disabled) {
        background: #e8f6ee;
        color: #0b5d3b;
        border-color: #cce5d5;
    }

    #paginationBerita .paginate_button.disabled {
        color: #adb5bd;
        cursor: default;
    }

    /* RESPONSIF */
    @media (max-width: 768px) {
        .berita-header {
            align-items: flex-start !important;
            gap: 12px;
            flex-wrap: wrap;
        }

        .berita-header h4 {
            font-size: 23px;
        }

        .berita-page .berita-card .card-body {
            padding: 14px;
        }

        .berita-controls {
            align-items: flex-start;
            flex-direction: column;
            gap: 14px;
        }

        .kontrol-search {
            width: 100%;
            margin-left: 0;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .kontrol-search input {
            width: 230px;
        }

        .berita-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        #paginationBerita {
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

        // Hindari inisialisasi ganda
        if ($.fn.DataTable.isDataTable('#dataBerita')) {
            $('#dataBerita').DataTable().destroy();
        }

        const tabelBerita = $('#dataBerita').DataTable({
            searching: true,
            ordering: true,
            paging: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            autoWidth: false,

            // Gunakan kontrol terpisah di luar tabel
            dom: 'rt',

            columnDefs: [
                {
                    targets: 0,
                    width: '55px',
                    className: 'text-center'
                },
                {
                    targets: 1,
                    width: '180px'
                },
                {
                    targets: 2,
                    width: '260px'
                },
                {
                    targets: 3,
                    width: '150px'
                },
                {
                    targets: 4,
                    width: '110px'
                },
                {
                    targets: 5,
                    width: '125px',
                    orderable: false
                },
                {
                    targets: 6,
                    width: '125px'
                },
                {
                    targets: 7,
                    width: '160px',
                    orderable: false
                }
            ],

            language: {
                emptyTable: 'Belum ada data berita',
                zeroRecords: 'Data berita tidak ditemukan'
            },

            drawCallback: function () {
                const api = this.api();
                const info = api.page.info();

                // Informasi jumlah data
                if (info.recordsDisplay === 0) {
                    $('#infoBerita').text('Tidak ada data yang ditampilkan');
                } else {
                    $('#infoBerita').text(
                        'Menampilkan ' +
                        (info.start + 1) + '–' +
                        info.end + ' dari ' +
                        info.recordsDisplay + ' data'
                    );
                }

                // Pagination
                const pagination = $('#paginationBerita');
                pagination.empty();

                function buatTombol(teks, halaman, disabled, aktif) {
                    const tombol = $('<button>', {
                        type: 'button',
                        class: 'paginate_button'
                            + (aktif ? ' current' : '')
                            + (disabled ? ' disabled' : ''),
                        text: teks
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

        // PENCARIAN DI AREA TERPISAH
        $('#cariBerita').on('input', function () {
            tabelBerita.search(this.value).draw();
        });

        // JUMLAH DATA
        $('#jumlahBerita').on('change', function () {
            tabelBerita.page.len(Number(this.value)).draw();
        });

        // ALERT HILANG OTOMATIS
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

@endsection
