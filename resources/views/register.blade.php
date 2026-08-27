<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Import Font dari Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Import Ikon dari FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Memanggil file CSS Eksternal -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

    <!-- ========================================== -->
    <!-- KODE BACKGROUND VIDEO MULAI DI SINI        -->
    <!-- ========================================== -->
    <video autoplay loop muted playsinline class="bg-video">
        <source src="{{ asset('videos/bg-login.mp4') }}" type="video/mp4">
    </video>
    <div class="video-overlay"></div>
    <!-- ========================================== -->

    <!-- Tambahkan style inline z-index agar kartu form berada di atas video -->
    <div class="card" style="position: relative; z-index: 1;">
        <div class="avatar">
            <i class="fa-solid fa-user"></i>
        </div>

        <h2>Sign up with email</h2>
        <p class="subtitle">make a new doc to bring your words, data<br>and teams together.for free</p>

       <form action="#" method="POST">
    @csrf
            <div class="input-group">
                <i class="fa-regular fa-envelope icon-left"></i>
                <input type="email" name="email" placeholder="your email">
            </div>

            <div class="input-group">
                <i class="fa-solid fa-key icon-left"></i>
                <!-- Tambahkan id="password" di sini -->
                <input type="password" name="password" id="password" placeholder="your password">
                <!-- Tambahkan id="togglePassword" di sini -->
                <i class="fa-regular fa-eye-slash icon-right" id="togglePassword"></i>
            </div>

            <div class="links">
                <!-- Ubah href="#" menjadi href="/login" -->
                <a href="/login" class="text-green">Already have account?</a>
                
                <!-- Untuk forget password -->
                <a href="/forgot-password" class="text-black">forget password?</a>
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

    <!-- Taruh kode ini tepat di atas tag </body> -->
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
    </script>

</body>
</html>