<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Jurusan - Products</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="admin-body">

    <!-- SIDEBAR -->
    <div class="admin-sidebar">
        <img src="{{ asset('images/logo_tefa.png') }}" alt="Logo" class="admin-logo">
        <ul class="admin-nav">
            <!-- Navigasi Analytics tidak aktif -->
            <li><a href="/admin-jurusan">ANALYTICS REPORTS</a></li>
            <!-- Navigasi Products sekarang aktif -->
            <li><a href="/admin-jurusan/products" class="active">PRODUCTS</a></li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="admin-main">
        
        <!-- Top Profile -->
        <div class="admin-top-profile">
            <div class="profile-pill">
                <img src="{{ asset('images/icon_dkv1.png') }}" alt="Avatar">
                TEFA DKV
            </div>
        </div>

        <!-- Main Header -->
        <div class="admin-header-row">
            <h1>PRODUCTS</h1>
            <div class="header-actions">
                <i class="fa-solid fa-magnifying-glass"></i>
                <i class="fa-regular fa-envelope"></i>
                <span class="year-badge">2026</span>
            </div>
        </div>

        <!-- KOTAK PUTIH UNTUK DAFTAR PRODUK -->
        <div class="admin-white-box">
            
            <!-- Kita pakai class product-grid yang sama dengan halaman katalog -->
            <div class="product-grid">
                
                <!-- KARTU 1 -->
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <img src="{{ asset('images/produk_dkv2.png') }}" alt="Graphic Design">
                        <!-- Tombol Update -->
                        <a href="#" class="btn-update">UPDATE NOW</a>
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
                        <a href="#" class="btn-update">UPDATE NOW</a>
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
                        <a href="#" class="btn-update">UPDATE NOW</a>
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
                        <a href="#" class="btn-update">UPDATE NOW</a>
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

                <!-- KARTU ADD NEW (Khusus Admin) -->
                <!-- Nantinya link href ini diarahkan ke form /tambah-produk -->
                <a href="#" class="add-new-box">
                    <div class="add-new-icon-wrapper">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <span class="add-new-text">ADD NEW</span>
                </a>

            </div>

        </div> <!-- End Admin White Box -->

    </div> <!-- End Main Content -->

</body>
</html>