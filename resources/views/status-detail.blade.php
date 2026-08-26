<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Status Pesanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">

    <div class="pemesanan-wrapper">
        <!-- HEADER -->
        <div class="pemesanan-header">
            <div class="pemesanan-title">
                <a href="/status"><i class="fa-solid fa-chevron-left"></i></a>
                <span class="text-blue">STATUS</span>
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

        <!-- KARTU DETAIL PELACAKAN -->
        <div class="detail-status-card">
            
            <div class="detail-status-header">
                <div class="detail-store-info">
                    <img src="{{ asset('images/icon_dkv1.png') }}" alt="Store">
                    <span>TEFA DKV <i class="fa-solid fa-chevron-right" style="font-size: 10px; margin-left:5px;"></i></span>
                </div>
                <div class="text-take-it">TAKE IT</div>
            </div>

            <div class="detail-alert">
                <h2>BARANG ANDA SIAP DI AMBIL</h2>
                <p>Dipersilahkan untuk mengambil Barangmu Ditempat kami</p>
            </div>

            <div class="detail-product-row">
                <img src="{{ asset('images/produk_dkv2.png') }}" alt="Tote Bag" class="detail-product-img">
                <div class="detail-product-info">
                    <h3>Tote bag making CUSTOMEZ</h3>
                    <div class="price">RP 500.000</div>
                    <div class="est">est.pembuatan <strong>7 agus - 14 agus</strong></div>
                    <div>
                        <button class="btn-masukan">BERI MASUKAN</button>
                        <button class="btn-belum-ambil">ANDA BELUM MENGAMBIL</button>
                    </div>
                </div>
            </div>

            <!-- TIMELINE PELACAKAN -->
            <div class="tracking-timeline">
                
                <div class="tracking-step">
                    <div class="tracking-icon"><i class="fa-solid fa-industry"></i></div>
                    <div class="tracking-line"></div>
                    <div class="tracking-text">Sedang tahap<br>pembuatan</div>
                </div>

                <div class="tracking-step">
                    <div class="tracking-icon"><i class="fa-solid fa-dolly"></i></div>
                    <div class="tracking-line"></div>
                    <div class="tracking-text">Tahap Pengemasan</div>
                </div>

                <div class="tracking-step">
                    <div class="tracking-icon"><i class="fa-solid fa-box-open"></i></div>
                    <div class="tracking-line"></div>
                    <div class="tracking-text">Barang Siap di ambil</div>
                </div>

                <div class="tracking-step">
                    <div class="tracking-icon"><i class="fa-regular fa-handshake"></i></div>
                    <div class="tracking-text">Barang Sudah di ambil</div>
                </div>

            </div>

        </div> <!-- End Card -->
    </div> <!-- End Wrapper -->

</body>
</html>