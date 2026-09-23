<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Jurusan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="admin-body">

    <!-- SIDEBAR -->
    <div class="admin-sidebar">
        <!-- Pakai logo yang sudah kamu punya -->
        <a href="/">
            <img src="{{ asset('images/logo_tefa.png') }}" alt="Logo" class="admin-logo">
        </a>
        <ul class="admin-nav">
            <!-- Navigasi Dinamis Laravel -->
            <li>
                <a href="{{ route('admin-jurusan.dashboard') }}" class="{{ request()->routeIs('admin-jurusan.dashboard') ? 'active' : '' }}">ANALYTICS REPORTS</a>
            </li>
            <li>
                <a href="{{ route('admin-jurusan.produk.create') }}" class="{{ request()->routeIs('admin-jurusan.produk.create') ? 'active' : '' }}">PRODUCTS</a>
            </li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="admin-main">
        
        <!-- Top Profile -->
        <div class="admin-top-profile">
            <div class="profile-pill">
                <img src="{{ asset('images/icon_dkv1.png') }}" alt="Avatar">
                TEFA DKV
            </div>
        </div>

        <!-- Main Header -->
        <div class="admin-header-row">
            <h1>ANALYTICS REPORTS</h1>
            <div class="header-actions">
                <i class="fa-solid fa-cart-shopping"></i>
                <i class="fa-solid fa-magnifying-glass"></i>
                <i class="fa-regular fa-envelope"></i>
                <span class="year-badge">2026</span>
            </div>
        </div>

        <!-- GRID DASHBOARD -->
        <div class="dashboard-grid">
            
            <!-- KIRI: Satisfaction Rate (Vertical Bar) -->
            <div class="dash-card">
                <h3 class="card-title">Satisfaction rate</h3>
                
                <div class="chart-container-vertical">
                    <div class="v-bar bg-dark-red" style="height: 60%;">30</div>
                    <div class="v-bar bg-bright-red" style="height: 100%;">50</div>
                    <div class="v-bar bg-beige" style="height: 80%;">40</div>
                    <div class="v-bar bg-brown" style="height: 40%;">20</div>
                </div>
                
                <!-- Label Bawah -->
                <div class="labels-under">
                    <div class="label-box bg-beige">baner</div>
                    <div class="label-box bg-beige">ds</div>
                    <div class="label-box bg-beige">stokba</div>
                    <div class="label-box bg-brown">nametag</div>
                </div>

                <p class="chart-desc">Percentage of visitors from various channels who complete a desired action on a website.</p>
            </div>

            <!-- KANAN: Kombinasi Konten -->
            <div class="right-column">
                
                <!-- Kanan Atas: Sales Results -->
                <div class="dash-card" style="margin-bottom: 20px;">
                    <div class="sales-top-row">
                        <div>
                            <h3 class="card-title">Sales results</h3>
                            <div class="chart-container-horizontal">
                                @forelse ($topProduk as $index => $produk)
                                    @php
                                        $warna = ['bg-bright-red', 'bg-dark-red', 'bg-beige', 'bg-brown'][$index % 4];
                                        $lebar = ($produk->pesanans_count / $maxPesanan) * 100;
                                    @endphp
                                    <div class="h-bar {{ $warna }}" style="width: {{ $lebar }}%;">{{ $produk->nama_produk }}</div>
                                @empty
                                    <p style="font-size: 12px; color: #999;">Belum ada data pesanan.</p>
                                @endforelse
                            </div>
                            <div class="scale-x">
                                <span>0</span><span>100</span><span>200</span><span>300</span><span>400</span><span>500</span>
                            </div>
                        </div>
                        
                        <!-- Box Highest Value -->
                        <div class="highest-value-box">
                            <p>Highest Value</p>
                            <h3>{{ $topProduk->first()->nama_produk ?? '-' }}</h3>
                            <p class="desc">Produk ini paling banyak dipesan dibanding produk lain di jurusan ini.</p>
                        </div>
                    </div>
                </div>

                <!-- Kanan Bawah: Orders & Approved -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <h4>ORDERS</h4>
                        <div class="number">{{ $totalOrders }}</div>
                        <i class="fa-solid fa-clipboard-check icon-bg"></i>
                    </div>

                    <div class="stat-card">
                        <h4>APPROVED</h4>
                        <div class="number">{{ $totalApproved }}</div>
                        <i class="fa-regular fa-square-check icon-bg"></i>
                    </div>
                </div>

            </div> <!-- End Right Column -->

        </div> <!-- End Dashboard Grid -->

    </div> <!-- End Main Content -->

</body>
</html>