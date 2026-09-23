@extends('layouts.frontend')

@section('content')
<style>
    .portfolio-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px 80px 20px;
        font-family: 'Poppins', sans-serif;
    }

    .portfolio-header {
        text-align: center;
        margin-bottom: 35px;
    }

    .portfolio-header h1 {
        font-size: 32px;
        font-weight: 800;
        letter-spacing: 0.5px;
        color: #111827;
        margin-bottom: 8px;
    }

    .portfolio-header p {
        color: #6b7280;
        font-size: 15px;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Filter Tabs */
    .filter-tabs {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 45px;
    }

    .filter-tab {
        padding: 8px 22px;
        border-radius: 9999px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease;
        border: 1.5px solid transparent;
        color: #4b5563;
        background-color: #f3f4f6;
    }

    .filter-tab:hover {
        background-color: #e5e7eb;
        color: #111827;
    }

    .filter-tab.active {
        background-color: #111827;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Portfolio Cards Grid */
    .portfolio-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 28px;
    }

    .portfolio-card {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #f0f0f0;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .portfolio-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 30px rgba(0, 0, 0, 0.1);
    }

    .card-thumb {
        position: relative;
        width: 100%;
        height: 210px;
        background-color: #f3f4f6;
        overflow: hidden;
    }

    .card-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .portfolio-card:hover .card-thumb img {
        transform: scale(1.05);
    }

    .badge-jurusan {
        position: absolute;
        top: 14px;
        left: 14px;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #ffffff;
        backdrop-filter: blur(4px);
    }

    .badge-rpl { background-color: #2563eb; }
    .badge-dkv { background-color: #e11d48; }
    .badge-tkj { background-color: #0d9488; }
    .badge-animasi { background-color: #f59e0b; }
    .badge-pspt { background-color: #7c3aed; }
    .badge-gim { background-color: #059669; }

    .card-body {
        padding: 22px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .card-title {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
        line-height: 1.4;
    }

    .card-desc {
        font-size: 13.5px;
        color: #6b7280;
        line-height: 1.6;
        margin-bottom: 20px;
        flex-grow: 1;
    }

    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #f3f4f6;
        padding-top: 14px;
    }

    .author-info {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .author-info i {
        color: #9ca3af;
        font-size: 14px;
    }

    .author-info span {
        font-size: 12px;
        font-weight: 500;
        color: #4b5563;
    }

    .btn-detail {
        font-size: 13px;
        font-weight: 600;
        color: #2563eb;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: gap 0.2s ease;
    }

    .btn-detail:hover {
        gap: 10px;
        color: #1d4ed8;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #9ca3af;
    }
</style>

<div class="portfolio-wrapper">
    <!-- Header Section -->
    <div class="portfolio-header">
        <h1>PORTOFOLIO TEFA</h1>
        <p>Karya dan proyek unggulan karya siswa-siswi SMKN 4 Tanjungpinang dari berbagai program keahlian.</p>
    </div>

    @php
        $kategoriAktif = request('kategori', 'all');

        // Contoh Data Statis untuk Preview Desain (Nantinya bisa diganti dari Database)
        $items = [
            [
                'id_jurusan' => '0',
                'jurusan' => 'RPL',
                'badge_class' => 'badge-rpl',
                'judul' => 'Sistem Informasi E-Katalog & Kasir TEFA',
                'deskripsi' => 'Aplikasi web pemesanan dan katalog produk berbasis Laravel dengan integrasi dashboard admin dan pelacakan pesanan real-time.',
                'pembuat' => 'Tim RPL TEFA',
                'gambar' => asset('images/tefa_rpl.png'),
            ],
            [
                'id_jurusan' => '4',
                'jurusan' => 'DKV',
                'badge_class' => 'badge-dkv',
                'judul' => 'Rebranding & Packaging Produk Kuliner Lokal',
                'deskripsi' => 'Desain identitas visual menyeluruh mulai dari logo vector, kemasan ramah lingkungan, hingga mockup media promosi digital.',
                'pembuat' => 'Siswa DKV Angkatan 2024',
                'gambar' => asset('images/tefa_dkv.png'),
            ],
            [
                'id_jurusan' => '5',
                'jurusan' => 'Gim',
                'badge_class' => 'badge-gim',
                'judul' => 'Petualangan Gurindam - 2D Platformer Game',
                'deskripsi' => 'Game edukasi budaya lokal Kepri yang dibangun menggunakan Unity engine dengan aset pixel art orisinal.',
                'pembuat' => 'Studio Gim SMKN 4',
                'gambar' => asset('images/tefa_gim.png'),
            ],
            [
                'id_jurusan' => '2',
                'jurusan' => 'TKJ',
                'badge_class' => 'badge-tkj',
                'judul' => 'Instalasi Hotspot & Manajemen Bandwidth Mikrotik',
                'deskripsi' => 'Implementasi sistem jaringan tertutup dengan captive portal dan load balancing ganda untuk laboratorium sekolah.',
                'pembuat' => 'Teknisi Muda TKJ',
                'gambar' => asset('images/tefa_tkj.png'),
            ],
            [
                'id_jurusan' => '1',
                'jurusan' => 'Animasi',
                'badge_class' => 'badge-animasi',
                'judul' => 'Short 3D Animation: "Langkah Kecil"',
                'deskripsi' => 'Film animasi 3 dimensi pendek berdurasi 3 menit menggunakan Blender, dari tahap character rigging sampai compositing.',
                'pembuat' => 'Tim Produksi Animasi',
                'gambar' => asset('images/tefa_animasi.png'),
            ],
            [
                'id_jurusan' => '3',
                'jurusan' => 'PSPT',
                'badge_class' => 'badge-pspt',
                'judul' => 'Video Profil Resmi SMKN 4 Tanjungpinang',
                'deskripsi' => 'Produksi video promosi sinematik multi-camera dengan color grading profesional dan live broadcasting podcast.',
                'pembuat' => 'Crew Broadcast PSPT',
                'gambar' => asset('images/tefa_pspt.png'),
            ],
        ];

        // Filter berdasarkan kategori yang dipilih
        if ($kategoriAktif !== 'all') {
            $items = array_filter($items, function($item) use ($kategoriAktif) {
                return $item['id_jurusan'] === (string)$kategoriAktif;
            });
        }
    @endphp

    <!-- Filter Tabs Kategori -->
    <div class="filter-tabs">
        <a href="{{ url('/portofolio') }}" class="filter-tab {{ $kategoriAktif == 'all' ? 'active' : '' }}">Semua</a>
        <a href="{{ url('/portofolio?kategori=0') }}" class="filter-tab {{ $kategoriAktif === '0' ? 'active' : '' }}">RPL</a>
        <a href="{{ url('/portofolio?kategori=4') }}" class="filter-tab {{ $kategoriAktif === '4' ? 'active' : '' }}">DKV</a>
        <a href="{{ url('/portofolio?kategori=2') }}" class="filter-tab {{ $kategoriAktif === '2' ? 'active' : '' }}">TKJ</a>
        <a href="{{ url('/portofolio?kategori=1') }}" class="filter-tab {{ $kategoriAktif === '1' ? 'active' : '' }}">Animasi</a>
        <a href="{{ url('/portofolio?kategori=3') }}" class="filter-tab {{ $kategoriAktif === '3' ? 'active' : '' }}">PSPT</a>
        <a href="{{ url('/portofolio?kategori=5') }}" class="filter-tab {{ $kategoriAktif === '5' ? 'active' : '' }}">Gim</a>
    </div>

    <!-- Portfolio Grid Container -->
    @if(count($items) > 0)
        <div class="portfolio-grid">
            @foreach($items as $item)
                <div class="portfolio-card">
                    <div class="card-thumb">
                        <img src="{{ $item['gambar'] }}" alt="{{ $item['judul'] }}">
                        <span class="badge-jurusan {{ $item['badge_class'] }}">{{ $item['jurusan'] }}</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">{{ $item['judul'] }}</h3>
                        <p class="card-desc">{{ $item['deskripsi'] }}</p>
                        <div class="card-footer">
                            <div class="author-info">
                                <i class="fa-solid fa-users-gear"></i>
                                <span>{{ $item['pembuat'] }}</span>
                            </div>
                            <a href="#" class="btn-detail">Detail <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="fa-regular fa-folder-open" style="font-size: 48px; margin-bottom: 12px; display: block;"></i>
            <p>Belum ada portofolio untuk kategori jurusan ini.</p>
        </div>
    @endif
</div>
@endsection