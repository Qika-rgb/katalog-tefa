<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pusat - Product Report</title>
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
            <li><a href="/admin-pusat/status" class="active-black-line">PRODUCT REPORT</a></li>
            <li>
                <div class="red-dot"></div>
                <a href="/admin-pusat/chat" class="active-cs">CUSTOMER SERVICE</a>
            </li>
            <li><a href="/admin-pusat/verifikasi">VERIFIKASI PESAN</a></li>
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
                Customer Service
            </div>
        </div>

        <!-- Main Header -->
        <div class="admin-header-row">
            <!-- Judul Diperbaiki -->
            <h1>PRODUCT REPORT</h1>
            <div class="header-actions">
                <i class="fa-solid fa-clock-rotate-left"></i> 
                <i class="fa-regular fa-envelope"></i>
                <span class="year-badge">2026</span>
            </div>
        </div>

        <!-- KOTAK PUTIH UNTUK DAFTAR PRODUK -->
        <div class="admin-white-box">
            <div class="product-grid">
                
                <!-- KARTU 1 -->
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <img src="{{ asset('images/produk_dkv2.png') }}" alt="Graphic Design">
                        <a href="#" class="btn-update">CHECK</a>
                    </div>
                    <div class="product-info">
                        <h3>Design creation services...</h3>
                        <p class="price">RP 2.000.000</p>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <span>5.0 + 5Rb terjual</span>
                        </div>
                    </div>
                </div>

                <!-- KARTU 2 -->
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <img src="{{ asset('images/produk_dkv3.png') }}" alt="Web Services">
                        <a href="#" class="btn-update">CHECK</a>
                    </div>
                    <div class="product-info">
                        <h3>web services</h3>
                        <p class="price">RP 1.500.000</p>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <span>5.0 + 5Rb terjual</span>
                        </div>
                    </div>
                </div>

                <!-- KARTU 3 -->
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <img src="{{ asset('images/produk_dkv2.png') }}" alt="Podcast">
                        <a href="#" class="btn-update">CHECK</a>
                    </div>
                    <div class="product-info">
                        <h3>Podcast Production ser...</h3>
                        <p class="price">RP 1.500.000</p>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <span>5.0 + 5Rb terjual</span>
                        </div>
                    </div>
                </div>

                <!-- KARTU 4 (Tote Bag) -->
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <img src="{{ asset('images/produk_dkv3.png') }}" alt="Tote Bag">
                        <a href="#" class="btn-update">CHECK</a>
                    </div>
                    <div class="product-info">
                        <h3>Tote bag making</h3>
                        <p class="price">RP 500.000</p>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <span>5.0 + 5Rb terjual</span>
                        </div>
                    </div>
                </div>

            </div>
        </div> 
    </div> 
</body>
</html>