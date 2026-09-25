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
            <!-- Menu Product Report -->
            <li>
                <a href="/admin-pusat/product-report" class="{{ request()->is('admin-pusat/product-report') ? 'active-cs active-black-line' : '' }}">PRODUCT REPORT</a>
            </li>
            
            <!-- Menu Customer Service -->
            <li>
                @if(isset($unread_chat) && $unread_chat > 0)
                    <div class="red-dot"></div>
                @endif
                <a href="/admin-pusat/chat" class="{{ request()->is('admin-pusat/chat') ? 'active-cs active-black-line' : '' }}">CUSTOMER SERVICE</a>
            </li>

            <!-- Menu Verifikasi Pesan -->
            <li>
                <a href="/admin-pusat/verifikasi" class="{{ request()->is('admin-pusat/verifikasi') ? 'active-cs active-black-line' : '' }}">VERIFIKASI PESAN</a>
            </li>
            
            <!-- Menu Status -->
            <li>
                <a href="/admin-pusat/status-pesanan" class="{{ request()->is('admin-pusat/status-pesanan') ? 'active-cs active-black-line' : '' }}">STATUS</a>
            </li>
            
            <!-- Menu Done -->
            <li>
                <a href="/admin-pusat/done" class="{{ request()->is('admin-pusat/done') ? 'active-cs active-black-line' : '' }}">DONE</a>
            </li>
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
                    <span class="contact-name">CUSTOMER WEB</span>
                </div>
            </div>

            <!-- KANAN: Jendela Obrolan -->
            <div class="chat-main">

                <!-- Header -->
                <div class="chat-header">
                    <img src="{{ asset('images/foto_profil.png') }}" alt="Avatar" class="contact-avatar">
                    <span class="contact-name">CUSTOMER WEB</span>
                </div>

                <!-- Chat Body (Looping dari Database) -->
                <div class="chat-body" id="chat-body-container">
                    @foreach($messages as $message)
                        <div class="chat-bubble {{ $message->sender === 'admin' ? 'bubble-right' : 'bubble-left' }}">
                            <img src="{{ asset('images/foto_profil.png') }}" alt="Avatar" class="contact-avatar">
                            <div class="chat-text">
                                {{ $message->message }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Form Input Chat -->
                <form action="/chat/send" method="POST" class="chat-input-area">
                    @csrf
                    <input type="text" name="message" class="chat-input" placeholder="TYPE HERE" autocomplete="off" required>
                    <input type="hidden" name="sender" value="admin">
                    <button type="submit" class="btn-send">
                        <i class="fa-regular fa-paper-plane"></i>
                    </button>
                </form>

            </div> <!-- Penutup chat-main -->

        </div> <!-- Penutup chat-wrapper -->

    </div> <!-- Penutup admin-main -->

    <!-- Script opsional untuk auto-refresh ringan agar real-time chat aman di lokal -->
    <script>
document.addEventListener("DOMContentLoaded", function () {
    // Tentukan room_id / user_id yang sedang aktif (sesuai dengan yang digunakan di sisi customer)
    const roomId = 1; 

    function loadAdminChat() {
        fetch('/chat/fetch/' + roomId)
            .then(response => response.json())
            .then(data => {
                let chatContainer = document.getElementById('chat-body-container'); 
                if (!chatContainer) return;

                let isScrolledToBottom = chatContainer.scrollHeight - chatContainer.clientHeight <= chatContainer.scrollTop + 10;

                let htmlContent = '';

                data.forEach(pesan => {
                    // Jika sender === 'admin', bubble di kanan (bubble-right), jika bukan di kiri (bubble-left)
                    let senderClass = (pesan.sender === 'admin') ? 'bubble-right' : 'bubble-left';
                    
                    htmlContent += `
                        <div class="chat-bubble ${senderClass}">
                            <img src="{{ asset('images/foto_profil.png') }}" alt="Avatar" class="contact-avatar">
                            <div class="chat-text">
                                ${pesan.message}
                            </div>
                        </div>
                    `;
                });

                chatContainer.innerHTML = htmlContent;

                // Auto scroll ke bawah jika sebelumnya posisi scroll berada di bawah
                if (isScrolledToBottom) {
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                }
            })
            .catch(error => console.error('Gagal memuat pesan admin:', error));
    }

    // Jalankan polling setiap 2 detik
    setInterval(loadAdminChat, 2000);
});
</script>
</body>
</html>