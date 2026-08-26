<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Panggil CSS Utama kita -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">

    <div class="pemesanan-wrapper">
        
        <!-- HEADER KERANJANG -->
        <div class="pemesanan-header">
            <div class="pemesanan-title">
                <a href="/katalog"><i class="fa-solid fa-chevron-left"></i></a>
                <span class="text-blue">KERANJANG</span>
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

        <!-- KARTU UTAMA -->
        <div class="pemesanan-card">
            
            <div class="cart-container">
                
                <!-- PRODUK 1 -->
                <div class="cart-item-wrapper">
                    <!-- Kotak Produk -->
                    <div class="cart-item-box">
                        <img src="{{ asset('images/produk_dkv2.png') }}" alt="Tote bag" class="cart-item-img">
                        <div class="cart-item-details">
                            <h4>Tote bag making CUSTOMEZ</h4>
                            <h5>TEFA DKV</h5>
                            <p class="cart-item-price">RP 500.000</p>
                            <input type="text" placeholder="ISI NOMOR TELEPON MU!" class="cart-input-phone">
                        </div>
                        <div class="cart-item-qty">
                            Total <strong>1</strong>
                        </div>
                    </div>
                </div>

                <!-- PRODUK 2 -->
                <div class="cart-item-wrapper">
                    <!-- Kotak Produk -->
                    <div class="cart-item-box">
                        <img src="{{ asset('images/produk_dkv3.png') }}" alt="Desain Grafis" class="cart-item-img">
                        <div class="cart-item-details">
                            <h4>DESIGN GRAFIS</h4>
                            <h5>TEFA DKV</h5>
                            <p class="cart-item-price">RP 500.000</p>
                            <!-- Pada desain kedua ini bordernya hitam, kita pakai inline style khusus untuk contoh -->
                            <input type="text" placeholder="ISI NOMOR TELEPON MU!" class="cart-input-phone" style="border-color: #333; color: #999;">
                        </div>
                        <div class="cart-item-qty">
                            Total <strong>1</strong>
                        </div>
                    </div>
                </div>

            </div> <!-- End Cart Container -->

            <!-- BAGIAN BAWAH / CHECKOUT -->
            <div class="cart-checkout-section">
                <div class="cart-total-info">
                    <span class="total-label">Total</span>
                    <span class="total-price">RP 1.000.000</span>
                </div>
                <button class="btn-checkout">Get Started</button>
            </div>

        </div> <!-- End Card -->
    </div> <!-- End Wrapper -->

</body>
</html>