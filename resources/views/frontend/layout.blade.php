<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Samad Gas | Safe Energy. Better Tomorrow - Oman')</title>

    <!-- Google Fonts: Inter / Plus Jakarta Sans & Cairo for Arabic -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        :root {
            --brand-navy: #08213b;
            --brand-blue: #0958a5;
            --brand-accent-blue: #0b66c3;
            --brand-yellow: #f59e0b;
            --brand-gold: #ffb800;
            --brand-text-dark: #0f1e2f;
            --brand-text-muted: #64748b;
            --brand-footer-bg: #071927;
            --brand-stat-bg: #0b2542;
        }

        body {
            font-family: {{ app()->getLocale() == 'ar' ? "'Cairo', sans-serif" : "'Plus Jakarta Sans', sans-serif" }};
            color: var(--brand-text-dark);
            background-color: #ffffff;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        /* ── Top Blue Bar ── */
        .top-nav-strip {
            background-color: #0b2f56;
            color: #d1e2f4;
            font-size: 12px;
            padding: 7px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .top-nav-strip a {
            color: #d1e2f4;
            text-decoration: none;
            transition: color 0.2s;
        }

        .top-nav-strip a:hover {
            color: #ffffff;
        }

        .top-social-icon {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #15457a;
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            text-decoration: none;
            transition: background 0.2s;
        }

        .top-social-icon:hover {
            background: var(--brand-yellow);
            color: #000;
        }

        /* ── Main Navigation ── */
        .main-navbar {
            background: #ffffff;
            padding: 14px 0;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.04);
            position: sticky;
            top: 0;
            z-index: 1050;
        }

        .brand-logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-logo-icon {
            width: 36px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-title-wrap h2 {
            font-size: 24px;
            font-weight: 900;
            margin: 0;
            line-height: 1.05;
            color: #092540;
            letter-spacing: -0.5px;
        }

        .brand-title-wrap p {
            font-size: 10.5px;
            color: #64748b;
            margin: 0;
            font-weight: 600;
            letter-spacing: 0.2px;
        }

        .nav-link-btn {
            font-weight: 600;
            font-size: 13.5px;
            color: #334155 !important;
            padding: 7px 16px !important;
            border-radius: 20px;
            transition: all 0.2s;
            text-decoration: none;
        }

        .nav-link-btn:hover, .nav-link-btn.active {
            color: #ffffff !important;
            background-color: #0b5fa5 !important;
        }

        .btn-get-support {
            background-color: #f7a400;
            color: #0c233c !important;
            font-weight: 700;
            font-size: 13.5px;
            padding: 8px 18px;
            border-radius: 20px;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 3px 10px rgba(247, 164, 0, 0.3);
            transition: all 0.2s;
        }

        .btn-get-support:hover {
            background-color: #e69500;
            transform: translateY(-1px);
        }

        .lang-switch-link {
            border: 1px solid #cbd5e1;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            color: #334155;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #f8fafc;
            transition: all 0.2s;
        }

        .lang-switch-link:hover {
            background: #0b5fa5;
            color: #fff;
            border-color: #0b5fa5;
        }

        /* ── Hero Section ── */
        .hero-banner-section {
            background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);
            padding: 40px 0 30px;
            position: relative;
        }

        .hero-headline {
            font-size: 46px;
            font-weight: 900;
            line-height: 1.15;
            color: #0b2742;
            letter-spacing: -1px;
            margin-bottom: 14px;
        }

        .hero-headline .text-gold {
            color: #f59e0b;
        }

        .hero-subtext {
            font-size: 14.5px;
            color: #475569;
            line-height: 1.6;
            margin-bottom: 22px;
            max-width: 480px;
        }

        .hero-checklist {
            list-style: none;
            padding: 0;
            margin: 0 0 25px 0;
        }

        .hero-checklist li {
            font-size: 13.5px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .hero-checklist li i {
            color: #0b60b0;
            font-size: 15px;
        }

        .btn-hero-primary {
            background-color: #08213b;
            color: #ffffff !important;
            font-size: 13.5px;
            font-weight: 700;
            padding: 10px 22px;
            border-radius: 20px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-hero-primary:hover {
            background-color: #0e3760;
        }

        .btn-hero-video {
            background-color: #ffffff;
            color: #08213b !important;
            font-size: 13.5px;
            font-weight: 700;
            padding: 10px 20px;
            border-radius: 20px;
            border: 1.5px solid #cbd5e1;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-hero-video:hover {
            background-color: #f8fafc;
            border-color: #94a3b8;
        }

        .hero-image-wrap {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(9, 37, 64, 0.12);
        }

        .hero-image-wrap img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }

        /* ── Services Section ── */
        .services-section {
            padding: 60px 0 50px;
            background: #ffffff;
        }

        .section-header-pill {
            display: inline-block;
            width: 38px;
            height: 4px;
            background-color: #f59e0b;
            border-radius: 3px;
            margin-bottom: 10px;
        }

        .section-header-title {
            font-size: 32px;
            font-weight: 800;
            color: #092540;
            margin-bottom: 6px;
        }

        .section-header-sub {
            font-size: 13.5px;
            color: #64748b;
            margin-bottom: 40px;
        }

        .service-card-box {
            background: #ffffff;
            border: 1px solid #e6edf5;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            text-align: center;
        }

        .service-card-box:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 28px rgba(9, 47, 86, 0.1);
            border-color: #bfdbfe;
        }

        .service-card-thumb {
            height: 125px;
            overflow: hidden;
            position: relative;
            background: #f1f5f9;
        }

        .service-card-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .service-card-box:hover .service-card-thumb img {
            transform: scale(1.06);
        }

        .service-floating-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: #0b5fa5;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin: -22px auto 12px;
            position: relative;
            z-index: 2;
            border: 3px solid #ffffff;
            box-shadow: 0 4px 10px rgba(11, 95, 165, 0.3);
        }

        .service-card-body {
            padding: 0 16px 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .service-card-body h5 {
            font-size: 15.5px;
            font-weight: 800;
            color: #092540;
            margin-bottom: 8px;
        }

        .service-card-body p {
            font-size: 12px;
            color: #64748b;
            line-height: 1.5;
            margin: 0;
        }

        /* ── About Section ── */
        .about-section-wrap {
            padding: 50px 0 60px;
            background: #ffffff;
        }

        .about-image-card {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .about-image-card img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }

        .about-badge-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }

        .about-badge-bar {
            width: 32px;
            height: 3.5px;
            background: #f59e0b;
            border-radius: 2px;
        }

        .about-badge-text {
            font-size: 13px;
            font-weight: 700;
            color: #092540;
        }

        .about-title {
            font-size: 34px;
            font-weight: 900;
            color: #092540;
            line-height: 1.2;
            margin-bottom: 14px;
        }

        .about-desc {
            font-size: 13.5px;
            color: #475569;
            line-height: 1.65;
            margin-bottom: 20px;
        }

        .about-features-row {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
        }

        .about-feature-item {
            font-size: 13px;
            font-weight: 700;
            color: #092540;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .about-feature-item i {
            color: #f59e0b;
            font-size: 15px;
        }

        .btn-learn-more {
            background-color: #f7a400;
            color: #0c233c !important;
            font-weight: 700;
            font-size: 13.5px;
            padding: 8px 22px;
            border-radius: 20px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }

        .btn-learn-more:hover {
            background-color: #e69500;
        }

        /* Right Side Badges (Safety / 24/7) */
        .trust-badge-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 24px 16px;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        }

        .trust-badge-box i.fa-shield-halved {
            color: #0b5fa5;
            font-size: 38px;
            margin-bottom: 10px;
        }

        .trust-badge-box i.fa-headphones-simple {
            color: #0b5fa5;
            font-size: 34px;
            margin-bottom: 10px;
        }

        .trust-badge-box h5 {
            font-size: 15px;
            font-weight: 800;
            color: #092540;
            margin: 0;
        }

        .trust-badge-box p {
            font-size: 12px;
            color: #64748b;
            margin: 2px 0 0 0;
            font-weight: 600;
        }

        /* ── Dark Blue Stats Strip ── */
        .stats-dark-strip {
            background-color: #08213b;
            color: #ffffff;
            padding: 24px 0;
        }

        .stat-item-block {
            display: flex;
            align-items: center;
            gap: 14px;
            justify-content: center;
        }

        .stat-item-icon {
            font-size: 26px;
            color: #f59e0b;
        }

        .stat-item-info h4 {
            font-size: 18px;
            font-weight: 800;
            margin: 0;
            line-height: 1.1;
        }

        .stat-item-info p {
            font-size: 11.5px;
            color: #94a3b8;
            margin: 2px 0 0;
        }

        /* ── Blue CTA Banner with Cylinders ── */
        .cta-gas-banner {
            position: relative;
            background: linear-gradient(135deg, #09477d 0%, #1565a8 50%, #e2e8f0 100%);
            overflow: hidden;
        }

        .cta-banner-img {
            width: 100%;
            height: auto;
            max-height: 240px;
            object-fit: cover;
            display: block;
        }

        .cta-banner-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            padding-left: 60px;
            background: linear-gradient(90deg, rgba(7, 34, 60, 0.95) 0%, rgba(9, 64, 114, 0.8) 45%, rgba(0, 0, 0, 0) 75%);
            color: #ffffff;
        }

        .cta-banner-overlay h2 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .cta-banner-overlay p {
            font-size: 14px;
            color: #e2e8f0;
            margin: 0;
        }

        /* ── Footer ── */
        .site-footer {
            background-color: #071927;
            color: #cbd5e1;
            padding: 55px 0 20px;
            font-size: 13px;
        }

        .footer-logo-title {
            font-size: 22px;
            font-weight: 900;
            color: #ffffff;
            margin: 0;
            line-height: 1.1;
        }

        .footer-logo-sub {
            font-size: 10.5px;
            color: #94a3b8;
            margin: 3px 0 0;
        }

        .footer-col-title {
            font-size: 14.5px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 16px;
        }

        .footer-nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-nav-list li {
            margin-bottom: 8px;
        }

        .footer-nav-list a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-nav-list a:hover {
            color: #ffffff;
        }

        .footer-social-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            font-size: 13px;
            margin-right: 6px;
        }

        .social-fb { background-color: #1877f2; }
        .social-yt { background-color: #ff0000; }
        .social-wa { background-color: #25d366; }

        .footer-contact-line {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 9px;
            color: #94a3b8;
        }

        .footer-bottom-bar {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            margin-top: 40px;
            padding-top: 20px;
            font-size: 12px;
            color: #64748b;
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- ── 1. TOP NAV STRIP (Blue Bar) ── -->
    <div class="top-nav-strip">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="d-flex align-items-center gap-3 gap-md-4 flex-wrap">
                    <span><i class="fas fa-location-dot me-1"></i> Muscat, Oman</span>
                    <a href="tel:+96892966649"><i class="fas fa-phone me-1"></i> +968 9296 6649</a>
                    <a href="mailto:info@samadgas.com"><i class="fas fa-envelope me-1"></i> info@samadgas.com</a>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span><i class="far fa-clock me-1"></i> Mon - Sat: 7:00 AM - 10:00 PM</span>
                    <div class="d-flex align-items-center gap-1 ms-2">
                        <a href="#" class="top-social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="top-social-icon"><i class="fab fa-youtube"></i></a>
                        <a href="https://wa.me/96892966649" target="_blank" class="top-social-icon"><i class="fab fa-whatsapp"></i></a>
                    </div>
                    <!-- Language Switcher -->
                    @if(app()->getLocale() == 'ar')
                        <a href="{{ route('lang.switch', 'en') }}" class="lang-switch-link ms-2">
                            <i class="fas fa-globe"></i> English
                        </a>
                    @else
                        <a href="{{ route('lang.switch', 'ar') }}" class="lang-switch-link ms-2">
                            <i class="fas fa-globe"></i> العربية
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ── 2. MAIN NAVBAR ── -->
    <nav class="main-navbar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Logo -->
                <a href="{{ route('landing') }}" class="brand-logo-area">
                    <img src="{{ asset('images/design/logo_flame.jpg') }}" alt="Samad Gas Logo" style="height: 42px; width: auto; object-fit: contain;">
                    <div class="brand-title-wrap">
                        <h2>Samad Gas</h2>
                        <p>Safe Energy. Better Tomorrow</p>
                    </div>
                </a>

                <!-- Nav Menu Links -->
                <div class="d-none d-lg-flex align-items-center gap-2">
                    <a href="{{ route('landing') }}" class="nav-link-btn {{ request()->routeIs('landing') ? 'active' : '' }}">
                        {{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}
                    </a>
                    <a href="{{ route('public.services') }}" class="nav-link-btn {{ request()->routeIs('public.services') ? 'active' : '' }}">
                        {{ app()->getLocale() == 'ar' ? 'خدماتنا' : 'Our Services' }}
                    </a>
                    <a href="{{ route('public.about') }}" class="nav-link-btn {{ request()->routeIs('public.about') ? 'active' : '' }}">
                        {{ app()->getLocale() == 'ar' ? 'من نحن' : 'About Us' }}
                    </a>
                    <a href="{{ route('public.products') }}" class="nav-link-btn {{ request()->routeIs('public.products') ? 'active' : '' }}">
                        {{ app()->getLocale() == 'ar' ? 'التزامنا' : 'Our Commitment' }}
                    </a>
                    <a href="{{ route('public.contact') }}" class="nav-link-btn {{ request()->routeIs('public.contact') ? 'active' : '' }}">
                        {{ app()->getLocale() == 'ar' ? 'اتصل بنا' : 'Contact Us' }}
                    </a>
                </div>

                <!-- Right Action: Get Support -->
                <div class="d-flex align-items-center gap-2">
                    <a href="https://wa.me/96892966649" target="_blank" class="btn-get-support">
                        <i class="fas fa-headset"></i> <span>Get Support</span>
                    </a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold d-none d-md-inline-block">
                                Login
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- ── CONTENT YIELD ── -->
    <main>
        @yield('content')
    </main>

    <!-- ── FOOTER (Matching Image Design) ── -->
    <footer class="site-footer">
        <div class="container">
            <div class="row g-4">
                <!-- Col 1: Brand -->
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <img src="{{ asset('images/design/logo_flame.jpg') }}" alt="Samad Gas Logo" style="height: 38px; width: auto;">
                        <div>
                            <h3 class="footer-logo-title">Samad Gas</h3>
                            <p class="footer-logo-sub">Safe Energy. Better Tomorrow</p>
                        </div>
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h5 class="footer-col-title">Quick Links</h5>
                    <ul class="footer-nav-list">
                        <li><a href="{{ route('landing') }}">Home</a></li>
                        <li><a href="{{ route('public.services') }}">Our Services</a></li>
                        <li><a href="{{ route('public.about') }}">About Us</a></li>
                        <li><a href="{{ route('public.contact') }}">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Col 3: Our Services -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h5 class="footer-col-title">Our Services</h5>
                    <ul class="footer-nav-list">
                        <li><a href="{{ route('public.services') }}">Cylinder Filling</a></li>
                        <li><a href="{{ route('public.services') }}">Bulk Supply</a></li>
                        <li><a href="{{ route('public.services') }}">Store Supply</a></li>
                    </ul>
                </div>

                <!-- Col 4: Follow Us -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h5 class="footer-col-title">Follow Us</h5>
                    <div class="d-flex align-items-center">
                        <a href="#" class="footer-social-btn social-fb"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="footer-social-btn social-yt"><i class="fab fa-youtube"></i></a>
                        <a href="https://wa.me/96892966649" target="_blank" class="footer-social-btn social-wa"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Col 5: Contact Info -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-col-title">Contact Info</h5>
                    <div class="footer-contact-line">
                        <i class="fas fa-phone text-primary"></i>
                        <span>+968 9296 6649</span>
                    </div>
                    <div class="footer-contact-line">
                        <i class="fas fa-envelope text-primary"></i>
                        <span>info@samadgas.com</span>
                    </div>
                    <div class="footer-contact-line">
                        <i class="fas fa-location-dot text-primary"></i>
                        <span>Muscat, Oman</span>
                    </div>
                </div>
            </div>

            <div class="footer-bottom-bar d-flex justify-content-between align-items-center flex-wrap gap-2">
                <span>&copy; {{ date('Y') }} Samad Gas. All Rights Reserved.</span>
                <span>Powered by Excellence <i class="fas fa-heart text-danger"></i></span>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
