<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pusat - Status Pesanan</title>
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
            
            <!-- Tempat menaruh kode logika notifikasi chat -->
            <li>
                @if(isset($unread_chat) && $unread_chat > 0)
                    <div class="red-dot"></div>
                @endif
                <a href="/admin-pusat/chat" class="active-cs active-black-line">CUSTOMER SERVICE</a>
            </li>
            <!-- ========================================== -->

            <li><a href="/admin-pusat/verifikasi">VERIFIKASI PESAN</a></li>
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
            <h1>STATUS</h1>
            <div class="header-actions">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <i class="fa-regular fa-envelope"></i>
                <span class="year-badge">2026</span>
            </div>
        </div>

        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- DAFTAR KARTU PESANAN DALAM PROSES -->
        @forelse($pesanans as $pesanan)
            <div class="admin-order-card">
                <img 
                    src="{{ asset('images/' . ($pesanan->produk->foto ?? 'default.png')) }}" 
                    alt="{{ $pesanan->produk->nama_produk ?? 'Produk DKV' }}" 
                    class="admin-order-img"
                >

                <div class="admin-order-info">
                    <h3>Informasi Pesanan #{{ $pesanan->id }}</h3>

                    <p>
                        NAMA PRODUK :
                        <strong>{{ $pesanan->produk->nama_produk ?? 'Produk DKV' }}</strong>
                    </p>

                    <p>
                        JUMLAH :
                        <strong>{{ $pesanan->jumlah }} Item</strong>
                    </p>

                    <p>
                        NO. TELEPON :
                        <strong>{{ $pesanan->no_telepon }}</strong>
                    </p>

                    <p>
                        STATUS SAAT INI :
                        <strong style="color: #007bff;">{{ strtoupper($pesanan->status) }}</strong>
                    </p>
                </div>

                <button 
                    class="btn-outline-blue-capsule btn-buka-modal" 
                    data-id="{{ $pesanan->id }}"
                    data-nama="{{ $pesanan->produk->nama_produk ?? 'Produk DKV' }}"
                    data-status="{{ $pesanan->status }}"
                    data-foto="{{ asset('images/' . ($pesanan->produk->foto ?? 'default.png')) }}"
                >
                    UBAH STATUS
                </button>
            </div>
        @empty
            <div style="text-align: center; padding: 40px; background: #fff; border-radius: 10px;">
                <p>Tidak ada pesanan yang sedang dalam proses.</p>
            </div>
        @endforelse

    </div> <!-- End Main Content -->

    <!-- OVERLAY MODAL UBAH STATUS -->
    <div class="modal-status-overlay" id="modalUbahStatus" style="display: none;">
        <div class="modal-status-card">
            
            <button class="btn-back" id="btnBackStatus"><i class="fa-solid fa-chevron-left"></i> BACK</button>

            <div class="modal-status-header">
                <img id="modalFotoProduk" src="" alt="Produk" class="modal-status-img">
                <div class="modal-status-title">
                    <h2 id="modalNamaProduk">Nama Produk</h2>
                    <div class="modal-status-profile">
                        <img src="{{ asset('images/foto_profil.png') }}" alt="Avatar"> TEFA DKV
                    </div>
                </div>
            </div>

            <!-- Form Perubahan Status -->
            <form id="formUbahStatus" method="POST" action="">
                @csrf
                <div style="margin-top: 20px; text-align: center;">
                    <p style="margin-bottom: 15px;">Klik tombol di bawah ini untuk memperbarui status ke tahap selanjutnya:</p>
                    <button type="submit" class="btn-solid-blue" style="padding: 12px 24px; font-weight: bold; border-radius: 20px;">
                        LANJUTKAN STATUS PESANAN
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- SCRIPT UNTUK MODAL DINAMIS -->
    <script>
        const modalStatus = document.getElementById('modalUbahStatus');
        const btnBukaModal = document.querySelectorAll('.btn-buka-modal');
        const btnBackStatus = document.getElementById('btnBackStatus');
        const formUbahStatus = document.getElementById('formUbahStatus');
        const modalNamaProduk = document.getElementById('modalNamaProduk');
        const modalFotoProduk = document.getElementById('modalFotoProduk');

        btnBukaModal.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const pesananId = this.getAttribute('data-id');
                const namaProduk = this.getAttribute('data-nama');
                const fotoProduk = this.getAttribute('data-foto');

                modalNamaProduk.textContent = namaProduk;
                modalFotoProduk.src = fotoProduk;
                formUbahStatus.action = `/admin-pusat/ubah-status/${pesananId}`;

                modalStatus.style.display = 'flex';
            });
        });

        if (btnBackStatus) {
            btnBackStatus.addEventListener('click', () => modalStatus.style.display = 'none');
        }

        window.addEventListener('click', function(e) {
            if (e.target === modalStatus) modalStatus.style.display = 'none';
        });
    </script>
</body>
</html>