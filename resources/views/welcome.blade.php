<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Samad Al Shan Gas | صمد الشأن للغاز - Professional LPG Gas Services in Oman</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Cairo:wght@400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 CSS & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- AOS (Animate on Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #0056b3;
            --primary-dark: #072a4d;
            --flame-orange: #ff6b1a;
            --flame-gold: #ffb800;
            --accent-cyan: #00c4cc;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --bg-light: #f8fafc;
        }

        body {
            font-family:
                {{ app()->getLocale() == 'ar' ? "'Cairo', sans-serif" : "'Plus Jakarta Sans', sans-serif" }}
            ;
            color: var(--text-dark);
            background-color: #ffffff;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* ── Modern Floating Navbar ── */
        .navbar-custom {
            padding: 18px 0;
            transition: all 0.35s ease;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand-text {
            font-weight: 800;
            font-size: 22px;
            color: var(--primary-dark);
            letter-spacing: -0.5px;
        }

        .navbar-brand-text span {
            color: var(--flame-orange);
        }

        .nav-link {
            font-weight: 600;
            color: #334155 !important;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.25s ease;
            font-size: 15px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-blue) !important;
            background: rgba(0, 86, 179, 0.06);
        }

        .btn-flame {
            background: linear-gradient(135deg, var(--flame-orange) 0%, #ff4500 100%);
            color: #ffffff !important;
            font-weight: 700;
            border-radius: 50px;
            padding: 10px 26px;
            box-shadow: 0 4px 15px rgba(255, 107, 26, 0.35);
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-flame:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 26, 0.45);
            color: #ffffff;
        }

        .btn-outline-white {
            border: 2px solid rgba(255, 255, 255, 0.7);
            color: #ffffff !important;
            font-weight: 700;
            border-radius: 50px;
            padding: 10px 24px;
            transition: all 0.3s ease;
            backdrop-filter: blur(6px);
        }

        .btn-outline-white:hover {
            background: #ffffff;
            color: var(--primary-dark) !important;
            border-color: #ffffff;
        }

        /* ── Hero Section ── */
        .hero-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 140px 0 90px;
            background: linear-gradient(135deg, rgba(7, 42, 77, 0.94) 0%, rgba(0, 86, 179, 0.88) 100%),
                url("{{ asset('images/login-bg.png') }}") center center / cover no-repeat;
            color: #ffffff;
            overflow: hidden;
        }

        .hero-badge {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 8px 18px;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--flame-gold);
            margin-bottom: 22px;
        }

        .hero-title {
            font-size: 52px;
            font-weight: 900;
            line-height: 1.15;
            margin-bottom: 24px;
            letter-spacing: -1px;
        }

        .hero-title .highlight {
            background: linear-gradient(120deg, #ffd000, #ff6b1a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 18px;
            line-height: 1.65;
            color: #e2e8f0;
            max-width: 580px;
            margin-bottom: 35px;
        }

        /* Hero Graphic / 3D Card */
        .hero-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 28px;
            padding: 35px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
            position: relative;
        }

        .hero-cylinder-preview {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: 20px;
            padding: 20px 0;
        }

        .cylinder-pillar {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .cylinder-pillar:hover {
            transform: translateY(-8px);
        }

        .cylinder-icon-box {
            background: linear-gradient(135deg, #ff6b1a, #ffb800);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            box-shadow: 0 10px 25px rgba(255, 107, 26, 0.4);
        }

        /* ── Key Trust Badges ── */
        .trust-strip {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px 35px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }

        .trust-item {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .trust-icon {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        /* ── Section Headings ── */
        .section-tag {
            font-size: 13px;
            font-weight: 800;
            color: var(--flame-orange);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 8px;
            display: block;
        }

        .section-heading {
            font-size: 38px;
            font-weight: 800;
            color: var(--primary-dark);
            letter-spacing: -0.5px;
            margin-bottom: 16px;
        }

        .section-desc {
            font-size: 16px;
            color: var(--text-muted);
            line-height: 1.7;
        }

        /* ── Refill Process Step Cards ── */
        .step-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 36px 28px;
            border: 1px solid #e2e8f0;
            position: relative;
            transition: all 0.35s ease;
            height: 100%;
        }

        .step-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 86, 179, 0.09);
            border-color: #cbd5e1;
        }

        .step-num {
            position: absolute;
            top: 24px;
            right: 24px;
            font-size: 42px;
            font-weight: 900;
            color: #f1f5f9;
            line-height: 1;
            z-index: 1;
        }

        .step-icon {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin-bottom: 22px;
            position: relative;
            z-index: 2;
        }

        /* ── Services Cards ── */
        .service-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 40px 32px;
            border: 1px solid #e2e8f0;
            transition: all 0.35s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--flame-orange));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 22px 45px rgba(15, 23, 42, 0.08);
            border-color: transparent;
        }

        .service-card:hover::before {
            opacity: 1;
        }

        /* ── Product Cylinder Cards ── */
        .cylinder-card {
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            transition: all 0.35s ease;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .cylinder-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 86, 179, 0.12);
            border-color: var(--primary-blue);
        }

        .cylinder-header {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 35px 20px;
            text-align: center;
            position: relative;
        }

        .cylinder-tag {
            position: absolute;
            top: 14px;
            right: 14px;
            background: var(--primary-blue);
            color: #fff;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .cylinder-body {
            padding: 28px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .spec-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed #e2e8f0;
            font-size: 13.5px;
        }

        /* ── Video/Media Section ── */
        .video-box-card {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #00376b 100%);
            border-radius: 30px;
            overflow: hidden;
            color: #fff;
            padding: 60px 50px;
            position: relative;
        }

        .play-btn-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #ffffff;
            color: var(--flame-orange);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            cursor: pointer;
            box-shadow: 0 0 0 12px rgba(255, 255, 255, 0.25);
            transition: all 0.3s ease;
        }

        .play-btn-circle:hover {
            transform: scale(1.1);
            background: var(--flame-orange);
            color: #ffffff;
            box-shadow: 0 0 0 16px rgba(255, 107, 26, 0.3);
        }

        /* ── Testimonials / Reviews ── */
        .review-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            height: 100%;
        }

        .stars {
            color: #f59e0b;
            font-size: 14px;
            margin-bottom: 12px;
        }

        /* ── Footer ── */
        .footer-custom {
            background: #071927;
            color: #cbd5e1;
            padding: 80px 0 30px;
        }

        .footer-title {
            color: #ffffff;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 22px;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.25s ease;
        }

        .footer-links a:hover {
            color: #ffffff;
            padding-left: 5px;
        }

        /* Smooth floating animation */
        @keyframes floatAnim {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .floating-element {
            animation: floatAnim 4s ease-in-out infinite;
        }
    </style>
</head>

<body>

    <!-- ── NAVIGATION BAR ── -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                <div class="cylinder-icon-box" style="width: 42px; height: 42px; font-size: 20px;">
                    <i class="fas fa-fire-flame-curved"></i>
                </div>
                <div class="navbar-brand-text">
                    SAMAD <span>AL SHAN</span> GAS
                    <small class="d-block text-muted" style="font-size: 10px; font-weight: 600; letter-spacing: 0.5px;">
                        LPG SERVICES • SULTANATE OF OMAN
                    </small>
                </div>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navMenu">
                <i class="fas fa-bars-staggered text-primary fs-4"></i>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="#home">{{ __('messages.home') ?? 'Home' }}</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#how-it-works">How It Works</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#products">Cylinders (Products)</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact Us</a></li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}" class="btn btn-outline-primary rounded-pill px-4 fw-bold">
                                <i class="fas fa-gauge me-1"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4 fw-bold">
                                <i class="fas fa-sign-in-alt me-1"></i> Staff Login
                            </a>
                        @endauth
                    @endif
                    <a href="https://wa.me/96890000000" target="_blank" class="btn btn-flame">
                        <i class="fab fa-whatsapp fs-5"></i> <span>Order Refill</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ── HERO SECTION ── -->
    <section class="hero-section" id="home">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7" data-aos="fade-up" data-aos-duration="1000">
                    <div class="hero-badge">
                        <i class="fas fa-shield-halved"></i> Certified &amp; Safe LPG Filling In Oman
                    </div>
                    <h1 class="hero-title">
                        Bring Your Empty Cylinder, <br>
                        <span class="highlight">We Refill Clean &amp; Safe LPG</span> In Minutes!
                    </h1>
                    <p class="hero-desc">
                        Welcome to <strong>Samad Al Shan Gas</strong>, your trusted LPG refilling and cylinder provider
                        in the Sultanate of Oman. Clients walk in with their empty gas cylinders and get certified,
                        precise, leak-tested LPG refilled instantly at the official approved prices.
                    </p>

                    <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                        <a href="#how-it-works" class="btn btn-flame py-3 px-4 fs-6">
                            <i class="fas fa-gas-pump"></i> Refill Process Guide
                        </a>
                        <a href="#products" class="btn btn-outline-white py-3 px-4 fs-6">
                            <i class="fas fa-boxes-stacked"></i> View Cylinder Sizes
                        </a>
                    </div>

                    <div class="d-flex align-items-center gap-4 pt-3 border-top border-white-50">
                        <div>
                            <h4 class="fw-bold mb-0 text-warning">100%</h4>
                            <small class="text-white-50">Certified Safe LPG</small>
                        </div>
                        <div class="vr bg-white-50 opacity-25"></div>
                        <div>
                            <h4 class="fw-bold mb-0 text-warning">11 / 22 / 44 KG</h4>
                            <small class="text-white-50">All Cylinder Sizes</small>
                        </div>
                        <div class="vr bg-white-50 opacity-25"></div>
                        <div>
                            <h4 class="fw-bold mb-0 text-warning">Muscat &amp; Oman</h4>
                            <small class="text-white-50">Prime Accessible Location</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5" data-aos="zoom-in" data-aos-duration="1000">
                    <div class="hero-card floating-element">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">
                                <i class="fas fa-bolt me-1"></i> Instant Counter Refill
                            </span>
                            <span class="text-white-50 small"><i class="fas fa-clock me-1"></i> 2 - 5 Minutes</span>
                        </div>

                        <div class="hero-cylinder-preview">
                            <!-- 11KG -->
                            <div class="cylinder-pillar text-center">
                                <div class="cylinder-icon-box" style="width: 60px; height: 90px;">
                                    <i class="fas fa-bottle-droplet fs-2"></i>
                                </div>
                                <span class="fw-bold text-white fs-6">11 KG</span>
                                <small class="text-white-50">Compact</small>
                            </div>
                            <!-- 22KG -->
                            <div class="cylinder-pillar text-center">
                                <div class="cylinder-icon-box"
                                    style="width: 75px; height: 120px; background: linear-gradient(135deg, #007aff, #00c4cc);">
                                    <i class="fas fa-fire fs-1"></i>
                                </div>
                                <span class="fw-bold text-white fs-5">22 KG</span>
                                <small class="text-warning fw-bold">Most Popular</small>
                            </div>
                            <!-- 44KG -->
                            <div class="cylinder-pillar text-center">
                                <div class="cylinder-icon-box"
                                    style="width: 85px; height: 145px; background: linear-gradient(135deg, #10b981, #059669);">
                                    <i class="fas fa-shield-heart fs-1"></i>
                                </div>
                                <span class="fw-bold text-white fs-6">44 KG</span>
                                <small class="text-white-50">Commercial</small>
                            </div>
                        </div>

                        <div class="p-3 bg-white bg-opacity-10 rounded-4 text-center mt-3">
                            <div class="text-white fw-bold mb-1">
                                <i class="fas fa-check-circle text-success me-1"></i> Pressure &amp; Valve Leak-Tested
                            </div>
                            <small class="text-white-50">Every filled cylinder undergoes automatic digital scale
                                verification before delivery.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── TRUST STRIP ── -->
    <div class="container">
        <div class="trust-strip">
            <div class="row g-4 align-items-center">
                <div class="col-md-3 col-sm-6">
                    <div class="trust-item">
                        <div class="trust-icon bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-scale-balanced"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Accurate Digital Weight</h6>
                            <small class="text-muted">Exact KG filling guaranteed</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="trust-item">
                        <div class="trust-icon bg-warning bg-opacity-10 text-warning">
                            <i class="fas fa-shield-virus"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Zero Leak Guarantee</h6>
                            <small class="text-muted">High-standard valve safety</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="trust-item">
                        <div class="trust-icon bg-success bg-opacity-10 text-success">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Rapid Express Fill</h6>
                            <small class="text-muted">No long waiting queues</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="trust-item">
                        <div class="trust-icon bg-info bg-opacity-10 text-info">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Oman Approved Price</h6>
                            <small class="text-muted">Standard transparent OMR rates</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── HOW IT WORKS: EMPTY CYLINDER TO FILLED REFILL ── -->
    <section class="py-5 my-5" id="how-it-works">
        <div class="container py-4">
            <div class="text-center max-w-xl mx-auto mb-5" data-aos="fade-up">
                <span class="section-tag">Easy 4-Step Walk-In Process</span>
                <h2 class="section-heading">How Our LPG Cylinder Refill Works</h2>
                <p class="section-desc">
                    Clients visit our agency in Muscat / Oman with empty cylinders. Here is our simple, safe, and fast
                    step-by-step refilling workflow.
                </p>
            </div>

            <div class="row g-4">
                <!-- Step 1 -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="step-card">
                        <span class="step-num">01</span>
                        <div class="step-icon bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-truck-pickup"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Bring Empty Cylinder</h5>
                        <p class="text-muted small mb-0">
                            Visit our agency counter with your empty 11kg, 22kg, or 44kg domestic or restaurant gas
                            cylinder.
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="step-card">
                        <span class="step-num">02</span>
                        <div class="step-icon bg-warning bg-opacity-10 text-warning">
                            <i class="fas fa-magnifying-glass-arrow-right"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Safety &amp; Valve Inspection</h5>
                        <p class="text-muted small mb-0">
                            Our certified technicians inspect cylinder validity, tare weight, body condition, and safety
                            seal integrity.
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="step-card">
                        <span class="step-num">03</span>
                        <div class="step-icon bg-success bg-opacity-10 text-success">
                            <i class="fas fa-gas-pump"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Precision LPG Filling</h5>
                        <p class="text-muted small mb-0">
                            Filled with high-purity, blue-flame LPG gas using calibrated digital dispensing scales for
                            exact net weight.
                        </p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="step-card">
                        <span class="step-num">04</span>
                        <div class="step-icon bg-info bg-opacity-10 text-info">
                            <i class="fas fa-circle-check"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Instant Pickup &amp; Pay</h5>
                        <p class="text-muted small mb-0">
                            Take your fresh, sealed gas cylinder with computer-generated invoice receipt in OMR. Cash
                            and card accepted!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── PRODUCTS: CYLINDER TYPES ── -->
    <section class="py-5 bg-light" id="products">
        <div class="container py-4">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-tag">Official Cylinder Sizes</span>
                <h2 class="section-heading">LPG Gas Cylinders Available For Refill &amp; Sale</h2>
                <p class="section-desc">
                    Whether you need a refill for your existing empty cylinder or want to purchase a brand-new complete
                    cylinder package.
                </p>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- 11 KG Cylinder -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="cylinder-card">
                        <div class="cylinder-header">
                            <span class="cylinder-tag">Compact</span>
                            <div class="my-3">
                                <i class="fas fa-bottle-droplet text-primary" style="font-size: 70px;"></i>
                            </div>
                            <h4 class="fw-bold mb-1">11 KG LPG Cylinder</h4>
                            <p class="text-muted small mb-0">Small Household &amp; Outdoor BBQ</p>
                        </div>
                        <div class="cylinder-body">
                            <div>
                                <div class="spec-item">
                                    <span class="text-muted">Gas Capacity:</span>
                                    <strong>11.0 KG (Pure LPG)</strong>
                                </div>
                                <div class="spec-item">
                                    <span class="text-muted">Ideal For:</span>
                                    <strong>Small Kitchens, Camping</strong>
                                </div>
                                <div class="spec-item">
                                    <span class="text-muted">Service Type:</span>
                                    <strong class="text-primary">Empty Exchange / Refill</strong>
                                </div>
                                <div class="spec-item">
                                    <span class="text-muted">Valve Type:</span>
                                    <strong>Standard Quick-On 20mm</strong>
                                </div>
                            </div>
                            <div class="mt-4 pt-3 border-top">
                                <a href="https://wa.me/96890000000?text=Hello,%20I%20want%2011kg%20gas%20refill"
                                    target="_blank" class="btn btn-outline-primary w-100 rounded-pill fw-bold">
                                    <i class="fab fa-whatsapp me-1"></i> Order 11KG Refill
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 22 KG Cylinder (Featured) -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="cylinder-card border-primary" style="box-shadow: 0 15px 35px rgba(0, 86, 179, 0.15);">
                        <div class="cylinder-header"
                            style="background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);">
                            <span class="cylinder-tag" style="background: var(--flame-orange);">Most Popular in
                                Oman</span>
                            <div class="my-3">
                                <i class="fas fa-fire-flame-curved text-danger" style="font-size: 80px;"></i>
                            </div>
                            <h4 class="fw-bold mb-1 text-primary">22 KG Standard Cylinder</h4>
                            <p class="text-muted small mb-0">Standard Omani Family Kitchen</p>
                        </div>
                        <div class="cylinder-body">
                            <div>
                                <div class="spec-item">
                                    <span class="text-muted">Gas Capacity:</span>
                                    <strong>22.0 KG (Standard Size)</strong>
                                </div>
                                <div class="spec-item">
                                    <span class="text-muted">Ideal For:</span>
                                    <strong>Family Homes, Bakeries</strong>
                                </div>
                                <div class="spec-item">
                                    <span class="text-muted">Service Type:</span>
                                    <strong class="text-primary">Instant Refill / New Cylinder</strong>
                                </div>
                                <div class="spec-item">
                                    <span class="text-muted">Flame Type:</span>
                                    <strong class="text-success">Clean Blue Efficiency</strong>
                                </div>
                            </div>
                            <div class="mt-4 pt-3 border-top">
                                <a href="https://wa.me/96890000000?text=Hello,%20I%20want%2022kg%20gas%20refill"
                                    target="_blank" class="btn btn-flame w-100 justify-content-center">
                                    <i class="fab fa-whatsapp me-1"></i> Order 22KG Refill
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 44 KG Cylinder -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="cylinder-card">
                        <div class="cylinder-header">
                            <span class="cylinder-tag bg-dark">Commercial</span>
                            <div class="my-3">
                                <i class="fas fa-industry text-success" style="font-size: 70px;"></i>
                            </div>
                            <h4 class="fw-bold mb-1">44 KG Jumbo Cylinder</h4>
                            <p class="text-muted small mb-0">Restaurants, Hotels &amp; Catering</p>
                        </div>
                        <div class="cylinder-body">
                            <div>
                                <div class="spec-item">
                                    <span class="text-muted">Gas Capacity:</span>
                                    <strong>44.0 KG (Heavy Commercial)</strong>
                                </div>
                                <div class="spec-item">
                                    <span class="text-muted">Ideal For:</span>
                                    <strong>Hotels, Restaurants, Catering</strong>
                                </div>
                                <div class="spec-item">
                                    <span class="text-muted">Service Type:</span>
                                    <strong class="text-primary">Commercial Refill / Bulk Supply</strong>
                                </div>
                                <div class="spec-item">
                                    <span class="text-muted">Refill Time:</span>
                                    <strong>Immediate On Counter</strong>
                                </div>
                            </div>
                            <div class="mt-4 pt-3 border-top">
                                <a href="https://wa.me/96890000000?text=Hello,%20I%20want%2044kg%20commercial%20gas%20refill"
                                    target="_blank" class="btn btn-outline-primary w-100 rounded-pill fw-bold">
                                    <i class="fab fa-whatsapp me-1"></i> Order 44KG Refill
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── SERVICES ── -->
    <section class="py-5" id="services">
        <div class="container py-4">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-tag">What We Offer</span>
                <h2 class="section-heading">Our Comprehensive Gas Solutions</h2>
                <p class="section-desc">
                    Serving households, catering companies, and commercial kitchens across Muscat &amp; surrounding
                    wilayats.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card">
                        <div class="trust-icon bg-primary bg-opacity-10 text-primary mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fas fa-arrows-rotate fs-3"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Empty Cylinder Refill</h5>
                        <p class="text-muted">
                            Bring any empty 11kg, 22kg, or 44kg gas cylinder. We will inspect, purge air if needed,
                            refill with pure gas, and deliver it sealed.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-card">
                        <div class="trust-icon bg-warning bg-opacity-10 text-warning mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fas fa-cart-plus fs-3"></i>
                        </div>
                        <h5 class="fw-bold mb-2">New Cylinder Sale</h5>
                        <p class="text-muted">
                            Need an additional or replacement cylinder? Buy brand-new, factory-certified cylinders with
                            valid stamps and warranty in Oman.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-card">
                        <div class="trust-icon bg-success bg-opacity-10 text-success mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fas fa-building-columns fs-3"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Commercial &amp; Hotel Contracts</h5>
                        <p class="text-muted">
                            Dedicated recurring supply for cafeterias, restaurants, bakeries, and food trucks with
                            regular scheduled refills.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-card">
                        <div class="trust-icon bg-danger bg-opacity-10 text-danger mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fas fa-screwdriver-wrench fs-3"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Valve &amp; Regulator Replacement</h5>
                        <p class="text-muted">
                            Safety first: We check worn out valves, replace old O-rings, and supply high-quality LPG low
                            and high pressure regulators.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-card">
                        <div class="trust-icon bg-info bg-opacity-10 text-info mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-truck-fast fs-3"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Bulk Gas Supply &amp; Transport</h5>
                        <p class="text-muted">
                            Certified delivery vehicles equipped with safety cages to safely transport filled cylinders
                            directly to your location.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="service-card">
                        <div class="trust-icon bg-purple bg-opacity-10 text-primary mb-3"
                            style="width: 60px; height: 60px;">
                            <i class="fas fa-receipt fs-3"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Official Computerized Billing</h5>
                        <p class="text-muted">
                            Transparent invoicing with breakdown in OMR (Omani Rial with 3 decimal precision) for clear
                            accounting and tax receipts.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── SAFETY & VIDEO EXPERIENCE SHOWCASE ── -->
    <section class="py-5 bg-light" id="about">
        <div class="container py-4">
            <div class="video-box-card" data-aos="fade-up">
                <div class="row align-items-center g-4">
                    <div class="col-lg-7">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3">
                            <i class="fas fa-video me-1"></i> Agency Tour &amp; Filling Safety
                        </span>
                        <h2 class="fw-bold mb-3 text-white">Experience Certified LPG Refilling In Action</h2>
                        <p class="text-light opacity-75 mb-4" style="line-height: 1.8;">
                            At Samad Al Shan Gas, every cylinder brought by clients is handled under rigorous safety
                            protocols. Watch how our technicians test, digitally weigh, and fill each unit to ensure
                            100% blue-flame cooking efficiency for your home and business.
                        </p>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-check-circle text-warning fs-5"></i>
                                    <span>High-Pressure Leak Testing</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-check-circle text-warning fs-5"></i>
                                    <span>Oman Civil Defence Compliant</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-check-circle text-warning fs-5"></i>
                                    <span>Pure Propane &amp; Butane Mix</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-check-circle text-warning fs-5"></i>
                                    <span>Express 5-Minute Turnaround</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 text-center">
                        <div class="p-4 bg-white bg-opacity-10 rounded-4 border border-white border-opacity-25">
                            <div class="mb-3">
                                <i class="fas fa-shield-halved text-warning" style="font-size: 64px;"></i>
                            </div>
                            <h5 class="fw-bold text-white mb-2">Safety Standard ISO Compliant</h5>
                            <p class="small text-white-50 mb-3">Always check the cap seal before connecting your
                                cylinder at home.</p>
                            <a href="#contact" class="btn btn-warning rounded-pill px-4 fw-bold">
                                <i class="fas fa-location-dot me-1"></i> Visit Filling Station
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── CLIENT REVIEWS / TESTIMONIALS ── -->
    <section class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-tag">Customer Trust</span>
                <h2 class="section-heading">What Our Clients in Oman Say</h2>
                <p class="section-desc">Reliable gas refilling trusted by hundreds of families and commercial kitchens
                    daily.</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="review-card">
                        <div class="stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted">
                            "I bring my 22kg empty cylinder every month. The refill is super quick, never takes more
                            than 3 minutes, and the flame at home is strong and blue!"
                        </p>
                        <div class="d-flex align-items-center gap-3 mt-4 pt-3 border-top">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                style="width: 44px; height: 44px;">
                                AK
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Ahmed Al-Kharusi</h6>
                                <small class="text-muted">Al Khoud, Muscat</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="review-card">
                        <div class="stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted">
                            "We run a restaurant in Muscat and need 44kg cylinders filled regularly. Samad Al Shan Gas
                            has always provided accurate weights and clean safety seals."
                        </p>
                        <div class="d-flex align-items-center gap-3 mt-4 pt-3 border-top">
                            <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                style="width: 44px; height: 44px;">
                                MR
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Mohammed Rashid</h6>
                                <small class="text-muted">Restaurant Owner, Seeb</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="review-card">
                        <div class="stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted">
                            "Excellent customer service and very honest digital weighing scales. Best LPG agency in
                            Mazoon Street area."
                        </p>
                        <div class="d-flex align-items-center gap-3 mt-4 pt-3 border-top">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                style="width: 44px; height: 44px;">
                                SB
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Salim Al-Balushi</h6>
                                <small class="text-muted">Resident, Muscat</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── CONTACT & LOCATION SECTION ── -->
    <section class="py-5 bg-light" id="contact">
        <div class="container py-4">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <span class="section-tag">Get In Touch</span>
                    <h2 class="section-heading">Visit Our Agency Or Call For Gas Refill</h2>
                    <p class="section-desc mb-4">
                        Bring your cylinders directly to our filling branch or reach out via WhatsApp/Phone for
                        commercial orders and queries.
                    </p>

                    <div class="d-flex flex-column gap-3 mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="trust-icon bg-primary bg-opacity-10 text-primary">
                                <i class="fas fa-location-dot"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark">Agency Address:</strong>
                                <span class="text-muted">Mazoon Street, Al Khoud 7, Muscat, Sultanate of Oman</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="trust-icon bg-success bg-opacity-10 text-success">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark">Phone &amp; WhatsApp:</strong>
                                <a href="https://wa.me/96890000000" target="_blank"
                                    class="text-decoration-none fw-bold text-success">+968 (Oman Hotline)</a>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="trust-icon bg-warning bg-opacity-10 text-warning">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark">Working Hours:</strong>
                                <span class="text-muted">Saturday - Thursday: 7:00 AM - 10:00 PM | Friday: 3:00 PM -
                                    10:00 PM</span>
                            </div>
                        </div>
                    </div>

                    <a href="https://wa.me/96890000000" target="_blank" class="btn btn-flame">
                        <i class="fab fa-whatsapp fs-5"></i> Chat On WhatsApp Now
                    </a>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5 bg-white">
                        <h4 class="fw-bold mb-3 text-primary">Send Quick Message / Request</h4>
                        <p class="text-muted small mb-4">Fill out this quick form and our agency team will connect with
                            you.</p>

                        <form
                            onsubmit="event.preventDefault(); alert('Thank you! Your message has been received. Our team will contact you shortly.');">
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Your Full Name</label>
                                <input type="text" class="form-control rounded-3" placeholder="e.g. Salim Al-Harthy"
                                    required>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Phone Number</label>
                                    <input type="tel" class="form-control rounded-3" placeholder="+968 9XXXXXXX"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Cylinder Size Needed</label>
                                    <select class="form-select rounded-3">
                                        <option value="22">22 KG (Standard)</option>
                                        <option value="11">11 KG (Small)</option>
                                        <option value="44">44 KG (Commercial)</option>
                                        <option value="new">Purchase New Cylinder</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold small">Notes / Questions</label>
                                <textarea class="form-control rounded-3" rows="3"
                                    placeholder="Tell us if you are walking in or need bulk delivery..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">
                                <i class="fas fa-paper-plane me-1"></i> Send Request
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── FOOTER ── -->
    <footer class="footer-custom">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="cylinder-icon-box" style="width: 36px; height: 36px; font-size: 18px;">
                            <i class="fas fa-fire-flame-curved"></i>
                        </div>
                        <span class="fs-5 fw-bold text-white">SAMAD AL SHAN GAS </span>
                    </div>
                    <p class="text-white-50 small mb-4" style="line-height: 1.8;">
                        Your premier authorized LPG cylinder refilling and gas solutions provider in the Sultanate of
                        Oman. Dedicated to customer safety, precise digital weights, and blue-flame cooking efficiency.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"
                            style="width:36px;height:36px;"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-sm btn-outline-light rounded-circle"
                            style="width:36px;height:36px;"><i class="fab fa-instagram"></i></a>
                        <a href="https://wa.me/96890000000" class="btn btn-sm btn-outline-light rounded-circle"
                            style="width:36px;height:36px;"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="footer-title">Quick Links</h6>
                    <ul class="list-unstyled footer-links small">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#how-it-works">Refill Process</a></li>
                        <li><a href="#products">Cylinder Sizes</a></li>
                        <li><a href="#services">Our Services</a></li>
                        <li><a href="#about">Safety Standards</a></li>
                        <li><a href="#contact">Contact &amp; Map</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="footer-title">Refill Services</h6>
                    <ul class="list-unstyled footer-links small">
                        <li><a href="#products">11 KG Domestic Cylinder</a></li>
                        <li><a href="#products">22 KG Family Cylinder</a></li>
                        <li><a href="#products">44 KG Restaurant Jumbo</a></li>
                        <li><a href="#services">New Cylinder Registration</a></li>
                        <li><a href="#services">Valve &amp; Hose Inspection</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="footer-title">Oman Location</h6>
                    <p class="text-white-50 small mb-2">
                        <i class="fas fa-location-dot text-warning me-2"></i> Mazoon St, Al Khoud 7, Muscat, Oman
                    </p>
                    <p class="text-white-50 small mb-2">
                        <i class="fas fa-phone text-warning me-2"></i> +968 (Hotline)
                    </p>
                    <p class="text-white-50 small">
                        <i class="fas fa-envelope text-warning me-2"></i> info@samadalshangas.com
                    </p>
                    <div class="mt-3">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-warning rounded-pill px-3">
                            <i class="fas fa-lock me-1"></i> Management Login
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-top border-white-50 opacity-25 pt-4 text-center small text-white-50">
                &copy; {{ date('Y') }} Samad Al Shan Gas. All Rights Reserved. Sultanate of Oman.
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS & AOS Animation -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        // Sticky Navbar shadow effect
        window.addEventListener('scroll', function () {
            const nav = document.querySelector('.navbar-custom');
            if (window.scrollY > 40) {
                nav.style.padding = '12px 0';
                nav.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.1)';
            } else {
                nav.style.padding = '18px 0';
                nav.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.05)';
            }
        });
    </script>
</body>

</html>