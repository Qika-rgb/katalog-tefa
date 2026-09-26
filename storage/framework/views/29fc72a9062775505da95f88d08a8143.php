<?php $__env->startSection('content'); ?>
<div class="portfolio-wrapper">
    <div class="portfolio-header">
        <h1>PORTOFOLIO TEFA</h1>
        <p>Karya dan proyek unggulan karya siswa-siswi SMKN 4 Tanjungpinang dari berbagai program keahlian.</p>
    </div>

    <!-- Filter Tabs dengan Logo Jurusan -->
    <div class="filter-tabs">
        <a href="<?php echo e(url('/portofolio')); ?>" class="filter-tab tab-all <?php echo e($kategoriAktif == 'all' ? 'active' : ''); ?>">
            <i class="fa-solid fa-shapes"></i>
            <span>Semua</span>
        </a>

        <?php $__currentLoopData = $daftarJurusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jurusan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $adaLogo = file_exists(public_path('images/' . $jurusan['logo']));
            ?>
            <a href="<?php echo e(url('/portofolio?kategori=' . $jurusan['id'])); ?>" class="filter-tab <?php echo e((string)$kategoriAktif === (string)$jurusan['id'] ? 'active' : ''); ?>">
                <?php if($adaLogo): ?>
                    <img src="<?php echo e(asset('images/' . $jurusan['logo'])); ?>" alt="<?php echo e($jurusan['nama']); ?>" class="filter-tab-img">
                <?php else: ?>
                    <span class="filter-tab-icon">
                        <i class="fa-solid fa-network-wired"></i>
                    </span>
                <?php endif; ?>
                <span><?php echo e($jurusan['nama']); ?></span>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Area Card Portofolio dari Database -->
    <?php if($portofolios->count() > 0): ?>
        <div class="portfolio-grid">
            <?php
                $namaJurusan = [
                    '0' => ['nama' => 'RPL', 'badge' => 'badge-rpl'],
                    '4' => ['nama' => 'DKV', 'badge' => 'badge-dkv'],
                    '2' => ['nama' => 'TKJ', 'badge' => 'badge-tkj'],
                    '1' => ['nama' => 'Animasi', 'badge' => 'badge-animasi'],
                    '3' => ['nama' => 'PSPT', 'badge' => 'badge-pspt'],
                    '5' => ['nama' => 'Gim', 'badge' => 'badge-gim'],
                ];
            ?>

            <?php $__currentLoopData = $portofolios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $info = $namaJurusan[$item->kategori_id] ?? ['nama' => 'TEFA', 'badge' => 'badge-rpl'];
                ?>
                <div class="portfolio-card">
                    <div class="card-thumb">
                        <img src="<?php echo e(asset('storage/' . $item->gambar)); ?>" alt="<?php echo e($item->judul); ?>">
                        <span class="badge-jurusan <?php echo e($info['badge']); ?>"><?php echo e($info['nama']); ?></span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title"><?php echo e($item->judul); ?></h3>
                        <p class="card-desc"><?php echo e($item->deskripsi); ?></p>
                        <div class="card-footer">
                            <div class="author-info">
                                <i class="fa-solid fa-users-gear"></i>
                                <span><?php echo e($item->pembuat); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="fa-regular fa-folder-open"></i>
            <p>Belum ada portofolio untuk kategori ini.</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\katalog-tefa\resources\views/portofolio.blade.php ENDPATH**/ ?>