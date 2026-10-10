@extends('admin')

@section('title', isset($ekstrakurikuler) ? 'Edit Ekstrakurikuler' : 'Tambah Ekstrakurikuler')

@section('content')

<style>
    .eskul-page {
        font-family: 'Poppins', sans-serif;
        padding: 8px 0 24px;
    }

    .eskul-page .page-title {
        color: #198754;
        font-size: 25px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .eskul-page .page-description {
        color: #748178;
        font-size: 14px;
        margin: 0;
    }

    .eskul-page .form-card {
        background: #fff;
        border: 1px solid #e0e9e3;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(25, 135, 84, 0.06);
        overflow: hidden;
    }

    .eskul-page .form-card-header {
        padding: 18px 24px;
        background: #f5f9f6;
        border-bottom: 1px solid #e0e9e3;
    }

    .eskul-page .form-card-header h5 {
        color: #198754;
        font-size: 16px;
        font-weight: 700;
        margin: 0;
    }

    .eskul-page .form-card-body {
        padding: 26px 24px;
    }

    .eskul-page .form-label {
        display: block;
        color: #34483b;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .eskul-page .required-mark {
        color: #dc3545;
    }

    .eskul-page .form-control {
        min-height: 43px;
        border: 1px solid #d9e3dc;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        color: #34483b;
        box-shadow: none;
    }

    .eskul-page textarea.form-control {
        min-height: 160px;
        resize: vertical;
        line-height: 1.7;
    }

    .eskul-page .form-control:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.1);
    }

    .eskul-page .form-control::placeholder {
        color: #a0aaa3;
    }

    .eskul-page .form-text {
        display: block;
        margin-top: 7px;
        color: #7a887e;
        font-size: 12px;
        line-height: 1.6;
    }

    .eskul-page .invalid-feedback {
        font-size: 12px;
    }

    .eskul-page .current-image {
        display: inline-block;
        max-width: 100%;
        margin-top: 16px;
        padding: 12px;
        background: #f5f9f6;
        border: 1px solid #e0e9e3;
        border-radius: 9px;
    }

    .eskul-page .current-image img {
        display: block;
        width: 150px;
        height: 95px;
        object-fit: cover;
        border: 1px solid #dce6df;
        border-radius: 7px;
    }

    .eskul-page .current-image-label {
        display: block;
        margin-bottom: 9px;
        color: #53665a;
        font-size: 12px;
        font-weight: 600;
    }

    .eskul-page .form-actions {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #edf1ee;
    }

    .eskul-page .btn {
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

    .eskul-page .btn-back {
        background: #fff;
        color: #526258;
        border: 1px solid #dce5de;
    }

    .eskul-page .btn-back:hover {
        background: #f0f5f1;
        color: #198754;
    }

    .eskul-page .btn-save {
        background: #198754;
        border: 1px solid #198754;
        color: #fff;
    }

    .eskul-page .btn-save:hover {
        background: #146c43;
        border-color: #146c43;
        color: #fff;
    }

    .eskul-page .btn svg {
        width: 16px;
        height: 16px;
    }

    @media (max-width: 576px) {
        .eskul-page {
            padding-top: 8px;
        }

        .eskul-page .page-title {
            font-size: 21px;
        }

        .eskul-page .form-card-header {
            padding: 16px;
        }

        .eskul-page .form-card-body {
            padding: 18px 16px;
        }

        .eskul-page .form-actions {
            flex-direction: column-reverse;
        }

        .eskul-page .form-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="container eskul-page">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h1 class="page-title">
                {{ isset($ekstrakurikuler) ? 'Edit Ekstrakurikuler' : 'Tambah Ekstrakurikuler' }}
            </h1>

            <p class="page-description">
                {{ isset($ekstrakurikuler)
                    ? 'Perbarui data ekstrakurikuler sekolah.'
                    : 'Tambahkan data ekstrakurikuler sekolah.' }}
            </p>
        </div>

        <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-back">
            <i data-feather="arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- FORM --}}
    <div class="form-card">

        <div class="form-card-header">
            <h5>
                {{ isset($ekstrakurikuler) ? 'Form Edit Ekstrakurikuler' : 'Form Ekstrakurikuler Baru' }}
            </h5>
        </div>

        <div class="form-card-body">

            <form
                action="{{ route('admin.ekstrakurikuler.save') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf

                {{-- ID ESKUL UNTUK EDIT --}}
                @if (isset($ekstrakurikuler))
                    <input
                        type="hidden"
                        name="id_eskul"
                        value="{{ Crypt::encrypt($ekstrakurikuler->id_eskul) }}"
                    >
                @endif

                <div class="row g-4">

                    {{-- NAMA EKSTRAKURIKULER --}}
                    <div class="col-md-6">
                        <label for="nama_eskul" class="form-label">
                            Nama Ekstrakurikuler
                            <span class="required-mark">*</span>
                        </label>

                        <input
                            type="text"
                            id="nama_eskul"
                            name="nama_eskul"
                            class="form-control @error('nama_eskul') is-invalid @enderror"
                            value="{{ old('nama_eskul', $ekstrakurikuler->nama_eskul ?? '') }}"
                            placeholder="Contoh: Pramuka"
                            required
                        >

                        @error('nama_eskul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- PEMBINA --}}
                    <div class="col-md-6">
                        <label for="pembina" class="form-label">
                            Pembina
                            <span class="required-mark">*</span>
                        </label>

                        <input
                            type="text"
                            id="pembina"
                            name="pembina"
                            class="form-control @error('pembina') is-invalid @enderror"
                            value="{{ old('pembina', $ekstrakurikuler->pembina ?? '') }}"
                            placeholder="Contoh: Bapak Ahmad, S.Pd."
                            required
                        >

                        @error('pembina')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- JADWAL LATIHAN --}}
                    <div class="col-md-6">
                        <label for="jadwal_latihan" class="form-label">
                            Jadwal Latihan
                            <span class="required-mark">*</span>
                        </label>

                        <input
                            type="text"
                            id="jadwal_latihan"
                            name="jadwal_latihan"
                            class="form-control @error('jadwal_latihan') is-invalid @enderror"
                            value="{{ old('jadwal_latihan', $ekstrakurikuler->jadwal_latihan ?? '') }}"
                            placeholder="Contoh: Jumat, 14.00 - 16.00"
                            required
                        >

                        @error('jadwal_latihan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- GAMBAR --}}
                    <div class="col-md-6">
                        <label for="gambar" class="form-label">
                            {{ isset($ekstrakurikuler) ? 'Ganti Foto / Gambar' : 'Foto / Gambar Ekstrakurikuler' }}

                            @if (!isset($ekstrakurikuler))
                                <span class="required-mark">*</span>
                            @endif
                        </label>

                        <input
                            type="file"
                            id="gambar"
                            name="gambar"
                            class="form-control @error('gambar') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            {{ !isset($ekstrakurikuler) ? 'required' : '' }}
                        >

                        <small class="form-text">
                            Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.

                            @if (isset($ekstrakurikuler))
                                Biarkan kosong jika tidak ingin mengganti gambar.
                            @endif
                        </small>

                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- GAMBAR LAMA --}}
                        @if (isset($ekstrakurikuler) && $ekstrakurikuler->gambar)
                            @if (file_exists(public_path('storage/' . $ekstrakurikuler->gambar)))
                                <div class="current-image">
                                    <span class="current-image-label">
                                        <i data-feather="image" style="width:14px;height:14px;vertical-align:middle;"></i>
                                        Gambar saat ini
                                    </span>

                                    <img
                                        src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}"
                                        alt="{{ $ekstrakurikuler->nama_eskul }}"
                                    >
                                </div>
                            @endif
                        @endif
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="col-12">
                        <label for="deskripsi" class="form-label">
                            Deskripsi
                            <span class="required-mark">*</span>
                        </label>

                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            rows="7"
                            class="form-control @error('deskripsi') is-invalid @enderror"
                            placeholder="Tuliskan deskripsi ekstrakurikuler..."
                            required
                        >{{ old('deskripsi', $ekstrakurikuler->deskripsi ?? '') }}</textarea>

                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- TOMBOL --}}
                <div class="form-actions">
                    <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-back">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-save">
                        <i data-feather="save"></i>
                        {{ isset($ekstrakurikuler) ? 'Simpan Perubahan' : 'Simpan Ekstrakurikuler' }}
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
