<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Hotel Booking System</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;

            background-image:
                linear-gradient(
                    rgba(10, 50, 100, 0.45),
                    rgba(10, 50, 100, 0.45)
                ),
                url("{{ asset('image/hotel.jpg') }}");

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 20px;
        }

        .login-wrapper {
            width: 900px;
            max-width: 100%;
            min-height: 560px;

            display: flex;

            background: white;

            border-radius: 20px;

            overflow: hidden;

            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.30);
        }

        /* LEFT SIDE */

        .hotel-side {
            width: 50%;

            background-image:
                linear-gradient(
                    rgba(10, 65, 125, 0.58),
                    rgba(10, 65, 125, 0.58)
                ),
                url("{{ asset('image/hotel.jpg') }}");

            background-size: cover;
            background-position: center;

            color: white;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            text-align: center;

            padding: 40px;
        }

        .hotel-icon {
            font-size: 65px;
            margin-bottom: 15px;
        }

        .hotel-side h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .hotel-side .tagline {
            font-size: 16px;
            margin-bottom: 40px;
        }

        .hotel-message {
            font-size: 18px;
            font-weight: bold;
            line-height: 1.5;
            margin-bottom: 35px;
        }

        .features {
            display: flex;
            justify-content: center;
            gap: 25px;
            width: 100%;
        }

        .feature {
            text-align: center;
            font-size: 12px;
        }

        .feature-icon {
            font-size: 28px;
            margin-bottom: 7px;
        }

        /* RIGHT SIDE */

        .login-side {
            width: 50%;

            background: #ffffff;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 45px;
        }

        .login-form {
            width: 100%;
            max-width: 390px;
        }

        .login-title {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-title h2 {
            color: #174d82;
            font-size: 30px;
            margin-bottom: 7px;
        }

        .login-title p {
            color: #777;
            font-size: 13px;
        }

        /* ERROR */

        .error-box {
            background: #ffe9e9;
            color: #b42318;
            border: 1px solid #ffb7b7;
            border-radius: 8px;
            padding: 10px 12px;
            margin-bottom: 15px;
            font-size: 12px;
        }

        /* SUCCESS */

        .success-box {
            background: #e9f8ef;
            color: #18733c;
            border: 1px solid #b2dfc2;
            border-radius: 8px;
            padding: 10px 12px;
            margin-bottom: 15px;
            font-size: 12px;
        }

        /* FORM GROUP */

        .form-group {
            margin-bottom: 17px;
        }

        .form-group label {
            display: block;

            color: #333;

            font-size: 13px;

            font-weight: bold;

            margin-bottom: 7px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;

            left: 13px;
            top: 50%;

            transform: translateY(-50%);

            font-size: 17px;
        }

        .input-wrapper input,
        .input-wrapper select {
            width: 100%;

            height: 44px;

            border: 1px solid #cbd5e1;

            border-radius: 8px;

            padding: 0 42px;

            outline: none;

            font-size: 13px;

            color: #333;

            background: white;
        }

        .input-wrapper select {
            padding-left: 42px;
            cursor: pointer;
        }

        .input-wrapper input:focus,
        .input-wrapper select:focus {
            border-color: #2474c7;

            box-shadow:
                0 0 0 3px rgba(36, 116, 199, 0.10);
        }

        .input-wrapper input::placeholder {
            color: #999;
        }

        /* PASSWORD */

        .password-wrapper input {
            padding-right: 45px;
        }

        .show-password {
            position: absolute;

            right: 13px;
            top: 50%;

            transform: translateY(-50%);

            cursor: pointer;

            font-size: 17px;

            user-select: none;
        }

        /* REMEMBER */

        .remember-row {
            display: flex;

            align-items: center;

            gap: 8px;

            margin-top: 2px;

            margin-bottom: 20px;

            color: #666;

            font-size: 12px;
        }

        .remember-row input {
            width: 15px;
            height: 15px;

            accent-color: #1769aa;

            cursor: pointer;
        }

        /* LOGIN BUTTON */

        .login-button {
            width: 100%;

            height: 45px;

            border: none;

            border-radius: 8px;

            background:
                linear-gradient(
                    135deg,
                    #1769aa,
                    #3f91e8
                );

            color: white;

            font-size: 15px;

            font-weight: bold;

            cursor: pointer;

            box-shadow:
                0 5px 12px rgba(23, 105, 170, 0.25);
        }

        .login-button:hover {
            background:
                linear-gradient(
                    135deg,
                    #12588f,
                    #287bc9
                );
        }

        /* REGISTER */

        .register-link {
            text-align: center;

            margin-top: 20px;

            padding-top: 17px;

            border-top: 1px solid #eeeeee;

            color: #777;

            font-size: 12px;
        }

        .register-link a {
            color: #1769aa;

            text-decoration: none;

            font-weight: bold;

            margin-left: 4px;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* FOOTER */

        .footer {
            text-align: center;

            color: #999;

            font-size: 10px;

            margin-top: 18px;
        }

        /* MOBILE */

        @media (max-width: 750px) {

            body {
                padding: 12px;
            }

            .login-wrapper {
                width: 420px;
                min-height: auto;
            }

            .hotel-side {
                display: none;
            }

            .login-side {
                width: 100%;
                padding: 35px 28px;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        <!-- LEFT HOTEL SIDE -->

        <div class="hotel-side">

            <div class="hotel-icon">
                🏨
            </div>

            <h1>
                Hotel Booking System
            </h1>

            <div class="tagline">
                Comfort • Quality • Service
            </div>

            <div class="hotel-message">
                Your comfortable stay<br>
                is our priority.
            </div>

            <div class="features">

                <div class="feature">

                    <div class="feature-icon">
                        🛏️
                    </div>

                    Comfortable<br>
                    Rooms

                </div>

                <div class="feature">

                    <div class="feature-icon">
                        🛡️
                    </div>

                    Safe & Secure<br>
                    Booking

                </div>

                <div class="feature">

                    <div class="feature-icon">
                        🎧
                    </div>

                    24/7<br>
                    Support

                </div>

            </div>

        </div>


        <!-- RIGHT LOGIN SIDE -->

        <div class="login-side">

            <div class="login-form">

                <div class="login-title">

                    <h2>
                        Welcome Back!
                    </h2>

                    <p>
                        Login to your account to continue.
                    </p>

                </div>


                <!-- SUCCESS MESSAGE -->

                @if (session('status'))

                    <div class="success-box">
                        {{ session('status') }}
                    </div>

                @endif


                <!-- ERROR MESSAGE -->

                @if ($errors->any())

                    <div class="error-box">
                        {{ $errors->first() }}
                    </div>

                @endif


                <!-- LOGIN FORM -->

                <form
                    method="POST"
                    action="{{ route('login') }}"
                >

                    @csrf


                    <!-- EMAIL -->

                    <div class="form-group">

                        <label for="email">
                            Email Address
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                ✉️
                            </span>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Enter your email"
                            >

                        </div>

                    </div>


                    <!-- PASSWORD -->

                    <div class="form-group">

                        <label for="password">
                            Password
                        </label>

                        <div class="input-wrapper password-wrapper">

                            <span class="input-icon">
                                🔒
                            </span>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Enter your password"
                            >

                            <span
                                class="show-password"
                                id="eye"
                                onclick="togglePassword()"
                            >
                                👁️
                            </span>

                        </div>

                    </div>


                    <!-- ROLE -->

                    <div class="form-group">

                        <label for="role">
                            Login As
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                👤
                            </span>

                            <select
                                id="role"
                                name="role"
                                required
                            >

                                <option value="">
                                    -- Select Role --
                                </option>

                                <option
                                    value="user"
                                    {{ old('role') == 'user' ? 'selected' : '' }}
                                >
                                    Customer
                                </option>

                                <option
                                    value="staff"
                                    {{ old('role') == 'staff' ? 'selected' : '' }}
                                >
                                    Staff
                                </option>

                                <option
                                    value="admin"
                                    {{ old('role') == 'admin' ? 'selected' : '' }}
                                >
                                    Admin
                                </option>

                            </select>

                        </div>

                    </div>


                    <!-- REMEMBER ME -->

                    <label class="remember-row">

                        <input
                            type="checkbox"
                            name="remember"
                        >

                        <span>
                            Remember me
                        </span>

                    </label>


                    <!-- LOGIN BUTTON -->

                    <button
                        type="submit"
                        class="login-button"
                    >
                        🔐 Login
                    </button>

                </form>


                <!-- REGISTER -->

                @if (Route::has('register'))

                    <div class="register-link">

                        Don't have an account?

                        <a href="{{ route('register') }}">
                            Register
                        </a>

                    </div>

                @endif


                <!-- FOOTER -->

                <div class="footer">
                    © {{ date('Y') }} Hotel Booking System
                </div>

            </div>

        </div>

    </div>


    <!-- SHOW PASSWORD -->

    <script>

        function togglePassword() {

            const password =
                document.getElementById('password');

            const eye =
                document.getElementById('eye');


            if (password.type === 'password') {

                password.type = 'text';

                eye.textContent = '🙈';

            } else {

                password.type = 'password';

                eye.textContent = '👁️';

            }

        }

    </script>

</body>
</html>