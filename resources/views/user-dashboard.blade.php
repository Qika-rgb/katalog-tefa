@extends('layouts.frontend')

@section('content')
<div class="user-dashboard-container">

    <!-- WELCOME PROFILE BANNER -->
    <div class="user-profile-banner">
        <div class="user-profile-info">
            <div class="user-avatar-circle">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="user-profile-details">
                <div class="user-badges-row">
                    <span class="user-role-badge">CUSTOMER</span>
                    <span class="user-joined-text">
                        <i class="fa-regular fa-calendar-days"></i> Bergabung {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                    </span>
                </div>
                <h2>Selamat Datang, {{ $user->name }}!</h2>
                <p><i class="fa-regular fa-envelope"></i> {{ $user->email }}</p>
            </div>
        </div>

        <div class="user-profile-actions">
            <a href="{{ route('profile.edit') }}" class="btn-dash-outline">
                <i class="fa-solid fa-user-pen"></i> Pengaturan Akun
            </a>
            <a href="{{ route('chat.customer') }}" class="btn-dash-primary">
                <i class="fa-solid fa-headset"></i> Bantuan CS
            </a>
        </div>
    </div>

    <!-- STATS CARDS -->
    <div class="user-stats-grid">
        <!-- 1. Total Pesanan -->
        <div class="user-stat-card border-blue-accent">
            <div class="stat-icon-wrapper bg-blue-subtle">
                <i class="fa-solid fa-boxes-stacked text-blue-accent"></i>
            </div>
            <div class="stat-content">
                <span class="stat-label">Total Pesanan</span>
                <h3 class="stat-value">{{ $totalPesanan }}</h3>
                <span class="stat-hint">Seluruh transaksi Anda</span>
            </div>
        </div>

        <!-- 2. Pesanan Diproses -->
        <div class="user-stat-card border-blue-accent">
            <div class="stat-icon-wrapper bg-blue-subtle">
                <i class="fa-solid fa-arrows-rotate text-blue-accent"></i>
            </div>
            <div class="stat-content">
                <span class="stat-label">Sedang Diproses</span>
                <h3 class="stat-value">{{ $pesananDiproses }}</h3>
                <span class="stat-hint">Pending / Produksi / Kemas</span>
            </div>
        </div>

        <!-- 3. Pesanan Selesai -->
        <div class="user-stat-card border-blue-accent">
            <div class="stat-icon-wrapper bg-blue-subtle">
                <i class="fa-solid fa-circle-check text-blue-accent"></i>
            </div>
            <div class="stat-content">
                <span class="stat-label">Siap / Selesai</span>
                <h3 class="stat-value">{{ $pesananSelesai }}</h3>
                <span class="stat-hint">Siap diambil atau selesai</span>
            </div>
        </div>

        <!-- 4. Item di Keranjang -->
        <div class="user-stat-card border-blue-accent">
            <div class="stat-icon-wrapper bg-blue-subtle">
                <i class="fa-solid fa-cart-shopping text-blue-accent"></i>
            </div>
            <div class="stat-content">
                <span class="stat-label">Item di Keranjang</span>
                <h3 class="stat-value">{{ $totalKeranjang }}</h3>
                <span class="stat-hint">Menunggu untuk di-checkout</span>
            </div>
        </div>
    </div>

    <!-- QUICK ACTIONS -->
    <div class="user-quick-section">
        <h3 class="dash-section-title"><i class="fa-solid fa-compass"></i> Menu Cepat</h3>
        <div class="user-quick-grid">
            <a href="/katalog" class="quick-nav-card">
                <div class="quick-icon"><i class="fa-solid fa-store"></i></div>
                <div class="quick-info">
                    <h4>Jelajahi Katalog</h4>
                    <p>Temukan produk & jasa TEFA SMKN 4</p>
                </div>
                <i class="fa-solid fa-arrow-right quick-arrow"></i>
            </a>

            <a href="/keranjang" class="quick-nav-card">
                <div class="quick-icon"><i class="fa-solid fa-basket-shopping"></i></div>
                <div class="quick-info">
                    <h4>Keranjang Belanja</h4>
                    <p>Kelola item sebelum checkout ({{ $totalKeranjang }} item)</p>
                </div>
                <i class="fa-solid fa-arrow-right quick-arrow"></i>
            </a>

            <a href="/status" class="quick-nav-card">
                <div class="quick-icon"><i class="fa-solid fa-truck-fast"></i></div>
                <div class="quick-info">
                    <h4>Status Pesanan</h4>
                    <p>Pantau proses pesanan Anda secara berkala</p>
                </div>
                <i class="fa-solid fa-arrow-right quick-arrow"></i>
            </a>

            <a href="/portofolio" class="quick-nav-card">
                <div class="quick-icon"><i class="fa-solid fa-briefcase"></i></div>
                <div class="quick-info">
                    <h4>Portofolio Siswa</h4>
                    <p>Karya dan pencapaian jurusan TEFA</p>
                </div>
                <i class="fa-solid fa-arrow-right quick-arrow"></i>
            </a>
        </div>
    </div>

    <!-- RECENT ORDERS SECTION -->
    <div class="user-recent-section">
        <div class="recent-header">
            <h3 class="dash-section-title"><i class="fa-solid fa-clock-rotate-left"></i> Pesanan Terbaru</h3>
            <a href="/status" class="view-all-link">Lihat Semua di Status <i class="fa-solid fa-chevron-right"></i></a>
        </div>

        <div class="recent-orders-list">
            @forelse ($recentOrders as $pesanan)
                @php
                    // Ambil item produk utama baik dari detail pesanan atau relasi produk langsung
                    if ($pesanan->detailPesanans && $pesanan->detailPesanans->count() > 0) {
                        $firstDetail = $pesanan->detailPesanans->first();
                        $produk = $firstDetail->produk;
                        $extraCount = $pesanan->detailPesanans->count() - 1;
                    } else {
                        $produk = $pesanan->produk;
                        $extraCount = 0;
                    }

                    $foto = $produk->foto ?? 'default.png';
                    $imgSrc = file_exists(public_path('images/' . $foto)) 
                        ? asset('images/' . $foto) 
                        : (file_exists(public_path('storage/' . $foto)) ? asset('storage/' . $foto) : asset('images/logo_tefa.png'));

                    // Status style badge
                    $status = $pesanan->status;
                    $badgeClass = match(strtolower($status)) {
                        'pending' => 'badge-pending',
                        'tahap pembuatan', 'pembuatan' => 'badge-process',
                        'pengemasan' => 'badge-packaging',
                        'siap diambil' => 'badge-ready',
                        'sudah diambil' => 'badge-completed',
                        'ditolak' => 'badge-rejected',
                        default => 'badge-default',
                    };
                @endphp

                <div class="user-order-item">
                    <div class="order-item-left">
                        <img src="{{ $imgSrc }}" alt="{{ $produk->nama_produk ?? 'Produk' }}" class="order-item-img">
                        <div class="order-item-info">
                            <h4>
                                {{ $produk->nama_produk ?? 'Produk TEFA' }}
                                @if ($extraCount > 0)
                                    <span class="extra-item-tag">+{{ $extraCount }} produk lainnya</span>
                                @endif
                            </h4>
                            <p class="order-jurusan-text">
                                TEFA {{ strtoupper($produk->kategori->nama_kategori ?? 'UMUM') }}
                            </p>
                            <span class="order-date-text">
                                <i class="fa-regular fa-calendar"></i> {{ $pesanan->created_at ? $pesanan->created_at->format('d M Y, H:i') : '-' }} WIB
                            </span>
                        </div>
                    </div>

                    <div class="order-item-middle">
                        <span class="order-price-label">Total Pembayaran</span>
                        <span class="order-price-val">RP {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</span>
                        <span class="order-qty-info">Jumlah: {{ $pesanan->jumlah ?? 1 }} barang</span>
                    </div>

                    <div class="order-item-right">
                        <span class="status-pill {{ $badgeClass }}">
                            <i class="fa-solid fa-circle-dot"></i> {{ strtoupper($status) }}
                        </span>
                        <a href="/status/detail?pesanan_id={{ $pesanan->id }}" class="btn-order-detail">
                            Lihat Detail
                        </a>
                    </div>
                </div>

            @empty
                <div class="user-empty-orders">
                    <div class="empty-icon-box">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <h4>Belum Ada Pesanan</h4>
                    <p>Anda belum pernah melakukan pemesanan produk atau jasa TEFA.</p>
                    <a href="/katalog" class="btn-empty-shop">
                        <i class="fa-solid fa-cart-plus"></i> Jelajahi Katalog Sekarang
                    </a>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection

