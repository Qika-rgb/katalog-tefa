<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog TEFA - SMKN 4 Tanjungpinang</title>

    <!-- FONT & ICON -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS UTAMA -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        
        <!-- 1. LOGO -->
        <div class="nav-brand">
            <a href="/">
                <img src="{{ asset('images/logo_tefa.png') }}" alt="Logo TEFA">
            </a>
        </div>

        <!-- 2. MENU UTAMA -->
        <ul class="nav-menu">
            <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">{{ __('messages.nav_home') }}</a></li>

            <!-- MENU KATALOG DENGAN DROPDOWN -->
            <li class="nav-dropdown">
                <a href="/katalog?kategori=all" class="nav-dropdown-toggle {{ request()->is('katalog*') ? 'active' : '' }}">
                    {{ __('messages.nav_katalog') }} <i class="fa-solid fa-chevron-down"></i>
                </a>
                <ul class="nav-dropdown-menu">
                    <li><a href="/katalog?kategori=all">{{ __('messages.all_majors') }}</a></li>
                    <li><a href="/katalog?kategori=0">{{ __('messages.rpl') }} (RPL)</a></li>
                    <li><a href="/katalog?kategori=1">{{ __('messages.animasi') }}</a></li>
                    <li><a href="/katalog?kategori=2">{{ __('messages.tkj') }} (TKJ)</a></li>
                    <li><a href="/katalog?kategori=3">{{ __('messages.pspt') }} (PSPT)</a></li>
                    <li><a href="/katalog?kategori=4">{{ __('messages.dkv') }} (DKV)</a></li>
                    <li><a href="/katalog?kategori=5">{{ __('messages.gim') }}</a></li>
                </ul>
            </li>

            <li><a href="/status" class="{{ request()->is('status*') ? 'active' : '' }}">{{ __('messages.nav_status') }}</a></li>
            <li><a href="/portofolio" class="{{ request()->is('portofolio*') ? 'active' : '' }}">{{ __('messages.nav_portofolio') }}</a></li>
        </ul>

        <!-- 3. ICON, MULTI-LANGUAGE & AUTH -->
        <div class="nav-icons" style="align-items: center; display: flex; gap: 16px;">
            <!-- Language Switcher Pill -->
            <div class="lang-switcher">
                <a href="{{ route('lang.switch', 'id') }}" class="lang-btn {{ app()->getLocale() == 'id' ? 'active' : '' }}" title="Bahasa Indonesia">ID</a>
                <span class="lang-divider">|</span>
                <a href="{{ route('lang.switch', 'en') }}" class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}" title="English">EN</a>
            </div>

            <a href="/keranjang" style="color: #000;" title="{{ __('messages.cart') }}"><i class="fa-solid fa-cart-shopping"></i></a>
            
            @guest
                <a href="{{ route('login') }}" style="color: #000;" title="{{ __('messages.login_register') }}"><i class="fa-regular fa-circle-user"></i></a>
            @else
                <a href="{{ url('/dashboard') }}" style="color: #000;" title="{{ __('messages.dashboard') }}"><i class="fa-regular fa-circle-user"></i></a>
                
                <form method="POST" action="{{ route('logout') }}" style="margin: 0; display: flex; align-items: center;">
                    @csrf
                    <button type="submit" style="background: transparent; border: none; padding: 0; color: #dc2626; font-size: 20px; cursor: pointer;" title="{{ __('messages.logout') }}">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            @endguest

            <a href="/customer-service" style="color: #000;" title="{{ __('messages.customer_service') }}"><i class="fa-solid fa-headset"></i></a>
        </div>

    </nav>

    <!-- AREA KONTEN -->
    <main>
        @yield('content')
    </main>

    @include('components.footer')

</body>
</html>