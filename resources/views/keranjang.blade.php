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
            <a href="/customer-service" style="color: inherit; text-decoration: none;">
                <i class="fa-solid fa-headset"></i>
            </a>
        </div>

    </div>


    <!-- =========================
        KARTU UTAMA
    ========================== -->
    <div class="pemesanan-card">

        <!-- ALERT NOTIFIKASI SUCCESS/ERROR -->
        @if(session('success'))
            <div style="padding: 10px 15px; background-color: #d4edda; color: #155724; border-radius: 8px; margin-bottom: 20px; font-weight: 600;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="padding: 10px 15px; background-color: #f8d7da; color: #721c24; border-radius: 8px; margin-bottom: 20px; font-weight: 600;">
                {{ session('error') }}
            </div>
        @endif

        <div class="cart-container">

            @forelse ($keranjangs as $item)

                <!-- =========================
                     ITEM PRODUK
                ========================== -->
                <div class="cart-item-wrapper">

                    <div class="cart-item-box" style="display: flex; align-items: center; justify-content: space-between;">

                        <!-- BAGIAN KIRI: FOTO & DETAIL -->
                        <div style="display: flex; gap: 20px; align-items: center;">
                            <!-- FOTO PRODUK -->
                            <img
                                src="{{ asset('images/' . $item->produk->foto) }}"
                                alt="{{ $item->produk->nama_produk }}"
                                class="cart-item-img"
                            >

                            <!-- DETAIL PRODUK -->
                            <div class="cart-item-details">

                                <h4>
                                    {{ $item->produk->nama_produk }}
                                </h4>

                                <h5>
                                    TEFA DKV
                                </h5>

                                <p class="cart-item-price">
                                    RP {{ number_format($item->produk->harga, 0, ',', '.') }}
                                </p>

                            </div>
                        </div>

                        <!-- BAGIAN KANAN: JUMLAH & TOMBOL HAPUS -->
                        <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 15px;">

                            <!-- TOMBOL HAPUS -->
                            <form action="/keranjang/hapus/{{ $item->id }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: transparent; border: none; color: #dc2626; font-size: 1.2rem; cursor: pointer; transition: 0.3s;" title="Hapus Produk" onmouseover="this.style.color='#991b1b'" onmouseout="this.style.color='#dc2626'">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>

                            <!-- JUMLAH PRODUK -->
                            <div class="cart-item-qty">
                                Total
                                <strong>
                                    {{ $item->jumlah }}
                                </strong>
                            </div>

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


                  <a href="/katalog"
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
        @if(count($keranjangs) > 0)

            <div class="cart-checkout-section">

                <div class="cart-total-info">

                    <span class="total-label">
                        Total
                    </span>

                    <span class="total-price">
                        RP
                        {{ number_format(
                            $keranjangs->sum(function ($item) {
                                return $item->produk->harga * $item->jumlah;
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