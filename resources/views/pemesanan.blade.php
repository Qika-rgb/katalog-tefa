@extends('layouts.frontend')

@section('content')
<div class="pemesanan-wrapper" style="padding: 40px 20px; max-width: 1000px; margin: 0 auto; font-family: 'Poppins', sans-serif;">

    <!-- HEADER KECIL & TOMBOL KEMBALI -->
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <a href="/katalog" style="color: #111827; font-size: 18px; text-decoration: none;"><i class="fa-solid fa-chevron-left"></i></a>
            <span style="font-weight: 700; font-size: 18px; letter-spacing: 0.5px;">PEMESANAN PRODUK</span>
        </div>
    </div>

    <!-- CARD UTAMA PEMESANAN -->
    <div class="pemesanan-card" style="background: #ffffff; border-radius: 16px; padding: 32px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border: 1px solid #f3f4f6;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 36px; align-items: start;">

            <!-- SISI KIRI: MEDIA (VIDEO / FOTO) -->
            <div style="background-color: #f9fafb; border-radius: 12px; padding: 16px; display: flex; align-items: center; justify-content: center; min-height: 320px; overflow: hidden; border: 1px solid #e5e7eb;">
                @php
                    $mediaFile = $produk->vidio ?? $produk->foto ?? 'default.png';
                    $extension = strtolower(pathinfo($mediaFile, PATHINFO_EXTENSION));

                    // Cek apakah file berasal dari upload storage atau folder images statis
                    $isStorage = preg_match('/^(produk|portofolio)\//', (string)$mediaFile);
                    $mediaUrl = $isStorage ? asset('storage/' . $mediaFile) : asset('images/' . $mediaFile);
                @endphp

                @if(in_array($extension, ['mp4', 'webm', 'ogg']))
                    <video width="100%" controls autoplay muted playsinline style="max-height: 340px; border-radius: 8px; object-fit: contain;">
                        <source src="{{ $mediaUrl }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutaran video.
                    </video>
                @else
                    <img src="{{ $mediaUrl }}" alt="{{ $produk->nama_produk ?? 'Produk' }}" style="max-height: 340px; width: 100%; object-fit: contain;">
                @endif
            </div>

            <!-- SISI KANAN: DETAIL & FORM PEMESANAN -->
            <div>
                <h1 style="font-size: 24px; font-weight: 800; color: #111827; margin-bottom: 10px; line-height: 1.3;">
                    {{ $produk->nama_produk ?? 'Nama Produk' }}
                </h1>

                <!-- Rating -->
                <div style="display: flex; align-items: center; gap: 6px; color: #f59e0b; font-size: 14px; margin-bottom: 16px;">
                    <span style="font-weight: 700; color: #111827;">4.5</span>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                    <span style="color: #6b7280; font-size: 13px; margin-left: 6px;">| 50 RB Penilaian</span>
                </div>

                <!-- Harga -->
                <div style="font-size: 24px; font-weight: 800; color: #dc2626; margin-bottom: 18px;">
                    RP 
                    @if(isset($produk->harga))
                        @if(str_contains((string)$produk->harga, '-'))
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
                </div>

                <!-- Deskripsi -->
                <p style="color: #4b5563; font-size: 14px; line-height: 1.6; margin-bottom: 24px;">
                    {{ $produk->deskripsi ?? 'Tidak ada deskripsi untuk produk ini.' }}
                </p>

                <!-- FORM PEMESANAN -->
                <form action="/keranjang/tambah/{{ $produk->id }}" method="POST">
                    @csrf
                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">

                    <!-- Kontrol Kuantitas -->
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #374151; margin-bottom: 8px;">KUANTITAS</label>
                        <div style="display: inline-flex; align-items: center; border: 1px solid #d1d5db; border-radius: 8px; overflow: hidden;">
                            <button type="button" id="btnMinus" style="width: 38px; height: 38px; background: #f3f4f6; border: none; font-size: 18px; font-weight: bold; cursor: pointer;">-</button>
                            <input type="text" name="jumlah" id="qtyInput" value="1" readonly style="width: 48px; height: 38px; text-align: center; border: none; font-weight: 600; outline: none;">
                            <button type="button" id="btnPlus" style="width: 38px; height: 38px; background: #f3f4f6; border: none; font-size: 18px; font-weight: bold; cursor: pointer;">+</button>
                        </div>
                    </div>

                    <!-- Input Nomor Telepon -->
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; font-weight: 600; font-size: 13px; color: #374151; margin-bottom: 8px;">NOMOR TELEPON / WHATSAPP</label>
                        <input type="text" name="no_telepon" placeholder="Contoh: 081234567890" required style="width: 100%; padding: 11px 14px; border: 1px solid #d1d5db; border-radius: 8px; outline: none; font-size: 14px;">
                    </div>

                    <!-- Tombol Aksi -->
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <button type="submit" style="flex: 1; min-width: 180px; padding: 12px 18px; background: #ffffff; color: #2563eb; border: 2px solid #2563eb; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
                            <i class="fa-solid fa-cart-arrow-down"></i> MASUKKAN KERANJANG
                        </button>
                        <button type="submit" formaction="{{ route('checkout.langsung') }}" style="flex: 1; min-width: 140px; padding: 12px 24px; background: #2563eb; color: #ffffff; border: none; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer;">
                            BELI SEKARANG
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    const btnMinus = document.getElementById('btnMinus');
    const btnPlus = document.getElementById('btnPlus');
    const qtyInput = document.getElementById('qtyInput');

    if (btnMinus && btnPlus && qtyInput) {
        btnMinus.addEventListener('click', () => {
            let val = parseInt(qtyInput.value) || 1;
            if (val > 1) qtyInput.value = val - 1;
        });

        btnPlus.addEventListener('click', () => {
            let val = parseInt(qtyInput.value) || 1;
            qtyInput.value = val + 1;
        });
    }
</script>
@endsection