<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior-to-Junior Workshop</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { padding-top: 60px; }
        .hero { background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); color: white; padding: 4rem 0; margin-bottom: 2rem; border-radius: 0 0 2rem 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .topic-card { transition: transform 0.2s, box-shadow 0.2s; border-radius: 1rem; overflow: hidden; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .topic-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .card-header-custom { background: #f8f9fa; border-bottom: 2px solid #e9ecef; font-weight: bold; }
        .progress-bar-custom { border-radius: 10px; }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">🎓 S2J Workshop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @auth
                    @if(Auth::user()->is_admin)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('topics.index') }}">Admin</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('registrations.index') }}">My Workshops</a>
                    </li>
                    @endif
                @endauth
            </ul>
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->is_admin ? 'Admin' : Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4 mb-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
