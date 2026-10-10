<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Portofolio - {{ $portofolio->judul }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- PANGGIL CSS SWIPER UNTUK SLIDER -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    
    <!-- PANGGIL CSS UTAMA ANDA -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="detail-body">

    <!-- NAVBAR SEDERHANA -->
    <header class="detail-navbar">
        <img src="{{ asset('images/logo_tefa.png') }}" alt="Logo TEFA">
        <nav class="detail-nav-links">
            <a href="/" class="link-home">HOME</a>
            <a href="/portofolio" class="link-porto">PORTOFOLIO</a>
        </nav>
    </header>

    <!-- KONTEN UTAMA -->
    <div class="detail-container">
        <a href="/portofolio" class="back-link"><i class="fa-solid fa-chevron-left"></i> KEMBALI KE PORTOFOLIO</a>
        
        <div class="detail-header">
            <div>
                <h1 class="detail-title">{{ $portofolio->judul }}</h1>
                <p style="color: #6b7280; font-weight: 600; margin-top: 5px;"><i class="fa-solid fa-building"></i> {{ $portofolio->pembuat }}</p>
            </div>
            <img src="{{ asset('images/logo_tefa.png') }}" alt="Logo" style="height: 50px;">
        </div>

        <p class="detail-desc">{{ $portofolio->deskripsi }}</p>

        <!-- SWIPER SLIDER UNTUK GAMBAR -->
        <h3 class="team-section-title">Halaman / Preview Proyek</h3>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                
                <!-- HANYA Tampilkan gambar dari relasi portofolio_images (Slider) -->
                @foreach($portofolio->images as $image)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $image->gambar) }}" alt="Slider Image">
                    </div>
                @endforeach
                
                <!-- Jika tidak ada gambar slider sama sekali, barulah tampilkan gambar utama -->
                @if($portofolio->images->count() == 0)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $portofolio->gambar) }}" alt="Thumbnail Image">
                    </div>
                @endif

            </div>
            <div class="swiper-pagination"></div>
        </div>

        <!-- DAFTAR TIM PROYEK -->
        <h3 class="team-section-title">Tim Pembuat Proyek</h3>
        
        @if($portofolio->teams->count() > 0)
            <div class="team-grid">
                @foreach($portofolio->teams as $team)
                    <div class="team-card">
                        <span class="team-role">{{ $team->peran }}</span>
                        
                        @php
                            $fotoTim = $team->foto ? asset('storage/' . $team->foto) : asset('images/foto_profil.png');
                        @endphp
                        
                        <img src="{{ $fotoTim }}" alt="{{ $team->nama }}" class="team-img">
                        <div class="team-name">{{ $team->nama }}</div>
                        <div class="team-desc">SMKN 4 Tanjungpinang</div>
                    </div>
                @endforeach
            </div>
        @else
            <p style="color: #6b7280; font-style: italic;">Data tim belum ditambahkan untuk proyek ini.</p>
        @endif

    </div>

    <!-- SCRIPT UNTUK MENJALANKAN SLIDER SWIPER.JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });
    </script>
</body>
</html>