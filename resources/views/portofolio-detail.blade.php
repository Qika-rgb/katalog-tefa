<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#2563eb">
    <meta name="description" content="Detail Portofolio {{ $portofolio->judul }} - Teaching Factory SMKN 4 Tanjungpinang.">
    <link rel="icon" type="image/png" href="{{ asset('images/logo_tefa.png') }}">
    <title>Detail Portofolio - {{ $portofolio->judul }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- PANGGIL CSS SWIPER UNTUK SLIDER -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    
    <!-- PANGGIL CSS UTAMA -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="detail-body">

    <!-- NAVBAR SEDERHANA -->
    <header class="detail-navbar">
        <a href="/" aria-label="Beranda Katalog TEFA">
            <img src="{{ asset('images/logo_tefa.png') }}" alt="Logo TEFA" width="120" height="40" style="object-fit: contain;">
        </a>
        <nav class="detail-nav-links" style="display: flex; align-items: center; gap: 20px;">
            <a href="/" class="link-home">{{ __('messages.nav_home') }}</a>
            <a href="/portofolio" class="link-porto">{{ __('messages.nav_portofolio') }}</a>
            <div class="lang-switcher">
                <a href="{{ route('lang.switch', 'id') }}" class="lang-btn {{ app()->getLocale() == 'id' ? 'active' : '' }}" title="Bahasa Indonesia">ID</a>
                <span class="lang-divider">|</span>
                <a href="{{ route('lang.switch', 'en') }}" class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}" title="English">EN</a>
            </div>
        </nav>
    </header>

    <!-- KONTEN UTAMA -->
    <main class="detail-container">
        <a href="/portofolio" class="back-link"><i class="fa-solid fa-chevron-left"></i> {{ __('messages.portfolio_back') }}</a>
        
        <div class="detail-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 15px;">
            <div style="flex: 1; min-width: 250px;">
                <h1 class="detail-title">{{ $portofolio->judul }}</h1>
                <p style="color: #6b7280; font-weight: 600; margin-top: 5px;"><i class="fa-solid fa-building"></i> {{ $portofolio->pembuat }}</p>
            </div>
            <img src="{{ asset('images/logo_tefa.png') }}" alt="Logo TEFA" style="max-height: 80px; width: auto; object-fit: contain;">
        </div>

        <p class="detail-desc">{{ $portofolio->deskripsi }}</p>

        <!-- SWIPER SLIDER UNTUK GAMBAR -->
        <h3 class="team-section-title">{{ __('messages.portfolio_project_preview') }}</h3>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                
                <!-- HANYA Tampilkan gambar dari relasi portofolio_images (Slider) -->
                @foreach($portofolio->images as $image)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $image->gambar) }}" alt="Slider Image {{ $loop->iteration }}" loading="lazy" decoding="async">
                    </div>
                @endforeach
                
                <!-- Jika tidak ada gambar slider sama sekali, barulah tampilkan gambar utama -->
                @if($portofolio->images->count() == 0)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $portofolio->gambar) }}" alt="Thumbnail Image" loading="lazy" decoding="async">
                    </div>
                @endif

            </div>
            <div class="swiper-pagination"></div>
        </div>

        <!-- DAFTAR TIM PROYEK -->
        <h3 class="team-section-title">{{ __('messages.portfolio_team_title') }}</h3>
        
        @if($portofolio->teams->count() > 0)
            <div class="team-grid">
                @foreach($portofolio->teams as $team)
                    <div class="team-card">
                        @php
                            $fotoTim = $team->foto ? asset('storage/' . $team->foto) : asset('images/foto_profil.png');
                        @endphp
                        
                        <img src="{{ $fotoTim }}" alt="{{ $team->nama }}" class="team-img" loading="lazy" decoding="async" width="180" height="180">
                        <div class="team-name">{{ $team->nama }}</div>
                        <div class="team-desc">SMKN 4 Tanjungpinang</div>
                    </div>
                @endforeach
            </div>
        @else
            <p style="color: #6b7280; font-style: italic;">{{ __('messages.portfolio_team_empty') }}</p>
        @endif

    </main>

    @include('components.footer')

    <!-- SCRIPT UNTUK MENJALANKAN SLIDER SWIPER.JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            grabCursor: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
        });
    </script>
</body>
</html>