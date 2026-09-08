<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TEFA</title>
    <!-- FONT POPPINS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS UTAMA -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="login-body">

        <!-- =========================================
            BACKGROUND VIDEO & OVERLAY
        ========================================== -->
        <!-- Tambahan atribut poster="...bg-login.jpg" sebagai gambar cadangan -->
        <video autoplay loop muted playsinline style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0;">
            <source src="{{ asset('videos/bg-login.mp4') }}" type="video/mp4">
        </video>
        
        <!-- Lapisan tipis agar kotak form tetap terbaca jelas -->
        <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.4); z-index: 1;"></div>
    <div class="login-page">
        <!-- BACKGROUND PATTERN LAMA (Bisa dipertahankan atau dihapus, efeknya tertutup video) -->
        <div class="login-background"></div>

        <div class="login-card">
            <!-- USER ICON -->
            <div class="login-avatar">
                <i class="fa-solid fa-user"></i>
            </div>

            <div class="login-title">
                <h1>login</h1>
            </div>

            <!-- Tampilkan Error Jika Login Gagal -->
            @if ($errors->any())
                <div style="color: red; font-size: 12px; margin-bottom: 10px; text-align: center;">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- BREEZE LOGIN ROUTE -->
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- EMAIL -->
                <div class="login-input-box">
                    <i class="fa-solid fa-user"></i>
                    <input
                        type="email"
                        name="email"
                        placeholder="your email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                </div>

                <!-- PASSWORD -->
                <div class="login-input-box">
                    <i class="fa-solid fa-key"></i>
                    <input
                        type="password"
                        name="password"
                        id="loginPassword"
                        placeholder="your password"
                        required
                    >
                    <!-- SHOW PASSWORD -->
                    <i class="fa-regular fa-eye" id="toggleLoginPassword" title="Show password"></i>
                </div>

                <!-- REMEMBER & FORGOT PASSWORD -->
                <div class="login-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}">forgot password?</a>
                </div>

                <!-- LOGIN BUTTON -->
                <button type="submit" class="login-button">login</button>
            </form>

            <div class="or-login">
                <span>or continue with</span>
            </div>

            <!-- SOCIAL LOGIN -->
            <div class="social-login">
                <button type="button" class="social-button" aria-label="Login with Google">
                    <i class="fa-brands fa-google google-icon"></i>
                </button>
                <button type="button" class="social-button" aria-label="Login with Facebook">
                    <i class="fa-brands fa-facebook facebook-icon"></i>
                </button>
                <button type="button" class="social-button" aria-label="Login with Apple">
                    <i class="fa-brands fa-apple apple-icon"></i>
                </button>
            </div>

            <!-- REGISTER LINK -->
            <div class="register-link">
                <span>Don't have an account?</span>
                <a href="{{ route('register') }}">sign up here</a>
            </div>
        </div>
    </div>

    <!-- SCRIPT SHOW/HIDE PASSWORD -->
    <script>
        const toggleLoginPassword = document.getElementById('toggleLoginPassword');
        const loginPassword = document.getElementById('loginPassword');

        if (toggleLoginPassword && loginPassword) {
            toggleLoginPassword.addEventListener('click', function () {
                if (loginPassword.type === 'password') {
                    loginPassword.type = 'text';
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                    this.setAttribute('title', 'Hide password');
                } else {
                    loginPassword.type = 'password';
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                    this.setAttribute('title', 'Show password');
                }
            });
        }
    </script>
</body>
</html>