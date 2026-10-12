
@extends('admin')

@section('title', isset($siswa) ? 'Edit Siswa' : 'Tambah Siswa')

@section('content')

<style>
    .siswa-page {
        font-family: 'Poppins', sans-serif;
        padding: 8px 0 24px;
    }

    .siswa-page .page-title {
        color: #198754;
        font-size: 25px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .siswa-page .page-description {
        color: #748178;
        font-size: 14px;
        margin: 0;
    }

    .siswa-page .form-card {
        background: #fff;
        border: 1px solid #e0e9e3;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(25, 135, 84, 0.06);
        overflow: hidden;
    }

    .siswa-page .form-card-header {
        padding: 18px 24px;
        background: #f5f9f6;
        border-bottom: 1px solid #e0e9e3;
    }

    .siswa-page .form-card-header h5 {
        color: #198754;
        font-size: 16px;
        font-weight: 700;
        margin: 0;
    }

    .siswa-page .form-card-body {
        padding: 26px 24px;
    }

    .siswa-page .form-label {
        display: block;
        color: #34483b;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .siswa-page .required-mark {
        color: #dc3545;
    }

    .siswa-page .form-control,
    .siswa-page .form-select {
        min-height: 43px;
        border: 1px solid #d9e3dc;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        color: #34483b;
        box-shadow: none;
    }

    .siswa-page .form-control:focus,
    .siswa-page .form-select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.1);
    }

    .siswa-page .form-control::placeholder {
        color: #a0aaa3;
    }

    .siswa-page .invalid-feedback {
        font-size: 12px;
    }

    .siswa-page .form-actions {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #edf1ee;
    }

    .siswa-page .btn {
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

    .siswa-page .btn-back {
        background: #fff;
        color: #526258;
        border: 1px solid #dce5de;
    }

    .siswa-page .btn-back:hover {
        background: #f0f5f1;
        color: #198754;
    }

    .siswa-page .btn-save {
        background: #198754;
        border: 1px solid #198754;
        color: #fff;
    }

    .siswa-page .btn-save:hover {
        background: #146c43;
        border-color: #146c43;
        color: #fff;
    }

    .siswa-page .btn svg {
        width: 16px;
        height: 16px;
    }

    @media (max-width: 576px) {
        .siswa-page {
            padding-top: 8px;
        }

        .siswa-page .page-title {
            font-size: 21px;
        }

        .siswa-page .form-card-header {
            padding: 16px;
        }

        .siswa-page .form-card-body {
            padding: 18px 16px;
        }

        .siswa-page .form-actions {
            flex-direction: column-reverse;
        }

        .siswa-page .form-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="container siswa-page">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h1 class="page-title">
                {{ isset($siswa) ? 'Edit Siswa' : 'Tambah Siswa' }}
            </h1>

            <p class="page-description">
                {{ isset($siswa)
                    ? 'Perbarui data siswa sekolah.'
                    : 'Tambahkan data siswa sekolah.' }}
            </p>
        </div>

        <a href="{{ route('admin.siswa.index') }}" class="btn btn-back">
            <i data-feather="arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- FORM CARD --}}
    <div class="form-card">

        <div class="form-card-header">
            <h5>
                {{ isset($siswa) ? 'Form Edit Siswa' : 'Form Siswa Baru' }}
            </h5>
        </div>

        <div class="form-card-body">

            <form action="{{ route('admin.siswa.save') }}" method="POST">
                @csrf

                {{-- ID SISWA SAAT EDIT --}}
                @if(isset($siswa))
                    <input
                        type="hidden"
                        name="id_siswa"
                        value="{{ Crypt::encrypt($siswa->id_siswa) }}">
                @endif

                <div class="row g-4">

                    {{-- NISN --}}
                    <div class="col-md-6">
                        <label for="nisn" class="form-label">
                            NISN <span class="required-mark">*</span>
                        </label>

                        <input
                            type="text"
                            id="nisn"
                            name="nisn"
                            class="form-control @error('nisn') is-invalid @enderror"
                            value="{{ old('nisn', $siswa->nisn ?? '') }}"
                            placeholder="Masukkan NISN"
                            maxlength="10"
                            required>

                        @error('nisn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NAMA SISWA --}}
                    <div class="col-md-6">
                        <label for="nama_siswa" class="form-label">
                            Nama Siswa <span class="required-mark">*</span>
                        </label>

                        <input
                            type="text"
                            id="nama_siswa"
                            name="nama_siswa"
                            class="form-control @error('nama_siswa') is-invalid @enderror"
                            value="{{ old('nama_siswa', $siswa->nama_siswa ?? '') }}"
                            placeholder="Masukkan nama lengkap siswa"
                            maxlength="40"
                            required>

                        @error('nama_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- JENIS KELAMIN --}}
                    <div class="col-md-6">
                        <label for="jenis_kelamin" class="form-label">
                            Jenis Kelamin <span class="required-mark">*</span>
                        </label>

                        <select
                            id="jenis_kelamin"
                            name="jenis_kelamin"
                            class="form-select @error('jenis_kelamin') is-invalid @enderror"
                            required>

                            <option value="">Pilih jenis kelamin</option>

                            <option
                                value="laki-laki"
                                {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') === 'laki-laki' ? 'selected' : '' }}>
                                Laki-laki
                            </option>

                            <option
                                value="perempuan"
                                {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') === 'perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>

                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- JURUSAN DARI DATABASE --}}
                    <div class="col-md-6">
                        <label for="id_jurusan" class="form-label">
                            Jurusan <span class="required-mark">*</span>
                        </label>

                        <select
                            id="id_jurusan"
                            name="id_jurusan"
                            class="form-select @error('id_jurusan') is-invalid @enderror"
                            required>

                            <option value="">Pilih Jurusan</option>

                            @foreach($jurusans as $jurusan)
                                <option
                                    value="{{ $jurusan->id_jurusan }}"
                                    {{ (string) old('id_jurusan', $siswa->id_jurusan ?? '') === (string) $jurusan->id_jurusan ? 'selected' : '' }}>
                                    {{ $jurusan->nama_jurusan }}
                                </option>
                            @endforeach
                        </select>

                        @error('id_jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TAHUN MASUK --}}
                    <div class="col-md-6">
                        <label for="tahun_masuk" class="form-label">
                            Tahun Masuk <span class="required-mark">*</span>
                        </label>

                        <input
                            type="number"
                            id="tahun_masuk"
                            name="tahun_masuk"
                            class="form-control @error('tahun_masuk') is-invalid @enderror"
                            value="{{ old('tahun_masuk', $siswa->tahun_masuk ?? '') }}"
                            placeholder="Contoh: 2026"
                            min="2000"
                            max="2100"
                            required>

                        @error('tahun_masuk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- TOMBOL --}}
                <div class="form-actions">
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-back">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-save">
                        <i data-feather="save"></i>
                        {{ isset($siswa) ? 'Simpan Perubahan' : 'Simpan Siswa' }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>

@endsection
