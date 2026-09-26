<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Service</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">

    <div class="user-cs-wrapper">
        <div class="user-cs-card">
            
            <!-- HEADER -->
            <div class="user-cs-header">
                <!-- Tombol Back mengarah ke halaman Home -->
                <a href="/" class="back-btn"><i class="fa-solid fa-chevron-left"></i></a>
                
                <div class="cs-title">
                    <img src="{{ asset('images/foto_profil.png') }}" alt="CS Avatar">
                    <h2>CUSTOMER SERVICE</h2>
                </div>
                
                <a href="#" class="history-btn"><i class="fa-solid fa-clipboard-list"></i></a>
            </div>

            <!-- AREA CHAT (BODY) -->
            <div class="user-cs-body" id="chat-container-pesan">
                
                <!-- Pesan Otomatis Bot / Admin -->
                <div class="cs-bot-msg">
                    <p><span class="text-red">Hai Baniiuhuy,</span><br>
                    Boleh minta Tolong jelaskan kendala yang kamu alami?</p>
                    
                    <!-- Pilihan Pertanyaan -->
                    <button type="button" class="cs-preset-btn" onclick="kirimPreset(this)">Kenapa status pemesanan saya belum berubah?</button>
                    <button type="button" class="cs-preset-btn" onclick="kirimPreset(this)">Bagaimana cara saya mau meng update no lama saya ke nomor yang baru</button>
                    <button type="button" class="cs-preset-btn" onclick="kirimPreset(this)">Mengapa saya tidak bisa login ke akun lama saya?</button>
                </div>

                @foreach ($messages as $message)
                    <div class="{{ $message->sender === 'admin' ? 'cs-bot-msg' : 'cs-user-msg' }}">
                        {{ $message->message }}
                    </div>
                @endforeach  
            </div>

            <!-- INPUT CHAT (FOOTER) -->
            <form action="/chat/send" method="POST" class="user-cs-footer">
                @csrf

                <input type="hidden" name="user_id" value="{{ $room_id ?? 1 }}">
                <input type="hidden" name="sender" value="user">

                <button type="button" class="add-btn"><i class="fa-solid fa-plus"></i></button>

                <input
                    type="text"
                    name="message"
                    placeholder="selamat datang! ada yang bisa saya bantu ??"
                    autocomplete="off"
                    required
                >

                <button type="submit" class="send-btn"><i class="fa-regular fa-paper-plane"></i></button>

            </form>

        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const roomId = "{{ $room->id ?? ($room_id ?? 1) }}"; 

        function loadPesanOtomatis() {
            fetch('/chat/fetch/' + roomId)
                .then(response => response.json())
                .then(data => {
                    let chatContainer = document.getElementById('chat-container-pesan'); 
                    if (!chatContainer) return;

                    let isScrolledToBottom = chatContainer.scrollHeight - chatContainer.clientHeight <= chatContainer.scrollTop + 10;

                    let htmlContent = `
                        <div class="cs-bot-msg">
                            <p><span class="text-red">Hai Baniiuhuy,</span><br>
                            Boleh minta Tolong jelaskan kendala yang kamu alami?</p>
                            <button type="button" class="cs-preset-btn" onclick="kirimPreset(this)">Kenapa status pemesanan saya belum berubah?</button>
                            <button type="button" class="cs-preset-btn" onclick="kirimPreset(this)">Bagaimana cara saya mau meng update no lama saya ke nomor yang baru</button>
                            <button type="button" class="cs-preset-btn" onclick="kirimPreset(this)">Mengapa saya tidak bisa login ke akun lama saya?</button>
                        </div>
                    `;

                    data.forEach(pesan => {
                        let senderClass = (pesan.sender === 'admin') ? 'cs-bot-msg' : 'cs-user-msg';
                        
                        htmlContent += `
                            <div class="${senderClass}">
                                ${pesan.message}
                            </div>
                        `;
                    });

                    chatContainer.innerHTML = htmlContent;

                    if (isScrolledToBottom) {
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                    }
                })
                .catch(error => console.error('Gagal memuat pesan:', error));
        }

        setInterval(loadPesanOtomatis, 2000);
    });
    </script>

</body>
</html>