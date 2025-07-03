<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rental Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts for a professional look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        /* Custom CSS to build the design */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa; /* A light grey background for the body */
        }

        /* --- Navbar --- */
        .navbar-custom {
            background-color: #1A5F99; /* A custom blue color */
            padding: 1rem 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand .logo-icon { width: 40px; height: 40px; margin-right: 10px; }
        .navbar-brand-text { font-weight: 600; letter-spacing: 1px; }
        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.8);
            font-weight: 600;
            margin-left: 1rem;
            transition: color 0.3s;
        }
        .navbar-nav .nav-link:hover { color: #ffffff; }
        .navbar-toggler { border-color: rgba(255, 255, 255, 0.5); }
        .navbar-toggler-icon { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e"); }

        /* --- Hero Section --- */
        .hero-section {
            display: flex;
            min-height: calc(100vh - 84px); /* Full viewport height minus navbar height */
            color: white;
        }
        .hero-panel {
            flex: 1;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem;
            overflow: hidden;
        }
        .hero-bg-image {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-size: cover;
            background-position: center;
            z-index: 1;
            transition: transform 0.5s ease-out;
        }
        .hero-panel:hover .hero-bg-image {
            transform: scale(1.05); /* The zoom effect */
        }
        .hero-panel::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 2;
        }
        .hero-content {
            position: relative;
            z-index: 3;
        }
        .hero-content h1 { font-size: 2.8rem; font-weight: 700; margin-bottom: 1.5rem; line-height: 1.3; }
        .hero-content .btn { padding: 0.8rem 2.5rem; font-weight: 600; border-radius: 5px; text-transform: uppercase; letter-spacing: 1px; border: none; transition: all 0.3s ease; }
        .btn-manage { background-color: #F7B801; color: #212529; }
        .btn-rent { background-color: #FFFFFF; color: #212529; }
        .btn-manage:hover, .btn-rent:hover { transform: translateY(-3px); box-shadow: 0 4px 10px rgba(0,0,0,0.2); }
        
        @media (max-width: 768px) {
            .hero-section { flex-direction: column; }
            .hero-panel { min-height: 50vh; }
            .hero-content h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <svg class="logo-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white"><path d="M12 2.0996094L1 12L4 12L4 21L11 21L11 15L13 15L13 21L20 21L20 12L23 12L12 2.0996094zM12 4.7910156L18 10.191406L18 19L15 19L15 13L9 13L9 19L6 19L6 10.191406L12 4.7910156z"/></svg>
                <span class="navbar-brand-text">RENTAL MANAGEMENT SYSTEM</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    @auth
                        {{-- If the user is logged in, show a link to the Dashboard --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @else
                        {{-- If the user is a guest, show Login and Register links --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Log in</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <section class="hero-section">
            <!-- Left Panel -->
            <div class="hero-panel">
                <div class="hero-bg-image" style="background-image: url('https://images.pexels.com/photos/259707/pexels-photo-259707.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');"></div>
                <div class="hero-content">
                    <h1>Simplifying Property Management for You</h1>
                    <!-- THIS IS THE FIRST LINE THAT WAS CHANGED -->
                    <a href="{{ auth()->check() ? route('properties.index') : route('login') }}" class="btn btn-manage">Manage My Property</a>
                </div>
            </div>

            <!-- Right Panel -->
            <div class="hero-panel">
                <div class="hero-bg-image" style="background-image: url('https://images.pexels.com/photos/271624/pexels-photo-271624.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');"></div>
                <div class="hero-content">
                    <h1>Find Rentals That Feel Like Home</h1>
                     <!-- THIS IS THE SECOND LINE THAT WAS CHANGED -->
                    <a href="{{ auth()->check() ? route('tenants.index') : route('login') }}" class="btn btn-rent">Rent a Property</a>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>