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

    <!-- 3. SEARCH BAR MENGGUNAKAN FORM GET -->
        <form action="{{ url('/katalog') }}" method="GET" class="nav-search" style="display: flex; align-items: center; margin: 0;">
            
            <!-- DROPDOWN PILIHAN JURUSAN (SEKARANG PAKAI ANGKA KATEGORI_ID) -->
            <!-- DROPDOWN PILIHAN JURUSAN -->
                    <select name="kategori" onchange="this.form.submit()" style="border: none; outline: none; background: transparent; font-family: 'Poppins', sans-serif; cursor: pointer; padding-right: 10px; border-right: 1px solid #ccc; margin-right: 10px; font-weight: 500; color: #333;">
                        <option value="all" {{ request('kategori') == 'all' ? 'selected' : '' }}>Semua Jurusan</option>
                        
                        <!-- UBAH ANGKA 6 MENJADI 0 DI BARIS INI -->
                        <option value="0" {{ request('kategori') == '0' ? 'selected' : '' }}>RPL</option>
                        
                        <option value="4" {{ request('kategori') == '4' ? 'selected' : '' }}>DKV</option>
                        <option value="2" {{ request('kategori') == '2' ? 'selected' : '' }}>TKJ</option>
                        <option value="1" {{ request('kategori') == '1' ? 'selected' : '' }}>Animasi</option>
                        <option value="3" {{ request('kategori') == '3' ? 'selected' : '' }}>PSPT</option>
                        <option value="5" {{ request('kategori') == '5' ? 'selected' : '' }}>Gim</option>
                    </select>

            <!-- INPUT PENCARIAN -->
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari..." style="border: none; outline: none; width: 100%; font-family: 'Poppins', sans-serif;">
            
            <!-- TOMBOL SEARCH -->
            <button type="submit" style="background: transparent; border: none; padding: 0; cursor: pointer;">
                <i class="fa-solid fa-magnifying-glass" style="color: #000; font-size: 18px;"></i>
            </button>
            
        </form>

        <!-- 4. ICON & AUTH BREEZE -->
        <div class="nav-icons" style="align-items: center; display: flex; gap: 20px;">
            
            <!-- Icon Keranjang -->
            <a href="/keranjang" style="color: #000;"><i class="fa-solid fa-cart-shopping"></i></a>
            
            <!-- Icon User Profile & Logout -->
            @guest
                <!-- Jika BELUM login -->
                <a href="{{ route('login') }}" style="color: #000;" title="Login / Register"><i class="fa-regular fa-circle-user"></i></a>
            @else
                <!-- Jika SUDAH login -->
                <a href="{{ url('/dashboard') }}" style="color: #000;" title="Masuk ke Dashboard"><i class="fa-regular fa-circle-user"></i></a>
                
                <!-- TOMBOL LOGOUT (WAJIB PAKAI FORM) -->
                <form method="POST" action="{{ route('logout') }}" style="margin: 0; display: flex; align-items: center;">
                    @csrf
                    <button type="submit" style="background: transparent; border: none; padding: 0; color: #dc2626; font-size: 20px; cursor: pointer;" title="Logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            @endguest

            <!-- Icon Customer Service -->
            <a href="/customer-service" style="color: #000;"><i class="fa-solid fa-headset"></i></a>
            
        </div>

    </nav>

    <!-- AREA KONTEN -->
    @yield('content')

</body>
</html>