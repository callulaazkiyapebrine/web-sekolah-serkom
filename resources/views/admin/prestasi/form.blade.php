@extends('admin')

@section('title', isset($prestasi) ? 'Edit Prestasi' : 'Tambah Prestasi')

@section('content')

<style>
    .prestasi-page {
        font-family: 'Poppins', sans-serif;
        padding: 8px 0 24px;
    }

    .prestasi-page .page-title {
        color: #198754;
        font-size: 25px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .prestasi-page .page-description {
        color: #748178;
        font-size: 14px;
        margin: 0;
    }

    .prestasi-page .form-card {
        background: #fff;
        border: 1px solid #e0e9e3;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(25, 135, 84, 0.06);
        overflow: hidden;
    }

    .prestasi-page .form-card-header {
        padding: 18px 24px;
        background: #f5f9f6;
        border-bottom: 1px solid #e0e9e3;
    }

    .prestasi-page .form-card-header h5 {
        color: #198754;
        font-size: 16px;
        font-weight: 700;
        margin: 0;
    }

    .prestasi-page .form-card-body {
        padding: 26px 24px;
    }

    .prestasi-page .form-label {
        display: block;
        color: #34483b;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .prestasi-page .required-mark {
        color: #dc3545;
    }

    .prestasi-page .form-control {
        min-height: 43px;
        border: 1px solid #d9e3dc;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        color: #34483b;
        box-shadow: none;
    }

    .prestasi-page textarea.form-control {
        min-height: 150px;
        resize: vertical;
        line-height: 1.7;
    }

    .prestasi-page .form-control:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.1);
    }

    .prestasi-page .form-control::placeholder {
        color: #a0aaa3;
    }

    .prestasi-page .form-text {
        display: block;
        margin-top: 7px;
        color: #7a887e;
        font-size: 12px;
        line-height: 1.6;
    }

    .prestasi-page .invalid-feedback {
        font-size: 12px;
    }

    .prestasi-page .current-image {
        display: inline-block;
        margin-top: 16px;
        padding: 12px;
        background: #f5f9f6;
        border: 1px solid #e0e9e3;
        border-radius: 9px;
    }

    .prestasi-page .current-image-label {
        display: block;
        margin-bottom: 9px;
        color: #53665a;
        font-size: 12px;
        font-weight: 600;
    }

    .prestasi-page .current-image img {
        display: block;
        width: 160px;
        height: 110px;
        object-fit: cover;
        border: 1px solid #dce6df;
        border-radius: 8px;
    }

    .prestasi-page .form-actions {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #edf1ee;
    }

    .prestasi-page .btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 7px;
        min-height: 40px;
        padding: 9px 17px;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: background-color 0.2s ease;
    }

    .prestasi-page .btn-back {
        background: #fff;
        color: #526258;
        border: 1px solid #dce5de;
    }

    .prestasi-page .btn-back:hover {
        background: #f0f5f1;
        color: #198754;
    }

    .prestasi-page .btn-save {
        background: #198754;
        border: 1px solid #198754;
        color: #fff;
    }

    .prestasi-page .btn-save:hover {
        background: #146c43;
        border-color: #146c43;
        color: #fff;
    }

    .prestasi-page .btn svg {
        width: 16px;
        height: 16px;
    }

    @media (max-width: 576px) {
        .prestasi-page {
            padding-top: 8px;
        }

        .prestasi-page .page-title {
            font-size: 21px;
        }

        .prestasi-page .form-card-header {
            padding: 16px;
        }

        .prestasi-page .form-card-body {
            padding: 18px 16px;
        }

        .prestasi-page .form-actions {
            flex-direction: column-reverse;
        }

        .prestasi-page .form-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="container prestasi-page">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h1 class="page-title">
                {{ isset($prestasi) ? 'Edit Prestasi' : 'Tambah Prestasi' }}
            </h1>

            <p class="page-description">
                {{ isset($prestasi)
                    ? 'Perbarui data prestasi sekolah.'
                    : 'Tambahkan data prestasi sekolah.' }}
            </p>
        </div>

        <a href="{{ route('admin.prestasi.index') }}" class="btn btn-back">
            <i data-feather="arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- FORM --}}
    <div class="form-card">

        <div class="form-card-header">
            <h5>
                {{ isset($prestasi) ? 'Form Edit Prestasi' : 'Form Prestasi Baru' }}
            </h5>
        </div>

        <div class="form-card-body">

            <form action="{{ route('admin.prestasi.save') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                {{-- ID PRESTASI SAAT EDIT --}}
                @if(isset($prestasi))
                    <input type="hidden"
                           name="id_prestasi"
                           value="{{ Crypt::encrypt($prestasi->id_prestasi) }}">
                @endif

                <div class="row g-4">

                    {{-- NAMA PRESTASI --}}
                    <div class="col-12">
                        <label for="nama_prestasi" class="form-label">
                            Nama Prestasi <span class="required-mark">*</span>
                        </label>

                        <input type="text"
                               id="nama_prestasi"
                               name="nama_prestasi"
                               class="form-control @error('nama_prestasi') is-invalid @enderror"
                               value="{{ old('nama_prestasi', $prestasi->nama_prestasi ?? '') }}"
                               placeholder="Contoh: Juara 1 Olimpiade Matematika"
                               required>

                        @error('nama_prestasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NAMA PEMENANG --}}
                    <div class="col-md-6">
                        <label for="nama_pemenang" class="form-label">
                            Nama Pemenang <span class="required-mark">*</span>
                        </label>

                        <input type="text"
                               id="nama_pemenang"
                               name="nama_pemenang"
                               class="form-control @error('nama_pemenang') is-invalid @enderror"
                               value="{{ old('nama_pemenang', $prestasi->nama_pemenang ?? '') }}"
                               placeholder="Nama siswa atau tim pemenang"
                               required>

                        @error('nama_pemenang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TANGGAL --}}
                    <div class="col-md-6">
                        <label for="tanggal" class="form-label">
                            Tanggal <span class="required-mark">*</span>
                        </label>

                        <input type="date"
                               id="tanggal"
                               name="tanggal"
                               class="form-control @error('tanggal') is-invalid @enderror"
                               value="{{ old('tanggal', isset($prestasi) && $prestasi->tanggal
                                   ? \Carbon\Carbon::parse($prestasi->tanggal)->format('Y-m-d')
                                   : '') }}"
                               required>

                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KETERANGAN --}}
                    <div class="col-12">
                        <label for="keterangan" class="form-label">
                            Keterangan <span class="required-mark">*</span>
                        </label>

                        <textarea id="keterangan"
                                  name="keterangan"
                                  rows="5"
                                  class="form-control @error('keterangan') is-invalid @enderror"
                                  placeholder="Masukkan keterangan prestasi..."
                                  required>{{ old('keterangan', $prestasi->keterangan ?? '') }}</textarea>

                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- GAMBAR --}}
                    <div class="col-12">
                        <label for="gambar" class="form-label">
                            {{ isset($prestasi) ? 'Ganti Gambar' : 'Gambar Prestasi' }}

                            @if(!isset($prestasi))
                                <span class="required-mark">*</span>
                            @endif
                        </label>

                        <input type="file"
                               id="gambar"
                               name="gambar"
                               class="form-control @error('gambar') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                               {{ isset($prestasi) ? '' : 'required' }}>

                        <small class="form-text">
                            Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.

                            @if(isset($prestasi))
                                <br>Biarkan kosong jika tidak ingin mengganti gambar.
                            @endif
                        </small>

                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- GAMBAR LAMA --}}
                        @if(isset($prestasi) && $prestasi->gambar)
                            @if(file_exists(public_path('storage/' . $prestasi->gambar)))
                                <div class="current-image">
                                    <span class="current-image-label">
                                        Gambar saat ini
                                    </span>

                                    <img src="{{ asset('storage/' . $prestasi->gambar) }}"
                                         alt="{{ $prestasi->nama_prestasi }}">
                                </div>
                            @endif
                        @endif
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="form-actions">
                    <a href="{{ route('admin.prestasi.index') }}" class="btn btn-back">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-save">
                        <i data-feather="save"></i>
                        {{ isset($prestasi) ? 'Simpan Perubahan' : 'Simpan Prestasi' }}
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>

@endsection
