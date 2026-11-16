@extends('frontend.layout')

@section('title', 'LPG Cylinders & Products | Samad Gas Muscat Oman')

@section('content')
    <style>
        /* ── Products Hero Banner (Matches Home/Services/About/Contact) ── */
        .prod-hero-section {
            background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);
            padding: 40px 0 30px;
            position: relative;
        }

        .prod-pill-tag {
            display: inline-block;
            width: 34px;
            height: 4px;
            background-color: #f59e0b;
            border-radius: 2px;
            margin-bottom: 8px;
        }

        .prod-hero-title {
            font-size: clamp(28px, 5.5vw, 44px);
            font-weight: 900;
            line-height: 1.15;
            color: #0b2742;
            letter-spacing: -1px;
            margin-bottom: 14px;
        }

        .prod-hero-title .text-gold {
            color: #f59e0b;
        }

        .prod-hero-desc {
            font-size: 14.5px;
            color: #475569;
            line-height: 1.6;
            margin-bottom: 22px;
            max-width: 480px;
        }

        .prod-hero-img-wrap {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(9, 37, 64, 0.12);
        }

        .prod-hero-img-wrap img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }

        /* ── 3 Main Product Cylinder Cards (11kg, 22kg, 44kg) ── */
        .products-grid-section {
            padding: 40px 0 50px;
            background: #ffffff;
        }

        .cylinder-product-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cylinder-product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 36px rgba(9, 47, 86, 0.1);
            border-color: #0b5fa5;
        }

        .cylinder-card-featured {
            border: 2px solid #0b5fa5;
            box-shadow: 0 10px 30px rgba(11, 95, 165, 0.12);
            position: relative;
        }

        .cylinder-top-header {
            background: linear-gradient(135deg, #f0f7ff 0%, #e2eefb 100%);
            padding: 30px 20px 24px;
            text-align: center;
            position: relative;
        }

        .cylinder-badge-tag {
            position: absolute;
            top: 14px;
            right: 14px;
            background-color: #0b5fa5;
            color: #ffffff;
            font-size: 11px;
            font-weight: 800;
            padding: 4px 12px;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .cylinder-badge-featured {
            background: #f59e0b;
            color: #092540;
        }

        .cylinder-photo-box {
            width: 90px;
            height: 110px;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cylinder-photo-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .cylinder-title {
            font-size: 20px;
            font-weight: 900;
            color: #092540;
            margin-bottom: 2px;
        }

        .cylinder-sub {
            font-size: 12px;
            color: #64748b;
            margin: 0;
        }

        .cylinder-card-body {
            padding: 24px 22px 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cylinder-spec-list {
            list-style: none;
            padding: 0;
            margin: 0 0 22px 0;
        }

        .cylinder-spec-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 9px 0;
            border-bottom: 1px dashed #e2e8f0;
            font-size: 12.5px;
        }

        .cylinder-spec-list li:last-child {
            border-bottom: none;
        }

        .cylinder-spec-list span.label {
            color: #64748b;
        }

        .cylinder-spec-list strong.value {
            color: #092540;
            font-weight: 700;
        }

        .btn-order-cylinder {
            background-color: #08213b;
            color: #ffffff !important;
            font-size: 13px;
            font-weight: 700;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            transition: all 0.2s;
        }

        .btn-order-cylinder:hover {
            background-color: #0b5fa5;
        }

        .btn-order-featured {
            background-color: #f7a400;
            color: #0c233c !important;
        }

        .btn-order-featured:hover {
            background-color: #e69500;
        }

        /* ── Accessories & Regulators Section ── */
        .accessories-section {
            padding: 30px 0 50px;
            background: #f8fafc;
        }

        .acc-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px 20px;
            height: 100%;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.02);
            transition: all 0.25s ease;
        }

        .acc-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(9, 47, 86, 0.06);
            border-color: #bfdbfe;
        }

        .acc-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background-color: #0b5fa5;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .acc-info h5 {
            font-size: 15px;
            font-weight: 800;
            color: #092540;
            margin-bottom: 4px;
        }

        .acc-info p {
            font-size: 12px;
            color: #64748b;
            margin: 0;
            line-height: 1.5;
        }

        /* ── Dark Blue Stats Strip ── */
        .stats-dark-strip {
            background-color: #08213b;
            color: #ffffff;
            padding: 24px 0;
            margin-bottom: 20px;
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

    <!-- ── 1. PRODUCTS HERO BANNER ── -->
    <section class="prod-hero-section">
        <div class="container">
            <div class="row align-items-center g-4">
                <!-- Left Content -->
                <div class="col-lg-5">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="prod-pill-tag"></span>
                        <span class="fw-bold small text-dark">LPG Products</span>
                    </div>
                    <h1 class="prod-hero-title">
                        Certified <span class="text-gold">LPG Cylinders</span> <br>
                        in Oman
                    </h1>
                    <p class="prod-hero-desc">
                        From 11kg domestic compact cylinders to 22kg family kitchen standards and 44kg jumbo commercial
                        units. Walk in with your empty cylinder or purchase brand new.
                    </p>

                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="https://wa.me/96892966649" target="_blank" class="btn"
                            style="background-color: #f7a400; color: #0c233c; border-radius: 20px; padding: 10px 24px; font-weight: 700; font-size: 13.5px; text-decoration: none; box-shadow: 0 4px 12px rgba(247, 164, 0, 0.3);">
                            <i class="fab fa-whatsapp me-1"></i> Order Now
                        </a>
                        <a href="#cylinder-sizes" class="btn"
                            style="background-color: #08213b; color: #fff; border-radius: 20px; padding: 10px 22px; font-weight: 700; font-size: 13.5px; text-decoration: none;">
                            <span>View Sizes</span> <i class="fas fa-arrow-down ms-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Right Visual: Station With Delivery Truck & Blue Cylinders -->
                <div class="col-lg-7">
                    <div class="prod-hero-img-wrap">
                        <img src="{{ asset('images/design/serv_why_cylinders.jpg') }}" alt="Samad Gas LPG Cylinders Oman"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── 2. THREE CYLINDER SIZES (11kg, 22kg, 44kg Exact Match) ── -->
    <section class="products-grid-section" id="cylinder-sizes">
        <div class="container">
            <div class="text-center mb-5">
                <span
                    style="display:inline-block; width:34px; height:4px; background:#f59e0b; border-radius:2px; margin-bottom:6px;"></span>
                <h2 style="font-size:32px; font-weight:900; color:#092540; margin-bottom:6px;">Official Cylinder Sizes &amp;
                    Capacities</h2>
                <p style="font-size:13.5px; color:#64748b; margin:0;">Precision filled with calibrated digital scales and
                    strict leak testing</p>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- 11 KG Cylinder -->
                <div class="col-lg-4 col-md-6">
                    <div class="cylinder-product-card">
                        <div class="cylinder-top-header">
                            <span class="cylinder-badge-tag">Compact</span>
                            <div class="cylinder-photo-box">
                                <img src="{{ asset('images/design/cylinder_single.jpg') }}" alt="11 KG LPG Gas Cylinder">
                            </div>
                            <h3 class="cylinder-title">11 KG Cylinder</h3>
                            <p class="cylinder-sub">Small Household &amp; Outdoor BBQ</p>
                        </div>

                        <div class="cylinder-card-body">
                            <ul class="cylinder-spec-list">
                                <li>
                                    <span class="label">Net Gas Weight:</span>
                                    <strong class="value">11.000 KG Pure LPG</strong>
                                </li>
                                <li>
                                    <span class="label">Ideal For:</span>
                                    <strong class="value">BBQ, Camping, Small Kitchen</strong>
                                </li>
                                <li>
                                    <span class="label">Valve Type:</span>
                                    <strong class="value">Quick-On 20mm Safety Valve</strong>
                                </li>
                                <li>
                                    <span class="label">Refill Time:</span>
                                    <strong class="value text-success">2 - 3 Minutes Instant</strong>
                                </li>
                                <li>
                                    <span class="label">Service Mode:</span>
                                    <strong class="value">Empty Exchange / New Buy</strong>
                                </li>
                            </ul>

                            <a href="https://wa.me/96892966649?text=Hello,%20I%20want%20to%20order%20an%2011kg%20gas%20cylinder"
                                target="_blank" class="btn-order-cylinder">
                                <i class="fab fa-whatsapp"></i> <span>Order 11 KG Cylinder</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 22 KG Standard Cylinder (Featured / Most Popular) -->
                <div class="col-lg-4 col-md-6">
                    <div class="cylinder-product-card cylinder-card-featured">
                        <div class="cylinder-top-header"
                            style="background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);">
                            <span class="cylinder-badge-tag cylinder-badge-featured">Most Popular in Oman</span>
                            <div class="cylinder-photo-box">
                                <img src="{{ asset('images/design/cylinder_single.jpg') }}"
                                    alt="22 KG Standard LPG Gas Cylinder" style="transform: scale(1.15);">
                            </div>
                            <h3 class="cylinder-title text-primary">22 KG Cylinder</h3>
                            <p class="cylinder-sub fw-bold text-dark">Standard Omani Family Kitchen</p>
                        </div>

                        <div class="cylinder-card-body">
                            <ul class="cylinder-spec-list">
                                <li>
                                    <span class="label">Net Gas Weight:</span>
                                    <strong class="value text-primary fs-6">22.000 KG Pure LPG</strong>
                                </li>
                                <li>
                                    <span class="label">Ideal For:</span>
                                    <strong class="value">Homes, Villas, Bakeries</strong>
                                </li>
                                <li>
                                    <span class="label">Flame Quality:</span>
                                    <strong class="value text-success"><i class="fas fa-check-circle me-1"></i> Clean Blue
                                        Flame</strong>
                                </li>
                                <li>
                                    <span class="label">Refill Time:</span>
                                    <strong class="value text-danger">Immediate Counter Service</strong>
                                </li>
                                <li>
                                    <span class="label">Official Pricing:</span>
                                    <strong class="value">Transparent Approved OMR</strong>
                                </li>
                            </ul>

                            <a href="https://wa.me/96892966649?text=Hello,%20I%20want%20to%20order%20a%2022kg%20gas%20cylinder"
                                target="_blank" class="btn-order-cylinder btn-order-featured">
                                <i class="fab fa-whatsapp"></i> <span>Order 22 KG Cylinder</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 44 KG Commercial Jumbo Cylinder -->
                <div class="col-lg-4 col-md-6">
                    <div class="cylinder-product-card">
                        <div class="cylinder-top-header">
                            <span class="cylinder-badge-tag" style="background-color: #08213b;">Commercial</span>
                            <div class="cylinder-photo-box">
                                <img src="{{ asset('images/design/cylinder_single.jpg') }}"
                                    alt="44 KG Jumbo Commercial LPG Gas Cylinder" style="transform: scale(1.25);">
                            </div>
                            <h3 class="cylinder-title">44 KG Cylinder</h3>
                            <p class="cylinder-sub">Hotels, Restaurants &amp; Catering</p>
                        </div>

                        <div class="cylinder-card-body">
                            <ul class="cylinder-spec-list">
                                <li>
                                    <span class="label">Net Gas Weight:</span>
                                    <strong class="value">44.000 KG High Capacity</strong>
                                </li>
                                <li>
                                    <span class="label">Ideal For:</span>
                                    <strong class="value">Heavy Kitchens &amp; Industrial</strong>
                                </li>
                                <li>
                                    <span class="label">Supply Mode:</span>
                                    <strong class="value">Bulk Fleet Transport</strong>
                                </li>
                                <li>
                                    <span class="label">Safety Test:</span>
                                    <strong class="value">Hydrostatic Pressure Verified</strong>
                                </li>
                                <li>
                                    <span class="label">Contract Supply:</span>
                                    <strong class="value text-success">Scheduled Recurring Delivery</strong>
                                </li>
                            </ul>

                            <a href="https://wa.me/96892966649?text=Hello,%20I%20want%20to%20order%20a%2044kg%20commercial%20gas%20cylinder"
                                target="_blank" class="btn-order-cylinder">
                                <i class="fab fa-whatsapp"></i> <span>Order 44 KG Cylinder</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── 3. ACCESSORIES, VALVES & SAFETY REGULATORS ── -->
    <section class="accessories-section">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
                <div>
                    <span
                        style="display:inline-block; width:30px; height:3.5px; background:#f59e0b; border-radius:2px; margin-bottom:4px;"></span>
                    <h3 style="font-size:24px; font-weight:800; color:#092540; margin:0;">Safety Accessories &amp;
                        Regulators</h3>
                </div>
                <small class="text-muted mt-2 mt-md-0">Available at our Al Khoud counter</small>
            </div>

            <div class="row g-3">
                <div class="col-lg-4 col-md-6">
                    <div class="acc-card">
                        <div class="acc-icon">
                            <i class="fas fa-gauge-high"></i>
                        </div>
                        <div class="acc-info">
                            <h5>Low-Pressure Regulators</h5>
                            <p>Certified household gas regulators with automatic shut-off safety valves.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="acc-card">
                        <div class="acc-icon" style="background-color: #f59e0b;">
                            <i class="fas fa-shield-virus"></i>
                        </div>
                        <div class="acc-info">
                            <h5>High-Pressure Regulators</h5>
                            <p>For commercial restaurant burners, tandoor ovens, and bakery equipment.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="acc-card">
                        <div class="acc-icon" style="background-color: #10b981;">
                            <i class="fas fa-ring"></i>
                        </div>
                        <div class="acc-info">
                            <h5>Safety Hoses &amp; O-Ring Seals</h5>
                            <p>Heavy-duty reinforced orange gas hoses and leak-proof replacement rubber washers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── 4. DARK BLUE STATS STRIP ── -->
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

    <!-- ── 5. BOTTOM DARK BLUE CONTACT STRIP ── -->
    <section class="bottom-cta-strip">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <!-- Left: Headset + Need LPG Gas Services? -->
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center"
                        style="width: 50px; height: 50px; border-radius: 50%; background: rgba(255, 255, 255, 0.12); font-size: 24px; color: #fff;">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-white" style="font-size: 20px;">Need LPG Gas Services?</h4>
                        <small style="color: #cbd5e1; font-size: 13px;">Contact us today for fast and reliable
                            service.</small>
                    </div>
                </div>

                <!-- Center: Phone Number -->
                <div class="d-flex align-items-center gap-3 border-start border-white-50 ps-lg-4 border-opacity-25">
                    <div class="d-flex align-items-center justify-content-center text-warning fs-3">
                        <i class="fas fa-phone-volume"></i>
                    </div>
                    <div>
                        <a href="tel:+96892966649" class="text-white text-decoration-none fw-bold"
                            style="font-size: 20px; letter-spacing: 0.5px;">
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