<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pusat - Verifikasi Pesanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="admin-body">

    <!-- SIDEBAR -->
    <div class="admin-sidebar">
        <a href="/">
            <img src="{{ asset('images/logo_tefa.png') }}" alt="Logo" class="admin-logo">
        </a>
        <ul class="admin-nav">
            <li><a href="/admin-pusat/product-report">PRODUCT REPORT</a></li>
            <li>
                <div class="red-dot"></div>
                <a href="/admin-pusat/chat" class="active-cs">CUSTOMER SERVICE</a>
            </li>
            <li><a href="/admin-pusat/verifikasi" class="active-black-line">VERIFIKASI PESAN</a></li>
            <li><a href="/admin-pusat/status-pesanan">STATUS</a></li>
            <li><a href="/admin-pusat/done">DONE</a></li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="admin-main">
        
        <!-- Top Profile -->
        <div class="admin-top-profile">
            <div class="profile-pill">
                <img src="{{ asset('images/foto_profil.png') }}" alt="Avatar">
                Customer Service
            </div>
        </div>

        <!-- Main Header -->
        <div class="admin-header-row">
            <h1>VERIFIKASI PESANAN</h1>
            <div class="header-actions">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <i class="fa-regular fa-envelope"></i>
                <span class="year-badge">2026</span>
            </div>
        </div>

        <!-- ALERT NOTIFIKASI SUCCESS/ERROR -->
        @if(session('success'))
            <div style="padding: 10px 15px; background-color: #d4edda; color: #155724; border-radius: 8px; margin-bottom: 20px; font-weight: 600;">
                {{ session('success') }}
            </div>
        @endif

        <!-- DAFTAR KARTU PESANAN DARI DATABASE -->
        @forelse ($pesanans as $pesanan)
            @php
                $produk = $pesanan->produk;
                
                // Menentukan path gambar yang valid (Public Images -> Storage -> Default)
                $fotoPath = asset('images/logo_tefa.png'); // Fallback default
                if ($produk && $produk->foto) {
                    if (file_exists(public_path('images/' . $produk->foto))) {
                        $fotoPath = asset('images/' . $produk->foto);
                    } elseif (file_exists(public_path('storage/' . $produk->foto))) {
                        $fotoPath = asset('storage/' . $produk->foto);
                    }
                }
            @endphp

            <div class="admin-order-card">

                <img src="{{ $fotoPath }}" alt="{{ $produk->nama_produk ?? 'Produk DKV' }}" class="admin-order-img">

                <div class="admin-order-info">
                    <h3>Informasi pemesanan & layanan</h3>

                    <p>
                        ID PESANAN :
                        <strong>#{{ $pesanan->id }}</strong>
                    </p>

                    <p>
                        NAMA PEMESAN / TELEPON :
                        <strong>{{ $pesanan->no_telepon ?? 'Customer' }}</strong>
                    </p>

                    <p>
                        JENIS LAYANAN / PAKET :
                        <strong>{{ $produk->nama_produk ?? 'Produk tidak ditemukan' }}</strong>
                    </p>

                    <p>
                        JUMLAH :
                        <strong>{{ $pesanan->jumlah }}</strong>
                    </p>

                    <p>
                        STATUS SAAT INI :
                        <span class="status-text" style="color: #ff9900; font-weight: 700;">
                            {{ strtoupper($pesanan->status) }}
                        </span>
                    </p>
                </div>

                <div class="admin-order-actions">
                    <!-- FORM ACCEPT (STEP 3) -->
                    <form action="{{ route('admin.accept', $pesanan->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="btn-accept">ACCEPT</button>
                    </form>

                    <!-- FORM DECLINE (STEP 4) -->
                    <form action="{{ route('admin.decline', $pesanan->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="btn-decline">DECLINE</button>
                    </form>
                </div>

            </div>
        @empty
            <div class="admin-order-card" style="text-align: center; padding: 40px;">
                <div class="admin-order-info" style="width: 100%;">
                    <h3>Belum ada pesanan baru</h3>
                    <p style="color: #666; margin-top: 5px;">Semua pesanan yang membutuhkan verifikasi telah diproses.</p>
                </div>
            </div>
        @endforelse

        <!-- ========================================= -->
        <!-- RIWAYAT PESANAN SELESAI (No. 5)            -->
        <!-- ========================================= -->
        <div class="admin-header-row" style="margin-top: 40px;">
            <h1>RIWAYAT PESANAN SELESAI</h1>
        </div>

        @forelse ($riwayatSelesai as $pesanan)
            @php
                $produk = $pesanan->produk;

                $fotoPath = asset('images/logo_tefa.png');
                if ($produk && $produk->foto) {
                    if (file_exists(public_path('images/' . $produk->foto))) {
                        $fotoPath = asset('images/' . $produk->foto);
                    } elseif (file_exists(public_path('storage/' . $produk->foto))) {
                        $fotoPath = asset('storage/' . $produk->foto);
                    }
                }
            @endphp

            <div class="admin-order-card">

                <img src="{{ $fotoPath }}" alt="{{ $produk->nama_produk ?? 'Produk DKV' }}" class="admin-order-img">

                <div class="admin-order-info">
                    <h3>Informasi pemesanan & layanan</h3>

                    <p>
                        ID PESANAN :
                        <strong>#{{ $pesanan->id }}</strong>
                    </p>

                    <p>
                        NAMA PEMESAN / TELEPON :
                        <strong>{{ $pesanan->no_telepon ?? 'Customer' }}</strong>
                    </p>

                    <p>
                        JENIS LAYANAN / PAKET :
                        <strong>{{ $produk->nama_produk ?? 'Produk tidak ditemukan' }}</strong>
                    </p>

                    <p>
                        JUMLAH :
                        <strong>{{ $pesanan->jumlah }}</strong>
                    </p>

                    <p>
                        STATUS :
                        <span class="status-text" style="color: #28a745; font-weight: 700;">
                            {{ strtoupper($pesanan->status) }}
                        </span>
                    </p>
                </div>

            </div>
        @empty
            <div class="admin-order-card" style="text-align: center; padding: 40px;">
                <div class="admin-order-info" style="width: 100%;">
                    <h3>Belum ada riwayat pesanan selesai</h3>
                </div>
            </div>
        @endforelse

    </div> <!-- End Main Content -->

</body>
</html>