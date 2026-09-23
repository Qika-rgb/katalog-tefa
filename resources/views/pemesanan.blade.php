<<<<<<< HEAD
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
                    <div class="detail-price">
=======
@extends('layouts.frontend')

@section('content')
<div class="pemesanan-wrapper" style="padding: 40px 20px; max-width: 800px; margin: 0 auto;">
    
    <div class="pemesanan-card" style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        <h2>KONFIRMASI PESANAN</h2>
        <hr style="margin-bottom: 20px;">

        <!-- TAMPILAN MEDIA (Mendukung Video & Gambar) -->
        <div style="text-align: center; margin-bottom: 20px;">
            @php
                $mediaFile = $produk->vidio ?? $produk->foto ?? '';
                $extension = pathinfo($mediaFile, PATHINFO_EXTENSION);
            @endphp

            @if(in_array(strtolower($extension), ['mp4', 'webm', 'ogg']))
                <video width="100%" controls style="max-height: 300px; border-radius: 8px;">
                    <source src="{{ asset('storage/' . $mediaFile) }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutaran video.
                </video>
            @else
                <img src="{{ asset('images/' . ($mediaFile ?: 'default.png')) }}" alt="{{ $produk->nama_produk ?? 'Produk' }}" style="max-height: 250px; object-fit: contain; border-radius: 8px;">
            @endif
        </div>

        <!-- DETAIL INFORMASI PRODUK -->
        <h3 style="font-size: 22px; font-weight: bold; margin-bottom: 10px;">{{ $produk->nama_produk ?? 'Nama Produk' }}</h3>
        
        <p class="price" style="font-size: 20px; color: #e24215; font-weight: bold; margin-bottom: 15px;">
>>>>>>> 6a27fb97cc0824b2664bb04bef876ceb65e44c33
            RP 
            @if(isset($produk->harga))
                @if(str_contains($produk->harga, '-'))
                    {{ $produk->harga }}
                @else
                    @if(is_numeric($produk->harga))
                        {{ number_format((float)$produk->harga, 0, ',', '.') }}
                    @else
                        {{ $produk->harga }}
                    @endif
                @endif
            @else
                0
            @endif
        </p>

<<<<<<< HEAD
                    <!-- MULAI FORM PEMESANAN (Menyambung ke Keranjang / Beli Langsung) -->
                    <form action="/keranjang/tambah/{{ $produk->id }}" method="POST">
                        @csrf

                        <!-- Dikirim khusus untuk tombol BUY -->
                        <input type="hidden" name="produk_id" value="{{ $produk->id }}">

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

                            <!-- Tombol Keranjang (submit normal ke KeranjangController) -->
                            <button type="submit" class="btn-outline-blue">
                                <i class="fa-solid fa-cart-arrow-down"></i> MASUKAN KERANJANG
                            </button>

                            <!-- Tombol BUY (langsung ke Checkout, skip keranjang) -->
                            <button
                                type="submit"
                                formaction="{{ route('checkout.langsung') }}"
                                class="btn-solid-blue"
                                style="width: 100%;"
                            >
                                BUY
                            </button>

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
=======
        <p style="color: #666; margin-bottom: 25px;">{{ $produk->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

        <!-- Rating Section -->
        <div class="detail-rating" style="display: flex; align-items: center; gap: 5px; margin-bottom: 25px; color: #fbbf24;">
            <span>4.5</span>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star-half-stroke"></i>
            <span style="color: #666; margin-left: 10px;">50 RB PENILAIAN</span>
        </div>

        <!-- FORM CHECKOUT / PEMESANAN -->
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <input type="hidden" name="produk_id" value="{{ $produk->id ?? '' }}">
            
            <div style="margin-bottom: 15px;">
                <label for="telepon" style="display: block; margin-bottom: 5px; font-weight: bold;">Nomor Telepon / WhatsApp:</label>
                <input type="text" id="telepon" name="telepon" required placeholder="Contoh: 081234567890" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
            </div>

            <button type="submit" style="background: #25d366; color: white; border: none; padding: 12px 20px; font-size: 16px; font-weight: bold; border-radius: 6px; cursor: pointer; width: 100%;">
                LANJUTKAN PESANAN VIA WHATSAPP / CHECKOUT
            </button>
        </form>

    </div>
</div>
@endsection
>>>>>>> 6a27fb97cc0824b2664bb04bef876ceb65e44c33
