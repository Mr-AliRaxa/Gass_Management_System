<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Samad Gas | Safe Energy. Better Tomorrow - Oman')</title>

    <!-- Google Fonts: Inter / Plus Jakarta Sans & Cairo for Arabic -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Cairo:wght@400;600;700;800;900&display=swap"
        rel="stylesheet">

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
            font-family:
                {{ app()->getLocale() == 'ar' ? "'Cairo', sans-serif" : "'Plus Jakarta Sans', sans-serif" }}
            ;
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

        @media (max-width: 767.98px) {
            .top-nav-strip {
                padding: 6px 0;
                font-size: 11px;
            }

            .top-hide-sm {
                display: none !important;
            }
        }

        /* ── Main Navigation ── */
        .main-navbar {
            background: #ffffff;
            padding: 12px 0;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
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

        .brand-logo-img {
            height: 42px;
            width: auto;
            object-fit: contain;
            transition: height 0.2s;
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
            padding: 8px 16px !important;
            border-radius: 20px;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .nav-link-btn:hover,
        .nav-link-btn.active {
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
            white-space: nowrap;
        }

        .btn-get-support:hover {
            background-color: #e69500;
            transform: translateY(-1px);
        }

        .mobile-support-btn {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 16px;
        }

        /* ── Custom Animated Mobile Hamburger Toggler ── */
        .custom-nav-toggler {
            border: 1.5px solid #0b5fa5 !important;
            background: #f0f7ff !important;
            border-radius: 10px !important;
            padding: 7px 8px !important;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
            width: 40px;
            height: 38px;
            box-shadow: 0 2px 6px rgba(11, 95, 165, 0.12);
            transition: all 0.25s ease;
            cursor: pointer;
        }

        .custom-nav-toggler:focus {
            box-shadow: 0 0 0 3px rgba(11, 95, 165, 0.25) !important;
            outline: none !important;
        }

        .custom-nav-toggler .toggler-icon-bar {
            width: 20px;
            height: 2.5px;
            background-color: #0b5fa5;
            border-radius: 2px;
            transition: all 0.25s ease;
            display: block;
        }

        .custom-nav-toggler:not(.collapsed) .top-bar {
            transform: translateY(6px) rotate(45deg);
        }

        .custom-nav-toggler:not(.collapsed) .middle-bar {
            opacity: 0;
        }

        .custom-nav-toggler:not(.collapsed) .bottom-bar {
            transform: translateY(-6px) rotate(-45deg);
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: #ffffff;
                border-radius: 16px;
                padding: 14px 16px;
                margin-top: 12px;
                box-shadow: 0 12px 32px rgba(9, 37, 64, 0.12);
                border: 1px solid #e2e8f0;
            }

            .nav-link-btn {
                display: flex !important;
                padding: 10px 14px !important;
                margin-bottom: 5px;
                font-size: 14.5px !important;
                border-radius: 10px !important;
                background: #f8fafc;
                color: #0f172a !important;
            }

            .nav-link-btn:hover,
            .nav-link-btn.active {
                background-color: #0b5fa5 !important;
                color: #ffffff !important;
            }

            .nav-link-btn:hover i,
            .nav-link-btn.active i {
                color: #ffffff !important;
            }

            .brand-title-wrap h2 {
                font-size: 20px;
            }

            .brand-title-wrap p {
                font-size: 9.5px;
            }

            .brand-logo-img {
                height: 36px;
            }
        }

        @media (max-width: 480px) {
            .brand-title-wrap h2 {
                font-size: 17px;
            }

            .brand-title-wrap p {
                font-size: 8.5px;
            }

            .brand-logo-img {
                height: 32px;
            }

            .mobile-support-btn span {
                display: none;
            }

            .mobile-support-btn {
                padding: 7px 10px;
                font-size: 13px;
            }
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
            min-height: auto;
            display: flex;
            align-items: center;
            position: relative;
            color: #fff;
            padding: 100px 0;
            overflow: hidden;
        }

        .hero-headline {
            font-size: clamp(32px, 5.5vw, 62px);
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 25px;
            color: #12336b !important;
        }

        .text-gold {
            color: #D6A74F;
        }

        .hero-subtext {
            font-size: 20px;
            color: #e9e9e9;
            margin-bottom: 35px;
            line-height: 1.8;
        }

        .hero-checklist {
            list-style: none;
            padding: 0;
            margin: 0 0 40px;
            color: black !important;
        }

        .hero-checklist li {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
            font-size: 18px;
        }

        .hero-checklist i {
            color: #28c76f;
            margin-right: 12px;
            font-size: 20px;
        }

        .hero-buttons {
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            background: #D6A74F;
            color: #fff;
            padding: 15px 34px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: .3s;
        }

        .btn-hero-primary:hover {
            background: #fff;
            color: #002B5B;
        }

        .btn-hero-video {
            background: rgba(255, 255, 255, .15);
            backdrop-filter: blur(12px);
            color: #fff;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, .2);
            transition: .3s;
        }

        .btn-hero-video:hover {
            background: #fff;
            color: #002B5B;
        }

        @media(max-width:991px) {

            .hero-banner-section {
                text-align: center;
                padding: 90px 0;
            }

            .hero-headline {
                font-size: 42px;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-checklist li {
                justify-content: center;
            }
        }

        @media(max-width: 575.98px) {
            .hero-banner-section {
                padding: 55px 0 !important;
            }

            .hero-headline {
                font-size: 30px !important;
                margin-bottom: 16px !important;
            }

            .hero-subtext {
                font-size: 14.5px !important;
                margin-bottom: 22px !important;
            }

            .hero-checklist li {
                font-size: 14px !important;
                margin-bottom: 10px !important;
            }

            .btn-hero-primary,
            .btn-hero-video {
                padding: 11px 22px !important;
                font-size: 14px !important;
                width: 100%;
                text-align: center;
                justify-content: center;
            }
        }

        /* hero section css end  */
        .services-section {
            background: #f5f7fb;
        }

        .section-line {
            display: inline-block;
            width: 60px;
            height: 4px;
            background: #f7b500;
            border-radius: 50px;
            margin-bottom: 15px;
        }

        .service-card {

            background: #fff;

            border-radius: 20px;

            overflow: hidden;

            box-shadow: 0 10px 35px rgba(0, 0, 0, .08);

            transition: .35s;

            position: relative;

            height: 100%;
        }

        .service-card:hover {

            transform: translateY(-10px);

            box-shadow: 0 20px 50px rgba(0, 0, 0, .15);

        }

        .service-img {

            width: 100%;

            height: 170px;

            object-fit: cover;
        }

        .service-icon {

            width: 75px;

            height: 75px;

            background: #0b3b87;

            color: #fff;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 30px;

            border: 6px solid #fff;

            position: absolute;

            left: 50%;

            transform: translateX(-50%);

            top: 130px;

            box-shadow: 0 10px 25px rgba(0, 0, 0, .2);

        }

        .service-body {

            padding: 55px 25px 30px;

            text-align: center;
        }

        .service-body h4 {

            font-size: 24px;

            font-weight: 700;

            color: #0c2d63;

            margin-bottom: 15px;
        }

        .service-body p {

            color: #666;

            line-height: 1.8;

            margin: 0;
        }

        @media(max-width:992px) {

            .service-img {

                height: 220px;

            }

            .service-icon {

                top: 180px;

            }

        }

        /* ── Services Section ── */

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
            margin: auto;
            width: 70%;
            border-radius: 20px;
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

        @media (max-width: 991.98px) {
            .stats-dark-strip {
                width: 92% !important;
                padding: 20px 16px !important;
                border-radius: 16px !important;
            }

            .stat-item-block {
                justify-content: flex-start !important;
            }
        }

        @media (max-width: 575.98px) {
            .stats-dark-strip {
                width: 100% !important;
                border-radius: 0 !important;
                padding: 20px 12px !important;
            }
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
            max-height: 310px;
            object-fit: cover;
            display: block;
        }

        .cta-banner-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            padding-left: 60px;
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

        @media (max-width: 767.98px) {
            .cta-banner-overlay {
                padding: 20px !important;
                background: rgba(9, 37, 64, 0.6);
            }

            .cta-banner-overlay h2 {
                font-size: 22px !important;
            }

            .cta-banner-overlay p {
                font-size: 13px !important;
            }

            .cta-banner-img {
                min-height: 180px;
            }
        }

        /* ── Footer ── */
        .site-footer {
            background-color: #0b2f56;
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

        .social-fb {
            background-color: #1877f2;
        }

        .social-yt {
            background-color: #ff0000;
        }

        .social-wa {
            background-color: #25d366;
        }

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
                    <span class="top-hide-sm"><i class="fas fa-location-dot me-1"></i> Al Mudhaibi, North Sharqiyah
                        OMAN</span>
                    <a href="tel:+96892966649"><i class="fas fa-phone me-1"></i> +968 9296 6649</a>
                    <a href="mailto:info@samadgas.com" class="top-hide-sm"><i class="fas fa-envelope me-1"></i>
                        info@samadgas.com</a>
                </div>
                <div class="d-flex align-items-center gap-2 gap-md-3">
                    <span class="top-hide-sm"><i class="far fa-clock me-1"></i> Mon - Sat: 7:00 AM - 10:00 PM</span>
                    <div class="d-flex align-items-center gap-1">
                        <a href="#" class="top-social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="top-social-icon"><i class="fab fa-youtube"></i></a>
                        <a href="https://api.whatsapp.com/send?phone=96892966649" target="_blank"
                            class="top-social-icon"><i class="fab fa-whatsapp"></i></a>
                    </div>
                    <!-- Language Switcher -->
                    @if(app()->getLocale() == 'ar')
                        <a href="{{ route('lang.switch', 'en') }}" class="lang-switch-link bg-dark ms-1">
                            <i class="fas fa-globe"></i> English
                        </a>
                    @else
                        <a href="{{ route('lang.switch', 'ar') }}" class="lang-switch-link bg-dark ms-1">
                            <i class="fas fa-globe"></i> العربية
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ── 2. MAIN NAVBAR (Fully Responsive with Mobile Hamburger Toggle) ── -->
    <nav class="navbar navbar-expand-lg main-navbar">
        <div class="container">
            <!-- Brand Logo -->
            <a href="{{ route('landing') }}" class="brand-logo-area">
                <img src="{{ asset('images/design/logo_flame.png') }}" alt="Samad Gas Logo" class="brand-logo-img">
                <!-- <div class="brand-title-wrap">
                    <h2>Samad Gas</h2>
                    <p>Safe Energy. Better Tomorrow</p>
                </div> -->
            </a>

            <!-- Mobile Action Controls (Support + Hamburger Toggle) -->
            <div class="d-flex align-items-center gap-2 d-lg-none">
                <a href="https://wa.me/96892966649" target="_blank" class="btn-get-support mobile-support-btn"
                    title="Get Support">
                    <i class="fas fa-headset"></i> <span>Support</span>
                </a>
                <button class="navbar-toggler custom-nav-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainNavbarCollapse" aria-controls="mainNavbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="toggler-icon-bar top-bar"></span>
                    <span class="toggler-icon-bar middle-bar"></span>
                    <span class="toggler-icon-bar bottom-bar"></span>
                </button>
            </div>

            <!-- Collapsible Navigation Menu (Desktop + Mobile) -->
            <div class="collapse navbar-collapse" id="mainNavbarCollapse">
                <ul class="navbar-nav mx-auto align-items-lg-center gap-1 gap-lg-2 py-3 py-lg-0">
                    <li class="nav-item">
                        <a href="{{ route('landing') }}"
                            class="nav-link-btn {{ request()->routeIs('landing') ? 'active' : '' }}">
                            <i class="fas fa-house d-lg-none me-2 text-primary"></i>
                            {{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('public.services') }}"
                            class="nav-link-btn {{ request()->routeIs('public.services') ? 'active' : '' }}">
                            <i class="fas fa-gas-pump d-lg-none me-2 text-primary"></i>
                            {{ app()->getLocale() == 'ar' ? 'خدماتنا' : 'Our Services' }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('public.about') }}"
                            class="nav-link-btn {{ request()->routeIs('public.about') ? 'active' : '' }}">
                            <i class="fas fa-circle-info d-lg-none me-2 text-primary"></i>
                            {{ app()->getLocale() == 'ar' ? 'من نحن' : 'About Us' }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('public.products') }}"
                            class="nav-link-btn {{ request()->routeIs('public.products') ? 'active' : '' }}">
                            <i class="fas fa-shield-halved d-lg-none me-2 text-primary"></i>
                            {{ app()->getLocale() == 'ar' ? 'التزامنا' : 'Our Commitment' }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('public.contact') }}"
                            class="nav-link-btn {{ request()->routeIs('public.contact') ? 'active' : '' }}">
                            <i class="fas fa-envelope d-lg-none me-2 text-primary"></i>
                            {{ app()->getLocale() == 'ar' ? 'اتصل بنا' : 'Contact Us' }}
                        </a>
                    </li>

                    <!-- Mobile-Only Action Footer inside Dropdown Menu -->
                    <li class="nav-item d-lg-none mt-3 pt-3 border-top">
                        <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
                            @if(app()->getLocale() == 'ar')
                                <a href="{{ route('lang.switch', 'en') }}"
                                    class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="fas fa-globe me-1"></i> English
                                </a>
                            @else
                                <a href="{{ route('lang.switch', 'ar') }}"
                                    class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="fas fa-globe me-1"></i> العربية
                                </a>
                            @endif

                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/home') }}" class="btn btn-sm btn-primary rounded-pill px-3 fw-bold">
                                        <i class="fas fa-gauge me-1"></i> Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold">
                                        <i class="fas fa-right-to-bracket me-1"></i> Login
                                    </a>
                                @endauth
                            @endif
                        </div>
                    </li>
                </ul>

                <!-- Desktop Right Action: Support + Login -->
                <div class="d-none d-lg-flex align-items-center gap-2">
                    <a href="https://wa.me/96892966649" target="_blank" class="btn-get-support">
                        <i class="fas fa-headset"></i> <span>Get Support</span>
                    </a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold">
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
                        <img src="{{ asset('images/design/logo_flame.jpg') }}" alt="Samad Gas Logo"
                            style="height: 38px; width: auto;">
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
                        <a href="https://wa.me/96892966649" target="_blank" class="footer-social-btn social-wa"><i
                                class="fab fa-whatsapp"></i></a>
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
                <span>Powered by Aixo Systems <i class="fas fa-heart text-danger"></i></span>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>