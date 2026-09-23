<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-light">

<div class="pemesanan-wrapper">
    <!-- HEADER -->
    <div class="pemesanan-header">
        <div class="pemesanan-title">
            <a href="javascript:void(0)" onclick="history.back()">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <span class="text-blue">
                CHECKOUT
            </span>
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

    <!-- CARD CHECKOUT -->
    <div class="pemesanan-card">
        <div style="padding: 30px;">
            <h2>KONFIRMASI PESANAN</h2>
            <hr>

            <!-- DAFTAR PRODUK -->
            @forelse ($keranjangs as $item)
                <div style="display: flex; align-items: center; gap: 20px; padding: 20px 0; border-bottom: 1px solid #ddd;">
<<<<<<< HEAD
=======
                    
>>>>>>> 6a27fb97cc0824b2664bb04bef876ceb65e44c33
                    <img src="{{ asset('images/' . $item->produk->foto) }}" alt="{{ $item->produk->nama_produk }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px;">

                    <div style="flex: 1;">
                        <h3>{{ $item->produk->nama_produk }}</h3>
                        <p>Harga: 
                            <strong>
                                RP 
                                @if(str_contains($item->produk->harga, '-'))
                                    {{ $item->produk->harga }}
                                @else
                                    @if(is_numeric(str_replace(['.', ','], '', $item->produk->harga)))
                                        {{ number_format((float) str_replace(['.', ','], '', $item->produk->harga), 0, ',', '.') }}
                                    @else
                                        {{ $item->produk->harga }}
                                    @endif
                                @endif
                            </strong>
                        </p>
                        <p>Jumlah: <strong>{{ $item->jumlah }}</strong></p>
                    </div>

                    <div>
                        <strong>
                            RP 
                            @php
                                $hargaClean = is_numeric(str_replace(['.', ','], '', $item->produk->harga)) 
                                    ? (float) str_replace(['.', ','], '', $item->produk->harga) 
                                    : 0;
                            @endphp
                            {{ number_format($hargaClean * $item->jumlah, 0, ',', '.') }}
                        </strong>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 40px;">
                    <i class="fa-solid fa-cart-shopping" style="font-size: 50px;"></i>
                    <h3>Keranjang masih kosong</h3>
                    <a href="/katalog">Kembali ke Katalog</a>
                </div>
            @endforelse

            @if(count($keranjangs) > 0)
                <!-- FORM CHECKOUT -->
                <form action="/checkout" method="POST">
                    @csrf

                    <!-- DATA PEMBELI -->
                    <div style="margin-top: 30px;">
                        <h2>DATA PEMBELI</h2>
                        <div style="margin-top: 20px;">
                            <label>Nama</label>
                            <input type="text" name="nama" placeholder="MASUKKAN NAMA" required style="width: 100%; padding: 12px; margin-top: 8px; margin-bottom: 15px;">
                        </div>

                        <div>
                            <label>Nomor Telepon</label>
                            <input type="text" name="telepon" placeholder="MASUKKAN NOMOR TELEPON" required style="width: 100%; padding: 12px; margin-top: 8px; margin-bottom: 15px;">
                        </div>

                        <div>
                            <label>Alamat</label>
                            <textarea name="alamat" placeholder="MASUKKAN ALAMAT" rows="4" required style="width: 100%; padding: 12px; margin-top: 8px;"></textarea>
                        </div>
                    </div>

                    <!-- TOTAL -->
                    <div style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #ddd;">
                        <div style="display: flex; justify-content: space-between; font-size: 20px; font-weight: bold;">
                            <span>TOTAL PESANAN</span>
                            <span>
<<<<<<< HEAD
                                RP {{ number_format($keranjangs->sum(function ($item) { return $item->produk->harga * $item->jumlah; }), 0, ',', '.') }}
=======
                                RP {{ number_format(
                                    $keranjangs->sum(function ($item) {
                                        $hargaClean = is_numeric(str_replace(['.', ','], '', $item->produk->harga)) 
                                            ? (float) str_replace(['.', ','], '', $item->produk->harga) 
                                            : 0;
                                        return $hargaClean * $item->jumlah;
                                    }),
                                    0,
                                    ',',
                                    '.'
                                ) }}
>>>>>>> 6a27fb97cc0824b2664bb04bef876ceb65e44c33
                            </span>
                        </div>

                        <!-- TOMBOL KONFIRMASI -->
                        <button type="submit" class="btn-checkout" style="margin-top: 25px;">
                            KONFIRMASI PESANAN
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>

</body>
</html>