<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - TEFA</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="login-body">

    <div class="login-page">

        <div class="login-card">

            <!-- ICON USER -->
            <div class="login-avatar">
                <i class="fa-solid fa-user"></i>
            </div>

            <!-- JUDUL -->
            <h1>login</h1>

            <!-- FORM LOGIN -->
            <form action="#" method="POST">

                @csrf

                <!-- USERNAME / EMAIL -->
                <div class="login-input-box">

                    <i class="fa-solid fa-user"></i>

                    <input
                        type="text"
                        name="email"
                        placeholder="username or email"
                        required
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

                    <i
                        class="fa-regular fa-eye"
                        id="toggleLoginPassword"
                    ></i>

                </div>

                <!-- REMEMBER + FORGOT -->
                <div class="login-options">

                    <label class="remember-me">

                        <input
                            type="checkbox"
                            name="remember"
                        >

                        <span>remember me</span>

                    </label>

                    <a href="/forgot-password">
                        forgot password?
                    </a>

                </div>

                <!-- LOGIN BUTTON -->
                <button
                    type="submit"
                    class="login-button"
                >
                    login
                </button>

            </form>

            <!-- OR -->
            <div class="or-login">
                or continue with
            </div>

            <!-- SOCIAL LOGIN -->
            <div class="social-login">

                <button type="button">
                    <i class="fa-brands fa-google google-icon"></i>
                </button>

                <button type="button">
                    <i class="fa-brands fa-facebook facebook-icon"></i>
                </button>

                <button type="button">
                    <i class="fa-brands fa-apple apple-icon"></i>
                </button>

            </div>

            <!-- REGISTER -->
            <div class="register-link">

                <span>Don't have an account?</span>

                <a href="/register">
                    sign up here
                </a>

            </div>

        </div>

    </div>


    <!-- JAVASCRIPT PASSWORD -->
    <script>

        const toggleLoginPassword =
            document.getElementById('toggleLoginPassword');

        const loginPassword =
            document.getElementById('loginPassword');

        toggleLoginPassword.addEventListener('click', function () {

            if (loginPassword.type === 'password') {

                loginPassword.type = 'text';

                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');

            } else {

                loginPassword.type = 'password';

                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');

            }

        });

    </script>

</body>
</html>