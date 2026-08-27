<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-light">

<div class="pemesanan-wrapper">

    <!-- =========================
         HEADER KERANJANG
    ========================== -->
    <div class="pemesanan-header">

        <div class="pemesanan-title">
            <a href="/katalog">
                <i class="fa-solid fa-chevron-left"></i>
            </a>

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


    <!-- =========================
         KARTU UTAMA
    ========================== -->
    <div class="pemesanan-card">

        <div class="cart-container">

            @forelse ($keranjang as $item)

                <!-- =========================
                     ITEM PRODUK
                ========================== -->
                <div class="cart-item-wrapper">

                    <div class="cart-item-box">

                        <!-- FOTO PRODUK -->
                        <img
                            src="{{ asset('images/' . $item['foto']) }}"
                            alt="{{ $item['nama_produk'] }}"
                            class="cart-item-img"
                        >


                        <!-- DETAIL PRODUK -->
                        <div class="cart-item-details">

                            <h4>
                                {{ $item['nama_produk'] }}
                            </h4>

                            <h5>
                                TEFA DKV
                            </h5>

                            <p class="cart-item-price">
                                RP {{ number_format($item['harga'], 0, ',', '.') }}
                            </p>

                            <input
                                type="text"
                                placeholder="ISI NOMOR TELEPON MU!"
                                class="cart-input-phone"
                            >

                        </div>


                        <!-- JUMLAH PRODUK -->
                        <div class="cart-item-qty">

                            Total

                            <strong>
                                {{ $item['jumlah'] }}
                            </strong>

                        </div>

                    </div>

                </div>

            @empty

                <!-- KERANJANG KOSONG -->
                <div style="text-align: center; padding: 40px;">

                    <i
                        class="fa-solid fa-cart-shopping"
                        style="font-size: 50px; margin-bottom: 15px;"
                    ></i>

                    <h3>
                        Keranjang masih kosong
                    </h3>

                    <p>
                        Silakan pilih produk terlebih dahulu.
                    </p>

                    <a
                        href="/katalog"
                        class="btn-solid-blue"
                        style="display: inline-block; margin-top: 15px; text-decoration: none;"
                    >
                        KEMBALI KE KATALOG
                    </a>

                </div>

            @endforelse

        </div>


        <!-- =========================
             CHECKOUT
        ========================== -->
        @if(count($keranjang) > 0)

            <div class="cart-checkout-section">

                <div class="cart-total-info">

                    <span class="total-label">
                        Total
                    </span>

                    <span class="total-price">

                        RP
                        {{ number_format(
                            collect($keranjang)->sum(function ($item) {
                                return $item['harga'] * $item['jumlah'];
                            }),
                            0,
                            ',',
                            '.'
                        ) }}

                    </span>

                </div>


                <a href="/checkout" class="btn-checkout" style="text-decoration: none; display: inline-block;">
                Get Started
                </a>

            </div>

        @endif

    </div>

</div>

</body>
</html>