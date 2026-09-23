<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Jurusan - Portofolio</title>
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

        <!-- Top Profile -->
        <div class="admin-top-profile">
            <div class="profile-pill">
                <img src="{{ asset('images/logo_' . strtolower(Auth::user()->jurusan) . '.jpeg') }}" onerror="this.src='{{ asset('images/icon_gallery.png') }}'" alt="Avatar">
                TEFA {{ Auth::user()->jurusan }}
            </div>
        </div>

        <!-- Main Header -->
        <div class="admin-header-row">
            <h1>PORTOFOLIO JURUSAN {{ Auth::user()->jurusan }}</h1>
            <div class="header-actions">
                <i class="fa-solid fa-magnifying-glass"></i>
                <i class="fa-regular fa-envelope"></i>
                <span class="year-badge">2026</span>
            </div>
        </div>

        <!-- ALERT NOTIFIKASI -->
        @if(session('success'))
            <div style="padding: 10px 15px; background-color: #d4edda; color: #155724; border-radius: 8px; margin-bottom: 20px; font-weight: 600;">
                {{ session('success') }}
            </div>
        @endif

        <?php if ($errors->any()): ?>
            <div style="padding: 10px 15px; background-color: #f8d7da; color: #721c24; border-radius: 8px; margin-bottom: 20px; font-weight: 600;">
                <ul style="margin: 0; padding-left: 20px;">
                    <?php foreach ($errors->all() as$error): ?>
                        <li><?= e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- DAFTAR KARTU PORTOFOLIO -->
        <div class="admin-white-box">
            <div class="product-grid">

                <?php if (isset($portofolios) && count($portofolios) > 0): ?>
                    <?php foreach ($portofolios as$porto): ?>
                        <div class="product-card">
                            <div class="product-img-wrapper">
                                <img src="<?= asset('storage/' . $porto->gambar) ?>" alt="<?= e($porto->judul) ?>" style="object-fit: cover;">
                                <a href="#" class="btn-update btn-open-update"
                                   data-id="<?= $porto->id ?>"
                                   data-judul="<?= e($porto->judul) ?>"
                                   data-pembuat="<?= e($porto->pembuat) ?>"
                                   data-deskripsi="<?= e($porto->deskripsi) ?>"
                                   data-gambar="<?= asset('storage/' . $porto->gambar) ?>">
                                   UPDATE NOW
                                </a>
                            </div>
                            <div class="product-info">
                                <h3 title="<?= e($porto->judul) ?>"><?= e(\Illuminate\Support\Str::limit($porto->judul, 25)) ?></h3>
                                <p class="price" style="font-size: 13px; color: #4b5563;"><i class="fa-solid fa-user-pen"></i> <?= e($porto->pembuat) ?></p>
                                <p style="font-size: 12px; color: #6b7280; margin-top: 4px;"><?= e(\Illuminate\Support\Str::limit($porto->deskripsi, 50)) ?></p>
                                
                                <form action="<?= route('admin-jurusan.portofolio.destroy', $porto->id) ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus portofolio ini?');" style="margin-top: 10px;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: transparent; border: none; color: #dc2626; cursor: pointer; font-size: 13px; font-weight: 600;">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- KARTU ADD NEW -->
                <a href="#" class="add-new-box" id="btnAddNewPorto">
                    <div class="add-new-icon-wrapper">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <span class="add-new-text">ADD NEW</span>
                </a>

            </div>
        </div>

    </div>

    <!-- 1. MODAL TAMBAH PORTOFOLIO -->
    <div class="modal-overlay" id="modalAddPorto">
        <div class="modal-card">
            <button type="button" class="btn-back" id="btnBackAddPorto"><i class="fa-solid fa-chevron-left"></i> BACK</button>

            <form action="{{ route('admin-jurusan.portofolio.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="modal-left">
                        <label for="fotoInputAdd" class="image-upload-box" style="cursor: pointer;">
                            <img id="previewFotoAdd" src="{{ asset('images/icon_gallery.png') }}" alt="Upload Gambar">
                        </label>
                        <input type="file" id="fotoInputAdd" name="gambar" accept="image/*" required style="display: none;">
                        <span class="upload-label">TAMBAHKAN GAMBAR KARYA</span>
                    </div>

                    <div class="modal-right">
                        <div class="form-group">
                            <label>JUDUL KARYA / PROYEK</label>
                            <input type="text" name="judul" class="form-input" placeholder="Contoh: Aplikasi Sistem Absensi RFID" required>
                        </div>

                        <div class="form-group">
                            <label>PEMBUAT / TIM SISWA</label>
                            <input type="text" name="pembuat" class="form-input" placeholder="Contoh: Tim Siswa {{ Auth::user()->jurusan }}" required>
                        </div>

                        <div class="form-group">
                            <label>DESKRIPSI</label>
                            <textarea name="deskripsi" class="form-input" rows="4" placeholder="Jelaskan ringkas tentang karya ini..." required style="resize: vertical;"></textarea>
                        </div>

                        <button type="submit" class="btn-simpan">SIMPAN PORTOFOLIO</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. MODAL UPDATE PORTOFOLIO -->
    <div class="modal-overlay" id="modalUpdatePorto">
        <div class="modal-card">
            <button type="button" class="btn-back" id="btnBackUpdatePorto"><i class="fa-solid fa-chevron-left"></i> BACK</button>

            <form id="formUpdatePorto" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="modal-left">
                        <label for="fotoInputUpdate" class="image-upload-box" style="cursor: pointer;">
                            <img id="previewFotoUpdate" src="" alt="Edit Gambar">
                        </label>
                        <input type="file" id="fotoInputUpdate" name="gambar" accept="image/*" style="display: none;">
                        <span class="upload-label">UBAH GAMBAR (OPSIONAL)</span>
                    </div>

                    <div class="modal-right">
                        <div class="form-group">
                            <label>JUDUL KARYA / PROYEK</label>
                            <input type="text" name="judul" id="editJudul" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label>PEMBUAT / TIM SISWA</label>
                            <input type="text" name="pembuat" id="editPembuat" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label>DESKRIPSI</label>
                            <textarea name="deskripsi" id="editDeskripsi" class="form-input" rows="4" required style="resize: vertical;"></textarea>
                        </div>

                        <button type="submit" class="btn-simpan">SIMPAN PERUBAHAN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT POPUP -->
    <script>
        const modalAdd = document.getElementById('modalAddPorto');
        const btnAddNew = document.getElementById('btnAddNewPorto');
        const btnBackAdd = document.getElementById('btnBackAddPorto');

        if (btnAddNew) {
            btnAddNew.addEventListener('click', function(e) {
                e.preventDefault();
                modalAdd.style.display = 'flex';
            });
        }
        if (btnBackAdd) {
            btnBackAdd.addEventListener('click', function() {
                modalAdd.style.display = 'none';
            });
        }

        const fotoInputAdd = document.getElementById('fotoInputAdd');
        const previewFotoAdd = document.getElementById('previewFotoAdd');
        if (fotoInputAdd) {
            fotoInputAdd.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        previewFotoAdd.src = evt.target.result;
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        }

        const modalUpdate = document.getElementById('modalUpdatePorto');
        const btnBackUpdate = document.getElementById('btnBackUpdatePorto');
        const updateButtons = document.querySelectorAll('.btn-open-update');
        const formUpdate = document.getElementById('formUpdatePorto');

        updateButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.getAttribute('data-id');
                const judul = this.getAttribute('data-judul');
                const pembuat = this.getAttribute('data-pembuat');
                const deskripsi = this.getAttribute('data-deskripsi');
                const gambar = this.getAttribute('data-gambar');

                document.getElementById('editJudul').value = judul;
                document.getElementById('editPembuat').value = pembuat;
                document.getElementById('editDeskripsi').value = deskripsi;
                document.getElementById('previewFotoUpdate').src = gambar;

                formUpdate.action = `/admin-jurusan/portofolio/update/${id}`;
                modalUpdate.style.display = 'flex';
            });
        });

        if (btnBackUpdate) {
            btnBackUpdate.addEventListener('click', function() {
                modalUpdate.style.display = 'none';
            });
        }

        const fotoInputUpdate = document.getElementById('fotoInputUpdate');
        const previewFotoUpdate = document.getElementById('previewFotoUpdate');
        if (fotoInputUpdate) {
            fotoInputUpdate.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        previewFotoUpdate.src = evt.target.result;
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        }

        window.addEventListener('click', function(event) {
            if (event.target === modalAdd) modalAdd.style.display = 'none';
            if (event.target === modalUpdate) modalUpdate.style.display = 'none';
        });
    </script>
</body>
</html>