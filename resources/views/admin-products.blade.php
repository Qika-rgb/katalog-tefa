<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Jurusan - Products</title>
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
                <img src="{{ asset('images/icon_dkv1.png') }}" alt="Avatar">
                TEFA DKV
            </div>
        </div>

        <!-- Main Header -->
        <div class="admin-header-row">
            <h1>PRODUCTS</h1>
            <div class="header-actions">
                <i class="fa-solid fa-magnifying-glass"></i>
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

        @if($errors->any())
            <div style="padding: 10px 15px; background-color: #f8d7da; color: #721c24; border-radius: 8px; margin-bottom: 20px; font-weight: 600;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- KOTAK PUTIH UNTUK DAFTAR PRODUK -->
        <div class="admin-white-box">

            <div class="product-grid">

                <!-- KARTU 1 -->
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <img src="{{ asset('images/produk_dkv2.png') }}" alt="Graphic Design">
                        <a href="#" class="btn-update">UPDATE NOW</a>
                    </div>
                    <div class="product-info">
                        <h3>Design creation services...</h3>
                        <p class="price">RP 2.000.000</p>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <span>5.0 + 5Rb terjual</span>
                        </div>
                    </div>
                </div>

                <!-- KARTU 2 -->
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <img src="{{ asset('images/produk_dkv3.png') }}" alt="Web Services">
                        <a href="#" class="btn-update">UPDATE NOW</a>
                    </div>
                    <div class="product-info">
                        <h3>web services</h3>
                        <p class="price">RP 1.500.000</p>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <span>5.0 + 5Rb terjual</span>
                        </div>
                    </div>
                </div>

                <!-- KARTU 3 -->
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <img src="{{ asset('images/produk_dkv2.png') }}" alt="Podcast">
                        <a href="#" class="btn-update">UPDATE NOW</a>
                    </div>
                    <div class="product-info">
                        <h3>Podcast Production ser...</h3>
                        <p class="price">RP 1.500.000</p>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <span>5.0 + 5Rb terjual</span>
                        </div>
                    </div>
                </div>

                <!-- KARTU 4 (Tote Bag) -->
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <img src="{{ asset('images/produk_dkv3.png') }}" alt="Tote Bag">
                        <a href="#" class="btn-update">UPDATE NOW</a>
                    </div>
                    <div class="product-info">
                        <h3>Tote bag making</h3>
                        <p class="price">RP 500.000</p>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <span>5.0 + 5Rb terjual</span>
                        </div>
                    </div>
                </div>

                <!-- KARTU ADD NEW (DI SINI ID DITAMBAHKAN) -->
                <a href="#" class="add-new-box" id="btnAddNew">
                    <div class="add-new-icon-wrapper">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <span class="add-new-text">ADD NEW</span>
                </a>

            </div>

        </div> <!-- End Admin White Box -->

    </div> <!-- End Main Content -->

    <!-- OVERLAY MODAL TAMBAH PRODUK (DI SINI ID DITAMBAHKAN) -->
    <div class="modal-overlay" id="modalAddProduct">
        <div class="modal-card">

            <!-- Tombol Back (DI SINI ID DITAMBAHKAN) -->
            <button type="button" class="btn-back" id="btnBackModal"><i class="fa-solid fa-chevron-left"></i> BACK</button>

            <!-- FORM TAMBAH PRODUK (Terhubung ke ProdukController@store) -->
            <form action="{{ route('admin-jurusan.produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <!-- Bagian Kiri: Gambar -->
                    <div class="modal-left">
                        <label for="fotoInput" class="image-upload-box" style="cursor: pointer;">
                            <img
                                id="previewFoto"
                                src="{{ asset('images/icon_gallery.png') }}"
                                alt="Upload Gambar"
                            >
                        </label>
                        <input
                            type="file"
                            id="fotoInput"
                            name="foto"
                            accept="image/jpeg,image/png,image/jpg"
                            style="display: none;"
                        >
                        <span class="upload-label">TAMBAHKAN GAMBAR</span>
                    </div>

                    <!-- Bagian Kanan: Form Utama -->
                    <div class="modal-right">

                        <div class="form-group">
                            <label>NAMA</label>
                            <input type="text" name="nama_produk" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label>DESKRIPSI</label>
                            <input type="text" name="deskripsi" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label>KATEGORI</label>
                            <select name="kategori_id" class="form-input" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-harga">
                            <label>HARGA JUAL</label>
                            <input type="number" name="harga" class="form-input" required>
                        </div>

                        <button type="submit" class="btn-simpan">SIMPAN</button>

                    </div> <!-- End Right -->
                </div> <!-- End Body -->
            </form>

        </div>
    </div>

    <!-- OVERLAY MODAL UPDATE PRODUK -->
    <div class="modal-overlay" id="modalUpdateProduct">
        <div class="modal-card">

            <!-- Tombol Back Khusus Update -->
            <button class="btn-back" id="btnBackUpdate"><i class="fa-solid fa-chevron-left"></i> BACK</button>

            <div class="modal-body">
                <!-- Bagian Kiri: Gambar -->
                <div class="modal-left">
                    <div class="image-upload-box">
                        <img src="{{ asset('images/produk_dkv2.png') }}" alt="Edit Gambar">
                    </div>
                    <span class="upload-label">UBAH GAMBAR</span>
                </div>

                <!-- Bagian Kanan: Form Utama -->
                <div class="modal-right">

                    <div class="form-group">
                        <label>NAMA</label>
                        <input type="text" class="form-input" value="Design creation services">
                    </div>

                    <div class="form-group">
                        <label>TIPE PENJUALAN</label>
                        <select class="form-input">
                            <option>BARANG</option>
                            <option selected>JASA</option>
                        </select>
                    </div>

                    <!-- Baris STOK & KODE PENJUALAN -->
                    <div class="row-stok-kode">
                        <div class="form-group col-stok">
                            <label>STOK</label>
                            <input type="number" class="form-input" value="10">
                        </div>

                        <div class="form-group col-kode">
                            <label>KODE PENJUALAN</label>
                            <div class="kode-input-wrapper">
                                <input type="text" class="form-input" value="DKV-001">
                                <button type="button" class="btn-refresh"><i class="fa-solid fa-rotate"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-harga">
                        <label>HARGA JUAL</label>
                        <input type="text" class="form-input" value="2000000">
                    </div>

                    <button type="button" class="btn-simpan">SIMPAN PERUBAHAN</button>

                </div> <!-- End Right -->
            </div> <!-- End Body -->
        </div>
    </div>

<!-- SCRIPT JAVASCRIPT UNTUK POP-UP (VERSI INSTAN) -->
<script>
        // --- 1. LOGIKA UNTUK MODAL ADD NEW ---
        const modalAdd = document.getElementById('modalAddProduct');
        const btnAddNew = document.getElementById('btnAddNew');
        const btnBackAdd = document.getElementById('btnBackModal');

        if(btnAddNew) {
            btnAddNew.addEventListener('click', function(e) {
                e.preventDefault();
                modalAdd.style.display = 'flex';
            });
        }
        if(btnBackAdd) {
            btnBackAdd.addEventListener('click', function() {
                modalAdd.style.display = 'none';
            });
        }

        // --- 2. LOGIKA UNTUK MODAL UPDATE ---
        const modalUpdate = document.getElementById('modalUpdateProduct');
        // Gunakan querySelectorAll karena tombol Update ada banyak
        const btnUpdates = document.querySelectorAll('.btn-update');
        const btnBackUpdate = document.getElementById('btnBackUpdate');

        // Looping ke semua tombol UPDATE NOW
        btnUpdates.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                modalUpdate.style.display = 'flex';
            });
        });

        if(btnBackUpdate) {
            btnBackUpdate.addEventListener('click', function() {
                modalUpdate.style.display = 'none';
            });
        }

        // --- 3. TUTUP MODAL JIKA AREA LUAR DIKLIK ---
        window.addEventListener('click', function(event) {
            if (event.target === modalAdd) {
                modalAdd.style.display = 'none';
            }
            if (event.target === modalUpdate) {
                modalUpdate.style.display = 'none';
            }
        });

        // --- 4. PREVIEW GAMBAR SEBELUM UPLOAD ---
        const fotoInput = document.getElementById('fotoInput');
        const previewFoto = document.getElementById('previewFoto');

        if (fotoInput) {
            fotoInput.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewFoto.src = event.target.result;
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        }
    </script>
</body>
</html>