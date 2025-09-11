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

        clearScanError();

        html5QrCode = new Html5Qrcode("reader");

        try {
            const devices = await Html5Qrcode.getCameras();
            if (devices && devices.length) {
                // Buat dropdown pilih kamera
                let cameraSelect = document.createElement("select");
                cameraSelect.id = "cameraSelect";
                Object.assign(cameraSelect.style, {
                    display: "block",
                    margin: "10px auto",
                    padding: "8px",
                    width: "100%",
                });

                devices.forEach((d, idx) => {
                    let option = document.createElement("option");
                    option.value = d.id;
                    option.text = d.label || `Camera ${idx + 1}`;
                    cameraSelect.appendChild(option);
                });

                // Sisipkan dropdown di atas tombol tutup
                const modalContent = document.querySelector("#scanModal div");
                const closeBtn = modalContent.querySelector("button");
                let oldSelect = document.getElementById("cameraSelect");
                if (oldSelect) oldSelect.remove();
                modalContent.insertBefore(cameraSelect, closeBtn);

                // Kamera default
                currentCameraId = cameraSelect.value;
                startScanner(currentCameraId);

                cameraSelect.addEventListener("change", function () {
                    currentCameraId = this.value;
                    restartScanner(currentCameraId);
                });
            } else {
                showScanError("Perangkat tidak memiliki kamera.");
            }
        } catch (err) {
            showScanError(
                "Tidak bisa mengakses kamera. Pastikan izin kamera diaktifkan."
            );
        }
    });

function clearScanError() {
    document.querySelectorAll("#scanErrorMsg").forEach((el) => el.remove());
}

function showScanError(msg) {
    clearScanError();
    let modalContent = document.querySelector("#scanModal div");
    let errorMsg = document.createElement("div");
    errorMsg.id = "scanErrorMsg";
    Object.assign(errorMsg.style, {
        color: "red",
        textAlign: "center",
        margin: "10px 0",
    });
    errorMsg.innerHTML = msg;
    modalContent.insertBefore(errorMsg, modalContent.firstChild);
}

function startScanner(cameraId) {
    clearScanError();

    html5QrCode
        .start(
            cameraId,
            { fps: 10, qrbox: 250 },
            (decodedText) => {
                // Stop scanner dulu
                html5QrCode.stop().then(() => {
                    html5QrCode = null;
                    document.getElementById("scanModal").style.display = "none";

                    // Ambil hanya QR code ID (misal: KEND-XXXX dari URL atau langsung kode)
                    let qrCode = decodedText.split("/").pop();

                    // Fetch data kendaraan
                    fetch(`/scan/${qrCode}`)
                        .then((res) => res.json())
                        .then((data) => {
                            if (data.error) {
                                Swal.fire("Error", data.error, "error");
                            } else {
                                tampilkanHasil(data);
                            }
                        })
                        .catch(() => {
                            Swal.fire(
                                "Error",
                                "Gagal mengambil data kendaraan",
                                "error"
                            );
                        });
                });
            },
            (errorMessage) => {
                // error scanning (bisa diabaikan)
            }
        )
        .catch((err) => {
            showScanError("Gagal membuka kamera: " + err);
            html5QrCode = null;
            document.getElementById("reader").innerHTML = "";
        });
}

function restartScanner(cameraId) {
    clearScanError();
    if (html5QrCode) {
        html5QrCode.stop().finally(() => {
            document.getElementById("reader").innerHTML = "";
            html5QrCode = new Html5Qrcode("reader");
            startScanner(cameraId);
        });
    }
}

function closeScanner() {
    document.getElementById("scanModal").style.display = "none";
    clearScanError();
    if (html5QrCode) {
        html5QrCode.stop().catch(() => {});
        html5QrCode = null;
    }
}

// Klik luar modal menutup
window.addEventListener("click", function (e) {
    const modal = document.getElementById("scanModal");
    if (e.target === modal) {
        closeScanner();
    }
});

// Fungsi tampilkan hasil + auto scroll
function tampilkanHasil(data) {
    document.getElementById("scan-result").style.display = "block";

    document.getElementById("fotoKendaraan").src = data.foto ?? "";
    document.getElementById("noPolisi").innerText = data.no_polisi ?? "-";
    document.getElementById("jenis").innerText = data.jenis ?? "-";
    document.getElementById("merk").innerText = data.merk ?? "-";
    document.getElementById("tahun").innerText = data.tahun ?? "-";
    document.getElementById("noRangka").innerText = data.no_rangka ?? "-";
    document.getElementById("noMesin").innerText = data.no_mesin ?? "-";
    document.getElementById("noBpkb").innerText = data.no_bpkb ?? "-";
    document.getElementById("pemilik").innerText = data.pemilik ?? "-";
    document.getElementById("unitKerja").innerText = data.unit_kerja ?? "-";

    // Auto scroll ke hasil
    document.getElementById("scan-result").scrollIntoView({
        behavior: "smooth",
        block: "start",
    });
}
