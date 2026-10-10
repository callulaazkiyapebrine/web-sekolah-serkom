@extends('admin')

@section('title', isset($berita) ? 'Edit Berita' : 'Tambah Berita')

@section('content')

<style>
    .berita-page {
        font-family: 'Poppins', sans-serif;
        padding: 8px 0 24px;
    }

    .berita-page .page-title {
        color: #198754;
        font-size: 25px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .berita-page .page-description {
        color: #748178;
        font-size: 14px;
        margin: 0;
    }

    .berita-page .form-card {
        background: #fff;
        border: 1px solid #e0e9e3;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(25, 135, 84, 0.06);
        overflow: hidden;
    }

    .berita-page .form-card-header {
        padding: 18px 24px;
        background: #f5f9f6;
        border-bottom: 1px solid #e0e9e3;
    }

    .berita-page .form-card-header h5 {
        color: #198754;
        font-size: 16px;
        font-weight: 700;
        margin: 0;
    }

    .berita-page .form-card-body {
        padding: 26px 24px;
    }

    .berita-page .form-label {
        color: #34483b;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .berita-page .required-mark {
        color: #dc3545;
    }

    .berita-page .form-control,
    .berita-page .form-select {
        min-height: 43px;
        border: 1px solid #d9e3dc;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        color: #34483b;
        box-shadow: none;
    }

    .berita-page textarea.form-control {
        min-height: 180px;
        resize: vertical;
        line-height: 1.7;
    }

    .berita-page .form-control:focus,
    .berita-page .form-select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.1);
    }

    .berita-page .form-control::placeholder {
        color: #a0aaa3;
    }

    .berita-page .form-text {
        display: block;
        margin-top: 7px;
        color: #7a887e;
        font-size: 12px;
        line-height: 1.6;
    }

    .berita-page .invalid-feedback {
        font-size: 12px;
    }

    .berita-page .current-image {
        margin-top: 16px;
        padding: 12px;
        background: #f5f9f6;
        border: 1px solid #e0e9e3;
        border-radius: 9px;
        width: fit-content;
        max-width: 100%;
    }

    .berita-page .current-image img {
        display: block;
        width: 150px;
        height: 95px;
        object-fit: cover;
        border-radius: 7px;
        border: 1px solid #dce6df;
    }

    .berita-page .current-image-label {
        display: block;
        margin-bottom: 9px;
        color: #53665a;
        font-size: 12px;
        font-weight: 600;
    }

    .berita-page .form-actions {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #edf1ee;
    }

    .berita-page .btn {
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

    .berita-page .btn-back {
        background: #fff;
        color: #526258;
        border: 1px solid #dce5de;
    }

    .berita-page .btn-back:hover {
        background: #f0f5f1;
        color: #198754;
    }

    .berita-page .btn-save {
        background: #198754;
        border: 1px solid #198754;
        color: #fff;
    }

    .berita-page .btn-save:hover {
        background: #146c43;
        border-color: #146c43;
        color: #fff;
    }

    .berita-page .btn svg {
        width: 16px;
        height: 16px;
    }

    @media (max-width: 576px) {
        .berita-page {
            padding-top: 8px;
        }

        .berita-page .page-title {
            font-size: 21px;
        }

        .berita-page .form-card-header {
            padding: 16px;
        }

        .berita-page .form-card-body {
            padding: 18px 16px;
        }

        .berita-page .form-actions {
            flex-direction: column-reverse;
        }

        .berita-page .form-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="container berita-page">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h1 class="page-title">
                {{ isset($berita) ? 'Edit Berita' : 'Tambah Berita' }}
            </h1>

            <p class="page-description">
                {{ isset($berita)
                    ? 'Perbarui informasi berita sekolah.'
                    : 'Tambahkan berita terbaru sekolah.' }}
            </p>
        </div>

        <a href="{{ route('admin.berita.index') }}" class="btn btn-back">
            <i data-feather="arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- NOTIFIKASI VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            Periksa kembali data yang kamu masukkan.
        </div>
    @endif

    {{-- FORM --}}
    <div class="form-card">

        <div class="form-card-header">
            <h5>
                {{ isset($berita) ? 'Form Edit Berita' : 'Form Berita Baru' }}
            </h5>
        </div>

        <div class="form-card-body">

            <form
                action="{{ route('admin.berita.save') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf

                @if (isset($berita))
                    <input
                        type="hidden"
                        name="id_berita"
                        value="{{ Crypt::encrypt($berita->id_berita) }}"
                    >
                @endif

                <div class="row g-4">

                    {{-- JUDUL --}}
                    <div class="col-12">
                        <label for="judul" class="form-label">
                            Judul Berita <span class="required-mark">*</span>
                        </label>

                        <input
                            type="text"
                            id="judul"
                            name="judul"
                            class="form-control @error('judul') is-invalid @enderror"
                            value="{{ old('judul', $berita->judul ?? '') }}"
                            placeholder="Contoh: Siswa Raih Prestasi"
                            required
                        >

                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TANGGAL --}}
                    <div class="col-md-6">
                        <label for="tanggal" class="form-label">
                            Tanggal Berita <span class="required-mark">*</span>
                        </label>

                        <input
                            type="date"
                            id="tanggal"
                            name="tanggal"
                            class="form-control @error('tanggal') is-invalid @enderror"
                            value="{{ old('tanggal', isset($berita) ? \Carbon\Carbon::parse($berita->tanggal)->format('Y-m-d') : date('Y-m-d')) }}"
                            required
                        >

                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-6">
                        <label for="status" class="form-label">
                            Status Berita <span class="required-mark">*</span>
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="form-select @error('status') is-invalid @enderror"
                            required
                        >
                            <option value="draft"
                                {{ old('status', $berita->status ?? 'draft') == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>

                            <option value="publish"
                                {{ old('status', $berita->status ?? 'draft') == 'publish' ? 'selected' : '' }}>
                                Publish
                            </option>
                        </select>

                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- GAMBAR --}}
                    <div class="col-12">
                        <label for="gambar" class="form-label">
                            Foto Sampul / Gambar

                            @if (!isset($berita))
                                <span class="required-mark">*</span>
                            @endif
                        </label>

                        <input
                            type="file"
                            id="gambar"
                            name="gambar"
                            class="form-control @error('gambar') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            {{ !isset($berita) ? 'required' : '' }}
                        >

                        <small class="form-text">
                            Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                            @if (isset($berita))
                                Biarkan kosong jika tidak ingin mengganti gambar.
                            @endif
                        </small>

                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- GAMBAR LAMA --}}
                        @if (isset($berita) && $berita->gambar)
                            @if (file_exists(public_path('storage/' . $berita->gambar)))
                                <div class="current-image">
                                    <span class="current-image-label">
                                        <i data-feather="image" style="width:14px;height:14px;vertical-align:middle;"></i>
                                        Gambar saat ini
                                    </span>

                                    <img
                                        src="{{ asset('storage/' . $berita->gambar) }}"
                                        alt="{{ $berita->judul }}"
                                    >
                                </div>
                            @endif
                        @endif
                    </div>

                    {{-- ISI BERITA --}}
                    <div class="col-12">
                        <label for="isi" class="form-label">
                            Isi Berita <span class="required-mark">*</span>
                        </label>

                        <textarea
                            id="isi"
                            name="isi"
                            rows="8"
                            class="form-control @error('isi') is-invalid @enderror"
                            placeholder="Tuliskan isi berita sekolah..."
                            required
                        >{{ old('isi', $berita->isi ?? '') }}</textarea>

                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- TOMBOL --}}
                <div class="form-actions">
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-back">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-save">
                        <i data-feather="save"></i>
                        {{ isset($berita) ? 'Simpan Perubahan' : 'Simpan Berita' }}
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
