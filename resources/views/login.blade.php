<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Memanggil CSS yang sama dengan halaman Register! -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

    <!-- ========================================== -->
    <!-- KODE BACKGROUND VIDEO MULAI DI SINI        -->
    <!-- ========================================== -->
    <video autoplay loop muted playsinline class="bg-video">
        <!-- Pastikan file bg-login.mp4 sudah ada di dalam folder public/videos/ -->
        <source src="{{ asset('videos/bg-login.mp4') }}" type="video/mp4">
    </video>
    <div class="video-overlay"></div>
    <!-- ========================================== -->

    <!-- Tambahkan style inline z-index agar kartu login berada di atas video -->
    <div class="card" style="position: relative; z-index: 1;">
        
        <!-- Avatar (jarak bawah diperbesar karena tidak ada judul) -->
        <div class="avatar" style="margin-bottom: 35px;">
            <i class="fa-solid fa-user"></i>
        </div>

        <form action="#" method="POST">
    @csrf
            <!-- Input Username/Email -->
            <div class="input-group">
                <i class="fa-solid fa-user icon-left"></i>
               <input type="text" name="email" placeholder="username or email">
            </div>

            <div class="input-group">
                <i class="fa-solid fa-key icon-left"></i>
                <!-- Tambahkan id="password" di sini -->
                <input type="password" name="password" id="password" placeholder="your password">
                <!-- Tambahkan id="togglePassword" di sini -->
                <i class="fa-regular fa-eye-slash icon-right" id="togglePassword"></i>
            </div>

            <!-- Remember me & Forget password -->
            <div class="links" style="align-items: center;">
                <label style="display: flex; align-items: center; gap: 5px; cursor: pointer; color: #888;">
                    <!-- Checkbox asli disembunyikan pakai CSS, tapi tetap bisa diklik berkat tag <label> -->
                    <input type="checkbox" id="rememberCheckbox" style="display: none;" checked>
                    
                    <!-- Ikon ini yang akan kita ubah-ubah dengan JS -->
                    <i class="fa-solid fa-circle-check" id="rememberIcon" style="color: #28a745; font-size: 16px;"></i> 
                    remember me
                </label>
                
                <a href="/forgot-password" class="text-black">forget password?</a>
            </div>

            <button type="submit" class="btn-main">login</button>
        </form>

        <div class="divider">or continue with</div>

        <div class="social-buttons" style="margin-bottom: 25px;">
            <button class="btn-social"><i class="fa-brands fa-google"></i></button>
            <button class="btn-social"><i class="fa-brands fa-facebook"></i></button>
            <button class="btn-social"><i class="fa-brands fa-apple"></i></button>
        </div>

        <!-- Teks Link Bawah (Warna Hijau dan Oranye) -->
        <div style="font-size: 11px; font-weight: 700; display: flex; justify-content: space-between;">
            <a href="/register" style="color: #28a745; text-decoration: none;">don't have account yet?</a>
            <a href="/register" style="color: #ff5722; text-decoration: none;">or sign in here</a>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // Ubah tipe input dari password ke text, dan sebaliknya
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // Ubah ikon mata (silang ke terbuka)
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // --- KODE BARU UNTUK REMEMBER ME ---
        const rememberCheckbox = document.querySelector('#rememberCheckbox');
        const rememberIcon = document.querySelector('#rememberIcon');

        // Mendengarkan perubahan pada checkbox tersembunyi
        rememberCheckbox.addEventListener('change', function () {
            if (this.checked) {
                // Jika dicentang: ikon hijau dan centang
                rememberIcon.className = 'fa-solid fa-circle-check';
                rememberIcon.style.color = '#28a745'; // warna hijau
            } else {
                // Jika tidak dicentang: ikon abu-abu dan bulat kosong
                rememberIcon.className = 'fa-regular fa-circle';
                rememberIcon.style.color = '#999'; // warna abu-abu
            }
        });
    </script>

</body>
</html>