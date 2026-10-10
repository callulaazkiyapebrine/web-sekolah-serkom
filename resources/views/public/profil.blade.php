@extends('public.layouts.app')

@section('title', 'Profil - MAN 2 Tasikmalaya')

@section('content')

@php
$profil = $profilSekolah;

$visiMisi = $profil->visi_misi ?? '';
$visi = '';
$misi = '';

if (preg_match('/VISI\s*:?(.*?)(?=\bMISI\b|$)/is', $visiMisi, $hasilVisi)) {
$visi = trim($hasilVisi[1]);
}

if (preg_match('/MISI\s*:?(.*)$/is', $visiMisi, $hasilMisi)) {
$misi = trim($hasilMisi[1]);
}

$daftarMisi = array_values(array_filter(
array_map('trim', preg_split('/\r\n|\r|\n/', $misi))
));
@endphp

<style>
    .profil-section {
        padding: 55px 0 75px;
        background: #f5f8f6;
    }

    /* IDENTITAS SEKOLAH */
    .profil-header {
        background: #fff;
        border: 1px solid #e5eee8;
        border-radius: 16px;
        padding: 35px;
        margin-bottom: 25px;
    }

    .profil-identitas {
        text-align: center;
        padding-bottom: 28px;
        border-bottom: 1px solid #edf1ee;
        margin-bottom: 25px;
    }

    .profil-logo {
        width: 95px;
        height: 95px;
        object-fit: contain;
        margin-bottom: 15px;
    }

    .profil-identitas h1 {
        color: #145c3a;
        font-size: 28px;
        font-weight: 750;
        margin: 0;
        line-height: 1.4;
    }

    .profil-subtitle {
        color: #168653;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.5px;
        margin-top: 8px;
    }

    /* DESKRIPSI SEKOLAH */
    .profil-deskripsi-title {
        color: #194a32;
        font-size: 19px;
        font-weight: 700;
        margin-bottom: 15px;
        padding-left: 12px;
        border-left: 4px solid #198754;
    }

    .profil-deskripsi {
        max-width: 900px;
        margin: 0 auto;
        color: #59675f;
        font-size: 15px;
        line-height: 1.95;
        text-align: justify;
        white-space: pre-line;
        overflow-wrap: anywhere;
    }

    /* VISI DAN MISI */

    .profil-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
        align-items: stretch;
    }

    .profil-card {
        height: 100%;
        min-width: 0;
        background: #fff;
        border: 1px solid #e5eee8;
        border-radius: 16px;
        padding: 27px;
        box-shadow: 0 5px 18px rgba(20, 70, 45, .04);
    }



    .profil-card-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
        padding-bottom: 17px;
        border-bottom: 1px solid #edf1ee;
    }

    .profil-icon {
        width: 43px;
        height: 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 12px;
        background: #e7f4eb;
        color: #167447;
        font-size: 23px;
    }

    .profil-card-title h2 {
        color: #194a32;
        font-size: 21px;
        font-weight: 700;
        margin: 0;
    }

    .profil-card p {
        color: #59675f;
        font-size: 14px;
        line-height: 1.9;
        margin: 0;
        white-space: pre-line;
        overflow-wrap: anywhere;
    }

    .profil-misi {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .profil-misi li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 0;
        color: #59675f;
        font-size: 14px;
        line-height: 1.8;
        border-bottom: 1px solid #edf1ee;
    }

    .profil-misi li:first-child {
        padding-top: 0;
    }

    .profil-misi li:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .profil-misi .nomor {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        flex-shrink: 0;
        border-radius: 8px;
        background: #e7f4eb;
        color: #167447;
        font-size: 13px;
        font-weight: 700;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .profil-section {
            padding: 30px 0 45px;
        }

        .profil-header {
            padding: 23px 19px;
        }

        .profil-identitas {
            padding-bottom: 22px;
            margin-bottom: 22px;
        }

        .profil-identitas h1 {
            font-size: 23px;
        }

        .profil-deskripsi {
            font-size: 14px;
            line-height: 1.85;
            text-align: left;
        }

        .profil-grid {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .profil-card {
            padding: 22px;
        }
    }
</style>

<section class="profil-section">
    <div class="container">

        {{-- IDENTITAS DAN DESKRIPSI SEKOLAH --}}
        <div class="profil-header">

            <div class="profil-identitas">

                @if(!empty($profil->logo))
                <img
                    src="{{ asset('storage/' . $profil->logo) }}"
                    alt="Logo MAN 2 Tasikmalaya"
                    class="profil-logo">
                @endif

                <h1>
                    {{ $profil->nama_sekolah ?? 'MAN 2 TASIKMALAYA' }}
                </h1>

                <div class="profil-subtitle">
                    MADRASAH ALIYAH NEGERI
                </div>

            </div>

            @if(!empty($profil->deskripsi))
            <h2 class="profil-deskripsi-title">
                Tentang Madrasah
            </h2>

            <div class="profil-deskripsi">{{ $profil->deskripsi }}</div>
            @endif

        </div>

        {{-- VISI DAN MISI --}}
        <div class="profil-grid">

            <div class="profil-card">

                <div class="profil-card-title">
                    <div class="profil-icon">◎</div>
                    <h2>Visi</h2>
                </div>

                <p>{{ $visi ?: 'Visi madrasah belum tersedia.' }}</p>

            </div>

            <div class="profil-card">

                <div class="profil-card-title">
                    <div class="profil-icon">✦</div>
                    <h2>Misi</h2>
                </div>

                @if(count($daftarMisi))
                <ul class="profil-misi">
                    @foreach($daftarMisi as $index => $isiMisi)
                    <li>
                        <span class="nomor">
                            {{ $index + 1 }}
                        </span>

                        <span>
                            {{ preg_replace('/^\d+[\.\)]\s*/', '', $isiMisi) }}
                        </span>
                    </li>
                    @endforeach
                </ul>
                @else
                <p>Misi madrasah belum tersedia.</p>
                @endif

            </div>

        </div>

    </div>
</section>

@endsection