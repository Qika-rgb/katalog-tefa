<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Service - Chat</title>
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
            <li><a href="/admin-pusat/status">PRODUCT REPORT</a></li>
            <li>
                <div class="red-dot"></div>
                <a href="/admin-pusat/chat" class="active-cs active-black-line">CUSTOMER SERVICE</a>
            </li>
            <li><a href="/admin-pusat/verifikasi">VERIFIKASI PESAN</a></li>
            <li><a href="/admin-pusat/status-pesanan">STATUS</a></li>
            <li><a href="/admin-pusat/done">DONE</a></li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="admin-main">
        
        <!-- Top Profile -->
        <div class="admin-top-profile">
            <div class="profile-pill">
                <img src="{{ asset('images/foto_profil.png') }}" alt="Avatar">
                Customer Service
            </div>
        </div>

        <!-- Main Header -->
        <div class="admin-header-row">
            <h1>CUSTOMER SERVICE</h1>
            <div class="header-actions">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <i class="fa-regular fa-envelope"></i>
                <span class="year-badge">2026</span>
            </div>
        </div>

        <!-- WADAH UTAMA CHAT -->
        <div class="chat-wrapper">
            
            <!-- KIRI: Daftar Pelanggan -->
            <div class="chat-sidebar">
                <div class="contact-item">
                    <img src="{{ asset('images/foto_profil.png') }}" alt="Avatar" class="contact-avatar">
                    <span class="contact-name">CUSTOMER TOTE BAG</span>
                </div>

                <div class="contact-item">
                    <div class="chat-red-dot"></div>
                    <img src="{{ asset('images/foto_profil.png') }}" alt="Avatar" class="contact-avatar">
                    <span class="contact-name">CUSTOMER WEB</span>
                </div>
            </div>

            <!-- KANAN: Jendela Obrolan -->
            <div class="chat-main">
                <div class="chat-header">
                    <img src="{{ asset('images/foto_profil.png') }}" alt="Avatar" class="contact-avatar">
                    <span class="contact-name">CUSTOMER TOTE BAG</span>
                </div>

                <div class="chat-body">
                    <div class="chat-bubble bubble-left">
                        <img src="{{ asset('images/foto_profil.png') }}" alt="Avatar" class="contact-avatar">
                        <div class="chat-text">
                            kenapa status pemesanan saya belum berubah?
                        </div>
                    </div>
                </div>

                <div class="chat-input-area">
                    <input type="text" class="chat-input" placeholder="TYPE HERE">
                    <button class="btn-send"><i class="fa-regular fa-paper-plane"></i></button>
                </div>
            </div>
        </div> 
    </div> 
</body>
</html>