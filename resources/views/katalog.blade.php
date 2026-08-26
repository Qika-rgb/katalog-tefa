@extends('layouts.app')

@section('content')
<div class="katalog-wrapper">

    <!-- BAGIAN BANNER -->
    <div class="banner-container">
        <!-- Panah Kiri -->
        <i class="fa-solid fa-chevron-left banner-arrow" id="prevBanner"></i>
        
        <div class="banner-content" id="bannerBg">
            <div class="banner-text">
                <h1 id="bannerTitle">WELCOME TO TEFA REKAYASA PERANGKAT LUNAK</h1>
                <a href="#" class="btn-banner">READY FOR DIGITAL WORK?</a>
            </div>
            
            <!-- Gambar Banner -->
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
<script>
    // 1. Data Banner (Pastikan nama gambar persis dengan yang ada di foldermu)
    const banners = [
        {
            title: "WELCOME TO TEFA REKAYASA PERANGKAT LUNAK",
            bg: "linear-gradient(to right, #ab6f4f, #e24215)", // Oranye RPL
            img: "{{ asset('images/icon_rpl.png') }}"
        },
        {
            title: "WELCOME TO TEFA ANIMASI",
            bg: "linear-gradient(to right, #38bdf8, #08405c)", // Biru muda Animasi
            img: "{{ asset('images/icon_animasi.png') }}"
        },
        {
            title: "WELCOME TO TEFA TKJ",
            bg: "linear-gradient(to right, #34d399, #065139)", // Hijau TKJ
            img: "{{ asset('images/icon_tkj.png') }}"
        },
        {
            title: "WELCOME TO TEFA PSPT",
            bg: "linear-gradient(to right, #facc15, #573e07)", // Kuning PSPT
            img: "{{ asset('images/icon_pspt.png') }}"
        },
        {
            title: "WELCOME TO TEFA DKV",
            bg: "linear-gradient(to right, #dc2626, #991b1b)", // Merah DKV
            img: "{{ asset('images/icon_dkv1.png') }}"
        },
        {
            title: "WELCOME TO TEFA PENGEMBANGAN GIM",
            bg: "linear-gradient(to right, #4f46e5, #090542)", // Ungu Game
            img: "{{ asset('images/icon_gim.png') }}"
        }
    ];

    let currentIndex = 0;

    // 2. Ambil elemen dari HTML
    const bannerBg = document.getElementById('bannerBg');
    const bannerTitle = document.getElementById('bannerTitle');
    const bannerImg = document.getElementById('bannerImg');
    const btnPrev = document.getElementById('prevBanner');
    const btnNext = document.getElementById('nextBanner');
    const katalogTitle = document.querySelector('.katalog-section-title');

    // 3. Fungsi Utama (Mengubah Banner, Judul, dan Filter Produk)
    function updateBanner(index) {
        // Ubah Banner
        bannerBg.style.background = banners[index].bg;
        bannerTitle.textContent = banners[index].title;
        bannerImg.src = banners[index].img;

        // Ubah Judul Katalog
        if (katalogTitle) {
            const namaJurusan = banners[index].title.replace('WELCOME TO TEFA ', '');
            katalogTitle.textContent = "CATALOG " + namaJurusan;
        }

        // Filter Produk
        const products = document.querySelectorAll('.product-card');
        products.forEach(product => {
            const kategoriProduk = product.getAttribute('data-kategori');
            // Tampilkan jika kategori cocok ATAU jika belum ada kategori dari backend
            if (!kategoriProduk || kategoriProduk == index) {
                product.style.display = 'flex';
            } else {
                product.style.display = 'none';
            }
        });
    }

    // 4. Fungsi Global untuk dipanggil dari Navbar Search
    window.goToBanner = function(index) {
        currentIndex = parseInt(index);
        updateBanner(currentIndex);
    };

    // 5. BANGUNKAN JAVASCRIPT SAAT HALAMAN DIMUAT (REFRESH)
    const urlParams = new URLSearchParams(window.location.search);
    const requestedBanner = urlParams.get('banner');
    if (requestedBanner !== null) {
        goToBanner(requestedBanner); // Jika di-klik dari Home
    } else {
        updateBanner(currentIndex); // Jika hanya di-refresh biasa
    }

    // 6. Logika Klik Panah
    btnNext.addEventListener('click', function() {
        currentIndex++;
        if (currentIndex >= banners.length) {
            currentIndex = 0;
        }
        updateBanner(currentIndex);
    });

    btnPrev.addEventListener('click', function() {
        currentIndex--;
        if (currentIndex < 0) {
            currentIndex = banners.length - 1;
        }
        updateBanner(currentIndex);
    });
</script>
@endsection