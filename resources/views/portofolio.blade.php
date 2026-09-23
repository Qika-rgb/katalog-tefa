@extends('layouts.frontend')

@section('content')
<div class="portfolio-wrapper">
    <div class="portfolio-header">
        <h1>PORTOFOLIO TEFA</h1>
        <p>Karya dan proyek unggulan karya siswa-siswi SMKN 4 Tanjungpinang dari berbagai program keahlian.</p>
    </div>

    <!-- Filter Tabs dengan Logo Jurusan -->
    <div class="filter-tabs">
        <a href="{{ url('/portofolio') }}" class="filter-tab tab-all {{ $kategoriAktif == 'all' ? 'active' : '' }}">
            <i class="fa-solid fa-shapes"></i>
            <span>Semua</span>
        </a>

        @foreach($daftarJurusan as $jurusan)
            @php
                $adaLogo = file_exists(public_path('images/' . $jurusan['logo']));
            @endphp
            <a href="{{ url('/portofolio?kategori=' . $jurusan['id']) }}" class="filter-tab {{ (string)$kategoriAktif === (string)$jurusan['id'] ? 'active' : '' }}">
                @if($adaLogo)
                    <img src="{{ asset('images/' . $jurusan['logo']) }}" alt="{{ $jurusan['nama'] }}" class="filter-tab-img">
                @else
                    <span class="filter-tab-icon">
                        <i class="fa-solid fa-network-wired"></i>
                    </span>
                @endif
                <span>{{ $jurusan['nama'] }}</span>
            </a>
        @endforeach
    </div>

    <!-- Area Card Portofolio dari Database -->
    @if($portofolios->count() > 0)
        <div class="portfolio-grid">
            @php
                $namaJurusan = [
                    '0' => ['nama' => 'RPL', 'badge' => 'badge-rpl'],
                    '4' => ['nama' => 'DKV', 'badge' => 'badge-dkv'],
                    '2' => ['nama' => 'TKJ', 'badge' => 'badge-tkj'],
                    '1' => ['nama' => 'Animasi', 'badge' => 'badge-animasi'],
                    '3' => ['nama' => 'PSPT', 'badge' => 'badge-pspt'],
                    '5' => ['nama' => 'Gim', 'badge' => 'badge-gim'],
                ];
            @endphp

            @foreach($portofolios as $item)
                @php
                    $info = $namaJurusan[$item->kategori_id] ?? ['nama' => 'TEFA', 'badge' => 'badge-rpl'];
                @endphp
                <div class="portfolio-card">
                    <div class="card-thumb">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
                        <span class="badge-jurusan {{ $info['badge'] }}">{{ $info['nama'] }}</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">{{ $item->judul }}</h3>
                        <p class="card-desc">{{ $item->deskripsi }}</p>
                        <div class="card-footer">
                            <div class="author-info">
                                <i class="fa-solid fa-users-gear"></i>
                                <span>{{ $item->pembuat }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="fa-regular fa-folder-open"></i>
            <p>Belum ada portofolio untuk kategori ini.</p>
        </div>
    @endif
</div>
@endsection