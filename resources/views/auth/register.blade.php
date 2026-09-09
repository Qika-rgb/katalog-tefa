<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - TEFA</title>
    <!-- Import Font dari Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Import Ikon dari FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Memanggil file CSS Eksternal -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

    <!-- BACKGROUND VIDEO -->
    <video autoplay loop muted playsinline class="bg-video">
        <source src="{{ asset('videos/bg-login.mp4') }}" type="video/mp4">
    </video>
    <div class="video-overlay"></div>

    <div class="card" style="position: relative; z-index: 1; padding: 30px;">
        <div class="avatar">
            <i class="fa-solid fa-user"></i>
        </div>

        <h2>Sign up with email</h2>
        <p class="subtitle">make a new doc to bring your words, data<br>and teams together. for free</p>

        <!-- Tampilkan Error Jika Pendaftaran Gagal -->
        @if ($errors->any())
            <div style="color: red; font-size: 12px; margin-bottom: 10px; text-align: center;">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- BREEZE REGISTER ROUTE -->
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <!-- NAME (WAJIB UNTUK BREEZE) -->
            <div class="input-group" style="margin-bottom: 15px;">
                <i class="fa-solid fa-user icon-left"></i>
                <input type="text" name="name" placeholder="your name" value="{{ old('name') }}" required autofocus>
            </div>

            <!-- EMAIL -->
            <div class="input-group" style="margin-bottom: 15px;">
                <i class="fa-regular fa-envelope icon-left"></i>
                <input type="email" name="email" placeholder="your email" value="{{ old('email') }}" required>
            </div>

            <!-- PASSWORD -->
            <div class="input-group" style="margin-bottom: 15px;">
                <i class="fa-solid fa-key icon-left"></i>
                <input type="password" name="password" id="password" placeholder="your password" required>
                <i class="fa-regular fa-eye-slash icon-right" id="togglePassword"></i>
            </div>

            <!-- CONFIRM PASSWORD (WAJIB UNTUK BREEZE) -->
            <div class="input-group" style="margin-bottom: 15px;">
                <i class="fa-solid fa-lock icon-left"></i>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="confirm password" required>
            </div>

            <div class="links">
                <a href="{{ route('login') }}" class="text-green">Already have account?</a>
            </div>

            <button type="submit" class="btn-main">Get Started</button>
        </form>

        <div class="divider">or sign up with</div>

        <div class="social-buttons">
            <button class="btn-social"><i class="fa-brands fa-google"></i></button>
            <button class="btn-social"><i class="fa-brands fa-facebook"></i></button>
            <button class="btn-social"><i class="fa-brands fa-apple"></i></button>
        </div>
    </div>

    <!-- SCRIPT SHOW/HIDE PASSWORD -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>