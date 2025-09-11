const menuBtn = document.getElementById("menu-btn");
const navLinks = document.getElementById("nav-links");
const menuBtnIcon = menuBtn.querySelector("i");

menuBtn.addEventListener("click", () => {
    navLinks.classList.toggle("open");
    const isOpen = navLinks.classList.contains("open");
    menuBtnIcon.setAttribute(
        "class",
        isOpen ? "ri-close-line" : "ri-menu-line"
    );
});

// Tutup menu jika klik link di menu
navLinks.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
        navLinks.classList.remove("open");
        menuBtnIcon.setAttribute("class", "ri-menu-line");
    });
});

const scrollRevealOption = {
    origin: "bottom",
    distance: "50px",
    duration: 1000,
};

// Correct way to use ScrollReveal:
ScrollReveal().reveal(".header__image img", {
    ...scrollRevealOption,
    origin: "right",
});

ScrollReveal().reveal(".header__content p", {
    ...scrollRevealOption,
    delay: 500,
});

ScrollReveal().reveal(".header__content h1", {
    ...scrollRevealOption,
    delay: 1000,
});

ScrollReveal().reveal(".header__btns", {
    ...scrollRevealOption,
    delay: 1500,
});

ScrollReveal().reveal(".destination__card", {
    ...scrollRevealOption,
    interval: 500,
});

ScrollReveal().reveal(".showcase__image img", {
    ...scrollRevealOption,
    origin: "left",
});

ScrollReveal().reveal(".showcase__content h4", {
    ...scrollRevealOption,
    delay: 500,
});

ScrollReveal().reveal(".showcase__content p", {
    ...scrollRevealOption,
    delay: 1000,
});

ScrollReveal().reveal(".showcase__btn", {
    ...scrollRevealOption,
    delay: 1500,
});

ScrollReveal().reveal(".banner__card", {
    ...scrollRevealOption,
    interval: 500,
});

ScrollReveal().reveal(".discover__card", {
    ...scrollRevealOption,
    interval: 500,
});

const swiper = new Swiper(".swiper", {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

let html5QrCode;
let currentCameraId;

// Buka modal scanner
document
    .querySelector(".scan-btn")
    .addEventListener("click", async function (e) {
        e.preventDefault();
        document.getElementById("scanModal").style.display = "flex";

        // Hapus pesan error lama
        let errorMsg = document.getElementById("scanErrorMsg");
        if (errorMsg) errorMsg.remove();

        html5QrCode = new Html5Qrcode("reader");

        try {
            const devices = await Html5Qrcode.getCameras();
            if (devices && devices.length) {
                // Buat dropdown pilih kamera
                let cameraSelect = document.createElement("select");
                cameraSelect.id = "cameraSelect";
                cameraSelect.style.display = "block";
                cameraSelect.style.margin = "10px auto";
                cameraSelect.style.padding = "8px";
                cameraSelect.style.width = "100%";

                devices.forEach((d, idx) => {
                    let option = document.createElement("option");
                    option.value = d.id;
                    option.text = d.label || `Camera ${idx + 1}`;
                    cameraSelect.appendChild(option);
                });

                // Sisipkan dropdown di atas tombol tutup
                const modalContent = document.querySelector("#scanModal div");
                const closeBtn = modalContent.querySelector("button");
                // Hapus dropdown lama jika ada
                let oldSelect = document.getElementById("cameraSelect");
                if (oldSelect) oldSelect.remove();
                modalContent.insertBefore(cameraSelect, closeBtn);

                // Kamera default pertama
                currentCameraId = cameraSelect.value;
                startScanner(currentCameraId);

                // Ganti kamera saat user pilih
                cameraSelect.addEventListener("change", function () {
                    currentCameraId = this.value;
                    restartScanner(currentCameraId);
                });
            } else {
                showScanError("Perangkat tidak memiliki kamera yang tersedia.");
            }
        } catch (err) {
            showScanError(
                "Tidak bisa mengakses kamera. Pastikan izin kamera diaktifkan."
            );
        }
    });

function showScanError(msg, showCloseBtn = false) {
    document.querySelectorAll("#scanErrorMsg").forEach((el) => el.remove());

    let modalContent = document.querySelector("#scanModal div");
    let errorMsg = document.createElement("div");
    errorMsg.id = "scanErrorMsg";
    errorMsg.style.color = "red";
    errorMsg.style.textAlign = "center";
    errorMsg.style.margin = "10px 0";
    errorMsg.innerHTML = msg;
    if (showCloseBtn) {
        let btn = document.createElement("button");
        btn.textContent = "Tutup";
        btn.className = "btn";
        btn.style.marginTop = "10px";
        btn.onclick = function (e) {
            e.stopPropagation(); // Agar tidak ikut event modal
            closeScanner();
        };
        errorMsg.appendChild(btn);
    }
    modalContent.insertBefore(errorMsg, modalContent.firstChild);
}

// Pastikan juga di startScanner dan restartScanner selalu hapus error lama
function maskData(data, visible = 4) {
    if (!data) return "-";
    return (
        data.slice(0, visible) + "*".repeat(Math.max(data.length - visible, 0))
    );
}

function startScanner(cameraId) {
    document.querySelectorAll("#scanErrorMsg").forEach((el) => el.remove());

    // Bersihkan pesan error sebelum mulai scanner
    let errorMsg = document.getElementById("scanErrorMsg");
    if (errorMsg) errorMsg.remove();

    html5QrCode
        .start(cameraId, { fps: 10, qrbox: 250 }, (decodedText) => {
            html5QrCode.stop().then(() => {
                document.getElementById("scanModal").style.display = "none";
            });

            fetch(decodedText)
                .then((res) => res.json())
                .then((data) => {
                    if (data.error) {
                        showScanError("Data Tidak Ditemukan: " + data.error);
                        return;
                    }

                    document.getElementById("scan-result").style.display =
                        "block";
                    document.querySelector(".kendaraan-detail").innerHTML = `
                        <h1 style="color: #0b3d91">${data.no_polisi}</h1>
                        <div class="kendaraan-info">
                            <p><b>Jenis Kendaraan</b> : ${data.jenis}</p>
                            <p><b>Merk</b> : ${data.merk} / ${data.tipe}</p>
                            <p><b>Tahun</b> : ${data.tahun}</p>
                            <p><b>No. Rangka</b> : ${maskData(
                                data.no_rangka,
                                6
                            )}</p>
                            <p><b>No. Mesin</b> : ${maskData(
                                data.no_mesin,
                                4
                            )}</p>
                            <p><b>No. BPKB</b> : ${maskData(
                                data.no_bpkb,
                                2
                            )}</p>
                            <p><b>Pemegang</b> : ${data.pemilik}</p>
                            <p><b>Unit Kerja</b> : ${data.unit_kerja ?? "-"}</p>
                        </div>
                    `;

                    if (data.foto) {
                        document.getElementById("fotoKendaraan").src =
                            data.foto;
                    } else {
                        document.getElementById("fotoKendaraan").src =
                            "pages/img/no-image.png";
                    }
                })
                .catch(() => {
                    showScanError(
                        "QR Code Tidak Valid. Gagal mengambil data kendaraan."
                    );
                });
        })
        .catch((err) => {
            showScanError(
                "Terjadi kesalahan saat membuka kamera: " + err,
                true
            );
            html5QrCode = null;
            document.getElementById("reader").innerHTML = "";
        });
}

function restartScanner(cameraId) {
    document.querySelectorAll("#scanErrorMsg").forEach((el) => el.remove());

    // Bersihkan pesan error sebelum restart scanner
    let errorMsg = document.getElementById("scanErrorMsg");
    if (errorMsg) errorMsg.remove();

    if (html5QrCode) {
        html5QrCode
            .stop()
            .then(() => {
                document.getElementById("reader").innerHTML = "";
                html5QrCode = new Html5Qrcode("reader");
                startScanner(cameraId);
            })
            .catch(() => {
                document.getElementById("reader").innerHTML = "";
                html5QrCode = new Html5Qrcode("reader");
                startScanner(cameraId);
            });
    } else {
        document.getElementById("reader").innerHTML = "";
        html5QrCode = new Html5Qrcode("reader");
        startScanner(cameraId);
    }
}

function closeScanner() {
    if (html5QrCode) {
        html5QrCode.stop().then(() => {
            document.getElementById("scanModal").style.display = "none";
        });
    } else {
        document.getElementById("scanModal").style.display = "none";
    }
    let errorMsg = document.getElementById("scanErrorMsg");
    if (errorMsg) errorMsg.remove();
}

// Klik luar modal menutup
window.addEventListener("click", function (e) {
    const modal = document.getElementById("scanModal");
    if (e.target === modal) {
        closeScanner();
    }
});
