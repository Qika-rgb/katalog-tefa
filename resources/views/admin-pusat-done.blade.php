<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pusat - Pesanan Selesai</title>
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
            <li><a href="/admin-pusat/status-pesanan">STATUS</a></li>
            <li><a href="/admin-pusat/done" class="active-black-line">DONE</a></li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="admin-main">
        
        <!-- Top Profile -->
        <div class="admin-top-profile">
            <div class="profile-pill">
                <img src="{{ asset('images/foto_profil.png') }}" alt="Avatar">
                Customer Service <!-- Typo 'Costumer' sudah kuperbaiki di sini -->
            </div>
        </div>

        <!-- Main Header -->
        <div class="admin-header-row">
            <h1>DONE</h1>
            <div class="header-actions">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <i class="fa-regular fa-envelope"></i>
                <span class="year-badge">2026</span>
            </div>
        </div>

        <!-- ==========================================
             DAFTAR KARTU PESANAN SELESAI
             ========================================== -->
             
        <!-- KARTU PESANAN 1 -->
        <div class="admin-order-card">
            <img src="{{ asset('images/produk_dkv2.png') }}" alt="Graphic Design" class="admin-order-img">
            
            <div class="admin-order-info">
                <h3>Informasi pemesanan & layanan</h3>
                <p>NAMA PEMESAN : <strong>MAHADIR BAMBANG SUDIOMO</strong></p>
                <p>ID PESANAN: <strong>#ORD-2026-001</strong></p>
                <p>JENIS LAYANAN / PAKET: <strong>GRAPHIC DESIGN - FEED INSTAGRAM</strong></p>
                <p>TANGGAL PENYELESAIAN : <strong>17 AGUSTUS 1945</strong></p>
            </div>

            <!-- Teks DONE Besar -->
            <div class="status-done-text">DONE</div>
        </div>

        <!-- KARTU PESANAN 2 -->
        <div class="admin-order-card">
            <img src="{{ asset('images/produk_dkv3.png') }}" alt="Web Services" class="admin-order-img">
            
            <div class="admin-order-info">
                <h3>Informasi pemesanan & layanan</h3>
                <p>NAMA PEMESAN : <strong>MAHADIR BAMBANG SUDIOMO</strong></p>
                <p>ID PESANAN: <strong>#ORD-2026-002</strong></p>
                <p>JENIS LAYANAN / PAKET: <strong>WEB SERVICES</strong></p>
                <p>TANGGAL PENYELESAIAN : <strong>17 AGUSTUS 1945</strong></p>
            </div>

            <div class="status-done-text">DONE</div>
        </div>

        <!-- KARTU PESANAN 3 -->
        <div class="admin-order-card">
            <img src="{{ asset('images/produk_dkv3.png') }}" alt="Tote Bag" class="admin-order-img">
            
            <div class="admin-order-info">
                <h3>Informasi pemesanan & layanan</h3>
                <p>NAMA PEMESAN : <strong>MAHADIR BAMBANG SUDIOMO</strong></p>
                <p>ID PESANAN: <strong>#ORD-2026-003</strong></p>
                <p>JENIS LAYANAN / PAKET: <strong>TOTE BAG MAKING</strong></p>
                <p>TANGGAL PENYELESAIAN : <strong>17 AGUSTUS 1945</strong></p>
            </div>

            <div class="status-done-text">DONE</div>
        </div>

    </div> <!-- End Main Content -->

</body>
</html>