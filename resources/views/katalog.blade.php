@extends('layouts.frontend')

@section('content')
<div class="katalog-wrapper">

    <!-- BAGIAN BANNER -->
    <div class="banner-container">
        <!-- Panah Kiri -->
        <i class="fa-solid fa-chevron-left banner-arrow" id="prevBanner"></i>
        
        <div class="banner-content" id="bannerBg">
            <div class="banner-text" id="bannerTextContainer">
                <!-- Teks judul banner -->
                <h1 id="bannerTitle">WELCOME TO TEFA REKAYASA PERANGKAT LUNAK</h1>
                <!-- TOMBOL READY FOR DIGITAL WORK SUDAH DIHAPUS DARI SINI -->
            </div>
            
            <!-- Gambar Banner Orang -->
            <img src="{{ asset('images/icon_rpl.png') }}" alt="Banner Icon" class="banner-img" id="bannerImg">
        </div>

        <!-- Panah Kanan -->
        <i class="fa-solid fa-chevron-right banner-arrow" id="nextBanner"></i>
    </div>

    <!-- JUDUL KATALOG -->
    <h2 class="katalog-section-title">CATALOG SEMUA PRODUK</h2>

    <!-- GRID PRODUK DARI DATABASE -->
    <div class="product-grid">
        
        <!-- Mulai Perulangan Database -->
        @foreach ($produks as $item)
            <!-- Tambahkan data-kategori di sini -->
            <!-- Asumsi: tim backend membuat kolom 'kategori_id' (0=RPL, 1=Animasi, 2=TKJ, 3=PSPT, 4=DKV, 5=Gim) -->
            <div class="product-card" data-kategori="{{ $item->kategori_id ?? '' }}">
                
                <!-- Kotak Gambar & Tombol -->
                <div class="product-img-wrapper">
                    <img src="{{ asset('images/' . $item->foto) }}" alt="{{ $item->nama_produk }}">
                    <!-- Mengirimkan ID produk ke URL -->
                    <a href="/pemesanan/{{ $item->id }}" class="btn-order">ORDER NOW</a>
                </div>
                
                <!-- Info Teks -->
                <div class="product-info">
                    <h3>{{ $item->nama_produk }}</h3>
                    <p class="price">RP {{ number_format($item->harga, 0, ',', '.') }}</p>
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <span>5.0 + 5Rb terjual</span>
                    </div>
                </div>
                
            </div>
        @endforeach
        
    </div>

</div> <!-- Penutup katalog-wrapper yang benar -->

<!-- SCRIPT UNTUK SLIDER BANNER -->
<!-- SCRIPT UNTUK SLIDER BANNER & FILTER PRODUK -->
<!-- SCRIPT UNTUK SLIDER BANNER & SINKRONISASI FILTER -->
<!-- SCRIPT UNTUK SLIDER BANNER & SINKRONISASI FILTER -->
<script>
    // 1. Data Banner Khusus "Semua Jurusan"
    const bannerSemua = {
        title: "WELCOME TO SMKN 4 TANJUNGPINANG",
        img: "{{ asset('images/icon_sekolah.png') }}"
    };

    // 2. Data Banner Jurusan 
    const banners = [
        { title: "WELCOME TO TEFA REKAYASA PERANGKAT LUNAK", bg: "linear-gradient(to right, #ab6f4f, #e24215)", img: "{{ asset('images/icon_rpl.png') }}" },
        { title: "WELCOME TO TEFA ANIMASI", bg: "linear-gradient(to right, #38bdf8, #08405c)", img: "{{ asset('images/icon_animasi.png') }}" },
        { title: "WELCOME TO TEFA TKJ", bg: "linear-gradient(to right, #34d399, #065139)", img: "{{ asset('images/icon_tkj.png') }}" },
        { title: "WELCOME TO TEFA PSPT", bg: "linear-gradient(to right, #facc15, #573e07)", img: "{{ asset('images/icon_pspt.png') }}" },
        { title: "WELCOME TO TEFA DKV", bg: "linear-gradient(to right, #dc2626, #991b1b)", img: "{{ asset('images/icon_dkv2.png') }}" },
        { title: "WELCOME TO TEFA PENGEMBANGAN GIM", bg: "linear-gradient(to right, #4f46e5, #090542)", img: "{{ asset('images/icon_gim.png') }}" }
    ];

    let currentIndex = 0;
    let isSemuaJurusan = false;

    // 3. Ambil elemen HTML
    const bannerBg = document.getElementById('bannerBg');
    const bannerTitle = document.getElementById('bannerTitle');
    const bannerImg = document.getElementById('bannerImg');
    const btnPrev = document.getElementById('prevBanner');
    const btnNext = document.getElementById('nextBanner');
    const katalogTitle = document.querySelector('.katalog-section-title');
    const bannerTextContainer = document.getElementById('bannerTextContainer');

    // 4. BACA URL SAAT HALAMAN DIMUAT
    const urlParams = new URLSearchParams(window.location.search);
    const kategoriParam = urlParams.get('kategori');

    if (kategoriParam === 'all' || kategoriParam === null) {
        // --- JIKA BERADA DI SEMUA JURUSAN ---
        isSemuaJurusan = true;
        
        // Background menggunakan center 20% agar foto sedikit turun
        bannerBg.style.background = `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('${bannerSemua.img}') center 20%/cover no-repeat`;
        bannerTitle.textContent = bannerSemua.title;
        bannerTitle.style.textShadow = '2px 2px 10px rgba(0,0,0,0.8)';
        bannerTextContainer.style.textAlign = 'center';
        bannerTextContainer.style.width = '100%';
        
        // Sembunyikan Gambar Icon Orang
        if(bannerImg) bannerImg.style.display = 'none';
        
        if (katalogTitle) katalogTitle.textContent = "CATALOG SEMUA PRODUK";

    } else {
        // --- JIKA BERADA DI JURUSAN SPESIFIK ---
        isSemuaJurusan = false;
        currentIndex = parseInt(kategoriParam);
        
        bannerBg.style.background = banners[currentIndex].bg;
        bannerTitle.textContent = banners[currentIndex].title;
        bannerTitle.style.textShadow = 'none';
        bannerTextContainer.style.textAlign = 'left';
        bannerTextContainer.style.width = 'auto';
        
        // Tampilkan Kembali Gambar Icon Orang
        if(bannerImg) {
            bannerImg.style.display = 'block';
            bannerImg.src = banners[currentIndex].img;
        }
        
        if (katalogTitle) {
            const namaJurusan = banners[currentIndex].title.replace('WELCOME TO TEFA ', '');
            katalogTitle.textContent = "CATALOG " + namaJurusan;
        }
    }
    
    // Tampilkan produk
    const products = document.querySelectorAll('.product-card');
    products.forEach(product => {
        product.style.display = 'flex'; 
    });

// 5. LOGIKA KLIK PANAH SLIDER (Sudah diperbaiki agar 'Semua Jurusan' ikut berputar)
    btnNext.addEventListener('click', function() {
        if (isSemuaJurusan) {
            // Jika sedang di "Semua Jurusan", lanjut ke RPL (0)
            window.location.href = `/katalog?kategori=0`;
        } else {
            // Jika sedang di jurusan terakhir (Gim), kembali ke "Semua Jurusan"
            if (currentIndex >= banners.length - 1) {
                window.location.href = `/katalog?kategori=all`;
            } else {
                // Jika di tengah-tengah, lanjut ke jurusan berikutnya
                currentIndex++;
                window.location.href = `/katalog?kategori=${currentIndex}`;
            }
        }
    });

    btnPrev.addEventListener('click', function() {
        if (isSemuaJurusan) {
            // Jika sedang di "Semua Jurusan", mundur ke jurusan terakhir (Gim)
            window.location.href = `/katalog?kategori=${banners.length - 1}`;
        } else {
            // Jika sedang di jurusan pertama (RPL), mundur ke "Semua Jurusan"
            if (currentIndex <= 0) {
                window.location.href = `/katalog?kategori=all`;
            } else {
                // Jika di tengah-tengah, mundur ke jurusan sebelumnya
                currentIndex--;
                window.location.href = `/katalog?kategori=${currentIndex}`;
            }
        }
    });
</script>
@endsection