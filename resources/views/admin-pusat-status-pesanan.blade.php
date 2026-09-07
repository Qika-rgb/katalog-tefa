<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pusat - Status Pesanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="admin-body">

    <!-- SIDEBAR -->
    <div class="admin-sidebar">
        <a href="/">
            <img src="{{ asset('images/logo_tefa.png') }}" alt="Logo" class="admin-logo">
        </a>
        <ul class="admin-nav">
            <li><a href="/admin-pusat/status">PRODUCT REPORT</a></li>
            <li>
                <div class="red-dot"></div>
                <a href="/admin-pusat/chat" class="active-cs">CUSTOMER SERVICE</a>
            </li>
            <li><a href="/admin-pusat/verifikasi">VERIFIKASI PESAN</a></li>
            <li><a href="/admin-pusat/status-pesanan" class="active-black-line">STATUS</a></li>
            <li><a href="/admin-pusat/done">DONE</a></li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="admin-main">
        
        <!-- Top Profile -->
        <div class="admin-top-profile">
            <div class="profile-pill">
                <img src="{{ asset('images/foto_profil.png') }}" alt="Avatar">
                Customer Service
            </div>
        </div>

        <!-- Main Header -->
        <div class="admin-header-row">
            <h1>STATUS</h1>
            <div class="header-actions">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <i class="fa-regular fa-envelope"></i>
                <span class="year-badge">2026</span>
            </div>
        </div>

        <!-- ==========================================
            DAFTAR KARTU PESANAN (UBAH STATUS)
            ========================================== -->
            
        <!-- KARTU PESANAN 1 -->
        <div class="admin-order-card">
            <img src="{{ asset('images/produk_dkv2.png') }}" alt="Graphic Design" class="admin-order-img">
            
            <div class="admin-order-info">
                <h3>Informasi pemesanan & layanan</h3>
                <p>NAMA PEMESAN : <strong>MAHADIR BAMBANG SUDIOMO</strong></p>
                <p>ID PESANAN: <strong>#ORD-2026-001</strong></p>
                <p>JENIS LAYANAN / PAKET: <strong>GRAPHIC DESIGN - FEED INSTAGRAM</strong></p>
                <p>STATUS SAAT INI: <span class="status-text">MENUNGGU KONFIRMASI</span></p>
            </div>

            <!-- Tombol Ubah Status di Kanan Bawah -->
            <button class="btn-outline-blue-capsule">UBAH STATUS</button>
        </div>

        <!-- KARTU PESANAN 2 -->
        <div class="admin-order-card">
            <img src="{{ asset('images/produk_dkv3.png') }}" alt="Web Services" class="admin-order-img">
            
            <div class="admin-order-info">
                <h3>Informasi pemesanan & layanan</h3>
                <p>NAMA PEMESAN : <strong>MAHADIR BAMBANG SUDIOMO</strong></p>
                <p>ID PESANAN: <strong>#ORD-2026-002</strong></p>
                <p>JENIS LAYANAN / PAKET: <strong>WEB SERVICES</strong></p>
                <p>STATUS SAAT INI: <span class="status-text">SEDANG DI PROSES</span></p>
            </div>

            <button class="btn-outline-blue-capsule">UBAH STATUS</button>
        </div>

    </div> <!-- End Main Content -->

    <!-- ==========================================
        OVERLAY MODAL UBAH STATUS (TOGGLE)
        ========================================== -->
    <div class="modal-status-overlay" id="modalUbahStatus">
        <div class="modal-status-card">
            
            <button class="btn-back" id="btnBackStatus"><i class="fa-solid fa-chevron-left"></i> BACK</button>

            <div class="modal-status-header">
                <img src="{{ asset('images/produk_dkv2.png') }}" alt="Graphic Design" class="modal-status-img">
                <div class="modal-status-title">
                    <h2>Jasa Pembuatan Graphic Design - Feed Instagram</h2>
                    <div class="modal-status-profile">
                        <img src="{{ asset('images/foto_profil.png') }}" alt="Avatar"> TEFA DKV
                    </div>
                </div>
            </div>

            <!-- Tombol Toggles -->
            <div class="toggle-wrapper">
                <div class="toggle-item">
                    <div class="toggle-switch" onclick="this.classList.toggle('active')">
                        <div class="toggle-option no">NO</div>
                        <div class="toggle-option yes">YES</div>
                    </div>
                    <span class="toggle-label">SEDANG TAHAP PEMBUATAN</span>
                </div>

                <div class="toggle-item">
                    <div class="toggle-switch" onclick="this.classList.toggle('active')">
                        <div class="toggle-option no">NO</div>
                        <div class="toggle-option yes">YES</div>
                    </div>
                    <span class="toggle-label">TAHAP PENGEMASAN</span>
                </div>

                <div class="toggle-item">
                    <div class="toggle-switch" onclick="this.classList.toggle('active')">
                        <div class="toggle-option no">NO</div>
                        <div class="toggle-option yes">YES</div>
                    </div>
                    <span class="toggle-label">JASA SUDAH DISELESAIKAN</span>
                </div>

                <div class="toggle-item">
                    <div class="toggle-switch" onclick="this.classList.toggle('active')">
                        <div class="toggle-option no">NO</div>
                        <div class="toggle-option yes">YES</div>
                    </div>
                    <span class="toggle-label">HASIL JASA DITERIMA</span>
                </div>
            </div>

        </div>
    </div>

    <!-- SCRIPT UNTUK MEMUNCULKAN MODAL -->
    <script>
        const modalStatus = document.getElementById('modalUbahStatus');
        const btnUbahStatus = document.querySelectorAll('.btn-outline-blue-capsule');
        const btnBackStatus = document.getElementById('btnBackStatus');

        // Buka Modal saat tombol Ubah Status diklik
        btnUbahStatus.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                modalStatus.style.display = 'flex';
            });
        });

        // Tutup Modal
        if(btnBackStatus) {
            btnBackStatus.addEventListener('click', () => modalStatus.style.display = 'none');
        }
        window.addEventListener('click', function(e) {
            if(e.target === modalStatus) modalStatus.style.display = 'none';
        });
    </script>
</body>
</html>