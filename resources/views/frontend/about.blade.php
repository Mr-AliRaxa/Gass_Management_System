@extends('frontend.layout')

@section('title', 'About Us | Reliable Energy for a Growing Oman - Samad Gas')

@section('content')
<style>
    /* ── About Hero Banner ── */
    .about-hero-section {
        background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);
        padding: 40px 0 30px;
        position: relative;
    }

    .about-pill-tag {
        display: inline-block;
        width: 34px;
        height: 4px;
        background-color: #f59e0b;
        border-radius: 2px;
        margin-bottom: 8px;
    }

    .about-hero-title {
        font-size: 44px;
        font-weight: 900;
        line-height: 1.15;
        color: #0b2742;
        letter-spacing: -1px;
        margin-bottom: 14px;
    }

    .about-hero-title .text-gold {
        color: #f59e0b;
    }

    .about-hero-desc {
        font-size: 14.5px;
        color: #475569;
        line-height: 1.6;
        margin-bottom: 22px;
        max-width: 460px;
    }

    .about-hero-img-wrap {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(9, 37, 64, 0.12);
    }

    .about-hero-img-wrap img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    /* ── Core Values & Mission Grid ── */
    .about-story-section {
        padding: 40px 0 50px;
        background: #ffffff;
    }

    .story-card-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 30px 24px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
        height: 100%;
        transition: all 0.3s ease;
    }

    .story-card-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 30px rgba(9, 47, 86, 0.08);
        border-color: #bfdbfe;
    }

    .story-card-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background-color: #0b5fa5;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 16px;
    }

    .story-card-title {
        font-size: 18px;
        font-weight: 800;
        color: #092540;
        margin-bottom: 10px;
    }

    .story-card-desc {
        font-size: 13px;
        color: #64748b;
        line-height: 1.65;
        margin: 0;
    }

    /* ── Detailed Quality / Safety Standards Strip ── */
    .safety-standards-box {
        background-color: #f0f7ff;
        border-radius: 20px;
        padding: 40px 30px;
        margin: 20px 0 50px;
    }

    .standard-badge-item {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 22px 18px;
        text-align: center;
        height: 100%;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.02);
    }

    .standard-badge-item i {
        font-size: 30px;
        color: #08213b;
        margin-bottom: 10px;
    }

    .standard-badge-item h5 {
        font-size: 15px;
        font-weight: 800;
        color: #092540;
        margin-bottom: 4px;
    }

    .standard-badge-item p {
        font-size: 11.5px;
        color: #64748b;
        margin: 0;
        line-height: 1.45;
    }

    /* ── Leader / Vision Row ── */
    .vision-row-wrap {
        padding: 30px 0 60px;
    }

    .vision-image-card {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
    }

    .vision-image-card img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    .vision-content h2 {
        font-size: 36px;
        font-weight: 900;
        color: #092540;
        line-height: 1.2;
        margin-bottom: 16px;
    }

    .vision-content p {
        font-size: 13.5px;
        color: #475569;
        line-height: 1.7;
        margin-bottom: 20px;
    }

    .vision-checklist {
        list-style: none;
        padding: 0;
        margin: 0 0 24px 0;
    }

    .vision-checklist li {
        font-size: 13px;
        font-weight: 700;
        color: #092540;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .vision-checklist li i {
        color: #f59e0b;
        font-size: 15px;
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

    /* ── Bottom Dark Blue Contact Bar ── */
    .bottom-cta-strip {
        background-color: #08213b;
        color: #ffffff;
        padding: 22px 0;
    }

    .btn-get-support-cta {
        background-color: #f7a400;
        color: #0c233c !important;
        font-weight: 700;
        font-size: 13.5px;
        padding: 10px 26px;
        border-radius: 25px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 14px rgba(247, 164, 0, 0.35);
        transition: all 0.2s;
    }

    .btn-get-support-cta:hover {
        background-color: #e69500;
        transform: translateY(-1px);
    }
</style>

    <!-- ── 1. ABOUT HERO BANNER (Matches Home/Services Style) ── -->
    <section class="about-hero-section">
        <div class="container">
            <div class="row align-items-center g-4">
                <!-- Left Content -->
                <div class="col-lg-5">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="about-pill-tag"></span>
                        <span class="fw-bold small text-dark">About Samad Gas</span>
                    </div>
                    <h1 class="about-hero-title">
                        Reliable Energy for a <br>
                        <span class="text-gold">Growing Oman</span>
                    </h1>
                    <p class="about-hero-desc">
                        Samad Gas is a premier LPG provider in the Sultanate of Oman. We empower homes, restaurants, commercial facilities, and industries with clean, safe, and certified LPG gas solutions.
                    </p>

                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="{{ route('public.services') }}" class="btn btn-hero-primary" style="background-color: #08213b; color: #fff; border-radius: 20px; padding: 10px 22px; font-weight: 700; font-size: 13.5px; text-decoration: none;">
                            <span>Our Services</span> <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                        <a href="https://wa.me/96892966649" target="_blank" class="btn btn-hero-video" style="background-color: #fff; color: #08213b; border: 1.5px solid #cbd5e1; border-radius: 20px; padding: 10px 20px; font-weight: 700; font-size: 13.5px; text-decoration: none;">
                            <i class="fas fa-phone-volume text-primary me-1"></i> <span>Contact Team</span>
                        </a>
                    </div>
                </div>

                <!-- Right Visual: Clean Modern Station & Fleet -->
                <div class="col-lg-7">
                    <div class="about-hero-img-wrap">
                        <img src="{{ asset('images/design/services_hero_station.jpg') }}" alt="Samad Gas Oman Filling Station" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── 2. THREE PILLARS: MISSION, VISION & COMMITMENT ── -->
    <section class="about-story-section">
        <div class="container">
            <div class="row g-4">
                <!-- Box 1: Our Mission -->
                <div class="col-lg-4 col-md-6">
                    <div class="story-card-box">
                        <div class="story-card-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h4 class="story-card-title">Our Mission</h4>
                        <p class="story-card-desc">
                            To deliver safe, reliable, and accurately weighed LPG gas to every household and business in Oman through fast walk-in filling and efficient commercial delivery.
                        </p>
                    </div>
                </div>

                <!-- Box 2: Our Vision -->
                <div class="col-lg-4 col-md-6">
                    <div class="story-card-box">
                        <div class="story-card-icon" style="background-color: #f59e0b;">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h4 class="story-card-title">Our Vision</h4>
                        <p class="story-card-desc">
                            To be Oman's most customer-focused and technologically advanced LPG network, known for absolute safety, digital precision, and environmental stewardship.
                        </p>
                    </div>
                </div>

                <!-- Box 3: Our Commitment -->
                <div class="col-lg-4 col-md-12">
                    <div class="story-card-box">
                        <div class="story-card-icon" style="background-color: #10b981;">
                            <i class="fas fa-shield-heart"></i>
                        </div>
                        <h4 class="story-card-title">Our Commitment</h4>
                        <p class="story-card-desc">
                            Zero tolerance for gas leaks, transparent computerized OMR billing, certified cylinder maintenance, and 24/7 dedicated customer assistance.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── 3. SAFETY STANDARDS & QUALITY ASSURANCE ── -->
    <div class="container">
        <div class="safety-standards-box">
            <div class="text-center mb-4">
                <span style="display:inline-block; width:34px; height:4px; background:#f59e0b; border-radius:2px; margin-bottom:6px;"></span>
                <h3 class="fw-bold mb-1" style="color: #092540; font-size: 26px;">Highest Safety &amp; Engineering Standards</h3>
                <p class="small text-muted mb-0">Every cylinder at Samad Gas goes through strict multi-point verification</p>
            </div>

            <div class="row g-3">
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="standard-badge-item">
                        <i class="fas fa-scale-balanced text-primary"></i>
                        <h5>Digital Tare Weighing</h5>
                        <p>Calibrated electronic sensors ensure exact net gas content.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="standard-badge-item">
                        <i class="fas fa-shield-halved text-warning"></i>
                        <h5>Valve Integrity Check</h5>
                        <p>Pressure and rubber O-ring seal leak test on every refill.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="standard-badge-item">
                        <i class="fas fa-award text-success"></i>
                        <h5>Civil Defence Compliant</h5>
                        <p>Full compliance with Oman safety and fire-prevention codes.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="standard-badge-item">
                        <i class="fas fa-fire-flame-curved text-danger"></i>
                        <h5>Clean Blue Flame</h5>
                        <p>High-purity LPG mix for maximum kitchen thermal efficiency.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── 4. WHY WE LEAD IN OMAN (Cylinders Photo & Detailed Story) ── -->
    <section class="vision-row-wrap">
        <div class="container">
            <div class="row align-items-center g-4">
                <!-- Left: Stacked Cylinders Photo -->
                <div class="col-lg-5">
                    <div class="vision-image-card">
                        <img src="{{ asset('images/design/about_cylinders.jpg') }}" alt="Samad Gas Storage & Refilling Facility">
                    </div>
                </div>

                <!-- Right: Content -->
                <div class="col-lg-7">
                    <div class="vision-content ps-lg-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span style="width: 32px; height: 3.5px; background: #f59e0b; border-radius: 2px;"></span>
                            <span class="fw-bold small text-dark">Why We Stand Out</span>
                        </div>
                        <h2>Built On Trust, Precision &amp; Customer Care</h2>
                        <p>
                            From our prime station location on Mazoon Street in Al Khoud, Muscat, Samad Gas serves hundreds of residential and commercial customers daily. Whether you are bringing your empty 11kg or 22kg domestic cylinder for an instant 3-minute refill, or require bulk 44kg supplies for a busy restaurant kitchen, our certified technicians ensure seamless service every time.
                        </p>

                        <ul class="vision-checklist">
                            <li>
                                <i class="fas fa-circle-check"></i>
                                <span>Fast walk-in counter refilling with zero long wait queues.</span>
                            </li>
                            <li>
                                <i class="fas fa-circle-check"></i>
                                <span>Authorized and transparent OMR pricing with official digital receipts.</span>
                            </li>
                            <li>
                                <i class="fas fa-circle-check"></i>
                                <span>Large dedicated fleet of safety-caged delivery vehicles for commercial contracts.</span>
                            </li>
                            <li>
                                <i class="fas fa-circle-check"></i>
                                <span>Trained technical staff providing free cylinder valve and regulator inspections.</span>
                            </li>
                        </ul>

                        <a href="{{ route('public.contact') }}" class="btn-explore-serv" style="background-color: #f7a400; color: #0c233c; font-weight: 700; font-size: 13.5px; padding: 9px 24px; border-radius: 20px; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                            <span>Visit Our Station</span> <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── 5. DARK BLUE STATS STRIP (Same as Home & Services) ── -->
    <section class="stats-dark-strip">
        <div class="container">
            <div class="row g-4 align-items-center">
                <!-- 100% -->
                <div class="col-lg-3 col-md-6 col-6">
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
                <div class="col-lg-3 col-md-6 col-6">
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
                <div class="col-lg-3 col-md-6 col-6">
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
                <div class="col-lg-3 col-md-6 col-6">
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

    <!-- ── 6. BOTTOM DARK BLUE CONTACT STRIP (Matches Home & Services) ── -->
    <section class="bottom-cta-strip">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <!-- Left: Headset + Need LPG Gas Services? -->
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 50%; background: rgba(255, 255, 255, 0.12); font-size: 24px; color: #fff;">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-white" style="font-size: 20px;">Need LPG Gas Services?</h4>
                        <small style="color: #cbd5e1; font-size: 13px;">Contact us today for fast and reliable service.</small>
                    </div>
                </div>

                <!-- Center: Phone Number -->
                <div class="d-flex align-items-center gap-3 border-start border-white-50 ps-lg-4 border-opacity-25">
                    <div class="d-flex align-items-center justify-content-center text-warning fs-3">
                        <i class="fas fa-phone-volume"></i>
                    </div>
                    <div>
                        <a href="tel:+96892966649" class="text-white text-decoration-none fw-bold" style="font-size: 20px; letter-spacing: 0.5px;">
                            +968 9296 6649
                        </a>
                        <small class="d-block" style="color: #94a3b8; font-size: 11px;">Call Us Now</small>
                    </div>
                </div>

                <!-- Right: Yellow Button -->
                <div>
                    <a href="https://wa.me/96892966649" target="_blank" class="btn-get-support-cta">
                        <span>Get Support</span> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
