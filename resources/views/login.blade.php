<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Katalog Tefa</title>
    
    <!-- Import Font Poppins & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Memanggil file auth.css milikmu -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

    <!-- BACKGROUND VIDEO & OVERLAY -->
    <video autoplay muted loop class="bg-video">
        <source src="{{ asset('videos/bg-login.mp4') }}" type="video/mp4">
        Browser kamu tidak mendukung tag video.
    </video>
    <div class="video-overlay"></div>

    <!-- KOTAK LOGIN -->
    <div class="card">
        
        <!-- Avatar Atas -->
        <div class="avatar">
            <i class="fa-solid fa-user-lock"></i>
        </div>

        <!-- Judul & Subjudul -->
        <h2>Welcome Back</h2>
        <p class="subtitle">Please enter your details to sign in</p>

        <!-- Form Login -->
        <form action="#" method="POST">
            <!-- CSRF Token (Wajib di Laravel nanti) -->
            <!-- @csrf -->

            <!-- Input Username/Email -->
            <div class="input-group">
                <i class="fa-solid fa-envelope icon-left"></i>
                <input type="email" placeholder="Email or Username" required>
            </div>

            <!-- Input Password -->
            <div class="input-group">
                <i class="fa-solid fa-lock icon-left"></i>
                <input type="password" placeholder="Password" id="passwordInput" required>
                <!-- Ikon mata untuk show/hide password -->
                <i class="fa-solid fa-eye-slash icon-right" id="togglePassword"></i>
            </div>

            <!-- Teks Link (Sign Up & Forgot Password) -->
            <div class="links">
                <a href="/register" class="text-green">Create Account</a>
                <a href="#" class="text-black">Forgot Password?</a>
            </div>

            <!-- Tombol Utama -->
            <button type="submit" class="btn-main">LOGIN</button>
        </form>

        <!-- Garis Pemisah -->
        <div class="divider">- Or sign in with -</div>

        <!-- Tombol Sosial Media -->
        <div class="social-buttons">
            <button type="button" class="btn-social">
                <i class="fa-brands fa-google"></i>
            </button>
            <button type="button" class="btn-social">
                <i class="fa-brands fa-facebook"></i>
            </button>
            <button type="button" class="btn-social">
                <i class="fa-brands fa-apple"></i>
            </button>
        </div>

    </div> <!-- End Card -->

    <!-- Script sederhana untuk fitur Show/Hide Password -->
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');

        togglePassword.addEventListener('click', function () {
            // Ubah tipe input antara text dan password
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Ubah ikon mata
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>