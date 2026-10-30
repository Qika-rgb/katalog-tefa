@extends('layouts.frontend')

@section('content')
<div class="katalog-wrapper">

    <!-- BAGIAN BANNER -->
    <div class="banner-container">
        <i class="fa-solid fa-chevron-left banner-arrow" id="prevBanner"></i>
        
        <div class="banner-content" id="bannerBg">
            <div class="banner-text" id="bannerTextContainer">
                <h1 id="bannerTitle">WELCOME TO TEFA REKAYASA PERANGKAT LUNAK</h1>
            </div>
            
            <img src="{{ asset('images/icon_rpl.png') }}" alt="Banner Icon" class="banner-img" id="bannerImg">
        </div>

        <i class="fa-solid fa-chevron-right banner-arrow" id="nextBanner"></i>
    </div>

    <!-- JUDUL KATALOG -->
    <h2 class="katalog-section-title">{{ __('messages.catalog_all_title') }}</h2>

    <!-- GRID PRODUK DARI DATABASE -->
    <div class="product-grid">
        @if(isset($produks) && count($produks) > 0)
            @foreach ($produks as $item)
                @php
                    $mediaFile = $item->vidio ?? $item->foto ?? 'default.png';
                    $extension = strtolower(pathinfo($mediaFile, PATHINFO_EXTENSION));

                    if (str_contains($mediaFile, 'produk/') || str_contains($mediaFile, 'portofolio/')) {
                        $mediaUrl = asset('storage/' .$mediaFile);
                    } else {
                        $mediaUrl = asset('images/' .$mediaFile);
                    }
                @endphp

                <div class="product-card" data-kategori="{{ $item->kategori_id ?? '' }}">
                    <!-- Kotak Media -->
                    <div class="product-img-wrapper" style="position: relative; background-color: #ffffff; height: 200px; display: flex; align-items: center; justify-content: center; overflow: hidden; padding: 5px;">
                        @if(in_array($extension, ['mp4', 'webm', 'ogg', 'mov']))
                            <video width="100%" height="100%" autoplay loop muted playsinline style="object-fit: cover; width: 100%; height: 100%;">
                                <source src="{{ $mediaUrl }}" type="video/mp4">
                                Browser Anda tidak mendukung pemutaran video.
                            </video>
                        @else
                            <img src="{{ $mediaUrl }}" alt="{{ $item->nama_produk ?? '' }}" style="width: 100%; height: 200px; object-fit: contain;">
                        @endif

                        <a href="/pemesanan/{{ $item->id }}" class="btn-order">{{ __('messages.order_now') }}</a>
                    </div>

                    <!-- Info Teks -->
                    <div class="product-info">
                        <h3>{{ $item->nama_produk ?? '' }}</h3>
                        <p class="price">
                            RP 
                            @php
                                $harga = (string)($item->harga ?? 0);
                            @endphp
                            @if(strpos($harga, '-') !== false)
                                {{ $harga }}
                            @elseif(is_numeric($item->harga))
                                {{ number_format((float)$item->harga, 0, ',', '.') }}
                            @else
                                {{ $harga }}
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
        @else
            <p style="grid-column: 1 / -1; text-align: center; color: #6b7280; padding: 30px;">{{ __('messages.no_products') }}</p>
        @endif
    </div>

    <!-- TOMBOL PAGINATION -->
    @if(isset($produks) && method_exists($produks, 'links'))
        <div class="d-flex justify-content-center mt-4 mb-5">
            {{ $produks->links() }}
        </div>
    @endif

</div>

<!-- SCRIPT SLIDER BANNER -->
<script>
    const bannerSemua = {
        title: "{!! __('messages.welcome_banner_title') !!}",
        bg: "linear-gradient(to right, #60EFFF, #0061FF)",
        img: "{{ asset('images/icon_welcome.png') }}",
        bottom: "0px",
        right: "20px",
        height: "200px"
    };

    const banners = [
        { 
                title: "WELCOME TO TEFA REKAYASA PERANGKAT LUNAK", 
                bg: "linear-gradient(to right, #FD1B00, #FC5200, #F68C25, #FDC02A)", 
                img: "{{ asset('images/icon_rpl.png') }}",
                bottom: "0px", // <-- Atur ketinggian khusus icon RPL di sini
                height: "270px"
            },
            { title: "WELCOME TO TEFA ANIMASI", bg: "linear-gradient(to right, #38bdf8, #08405c)", img: "{{ asset('images/icon_animasi.png') }}" },
            { title: "WELCOME TO TEFA TEKNIK KOMPUTER DAN JARINGAN", bg: "linear-gradient(to right, #10B981, #052E16)", img: "{{ asset('images/icon_tkj.png') }}" },
            { title: "WELCOME TO TEFA PRODUKSI SIARAN DAN PROGRAM TELEVISI", bg: "linear-gradient(to right, #eac793, #F3C623, #FFB22C, #FA812F)", img: "{{ asset('images/icon_pspt.png') }}" },
            { title: "WELCOME TO TEFA DESAIN KOMUNIKASI VISUAL", bg: "linear-gradient(to right, #6b0f1a, #4a0711, #1a0205)", img: "{{ asset('images/icon_dkv2.png') }}" },
            { title: "WELCOME TO TEFA PENGEMBANGAN GIM", bg: "linear-gradient(to right, #4f46e5, #090542)", img: "{{ asset('images/icon_gim.png') }}" }
        ];

    let currentIndex = 0;
    let isSemuaJurusan = false;

    const bannerBg = document.getElementById('bannerBg');
    const bannerTitle = document.getElementById('bannerTitle');
    const bannerImg = document.getElementById('bannerImg');
    const btnPrev = document.getElementById('prevBanner');
    const btnNext = document.getElementById('nextBanner');
    const katalogTitle = document.querySelector('.katalog-section-title');
    const bannerTextContainer = document.getElementById('bannerTextContainer');

    const urlParams = new URLSearchParams(window.location.search);
    const kategoriParam = urlParams.get('kategori');

    if (kategoriParam === 'all' || kategoriParam === null) {
        isSemuaJurusan = true;
        bannerBg.style.background = bannerSemua.bg;
        bannerTitle.innerHTML = bannerSemua.title;
        bannerTitle.style.fontSize = '42px';
        bannerTitle.style.lineHeight = '1.2';
        bannerTitle.style.textShadow = 'none';
        bannerTextContainer.style.textAlign = 'left';
        bannerTextContainer.style.width = 'auto';
        bannerTextContainer.style.marginLeft = '40px';
        if(bannerImg) {
            bannerImg.style.display = 'block';
            bannerImg.src = bannerSemua.img;
            bannerImg.style.right = bannerSemua.right || '0px';
            bannerImg.style.bottom = bannerSemua.bottom || '0px';
            bannerImg.style.height = bannerSemua.height || '200px';
        }
        if (katalogTitle) katalogTitle.textContent = "{{ __('messages.catalog_all_title') }}";
    } else {
        isSemuaJurusan = false;
        currentIndex = parseInt(kategoriParam);
        bannerBg.style.background = banners[currentIndex].bg;
        bannerTitle.innerHTML = banners[currentIndex].title;
        bannerTitle.style.fontSize = '32px';
        bannerTitle.style.lineHeight = '1.2';
        bannerTitle.style.textShadow = 'none';
        bannerTextContainer.style.textAlign = 'left';
        bannerTextContainer.style.width = 'auto';
        bannerTextContainer.style.marginLeft = '0px';
                if(bannerImg) {
            bannerImg.style.display = 'block';
            bannerImg.src = banners[currentIndex].img;
            bannerImg.style.right = banners[currentIndex].right || '0px';
            bannerImg.style.bottom = banners[currentIndex].bottom || '0px';
            bannerImg.style.height = banners[currentIndex].height || '200px'; // <-- Tambahkan baris ini
        }
        if (katalogTitle) {
            const namaJurusan = banners[currentIndex].title.replace('WELCOME TO TEFA ', '');
            katalogTitle.textContent = "{{ __('messages.catalog_title_prefix') }}" + namaJurusan;
        }
    }

    btnNext.addEventListener('click', function() {
        if (isSemuaJurusan) {
            window.location.href = `/katalog?kategori=0`;
        } else {
            if (currentIndex >= banners.length - 1) {
                window.location.href = `/katalog?kategori=all`;
            } else {
                currentIndex++;
                window.location.href = `/katalog?kategori=${currentIndex}`;
            }
        }
    });

    btnPrev.addEventListener('click', function() {
        if (isSemuaJurusan) {
            window.location.href = `/katalog?kategori=${banners.length - 1}`;
        } else {
            if (currentIndex <= 0) {
                window.location.href = `/katalog?kategori=all`;
            } else {
                currentIndex--;
                window.location.href = `/katalog?kategori=${currentIndex}`;
            }
        }
    });
</script>
@endsection