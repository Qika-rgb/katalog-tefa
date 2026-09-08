<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog TEFA - SMKN 4 Tanjungpinang</title>

    <!-- FONT & ICON -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- MEMANGGIL CSS ASLIMU -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- NAVBAR ASLI SESUAI CSS-MU -->
    <!-- NAVBAR ASLI SESUAI CSS-MU -->
    <nav class="navbar">
        
        <!-- 1. LOGO -->
        <div class="nav-brand">
            <a href="/">
                <img src="{{ asset('images/logo_tefa.png') }}" alt="Logo TEFA">
            </a>
        </div>

        <!-- 2. MENU UTAMA -->
        <ul class="nav-menu">
            <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">HOME</a></li>
            <li><a href="/katalog" class="{{ request()->is('katalog') ? 'active' : '' }}">KATALOG</a></li>
            <li><a href="/status" class="{{ request()->is('status') ? 'active' : '' }}">STATUS</a></li>
        </ul>

        <!-- 3. SEARCH BAR -->
        <div class="nav-search">
            <!-- Icon pencarian (warna disesuaikan agar tebal hitam) -->
            <i class="fa-solid fa-magnifying-glass" style="color: #000; font-size: 18px;"></i>
            <input type="text" placeholder="">
        </div>

        <!-- 4. ICON & AUTH BREEZE -->
        <div class="nav-icons" style="align-items: center;">
            
            <!-- Icon Keranjang -->
            <a href="/keranjang" style="color: #000;"><i class="fa-solid fa-cart-shopping"></i></a>
            
            <!-- Icon User Profile (Otomatis deteksi login) -->
            @guest
                <!-- Jika BELUM login, klik icon ini akan ke halaman Login Breeze -->
                <a href="{{ route('login') }}" style="color: #000;"><i class="fa-regular fa-circle-user"></i></a>
            @else
                <!-- Jika SUDAH login, klik icon ini akan ke Dashboard -->
                <a href="{{ url('/dashboard') }}" style="color: #000;"><i class="fa-regular fa-circle-user"></i></a>
            @endguest

            <!-- Icon Customer Service -->
            <a href="/customer-service" style="color: #000;"><i class="fa-solid fa-headset"></i></a>
            
        </div>

    </nav>

    <!-- AREA KONTEN -->
    @yield('content')

</body>
</html>