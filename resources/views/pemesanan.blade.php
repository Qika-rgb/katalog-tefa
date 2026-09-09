<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan - {{ $produk->nama_produk }}</title>
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
                <a href="/customer-service" style="color: inherit; text-decoration: none;">
                    <i class="fa-solid fa-headset"></i>
                </a>
            </div>
        </div>

        <!-- CARD UTAMA -->
        <div class="pemesanan-card">
            
            <div class="pemesanan-grid">
                
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

                    <!-- MULAI FORM PEMESANAN (Menyambung ke Keranjang) -->
                    <form action="/keranjang/tambah/{{ $produk->id }}" method="POST">
                        @csrf

                        <!-- Kuantitas -->
                        <span class="qty-label">KUANTITAS</span>
                        <div class="qty-control">
                            <!-- type="button" agar form tidak tersubmit saat klik minus -->
                            <button type="button" class="qty-btn" id="btnMinus">-</button>
                            <!-- Input ini otomatis mengirim name="jumlah" -->
                            <input type="text" name="jumlah" class="qty-input" id="qtyInput" value="1" readonly>
                            <!-- type="button" agar form tidak tersubmit saat klik plus -->
                            <button type="button" class="qty-btn" id="btnPlus">+</button>
                        </div>

                        <!-- Input Nomor Telepon -->
                        <input type="text" name="no_telepon" class="input-telepon" placeholder="ISI NOMOR TELEPON MU!" required>

                        <!-- Tombol Aksi -->
                        <div class="action-buttons">
                            
                            <!-- Tombol Keranjang (Mensubmit form ke database) -->
                            <button type="submit" class="btn-outline-blue">
                                <i class="fa-solid fa-cart-arrow-down"></i> MASUKAN KERANJANG
                            </button>

                            <!-- Tombol BUY (Arahkan langsung ke WhatsApp Admin TEFA) -->
                            <!-- Ganti 6281234567890 dengan nomor WA sekolahmu -->
                            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20TEFA,%20saya%20tertarik%20untuk%20memesan%20{{ $produk->nama_produk }}." target="_blank" class="btn-solid-blue" style="text-decoration: none; display: flex; justify-content: center; align-items: center; width: 100%;">
                                BUY
                            </a>

                        </div>
                    </form>
                    
                </div>
            </div> <!-- End Grid Atas -->

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

        // Tambah Kuantitas
        btnPlus.addEventListener('click', function() {
            qtyInput.value = parseInt(qtyInput.value) + 1;
        });

        // Kurangi Kuantitas (Minimal 1)
        btnMinus.addEventListener('click', function() {
            if (parseInt(qtyInput.value) > 1) {
                qtyInput.value = parseInt(qtyInput.value) - 1;
            }
        });
    </script>
</body>
</html>