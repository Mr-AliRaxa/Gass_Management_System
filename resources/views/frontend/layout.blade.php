<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Samad Al Shan Gas | صمد الشأن للغاز - Oman LPG Gas Services')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">

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
            --wave-dark: #071927;
        }

        body {
            font-family: {{ app()->getLocale() == 'ar' ? "'Cairo', sans-serif" : "'Plus Jakarta Sans', sans-serif" }};
            color: var(--text-dark);
            background-color: #ffffff;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── Top Alert / Info Bar ── */
        .top-info-bar {
            background: #051a2f;
            color: #94a3b8;
            font-size: 13px;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .top-info-bar a {
            color: #e2e8f0;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .top-info-bar a:hover {
            color: var(--flame-gold);
        }

        /* ── Modern Floating Header / Navbar ── */
        .header-custom {
            position: sticky;
            top: 0;
            z-index: 1040;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(14px);
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .navbar-brand-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--flame-orange) 0%, #ff4500 100%);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            box-shadow: 0 6px 16px rgba(255, 107, 26, 0.35);
        }

        .brand-text-wrap h1 {
            font-size: 20px;
            font-weight: 900;
            margin: 0;
            line-height: 1.15;
            color: var(--primary-dark);
            letter-spacing: -0.5px;
        }

        .brand-text-wrap h1 span {
            color: var(--flame-orange);
        }

        .brand-text-wrap small {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            display: block;
        }

        .nav-link-custom {
            font-weight: 700;
            color: #334155;
            padding: 10px 18px !important;
            border-radius: 10px;
            font-size: 14.5px;
            transition: all 0.25s ease;
            text-decoration: none;
            display: inline-block;
        }

        .nav-link-custom:hover, .nav-link-custom.active {
            color: var(--primary-blue) !important;
            background: rgba(0, 86, 179, 0.07);
        }

        /* ── Language Switcher Button ── */
        .lang-switch-btn {
            background: #f1f5f9;
            border: 1.5px solid #cbd5e1;
            border-radius: 50px;
            padding: 6px 14px;
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.25s ease;
        }

        .lang-switch-btn:hover {
            background: #0056b3;
            color: #ffffff;
            border-color: #0056b3;
            transform: translateY(-1px);
        }

        .btn-flame {
            background: linear-gradient(135deg, var(--flame-orange) 0%, #ff4500 100%);
            color: #ffffff !important;
            font-weight: 700;
            border-radius: 50px;
            padding: 9px 22px;
            box-shadow: 0 4px 15px rgba(255, 107, 26, 0.35);
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            text-decoration: none;
        }

        .btn-flame:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 26, 0.45);
            color: #ffffff;
        }

        /* ── Page Header / Breadcrumbs Banner ── */
        .page-banner {
            background: linear-gradient(135deg, rgba(7, 42, 77, 0.95) 0%, rgba(0, 86, 179, 0.9) 100%), 
                        url("{{ asset('images/login-bg.png') }}") center center / cover no-repeat;
            padding: 70px 0 60px;
            color: #fff;
            position: relative;
            text-align: center;
        }

        .page-banner h1 {
            font-size: 42px;
            font-weight: 900;
            letter-spacing: -0.5px;
            margin-bottom: 12px;
        }

        .page-banner p {
            color: #cbd5e1;
            font-size: 17px;
            max-width: 650px;
            margin: 0 auto 16px;
        }

        .banner-breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 13px;
            backdrop-filter: blur(8px);
        }

        .banner-breadcrumb a {
            color: #f8fafc;
            text-decoration: none;
        }

        .banner-breadcrumb span {
            color: var(--flame-gold);
            font-weight: 700;
        }

        /* ── WAVE FOOTER DESIGN ── */
        .footer-wrapper {
            margin-top: auto;
            position: relative;
            background: var(--wave-dark);
            color: #cbd5e1;
        }

        .wave-svg-container {
            position: relative;
            top: 1px;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }

        .wave-svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 70px;
        }

        .wave-svg path {
            fill: #ffffff;
        }

        .footer-content {
            padding: 40px 0 25px;
        }

        .footer-brand h4 {
            font-size: 22px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 14px;
        }

        .footer-brand h4 span {
            color: var(--flame-orange);
        }

        .footer-desc {
            font-size: 14px;
            line-height: 1.75;
            color: #94a3b8;
            margin-bottom: 24px;
        }

        .footer-title {
            color: #ffffff;
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-title::after {
            content: "";
            position: absolute;
            bottom: 0;
            {{ app()->getLocale() == 'ar' ? 'right: 0;' : 'left: 0;' }}
            width: 38px;
            height: 3px;
            background: var(--flame-orange);
            border-radius: 2px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 11px;
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .footer-links a:hover {
            color: #ffffff;
            transform: translateX({{ app()->getLocale() == 'ar' ? '-6px' : '6px' }});
        }

        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
            font-size: 14px;
            color: #94a3b8;
        }

        .footer-contact-item i {
            color: var(--flame-gold);
            font-size: 16px;
            margin-top: 3px;
        }

        .footer-social-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .footer-social-btn:hover {
            background: var(--flame-orange);
            color: #ffffff;
            transform: translateY(-3px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding: 22px 0;
            font-size: 13.5px;
            color: #64748b;
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- ── TOP MINI BAR ── -->
    <div class="top-info-bar d-none d-md-block">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-4">
                    <span><i class="fas fa-location-dot text-warning me-1"></i> Mazoon St, Al Khoud 7, Muscat, Oman</span>
                    <span><i class="fas fa-clock text-warning me-1"></i> Sat - Thu: 7:00 AM - 10:00 PM</span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="https://wa.me/96890000000" target="_blank"><i class="fab fa-whatsapp text-success me-1"></i> +968 (Hotline)</a>
                    <span class="text-white-50">|</span>
                    <!-- Language Switcher in Top Bar -->
                    @if(app()->getLocale() == 'ar')
                        <a href="{{ route('lang.switch', 'en') }}" class="lang-switch-btn py-1 px-3">
                            <i class="fas fa-globe text-primary"></i> <strong>English</strong>
                        </a>
                    @else
                        <a href="{{ route('lang.switch', 'ar') }}" class="lang-switch-btn py-1 px-3">
                            <i class="fas fa-globe text-primary"></i> <strong>العربية (Arabic)</strong>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ── MAIN NAVBAR ── -->
    <header class="header-custom">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light py-2">
                <a class="navbar-brand-custom" href="{{ route('landing') }}">
                    <div class="brand-icon">
                        <i class="fas fa-fire-flame-curved"></i>
                    </div>
                    <div class="brand-text-wrap">
                        <h1>SAMAD <span>AL SHAN</span> GAS</h1>
                        <small>صمد الشأن للغاز • SULTANATE OF OMAN</small>
                    </div>
                </a>

                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#publicNav">
                    <i class="fas fa-bars-staggered fs-3 text-primary"></i>
                </button>

                <div class="collapse navbar-collapse" id="publicNav">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link-custom {{ request()->routeIs('landing') ? 'active' : '' }}" href="{{ route('landing') }}">
                                {{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-custom {{ request()->routeIs('public.about') ? 'active' : '' }}" href="{{ route('public.about') }}">
                                {{ app()->getLocale() == 'ar' ? 'من نحن' : 'About Us' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-custom {{ request()->routeIs('public.products') ? 'active' : '' }}" href="{{ route('public.products') }}">
                                {{ app()->getLocale() == 'ar' ? 'الأسطوانات (المنتجات)' : 'Products (Cylinders)' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-custom {{ request()->routeIs('public.services') ? 'active' : '' }}" href="{{ route('public.services') }}">
                                {{ app()->getLocale() == 'ar' ? 'خدماتنا' : 'Services' }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-custom {{ request()->routeIs('public.contact') ? 'active' : '' }}" href="{{ route('public.contact') }}">
                                {{ app()->getLocale() == 'ar' ? 'اتصل بنا' : 'Contact Us' }}
                            </a>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <!-- Mobile Language Switcher (Visible on small screens) -->
                        <div class="d-md-none mb-2 mb-lg-0">
                            @if(app()->getLocale() == 'ar')
                                <a href="{{ route('lang.switch', 'en') }}" class="lang-switch-btn">
                                    <i class="fas fa-globe"></i> English
                                </a>
                            @else
                                <a href="{{ route('lang.switch', 'ar') }}" class="lang-switch-btn">
                                    <i class="fas fa-globe"></i> العربية
                                </a>
                            @endif
                        </div>

                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/home') }}" class="btn btn-outline-primary rounded-pill px-3 fw-bold">
                                    <i class="fas fa-gauge me-1"></i> Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-3 fw-bold">
                                    <i class="fas fa-sign-in-alt me-1"></i> {{ app()->getLocale() == 'ar' ? 'دخول الموظفين' : 'Staff Login' }}
                                </a>
                            @endauth
                        @endif

                        <a href="https://wa.me/96890000000" target="_blank" class="btn btn-flame">
                            <i class="fab fa-whatsapp fs-5"></i> <span>{{ app()->getLocale() == 'ar' ? 'اطلب الغاز' : 'Order Refill' }}</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- ── MAIN CONTENT YIELD ── -->
    <main>
        @yield('content')
    </main>

    <!-- ── PROFESSIONAL WAVE FOOTER ── -->
    <footer class="footer-wrapper">
        <!-- SVG Wave Divider -->
        <div class="wave-svg-container">
            <svg class="wave-svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0 C150,90 350,-40 500,45 C650,130 900,10 1200,50 L1200,120 L0,120 Z"></path>
            </svg>
        </div>

        <div class="footer-content">
            <div class="container">
                <div class="row g-4 mb-5">
                    <!-- Brand Col -->
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-brand">
                            <h4>SAMAD <span>AL SHAN</span> GAS</h4>
                        </div>
                        <p class="footer-desc">
                            {{ app()->getLocale() == 'ar' 
                                ? 'وكالة صمد الشأن للغاز المعتمدة في سلطنة عمان. نقدم خدمات تعبئة الغاز الفورية للعملاء بأسطواناتهم الفارغة، وتوفير أسطوانات جديدة بأعلى معايير السلامة والمقاييس الرقمية المعتمدة.' 
                                : 'Premier authorized LPG gas refill agency in Sultanate of Oman. Clients walk in with empty cylinders to receive certified, leak-tested LPG refilled at approved OMR rates.' }}
                        </p>
                        <div class="d-flex gap-2">
                            <a href="#" class="footer-social-btn"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="footer-social-btn"><i class="fab fa-instagram"></i></a>
                            <a href="https://wa.me/96890000000" class="footer-social-btn" style="background:#25d366;"><i class="fab fa-whatsapp"></i></a>
                            <a href="#" class="footer-social-btn"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>

                    <!-- Navigation Links -->
                    <div class="col-lg-2 col-md-6 col-6">
                        <h6 class="footer-title">{{ app()->getLocale() == 'ar' ? 'روابط سريعة' : 'Quick Links' }}</h6>
                        <ul class="footer-links">
                            <li><a href="{{ route('landing') }}"><i class="fas fa-chevron-right small text-warning"></i> {{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}</a></li>
                            <li><a href="{{ route('public.about') }}"><i class="fas fa-chevron-right small text-warning"></i> {{ app()->getLocale() == 'ar' ? 'من نحن' : 'About Us' }}</a></li>
                            <li><a href="{{ route('public.products') }}"><i class="fas fa-chevron-right small text-warning"></i> {{ app()->getLocale() == 'ar' ? 'الأسطوانات' : 'Cylinder Sizes' }}</a></li>
                            <li><a href="{{ route('public.services') }}"><i class="fas fa-chevron-right small text-warning"></i> {{ app()->getLocale() == 'ar' ? 'خدماتنا' : 'Services' }}</a></li>
                            <li><a href="{{ route('public.contact') }}"><i class="fas fa-chevron-right small text-warning"></i> {{ app()->getLocale() == 'ar' ? 'اتصل بنا' : 'Contact Us' }}</a></li>
                        </ul>
                    </div>

                    <!-- Products / Cylinder Sizes -->
                    <div class="col-lg-3 col-md-6 col-6">
                        <h6 class="footer-title">{{ app()->getLocale() == 'ar' ? 'الأسطوانات المتاحة' : 'LPG Cylinders' }}</h6>
                        <ul class="footer-links">
                            <li><a href="{{ route('public.products') }}"><i class="fas fa-fire small text-warning"></i> 11 KG Domestic Compact</a></li>
                            <li><a href="{{ route('public.products') }}"><i class="fas fa-fire small text-warning"></i> 22 KG Family Standard</a></li>
                            <li><a href="{{ route('public.products') }}"><i class="fas fa-fire small text-warning"></i> 44 KG Commercial Jumbo</a></li>
                            <li><a href="{{ route('public.services') }}"><i class="fas fa-check-circle small text-success"></i> New Cylinder Purchase</a></li>
                            <li><a href="{{ route('public.services') }}"><i class="fas fa-check-circle small text-success"></i> Valve &amp; Regulator Check</a></li>
                        </ul>
                    </div>

                    <!-- Contact & Info -->
                    <div class="col-lg-3 col-md-6">
                        <h6 class="footer-title">{{ app()->getLocale() == 'ar' ? 'فرع عمان' : 'Oman Location' }}</h6>
                        <div class="footer-contact-item">
                            <i class="fas fa-location-dot"></i>
                            <span>Mazoon Street, Al Khoud 7, Muscat, Sultanate of Oman</span>
                        </div>
                        <div class="footer-contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+968 (Hotline) / WhatsApp</span>
                        </div>
                        <div class="footer-contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>info@samadalshangas.com</span>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                <i class="fas fa-lock me-1"></i> Management Login
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Footer Bottom Row -->
                <div class="footer-bottom text-center">
                    <p class="mb-0">
                        &copy; {{ date('Y') }} <strong>Samad Al Shan Gas (صمد الشأن للغاز)</strong>. All Rights Reserved. Sultanate of Oman.
                    </p>
                </div>
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
    </script>
    @stack('scripts')
</body>
</html>
