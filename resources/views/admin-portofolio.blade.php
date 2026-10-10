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
            <li><a href="{{ route('admin-jurusan.dashboard') }}" class="{{ request()->routeIs('admin-jurusan.dashboard') ? 'active' : '' }}">ANALYTICS REPORTS</a></li>
            <li><a href="{{ route('admin-jurusan.produk.create') }}" class="{{ request()->routeIs('admin-jurusan.produk.create') ? 'active' : '' }}">PRODUCTS</a></li>
            <li><a href="{{ route('admin-jurusan.portofolio.index') }}" class="{{ request()->routeIs('admin-jurusan.portofolio*') ? 'active' : '' }}">PORTOFOLIO</a></li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="admin-main">
        <div class="admin-top-profile">
            <div class="profile-pill">
                <img src="{{ asset('images/logo_' . strtolower(Auth::user()->jurusan) . '.jpeg') }}" onerror="this.src='{{ asset('images/icon_gallery.png') }}'" alt="Avatar">
                TEFA {{ Auth::user()->jurusan }}
            </div>
        </div>

        <div class="admin-header-row">
            <h1>PORTOFOLIO JURUSAN {{ Auth::user()->jurusan }}</h1>
        </div>

        @if(session('success'))
            <div style="padding: 10px 15px; background-color: #d4edda; color: #155724; border-radius: 8px; margin-bottom: 20px; font-weight: 600;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="padding: 10px 15px; background-color: #f8d7da; color: #721c24; border-radius: 8px; margin-bottom: 20px; font-weight: 600;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- DAFTAR KARTU PORTOFOLIO ADMIN -->
        <div class="admin-white-box">
            <div class="product-grid">

                @if (isset($portofolios) && count($portofolios) > 0)
                    @foreach ($portofolios as $porto)
                        <div class="product-card">
                            <div class="product-img-wrapper">
                                <img src="{{ asset('storage/' . $porto->gambar) }}" alt="{{ $porto->judul }}" style="object-fit: cover;">
                                <a href="#" class="btn-update btn-open-update"
                                   data-id="{{ $porto->id }}"
                                   data-judul="{{ $porto->judul }}"
                                   data-pembuat="{{ $porto->pembuat }}"
                                   data-deskripsi="{{ $porto->deskripsi }}"
                                   data-gambar="{{ asset('storage/' . $porto->gambar) }}"
                                   data-images="{{ json_encode($porto->images) }}"
                                   data-teams="{{ json_encode($porto->teams) }}">
                                   UPDATE INFO
                                </a>
                            </div>
                            <div class="product-info">
                                <h3 title="{{ $porto->judul }}">{{ Str::limit($porto->judul, 25) }}</h3>
                                <p class="price" style="font-size: 13px; color: #4b5563;"><i class="fa-solid fa-user-pen"></i> {{ $porto->pembuat }}</p>
                                <p style="font-size: 12px; color: #6b7280; margin-top: 4px;">{{ Str::limit($porto->deskripsi, 50) }}</p>

                                <form action="{{ route('admin-jurusan.portofolio.destroy', $porto->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus portofolio ini beserta seluruh gambar slider dan timnya?');" style="margin-top: 10px;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: transparent; border: none; color: #dc2626; cursor: pointer; font-size: 13px; font-weight: 600;">
                                        <i class="fa-solid fa-trash"></i> Hapus Portofolio
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif

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
        <div class="modal-card" style="width: 800px; max-height: 90vh; overflow-y: auto;">
            <button type="button" class="btn-back" id="btnBackAddPorto"><i class="fa-solid fa-chevron-left"></i> BACK</button>

            <form action="{{ route('admin-jurusan.portofolio.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="flex-direction: column;">
                    
                    <h3>Info Utama Proyek</h3>
                    <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                        <div class="modal-left" style="flex: 1;">
                            <label for="fotoInputAdd" class="image-upload-box" style="cursor: pointer; height: 200px;">
                                <img id="previewFotoAdd" src="{{ asset('images/icon_gallery.png') }}" alt="Upload Gambar">
                            </label>
                            <input type="file" id="fotoInputAdd" name="gambar" accept="image/*" required style="display: none;">
                            <span class="upload-label">GAMBAR THUMBNAIL UTAMA</span>
                        </div>

                        <div class="modal-right" style="flex: 2;">
                            <div class="form-group">
                                <label>JUDUL KARYA / PROYEK</label>
                                <input type="text" name="judul" class="form-input" placeholder="Contoh: Aplikasi Sistem Absensi RFID" required>
                            </div>
                            <div class="form-group">
                                <label>NAMA INSTANSI / CLIENT / TIM</label>
                                <input type="text" name="pembuat" class="form-input" placeholder="Contoh: SMKN 4 Tanjungpinang" required>
                            </div>
                            <div class="form-group">
                                <label>DESKRIPSI PROYEK</label>
                                <textarea name="deskripsi" class="form-input" rows="3" placeholder="Jelaskan ringkas tentang karya ini..." required style="resize: vertical;"></textarea>
                            </div>
                        </div>
                    </div>

                    <hr style="border: 1px solid #e2e8f0; margin-bottom: 20px;">

                    <div class="dynamic-section">
                        <h3><i class="fa-solid fa-images"></i> Gambar Slider Halaman Detail (Opsional)</h3>
                        <p style="font-size: 12px; color: #64748b; margin-bottom: 10px;">Pilih beberapa foto sekaligus untuk slider yang bisa digeser (Format: JPG, PNG).</p>
                        <input type="file" name="slider_images[]" multiple accept="image/*" class="form-input" style="padding: 10px; background: white;">
                    </div>

                    <div class="dynamic-section">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                            <h3><i class="fa-solid fa-users"></i> Anggota Tim Proyek (Opsional)</h3>
                            <button type="button" class="btn-add-row" id="btnAddTeam"><i class="fa-solid fa-plus"></i> Tambah Anggota</button>
                        </div>
                        
                        <div id="teamContainer">
                            <div class="team-member-row">
                                <input type="text" name="team_nama[]" class="form-input" placeholder="Nama Anggota (Cth: Mahadir)">
                                <input type="text" name="team_peran[]" class="form-input" placeholder="Peran (Cth: Backend)">
                                <input type="file" name="team_foto[]" class="form-input" accept="image/*" title="Foto Anggota">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-simpan" style="width: 100%; margin-top: 10px; padding: 15px; font-size: 16px;">SIMPAN PORTOFOLIO & DETAILNYA</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. MODAL UPDATE INFO UTAMA -->
    <div class="modal-overlay" id="modalUpdatePorto">
        <div class="modal-card" style="width: 800px; max-height: 90vh; overflow-y: auto;">
            <button type="button" class="btn-back" id="btnBackUpdatePorto"><i class="fa-solid fa-chevron-left"></i> BACK</button>

            <form id="formUpdatePorto" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="flex-direction: column;">
                    
                    <h3>Info Utama Proyek</h3>
                    <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                        <div class="modal-left" style="flex: 1;">
                            <label for="fotoInputUpdate" class="image-upload-box" style="cursor: pointer; height: 200px;">
                                <img id="previewFotoUpdate" src="" alt="Edit Gambar">
                            </label>
                            <input type="file" id="fotoInputUpdate" name="gambar" accept="image/*" style="display: none;">
                            <span class="upload-label">UBAH THUMBNAIL (OPSIONAL)</span>
                        </div>

                        <div class="modal-right" style="flex: 2;">
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
                                <textarea name="deskripsi" id="editDeskripsi" class="form-input" rows="3" required style="resize: vertical;"></textarea>
                            </div>
                        </div>
                    </div>

                    <hr style="border: 1px solid #e2e8f0; margin-bottom: 20px;">

                    <!-- GAMBAR SLIDER YANG SUDAH ADA -->
                    <div class="dynamic-section">
                        <h3><i class="fa-solid fa-images"></i> Gambar Slider Saat Ini</h3>
                        <div id="existingImagesContainer" style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 15px;">
                            <!-- Dimuat lewat JS -->
                        </div>

                        <label style="font-size: 13px; font-weight: 600; color: #374151;">Tambah Gambar Slider Baru (Opsional):</label>
                        <input type="file" name="slider_images[]" multiple accept="image/*" class="form-input" style="padding: 10px; background: white; margin-top: 5px;">
                    </div>

                    <!-- ANGGOTA TIM YANG SUDAH ADA -->
                    <div class="dynamic-section">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                            <h3><i class="fa-solid fa-users"></i> Anggota Tim Saat Ini</h3>
                            <button type="button" class="btn-add-row" id="btnAddTeamUpdate"><i class="fa-solid fa-plus"></i> Tambah Anggota</button>
                        </div>
                        
                        <div id="existingTeamsContainer" style="margin-bottom: 15px;">
                            <!-- Dimuat lewat JS -->
                        </div>

                        <div id="teamContainerUpdate">
                            <!-- Input tim tambahan baru -->
                        </div>
                    </div>

                    <button type="submit" class="btn-simpan" style="width: 100%; margin-top: 10px; padding: 15px; font-size: 16px;">SIMPAN PERUBAHAN</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT POPUP & DYNAMIC INPUTS -->
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

        const btnAddTeam = document.getElementById('btnAddTeam');
        const teamContainer = document.getElementById('teamContainer');
        if (btnAddTeam) {
            btnAddTeam.addEventListener('click', function() {
                const newRow = document.createElement('div');
                newRow.className = 'team-member-row';
                newRow.innerHTML = `
                    <input type="text" name="team_nama[]" class="form-input" placeholder="Nama Anggota (Cth: Mahadir)">
                    <input type="text" name="team_peran[]" class="form-input" placeholder="Peran (Cth: Backend)">
                    <input type="file" name="team_foto[]" class="form-input" accept="image/*" title="Foto Anggota">
                    <button type="button" class="btn-remove-row"><i class="fa-solid fa-trash"></i></button>
                `;
                teamContainer.appendChild(newRow);

                newRow.querySelector('.btn-remove-row').addEventListener('click', function() {
                    newRow.remove();
                });
            });
        }

        const btnAddTeamUpdate = document.getElementById('btnAddTeamUpdate');
        const teamContainerUpdate = document.getElementById('teamContainerUpdate');
        if (btnAddTeamUpdate) {
            btnAddTeamUpdate.addEventListener('click', function() {
                const newRow = document.createElement('div');
                newRow.className = 'team-member-row';
                newRow.innerHTML = `
                    <input type="text" name="team_nama[]" class="form-input" placeholder="Nama Anggota (Cth: Mahadir)">
                    <input type="text" name="team_peran[]" class="form-input" placeholder="Peran (Cth: Backend)">
                    <input type="file" name="team_foto[]" class="form-input" accept="image/*" title="Foto Anggota">
                    <button type="button" class="btn-remove-row"><i class="fa-solid fa-trash"></i></button>
                `;
                teamContainerUpdate.appendChild(newRow);

                newRow.querySelector('.btn-remove-row').addEventListener('click', function() {
                    newRow.remove();
                });
            });
        }

        const modalUpdate = document.getElementById('modalUpdatePorto');
        const btnBackUpdate = document.getElementById('btnBackUpdatePorto');
        const updateButtons = document.querySelectorAll('.btn-open-update');
        const formUpdate = document.getElementById('formUpdatePorto');
        const existingImagesContainer = document.getElementById('existingImagesContainer');
        const existingTeamsContainer = document.getElementById('existingTeamsContainer');

        updateButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.getAttribute('data-id');
                const judul = this.getAttribute('data-judul');
                const pembuat = this.getAttribute('data-pembuat');
                const deskripsi = this.getAttribute('data-deskripsi');
                const gambar = this.getAttribute('data-gambar');
                const images = JSON.parse(this.getAttribute('data-images') || '[]');
                const teams = JSON.parse(this.getAttribute('data-teams') || '[]');

                document.getElementById('editJudul').value = judul;
                document.getElementById('editPembuat').value = pembuat;
                document.getElementById('editDeskripsi').value = deskripsi;
                document.getElementById('previewFotoUpdate').src = gambar;
                
                // Render Slider Lama
                existingImagesContainer.innerHTML = '';
                if (images.length > 0) {
                    images.forEach(img => {
                        const imgBox = document.createElement('div');
                        imgBox.style.cssText = 'position: relative; display: inline-block;';
                        imgBox.innerHTML = `
                            <img src="/storage/${img.gambar}" style="width: 70px; height: 70px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1;">
                            <button type="button" onclick="deleteSliderImage(${img.id})" style="position: absolute; top: -5px; right: -5px; background: #dc2626; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; font-size: 10px; cursor: pointer;" title="Hapus foto ini">&times;</button>
                        `;
                        existingImagesContainer.appendChild(imgBox);
                    });
                } else {
                    existingImagesContainer.innerHTML = '<p style="font-size: 12px; color: #6b7280; font-style: italic;">Belum ada gambar slider.</p>';
                }

                // Render Tim Lama
                existingTeamsContainer.innerHTML = '';
                if (teams.length > 0) {
                    teams.forEach(team => {
                        const teamBox = document.createElement('div');
                        teamBox.className = 'team-member-row';
                        teamBox.innerHTML = `
                            <input type="text" value="${team.nama}" disabled class="form-input" style="background: #f1f5f9;">
                            <input type="text" value="${team.peran}" disabled class="form-input" style="background: #f1f5f9;">
                            <button type="button" class="btn-remove-row" onclick="deleteTeamMember(${team.id})" title="Hapus anggota"><i class="fa-solid fa-trash"></i></button>
                        `;
                        existingTeamsContainer.appendChild(teamBox);
                    });
                } else {
                    existingTeamsContainer.innerHTML = '<p style="font-size: 12px; color: #6b7280; font-style: italic; margin-bottom: 10px;">Belum ada data tim.</p>';
                }

                teamContainerUpdate.innerHTML = '';
                formUpdate.action = `/admin-jurusan/portofolio/update/${id}`;
                modalUpdate.style.display = 'flex';
            });
        });

        function deleteSliderImage(imageId) {
            if (confirm('Yakin ingin menghapus gambar slider ini?')) {
                fetch(`/admin-jurusan/portofolio/image/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    if (response.ok) location.reload();
                });
            }
        }

        function deleteTeamMember(teamId) {
            if (confirm('Yakin ingin menghapus anggota tim ini?')) {
                fetch(`/admin-jurusan/portofolio/team/${teamId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    if (response.ok) location.reload();
                });
            }
        }

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