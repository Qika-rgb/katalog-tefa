<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog TEFA - SMKN 4 Tanjungpinang</title>

    <!-- FONT & ICON -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS UTAMA -->
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        
        <!-- 1. LOGO -->
        <div class="nav-brand">
            <a href="/">
                <img src="<?php echo e(asset('images/logo_tefa.png')); ?>" alt="Logo TEFA">
            </a>
        </div>

        <!-- 2. MENU UTAMA -->
        <ul class="nav-menu">
            <li><a href="/" class="<?php echo e(request()->is('/') ? 'active' : ''); ?>">HOME</a></li>

            <!-- MENU KATALOG DENGAN DROPDOWN -->
            <li class="nav-dropdown">
                <a href="/katalog?kategori=all" class="nav-dropdown-toggle <?php echo e(request()->is('katalog*') ? 'active' : ''); ?>">
                    KATALOG <i class="fa-solid fa-chevron-down"></i>
                </a>
                <ul class="nav-dropdown-menu">
                    <li><a href="/katalog?kategori=all">Semua Jurusan</a></li>
                    <li><a href="/katalog?kategori=0">Rekayasa Perangkat Lunak (RPL)</a></li>
                    <li><a href="/katalog?kategori=1">Animasi</a></li>
                    <li><a href="/katalog?kategori=2">Teknik Komputer & Jaringan (TKJ)</a></li>
                    <li><a href="/katalog?kategori=3">PSPT</a></li>
                    <li><a href="/katalog?kategori=4">Desain Komunikasi Visual (DKV)</a></li>
                    <li><a href="/katalog?kategori=5">Pengembangan Gim</a></li>
                </ul>
            </li>

            <li><a href="/status" class="<?php echo e(request()->is('status*') ? 'active' : ''); ?>">STATUS</a></li>
            <li><a href="/portofolio" class="<?php echo e(request()->is('portofolio*') ? 'active' : ''); ?>">PORTOFOLIO</a></li>
        </ul>

        <!-- 3. ICON & AUTH -->
        <div class="nav-icons" style="align-items: center; display: flex; gap: 20px;">
            <a href="/keranjang" style="color: #000;"><i class="fa-solid fa-cart-shopping"></i></a>
            
            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" style="color: #000;" title="Login / Register"><i class="fa-regular fa-circle-user"></i></a>
            <?php else: ?>
                <a href="<?php echo e(url('/dashboard')); ?>" style="color: #000;" title="Masuk ke Dashboard"><i class="fa-regular fa-circle-user"></i></a>
                
                <form method="POST" action="<?php echo e(route('logout')); ?>" style="margin: 0; display: flex; align-items: center;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" style="background: transparent; border: none; padding: 0; color: #dc2626; font-size: 20px; cursor: pointer;" title="Logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            <?php endif; ?>

            <a href="/customer-service" style="color: #000;"><i class="fa-solid fa-headset"></i></a>
        </div>

    </nav>

    <!-- AREA KONTEN -->
    <?php echo $__env->yieldContent('content'); ?>

</body>
</html><?php /**PATH C:\xampp\htdocs\katalog-tefa\resources\views/layouts/frontend.blade.php ENDPATH**/ ?>