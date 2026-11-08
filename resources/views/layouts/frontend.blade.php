<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#2563eb">
    <meta name="description" content="Katalog Teaching Factory (TEFA) SMKN 4 Tanjungpinang. Menghadirkan karya, produk kreatif, dan jasa profesional berstandar industri hasil karya siswa-siswi kejuruan.">

    <!-- Open Graph / Social Media Preview -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Katalog TEFA - SMKN 4 Tanjungpinang')">
    <meta property="og:description" content="Katalog Teaching Factory (TEFA) SMKN 4 Tanjungpinang. Menghadirkan produk dan jasa profesional karya siswa-siswi kejuruan.">
    <meta property="og:image" content="{{ asset('images/logo_tefa.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo_tefa.png') }}">

    <title>@yield('title', 'Katalog TEFA - SMKN 4 Tanjungpinang')</title>

    <!-- FONT PRECONNECT & DISPLAY SWAP (Optimal Core Web Vitals) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS UTAMA -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- NAVBAR WRAPPER & HEADER -->
    <header class="navbar-wrapper">
        <nav class="navbar" aria-label="Main Navigation">
            
            <!-- 1. KIRI: TOMBOL HAMBURGER (MOBILE) + LOGO -->
            <div class="nav-left">
                <!-- Tombol Hamburger (Persis Foto 1) -->
                <button type="button" class="mobile-menu-btn" id="mobileMenuToggle" aria-label="Menu Navigasi" aria-expanded="false" aria-controls="mobileNavDropdown">
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                </button>

                <!-- Logo TEFA -->
                <div class="nav-brand">
                    <a href="/" aria-label="Beranda Katalog TEFA">
                        <img src="{{ asset('images/logo_tefa.png') }}" alt="Logo TEFA SMKN 4 Tanjungpinang" class="site-logo" width="130" height="42">
                    </a>
                </div>
            </div>

            <!-- 2. TENGAH: DESKTOP MENU (Lingkaran Hijau di PC, disembunyikan di HP) -->
            <ul class="nav-menu" id="desktopNavMenu">
                <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">{{ __('messages.nav_home') }}</a></li>

                <!-- MENU KATALOG DENGAN DROPDOWN -->
                <li class="nav-dropdown">
                    <a href="/katalog?kategori=all" class="nav-dropdown-toggle {{ request()->is('katalog*') ? 'active' : '' }}" aria-expanded="false">
                        {{ __('messages.nav_katalog') }} <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
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

            <!-- 3. KANAN: ACTIONS (ID|EN dan Keranjang di HP, Semua Ikon di Desktop) -->
            <div class="nav-icons">
                <!-- Language Switcher Pill -->
                <div class="lang-switcher" aria-label="Language Selector">
                    <a href="{{ route('lang.switch', 'id') }}" class="lang-btn {{ app()->getLocale() == 'id' ? 'active' : '' }}" title="Bahasa Indonesia">ID</a>
                    <span class="lang-divider">|</span>
                    <a href="{{ route('lang.switch', 'en') }}" class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}" title="English">EN</a>
                </div>

                <!-- Keranjang Belanja -->
                <a href="/keranjang" class="icon-touch-btn" title="{{ __('messages.cart') }}" aria-label="{{ __('messages.cart') }}">
                    <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
                </a>
                
                <!-- Ikon Khusus Desktop (Di layar HP dimasukkan rapi ke dalam dropdown menu) -->
                <div class="desktop-only-icons">
                    @guest
                        <a href="{{ route('login') }}" class="icon-touch-btn" title="{{ __('messages.login_register') }}" aria-label="{{ __('messages.login_register') }}">
                            <i class="fa-regular fa-circle-user" aria-hidden="true"></i>
                        </a>
                    @else
                        <a href="{{ url('/dashboard') }}" class="icon-touch-btn" title="{{ __('messages.dashboard') }}" aria-label="{{ __('messages.dashboard') }}">
                            <i class="fa-regular fa-circle-user" aria-hidden="true"></i>
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0; display: inline-flex;">
                            @csrf
                            <button type="submit" class="icon-touch-btn" style="background: transparent; border: none; padding: 0; color: #dc2626; cursor: pointer;" title="{{ __('messages.logout') }}" aria-label="{{ __('messages.logout') }}">
                                <i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i>
                            </button>
                        </form>
                    @endguest

                    <a href="/customer-service" class="icon-touch-btn" title="{{ __('messages.customer_service') }}" aria-label="{{ __('messages.customer_service') }}">
                        <i class="fa-solid fa-headset" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

        </nav>

        <!-- DROPDOWN MENU MOBILE (PERSIS SEPERTI FOTO PERTAMA DENGAN LINGKARAN MERAH) -->
        <div class="mobile-dropdown-menu" id="mobileNavDropdown" aria-hidden="true">
            <ul class="mobile-menu-list">
                <li>
                    <a href="/" class="mobile-menu-link {{ request()->is('/') ? 'active' : '' }}">
                        <span><i class="fa-solid fa-house"></i> {{ __('messages.nav_home') }}</span>
                    </a>
                </li>
                
                <!-- Menu Katalog dengan Sub-menu Accordion Dropdown -->
                <li class="mobile-menu-dropdown">
                    <button type="button" class="mobile-dropdown-toggle" id="mobileKatalogToggle" aria-expanded="false">
                        <span><i class="fa-solid fa-boxes-stacked"></i> {{ __('messages.nav_katalog') }}</span>
                        <i class="fa-solid fa-chevron-down mobile-dropdown-arrow" aria-hidden="true"></i>
                    </button>
                    <ul class="mobile-sub-menu" id="mobileKatalogSubMenu">
                        <li><a href="/katalog?kategori=all">{{ __('messages.all_majors') }}</a></li>
                        <li><a href="/katalog?kategori=0">{{ __('messages.rpl') }} (RPL)</a></li>
                        <li><a href="/katalog?kategori=1">{{ __('messages.animasi') }}</a></li>
                        <li><a href="/katalog?kategori=2">{{ __('messages.tkj') }} (TKJ)</a></li>
                        <li><a href="/katalog?kategori=3">{{ __('messages.pspt') }} (PSPT)</a></li>
                        <li><a href="/katalog?kategori=4">{{ __('messages.dkv') }} (DKV)</a></li>
                        <li><a href="/katalog?kategori=5">{{ __('messages.gim') }}</a></li>
                    </ul>
                </li>

                <li>
                    <a href="/status" class="mobile-menu-link {{ request()->is('status*') ? 'active' : '' }}">
                        <span><i class="fa-solid fa-list-check"></i> {{ __('messages.nav_status') }}</span>
                    </a>
                </li>

                <li>
                    <a href="/portofolio" class="mobile-menu-link {{ request()->is('portofolio*') ? 'active' : '' }}">
                        <span><i class="fa-solid fa-briefcase"></i> {{ __('messages.nav_portofolio') }}</span>
                    </a>
                </li>

                <li>
                    <a href="/customer-service" class="mobile-menu-link {{ request()->is('customer-service*') ? 'active' : '' }}">
                        <span><i class="fa-solid fa-headset"></i> {{ __('messages.customer_service') }}</span>
                    </a>
                </li>

                <li class="mobile-menu-divider"></li>

                @guest
                    <li>
                        <a href="{{ route('login') }}" class="mobile-menu-link mobile-login-link">
                            <span><i class="fa-regular fa-circle-user"></i> {{ __('messages.login_register') }}</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ url('/dashboard') }}" class="mobile-menu-link">
                            <span><i class="fa-solid fa-gauge"></i> {{ __('messages.dashboard') }}</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0; width: 100%;">
                            @csrf
                            <button type="submit" class="mobile-menu-link mobile-logout-link" style="width: 100%; border: none; background: transparent; text-align: left; cursor: pointer;">
                                <span><i class="fa-solid fa-right-from-bracket"></i> {{ __('messages.logout') }}</span>
                            </button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>

        <!-- Backdrop saat menu terbuka -->
        <div class="mobile-menu-backdrop" id="mobileMenuBackdrop"></div>
    </header>

    <!-- AREA KONTEN -->
    <main>
        @yield('content')
    </main>

    @include('components.footer')

    <!-- JS Mobile Dropdown Toggle (Persis Foto 1) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('mobileMenuToggle');
            const dropdown = document.getElementById('mobileNavDropdown');
            const backdrop = document.getElementById('mobileMenuBackdrop');
            const katalogToggle = document.getElementById('mobileKatalogToggle');
            const katalogSubMenu = document.getElementById('mobileKatalogSubMenu');

            function toggleMenu(forceClose = false) {
                if (!dropdown || !toggleBtn) return;
                const isOpen = forceClose ? false : !dropdown.classList.contains('open');

                dropdown.classList.toggle('open', isOpen);
                toggleBtn.classList.toggle('active', isOpen);
                if (backdrop) backdrop.classList.toggle('open', isOpen);
                toggleBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                dropdown.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    toggleMenu();
                });
            }

            if (backdrop) {
                backdrop.addEventListener('click', function () {
                    toggleMenu(true);
                });
            }

            // Tutup jika tekan tombol Escape
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && dropdown && dropdown.classList.contains('open')) {
                    toggleMenu(true);
                }
            });

            // Accordion Dropdown Katalog di Mobile
            if (katalogToggle && katalogSubMenu) {
                katalogToggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const isExpanded = katalogSubMenu.classList.toggle('open');
                    katalogToggle.classList.toggle('open', isExpanded);
                    katalogToggle.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
                });
            }
        });
    </script>

</body>
</html>
