<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Workshop Manager</title>
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
            color: #ff4757; /* Pink matching mockup style */
            font-size: 36px;
            margin-bottom: 30px;
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
            box-shadow: 0 8px 20px rgba(95, 39, 205, 0.3); /* Blueish shadow on focus */
            transform: translateY(-2px);
        }

        .input-group input::placeholder {
            color: #aab;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 30px;
            background: linear-gradient(90deg, #ff4757, #5f27cd); /* Pink to Blue/Purple */
            color: white;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(95, 39, 205, 0.3);
            transition: all 0.3s ease;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(95, 39, 205, 0.4);
            background: linear-gradient(90deg, #ff2337, #4b1f9e);
        }
        
        .btn-login:active {
            transform: translateY(1px);
        }

        .forgot-password {
            font-size: 14px;
            color: #ff4757;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #3f51b5;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: left;
            padding-left: 15px;
        }

    </style>
</head>
<body>

    <div class="login-container">
        <h1>Register</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            @if ($errors->any())
                <div class="error-message">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="input-group">
                <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="input-group">
                <input type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            
            <div class="input-group">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            </div>

            <button type="submit" class="btn-login">Sign Up</button>

            <div>
                <a href="{{ route('login') }}" class="forgot-password">Already have an account? Log In</a>
            </div>
        </form>
    </div>

</body>
</html>
