<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('pages/style.css') }}" />
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <title>SIM-KEDIS - Sistem Informasi Manajemen Kendaraan Dinas</title>
</head>

<body>
    <nav>
        <div class="nav__container">
            <div class="nav__header">
                <div class="nav__logo">
                    <a href="#" class="logo"><i class="ri-bus-fill"></i> SIM-KEDIS</a>
                </div>
                <div class="nav__menu__btn" id="menu-btn">
                    <i class="ri-menu-line"></i>
                </div>
            </div>
            <ul class="nav__links" id="nav-links">
                <li><a href="#home">BERANDA</a></li>
                <li><a href="#about">TENTANG</a></li>
                <li><a href="#fitur">FITUR</a></li>
                <li><a href="#kendaraan">DATA KENDARAAN</a></li>
                <li><a href="#contact">KONTAK</a></li>
                <li class="nav__btns-mobile">
                    <a href="{{ route('login') }}" class="btn">Login</a>
                </li>
            </ul>
            <div class="nav__btns">
                <a href="{{ route('login') }}" class="btn">Login</a>
            </div>
        </div>
    </nav>

    <header id="home">
        <div class="header__container">
            <div class="header__content">
                <p>
                    SIM-KEDIS adalah sistem informasi digital untuk pendataan, monitoring, dan pengelolaan kendaraan
                    dinas milik Dinas Perhubungan Kota Cirebon. Semua data kendaraan, status pajak, dan dokumen
                    terintegrasi dalam satu aplikasi yang mudah diakses.
                </p>
                <h1>
                    SIM-KEDIS<br />
                    <span style="font-size:1.2rem;">Sistem Informasi Manajemen Kendaraan Dinas</span>
                </h1>
                <div class="header__btns">
                    <a href="#kendaraan" class="btn">Lihat Data Kendaraan Dinas</a>
                </div>
            </div>
            <div class="header__image">
                <img src="pages/img/car.png" alt="SIM KEDIS - Kendaraan Dinas" />
            </div>
        </div>
    </header>

    <section class="section__container banner__container">
        <div class="banner__card">
            <h4>100+</h4>
            <p>Kendaraan Dinas Terdata</p>
        </div>
        <div class="banner__card">
            <h4>20+</h4>
            <p>Pegawai Pemegang Kendaraan</p>
        </div>
        <div class="banner__card">
            <h4>99%</h4>
            <p>Data Selalu Terupdate</p>
        </div>
    </section>

    <section class="section__container showcase__container" id="kendaraan">
        <div class="showcase__card">
            <h2>SCAN QR Kendaraan</h2>
            <p>
                Gunakan fitur scan QR Code pada kendaraan dinas untuk melihat detail informasi kendaraan secara cepat
                dan akurat melalui SIM KEDIS. Setiap kendaraan dinas Dishub Kota Cirebon telah dilengkapi QR Code untuk
                kemudahan akses data.
            </p>
            <a href="#" class="btn scan-btn">
                <span><i class="ri-qr-code-line"></i></span>
                Scan QR Kendaraan
            </a>
        </div>
    </section>

    <section class="section__container" id="scan-result" style="display:none;">
        <h2 class="section__header">DATA KENDARAAN DINAS / OPERASIONAL</h2>
        <h4>DINAS PERHUBUNGAN KOTA CIREBON - {{ date('Y') }}</h4>
        <div class="kendaraan-card">
            <div class="kendaraan-foto">
                <img id="fotoKendaraan" src="" alt="Foto Kendaraan">
            </div>
            <div class="kendaraan-detail">
                <h1 id="noPolisi"></h1>
                <p><span id="jenis">-</span></p>
                <p><span id="merk">-</span></p>
                <p><span id="tahun">-</span></p>
                <p><span id="noRangka">-</span></p>
                <p><span id="noMesin">-</span></p>
                <p><span id="noBpkb">-</span></p>
                <p><span id="pemilik">-</span></p>
                <p><span id="unitKerja">-</span></p>
            </div>
        </div>
    </section>

    <!-- Modal Scan QR -->
    <div class="modal" id="scanModal"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
    background:rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index:9999;">
        <div style="background:#fff; padding:20px; border-radius:8px; max-width:500px; width:90%;">
            <h2 style="text-align: center; margin: 1rem;">Scan QR Kendaraan</h2>
            <div id="reader" style="width:100%;"></div>
            <br>
            <button onclick="closeScanner()" class="btn" style="cursor:pointer; border: none; display: block; margin: 0 auto;">Tutup</button>
        </div>
    </div>

    <section class="section__container destination__container" id="about">
        <h2 class="section__header">Tentang SIM-KEDIS</h2>
        <div class="destination__grid">
            <div class="destination__card">
                <span><i class="ri-check-line"></i></span>
                <div class="destination__card__details">
                    <h4>Data Lengkap Kendaraan</h4>
                    <p>
                        Semua kendaraan dinas tercatat digital, mulai dari plat nomor, merk, jenis, tahun, hingga
                        pemegang kendaraan. Data mudah diakses dan selalu terupdate.
                    </p>
                </div>
            </div>
            <div class="destination__card">
                <span><i class="ri-calendar-check-line"></i></span>
                <div class="destination__card__details">
                    <h4>Status Pajak & STNK</h4>
                    <p>
                        Pantau masa berlaku pajak dan STNK kendaraan dinas secara real-time. Sistem memberikan
                        notifikasi agar dokumen kendaraan selalu aktif.
                    </p>
                </div>
            </div>
            <div class="destination__card">
                <span><i class="ri-qr-code-line"></i></span>
                <div class="destination__card__details">
                    <h4>QR Code Kendaraan</h4>
                    <p>
                        Setiap kendaraan dinas memiliki QR Code untuk akses detail data kendaraan secara praktis melalui
                        smartphone.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="section__container journey__container" id="fitur">
        <h2 class="section__header">Fitur Utama SIM KEDIS</h2>
        <p class="section__description">Manajemen kendaraan dinas yang efisien, akurat, dan terintegrasi</p>
        <div class="journey__grid">
            <div class="journey__card">
                <div class="journey__card__bg">
                    <span><i class="ri-database-2-line"></i></span>
                    <h4>Pendataan Kendaraan</h4>
                </div>
                <div class="journey__card__content">
                    <h4>Data kendaraan dinas Dishub</h4>
                    <p>
                        Setiap kendaraan dinas didata secara digital, lengkap dengan identitas, pemegang, dan status
                        dokumen. Data terpusat dan mudah dicari.
                    </p>
                </div>
            </div>
            <div class="journey__card">
                <div class="journey__card__bg">
                    <span><i class="ri-calendar-check-line"></i></span>
                    <h4>Monitoring Pajak & STNK</h4>
                </div>
                <div class="journey__card__content">
                    <h4>Pengingat otomatis</h4>
                    <p>
                        Sistem memberikan pengingat otomatis untuk masa berlaku pajak dan STNK, sehingga kendaraan dinas
                        selalu legal dan siap digunakan.
                    </p>
                </div>
            </div>
            <div class="journey__card">
                <div class="journey__card__bg">
                    <span><i class="ri-qr-code-line"></i></span>
                    <h4>QR Code Kendaraan</h4>
                </div>
                <div class="journey__card__content">
                    <h4>Akses cepat data kendaraan</h4>
                    <p>
                        QR Code pada kendaraan memudahkan akses data detail kendaraan hanya dengan satu kali scan
                        menggunakan smartphone.
                    </p>
                </div>
            </div>
        </div>
    </section>

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
                <br>
                <br>
                <ul class="footer__socials">
                    <li>
                        <a href="https://facebook.com/dishubcirebon"><i class="ri-facebook-fill"></i></a>
                    </li>
                    <li>
                        <a href="https://instagram.com/dishubcirebon"><i class="ri-instagram-line"></i></a>
                    </li>
                    <li>
                        <a href="https://youtube.com/dishubcirebon"><i class="ri-youtube-line"></i></a>
                    </li>
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
                    <li>
                        <a href="tel:0231234567">
                            <span><i class="ri-phone-fill"></i></span> 021 4728365
                        </a>
                    </li>
                    <li>
                        <a href="mailto:info@dishubcirebon.com">
                            <span><i class="ri-record-mail-line"></i></span>
                            info@dishubcirebon.com
                        </a>
                    </li>
                    <li>
                        <a href="https://share.google/TUffV75DxfvZgUHqK" target="_blank">
                            <span><i class="ri-map-pin-2-fill"></i></span> Jl. Terusan Pemuda No.8, Sunyaragi, Kec.
                            Kesambi, Kota Cirebon, Jawa Barat 45132, Indonesia
                        </a>
                    </li>
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

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="{{ asset('pages/main.js') }}"></script>
    <script>
        let html5QrCode;

        // Buka modal scanner
        document.querySelector(".scan-btn").addEventListener("click", function(e) {
            e.preventDefault();
            document.getElementById("scanModal").style.display = "flex";

            html5QrCode = new Html5Qrcode("reader");

            // Fungsi masking
            function maskData(data, visible = 4) {
                if (!data) return '-';
                return data.slice(0, visible) + '*'.repeat(Math.max(data.length - visible, 0));
            }

            function startScanner(cameraConfig) {
                html5QrCode.start(
                    cameraConfig, {
                        fps: 10,
                        qrbox: 250
                    },
                    (decodedText) => {
                        // Stop scanner setelah berhasil scan
                        html5QrCode.stop().then(() => {
                            document.getElementById("scanModal").style.display = "none";
                        });

                        // Fetch detail kendaraan
                        fetch(decodedText)
                            .then(res => res.json())
                            .then(data => {
                                if (data.error) {
                                    document.querySelector(".kendaraan-detail").innerHTML =
                                        `<p style="color:red;">${data.error}</p>`;
                                    return;
                                }

                                document.getElementById("scan-result").style.display = "block";
                                document.querySelector(".kendaraan-detail").innerHTML = `
                                <h1 style="color: #0b3d91">${data.no_polisi}</h1>
                                <div class="kendaraan-info">
                                    <p><b>Jenis Kendaraan</b> ${data.jenis}</p>
                                    <p><b>Merk</b> ${data.merk}</p>
                                    <p><b>Tahun</b> ${data.tahun}</p>
                                    <p><b>No. Rangka</b> ${maskData(data.no_rangka,6)}</p>
                                    <p><b>No. Mesin</b> ${maskData(data.no_mesin,4)}</p>
                                    <p><b>No. BPKB</b> ${maskData(data.no_bpkb,2)}</p>
                                    <p><b>Pemegang</b> ${data.pemilik}</p>
                                    <p><b>Unit Kerja :</b> ${data.unit_kerja ?? '-'}</p>
                                </div>
                            `;

                                if (data.foto) {
                                    document.getElementById("fotoKendaraan").src = data.foto;
                                } else {
                                    document.getElementById("fotoKendaraan").src = "pages/img/no-image.png";
                                }
                            })
                            .catch(() => {
                                document.querySelector(".kendaraan-detail").innerHTML =
                                    "<p style='color:red;'>Gagal mengambil data kendaraan. QR Code tidak valid.</p>";
                            });
                    },
                    (errorMessage) => {
                        // bisa kosongin biar ga flooding
                    }
                ).catch(() => {
                    // fallback ke kamera depan
                    if (cameraConfig.facingMode !== "user") {
                        startScanner({
                            facingMode: "user"
                        });
                    }
                });
            }

            // Mulai scan pakai kamera belakang
            startScanner({
                facingMode: {
                    exact: "environment"
                }
            });
        });

        // Tutup modal scanner
        function closeScanner() {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    document.getElementById("scanModal").style.display = "none";
                }).catch(err => console.log(err));
            } else {
                document.getElementById("scanModal").style.display = "none";
            }
        }
    </script>


</body>

</html>
