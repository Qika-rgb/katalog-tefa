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