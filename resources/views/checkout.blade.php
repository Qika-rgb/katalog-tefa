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
            <a href="/customer-service" style="color: inherit; text-decoration: none;">
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
                    
                    <img src="{{ asset('images/' . ($item->produk->foto ?? 'default.png')) }}" alt="{{ $item->produk->nama_produk ?? 'Produk' }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px;">

                    <div style="flex: 1;">
                        <h3>{{ $item->produk->nama_produk ?? 'Nama Produk' }}</h3>
                        <p>Harga: 
                            <strong>
                                RP 
                                @if(isset($item->produk->harga))
                                    @if(str_contains((string)$item->produk->harga, '-'))
                                        {{ $item->produk->harga }}
                                    @else
                                        @php
                                            $cleanPrice = preg_replace('/[^0-9]/', '', (string)$item->produk->harga);
                                        @endphp
                                        {{ is_numeric($cleanPrice) ? number_format((float)$cleanPrice, 0, ',', '.') : $item->produk->harga }}
                                    @endif
                                @else
                                    0
                                @endif
                            </strong>
                        </p>
                        <p>Jumlah: <strong>{{ $item->jumlah }}</strong></p>
                    </div>

                    <div>
                        <strong>
                            RP 
                            @php
                                $hargaClean = (float) preg_replace('/[^0-9]/', '', (string)($item->produk->harga ?? 0));
                            @endphp
                            {{ number_format($hargaClean * (int)$item->jumlah, 0, ',', '.') }}
                        </strong>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 40px;">
                    <i class="fa-solid fa-cart-shopping" style="font-size: 50px;"></i>
                    <h3>Keranjang masih kosong</h3>
                    <a href="/katalog" class="btn-solid-blue" style="display: inline-block; margin-top: 15px; text-decoration: none;">Kembali ke Katalog</a>
                </div>
            @endforelse

            @if(count($keranjangs) > 0)
                <!-- FORM CHECKOUT -->
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf

                    <!-- DATA PEMBELI -->
                    <div style="margin-top: 30px;">
                        <h2>DATA PEMBELI</h2>

                        @if ($errors->any())
                            <div style="padding: 10px 15px; background-color: #f8d7da; color: #721c24; border-radius: 8px; margin-top: 15px; font-weight: 600;">
                                <ul style="margin: 0; padding-left: 20px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div style="margin-top: 20px;">
                            <label>Nama</label>
                            <input type="text" name="nama" value="{{ old('nama', Auth::user()->name ?? '') }}" placeholder="MASUKKAN NAMA" required style="width: 100%; padding: 12px; margin-top: 8px; margin-bottom: 15px;">
                        </div>

                        <div>
                            <label>Nomor Telepon</label>
                            <input type="text" name="telepon" value="{{ old('telepon') }}" placeholder="MASUKKAN NOMOR TELEPON" required style="width: 100%; padding: 12px; margin-top: 8px; margin-bottom: 15px;">
                        </div>

                        <div>
                            <label>Alamat</label>
                            <textarea name="alamat" placeholder="MASUKKAN ALAMAT" rows="4" required style="width: 100%; padding: 12px; margin-top: 8px;">{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                    <!-- TOTAL -->
                    <div style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #ddd;">
                        <div style="display: flex; justify-content: space-between; font-size: 20px; font-weight: bold;">
                            <span>TOTAL PESANAN</span>
                            <span>
                                RP {{ number_format(
                                    $keranjangs->sum(function ($item) {
                                        $hargaClean = (float) preg_replace('/[^0-9]/', '', (string)($item->produk->harga ?? 0));
                                        return $hargaClean * (int)($item->jumlah ?? 1);
                                    }),
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </span>
                        </div>

                        <!-- TOMBOL KONFIRMASI -->
                        <button type="submit" class="btn-checkout" style="margin-top: 25px; border: none; cursor: pointer; width: 100%;">
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