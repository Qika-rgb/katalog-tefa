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
            <li>
                <a href="{{ route('admin-jurusan.dashboard') }}" class="{{ request()->routeIs('admin-jurusan.dashboard') ? 'active' : '' }}">ANALYTICS REPORTS</a>
            </li>
            <li>
                <a href="{{ route('admin-jurusan.produk.create') }}" class="{{ request()->routeIs('admin-jurusan.produk.create') ? 'active' : '' }}">PRODUCTS</a>
            </li>
            <li>
                <a href="{{ route('admin-jurusan.portofolio.index') }}" class="{{ request()->routeIs('admin-jurusan.portofolio*') ? 'active' : '' }}">PORTOFOLIO</a>
            </li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="admin-main">

        <!-- Top Profile Dinamis -->
        <div class="admin-top-profile">
            @php
                $userJurusan = strtoupper(auth()->user()->jurusan ?? 'RPL');
                $logoMap = [
                    'RPL'     => 'logo_rpl.jpeg',
                    'DKV'     => 'logo_dkv.jpeg',
                    'TKJ'     => 'logo_tkj.jpeg',
                    'ANIMASI' => 'logo_animasi.jpeg',
                    'PSPT'    => 'logo_pspt.jpeg',
                    'GIM'     => 'logo_gim.jpeg',
                ];
                $logoFile = $logoMap[$userJurusan] ?? 'logo_rpl.jpeg';
            @endphp
            <div class="profile-pill">
                <img src="{{ asset('images/' . $logoFile) }}" alt="Avatar">
                TEFA {{ auth()->user()->jurusan ?? 'JURUSAN' }}
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

                <!-- LOOPING PRODUK DINAMIS SESUAI DATABASE -->
                @forelse ($produks as $item)
                    <div class="product-card">
                        <div class="product-img-wrapper">
                            @php
                                $foto = $item->foto ?? 'default.png';
                                $isStorage = str_starts_with($foto, 'produk/');
                                $imgSrc = $isStorage ? asset('storage/' . $foto) : asset('images/' . $foto);
                            @endphp
                            <img src="{{ $imgSrc }}" alt="{{ $item->nama_produk }}">
                            <a href="#" class="btn-update" 
                               data-id="{{ $item->id }}" 
                               data-nama="{{ $item->nama_produk }}" 
                               data-deskripsi="{{ $item->deskripsi }}" 
                               data-harga="{{ $item->harga }}" 
                               data-foto="{{ $imgSrc }}">UPDATE NOW</a>
                        </div>
                        <div class="product-info">
                            <h3>{{ Str::limit($item->nama_produk, 26) }}</h3>
                            <p class="price">
                                RP {{ is_numeric($item->harga) ? number_format((float)$item->harga, 0, ',', '.') : $item->harga }}
                            </p>
                            
                            <!-- RATING & TOMBOL HAPUS -->
                            <div class="rating" style="display: flex; justify-content: space-between; align-items: center; margin-top: 8px;">
                                <div>
                                    <i class="fa-solid fa-star"></i>
                                    <span>5.0 + 0 terjual</span>
                                </div>

                                <!-- Form Hapus Produk -->
                                <form action="{{ route('admin-jurusan.produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: transparent; border: none; color: #dc2626; cursor: pointer; font-size: 13px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; padding: 2px 6px; border-radius: 4px; transition: 0.2s;" onmouseover="this.style.backgroundColor='#fee2e2'" onmouseout="this.style.backgroundColor='transparent'">
                                        <i class="fa-regular fa-trash-can"></i> Hapus
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; padding: 25px; text-align: center; color: #6b7280; font-size: 14px;">
                        Belum ada produk yang terdaftar untuk jurusan {{ auth()->user()->jurusan }}.
                    </div>
                @endforelse

                <!-- KARTU ADD NEW -->
                <a href="#" class="add-new-box" id="btnAddNew">
                    <div class="add-new-icon-wrapper">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <span class="add-new-text">ADD NEW</span>
                </a>

            </div>

        </div>

    </div>

    <!-- OVERLAY MODAL TAMBAH PRODUK -->
    <div class="modal-overlay" id="modalAddProduct">
        <div class="modal-card">

            <button type="button" class="btn-back" id="btnBackModal"><i class="fa-solid fa-chevron-left"></i> BACK</button>

            <form action="{{ route('admin-jurusan.produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
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
                            accept="image/jpeg,image/png,image/jpg,image/webp"
                            style="display: none;"
                        >
                        <span class="upload-label">TAMBAHKAN GAMBAR</span>
                    </div>

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
                    </div>
                </div>
            </form>

        </div>
    </div>

    <!-- OVERLAY MODAL UPDATE PRODUK -->
    <div class="modal-overlay" id="modalUpdateProduct">
        <div class="modal-card">

            <button class="btn-back" id="btnBackUpdate"><i class="fa-solid fa-chevron-left"></i> BACK</button>

            <div class="modal-body">
                <div class="modal-left">
                    <div class="image-upload-box">
                        <img id="updatePreviewFoto" src="{{ asset('images/icon_gallery.png') }}" alt="Edit Gambar">
                    </div>
                    <span class="upload-label">GAMBAR PRODUK</span>
                </div>

                <div class="modal-right">
                    <div class="form-group">
                        <label>NAMA</label>
                        <input type="text" id="updateNamaProduk" class="form-input" readonly>
                    </div>

                    <div class="form-group">
                        <label>DESKRIPSI</label>
                        <input type="text" id="updateDeskripsi" class="form-input" readonly>
                    </div>

                    <div class="form-group col-harga">
                        <label>HARGA JUAL</label>
                        <input type="text" id="updateHarga" class="form-input" readonly>
                    </div>

                    <button type="button" class="btn-simpan" id="btnCloseUpdate">TUTUP</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT JAVASCRIPT UNTUK POP-UP -->
    <script>
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

        const modalUpdate = document.getElementById('modalUpdateProduct');
        const btnUpdates = document.querySelectorAll('.btn-update');
        const btnBackUpdate = document.getElementById('btnBackUpdate');
        const btnCloseUpdate = document.getElementById('btnCloseUpdate');

        const updateNama = document.getElementById('updateNamaProduk');
        const updateDeskripsi = document.getElementById('updateDeskripsi');
        const updateHarga = document.getElementById('updateHarga');
        const updateFoto = document.getElementById('updatePreviewFoto');

        btnUpdates.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                if(updateNama) updateNama.value = this.dataset.nama || '';
                if(updateDeskripsi) updateDeskripsi.value = this.dataset.deskripsi || '';
                if(updateHarga) updateHarga.value = this.dataset.harga || '';
                if(updateFoto && this.dataset.foto) updateFoto.src = this.dataset.foto;
                modalUpdate.style.display = 'flex';
            });
        });

        if(btnBackUpdate) {
            btnBackUpdate.addEventListener('click', function() {
                modalUpdate.style.display = 'none';
            });
        }
        if(btnCloseUpdate) {
            btnCloseUpdate.addEventListener('click', function() {
                modalUpdate.style.display = 'none';
            });
        }

        window.addEventListener('click', function(event) {
            if (event.target === modalAdd) modalAdd.style.display = 'none';
            if (event.target === modalUpdate) modalUpdate.style.display = 'none';
        });

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