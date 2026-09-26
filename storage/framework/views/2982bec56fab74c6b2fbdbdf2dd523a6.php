<?php $__env->startSection('content'); ?>
<div class="katalog-wrapper">

    <!-- BAGIAN BANNER -->
    <div class="banner-container">
        <i class="fa-solid fa-chevron-left banner-arrow" id="prevBanner"></i>
        
        <div class="banner-content" id="bannerBg">
            <div class="banner-text" id="bannerTextContainer">
                <h1 id="bannerTitle">WELCOME TO TEFA REKAYASA PERANGKAT LUNAK</h1>
            </div>
            
            <img src="<?php echo e(asset('images/icon_rpl.png')); ?>" alt="Banner Icon" class="banner-img" id="bannerImg">
        </div>

        <i class="fa-solid fa-chevron-right banner-arrow" id="nextBanner"></i>
    </div>

    <!-- JUDUL KATALOG -->
    <h2 class="katalog-section-title">CATALOG SEMUA PRODUK</h2>

    <!-- GRID PRODUK DARI DATABASE -->
    <div class="product-grid">
        <?php if(isset($produks) && count($produks) > 0): ?>
            <?php $__currentLoopData = $produks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $mediaFile = $item->vidio ?? $item->foto ?? 'default.png';
                    $extension = strtolower(pathinfo($mediaFile, PATHINFO_EXTENSION));

                    if (str_contains($mediaFile, 'produk/') || str_contains($mediaFile, 'portofolio/')) {
                        $mediaUrl = asset('storage/' .$mediaFile);
                    } else {
                        $mediaUrl = asset('images/' .$mediaFile);
                    }
                ?>

                <div class="product-card" data-kategori="<?php echo e($item->kategori_id ?? ''); ?>">
                    <!-- Kotak Media -->
                    <div class="product-img-wrapper" style="position: relative; background-color: #ffffff; height: 200px; display: flex; align-items: center; justify-content: center; overflow: hidden; padding: 5px;">
                        <?php if(in_array($extension, ['mp4', 'webm', 'ogg', 'mov'])): ?>
                            <video width="100%" height="100%" autoplay loop muted playsinline style="object-fit: cover; width: 100%; height: 100%;">
                                <source src="<?php echo e($mediaUrl); ?>" type="video/mp4">
                                Browser Anda tidak mendukung pemutaran video.
                            </video>
                        <?php else: ?>
                            <img src="<?php echo e($mediaUrl); ?>" alt="<?php echo e($item->nama_produk ?? ''); ?>" style="width: 100%; height: 200px; object-fit: contain;">
                        <?php endif; ?>

                        <a href="/pemesanan/<?php echo e($item->id); ?>" class="btn-order">ORDER NOW</a>
                    </div>

                    <!-- Info Teks -->
                    <div class="product-info">
                        <h3><?php echo e($item->nama_produk ?? ''); ?></h3>
                        <p class="price">
                            RP 
                            <?php
                                $harga = (string)($item->harga ?? 0);
                            ?>
                            <?php if(strpos($harga, '-') !== false): ?>
                                <?php echo e($harga); ?>

                            <?php elseif(is_numeric($item->harga)): ?>
                                <?php echo e(number_format((float)$item->harga, 0, ',', '.')); ?>

                            <?php else: ?>
                                <?php echo e($harga); ?>

                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p style="grid-column: 1 / -1; text-align: center; color: #6b7280; padding: 30px;">Belum ada produk yang tersedia.</p>
        <?php endif; ?>
    </div>

    <!-- TOMBOL PAGINATION -->
    <?php if(isset($produks) && method_exists($produks, 'links')): ?>
        <div class="d-flex justify-content-center mt-4 mb-5">
            <?php echo e($produks->links()); ?>

        </div>
    <?php endif; ?>

</div>

<!-- SCRIPT SLIDER BANNER -->
<script>
    const bannerSemua = {
        title: "WELCOME TO SMKN 4 TANJUNGPINANG",
        img: "<?php echo e(asset('images/icon_sekolah.png')); ?>"
    };

    const banners = [
        { title: "WELCOME TO TEFA REKAYASA PERANGKAT LUNAK", bg: "linear-gradient(to right, #ab6f4f, #e24215)", img: "<?php echo e(asset('images/icon_rpl.png')); ?>" },
        { title: "WELCOME TO TEFA ANIMASI", bg: "linear-gradient(to right, #38bdf8, #08405c)", img: "<?php echo e(asset('images/icon_animasi.png')); ?>" },
        { title: "WELCOME TO TEFA TKJ", bg: "linear-gradient(to right, #34d399, #065139)", img: "<?php echo e(asset('images/icon_tkj.png')); ?>" },
        { title: "WELCOME TO TEFA PSPT", bg: "linear-gradient(to right, #facc15, #573e07)", img: "<?php echo e(asset('images/icon_pspt.png')); ?>" },
        { title: "WELCOME TO TEFA DKV", bg: "linear-gradient(to right, #dc2626, #991b1b)", img: "<?php echo e(asset('images/icon_dkv2.png')); ?>" },
        { title: "WELCOME TO TEFA PENGEMBANGAN GIM", bg: "linear-gradient(to right, #4f46e5, #090542)", img: "<?php echo e(asset('images/icon_gim.png')); ?>" }
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
        bannerBg.style.background = `linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('${bannerSemua.img}') center 20%/cover no-repeat`;
        bannerTitle.textContent = bannerSemua.title;
        bannerTitle.style.textShadow = '2px 2px 10px rgba(0,0,0,0.8)';
        bannerTextContainer.style.textAlign = 'center';
        bannerTextContainer.style.width = '100%';
        if(bannerImg) bannerImg.style.display = 'none';
        if (katalogTitle) katalogTitle.textContent = "CATALOG SEMUA PRODUK";
    } else {
        isSemuaJurusan = false;
        currentIndex = parseInt(kategoriParam);
        bannerBg.style.background = banners[currentIndex].bg;
        bannerTitle.textContent = banners[currentIndex].title;
        bannerTitle.style.textShadow = 'none';
        bannerTextContainer.style.textAlign = 'left';
        bannerTextContainer.style.width = 'auto';
        if(bannerImg) {
            bannerImg.style.display = 'block';
            bannerImg.src = banners[currentIndex].img;
        }
        if (katalogTitle) {
            const namaJurusan = banners[currentIndex].title.replace('WELCOME TO TEFA ', '');
            katalogTitle.textContent = "CATALOG " + namaJurusan;
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\katalog-tefa\resources\views/katalog.blade.php ENDPATH**/ ?>