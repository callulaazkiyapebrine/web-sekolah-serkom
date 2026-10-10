@extends('admin')

@section('title', 'Detail Pengumuman')

@section('content')

<style>
    .detail-pengumuman {
        max-width: 1100px;
        margin: 0 auto;
        padding-top: 4px;
        color: #26352c;
    }

    .pengumuman-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
    }

    .pengumuman-header h2 {
        color: #0b5d3b;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 6px;
        overflow-wrap: anywhere;
    }

    .pengumuman-header p {
        color: #78847c;
        margin: 0;
        font-size: .95rem;
    }

    .btn-kembali-pengumuman {
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

    .btn-kembali-pengumuman:hover {
        background: #0b5d3b;
        color: white;
    }

    .pengumuman-card {
        background: white;
        border: 1px solid #e5ebe6;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(20, 60, 35, .05);
    }

    .pengumuman-card-header {
        padding: 28px 32px;
        background: #f1f7f2;
        border-bottom: 1px solid #e2ebe4;
    }

    .pengumuman-label {
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 14px;
        background: #dceee1;
        color: #0b5d3b;
        border-radius: 6px;
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .3px;
    }

    .pengumuman-judul {
        color: #173d29;
        font-size: 1.8rem;
        line-height: 1.4;
        font-weight: 700;
        margin: 0;
        overflow-wrap: anywhere;
    }

    .pengumuman-card-body {
        padding: 30px 32px;
    }

    .pengumuman-info {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }

    .pengumuman-info-item {
        padding: 18px;
        background: #f8faf8;
        border: 1px solid #e8eee9;
        border-radius: 11px;
    }

    .pengumuman-info-label {
        color: #78847c;
        font-size: .85rem;
        margin-bottom: 8px;
    }

    .pengumuman-info-value {
        color: #26352c;
        font-size: .98rem;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .pengumuman-status {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: .8rem;
        font-weight: 700;
    }

    .pengumuman-status.publish {
        color: #0b5d3b;
        background: #dceee1;
    }

    .pengumuman-status.draft {
        color: #6b7280;
        background: #eceff1;
    }

    .pengumuman-divider {
        border: 0;
        border-top: 1px solid #e5ebe6;
        margin: 28px 0;
    }

    .pengumuman-isi-title {
        color: #0b5d3b;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .pengumuman-isi {
        color: #4b5a50;
        font-size: .98rem;
        line-height: 1.9;
        white-space: pre-line;
        overflow-wrap: anywhere;
    }

    .pengumuman-card-footer {
        padding: 18px 32px;
        background: #fbfcfb;
        border-top: 1px solid #e8eee9;
    }

    @media (max-width: 576px) {
        .detail-pengumuman {
            padding: 10px 0;
        }

        .pengumuman-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .pengumuman-header h2 {
            font-size: 1.5rem;
        }

        .pengumuman-card-header,
        .pengumuman-card-body {
            padding: 22px 18px;
        }

        .pengumuman-judul {
            font-size: 1.4rem;
        }

        .pengumuman-info {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .pengumuman-card-footer {
            padding: 16px 18px;
        }
    }
</style>

<div class="container pt-2 pb-4">
    <div class="detail-pengumuman">

        {{-- HEADER --}}
        <div class="pengumuman-header">
            <div>
                <h2>Detail Pengumuman</h2>
                <p>Informasi lengkap pengumuman sekolah.</p>
            </div>

            <a href="{{ route('admin.pengumuman.index') }}"
                class="btn-kembali-pengumuman">
                <i data-feather="arrow-left"></i>
                Kembali
            </a>
        </div>

        {{-- KARTU DETAIL --}}
        <div class="pengumuman-card">

            {{-- JUDUL --}}
            <div class="pengumuman-card-header">
                <span class="pengumuman-label">
                    Pengumuman Sekolah
                </span>

                <h1 class="pengumuman-judul">
                    {{ $pengumuman->judul }}
                </h1>
            </div>

            <div class="pengumuman-card-body">

                {{-- INFORMASI --}}
                <div class="pengumuman-info">

                    <div class="pengumuman-info-item">
                        <div class="pengumuman-info-label">
                            <i data-feather="calendar"
                                style="width:15px;height:15px;vertical-align:middle;margin-right:5px;">
                            </i>
                            Tanggal Pengumuman
                        </div>

                        <div class="pengumuman-info-value">
                            {{ \Carbon\Carbon::parse($pengumuman->tanggal)->translatedFormat('d F Y') }}
                        </div>
                    </div>

                    <div class="pengumuman-info-item">
                        <div class="pengumuman-info-label">
                            <i data-feather="flag"
                                style="width:15px;height:15px;vertical-align:middle;margin-right:5px;">
                            </i>
                            Status Pengumuman
                        </div>

                        <div class="pengumuman-info-value">
                            @if($pengumuman->status == 'publish')
                            <span class="pengumuman-status publish">
                                Dipublikasikan
                            </span>
                            @else
                            <span class="pengumuman-status draft">
                                Draft
                            </span>
                            @endif
                        </div>
                    </div>

                </div>

                <hr class="pengumuman-divider">

                {{-- ISI PENGUMUMAN --}}
                <div>
                    <h5 class="pengumuman-isi-title">
                        <i data-feather="file-text"
                            style="width:18px;height:18px;vertical-align:middle;margin-right:6px;">
                        </i>
                        Isi Pengumuman
                    </h5>

                    <div class="pengumuman-isi">{{ $pengumuman->isi }}</div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection