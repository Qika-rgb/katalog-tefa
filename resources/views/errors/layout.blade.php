<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2563eb">
    <title>@yield('title', 'Error') — Katalog TEFA SMKN 4</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo_tefa.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .error-page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            font-family: 'Poppins', sans-serif;
            text-align: center;
        }
        .error-logo {
            height: 50px;
            margin-bottom: 32px;
            object-fit: contain;
        }
        .error-code {
            font-size: 100px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 8px;
            color: transparent;
            background: @yield('code-gradient', 'linear-gradient(to right, #2563eb, #60a5fa)');
            -webkit-background-clip: text;
            background-clip: text;
        }
        .error-title {
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 12px;
        }
        .error-desc {
            font-size: 15px;
            color: #64748b;
            max-width: 420px;
            line-height: 1.6;
            margin-bottom: 32px;
        }
        .error-btns {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .error-btn-primary {
            background: #2563eb;
            color: #fff;
            padding: 12px 28px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: background 0.2s;
        }
        .error-btn-primary:hover { background: #1d4ed8; color: #fff; }
        .error-btn-secondary {
            background: #fff;
            color: #2563eb;
            padding: 12px 28px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            border: 2px solid #2563eb;
            transition: all 0.2s;
        }
        .error-btn-secondary:hover { background: #eff6ff; }
        @media (max-width: 480px) {
            .error-code { font-size: 72px; }
            .error-title { font-size: 18px; }
        }
    </style>
</head>
<body>
<div class="error-page-wrapper">
    <a href="/">
        <img src="{{ asset('images/logo_tefa.png') }}" alt="Logo TEFA" class="error-logo">
    </a>

    <div class="error-code" style="background: @yield('code-gradient', 'linear-gradient(to right, #2563eb, #60a5fa)'); -webkit-background-clip: text; background-clip: text;">
        @yield('code', '???')
    </div>

    <h1 class="error-title">@yield('title', 'Terjadi Kesalahan')</h1>
    <p class="error-desc">@yield('description', 'Maaf, terjadi sesuatu yang tidak terduga. Silakan coba lagi.')</p>

    <div class="error-btns">
        <a href="/" class="error-btn-primary">
            <i class="fa-solid fa-house"></i>&nbsp; Kembali ke Beranda
        </a>
        <a href="javascript:history.back()" class="error-btn-secondary">
            <i class="fa-solid fa-arrow-left"></i>&nbsp; Halaman Sebelumnya
        </a>
    </div>
</div>
</body>
</html>
