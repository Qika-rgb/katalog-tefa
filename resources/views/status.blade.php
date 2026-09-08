<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pesanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    {{-- Refresh halaman otomatis setiap 15 detik agar status selalu terupdate --}}
    <meta http-equiv="refresh" content="15">
</head>

<body class="bg-light">

<div class="pemesanan-wrapper">

    <!-- HEADER -->
    <div class="pemesanan-header">
        <div class="pemesanan-title">
            <a href="/katalog">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
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

        @forelse ($pesanans as $pesanan)

            {{-- JIKA MEMILIKI DETAIL PESANAN --}}
            @if ($pesanan->detailPesanans && $pesanan->detailPesanans->count() > 0)

                @foreach ($pesanan->detailPesanans as $detail)
                    @php
                        $produk = $detail->produk;
                        $foto = $produk->foto ?? 'default.png';
                        $imgSrc = file_exists(public_path('images/' . $foto)) 
                            ? asset('images/' . $foto) 
                            : (file_exists(public_path('storage/' . $foto)) ? asset('storage/' . $foto) : asset('images/logo_tefa.png'));
                    @endphp

                    <div class="status-card-box border-blue">
                        <!-- BAGIAN KIRI -->
                        <div class="status-info-left">
                            <img src="{{ $imgSrc }}" alt="{{ $produk->nama_produk ?? 'Produk' }}" class="status-img">

                            <div class="status-text">
                                <h4>{{ $produk->nama_produk ?? 'Produk' }}</h4>
                                <h5>TEFA DKV</h5>
                                <p>Jumlah: <strong>{{ $detail->jumlah }}</strong></p>
                                <p>Harga: <strong>RP {{ number_format($detail->harga ?? 0, 0, ',', '.') }}</strong></p>
                                <a href="/status/detail?pesanan_id={{ $pesanan->id }}" class="btn-lihat-detail">
                                    LIHAT LEBIH DETAIL TENTANG PESANANMU
                                </a>
                            </div>
                        </div>

                        <!-- BAGIAN KANAN -->
                        <div class="status-icon-right icon-blue">
                            <i class="fa-solid fa-arrows-rotate"></i>
                            <span>{{ strtoupper($pesanan->status) }}</span>
                        </div>
                    </div>
                @endforeach

            {{-- FALLBACK: JIKA DETAIL PESANAN NULL / RELASI PRODUK LANGSUNG --}}
            @else
                @php
                    $produk = $pesanan->produk;
                    $foto = $produk->foto ?? 'default.png';
                    $imgSrc = file_exists(public_path('images/' . $foto)) 
                        ? asset('images/' . $foto) 
                        : (file_exists(public_path('storage/' . $foto)) ? asset('storage/' . $foto) : asset('images/logo_tefa.png'));
                @endphp

                <div class="status-card-box border-blue">
                    <!-- BAGIAN KIRI -->
                    <div class="status-info-left">
                        <img src="{{ $imgSrc }}" alt="{{ $produk->nama_produk ?? 'Produk' }}" class="status-img">

                        <div class="status-text">
                            <h4>{{ $produk->nama_produk ?? 'Produk DKV' }}</h4>
                            <h5>TEFA DKV</h5>
                            <p>Jumlah: <strong>{{ $pesanan->jumlah }}</strong></p>
                            <a href="/status/detail?pesanan_id={{ $pesanan->id }}" class="btn-lihat-detail">
                                LIHAT LEBIH DETAIL TENTANG PESANANMU
                            </a>
                        </div>
                    </div>

                    <!-- BAGIAN KANAN -->
                    <div class="status-icon-right icon-blue">
                        <i class="fa-solid fa-arrows-rotate"></i>
                        <span>{{ strtoupper($pesanan->status) }}</span>
                    </div>
                </div>

            @endif

        @empty

            <!-- BELUM ADA PESANAN -->
            <div style="text-align: center; padding: 50px;">
                <i class="fa-solid fa-box-open" style="font-size: 60px; margin-bottom: 20px;"></i>
                <h3>Belum Ada Pesanan</h3>
                <p>Kamu belum memiliki pesanan.</p>
                <a href="/katalog" class="btn-solid-blue" style="display: inline-block; margin-top: 15px; text-decoration: none;">
                    BELANJA SEKARANG
                </a>
            </div>

        @endforelse

    </div>

</div>

</body>
</html>