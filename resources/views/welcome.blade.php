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
        /* Enable Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
        }

        /* --- Navbar --- */
        .navbar-custom {
            background-color: #033c6b;
            padding: 1rem 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand .logo-icon { width: 40px; height: 40px; margin-right: 10px; }
        .navbar-brand-text { font-weight: 600; letter-spacing: 1px; }
        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.8);
            font-weight: 600;
            margin: 0 0.5rem;
            transition: color 0.3s;
        }
        .navbar-nav .nav-link:hover { color: #ffffff; }
        .navbar-nav .nav-link-highlight {
            color: #F7B801; /* Highlight color for 'About' link */
        }
         .navbar-nav .nav-link-highlight:hover {
            color: #ffda73;
        }
        .navbar-toggler { border-color: rgba(255, 255, 255, 0.5); }
        .navbar-toggler-icon { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e"); }
        .dropdown-menu {
            background-color: #033c6b;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        .dropdown-item {
            color: rgba(255,255,255,0.8);
            font-weight: 600;
        }
        .dropdown-item:hover {
            background-color: #022a4b;
            color: #ffffff;
        }

        /* --- Hero Section --- */
        .hero-section {
            display: flex;
            min-height: calc(100vh - 84px);
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
        .hero-panel:hover .hero-bg-image { transform: scale(1.05); }
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
            text-shadow: 0 2px 4px rgba(0,0,0,0.4);
        }
        .hero-content h1 { font-size: 2.8rem; font-weight: 700; margin-bottom: 1.5rem; line-height: 1.3; }
        .hero-content .btn {
            padding: 0.8rem 2.5rem;
            font-weight: 600;
            border-radius: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            transition: all 0.3s ease;
            min-width: 320px;
        }
        .btn-manage { background-color: #F7B801; color: #212529; }
        .btn-rent { background-color: #FFFFFF; color: #212529; }
        .btn-manage:hover, .btn-rent:hover { transform: translateY(-3px); box-shadow: 0 4px 10px rgba(0,0,0,0.2); }

        /* --- About Us Section --- */
        .about-section {
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
            background-color: #f8f9fa;
        }
        .about-heading {
            font-weight: 700;
            font-size: 2.5rem;
            color: #033c6b;
            border-left: 5px solid #033c6b;
            padding-left: 1rem;
            margin-bottom: 1.5rem;
        }
        .about-text {
            color: #343a40;
            line-height: 1.8;
        }
        .about-image {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
        }

        /* --- Services Section --- */
        .services-section {
            padding: 6rem 0;
        }
        .services-header {
            text-align: center;
            margin-bottom: 4rem;
        }
        .services-header h2 {
            font-size: 3.5rem;
            font-weight: 700;
            color: #033c6b;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }
        .services-header h2::before {
            content: '';
            position: absolute;
            top: 0;
            left: -20px;
            right: -20px;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(135, 206, 250, 0.5), rgba(135, 206, 250, 0.1));
            z-index: -1;
            transform: skew(-10deg);
        }
        .services-header p {
            max-width: 800px;
            margin: 0 auto;
            color: #555;
            line-height: 1.7;
        }
        .service-item {
            margin-bottom: 4rem;
        }
        .service-image {
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .service-content {
            padding: 0 2rem;
        }
        .service-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: #033c6b;
        }
        .service-icon {
            width: 48px;
            height: 48px;
            margin-right: 1rem;
            fill: #36a4d7; /* Icon Color */
        }
        .service-list {
            list-style: none;
            padding-left: 0;
        }
        .service-list li {
            position: relative;
            padding-left: 25px;
            margin-bottom: 0.75rem;
            color: #343a40;
        }
        .service-list li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: #36a4d7;
            font-weight: bold;
            font-size: 1.5rem;
            line-height: 1;
        }

        @media (max-width: 991px) {
            .about-image { margin-bottom: 2rem; }
            .service-content { padding: 2rem 0; }
        }
        @media (max-width: 768px) {
            .hero-section { flex-direction: column; }
            .hero-panel { min-height: 50vh; }
            .hero-content h1 { font-size: 2rem; }
            .hero-content .btn { min-width: 280px; }
            .services-header h2 { font-size: 2.5rem; }
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
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Centered Links -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-link-highlight" href="#about-section">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services-section">SERVICES</a>
                    </li>
                </ul>

                <!-- Right Aligned Auth Links -->
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Log Out</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
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
                <div class="hero-bg-image" style="background-image: url('{{ asset('images/1c7fa4a5-e10d-4259-bedc-4e35face5860.jpeg') }}');"></div>
                <div class="hero-content">
                    <h1>Simplifying Property Management for You</h1>
                    <a href="{{ auth()->check() ? route('properties.index') : route('login') }}" class="btn btn-manage">Manage My Property</a>
                </div>
            </div>

            <!-- Right Panel -->
            <div class="hero-panel">
                <div class="hero-bg-image" style="background-image: url('{{ asset('images/05bb7fa1-4b0f-4b79-8880-331758c36177.jpeg') }}');"></div>
                <div class="hero-content">
                    <h1>Find Rentals That Feel Like Home</h1>
                    <a href="{{ auth()->check() ? route('tenants.index') : route('login') }}" class="btn btn-rent">Rent a Property</a>
                </div>
            </div>
        </section>
    </main>

    <!-- About Us Section -->
    <section id="about-section" class="about-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="about-heading">Your Trusted Partner in Property Management</h2>
                    <p class="about-text">
                        At Rental  Management , we believe owning property should be a rewarding experience—not a stressful one. Founded with the mission to provide exceptional property management services, we cater to homeowners who value professionalism, transparency, and peace of mind. Whether you're living abroad, managing a busy schedule, or simply seeking expert care for your property, our dedicated team ensures your investment is well-maintained, tenants are satisfied, and your returns are maximized.
                    </p>
                    <p class="about-text">
                        With years of experience in the industry, we specialize in managing residential and commercial properties across Kathmandu, Lalitpur, and Bhaktapur. At Sams Property Management, we treat every property as if it were our own, delivering personalized solutions with the utmost care and professionalism.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services-section" class="services-section">
        <div class="container">
            <div class="services-header">
                <h2>Our Services</h2>
                <p>Owning property is a valuable investment, but managing it can be overwhelming. From finding reliable tenants to handling maintenance, legal work, and financial records, landlords often struggle to balance responsibilities—especially if they live abroad, have busy schedules, or are elderly. Without professional support, properties can become a burden instead of a benefit.</p>
                <p>At Sams Property Management, we treat your property like our own. Our services are designed to make property ownership stress-free. Here's how we can give you a stress-free property ownership experience:</p>
            </div>

            <!-- Service 1: Property Management -->
            <div class="service-item">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <!-- Image removed -->
                    </div>
                    <div class="col-lg-6">
                        <div class="service-content">
                            <div class="d-flex align-items-center mb-3">
                                <svg class="service-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2.0996094L1 12L4 12L4 21L11 21L11 15L13 15L13 21L20 21L20 12L23 12L12 2.0996094zM12 4.7910156L18 10.191406L18 19L15 19L15 13L9 13L9 19L6 19L6 10.191406L12 4.7910156z"/></svg>
                                <h3 class="service-title">Property Management</h3>
                            </div>
                            <ul class="service-list">
                                <li>End-to-end management of your residential or commercial property.</li>
                                <li>Rent collection, tenant screening, and property maintenance.</li>
                                <li>Regular property inspections and updates for your peace of mind.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 2: Tenant Placement -->
            <div class="service-item">
                <div class="row align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <!-- Image removed -->
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="service-content">
                            <div class="d-flex align-items-center mb-3">
                                <svg class="service-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,2A10,10,0,0,0,2,12A10,10,0,0,0,12,22A10,10,0,0,0,22,12A10,10,0,0,0,12,2M12,5A3,3,0,0,1,15,8A3,3,0,0,1,12,11A3,3,0,0,1,9,8A3,3,0,0,1,12,5M12,19.2C9.5,19.2,7.29,17.92,6,15.98C6.03,13.97,10,12.9,12,12.9C14,12.9,17.97,13.97,18,15.98C16.71,17.92,14.5,19.2,12,19.2Z"/></svg>
                                <h3 class="service-title">Tenant Placement</h3>
                            </div>
                            <ul class="service-list">
                                <li>Find reliable tenants for your property.</li>
                                <li>Complete documentation, agreements, and background checks.</li>
                                <li>Smooth onboarding process for tenants.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 3: Financial Reporting -->
            <div class="service-item">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <!-- Image removed -->
                    </div>
                    <div class="col-lg-6">
                        <div class="service-content">
                            <div class="d-flex align-items-center mb-3">
                               <svg class="service-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7,21H5V9H7V21M13,21H11V3H13V21M19,21H17V14H19V21M3,21H1V7L3,7V21Z"/></svg>
                                <h3 class="service-title">Financial Reporting</h3>
                            </div>
                            <ul class="service-list">
                                <li>Regular reports on rental income and expenses.</li>
                                <li>Clear and transparent accounting of all transactions.</li>
                                <li>Tailored reports to meet your specific needs.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 4: Property Marketing -->
            <div class="service-item">
                <div class="row align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <!-- Image removed -->
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="service-content">
                            <div class="d-flex align-items-center mb-3">
                                <svg class="service-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20,2H4A2,2 0 0,0 2,4V22L6,18H20A2,2 0 0,0 22,16V4A2,2 0 0,0 20,2M9.1,12.9L11.1,15.3L13.1,12.5L16.1,16H5.1L9.1,12.9Z"/></svg>
                                <h3 class="service-title">Property Marketing</h3>
                            </div>
                            <ul class="service-list">
                                <li>Professional advertising to attract quality tenants</li>
                                <li>Listing creation on popular platforms and social media.</li>
                                <li>Market analysis to set competitive rental rates.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service 5: Representation and Legal Assistance -->
            <div class="service-item">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <!-- Image removed -->
                    </div>
                    <div class="col-lg-6">
                        <div class="service-content">
                            <div class="d-flex align-items-center mb-3">
                                <svg class="service-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15,2H9A2,2 0 0,0 7,4V20A2,2 0 0,0 9,22H15A2,2 0 0,0 17,20V4A2,2 0 0,0 15,2M15,20H9V4H15V20M10.5,18L13.5,15L10.5,12V18Z"/></svg>
                                <h3 class="service-title">Representation and Legal Assistance</h3>
                            </div>
                            <ul class="service-list">
                                <li>Representation at government offices for taxes, permits, and legal documentation.</li>
                                <li>Assistance with rental agreements, disputes, and compliance.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>``