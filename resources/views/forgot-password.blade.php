<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Memanggil CSS yang sama persis -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="card">
        
        <!-- Ikon diganti jadi gembok untuk tema lupa sandi -->
        <div class="avatar">
            <i class="fa-solid fa-lock"></i>
        </div>

        <h2>Forgot Password?</h2>
        <p class="subtitle">Enter your email address and we'll send you a link to reset your password.</p>

       <form action="#" method="POST">
    @csrf
            <!-- Input Email -->
            <div class="input-group">
                <i class="fa-regular fa-envelope icon-left"></i>
               <input type="email" name="email" placeholder="your email">
            </div>

            <button type="submit" class="btn-main">Send Reset Link</button>
        </form>

        <!-- Tombol kembali ke Login -->
        <div style="margin-top: 20px; font-size: 12px; font-weight: 700;">
            <a href="/login" style="color: #888; text-decoration: none;">
                <i class="fa-solid fa-arrow-left"></i> back to login
            </a>
        </div>

    </div>
</body>
</html>