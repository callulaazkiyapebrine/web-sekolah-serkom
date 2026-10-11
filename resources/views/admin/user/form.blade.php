@extends('admin')

@section('title', $user ? 'Edit Data User - MAN 2 Tasikmalaya' : 'Tambah Data User - MAN 2 Tasikmalaya')

@section('content')

<style>
    .user-page {
        font-family: 'Poppins', sans-serif;
        padding: 8px 0 24px;
    }

    .user-page .page-title {
        color: #198754;
        font-size: 25px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .user-page .page-description {
        color: #748178;
        font-size: 14px;
        margin: 0;
    }

    .user-page .form-card {
        background: #fff;
        border: 1px solid #e0e9e3;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(25, 135, 84, 0.06);
        overflow: hidden;
    }

    .user-page .form-card-header {
        padding: 18px 24px;
        background: #f5f9f6;
        border-bottom: 1px solid #e0e9e3;
    }

    .user-page .form-card-header h5 {
        color: #198754;
        font-size: 16px;
        font-weight: 700;
        margin: 0;
    }

    .user-page .form-card-body {
        padding: 26px 24px;
    }

    .user-page .form-label {
        display: block;
        color: #34483b;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .user-page .required-mark {
        color: #dc3545;
    }

    .user-page .form-control,
    .user-page .form-select {
        min-height: 43px;
        border: 1px solid #d9e3dc;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        color: #34483b;
        box-shadow: none;
    }

    .user-page .form-control:focus,
    .user-page .form-select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.1);
    }

    .user-page .form-control::placeholder {
        color: #a0aaa3;
    }

    .user-page .form-text {
        display: block;
        margin-top: 7px;
        color: #7a887e;
        font-size: 12px;
        line-height: 1.6;
    }

    .user-page .invalid-feedback {
        font-size: 12px;
    }

    .user-page .alert {
        border-radius: 8px;
        font-size: 13px;
    }

    .user-page .form-actions {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #edf1ee;
    }

    .user-page .btn {
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

    .user-page .btn-back {
        background: #fff;
        color: #526258;
        border: 1px solid #dce5de;
    }

    .user-page .btn-back:hover {
        background: #f0f5f1;
        color: #198754;
    }

    .user-page .btn-save {
        background: #198754;
        border: 1px solid #198754;
        color: #fff;
    }

    .user-page .btn-save:hover {
        background: #146c43;
        border-color: #146c43;
        color: #fff;
    }

    .user-page .btn svg {
        width: 16px;
        height: 16px;
    }

    @media (max-width: 576px) {
        .user-page {
            padding-top: 8px;
        }

        .user-page .page-title {
            font-size: 21px;
        }

        .user-page .form-card-header {
            padding: 16px;
        }

        .user-page .form-card-body {
            padding: 18px 16px;
        }

        .user-page .form-actions {
            flex-direction: column-reverse;
        }

        .user-page .form-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="container user-page">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h1 class="page-title">
                {{ $user ? 'Edit Data User' : 'Tambah User Baru' }}
            </h1>

            <p class="page-description">
                {{ $user
                    ? 'Perbarui informasi akun dan hak akses user.'
                    : 'Tambahkan akun baru untuk mengakses halaman admin.' }}
            </p>
        </div>

        <a href="{{ route('admin.user.index') }}" class="btn btn-back">
            <i data-feather="arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- FORM --}}
    <div class="form-card">

        <div class="form-card-header">
            <h5>
                {{ $user ? 'Form Edit User' : 'Form User Baru' }}
            </h5>
        </div>

        <div class="form-card-body">

            {{-- ERROR VALIDASI --}}
            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <strong>Periksa kembali data yang dimasukkan.</strong>

                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ $user
                    ? route('admin.user.save', Crypt::encrypt($user->id_user))
                    : route('admin.user.save') }}"
                method="POST">

                @csrf

                <div class="row g-4">

                    {{-- USERNAME --}}
                    <div class="col-md-6">
                        <label for="username" class="form-label">
                            Username <span class="required-mark">*</span>
                        </label>

                        <input
                            type="text"
                            id="username"
                            name="username"
                            class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username', $user->username ?? '') }}"
                            placeholder="Masukkan username"
                            required>

                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- ROLE --}}
                    <div class="col-md-6">
                        <label for="role" class="form-label">
                            Role <span class="required-mark">*</span>
                        </label>

                        <select
                            id="role"
                            name="role"
                            class="form-select @error('role') is-invalid @enderror"
                            required>

                            <option value="">Pilih role user</option>

                            <option
                                value="admin"
                                {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>

                            <option
                                value="operator"
                                {{ old('role', $user->role ?? '') == 'operator' ? 'selected' : '' }}>
                                Operator
                            </option>
                        </select>

                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <small class="form-text">
                            Admin memiliki akses pengelolaan sesuai hak akses yang diterapkan.
                            Operator memiliki akses sesuai pembatasan role.
                        </small>
                    </div>

                    {{-- PASSWORD --}}
                    <div class="col-12">
                        <label for="password" class="form-label">
                            Password

                            @if($user)
                                <span class="text-muted fw-normal">
                                    (kosongkan jika tidak ingin mengubah)
                                </span>
                            @else
                                <span class="required-mark">*</span>
                            @endif
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="{{ $user ? 'Masukkan password baru' : 'Masukkan password' }}"
                            {{ $user ? '' : 'required' }}>

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if($user)
                            <small class="form-text">
                                Password lama tetap digunakan jika kolom ini dikosongkan.
                            </small>
                        @endif
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="form-actions">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-back">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-save">
                        <i data-feather="save"></i>
                        {{ $user ? 'Simpan Perubahan' : 'Simpan User' }}
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
