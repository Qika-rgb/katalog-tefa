<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pusat - Verifikasi Pesanan</title>
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
            <li><a href="/admin-pusat/verifikasi" class="active-black-line">VERIFIKASI PESAN</a></li>
            <li><a href="/admin-pusat/status-pesanan">STATUS</a></li>
            <li><a href="/admin-pusat/done">DONE</a></li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="admin-main">
        
        <!-- Top Profile -->
        <div class="admin-top-profile">
            <div class="profile-pill">
                <img src="{{ asset('images/foto_profil.png') }}" alt="Avatar">
                Costumer Service
            </div>
        </div>

        <!-- Main Header -->
        <div class="admin-header-row">
            <h1>VERIFIKASI PESANAN</h1>
            <div class="header-actions">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <i class="fa-regular fa-envelope"></i>
                <span class="year-badge">2026</span>
            </div>
        </div>

        <!-- ==========================================
             DAFTAR KARTU PESANAN (VERIFIKASI)
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

            <!-- Tombol Action di Kanan Bawah -->
            <div class="admin-order-actions">
                <button class="btn-accept">ACCEPT</button>
                <button class="btn-decline">DECLINE</button>
            </div>
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

            <div class="admin-order-actions">
                <button class="btn-accept">ACCEPT</button>
                <button class="btn-decline">DECLINE</button>
            </div>
        </div>

        <!-- Jika ada pesanan tambahan, tinggal copy paste div admin-order-card ke bawah sini -->

    </div> <!-- End Main Content -->

</body>
</html>