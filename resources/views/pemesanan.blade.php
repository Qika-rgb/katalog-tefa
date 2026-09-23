@extends('layouts.frontend')

@section('content')
<div class="pemesanan-wrapper" style="padding: 40px 20px; max-width: 800px; margin: 0 auto;">
    <div class="pemesanan-card" style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        <h2>KONFIRMASI PESANAN</h2>
        <hr style="margin-bottom: 20px;">

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

        <h3 style="font-size: 22px; font-weight: bold; margin-bottom: 10px;">{{ $produk->nama_produk ?? 'Nama Produk' }}</h3>
        
        <p class="price" style="font-size: 20px; color: #e24215; font-weight: bold; margin-bottom: 15px;">
            RP {{ is_numeric($produk->harga) ? number_format((float)$produk->harga, 0, ',', '.') : $produk->harga }}
        </p>

        <p style="color: #666; margin-bottom: 25px;">{{ $produk->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

        <form action="{{ route('checkout.langsung') }}" method="POST">
            @csrf
            <input type="hidden" name="produk_id" value="{{ $produk->id ?? '' }}">
            <input type="hidden" name="jumlah" value="1">
            
            <div style="margin-bottom: 15px;">
                <label for="nama_pemesan" style="display: block; margin-bottom: 5px; font-weight: bold;">Nama Lengkap:</label>
                <input type="text" id="nama_pemesan" name="nama_pemesan" required value="{{ Auth::user()->name ?? '' }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="no_hp" style="display: block; margin-bottom: 5px; font-weight: bold;">Nomor WhatsApp:</label>
                <input type="text" id="no_hp" name="no_hp" required placeholder="Contoh: 081234567890" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="alamat" style="display: block; margin-bottom: 5px; font-weight: bold;">Alamat Pengiriman:</label>
                <textarea id="alamat" name="alamat" rows="2" required placeholder="Alamat lengkap..." style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;"></textarea>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="metode_pembayaran" style="display: block; margin-bottom: 5px; font-weight: bold;">Metode Pembayaran:</label>
                <select id="metode_pembayaran" name="metode_pembayaran" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="QRIS">QRIS</option>
                    <option value="COD">COD</option>
                </select>
            </div>

            <button type="submit" style="background: #25d366; color: white; border: none; padding: 12px 20px; font-size: 16px; font-weight: bold; border-radius: 6px; cursor: pointer; width: 100%;">
                CHECKOUT SEKARANG
            </button>
        </form>
    </div>
</div>
@endsection