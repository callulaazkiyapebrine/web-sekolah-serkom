<!-- ================= FOOTER CSS ================= -->

<style>
    .footer {
        margin-top: 80px;
        padding: 65px 0 0;
        background: #063b27;
        color: #fff;
    }

    .footer-main {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1.35fr;
        gap: 70px;
    }

    .footer-brand {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 32px;
    }

    .footer-brand img {
        width: 58px;
        height: 58px;
        object-fit: contain;
    }

    .footer-brand h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
    }

    .footer-brand span {
        display: block;
        margin-top: 5px;
        color: #9bcdb5;
        font-size: 13px;
    }

    .footer-school h4,
    .footer-menu h4,
    .footer-contact h4 {
        margin: 0 0 18px;
        font-size: 15px;
        font-weight: 700;
    }

    .footer-visi {
        max-width: 450px;
        margin: 0 0 30px;
        color: #b9d5c7;
        font-size: 14px;
        line-height: 1.8;
    }

    .footer-social {
        display: flex;
        gap: 9px;
    }

    .footer-social a {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: white;
        text-decoration: none;
        background: rgba(255, 255, 255, .1);
        transition: .3s;
    }

    .footer-social a:hover {
        background: #198754;
        transform: translateY(-3px);
    }

    .footer-menu a {
        display: block;
        width: fit-content;
        margin-bottom: 12px;
        color: #b9d5c7;
        font-size: 14px;
        text-decoration: none;
        transition: .2s;
    }

    .footer-menu a:hover {
        color: #fff;
        transform: translateX(4px);
    }

    .footer-contact {
        max-width: 350px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        margin-bottom: 18px;
        color: #b9d5c7;
        font-size: 14px;
        line-height: 1.7;
    }

    .contact-icon {
        flex-shrink: 0;
        width: 22px;
        margin-top: 2px;
        font-size: 16px;
        text-align: center;
    }

    .contact-item span:last-child {
        word-break: break-word;
    }

    .footer-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 55px;
        padding: 22px 0;
        border-top: 1px solid rgba(255, 255, 255, .12);
    }

    .footer-bottom-brand {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .footer-bottom-brand img {
        width: 30px;
        height: 30px;
        object-fit: contain;
    }

    .footer-bottom-brand span {
        color: #d5e7de;
        font-size: 13px;
        font-weight: 600;
    }

    .footer-bottom p {
        margin: 0;
        color: rgba(255, 255, 255, .5);
        font-size: 12px;
        text-align: right;
    }

     @media (max-width: 992px) {

        .footer-main {
            grid-template-columns: 1fr 1fr;
            gap: 45px;
        }

        .footer-school {
            grid-column: 1 / -1;
        }

    }

    @media (max-width: 576px) {

        .footer {
            margin-top: 60px;
            padding-top: 50px;
        }

        .footer-main {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .footer-school {
            grid-column: auto;
        }

        .footer-bottom {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .footer-bottom p {
            text-align: left;
        }

    }
</style>

<!-- =====================================================
     FOOTER
====================================================== -->

<footer class="footer">

    <div class="container">

        <!-- ================= FOOTER MAIN ================= -->
        <div class="footer-main">

            <!-- ================= SEKOLAH ================= -->
            <div class="footer-school">

                <div class="footer-brand">

                   @if(isset($profilSekolah) && $profilSekolah && $profilSekolah->logo)
                        <img
                            src="{{ asset('storage/' . $profilSekolah->logo) }}"
                            alt="{{ $profilSekolah->nama_sekolah }}">
                    @endif

                    <div>
                        <h3>
                            {{ $profilSekolah->nama_sekolah ?? 'MAN 2 Tasikmalaya' }}
                        </h3>

                        <span>Madrasah Aliyah Negeri</span>
                    </div>

                </div>

                <h4>Ikuti Kami</h4>

                <div class="footer-social">

                   @if(isset($profilSekolah) && $profilSekolah && $profilSekolah->instagram)
                        <a href="{{ $profilSekolah->instagram }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                    @endif

                  @if(isset($profilSekolah) && $profilSekolah && $profilSekolah->tiktok)
                        <a href="{{ $profilSekolah->tiktok }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="TikTok">
                            <i class="bi bi-tiktok"></i>
                        </a>
                    @endif

                   @if(isset($profilSekolah) && $profilSekolah && $profilSekolah->facebook)
                        <a href="{{ $profilSekolah->facebook }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                    @endif

                   @if(isset($profilSekolah) && $profilSekolah && $profilSekolah->youtube)
                        <a href="{{ $profilSekolah->youtube }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="YouTube">
                            <i class="bi bi-youtube"></i>
                        </a>
                    @endif

                </div>

            </div>

            <!-- ================= MENU ================= -->
            <div class="footer-menu">

                <h4>Menu Utama</h4>

                <a href="{{ route('public.dashboard') }}">Beranda</a>

                <a href="{{ route('public.profil') }}">Profil Sekolah</a>

                <a href="{{ route('public.guru') }}">Guru</a>

                <a href="{{ route('public.berita') }}">Berita</a>

                <a href="{{ route('public.ekstrakurikuler') }}">
                    Ekstrakurikuler
                </a>

                <a href="{{ route('public.galeri') }}">Galeri</a>

            </div>

            <!-- ================= INFORMASI SEKOLAH ================= -->
            <div class="footer-contact">

                <h4>Informasi Sekolah</h4>

                <!-- LOKASI -->
                <div class="contact-item">

                    <span class="contact-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </span>

                    <span>
                        {{ $profilSekolah->alamat ?? '-' }}
                    </span>

                </div>

                <!-- NOMOR TELEPON -->
                <div class="contact-item">

                    <span class="contact-icon">
                        <i class="bi bi-telephone-fill"></i>
                    </span>

                    <span>
                        {{ $profilSekolah->kontak ?? '-' }}
                    </span>

                </div>

            </div>

        </div>
        <!-- END FOOTER MAIN -->


        <!-- ================= FOOTER BOTTOM ================= -->
        <div class="footer-bottom">

            <div class="footer-bottom-brand">
@if(isset($profilSekolah) && $profilSekolah && $profilSekolah->logo)
                    <img
                        src="{{ asset('storage/' . $profilSekolah->logo) }}"
                        alt="{{ $profilSekolah->nama_sekolah }}">
                @endif

                <span>
                    {{ $profilSekolah->nama_sekolah ?? 'MAN 2 Tasikmalaya' }}
                </span>

            </div>

            <p>
                © {{ date('Y') }}
                {{ $profilSekolah->nama_sekolah ?? 'MAN 2 Tasikmalaya' }}
                · All rights reserved.
            </p>

        </div>
        <!-- END FOOTER BOTTOM -->

    </div>

</footer>