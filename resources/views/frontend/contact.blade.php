@extends('frontend.layout')

@section('title', 'Contact Us | Samad Gas Muscat Oman - Fast LPG Refilling & Support')

@section('content')
    <style>
        /* ── Contact Hero Banner (Matches Home/Services/About Theme) ── */
        .contact-hero-section {
            background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);
            padding: 40px 0 30px;
            position: relative;
        }

        .contact-pill-tag {
            display: inline-block;
            width: 34px;
            height: 4px;
            background-color: #f59e0b;
            border-radius: 2px;
            margin-bottom: 8px;
        }

        .contact-hero-title {
            font-size: clamp(28px, 5.5vw, 44px);
            font-weight: 900;
            line-height: 1.15;
            color: #0b2742;
            letter-spacing: -1px;
            margin-bottom: 14px;
        }

        .contact-hero-title .text-gold {
            color: #f59e0b;
        }

        .contact-hero-desc {
            font-size: 14.5px;
            color: #475569;
            line-height: 1.6;
            margin-bottom: 22px;
            max-width: 460px;
        }

        .contact-hero-img-wrap {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(9, 37, 64, 0.12);
        }

        .contact-hero-img-wrap img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }

        /* ── Quick Touch Info Cards (4 Columns) ── */
        .contact-cards-section {
            padding: 30px 0 45px;
            background: #ffffff;
        }

        .contact-info-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px 20px;
            text-align: center;
            height: 100%;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .contact-info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 30px rgba(9, 47, 86, 0.08);
            border-color: #bfdbfe;
        }

        .contact-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: #0b5fa5;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-bottom: 14px;
            box-shadow: 0 4px 12px rgba(11, 95, 165, 0.25);
        }

        .contact-info-card h5 {
            font-size: 15px;
            font-weight: 800;
            color: #092540;
            margin-bottom: 6px;
        }

        .contact-info-card p,
        .contact-info-card a {
            font-size: 12.5px;
            color: #64748b;
            margin: 0;
            text-decoration: none;
            line-height: 1.5;
        }

        .contact-info-card a:hover {
            color: #0b5fa5;
            font-weight: 600;
        }

        /* ── Main Form & Station Map Row ── */
        .form-map-section {
            padding: 20px 0 60px;
            background: #ffffff;
        }

        .contact-form-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 38px 32px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            height: 100%;
        }

        .contact-form-card h3 {
            font-size: 24px;
            font-weight: 900;
            color: #092540;
            margin-bottom: 8px;
        }

        .form-control-custom {
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 10px 16px;
            font-size: 13.5px;
            color: #1e293b;
            transition: all 0.2s;
        }

        .form-control-custom:focus {
            border-color: #0b5fa5;
            box-shadow: 0 0 0 3px rgba(11, 95, 165, 0.12);
            outline: none;
        }

        .form-label-custom {
            font-size: 12.5px;
            font-weight: 700;
            color: #092540;
            margin-bottom: 6px;
        }

        .btn-submit-contact {
            background-color: #08213b;
            color: #ffffff !important;
            font-weight: 700;
            font-size: 14px;
            padding: 12px 28px;
            border-radius: 25px;
            border: none;
            width: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-submit-contact:hover {
            background-color: #0e3760;
            transform: translateY(-1px);
        }

        .station-info-panel {
            background: #f0f7ff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 35px 28px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .station-badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            color: #0b5fa5;
            margin-bottom: 14px;
        }

        .station-info-panel h3 {
            font-size: 24px;
            font-weight: 900;
            color: #092540;
            margin-bottom: 12px;
        }

        .station-info-panel p {
            font-size: 13.5px;
            color: #475569;
            line-height: 1.7;
            margin-bottom: 22px;
        }

        .station-feature-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
        }

        .station-feature-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            color: #f59e0b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .station-feature-text strong {
            display: block;
            font-size: 13.5px;
            color: #092540;
        }

        .station-feature-text span {
            font-size: 12px;
            color: #64748b;
        }

        .btn-whatsapp-direct {
            background-color: #25d366;
            color: #ffffff !important;
            font-weight: 700;
            font-size: 13.5px;
            padding: 10px 24px;
            border-radius: 25px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
        }

        .btn-whatsapp-direct:hover {
            background-color: #20bd5a;
            transform: translateY(-1px);
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

    <!-- ── 1. CONTACT HERO BANNER ── -->
    <section class="contact-hero-section">
        <div class="container">
            <div class="row align-items-center g-4">
                <!-- Left Content -->
                <div class="col-lg-5">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="contact-pill-tag"></span>
                        <span class="fw-bold small text-dark">Get In Touch</span>
                    </div>
                    <h1 class="contact-hero-title">
                        Connect with <br>
                        <span class="text-gold">Samad Gas</span> Oman
                    </h1>
                    <p class="contact-hero-desc">
                        Bring your empty cylinder directly to our station in Muscat, or reach out to our team for
                        residential refills, commercial bulk deliveries, and support.
                    </p>

                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="tel:+96892966649" class="btn"
                            style="background-color: #08213b; color: #fff; border-radius: 20px; padding: 10px 22px; font-weight: 700; font-size: 13.5px; text-decoration: none;">
                            <i class="fas fa-phone-volume me-1"></i> Call Now
                        </a>
                        <a href="https://wa.me/96892966649" target="_blank" class="btn"
                            style="background-color: #25d366; color: #fff; border-radius: 20px; padding: 10px 22px; font-weight: 700; font-size: 13.5px; text-decoration: none;">
                            <i class="fab fa-whatsapp me-1"></i> WhatsApp Us
                        </a>
                    </div>
                </div>

                <!-- Right Visual: Station with Truck, Worker & Gas Dispenser -->
                <div class="col-lg-7">
                    <div class="contact-hero-img-wrap">
                        <img src="{{ asset('images/design/hero_gas_station.jpg') }}" alt="Samad Gas Muscat Station"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── 2. QUICK CONTACT 4 CARDS ── -->
    <section class="contact-cards-section">
        <div class="container">
            <div class="row g-3 g-lg-4">
                <!-- Card 1: Station Location -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="contact-info-card">
                        <div class="contact-card-icon">
                            <i class="fas fa-location-dot"></i>
                        </div>
                        <h5>Station Location</h5>
                        <p>Mazoon Street, Al Khoud 7, Muscat, Sultanate of Oman</p>
                    </div>
                </div>

                <!-- Card 2: Phone Hotline -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="contact-info-card">
                        <div class="contact-card-icon" style="background-color: #f59e0b;">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h5>Direct Hotline</h5>
                        <p><a href="tel:+96892966649">+968 9296 6649</a></p>
                        <small class="text-muted d-block mt-1">Instant Response</small>
                    </div>
                </div>

                <!-- Card 3: WhatsApp Support -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="contact-info-card">
                        <div class="contact-card-icon" style="background-color: #10b981;">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <h5>WhatsApp Chat</h5>
                        <p><a href="https://wa.me/96892966649" target="_blank">+968 9296 6649</a></p>
                        <small class="text-muted d-block mt-1">Order &amp; Inquiries</small>
                    </div>
                </div>

                <!-- Card 4: Working Hours -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="contact-info-card">
                        <div class="contact-card-icon" style="background-color: #08213b;">
                            <i class="far fa-clock"></i>
                        </div>
                        <h5>Working Hours</h5>
                        <p>Mon - Sat: 7:00 AM - 10:00 PM</p>
                        <small class="text-muted d-block mt-1">Friday Open for Emergencies</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── 3. FORM & STATION INFORMATION SECTION ── -->
    <section class="form-map-section">
        <div class="container">
            <div class="row g-4 align-items-stretch">
                <!-- Left: Send Message Form -->
                <div class="col-lg-7">
                    <div class="contact-form-card">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span style="width: 30px; height: 3.5px; background: #f59e0b; border-radius: 2px;"></span>
                            <span class="fw-bold small text-dark">Send Message</span>
                        </div>
                        <h3>Request a Call Back or Quote</h3>
                        <p class="text-muted small mb-4">
                            Fill out the form below for domestic cylinder inquiries, restaurant contracts, or bulk LPG
                            supply requests in Oman.
                        </p>

                        <form
                            onsubmit="event.preventDefault(); alert('Thank you! Your inquiry has been sent to Samad Gas. Our team will contact you shortly.');">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label form-label-custom">Full Name</label>
                                    <input type="text" class="form-control form-control-custom" placeholder="Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label form-label-custom">Phone Number (Oman)</label>
                                    <input type="tel" class="form-control form-control-custom" placeholder="9XXXXXXX"
                                        required>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label form-label-custom">Service Required</label>
                                    <select class="form-select form-control-custom">
                                        <option value="cylinder_refill">Cylinder Refill (Walk-in)</option>
                                        <option value="cylinder_supply">New Cylinder Purchase</option>
                                        <option value="bulk_supply">Bulk Supply &amp; Delivery</option>
                                        <option value="restaurant">Commercial Restaurant Contract</option>
                                        <option value="other">General Inquiry</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label form-label-custom">Cylinder Size</label>
                                    <select class="form-select form-control-custom">
                                        <option value="22kg">22 KG (Standard Family)</option>
                                        <option value="11kg">11 KG (Compact BBQ)</option>
                                        <option value="44kg">44 KG (Commercial Jumbo)</option>
                                        <option value="multiple">Multiple / Bulk Quantities</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label form-label-custom">Your Message / Delivery Location</label>
                                <textarea class="form-control form-control-custom" rows="4"
                                    placeholder="Mention your requirements, quantity, or specific delivery area in Muscat..."></textarea>
                            </div>

                            <button type="submit" class="btn-submit-contact">
                                <span>Submit Request</span> <i class="fas fa-paper-plane ms-1"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Right: Station Detail Panel -->
                <div class="col-lg-5">
                    <div class="station-info-panel">
                        <div>
                            <span class="station-badge-pill">
                                <i class="fas fa-gas-pump"></i> Official Filling Station
                            </span>
                            <h3>Visit Samad Gas In Al Khoud</h3>
                            <p>
                                Clients are welcome to walk in directly with empty gas cylinders. Our technical crew
                                operates digital filling dispensers with real-time weighing scales for fast 3-minute
                                turnaround.
                            </p>

                            <div class="station-feature-item">
                                <div class="station-feature-icon">
                                    <i class="fas fa-scale-balanced"></i>
                                </div>
                                <div class="station-feature-text">
                                    <strong>Real-Time Digital Meter Dispensing</strong>
                                    <span>Accurate transparent kilogram weight verified before pickup.</span>
                                </div>
                            </div>

                            <div class="station-feature-item">
                                <div class="station-feature-icon">
                                    <i class="fas fa-shield-virus"></i>
                                </div>
                                <div class="station-feature-text">
                                    <strong>Free Valve &amp; Seal Safety Check</strong>
                                    <span>Every cylinder undergoes O-ring seal leak testing at zero extra cost.</span>
                                </div>
                            </div>

                            <div class="station-feature-item">
                                <div class="station-feature-icon">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <div class="station-feature-text">
                                    <strong>Official Computerized Receipts</strong>
                                    <span>Transparent billing in OMR with 3 decimals for personal and business
                                        records.</span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-3 border-top border-white-50">
                            <a href="https://wa.me/96892966649" target="_blank" class="btn-whatsapp-direct w-100">
                                <i class="fab fa-whatsapp fs-5"></i> <span>Chat with Us on WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- google map location  -->
    <div style="text-align:center;">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7358.009429147292!2d58.140958534526895!3d22.765206310155172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e8fcfcaa653998d%3A0x96ed18f56b991780!2z2LTYsdmD2Kkg2LPZhdivINmE2YXZhtiq2YjYrNin2Kog2KfZhNi62KfYsiAo2KjZiti5INmIINiq2LnYqNim2Kkg2KfYs9i32YjYp9mG2KfYqiDYp9mE2LrYp9iyKSB8IFNhbWFkIEZvciBHYXMgUHJvZHVjdGlvbg!5e0!3m2!1sen!2som!4v1794840843237!5m2!1sen!2som"
            width="80%" height="450" style="border:0; margin:20px auto; display:block;" allowfullscreen="" loading="lazy"
            referrerpolicy="strict-origin-when-cross-origin">
        </iframe>
    </div>

    <!-- ── 4. DARK BLUE STATS STRIP (Same as Home & Services) ── -->
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