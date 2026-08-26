<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog TEFA</title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS Utama -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- NAVBAR ATAS -->
    <nav class="navbar">
        <div class="nav-brand">
            <img src="{{ asset('images/logo_tefa.png') }}" alt="Logo TEFA">
        </div>
        
        <ul class="nav-menu">
            <!-- Request::is() digunakan agar garis biru berpindah otomatis sesuai halaman -->
            <li><a href="/" class="{{ Request::is('/') ? 'active' : '' }}">HOME</a></li>
            <li><a href="/katalog" class="{{ Request::is('katalog') ? 'active' : '' }}">KATALOG</a></li>
            <li><a href="/status" class="">STATUS</a></li>
        </ul>

        <!-- KOLOM PENCARIAN & DROPDOWN -->
        <div class="nav-search" id="navSearchContainer">
            <i class="fa-solid fa-magnifying-glass" style="font-size: 14px;"></i>
            <input type="text" placeholder="Cari produk atau jurusan..." id="searchInput" autocomplete="off">
            
            <!-- Kotak Dropdown Pilihan Jurusan -->
            <!-- Kotak Dropdown Pilihan Jurusan -->
            <div class="search-dropdown" id="searchDropdown">
                <ul>
                    <!-- Tambahkan class "pilih-jurusan" dan atribut "data-banner" -->
                    <li><a href="#" class="pilih-jurusan" data-banner="0"><i class="fa-solid fa-clock-rotate-left"></i> Rekayasa Perangkat Lunak (RPL)</a></li>
                    <li><a href="#" class="pilih-jurusan" data-banner="2"><i class="fa-solid fa-clock-rotate-left"></i> Teknik Komputer Jaringan (TKJ)</a></li>
                    <li><a href="#" class="pilih-jurusan" data-banner="4"><i class="fa-solid fa-clock-rotate-left"></i> Desain Komunikasi Visual (DKV)</a></li>
                    <li><a href="#" class="pilih-jurusan" data-banner="1"><i class="fa-solid fa-clock-rotate-left"></i> Animasi</a></li>
                    <li><a href="#" class="pilih-jurusan" data-banner="3"><i class="fa-solid fa-clock-rotate-left"></i> Broadcasting (PSPT)</a></li>
                    <li><a href="#" class="pilih-jurusan" data-banner="5"><i class="fa-solid fa-clock-rotate-left"></i> Pengembangan Gim</a></li>
                </ul>
            </div>
        </div>

        <div class="nav-icons">
            <a href="/keranjang" style="color: inherit; text-decoration: none;">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
            <a href="/register" style="color: inherit; text-decoration: none;">
                <i class="fa-regular fa-user"></i>
            </a>
            <a href="#" style="color: inherit; text-decoration: none;">
                <i class="fa-solid fa-headset"></i>
            </a>
        </div>
    </nav>

    <!-- KONTEN DINAMIS -->
    <main>
        @yield('content')
    </main>

    <!-- Script untuk Navbar Search Dropdown -->
<!-- Script untuk Navbar Search Dropdown -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const searchDropdown = document.getElementById('searchDropdown');

        searchInput.addEventListener('focus', function() {
            searchDropdown.classList.add('show');
        });

        document.addEventListener('click', function(event) {
            const isClickInside = document.getElementById('navSearchContainer').contains(event.target);
            if (!isClickInside) {
                searchDropdown.classList.remove('show');
            }
        });

        // ================= KODE BARU UNTUK KLIK JURUSAN =================
        document.querySelectorAll('.pilih-jurusan').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Mencegah halaman refresh
                
                let bannerIndex = this.getAttribute('data-banner');
                
                // Cek apakah kita sedang berada di halaman Katalog (punya fungsi goToBanner)
                if (typeof window.goToBanner === 'function') {
                    window.goToBanner(bannerIndex); // Geser banner
                    searchDropdown.classList.remove('show'); // Tutup dropdown
                } else {
                    // Jika di halaman Home, pindah ke Katalog dan bawa nomor bannernya via URL
                    window.location.href = '/katalog?banner=' + bannerIndex;
                }
            });
        });
    </script>
</body>
</html>