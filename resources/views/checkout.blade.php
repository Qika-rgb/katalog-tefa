@extends('layouts.frontend')

@section('content')
<div class="checkout-wrapper">
    <!-- Tombol Kembali & Judul Halaman -->
    <div class="checkout-header-bar">
        <a href="{{ url()->previous() != url()->current() ? url()->previous() : url('/katalog') }}" class="btn-back">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
        <h2 class="checkout-page-title">Checkout Pesanan</h2>
    </div>

    <!-- Alert Error Validasi -->
    @if ($errors->any())
        <div class="checkout-alert-danger">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        {{-- Hidden input jika checkout langsung per produk --}}
        @if(isset($produk))
            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
            <input type="hidden" name="qty" value="{{ $qty ?? 1 }}">
        @endif

        <div class="checkout-layout">
            <!-- Kolom Kiri: Form Informasi Pemesan -->
            <div class="checkout-card form-section">
                <h3 class="checkout-section-title">
                    <i class="fa-solid fa-address-card" style="color: #2563eb;"></i> Informasi Pengiriman & Pemesan
                </h3>

                <div class="form-group">
                    <label for="nama_pemesan">Nama Lengkap</label>
                    <input type="text" id="nama_pemesan" name="nama_pemesan" value="{{ old('nama_pemesan', Auth::user()->name ?? '') }}" placeholder="Masukkan nama lengkap Anda" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="no_hp">Nomor Handphone / WhatsApp</label>
                    <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890" required class="form-control">
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label for="alamat">Alamat Lengkap Pengiriman / Catatan Pesanan</label>
                    <textarea id="alamat" name="alamat" rows="4" placeholder="Masukkan alamat lengkap tujuan pengiriman atau deskripsi pesanan spesifik..." required class="form-control">{{ old('alamat') }}</textarea>
                </div>
            </div>

            <!-- Kolom Kanan: Ringkasan Pesanan -->
            <div class="checkout-summary-card">
                <h3 class="checkout-section-title" style="margin-bottom: 16px;">
                    <i class="fa-solid fa-receipt" style="color: #2563eb;"></i> Ringkasan Pesanan
                </h3>

                <div class="checkout-items-list">
                    @if(isset($items) && count($items) > 0)
                        @foreach($items as $item)
                            @php
                                $prod = $item->produk;
                                $mediaFile = $prod->vidio ?? $prod->foto ?? 'default.png';
                                $imgUrl = (str_contains($mediaFile, 'produk/') || str_contains($mediaFile, 'portofolio/')) 
                                    ? asset('storage/' . $mediaFile) 
                                    : asset('images/' . $mediaFile);
                                $subtotalItem = $item->subtotal ?? ($prod->harga * $item->jumlah);
                            @endphp
                            <div class="checkout-item-row">
                                <img src="{{ $imgUrl }}" alt="{{ $prod->nama_produk ?? 'Produk' }}" class="checkout-item-img">
                                <div class="checkout-item-details">
                                    <h4 class="checkout-item-name">{{ $prod->nama_produk ?? 'Produk' }}</h4>
                                    <span class="checkout-item-meta">{{ $item->jumlah }}x Rp {{ number_format($prod->harga ?? 0, 0, ',', '.') }}</span>
                                    <span class="checkout-item-subtotal">Rp {{ number_format($subtotalItem, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="checkout-divider"></div>

                <div class="checkout-price-row">
                    <span>Subtotal Produk</span>
                    <span>Rp {{ number_format($totalHarga ?? 0, 0, ',', '.') }}</span>
                </div>

                <div class="checkout-price-row">
                    <span>Biaya Layanan</span>
                    <span style="color: #16a34a; font-weight: 600;">Gratis</span>
                </div>

                <div class="checkout-divider"></div>

                <div class="checkout-price-row checkout-total-row">
                    <span>Total Pembayaran</span>
                    <span class="checkout-total-amount">Rp {{ number_format($totalHarga ?? 0, 0, ',', '.') }}</span>
                </div>

                <button type="submit" class="btn-submit-order">
                    <i class="fa-solid fa-lock"></i> Buat Pesanan Sekarang
                </button>
            </div>
        </div>
    </form>
</div>
@endsection