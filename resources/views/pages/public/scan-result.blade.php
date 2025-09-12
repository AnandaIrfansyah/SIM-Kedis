<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('pages/style.css') }}" />
    <title>SIM-KEDIS - Sistem Informasi Manajemen Kendaraan Dinas</title>
</head>

<body>
    <main>
        @if (isset($error))
            <section class="section__container" id="scan-result">
                <div class="alert alert-danger text-center">
                    {{ $error }}
                </div>
            </section>
        @elseif(isset($data))
            <section class="section__container" id="scan-result">
                <h2 class="section__header">DATA KENDARAAN DINAS / OPERASIONAL</h2>
                <h4>DINAS PERHUBUNGAN KOTA CIREBON - {{ date('Y') }}</h4>

                <div class="kendaraan-card">
                    <!-- Plat nomor -->
                    <h1>{{ $data['no_polisi'] }}</h1>

                    <div class="kendaraan-body">
                        <!-- Foto -->
                        <div class="kendaraan-foto">
                            @if ($data['foto'])
                                <img src="{{ $data['foto'] }}" alt="Foto Kendaraan">
                            @else
                                <span class="text-muted">Tidak ada foto</span>
                            @endif
                        </div>

                        <!-- Detail kendaraan -->
                        <div class="kendaraan-info-2col">
                            <div class="col">
                                <div class="row"><span class="label">Jenis
                                        Kendaraan</span><span>{{ $data['jenis'] }}</span></div>
                                <div class="row"><span class="label">Merk /
                                        Tipe</span><span>{{ $data['merk'] }}</span></div>
                                <div class="row"><span class="label">Tahun</span><span>{{ $data['tahun'] }}</span>
                                </div>
                                <div class="row"><span class="label">No.
                                        Rangka</span><span>{{ $data['no_rangka'] }}</span></div>
                            </div>
                            <div class="col">
                                <div class="row"><span class="label">No.
                                        Mesin</span><span>{{ $data['no_mesin'] }}</span></div>
                                <div class="row"><span class="label">No.
                                        BPKB</span><span>{{ $data['no_bpkb'] }}</span></div>
                                <div class="row"><span
                                        class="label">Pemegang</span><span>{{ $data['pemilik'] }}</span></div>
                                <div class="row"><span class="label">Unit
                                        Kerja</span><span>{{ $data['unit_kerja'] }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="ri-qr-scan-2-line"></i> Scan di Dashboard
                    </a>
                    <p class="mt-2 text-muted small">
                        Anda juga bisa melakukan scan langsung melalui dashboard untuk hasil lebih cepat.
                    </p>
                </div>
            </section>
        @endif
    </main>

    {{-- Footer bawaan --}}
    <footer id="contact">
        <div class="section__container footer__container">
            <div class="footer__col">
                <div class="footer__logo">
                    <a href="#" class="logo"><i class="ri-bus-fill"></i> SIM KEDIS</a>
                </div>
                <p>
                    SIM KEDIS - Sistem Informasi Manajemen Kendaraan Dinas<br />
                    Dinas Perhubungan Kota Cirebon
                </p>
                <span class="footer__tagline">"Mudah, Akurat, Terintegrasi"</span>
                <br><br>
                <ul class="footer__socials">
                    <li><a href="https://facebook.com/dishubcirebon"><i class="ri-facebook-fill"></i></a></li>
                    <li><a href="https://instagram.com/dishubcirebon"><i class="ri-instagram-line"></i></a></li>
                    <li><a href="https://youtube.com/dishubcirebon"><i class="ri-youtube-line"></i></a></li>
                </ul>
            </div>
            <div class="footer__col">
                <h4>Menu</h4>
                <ul class="footer__links">
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#kendaraan">Kendaraan</a></li>
                    <li><a href="#fitur">Fitur</a></li>
                    <li><a href="#about">Tentang</a></li>
                </ul>
            </div>
            <div class="footer__col">
                <h4>Kontak</h4>
                <ul class="footer__links">
                    <li><a href="tel:0231234567"><i class="ri-phone-fill"></i> 021 4728365</a></li>
                    <li><a href="mailto:info@dishubcirebon.com"><i class="ri-record-mail-line"></i>
                            info@dishubcirebon.com</a></li>
                    <li><a href="https://share.google/TUffV75DxfvZgUHqK" target="_blank"><i
                                class="ri-map-pin-2-fill"></i> Jl. Terusan Pemuda No.8, Sunyaragi, Kec. Kesambi, Kota
                            Cirebon</a></li>
                </ul>
            </div>
            <div class="footer__col">
                <h4>Pertanyaan</h4>
                <form action="#!">
                    <input type="text" placeholder="Masukkan pertanyaan Anda" />
                    <button class="btn">Kirim</button>
                </form>
            </div>
        </div>
        <div class="footer__bar">
            Copyright © 2025 <a class="text-white" href="https://dishubcirebon.com/" target="_blank">Dinas
                Perhubungan Kota Cirebon</a>
        </div>
    </footer>
</body>

</html>
