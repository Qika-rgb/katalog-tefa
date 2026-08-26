<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pesanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">

    <div class="pemesanan-wrapper">
        <!-- HEADER -->
        <div class="pemesanan-header">
            <div class="pemesanan-title">
                <a href="/katalog"><i class="fa-solid fa-chevron-left"></i></a>
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

        <!-- DAFTAR PESANAN -->
        <div class="pemesanan-card">
            
            <!-- Item 1: Siap Diambil (Garis Biru) -->
            <div class="status-card-box border-blue">
                <div class="status-info-left">
                    <img src="{{ asset('images/produk_dkv2.png') }}" alt="Tote Bag" class="status-img">
                    <div class="status-text">
                        <h4>Tote bag making CUSTOMEZ</h4>
                        <h5>TEFA DKV</h5>
                        <!-- Link menuju detail pelacakan -->
                        <a href="/status/detail" class="btn-lihat-detail">LIHAT LEBIH DETAIL TENTANG PESANANMU</a>
                    </div>
                </div>
                <div class="status-icon-right icon-blue">
                    <i class="fa-solid fa-box-open"></i>
                    <span>BARANG SIAP DI AMBIL</span>
                </div>
            </div>

            <!-- Item 2: Sedang Diproses (Garis Hitam) -->
            <div class="status-card-box">
                <div class="status-info-left">
                    <img src="{{ asset('images/produk_dkv3.png') }}" alt="Design Grafis" class="status-img">
                    <div class="status-text">
                        <h4>DESIGN GRAFIS</h4>
                        <h5>TEFA DKV</h5>
                        <a href="/status/detail" class="btn-lihat-detail">LIHAT LEBIH DETAIL TENTANG PESANANMU</a>
                    </div>
                </div>
                <div class="status-icon-right icon-black">
                    <i class="fa-solid fa-arrows-rotate"></i>
                    <span>PENGERJAAN JASA SEDANG DI PROSES</span>
                </div>
            </div>

        </div>
    </div>

</body>
</html>