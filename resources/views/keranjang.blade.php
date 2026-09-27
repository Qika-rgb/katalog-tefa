@extends('layouts.frontend')

@section('content')
<div class="cart-container">
    <h2 class="cart-title">Keranjang Belanja</h2>

    @if(session('success'))
        <div class="cart-alert-success">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background-color: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; padding: 14px 18px; border-radius: 10px; margin-bottom: 25px;">
            <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
        </div>
    @endif

    @if(isset($keranjangs) && count($keranjangs) > 0)
        <div class="cart-layout">
            
            <!-- Kolom Kiri: Daftar Produk -->
            <div class="cart-card">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th style="text-align: center;">Jumlah</th>
                            <th>Subtotal</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $grandTotal = 0; @endphp
                        @foreach($keranjangs as $item)
                            @php
                                $harga = (float)($item->produk->harga ?? 0);
                                $subtotal = $harga * ($item->jumlah ?? 1);
                                $grandTotal += $subtotal;

                                $foto = $item->produk->foto ?? $item->produk->vidio ?? 'default.png';
                                if (str_contains($foto, 'produk/') || str_contains($foto, 'portofolio/')) {
                                    $imgUrl = asset('storage/' . $foto);
                                } else {
                                    $imgUrl = asset('images/' . $foto);
                                }
                            @endphp
                            <tr>
                                <td>
                                    <div class="cart-product-item">
                                        <img src="{{ $imgUrl }}" alt="{{ $item->produk->nama_produk ?? 'Produk' }}" class="cart-product-img">
                                        <div>
                                            <h4 class="cart-product-name">{{ $item->produk->nama_produk ?? 'Nama Produk' }}</h4>
                                            <span class="cart-product-sub">TEFA SMKN 4</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart-product-price">Rp {{ number_format($harga, 0, ',', '.') }}</td>
                                <td style="text-align: center;">
                                    <span class="cart-qty-badge">{{ $item->jumlah ?? 1 }}</span>
                                </td>
                                <td class="cart-product-subtotal">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                <td style="text-align: center;">
                                    <form action="{{ route('keranjang.hapus', $item->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-cart-delete" title="Hapus Item">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Kolom Kanan: Ringkasan Total Belanja -->
            <div class="cart-summary-card">
                <h3 class="summary-title">Ringkasan Belanja</h3>
                
                <div class="summary-row">
                    <span>Total Item</span>
                    <span>{{ count($keranjangs) }} Produk</span>
                </div>

                <div class="summary-divider"></div>

                <div class="summary-row summary-total">
                    <span>Total Harga</span>
                    <span class="total-amount">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                </div>

                <a href="{{ route('checkout.index') }}" class="btn-checkout">
                    Lanjut ke Checkout <i class="fa-solid fa-arrow-right"></i>
                </a>

                <a href="{{ url('/katalog') }}" class="btn-continue-shopping">
                    <i class="fa-solid fa-chevron-left"></i> Lanjut Belanja
                </a>
            </div>

        </div>
    @else
        <!-- Tampilan Saat Keranjang Kosong -->
        <div class="cart-empty-box">
            <i class="fa-solid fa-cart-shopping cart-empty-icon"></i>
            <h3>Keranjang belanja Anda masih kosong</h3>
            <p>Yuk pilih berbagai karya dan produk TEFA SMKN 4 yang menarik di katalog!</p>
            <a href="{{ url('/katalog') }}" class="btn-checkout" style="display: inline-flex; width: auto; padding: 12px 28px;">
                Lihat Katalog Produk
            </a>
        </div>
    @endif
</div>
@endsection