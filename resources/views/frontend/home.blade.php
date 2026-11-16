@extends('frontend.layout')

@section('title', 'Samad Gas | Your Trusted LPG Gas Partner in Oman')

@section('content')
    <!-- ── 1. HERO SECTION (Exact Match To Uploaded Image) ── -->
    <section class="hero-banner-section"
        style="background: url('{{ asset('images/design/heroimg.jpg') }}') center center / cover no-repeat;">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8">

                    <h1 class="hero-headline">
                        Your Trusted <br>
                        <span class="text-gold">LPG Gas</span> Partner
                    </h1>

                    <p class="hero-subtext text-dark">
                        From empty cylinder to full service –
                        <br>
                        for homes, businesses and industries in Oman.
                    </p>

                    <ul class="hero-checklist">
                        <li>
                            <i class="fas fa-circle-check"></i>
                            <span>Digital Gas Station</span>
                        </li>

                        <li>
                            <i class="fas fa-circle-check"></i>
                            <span>Cylinder Filling</span>
                        </li>

                        <li>
                            <i class="fas fa-circle-check"></i>
                            <span>Bulk Supply & Delivery</span>
                        </li>

                        <li>
                            <i class="fas fa-circle-check"></i>
                            <span>Safe & Reliable Service</span>
                        </li>
                    </ul>

                    <div class="hero-buttons">
                        <a href="{{ route('public.services') }}" class="btn-hero-primary">
                            Our Services
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>

                        <a href="https://wa.me/96892966649" target="_blank" class="btn-hero-video">

                            <i class="fab fa-whatsapp"></i>
                            Watch Video
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </section>
    <!-- our services area  -->
    <section class="py-5 services-section">
        <div class="container">

            <div class="text-center mb-5">
                <span class="section-line"></span>
                <h2 class="fw-bold display-6 mb-2">Our Services</h2>
                <p class="text-muted">
                    Complete LPG Gas Solutions Under One Roof
                </p>
            </div>

            <div class="row g-4">

                <!-- Card 1 -->
                <div class="col-lg-3 col-md-6">
                    <div class="service-card">

                        <img src="{{ asset('images/design/service_1.jpg') }}" class="img-fluid service-img">

                        <div class="service-icon">
                            <i class="fas fa-gas-pump"></i>
                        </div>

                        <div class="service-body">

                            <h4>Cylinder Filling</h4>

                            <p>
                                Bring your empty cylinder,
                                we'll fill it with care.
                            </p>

                        </div>

                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-3 col-md-6">
                    <div class="service-card">

                        <img src="{{ asset('images/design/service_2.jpg') }}" class="img-fluid service-img">

                        <div class="service-icon">
                            <i class="fas fa-gas-pump"></i>
                        </div>

                        <div class="service-body">

                            <h4>Digital Gas Station</h4>

                            <p>
                                Accurate & transparent filling
                                with digital meters.
                            </p>

                        </div>

                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-3 col-md-6">
                    <div class="service-card">

                        <img src="{{ asset('images/design/service_3.jpg') }}" class="img-fluid service-img">

                        <div class="service-icon">
                            <i class="fas fa-truck"></i>
                        </div>

                        <div class="service-body">

                            <h4>Bulk Supply & Delivery</h4>

                            <p>
                                Large vehicles for
                                commercial supply.
                            </p>

                        </div>

                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-lg-3 col-md-6">
                    <div class="service-card">

                        <img src="{{ asset('images/design/service_4.jpg') }}" class="img-fluid service-img">

                        <div class="service-icon">
                            <i class="fas fa-warehouse"></i>
                        </div>

                        <div class="service-body">

                            <h4>Store Supply</h4>

                            <p>
                                Direct supply to our
                                storage and distribution.
                            </p>

                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ── 3. ABOUT SAMAD GAS (Exact Layout from Image) ── -->
    <section class="about-section-wrap">
        <div class="container">
            <div class="row align-items-center g-4">
                <!-- Left: Cylinders Stack Photo -->
                <div class="col-lg-5">
                    <div class="about-image-card">
                        <img src="{{ asset('images/design/about_cylinders.jpg') }}" alt="Samad Gas Cylinders">
                    </div>
                </div>

                <!-- Center: About Story Content -->
                <div class="col-lg-5">
                    <div class="about-badge-header">
                        <span class="about-badge-bar"></span>
                        <span class="about-badge-text">About Samad Gas</span>
                    </div>
                    <h2 class="about-title">
                        Reliable Energy for a <br>
                        Growing Oman
                    </h2>
                    <p class="about-desc">
                        Samad Gas is a leading LPG gas provider in Oman, committed to delivering safe, efficient and
                        affordable gas solutions. From our digital filling stations to bulk supply and delivery, we ensure
                        quality service with the highest safety standards.
                    </p>

                    <div class="about-features-row">
                        <div class="about-feature-item">
                            <i class="fas fa-circle-check"></i>
                            <span>Safety First</span>
                        </div>
                        <div class="about-feature-item">
                            <i class="fas fa-circle-check"></i>
                            <span>Premium Quality</span>
                        </div>
                        <div class="about-feature-item">
                            <i class="fas fa-circle-check"></i>
                            <span>Customer Satisfaction</span>
                        </div>
                    </div>

                    <a href="{{ route('public.about') }}" class="btn-learn-more">
                        <span>Learn More</span> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Right: Safety Priority & 24/7 Support Vertical Badges -->
                <div class="col-lg-2">
                    <div class="d-flex flex-column gap-3 h-100 justify-content-center">
                        <div class="trust-badge-box">
                            <i class="fas fa-shield-halved"></i>
                            <h5>Safety</h5>
                            <p>Our Priority</p>
                        </div>
                        <div class="trust-badge-box">
                            <i class="fas fa-headphones-simple"></i>
                            <h5>24/7</h5>
                            <p>Support</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── 4. DARK BLUE STATS STRIP (Exact 4 Metrics from Image) ── -->
    <section class="stats-dark-strip">
        <div class="container">
            <div class="row g-4 align-items-center">
                <!-- 100% -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stat-item-block">
                        <div class="stat-item-icon">
                            <i class="fas fa-gas-pump"></i>
                        </div>
                        <div class="stat-item-info">
                            <h4>100%</h4>
                            <p>Safe &amp; Reliable</p>
                        </div>
                    </div>
                </div>

                <!-- Thousands -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stat-item-block">
                        <div class="stat-item-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-item-info">
                            <h4>Thousands</h4>
                            <p>Happy Customers</p>
                        </div>
                    </div>
                </div>

                <!-- On-Time -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stat-item-block">
                        <div class="stat-item-icon">
                            <i class="fas fa-truck-fast"></i>
                        </div>
                        <div class="stat-item-info">
                            <h4>On-Time</h4>
                            <p>Delivery</p>
                        </div>
                    </div>
                </div>

                <!-- Trusted in Oman -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="stat-item-block">
                        <div class="stat-item-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <div class="stat-item-info">
                            <h4>Trusted</h4>
                            <p>in Oman</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br> <br> <br>
    <!-- ── 5. PRE-FOOTER CTA BANNER (Blue Wave + Mosque + 3 Blue Cylinders) ── -->
    <section class="cta-gas-banner">
        <img src="{{ asset('images/design/cta_banner.jpg') }}" alt="Need LPG Gas Services in Oman" class="cta-banner-img">
        <div class="cta-banner-overlay">
            <div>
                <h2>Need LPG Gas Services?</h2>
                <p>Contact us today for professional and reliable service.</p>
            </div>
        </div>
    </section>

@endsection