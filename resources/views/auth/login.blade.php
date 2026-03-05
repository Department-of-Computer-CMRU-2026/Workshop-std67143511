<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Workshop Manager</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=nunito:400,600,700,800&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9ff;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        .login-container {
            background: white;
            padding: 40px 30px;
            border-radius: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-sizing: border-box;
        }

        h1 {
            color: #3f51b5; /* Blue matching mockup */
            font-size: 36px;
            margin-bottom: 40px;
            font-weight: 800;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group input {
            width: 100%;
            padding: 15px 25px;
            border: none;
            border-radius: 30px;
            background: white;
            box-shadow: 0 8px 20px rgba(200, 200, 220, 0.3);
            font-size: 16px;
            box-sizing: border-box;
            color: #555;
            transition: all 0.3s ease;
            outline: none;
        }

        .input-group input:focus {
            box-shadow: 0 8px 20px rgba(255, 105, 180, 0.3); /* Pinkish shadow on focus */
            transform: translateY(-2px);
        }

        .input-group input::placeholder {
            color: #aab;
        }

        .remember-group {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
            font-size: 14px;
            color: #889;
            padding-left: 10px;
        }

        .remember-group input[type="checkbox"] {
            appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 2px solid #ddd;
            margin-right: 10px;
            position: relative;
            cursor: pointer;
            outline: none;
            transition: all 0.2s ease;
        }

        .remember-group input[type="checkbox"]:checked {
            border-color: #f368e0;
        }

        .remember-group input[type="checkbox"]:checked::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            background-color: #f368e0;
            border-radius: 50%;
        }

        .social-login p {
            font-size: 13px;
            color: #889;
            margin-bottom: 20px;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 40px;
        }

        .social-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        
        .social-icon img {
            width: 20px;
            height: 20px;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 30px;
            background: linear-gradient(90deg, #5f27cd, #ff4757); /* Blue/Purple to Pink */
            color: white;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(255, 71, 87, 0.3);
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(255, 71, 87, 0.4);
            background: linear-gradient(90deg, #4b1f9e, #ff2337);
        }
        
        .btn-login:active {
            transform: translateY(1px);
        }

        .forgot-password {
            font-size: 14px;
            color: #3f51b5;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #ff4757;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: left;
            padding-left: 15px;
        }

        /* Basic colorful dots for social icons since no SVGs are provided */
        .color-dot { width: 22px; height: 22px; border-radius: 50%; }
        .google-color { background: conic-gradient(#ea4335 0 90deg, #34a853 90deg 180deg, #fbbc05 180deg 270deg, #4285f4 270deg 360deg); }
        .fb-color { background-color: #1877F2; }
        .insta-color { background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); }

    </style>
</head>
<body>

    <div class="login-container">
        <h1>Log In</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            @if ($errors->any())
                <div class="error-message">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="input-group">
                <input type="email" name="email" placeholder="login/e-mail" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="password" required>
            </div>

            <div class="remember-group">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </div>

            <div class="social-login">
                <p>Log in with social account</p>
                <div class="social-icons">
                    <div class="social-icon"><div class="color-dot google-color"></div></div>
                    <div class="social-icon"><div class="color-dot fb-color"></div></div>
                    <div class="social-icon"><div class="color-dot insta-color"></div></div>
                </div>
            </div>

            <button type="submit" class="btn-login">Log In</button>

            <div>
                <a href="{{ route('register') }}" class="forgot-password">Need an account? Register</a>
            </div>
            <div style="margin-top: 10px;">
                <a href="#" class="forgot-password">Forgot your password?</a>
            </div>
        </form>
    </div>

</body>
</html>
