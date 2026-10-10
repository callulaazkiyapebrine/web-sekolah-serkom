@extends('admin')

@section('title', 'Detail Siswa')

@section('content')

<style>
    .detail-siswa {
        max-width: 1100px;
        margin: 0 auto;
        padding-top: 4px;
        color: #26352c;
    }

    .siswa-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
    }

    .siswa-header h2 {
        color: #0b5d3b;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .siswa-header p {
        color: #78847c;
        margin: 0;
        font-size: .95rem;
    }

    .btn-kembali-siswa {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        border: 1px solid #0b5d3b;
        border-radius: 9px;
        color: #0b5d3b;
        background: white;
        text-decoration: none;
        font-size: .9rem;
        font-weight: 600;
        white-space: nowrap;
        transition: .2s;
    }

    .btn-kembali-siswa:hover {
        background: #0b5d3b;
        color: white;
    }

    .siswa-card {
        background: white;
        border: 1px solid #e5ebe6;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(20, 60, 35, .05);
    }

    .siswa-card-header {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 28px 32px;
        background: #f1f7f2;
        border-bottom: 1px solid #e2ebe4;
    }

    .siswa-avatar {
        width: 64px;
        height: 64px;
        flex-shrink: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 14px;
        background: #dceee1;
        color: #0b5d3b;
    }

    .siswa-avatar i {
        width: 30px;
        height: 30px;
    }

    .siswa-label {
        display: inline-block;
        color: #0b5d3b;
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .4px;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    .siswa-nama {
        color: #173d29;
        font-size: 1.7rem;
        line-height: 1.4;
        font-weight: 700;
        margin: 0;
        overflow-wrap: anywhere;
    }

    .siswa-card-body {
        padding: 30px 32px;
    }

    .siswa-section-title {
        color: #0b5d3b;
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .siswa-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .siswa-info-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 20px;
        background: #f8faf8;
        border: 1px solid #e8eee9;
        border-radius: 11px;
        min-width: 0;
    }

    .siswa-info-icon {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        background: #dceee1;
        color: #0b5d3b;
    }

    .siswa-info-icon i {
        width: 19px;
        height: 19px;
    }

    .siswa-info-label {
        color: #78847c;
        font-size: .84rem;
        margin-bottom: 6px;
    }

    .siswa-info-value {
        color: #26352c;
        font-size: .98rem;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .siswa-gender {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 6px;
        background: #dceee1;
        color: #0b5d3b;
        font-size: .85rem;
        font-weight: 600;
    }

    .siswa-card-footer {
        padding: 18px 32px;
        background: #fbfcfb;
        border-top: 1px solid #e8eee9;
    }

    @media (max-width: 576px) {
        .detail-siswa {
            padding: 10px 0;
        }

        .siswa-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .siswa-header h2 {
            font-size: 1.5rem;
        }

        .siswa-card-header {
            align-items: flex-start;
            padding: 22px 18px;
            gap: 14px;
        }

        .siswa-avatar {
            width: 50px;
            height: 50px;
        }

        .siswa-avatar i {
            width: 24px;
            height: 24px;
        }

        .siswa-nama {
            font-size: 1.35rem;
        }

        .siswa-card-body {
            padding: 22px 18px;
        }

        .siswa-info-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .siswa-info-item {
            padding: 16px;
        }

        .siswa-card-footer {
            padding: 16px 18px;
        }
    }
</style>

<div class="container-fluid pt-2 pb-4">
    <div class="detail-siswa">

        {{-- HEADER --}}
        <div class="siswa-header">
            <div>
                <h2>Detail Siswa</h2>
                <p>Informasi lengkap data siswa sekolah.</p>
            </div>

            <a href="{{ route('admin.siswa.index') }}"
                class="btn-kembali-siswa">
                <i data-feather="arrow-left"></i>
                Kembali
            </a>
        </div>

        {{-- KARTU DETAIL --}}
        <div class="siswa-card">

            {{-- IDENTITAS SISWA --}}
            <div class="siswa-card-header">
                <div class="siswa-avatar">
                    <i data-feather="user"></i>
                </div>

                <div>
                    <span class="siswa-label">Data Siswa</span>

                    <h1 class="siswa-nama">
                        {{ $siswa->nama_siswa }}
                    </h1>
                </div>
            </div>

            <div class="siswa-card-body">

                <h5 class="siswa-section-title">
                    <i data-feather="clipboard"
                        style="width:18px;height:18px;vertical-align:middle;margin-right:6px;">
                    </i>
                    Informasi Siswa
                </h5>

                <div class="siswa-info-grid">

                    {{-- NISN --}}
                    <div class="siswa-info-item">
                        <div class="siswa-info-icon">
                            <i data-feather="credit-card"></i>
                        </div>

                        <div>
                            <div class="siswa-info-label">NISN</div>
                            <div class="siswa-info-value">
                                {{ $siswa->nisn ?: '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- JENIS KELAMIN --}}
                    <div class="siswa-info-item">
                        <div class="siswa-info-icon">
                            <i data-feather="users"></i>
                        </div>

                        <div>
                            <div class="siswa-info-label">Jenis Kelamin</div>
                            <div class="siswa-info-value">
                                @if($siswa->jenis_kelamin === 'laki-laki')
                                <span class="siswa-gender">Laki-laki</span>
                                @else
                                <span class="siswa-gender">Perempuan</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- TAHUN MASUK --}}
                    <div class="siswa-info-item">
                        <div class="siswa-info-icon">
                            <i data-feather="calendar"></i>
                        </div>

                        <div>
                            <div class="siswa-info-label">Tahun Masuk</div>
                            <div class="siswa-info-value">
                                {{ $siswa->tahun_masuk ?: '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- ID SISWA --}}
                    <div class="siswa-info-item">
                        <div class="siswa-info-icon">
                            <i data-feather="hash"></i>
                        </div>

                        <div>
                            <div class="siswa-info-label">ID Siswa</div>
                            <div class="siswa-info-value">
                                {{ $siswa->id_siswa }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection