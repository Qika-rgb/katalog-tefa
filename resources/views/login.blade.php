<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - TEFA</title>

    <!-- FONT POPPINS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <!-- FONT AWESOME -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >

    <!-- CSS UTAMA -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="login-body">

    <!-- =========================================
         LOGIN PAGE
    ========================================== -->

    <div class="login-page">

        <!-- BACKGROUND PATTERN -->
        <div class="login-background"></div>


        <!-- =====================================
             LOGIN CARD
        ====================================== -->

        <div class="login-card">

            <!-- USER ICON -->
            <div class="login-avatar">
                <i class="fa-solid fa-user"></i>
            </div>


            <!-- =================================
                 TITLE
            ================================== -->

            <div class="login-title">
                <h1>login</h1>
            </div>


            <!-- =================================
                 LOGIN FORM
            ================================== -->

            <form action="#" method="POST">

                @csrf


                <!-- USERNAME / EMAIL -->

                <div class="login-input-box">

                    <i class="fa-solid fa-user"></i>

                    <input
                        type="text"
                        name="email"
                        placeholder="username or email"
                        autocomplete="username"
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
                        autocomplete="current-password"
                        required
                    >

                    <!-- SHOW PASSWORD -->

                    <i
                        class="fa-regular fa-eye"
                        id="toggleLoginPassword"
                        title="Show password"
                    ></i>

                </div>


                <!-- =================================
                     REMEMBER & FORGOT PASSWORD
                ================================== -->

                <div class="login-options">

                    <label class="remember-me">

                        <input
                            type="checkbox"
                            name="remember"
                        >

                        <span>
                            remember me
                        </span>

                    </label>


                    <a href="/forgot-password">
                        forgot password?
                    </a>

                </div>


                <!-- =================================
                     LOGIN BUTTON
                ================================== -->

                <button
                    type="submit"
                    class="login-button"
                >
                    login
                </button>

            </form>


            <!-- =================================
                 OR CONTINUE WITH
            ================================== -->

            <div class="or-login">
                <span>or continue with</span>
            </div>


            <!-- =================================
                 SOCIAL LOGIN
            ================================== -->

            <div class="social-login">

                <!-- GOOGLE -->

                <button
                    type="button"
                    class="social-button"
                    aria-label="Login with Google"
                >

                    <i class="fa-brands fa-google google-icon"></i>

                </button>


                <!-- FACEBOOK -->

                <button
                    type="button"
                    class="social-button"
                    aria-label="Login with Facebook"
                >

                    <i class="fa-brands fa-facebook facebook-icon"></i>

                </button>


                <!-- APPLE -->

                <button
                    type="button"
                    class="social-button"
                    aria-label="Login with Apple"
                >

                    <i class="fa-brands fa-apple apple-icon"></i>

                </button>

            </div>


            <!-- =================================
                 REGISTER
            ================================== -->

            <div class="register-link">

                <span>
                    Don't have an account?
                </span>

                <a href="/register">
                    sign up here
                </a>

            </div>

        </div>

    </div>


    <!-- =========================================
         SHOW / HIDE PASSWORD
    ========================================== -->

    <script>

        const toggleLoginPassword =
            document.getElementById('toggleLoginPassword');

        const loginPassword =
            document.getElementById('loginPassword');


        if (toggleLoginPassword && loginPassword) {

            toggleLoginPassword.addEventListener(
                'click',
                function () {

                    if (loginPassword.type === 'password') {

                        loginPassword.type = 'text';

                        this.classList.remove('fa-eye');
                        this.classList.add('fa-eye-slash');

                        this.setAttribute(
                            'title',
                            'Hide password'
                        );

                    } else {

                        loginPassword.type = 'password';

                        this.classList.remove('fa-eye-slash');
                        this.classList.add('fa-eye');

                        this.setAttribute(
                            'title',
                            'Show password'
                        );

                    }

                }
            );

        }

    </script>

</body>
</html>