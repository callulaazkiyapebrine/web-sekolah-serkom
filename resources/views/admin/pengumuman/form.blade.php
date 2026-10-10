@extends('admin')

@section('title', isset($pengumuman) ? 'Edit Pengumuman' : 'Tambah Pengumuman')

@section('content')

<style>
    .pengumuman-page {
        font-family: 'Poppins', sans-serif;
        padding: 8px 0 24px;
    }

    .pengumuman-page .page-title {
        color: #198754;
        font-size: 25px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .pengumuman-page .page-description {
        color: #748178;
        font-size: 14px;
        margin: 0;
    }

    .pengumuman-page .form-card {
        background: #fff;
        border: 1px solid #e0e9e3;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(25, 135, 84, 0.06);
        overflow: hidden;
    }

    .pengumuman-page .form-card-header {
        padding: 18px 24px;
        background: #f5f9f6;
        border-bottom: 1px solid #e0e9e3;
    }

    .pengumuman-page .form-card-header h5 {
        color: #198754;
        font-size: 16px;
        font-weight: 700;
        margin: 0;
    }

    .pengumuman-page .form-card-body {
        padding: 26px 24px;
    }

    .pengumuman-page .form-label {
        display: block;
        color: #34483b;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .pengumuman-page .required-mark {
        color: #dc3545;
    }

    .pengumuman-page .form-control,
    .pengumuman-page .form-select {
        min-height: 43px;
        border: 1px solid #d9e3dc;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        color: #34483b;
        box-shadow: none;
    }

    .pengumuman-page textarea.form-control {
        min-height: 180px;
        resize: vertical;
        line-height: 1.7;
    }

    .pengumuman-page .form-control:focus,
    .pengumuman-page .form-select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.1);
    }

    .pengumuman-page .form-control::placeholder {
        color: #a0aaa3;
    }

    .pengumuman-page .form-text {
        display: block;
        margin-top: 7px;
        color: #7a887e;
        font-size: 12px;
        line-height: 1.6;
    }

    .pengumuman-page .invalid-feedback {
        font-size: 12px;
    }

    .pengumuman-page .alert {
        border-radius: 9px;
        font-size: 13px;
    }

    .pengumuman-page .form-actions {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #edf1ee;
    }

    .pengumuman-page .btn {
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

    .pengumuman-page .btn-back {
        background: #fff;
        color: #526258;
        border: 1px solid #dce5de;
    }

    .pengumuman-page .btn-back:hover {
        background: #f0f5f1;
        color: #198754;
    }

    .pengumuman-page .btn-save {
        background: #198754;
        border: 1px solid #198754;
        color: #fff;
    }

    .pengumuman-page .btn-save:hover {
        background: #146c43;
        border-color: #146c43;
        color: #fff;
    }

    .pengumuman-page .btn svg {
        width: 16px;
        height: 16px;
    }

    @media (max-width: 576px) {
        .pengumuman-page {
            padding-top: 8px;
        }

        .pengumuman-page .page-title {
            font-size: 21px;
        }

        .pengumuman-page .form-card-header {
            padding: 16px;
        }

        .pengumuman-page .form-card-body {
            padding: 18px 16px;
        }

        .pengumuman-page .form-actions {
            flex-direction: column-reverse;
        }

        .pengumuman-page .form-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="container pengumuman-page">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h1 class="page-title">
                {{ isset($pengumuman) ? 'Edit Pengumuman' : 'Tambah Pengumuman' }}
            </h1>

            <p class="page-description">
                {{ isset($pengumuman)
                    ? 'Perbarui informasi pengumuman sekolah.'
                    : 'Tambahkan informasi pengumuman sekolah.' }}
            </p>
        </div>

        <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-back">
            <i data-feather="arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger">
            <i data-feather="x-circle" class="me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- FORM --}}
    <div class="form-card">

        <div class="form-card-header">
            <h5>
                {{ isset($pengumuman) ? 'Form Edit Pengumuman' : 'Form Pengumuman Baru' }}
            </h5>
        </div>

        <div class="form-card-body">

            <form action="{{ route('admin.pengumuman.save') }}" method="POST">
                @csrf

                {{-- ID PENGUMUMAN SAAT EDIT --}}
                @if(isset($pengumuman))
                    <input type="hidden"
                           name="id_pengumuman"
                           value="{{ Crypt::encrypt($pengumuman->id_pengumuman) }}">
                @endif

                <div class="row g-4">

                    {{-- JUDUL --}}
                    <div class="col-12">
                        <label for="judul" class="form-label">
                            Judul Pengumuman <span class="required-mark">*</span>
                        </label>

                        <input type="text"
                               id="judul"
                               name="judul"
                               class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul', $pengumuman->judul ?? '') }}"
                               placeholder="Masukkan judul pengumuman"
                               maxlength="200"
                               required>

                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TANGGAL --}}
                    <div class="col-md-6">
                        <label for="tanggal" class="form-label">
                            Tanggal Pengumuman <span class="required-mark">*</span>
                        </label>

                        <input type="date"
                               id="tanggal"
                               name="tanggal"
                               class="form-control @error('tanggal') is-invalid @enderror"
                               value="{{ old('tanggal', isset($pengumuman) && $pengumuman->tanggal
                                   ? \Carbon\Carbon::parse($pengumuman->tanggal)->format('Y-m-d')
                                   : date('Y-m-d')) }}"
                               required>

                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-6">
                        <label for="status" class="form-label">
                            Status Publikasi <span class="required-mark">*</span>
                        </label>

                        <select id="status"
                                name="status"
                                class="form-select @error('status') is-invalid @enderror"
                                required>

                            <option value="">Pilih status</option>

                            <option value="draft"
                                {{ old('status', $pengumuman->status ?? 'draft') == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>

                            <option value="publish"
                                {{ old('status', $pengumuman->status ?? '') == 'publish' ? 'selected' : '' }}>
                                Publish
                            </option>
                        </select>

                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <small class="form-text">
                            Draft tidak ditampilkan di halaman publik.
                        </small>
                    </div>

                    {{-- ISI PENGUMUMAN --}}
                    <div class="col-12">
                        <label for="isi" class="form-label">
                            Isi Pengumuman <span class="required-mark">*</span>
                        </label>

                        <textarea id="isi"
                                  name="isi"
                                  rows="6"
                                  class="form-control @error('isi') is-invalid @enderror"
                                  placeholder="Tuliskan isi pengumuman secara lengkap..."
                                  required>{{ old('isi', $pengumuman->isi ?? '') }}</textarea>

                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="form-actions">
                    <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-back">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-save">
                        <i data-feather="save"></i>
                        {{ isset($pengumuman) ? 'Simpan Perubahan' : 'Simpan Pengumuman' }}
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
