<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Pusat - Product Report</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="admin-body">

<!-- SIDEBAR -->
    <div class="admin-sidebar">
        <a href="/">
            <img src="{{ asset('images/logo_tefa.png') }}" alt="Logo" class="admin-logo">
        </a>
        <ul class="admin-nav">
            <!-- Menu Product Report -->
            <li>
                <a href="/admin-pusat/product-report" class="{{ request()->is('admin-pusat/product-report') ? 'active-cs active-black-line' : '' }}">PRODUCT REPORT</a>
            </li>
            
            <!-- Menu Customer Service -->
            <li>
                @if(isset($unread_chat) && $unread_chat > 0)
                    <div class="red-dot"></div>
                @endif
                <a href="/admin-pusat/chat" class="{{ request()->is('admin-pusat/chat') ? 'active-cs active-black-line' : '' }}">CUSTOMER SERVICE</a>
            </li>

            <!-- Menu Verifikasi Pesan -->
            <li>
                <a href="/admin-pusat/verifikasi" class="{{ request()->is('admin-pusat/verifikasi') ? 'active-cs active-black-line' : '' }}">VERIFIKASI PESAN</a>
            </li>
            
            <!-- Menu Status -->
            <li>
                <a href="/admin-pusat/status-pesanan" class="{{ request()->is('admin-pusat/status-pesanan') ? 'active-cs active-black-line' : '' }}">STATUS</a>
            </li>
            
            <!-- Menu Done -->
            <li>
                <a href="/admin-pusat/done" class="{{ request()->is('admin-pusat/done') ? 'active-cs active-black-line' : '' }}">DONE</a>
            </li>
        </ul>
    </div>


    <!-- MAIN CONTENT -->
    <div class="admin-main">

        <!-- TOP PROFILE -->
        <div class="admin-top-profile">

            <div class="profile-pill">

                <img src="{{ asset('images/foto_profil.png') }}"
                     alt="Avatar">

                Customer Service

            </div>

        </div>


        <!-- MAIN HEADER -->
        <div class="admin-header-row">

            <h1>PRODUCT REPORT</h1>

            <div class="header-actions">

                <i class="fa-solid fa-clock-rotate-left"></i>

                <i class="fa-regular fa-envelope"></i>

                <span class="year-badge">
                    2026
                </span>

            </div>

        </div>


        <!-- KOTAK PUTIH UNTUK DAFTAR PRODUK -->
        <div class="admin-white-box">

            <!-- FORM FILTER KATEGORI / JURUSAN -->
            <form method="GET" action="{{ route('admin.product-report') }}" style="margin-bottom: 20px; display: flex; gap: 10px; align-items: center;">
                <select name="kategori" class="form-control" style="padding: 8px 12px; border-radius: 6px; border: 1px solid #ccc;" onchange="this.form.submit()">
                    <option value="all">Semua Jurusan / Kategori</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori ?? $kat->nama ?? 'Kategori ' . $kat->id }}
                        </option>
                    @endforeach
                </select>
                @if(request('kategori') && request('kategori') !== 'all')
                    <a href="{{ route('admin.product-report') }}" class="btn-reset" style="padding: 8px 12px; background: #e2e8f0; color: #333; text-decoration: none; border-radius: 6px; font-size: 14px;">Reset Filter</a>
                @endif
            </form>

            <div class="product-grid">

                @forelse ($produks as $produk)

                    <!-- PRODUCT CARD -->
                    <div class="product-card">

                        <!-- GAMBAR PRODUK -->
                        <div class="product-img-wrapper">

                            @if ($produk->foto)

                                <img src="{{ asset('storage/' . $produk->foto) }}"
                                     alt="{{ $produk->nama_produk }}">

                            @else

                                <img src="{{ asset('images/produk_dkv2.png') }}"
                                     alt="{{ $produk->nama_produk }}">

                            @endif


                            <!-- BUTTON CHECK -->
                            <a href="/pemesanan/{{ $produk->id }}"
                               class="btn-update">
                                CHECK
                            </a>

                        </div>


                        <!-- INFORMASI PRODUK -->
                        <div class="product-info">

                            <h3>
                                {{ $produk->nama_produk }}
                            </h3>


                            <p class="price">

                                RP
                                {{ number_format($produk->harga, 0, ',', '.') }}

                            </p>


                            <div class="rating">

                                <i class="fa-solid fa-star"></i>

                                <span>
                                    {{ $produk->kategori->nama_kategori ?? 'Product Report' }}
                                </span>

                            </div>

                        </div>

                    </div>

                @empty

                    <!-- JIKA BELUM ADA PRODUK -->
                    <div style="width: 100%; text-align: center; padding: 40px;">

                        <h3>
                            Belum ada produk.
                        </h3>

                        <p>
                            Data produk belum tersedia di database atau untuk kategori ini.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>
    </div>

</body>
</html>