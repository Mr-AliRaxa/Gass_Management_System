@extends('frontend.layout')

@section('title', 'Our Services | Complete LPG Gas Solutions in Oman - Samad Gas')

@section('content')
<style>
    /* ── Services Page Hero Banner ── */
    .serv-hero-section {
        background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);
        padding: 40px 0 30px;
        position: relative;
    }

    .serv-pill-tag {
        display: inline-block;
        width: 34px;
        height: 4px;
        background-color: #f59e0b;
        border-radius: 2px;
        margin-bottom: 8px;
    }

    .serv-hero-title {
        font-size: 44px;
        font-weight: 900;
        line-height: 1.15;
        color: #0b2742;
        letter-spacing: -1px;
        margin-bottom: 14px;
    }

    .serv-hero-title .text-gold {
        color: #f59e0b;
    }

    .serv-hero-desc {
        font-size: 14.5px;
        color: #475569;
        line-height: 1.6;
        margin-bottom: 22px;
        max-width: 440px;
    }

    .btn-explore-serv {
        background-color: #f7a400;
        color: #0c233c !important;
        font-weight: 700;
        font-size: 13.5px;
        padding: 9px 24px;
        border-radius: 20px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(247, 164, 0, 0.3);
    }

    .btn-explore-serv:hover {
        background-color: #e69500;
        transform: translateY(-1px);
    }

    .serv-hero-img-wrap {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(9, 37, 64, 0.12);
    }

    .serv-hero-img-wrap img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    /* ── 4 Detailed Service Cards Grid ── */
    .serv-grid-section {
        padding: 35px 0 50px;
        background: #ffffff;
    }

    .serv-detail-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
        transition: all 0.3s ease;
        height: 100%;
    }

    .serv-detail-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 30px rgba(9, 47, 86, 0.08);
        border-color: #bfdbfe;
    }

    .serv-card-inner {
        display: flex;
        height: 100%;
    }

    @media (max-width: 767px) {
        .serv-card-inner {
            flex-direction: column;
        }
    }

    .serv-card-img-col {
        width: 46%;
        min-height: 190px;
        overflow: hidden;
        background: #f1f5f9;
        flex-shrink: 0;
    }

    @media (max-width: 767px) {
        .serv-card-img-col {
            width: 100%;
            height: 180px;
        }
    }

    .serv-card-img-col img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }

    .serv-detail-card:hover .serv-card-img-col img {
        transform: scale(1.05);
    }

    .serv-card-content-col {
        width: 54%;
        padding: 22px 20px 20px 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    @media (max-width: 767px) {
        .serv-card-content-col {
            width: 100%;
            padding: 20px;
        }
    }

    .serv-card-icon-badge {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #0b5fa5;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        margin-bottom: 10px;
    }

    .serv-card-title {
        font-size: 17px;
        font-weight: 800;
        color: #092540;
        margin-bottom: 6px;
    }

    .serv-card-text {
        font-size: 12px;
        color: #64748b;
        line-height: 1.5;
        margin-bottom: 12px;
    }

    .serv-card-bullets {
        list-style: none;
        padding: 0;
        margin: 0 0 16px 0;
    }

    .serv-card-bullets li {
        font-size: 11.5px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .serv-card-bullets li i {
        color: #f59e0b;
        font-size: 12px;
    }

    .btn-card-learn {
        border: 1.5px solid #0b5fa5;
        color: #0b5fa5 !important;
        font-size: 11.5px;
        font-weight: 700;
        padding: 5px 16px;
        border-radius: 20px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        align-self: flex-start;
        transition: all 0.2s;
    }

    .btn-card-learn:hover {
        background-color: #0b5fa5;
        color: #ffffff !important;
    }

    /* ── How It Works (Exact 4 Step Icons Strip) ── */
    .how-it-works-box {
        background-color: #f0f7ff;
        border-radius: 20px;
        padding: 35px 25px 30px;
        margin: 10px 0 50px;
        text-align: center;
    }

    .how-title-pill {
        display: inline-block;
        width: 32px;
        height: 3.5px;
        background-color: #f59e0b;
        border-radius: 2px;
        margin-bottom: 6px;
    }

    .how-section-title {
        font-size: 26px;
        font-weight: 800;
        color: #092540;
        margin-bottom: 4px;
    }

    .how-section-sub {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 35px;
    }

    .step-unit {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .step-number-bubble {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background-color: #08213b;
        color: #ffffff;
        font-size: 11px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
    }

    .step-main-icon {
        font-size: 32px;
        color: #08213b;
        margin-bottom: 12px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .step-unit h6 {
        font-size: 14px;
        font-weight: 800;
        color: #092540;
        margin-bottom: 4px;
    }

    .step-unit p {
        font-size: 11.5px;
        color: #64748b;
        margin: 0;
        max-width: 170px;
        line-height: 1.4;
    }

    .step-arrow-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        font-size: 18px;
    }

    /* ── Why Choose Samad Gas ── */
    .why-choose-section {
        padding: 20px 0 50px;
    }

    .why-title-pill {
        display: inline-block;
        width: 32px;
        height: 3.5px;
        background-color: #f59e0b;
        border-radius: 2px;
        margin-bottom: 6px;
    }

    .why-header-label {
        font-size: 13px;
        font-weight: 700;
        color: #092540;
    }

    .why-main-heading {
        font-size: 38px;
        font-weight: 900;
        color: #092540;
        line-height: 1.15;
        margin-bottom: 14px;
    }

    .why-main-desc {
        font-size: 13.5px;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 20px;
        max-width: 380px;
    }

    .why-feature-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 16px 14px;
        text-align: center;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .why-feature-card i {
        font-size: 24px;
        color: #08213b;
        margin-bottom: 8px;
    }

    .why-feature-card h6 {
        font-size: 13px;
        font-weight: 800;
        color: #092540;
        margin-bottom: 2px;
    }

    .why-feature-card p {
        font-size: 10.5px;
        color: #64748b;
        margin: 0;
    }

    .why-feature-card-wide {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .why-feature-card-wide i {
        font-size: 24px;
        color: #08213b;
    }

    .why-feature-card-wide h6 {
        font-size: 13px;
        font-weight: 800;
        color: #092540;
        margin-bottom: 2px;
    }

    .why-feature-card-wide p {
        font-size: 11px;
        color: #64748b;
        margin: 0;
    }

    .why-right-img {
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .why-right-img img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
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

    <!-- ── 1. SERVICES HERO BANNER ── -->
    <section class="serv-hero-section">
        <div class="container">
            <div class="row align-items-center g-4">
                <!-- Left Content -->
                <div class="col-lg-5">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="serv-pill-tag"></span>
                        <span class="fw-bold small text-dark">Our Services</span>
                    </div>
                    <h1 class="serv-hero-title">
                        Complete LPG Gas <br>
                        Solutions <span class="text-gold">in Oman</span>
                    </h1>
                    <p class="serv-hero-desc">
                        From filling to delivery, we provide safe, reliable and efficient LPG gas services for homes, businesses and industries.
                    </p>

                    <a href="#services-grid" class="btn-explore-serv">
                        <span>Explore Our Services</span> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Right Visual: Canopy Station with blue pumps and mountains -->
                <div class="col-lg-7">
                    <div class="serv-hero-img-wrap">
                        <img src="{{ asset('images/design/services_hero_station.jpg') }}" alt="Samad Gas Oman Station" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── 2. FOUR SERVICES DETAIL CARDS (2x2 Grid Exact Match) ── -->
    <section class="serv-grid-section" id="services-grid">
        <div class="container">
            <div class="row g-4">
                <!-- Card 1: Cylinder Filling -->
                <div class="col-lg-6">
                    <div class="serv-detail-card">
                        <div class="serv-card-inner">
                            <div class="serv-card-img-col">
                                <img src="{{ asset('images/design/serv_box1_filling.jpg') }}" alt="Cylinder Filling">
                            </div>
                            <div class="serv-card-content-col">
                                <div>
                                    <div class="serv-card-icon-badge">
                                        <i class="fas fa-gas-pump"></i>
                                    </div>
                                    <h4 class="serv-card-title">Cylinder Filling</h4>
                                    <p class="serv-card-text">
                                        Bring your empty cylinder, and we'll fill it with care using our digital gas station.
                                    </p>
                                    <ul class="serv-card-bullets">
                                        <li><i class="fas fa-circle-check"></i> Accurate Filling</li>
                                        <li><i class="fas fa-circle-check"></i> Digital Weighing</li>
                                        <li><i class="fas fa-circle-check"></i> Maximum Safety</li>
                                    </ul>
                                </div>
                                <a href="https://wa.me/96892966649?text=Hello,%20I%20want%20to%20refill%20my%20cylinder" target="_blank" class="btn-card-learn">
                                    <span>Learn More</span> <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Cylinder Supply -->
                <div class="col-lg-6">
                    <div class="serv-detail-card">
                        <div class="serv-card-inner">
                            <div class="serv-card-img-col">
                                <img src="{{ asset('images/design/serv_box2_supply.jpg') }}" alt="Cylinder Supply">
                            </div>
                            <div class="serv-card-content-col">
                                <div>
                                    <div class="serv-card-icon-badge">
                                        <i class="fas fa-bottle-droplet"></i>
                                    </div>
                                    <h4 class="serv-card-title">Cylinder Supply</h4>
                                    <p class="serv-card-text">
                                        Get high-quality LPG cylinders for your home and business.
                                    </p>
                                    <ul class="serv-card-bullets">
                                        <li><i class="fas fa-circle-check"></i> Multiple Sizes</li>
                                        <li><i class="fas fa-circle-check"></i> Top Quality</li>
                                        <li><i class="fas fa-circle-check"></i> Safe &amp; Reliable</li>
                                    </ul>
                                </div>
                                <a href="https://wa.me/96892966649?text=Hello,%20I%20need%20cylinder%20supply" target="_blank" class="btn-card-learn">
                                    <span>Learn More</span> <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Bulk Supply & Delivery -->
                <div class="col-lg-6">
                    <div class="serv-detail-card">
                        <div class="serv-card-inner">
                            <div class="serv-card-img-col">
                                <img src="{{ asset('images/design/serv_box3_bulk.jpg') }}" alt="Bulk Supply & Delivery">
                            </div>
                            <div class="serv-card-content-col">
                                <div>
                                    <div class="serv-card-icon-badge">
                                        <i class="fas fa-truck-moving"></i>
                                    </div>
                                    <h4 class="serv-card-title">Bulk Supply &amp; Delivery</h4>
                                    <p class="serv-card-text">
                                        We deliver LPG gas in bulk for commercial and industrial use with our large fleet.
                                    </p>
                                    <ul class="serv-card-bullets">
                                        <li><i class="fas fa-circle-check"></i> On-Time Delivery</li>
                                        <li><i class="fas fa-circle-check"></i> Large Capacity</li>
                                        <li><i class="fas fa-circle-check"></i> Cost Efficient</li>
                                    </ul>
                                </div>
                                <a href="https://wa.me/96892966649?text=Hello,%20I%20need%20bulk%20gas%20supply" target="_blank" class="btn-card-learn">
                                    <span>Learn More</span> <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Storage Solutions -->
                <div class="col-lg-6">
                    <div class="serv-detail-card">
                        <div class="serv-card-inner">
                            <div class="serv-card-img-col">
                                <img src="{{ asset('images/design/serv_box4_storage.jpg') }}" alt="Storage Solutions">
                            </div>
                            <div class="serv-card-content-col">
                                <div>
                                    <div class="serv-card-icon-badge">
                                        <i class="fas fa-warehouse"></i>
                                    </div>
                                    <h4 class="serv-card-title">Storage Solutions</h4>
                                    <p class="serv-card-text">
                                        Safe and organized storage facility for LPG cylinders.
                                    </p>
                                    <ul class="serv-card-bullets">
                                        <li><i class="fas fa-circle-check"></i> Well-Managed</li>
                                        <li><i class="fas fa-circle-check"></i> High Safety Standards</li>
                                        <li><i class="fas fa-circle-check"></i> Large Storage Capacity</li>
                                    </ul>
                                </div>
                                <a href="https://wa.me/96892966649?text=Hello,%20I%20have%20inquiry%20about%20gas%20storage" target="_blank" class="btn-card-learn">
                                    <span>Learn More</span> <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── 3. HOW IT WORKS (Simple Steps To Get Your LPG Gas) ── -->
    <div class="container">
        <div class="how-it-works-box">
            <div class="d-flex align-items-center justify-content-center gap-2 mb-1">
                <span class="how-title-pill"></span>
                <span class="fw-bold fs-4 text-dark">How It Works</span>
                <span class="how-title-pill"></span>
            </div>
            <p class="how-section-sub">Simple Steps to Get Your LPG Gas</p>

            <div class="row align-items-center justify-content-center g-3">
                <!-- Step 1 -->
                <div class="col-lg-2 col-md-3 col-6">
                    <div class="step-unit">
                        <div class="step-number-bubble">1</div>
                        <div class="step-main-icon">
                            <i class="fas fa-hand-holding-hand"></i>
                        </div>
                        <h6>Request Service</h6>
                        <p>Call us or visit our station</p>
                    </div>
                </div>

                <!-- Arrow 1 -->
                <div class="col-lg-1 d-none d-lg-flex step-arrow-divider">
                    <i class="fas fa-arrow-right"></i>
                </div>

                <!-- Step 2 -->
                <div class="col-lg-2 col-md-3 col-6">
                    <div class="step-unit">
                        <div class="step-number-bubble">2</div>
                        <div class="step-main-icon">
                            <i class="fas fa-scale-balanced"></i>
                        </div>
                        <h6>Fill / Supply</h6>
                        <p>We fill or prepare your order</p>
                    </div>
                </div>

                <!-- Arrow 2 -->
                <div class="col-lg-1 d-none d-lg-flex step-arrow-divider">
                    <i class="fas fa-arrow-right"></i>
                </div>

                <!-- Step 3 -->
                <div class="col-lg-2 col-md-3 col-6">
                    <div class="step-unit">
                        <div class="step-number-bubble">3</div>
                        <div class="step-main-icon">
                            <i class="fas fa-truck-fast"></i>
                        </div>
                        <h6>Deliver</h6>
                        <p>We deliver safely</p>
                    </div>
                </div>

                <!-- Arrow 3 -->
                <div class="col-lg-1 d-none d-lg-flex step-arrow-divider">
                    <i class="fas fa-arrow-right"></i>
                </div>

                <!-- Step 4 -->
                <div class="col-lg-2 col-md-3 col-6">
                    <div class="step-unit">
                        <div class="step-number-bubble">4</div>
                        <div class="step-main-icon">
                            <i class="fas fa-shield-heart"></i>
                        </div>
                        <h6>Enjoy Safe Energy</h6>
                        <p>Power your life with confidence</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── 4. WHY CHOOSE SAMAD GAS? YOUR SAFETY, OUR PRIORITY ── -->
    <section class="why-choose-section">
        <div class="container">
            <div class="row align-items-center g-4">
                <!-- Left Text Column -->
                <div class="col-lg-4">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="why-title-pill"></span>
                        <span class="why-header-label">Why Choose Samad Gas?</span>
                    </div>
                    <h2 class="why-main-heading">
                        Your Safety, <br>
                        Our Priority
                    </h2>
                    <p class="why-main-desc">
                        We are committed to delivering safe, reliable and affordable LPG gas services across Oman.
                    </p>
                    <a href="{{ route('public.about') }}" class="btn-explore-serv">
                        <span>Learn More</span> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Center 3 Feature Cards Grid -->
                <div class="col-lg-5">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="why-feature-card">
                                <i class="fas fa-shield-halved"></i>
                                <h6>Safety First</h6>
                                <p>Your safety is our station priority</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="why-feature-card">
                                <i class="fas fa-gem"></i>
                                <h6>Premium Quality</h6>
                                <p>Top-grade LPG gas</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="why-feature-card">
                                <i class="far fa-clock"></i>
                                <h6>On-Time Service</h6>
                                <p>Always on schedule</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="why-feature-card">
                                <i class="fas fa-handshake"></i>
                                <h6>Customer Satisfaction</h6>
                                <p>Your trust matters</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Cylinders Photo -->
                <div class="col-lg-3">
                    <div class="why-right-img">
                        <img src="{{ asset('images/design/serv_why_cylinders.jpg') }}" alt="Samad Gas Safety Cylinders" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── 5. BOTTOM DARK BLUE CONTACT STRIP (Exact Match To Uploaded Image) ── -->
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
