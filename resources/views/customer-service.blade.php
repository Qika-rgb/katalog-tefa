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
            <div class="user-cs-body">
                
                <!-- Pesan Otomatis Bot / Admin -->
                <div class="cs-bot-msg">
                    <p><span class="text-red">Hai Baniiuhuy,</span><br>
                    Boleh minta Tolong jelaskan kendala yang kamu alami?</p>
                    
                    <!-- Pilihan Pertanyaan -->
                    <button type="button" class="cs-preset-btn" onclick="kirimPreset(this)">Kenapa status pemesanan saya belum berubah?</button>
                    <button type="button" class="cs-preset-btn" onclick="kirimPreset(this)">Bagaimana cara saya mau meng update no lama saya ke nomor yang baru</button>
                    <button type="button" class="cs-preset-btn" onclick="kirimPreset(this)">Mengapa saya tidak bisa login ke akun lama saya?</button>
                </div>

               @foreach($messages as $message)
            <div class="{{ $message->sender === 'admin' ? 'cs-bot-msg' : 'cs-user-msg' }}">
                {{ $message->message }}
            </div>
                @endforeach  
            </div>

            <!-- INPUT CHAT (FOOTER) -->
            <form action="/chat/send" method="POST" class="user-cs-footer">
                @csrf

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
    function kirimPreset(btn) {
        const teks = btn.innerText;
        const input = document.querySelector('.user-cs-footer input[name="message"]');
        input.value = teks;
        document.querySelector('.user-cs-footer').submit();
    }
    </script>

</body>
</html>