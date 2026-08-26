@extends('layouts.app')

@section('content')
<div class="container">

    <!-- 1. DKV (Gambar di Kanan) -->
    <div class="row">
        <div class="text-content">
            <h2>TEFA<br>DESAIN KOMUNIKASI VISUAL</h2>
            <p>Membangun fondasi digital yang tangguh, aman, dan terintegrasi. Dari perakitan perangkat keras, manajemen jaringan komputer, hingga konfigurasi server, kami siap menghadirkan solusi infrastruktur IT yang handal dan berstandar industri.</p>
            <a href="/katalog" class="btn-dark">FOR DETAIL GO TO KATALOG</a>
        </div>
        <div class="img-content">
            <!-- Menggunakan gambar yang sudah kamu rename sebelumnya -->
            <img src="{{ asset('images/tefa_dkv.png') }}" alt="Ilustrasi DKV">
        </div>
    </div>

    <!-- 2. GAME (Gambar di Kiri -> class "reverse") -->
    <div class="row reverse">
        <div class="text-content">
            <h2>TEFA<br>PENGEMBANGAN GIM</h2>
            <p>Membangun fondasi digital yang tangguh, aman, dan terintegrasi. Dari perakitan perangkat keras, manajemen jaringan komputer, hingga konfigurasi server, kami siap menghadirkan solusi infrastruktur IT yang handal dan berstandar industri.</p>
            <a href="/katalog" class="btn-dark">FOR DETAIL GO TO KATALOG</a>
        </div>
        <div class="img-content">
            <img src="{{ asset('images/tefa_gim.png') }}" alt="Ilustrasi Game">
        </div>
    </div>

    <!-- 3. TKJ (Gambar di Kanan) -->
    <div class="row">
        <div class="text-content">
            <h2>TEFA<br>TEKNIK KOMPUTER JARINGAN</h2>
            <p>Membangun fondasi digital yang tangguh, aman, dan terintegrasi. Dari perakitan perangkat keras, manajemen jaringan komputer, hingga konfigurasi server, kami siap menghadirkan solusi infrastruktur IT yang handal dan berstandar industri.</p>
            <a href="/katalog" class="btn-dark">FOR DETAIL GO TO KATALOG</a>
        </div>
        <div class="img-content">
            <img src="{{ asset('images/tefa_tkj.png') }}" alt="Ilustrasi TKJ">
        </div>
    </div>

    <!-- 4. RPL (Gambar di Kiri) -->
    <div class="row reverse">
        <div class="text-content">
            <h2>TEFA<br>REKAYASA PERANGKAT LUNAK</h2>
            <p>Menerjemahkan ide dan logika menjadi solusi digital yang fungsional, efisien, dan andal. Dari perancangan sistem, pengembangan aplikasi web dan seluler, hingga manajemen basis data, kami siap menghadirkan produk perangkat lunak berstandar industri.</p>
            <a href="/katalog" class="btn-dark">FOR DETAIL GO TO KATALOG</a>
        </div>
        <div class="img-content">
            <img src="{{ asset('images/tefa_rpl.png') }}" alt="Ilustrasi RPL">
        </div>
    </div>

    <!-- 5. PSPT (Gambar di Kanan) -->
    <div class="row">
        <div class="text-content">
            <h2>TEFA<br>PRODUK SIARAN PROGRAM TELEVISI</h2>
            <p>Menghidupkan cerita di layar kaca melalui produksi audio-visual yang kreatif, dinamis, dan berkualitas tinggi. Dari tahap pra-produksi, produksi di studio maupun lapangan, hingga pasca-produksi, kami siap menghadirkan tayangan visual yang bernyawa dan berstandar industri.</p>
            <a href="/katalog" class="btn-dark">FOR DETAIL GO TO KATALOG</a>
        </div>
        <div class="img-content">
            <img src="{{ asset('images/tefa_pspt.png') }}" alt="Ilustrasi PSPT">
        </div>
    </div>

    <!-- 6. ANIMASI (Gambar di Kiri) -->
    <div class="row reverse">
        <div class="text-content">
            <h2>TEFA<br>ANIMASI</h2>
            <p>Menghidupkan karakter dan imajinasi melalui gerakan visual yang dinamis dan ekspresif. Dari pembuatan konsep, pemodelan objek, hingga teknik animasi 2D dan 3D, kami siap menghadirkan cerita interaktif yang memukau dan berstandar industri.</p>
            <a href="/katalog" class="btn-dark">FOR DETAIL GO TO KATALOG</a>
        </div>
        <div class="img-content">
            <img src="{{ asset('images/tefa_animasi.png') }}" alt="Ilustrasi Animasi">
        </div>
    </div>

</div>
@endsection