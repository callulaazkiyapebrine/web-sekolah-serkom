@extends('admin')

@section('title', isset($guru) ? 'Edit Guru' : 'Tambah Guru')

@section('content')

<style>
    .guru-page {
        font-family: 'Poppins', sans-serif;
        padding: 8px 0 24px;
    }

    .guru-page .page-title {
        color: #198754;
        font-size: 25px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .guru-page .page-description {
        color: #748178;
        font-size: 14px;
        margin: 0;
    }

    .guru-page .form-card {
        background: #fff;
        border: 1px solid #e0e9e3;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(25, 135, 84, 0.06);
        overflow: hidden;
    }

    .guru-page .form-card-header {
        padding: 18px 24px;
        background: #f5f9f6;
        border-bottom: 1px solid #e0e9e3;
    }

    .guru-page .form-card-header h5 {
        color: #198754;
        font-size: 16px;
        font-weight: 700;
        margin: 0;
    }

    .guru-page .form-card-body {
        padding: 26px 24px;
    }

    .guru-page .form-label {
        display: block;
        color: #34483b;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .guru-page .required-mark {
        color: #dc3545;
    }

    .guru-page .form-control {
        min-height: 43px;
        border: 1px solid #d9e3dc;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        color: #34483b;
        box-shadow: none;
    }

    .guru-page .form-control:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.1);
    }

    .guru-page .form-control::placeholder {
        color: #a0aaa3;
    }

    .guru-page .form-text {
        display: block;
        margin-top: 7px;
        color: #7a887e;
        font-size: 12px;
        line-height: 1.6;
    }

    .guru-page .invalid-feedback {
        font-size: 12px;
    }

    .guru-page .current-photo {
        display: inline-block;
        margin-top: 16px;
        padding: 12px;
        background: #f5f9f6;
        border: 1px solid #e0e9e3;
        border-radius: 9px;
    }

    .guru-page .current-photo-label {
        display: block;
        margin-bottom: 9px;
        color: #53665a;
        font-size: 12px;
        font-weight: 600;
    }

    .guru-page .current-photo img {
        display: block;
        width: 100px;
        height: 100px;
        object-fit: cover;
        border: 1px solid #dce6df;
        border-radius: 50%;
    }

    .guru-page .form-actions {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #edf1ee;
    }

    .guru-page .btn {
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

    .guru-page .btn-back {
        background: #fff;
        color: #526258;
        border: 1px solid #dce5de;
    }

    .guru-page .btn-back:hover {
        background: #f0f5f1;
        color: #198754;
    }

    .guru-page .btn-save {
        background: #198754;
        border: 1px solid #198754;
        color: #fff;
    }

    .guru-page .btn-save:hover {
        background: #146c43;
        border-color: #146c43;
        color: #fff;
    }

    @media (max-width: 576px) {
        .guru-page {
            padding-top: 8px;
        }

        .guru-page .page-title {
            font-size: 21px;
        }

        .guru-page .form-card-header {
            padding: 16px;
        }

        .guru-page .form-card-body {
            padding: 18px 16px;
        }

        .guru-page .form-actions {
            flex-direction: column-reverse;
        }

        .guru-page .form-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="container guru-page">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h1 class="page-title">
                {{ isset($guru) ? 'Edit Data Guru' : 'Tambah Data Guru' }}
            </h1>

            <p class="page-description">
                {{ isset($guru)
                    ? 'Perbarui data guru sekolah.'
                    : 'Tambahkan data guru sekolah.' }}
            </p>
        </div>

        <a href="{{ route('admin.guru.index') }}" class="btn btn-back">
            <i data-feather="arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- FORM --}}
    <div class="form-card">

        <div class="form-card-header">
            <h5>
                {{ isset($guru) ? 'Form Edit Guru' : 'Form Guru Baru' }}
            </h5>
        </div>

        <div class="form-card-body">

            <form action="{{ route('admin.guru.save') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                {{-- ID GURU SAAT EDIT --}}
                @if(isset($guru))
                    <input type="hidden"
                           name="id_guru"
                           value="{{ Crypt::encrypt($guru->id_guru) }}">
                @endif

                <div class="row g-4">

                    {{-- NAMA GURU --}}
                    <div class="col-md-6">
                        <label for="nama_guru" class="form-label">
                            Nama Guru <span class="required-mark">*</span>
                        </label>

                        <input type="text"
                               name="nama_guru"
                               id="nama_guru"
                               class="form-control @error('nama_guru') is-invalid @enderror"
                               value="{{ old('nama_guru', $guru->nama_guru ?? '') }}"
                               placeholder="Contoh: Ahmad Fauzi, S.Pd."
                               required>

                        @error('nama_guru')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NIP --}}
                    <div class="col-md-6">
                        <label for="nip" class="form-label">NIP</label>

                        <input type="text"
                               name="nip"
                               id="nip"
                               class="form-control @error('nip') is-invalid @enderror"
                               value="{{ old('nip', $guru->nip ?? '') }}"
                               placeholder="Masukkan NIP">

                        @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- MATA PELAJARAN --}}
                    <div class="col-md-6">
                        <label for="mapel" class="form-label">
                            Mata Pelajaran
                        </label>

                        <input type="text"
                               name="mapel"
                               id="mapel"
                               class="form-control @error('mapel') is-invalid @enderror"
                               value="{{ old('mapel', $guru->mapel ?? '') }}"
                               placeholder="Contoh: Matematika">

                        @error('mapel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- FOTO GURU --}}
                    <div class="col-md-6">
                        <label for="foto" class="form-label">
                            {{ isset($guru) ? 'Ganti Foto' : 'Foto Guru' }}

                            @if(!isset($guru))
                                <span class="required-mark">*</span>
                            @endif
                        </label>

                        <input type="file"
                               name="foto"
                               id="foto"
                               class="form-control @error('foto') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                               {{ isset($guru) ? '' : 'required' }}>

                        <small class="form-text">
                            Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.

                            @if(isset($guru))
                                <br>Biarkan kosong jika tidak ingin mengganti foto.
                            @endif
                        </small>

                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- FOTO LAMA --}}
                        @if(isset($guru) && $guru->foto)
                            @if(file_exists(public_path('storage/' . $guru->foto)))
                                <div class="current-photo">
                                    <span class="current-photo-label">
                                        Foto saat ini
                                    </span>

                                    <img src="{{ asset('storage/' . $guru->foto) }}"
                                         alt="{{ $guru->nama_guru }}">
                                </div>
                            @endif
                        @endif
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="form-actions">
                    <a href="{{ route('admin.guru.index') }}" class="btn btn-back">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-save">
                        <i data-feather="save"></i>
                        {{ isset($guru) ? 'Simpan Perubahan' : 'Simpan Guru' }}
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
