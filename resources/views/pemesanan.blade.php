<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Panggil CSS Utama kita -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">

    <div class="pemesanan-wrapper">
        
        <!-- HEADER -->
        <div class="pemesanan-header">
            <div class="pemesanan-title">
                <a href="/katalog"><i class="fa-solid fa-chevron-left"></i></a>
                <span>PEMESANAN</span>
            </div>
            <div class="nav-icons">
                <a href="/keranjang" style="color: inherit; text-decoration: none;">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
                <a href="/register" style="color: inherit; text-decoration: none;">
                    <i class="fa-regular fa-user"></i>
                </a>
                <a href="#" style="color: inherit; text-decoration: none;">
                    <i class="fa-solid fa-headset"></i>
                </a>
            </div>
        </div>

        <!-- CARD UTAMA -->
        <div class="pemesanan-card">
            
            <div class="pemesanan-grid">
                <!-- BAGIAN KIRI: GAMBAR -->
                <!-- BAGIAN KIRI: GAMBAR -->
                <div class="product-images">
                    <!-- Menampilkan foto sesuai database -->
                    <img src="{{ asset('images/' . $produk->foto) }}" alt="{{ $produk->nama_produk }}" class="main-product-img">
                </div>

                <!-- BAGIAN KANAN: INFO PRODUK -->
                <div class="product-detail-info">
                    
                    <!-- Menampilkan nama produk dari database -->
                    <h1>{{ $produk->nama_produk }}</h1>
                    
                    <!-- Rating Bintang -->
                    <div class="detail-rating">
                        <span>4.5</span>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                        <span>| 50 RB PENILAIAN</span>
                    </div>

                    <!-- Menampilkan harga produk dari database -->
                    <div class="detail-price">RP {{ number_format($produk->harga, 0, ',', '.') }}</div>

                    <!-- Kuantitas -->
                    <span class="qty-label">KUANTITAS</span>
                    <div class="qty-control">
                        <button class="qty-btn" id="btnMinus">-</button>
                        <input type="text" class="qty-input" id="qtyInput" value="1">
                        <button class="qty-btn" id="btnPlus">+</button>
                    </div>

                    <!-- Input Nomor Telepon -->
                    <input type="text" class="input-telepon" placeholder="ISI NOMOR TELEPON MU!">

                    <!-- Tombol Aksi -->
                    <div class="action-buttons">
                        <button class="btn-outline-blue">
                            <i class="fa-solid fa-cart-arrow-down"></i> MASUKAN KERANJANG
                        </button>
                        <button class="btn-solid-blue">BUY</button>
                    </div>
                    
                </div>

            <!-- BAGIAN BAWAH: INFO TOKO -->
            <div class="store-info-box">
                <div class="store-profile">
                    <!-- Icon Avatar Toko -->
                    <img src="{{ asset('images/icon_dkv1.png') }}" alt="Avatar Toko">
                    <div>
                        <h4>TEFA DKV</h4>
                        <a href="/katalog" class="btn-kunjungi">KUNJUNGI KATALOG</a>
                    </div>
                </div>

                <div class="store-stats">
                    <div>Penilaian <span>10 RB</span></div>
                    <div>presentase rating <span>89,55</span></div>
                    <div>produk <span>50</span></div>
                    <div>lokasi <span>SMKN 4 TANJUNGPINANG TIMUR</span></div>
                </div>
            </div>

        </div> <!-- End Card -->
    </div> <!-- End Wrapper -->

    <!-- JavaScript Interaktif untuk Tombol Plus/Minus -->
    <script>
        const btnMinus = document.getElementById('btnMinus');
        const btnPlus = document.getElementById('btnPlus');
        const qtyInput = document.getElementById('qtyInput');

        btnPlus.addEventListener('click', function() {
            qtyInput.value = parseInt(qtyInput.value) + 1;
        });

        btnMinus.addEventListener('click', function() {
            if (parseInt(qtyInput.value) > 1) {
                qtyInput.value = parseInt(qtyInput.value) - 1;
            }
        });
    </script>
</body>
</html>