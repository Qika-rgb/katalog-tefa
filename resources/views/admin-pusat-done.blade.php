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
            <li><a href="/admin-pusat/product-report">PRODUCT REPORT</a></li>
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
                Customer Service
            </div>
        </div>

        <!-- Main Header -->
        <div class="admin-header-row">
            <h1>RIWAYAT PESANAN SELESAI</h1>
            <div class="header-actions">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <i class="fa-regular fa-envelope"></i>
                <span class="year-badge">2026</span>
            </div>
        </div>

        <!-- DAFTAR KARTU PESANAN SELESAI -->
        @forelse($pesanans as $pesanan)
            <div class="admin-order-card" style="border-left: 5px solid #28a745;">
                <img 
                    src="{{ asset('images/' . ($pesanan->produk->foto ?? 'default.png')) }}" 
                    alt="{{ $pesanan->produk->nama_produk ?? 'Produk DKV' }}" 
                    class="admin-order-img"
                >

                <div class="admin-order-info">
                    <h3>Pesanan #{{ $pesanan->id }} <span style="color: #28a745; font-size: 14px;">(SELESAI)</span></h3>

                    <p>
                        NAMA PRODUK :
                        <strong>{{ $pesanan->produk->nama_produk ?? 'Produk DKV' }}</strong>
                    </p>

                    <p>
                        JUMLAH :
                        <strong>{{ $pesanan->jumlah }} Item</strong>
                    </p>

                    <p>
                        NO. TELEPON :
                        <strong>{{ $pesanan->no_telepon }}</strong>
                    </p>

                    <p>
                        STATUS :
                        <strong style="color: #28a745;">{{ strtoupper($pesanan->status) }}</strong>
                    </p>
                </div>

                <div style="text-align: right;">
                    <span class="badge-done" style="background: #28a745; color: white; padding: 8px 16px; border-radius: 20px; font-weight: bold; font-size: 12px;">
                        <i class="fa-solid fa-check-circle"></i> SUDAH DIAMBIL
                    </span>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 40px; background: #fff; border-radius: 10px;">
                <p>Belum ada pesanan yang selesai (Sudah Diambil).</p>
            </div>
        @endforelse

    </div>

</body>
</html>