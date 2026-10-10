
@extends('public.layouts.app')

@section('title', 'Galeri - MAN 2 Tasikmalaya')

@section('content')

<style>
    .galeri-section {
        padding: 80px 0;
        background: #f8faf9;
    }

    .galeri-header {
        max-width: 700px;
        margin: 0 auto 50px;
        text-align: center;
    }

    .galeri-header .label {
        display: inline-block;
        margin-bottom: 10px;
        color: #006b3c;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .galeri-header h1 {
        margin-bottom: 12px;
        color: #1f2937;
        font-size: 36px;
        font-weight: 700;
    }

    .galeri-header p {
        margin: 0;
        color: #6b7280;
        font-size: 16px;
        line-height: 1.7;
    }

    .galeri-card {
        height: 100%;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e5eee9;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .galeri-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 107, 60, 0.12);
    }

    .galeri-media {
        width: 100%;
        height: 230px;
        overflow: hidden;
        background: #e8f5ee;
    }

    .galeri-media img,
    .galeri-media video {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .galeri-card:hover .galeri-media img {
        transform: scale(1.04);
    }

    .galeri-no-foto {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        height: 100%;
        color: #6b7280;
        font-size: 14px;
    }

    .galeri-no-foto i {
        width: 35px;
        height: 35px;
        color: #198754;
    }

    .galeri-info {
        padding: 22px;
    }

    .galeri-info h3 {
        margin: 0 0 10px;
        color: #1f2937;
        font-size: 18px;
        font-weight: 700;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }

    .galeri-tanggal {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 14px;
        color: #6b7280;
        font-size: 13px;
    }

    .galeri-tanggal i {
        width: 15px;
        height: 15px;
        color: #198754;
    }

    .galeri-jumlah {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 15px;
        color: #6b7280;
        font-size: 13px;
    }

    .galeri-jumlah span {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .galeri-jumlah i {
        width: 15px;
        height: 15px;
        color: #198754;
    }

    .galeri-info p {
        margin: 0 0 18px;
        color: #6b7280;
        font-size: 14px;
        line-height: 1.7;
    }

    .galeri-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 14px;
        border-radius: 6px;
        background: #198754;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s ease;
    }

    .galeri-link:hover {
        background: #0b5d3b;
        color: #fff;
    }

    .galeri-link i {
        width: 15px;
        height: 15px;
    }

    .galeri-kosong {
        padding: 60px 20px;
        text-align: center;
        background: #fff;
        border: 1px dashed #b9dcc9;
        border-radius: 18px;
    }

    .galeri-kosong i {
        width: 42px;
        height: 42px;
        margin-bottom: 15px;
        color: #198754;
    }

    .galeri-kosong h3 {
        margin-bottom: 8px;
        color: #1f2937;
        font-size: 22px;
    }

    .galeri-kosong p {
        margin: 0;
        color: #6b7280;
    }

    .galeri-pagination {
        display: flex;
        justify-content: center;
        margin-top: 35px;
    }

    @media (max-width: 575.98px) {
        .galeri-section {
            padding: 55px 0;
        }

        .galeri-header h1 {
            font-size: 28px;
        }

        .galeri-header p {
            font-size: 15px;
        }

        .galeri-media {
            height: 240px;
        }
    }
</style>

<section class="galeri-section">
    <div class="container">

        {{-- HEADER --}}
        <div class="galeri-header">
            <span class="label">Dokumentasi Sekolah</span>

            <h1>Galeri Kegiatan</h1>

            <p>
                Dokumentasi kegiatan dan momen berharga
                keluarga besar MAN 2 Tasikmalaya.
            </p>
        </div>

        {{-- DATA GALERI --}}
        @if($galeri->count())

            <div class="row g-4">

                @foreach($galeri as $item)

                    @php
                        $mediaSampul = $item->media->first();
                        $jumlahFoto = $item->media->where('kategori', 'foto')->count();
                        $jumlahVideo = $item->media->where('kategori', 'video')->count();
                        $idAlbum = \Illuminate\Support\Facades\Crypt::encrypt($item->id_album);
                    @endphp

                    <div class="col-md-6 col-lg-4">

                        <div class="galeri-card">

                            {{-- FOTO SAMPUL --}}
                            <div class="galeri-media">

                                @if($mediaSampul && $mediaSampul->kategori === 'foto')

                                    <img
                                        src="{{ asset('storage/' . $mediaSampul->file) }}"
                                        alt="{{ $item->judul }}"
                                        loading="lazy">

                                @elseif($mediaSampul && $mediaSampul->kategori === 'video')

                                    @php
                                        $urlVideo = $mediaSampul->file;
                                        $videoId = null;

                                        if (preg_match(
                                            '~(?:youtube\.com/watch\?v=|youtu\.be/|youtube\.com/embed/|youtube\.com/shorts/)([a-zA-Z0-9_-]{11})~',
                                            $urlVideo,
                                            $cocok
                                        )) {
                                            $videoId = $cocok[1];
                                        }
                                    @endphp

                                    @if($videoId)
                                        <img
                                            src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                            alt="{{ $item->judul }}"
                                            loading="lazy">
                                    @elseif(\Illuminate\Support\Str::startsWith($urlVideo, ['http://', 'https://']))
                                        <div class="galeri-no-foto">
                                            <i data-feather="video"></i>
                                            <span>Album berisi video</span>
                                        </div>
                                    @else
                                        <video preload="metadata" muted>
                                            <source src="{{ asset('storage/' . $urlVideo) }}">
                                        </video>
                                    @endif

                                @else

                                    <div class="galeri-no-foto">
                                        <i data-feather="image"></i>
                                        <span>Belum ada media</span>
                                    </div>

                                @endif

                            </div>

                            {{-- INFORMASI ALBUM --}}
                            <div class="galeri-info">

                                <h3>{{ $item->judul }}</h3>

                                <div class="galeri-tanggal">
                                    <i data-feather="calendar"></i>
                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                </div>

                                <div class="galeri-jumlah">
                                    <span>
                                        <i data-feather="image"></i>
                                        {{ $jumlahFoto }} Foto
                                    </span>

                                    <span>
                                        <i data-feather="video"></i>
                                        {{ $jumlahVideo }} Video
                                    </span>
                                </div>

                                @if($item->keterangan)
                                    <p>
                                        {{ \Illuminate\Support\Str::limit($item->keterangan, 100) }}
                                    </p>
                                @endif

                                <a
                                    href="{{ route('public.galeri.show', ['id' => $idAlbum]) }}"
                                    class="galeri-link">
                                    Lihat Album
                                    <i data-feather="arrow-right"></i>
                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            {{-- PAGINATION --}}
            @if(method_exists($galeri, 'links'))
                <div class="galeri-pagination">
                    {{ $galeri->links() }}
                </div>
            @endif

        @else

            {{-- JIKA DATA KOSONG --}}
            <div class="galeri-kosong">
                <i data-feather="image"></i>

                <h3>Galeri Belum Tersedia</h3>

                <p>
                    Dokumentasi kegiatan sekolah belum ditambahkan.
                </p>
            </div>

        @endif

    </div>
</section>

@endsection
