@extends('frontend.layout')

@section('title', app()->getLocale() == 'ar' ? 'صمد الشأن للغاز | تعبئة أسطوانات الغاز في سلطنة عمان' : 'Samad Al Shan Gas | Certified LPG Cylinder Refill Services in Oman')

@section('content')
    <style>
        .hero-section {
            position: relative;
            padding: 100px 0 90px;
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
            font-size: 50px;
            font-weight: 900;
            line-height: 1.18;
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

        .hero-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 28px;
            padding: 35px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
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
            {{ app()->getLocale() == 'ar' ? 'left: 24px;' : 'right: 24px;' }}
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
            {{ app()->getLocale() == 'ar' ? 'left: 14px;' : 'right: 14px;' }}
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

        .btn-outline-white {
            border: 2px solid rgba(255, 255, 255, 0.7);
            color: #ffffff !important;
            font-weight: 700;
            border-radius: 50px;
            padding: 10px 24px;
            transition: all 0.3s ease;
            backdrop-filter: blur(6px);
            text-decoration: none;
        }

        .btn-outline-white:hover {
            background: #ffffff;
            color: var(--primary-dark) !important;
        }

        .video-box-card {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #00376b 100%);
            border-radius: 30px;
            overflow: hidden;
            color: #fff;
            padding: 60px 50px;
            position: relative;
        }
    </style>

    <!-- ── HERO SECTION ── -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7" data-aos="fade-up" data-aos-duration="1000">
                    <div class="hero-badge">
                        <i class="fas fa-shield-halved"></i>
                        {{ app()->getLocale() == 'ar' ? 'تعبئة غاز معتمدة وآمنة 100% في سلطنة عمان' : 'Certified & Safe LPG Filling In Oman' }}
                    </div>
                    <h1 class="hero-title">
                        {{ app()->getLocale() == 'ar' ? 'أحضر أسطوانتك الفارغة،' : 'Bring Your Empty Cylinder,' }} <br>
                        <span class="highlight">
                            {{ app()->getLocale() == 'ar' ? 'نملؤها بغاز نقي وآمن' : 'We Refill Clean & Safe LPG' }}
                        </span> 
                        {{ app()->getLocale() == 'ar' ? 'خلال دقائق معدودة!' : 'In Minutes!' }}
                    </h1>
                    <p class="hero-desc">
                        {{ app()->getLocale() == 'ar' 
                            ? 'مرحباً بكم في وكالة صمد الشأن للغاز. يأتي عملاؤنا بأسطواناتهم الفارغة ونقوم بتعبئتها بأحدث أجهزة الوزن الرقمية الدقيقة واختبار الصمامات لضمان شعلة زرقاء نقية وأمان تام لمنازلكم ومطاعمكم.' 
                            : 'Welcome to Samad Al Shan Gas, your trusted LPG refilling and cylinder provider in the Sultanate of Oman. Clients walk in with empty gas cylinders and get certified, leak-tested LPG refilled instantly at official approved rates.' }}
                    </p>

                    <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
                        <a href="{{ route('public.products') }}" class="btn btn-flame py-3 px-4 fs-6">
                            <i class="fas fa-gas-pump"></i> {{ app()->getLocale() == 'ar' ? 'شاهد أحجام الأسطوانات' : 'View Cylinder Sizes' }}
                        </a>
                        <a href="{{ route('public.about') }}" class="btn btn-outline-white py-3 px-4 fs-6">
                            <i class="fas fa-circle-info"></i> {{ app()->getLocale() == 'ar' ? 'تعرف على خدماتنا' : 'About Our Agency' }}
                        </a>
                    </div>

                    <div class="d-flex align-items-center gap-4 pt-3 border-top border-white-50">
                        <div>
                            <h4 class="fw-bold mb-0 text-warning">100%</h4>
                            <small class="text-white-50">{{ app()->getLocale() == 'ar' ? 'شعلة زرقاء نقية' : 'Pure Blue Flame' }}</small>
                        </div>
                        <div class="vr bg-white-50 opacity-25"></div>
                        <div>
                            <h4 class="fw-bold mb-0 text-warning">11 / 22 / 44 KG</h4>
                            <small class="text-white-50">{{ app()->getLocale() == 'ar' ? 'كافة المقاسات' : 'All Cylinder Sizes' }}</small>
                        </div>
                        <div class="vr bg-white-50 opacity-25"></div>
                        <div>
                            <h4 class="fw-bold mb-0 text-warning">Muscat, Oman</h4>
                            <small class="text-white-50">{{ app()->getLocale() == 'ar' ? 'موقع سهل وسريع' : 'Prime Location' }}</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5" data-aos="zoom-in" data-aos-duration="1000">
                    <div class="hero-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">
                                <i class="fas fa-bolt me-1"></i> {{ app()->getLocale() == 'ar' ? 'تعبئة فورية بالمنفذ' : 'Instant Counter Refill' }}
                            </span>
                            <span class="text-white-50 small"><i class="fas fa-clock me-1"></i> 2 - 5 Min</span>
                        </div>

                        <div class="hero-cylinder-preview">
                            <div class="cylinder-pillar text-center">
                                <div class="cylinder-icon-box" style="width: 60px; height: 90px;">
                                    <i class="fas fa-bottle-droplet fs-2"></i>
                                </div>
                                <span class="fw-bold text-white fs-6">11 KG</span>
                                <small class="text-white-50">{{ app()->getLocale() == 'ar' ? 'منزلي خفيف' : 'Compact' }}</small>
                            </div>
                            <div class="cylinder-pillar text-center">
                                <div class="cylinder-icon-box" style="width: 75px; height: 120px; background: linear-gradient(135deg, #007aff, #00c4cc);">
                                    <i class="fas fa-fire fs-1"></i>
                                </div>
                                <span class="fw-bold text-white fs-5">22 KG</span>
                                <small class="text-warning fw-bold">{{ app()->getLocale() == 'ar' ? 'الأكثر طلباً' : 'Popular' }}</small>
                            </div>
                            <div class="cylinder-pillar text-center">
                                <div class="cylinder-icon-box" style="width: 85px; height: 145px; background: linear-gradient(135deg, #10b981, #059669);">
                                    <i class="fas fa-shield-heart fs-1"></i>
                                </div>
                                <span class="fw-bold text-white fs-6">44 KG</span>
                                <small class="text-white-50">{{ app()->getLocale() == 'ar' ? 'تجاري للمطاعم' : 'Commercial' }}</small>
                            </div>
                        </div>

                        <div class="p-3 bg-white bg-opacity-10 rounded-4 text-center mt-3">
                            <div class="text-white fw-bold mb-1">
                                <i class="fas fa-check-circle text-success me-1"></i> {{ app()->getLocale() == 'ar' ? 'فحص الضغط والصمام أوتوماتيكياً' : 'Pressure & Valve Leak-Tested' }}
                            </div>
                            <small class="text-white-50">{{ app()->getLocale() == 'ar' ? 'كل أسطوانة تخضع للوزن الرقمي المعتمد قبل التسليم' : 'Every filled cylinder is electronically verified before leaving counter.' }}</small>
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
                            <h6 class="fw-bold mb-1">{{ app()->getLocale() == 'ar' ? 'وزن رقمي دقيق' : 'Accurate Digital Weight' }}</h6>
                            <small class="text-muted">{{ app()->getLocale() == 'ar' ? 'وزن معتمد بالكيلوجرام' : 'Exact KG filling guaranteed' }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="trust-item">
                        <div class="trust-icon bg-warning bg-opacity-10 text-warning">
                            <i class="fas fa-shield-virus"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">{{ app()->getLocale() == 'ar' ? 'ضمان ضد التسريب' : 'Zero Leak Guarantee' }}</h6>
                            <small class="text-muted">{{ app()->getLocale() == 'ar' ? 'فحص الصمام والأمان' : 'High-standard valve safety' }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="trust-item">
                        <div class="trust-icon bg-success bg-opacity-10 text-success">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">{{ app()->getLocale() == 'ar' ? 'سرعة التعبئة' : 'Rapid Express Fill' }}</h6>
                            <small class="text-muted">{{ app()->getLocale() == 'ar' ? 'بدون انتظار طويل' : 'No long waiting queues' }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="trust-item">
                        <div class="trust-icon bg-info bg-opacity-10 text-info">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">{{ app()->getLocale() == 'ar' ? 'الأسعار الرسمية' : 'Oman Approved Price' }}</h6>
                            <small class="text-muted">{{ app()->getLocale() == 'ar' ? 'بالريال العماني المعتمد' : 'Standard transparent OMR rates' }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── 4-STEP REFILL PROCESS ── -->
    <section class="py-5 my-5">
        <div class="container py-4">
            <div class="text-center max-w-xl mx-auto mb-5" data-aos="fade-up">
                <span class="section-tag">{{ app()->getLocale() == 'ar' ? 'خطوات التعبئة السريعة' : 'Easy 4-Step Walk-In Process' }}</span>
                <h2 class="section-heading">{{ app()->getLocale() == 'ar' ? 'كيف تتم عملية تعبئة الغاز لدينا؟' : 'How Our LPG Cylinder Refill Works' }}</h2>
                <p class="section-desc">
                    {{ app()->getLocale() == 'ar' 
                        ? 'يأتي العميل بأسطوانته الفارغة إلى مقر وكالتنا في مسقط ونقوم بتنفيذ عملية التعبئة وفق أعلى معايير السلامة.' 
                        : 'Clients visit our agency in Muscat with empty cylinders. Here is our simple, safe, and fast step-by-step refilling workflow.' }}
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="step-card">
                        <span class="step-num">01</span>
                        <div class="step-icon bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-truck-pickup"></i>
                        </div>
                        <h5 class="fw-bold mb-2">{{ app()->getLocale() == 'ar' ? 'إحضار الأسطوانة الفارغة' : 'Bring Empty Cylinder' }}</h5>
                        <p class="text-muted small mb-0">
                            {{ app()->getLocale() == 'ar' ? 'تفضل بزيارة منفذنا مصطحباً أسطوانتك الفارغة بمقاس 11 أو 22 أو 44 كجم.' : 'Visit our agency counter with your empty 11kg, 22kg, or 44kg gas cylinder.' }}
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="step-card">
                        <span class="step-num">02</span>
                        <div class="step-icon bg-warning bg-opacity-10 text-warning">
                            <i class="fas fa-magnifying-glass-arrow-right"></i>
                        </div>
                        <h5 class="fw-bold mb-2">{{ app()->getLocale() == 'ar' ? 'الفحص والتأكد من الصمام' : 'Safety & Valve Check' }}</h5>
                        <p class="text-muted small mb-0">
                            {{ app()->getLocale() == 'ar' ? 'يفحص الفنيون الصمام، سلامة الهيكل الخارجي، وتاريخ الصلاحية لضمان الأمان.' : 'Technicians inspect cylinder validity, tare weight, body condition, and safety seal.' }}
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="step-card">
                        <span class="step-num">03</span>
                        <div class="step-icon bg-success bg-opacity-10 text-success">
                            <i class="fas fa-gas-pump"></i>
                        </div>
                        <h5 class="fw-bold mb-2">{{ app()->getLocale() == 'ar' ? 'التعبئة بالوزن الرقمي' : 'Precision LPG Filling' }}</h5>
                        <p class="text-muted small mb-0">
                            {{ app()->getLocale() == 'ar' ? 'تعبئة غاز البترول المسال النقي بدقة عالية عبر موازين رقمية معتمدة.' : 'Filled with high-purity LPG using calibrated digital dispensing scales for exact weight.' }}
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="step-card">
                        <span class="step-num">04</span>
                        <div class="step-icon bg-info bg-opacity-10 text-info">
                            <i class="fas fa-circle-check"></i>
                        </div>
                        <h5 class="fw-bold mb-2">{{ app()->getLocale() == 'ar' ? 'الاستلام والفاتورة' : 'Pickup & Invoicing' }}</h5>
                        <p class="text-muted small mb-0">
                            {{ app()->getLocale() == 'ar' ? 'استلم أسطوانتك المختومة مع فاتورة رسمية بالريال العماني جاهزة للاستخدام.' : 'Take your fresh, sealed gas cylinder with computer-generated invoice receipt in OMR.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── PRODUCTS TEASER ── -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5">
                <div>
                    <span class="section-tag">{{ app()->getLocale() == 'ar' ? 'الأحجام المتوفرة' : 'Cylinder Sizes' }}</span>
                    <h2 class="section-heading mb-0">{{ app()->getLocale() == 'ar' ? 'أسطوانات الغاز للتعبئة والبيع' : 'LPG Cylinders For Refill & Sale' }}</h2>
                </div>
                <a href="{{ route('public.products') }}" class="btn btn-outline-primary rounded-pill px-4 mt-3 mt-md-0 fw-bold">
                    {{ app()->getLocale() == 'ar' ? 'عرض جميع المنتجات' : 'View All Products' }} <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="row g-4">
                <!-- 11KG -->
                <div class="col-lg-4 col-md-6">
                    <div class="cylinder-card">
                        <div class="cylinder-header">
                            <span class="cylinder-tag">11 KG</span>
                            <div class="my-3"><i class="fas fa-bottle-droplet text-primary" style="font-size: 65px;"></i></div>
                            <h4 class="fw-bold mb-1">11 KG LPG Cylinder</h4>
                            <p class="text-muted small mb-0">{{ app()->getLocale() == 'ar' ? 'للمطابخ الصغيرة والتخييم' : 'Small Household & BBQ' }}</p>
                        </div>
                        <div class="cylinder-body">
                            <div class="spec-item"><span class="text-muted">Gas Capacity:</span><strong>11.0 KG</strong></div>
                            <div class="spec-item"><span class="text-muted">Service:</span><strong class="text-primary">Refill / Exchange</strong></div>
                            <div class="mt-3">
                                <a href="https://wa.me/96890000000?text=Hello,%20I%20need%2011kg%20gas%20refill" target="_blank" class="btn btn-outline-primary w-100 rounded-pill fw-bold">
                                    <i class="fab fa-whatsapp me-1"></i> Order 11KG
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 22KG (Featured) -->
                <div class="col-lg-4 col-md-6">
                    <div class="cylinder-card border-primary" style="box-shadow: 0 15px 35px rgba(0, 86, 179, 0.15);">
                        <div class="cylinder-header" style="background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);">
                            <span class="cylinder-tag" style="background: var(--flame-orange);">{{ app()->getLocale() == 'ar' ? 'الأكثر استخداماً' : 'Most Popular in Oman' }}</span>
                            <div class="my-3"><i class="fas fa-fire-flame-curved text-danger" style="font-size: 75px;"></i></div>
                            <h4 class="fw-bold mb-1 text-primary">22 KG Standard Cylinder</h4>
                            <p class="text-muted small mb-0">{{ app()->getLocale() == 'ar' ? 'للمنازل والعائلات في عمان' : 'Standard Omani Family Kitchen' }}</p>
                        </div>
                        <div class="cylinder-body">
                            <div class="spec-item"><span class="text-muted">Gas Capacity:</span><strong>22.0 KG</strong></div>
                            <div class="spec-item"><span class="text-muted">Service:</span><strong class="text-primary">Instant Refill / New</strong></div>
                            <div class="mt-3">
                                <a href="https://wa.me/96890000000?text=Hello,%20I%20need%2022kg%20gas%20refill" target="_blank" class="btn btn-flame w-100 justify-content-center">
                                    <i class="fab fa-whatsapp me-1"></i> Order 22KG Refill
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 44KG -->
                <div class="col-lg-4 col-md-6">
                    <div class="cylinder-card">
                        <div class="cylinder-header">
                            <span class="cylinder-tag bg-dark">44 KG</span>
                            <div class="my-3"><i class="fas fa-industry text-success" style="font-size: 65px;"></i></div>
                            <h4 class="fw-bold mb-1">44 KG Jumbo Cylinder</h4>
                            <p class="text-muted small mb-0">{{ app()->getLocale() == 'ar' ? 'للمطاعم والمطابخ التجارية' : 'Hotels & Commercial Kitchens' }}</p>
                        </div>
                        <div class="cylinder-body">
                            <div class="spec-item"><span class="text-muted">Gas Capacity:</span><strong>44.0 KG</strong></div>
                            <div class="spec-item"><span class="text-muted">Service:</span><strong class="text-primary">Commercial Refill</strong></div>
                            <div class="mt-3">
                                <a href="https://wa.me/96890000000?text=Hello,%20I%20need%2044kg%20gas%20refill" target="_blank" class="btn btn-outline-primary w-100 rounded-pill fw-bold">
                                    <i class="fab fa-whatsapp me-1"></i> Order 44KG
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── AGENCY SAFETY TOUR ── -->
    <section class="py-5">
        <div class="container py-4">
            <div class="video-box-card" data-aos="fade-up">
                <div class="row align-items-center g-4">
                    <div class="col-lg-7">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3">
                            <i class="fas fa-shield-halved me-1"></i> {{ app()->getLocale() == 'ar' ? 'معايير السلامة والجودة' : 'Safety First Protocols' }}
                        </span>
                        <h2 class="fw-bold mb-3 text-white">
                            {{ app()->getLocale() == 'ar' ? 'تعبئة الغاز وفق معايير الدفاع المدني العماني' : 'Certified Safe LPG Refilling in Oman' }}
                        </h2>
                        <p class="text-light opacity-75 mb-4" style="line-height: 1.8;">
                            {{ app()->getLocale() == 'ar' 
                                ? 'نحرص في صمد الشأن للغاز على سلامة كل أسطوانة تخرج من منفذنا. يتم فحص الصمامات واستبدال الحلقات المطاطية التالفة واختبار ضغط الغاز قبل تسليمها للعميل.' 
                                : 'Every cylinder brought by clients is handled under rigorous safety protocols. Our technicians test valves, check tare weights, and fill each unit to ensure 100% blue-flame cooking efficiency.' }}
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('public.contact') }}" class="btn btn-warning rounded-pill px-4 fw-bold">
                                <i class="fas fa-location-dot me-1"></i> {{ app()->getLocale() == 'ar' ? 'موقع المنفذ' : 'Visit Filling Station' }}
                            </a>
                            <a href="{{ route('public.services') }}" class="btn btn-outline-light rounded-pill px-4 fw-bold">
                                {{ app()->getLocale() == 'ar' ? 'المزيد عن خدماتنا' : 'Explore Services' }}
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5 text-center">
                        <div class="p-4 bg-white bg-opacity-10 rounded-4 border border-white border-opacity-25">
                            <i class="fas fa-award text-warning mb-3" style="font-size: 70px;"></i>
                            <h5 class="fw-bold text-white mb-2">{{ app()->getLocale() == 'ar' ? 'وكالة معتمدة ومرخصة' : 'Licensed LPG Facility' }}</h5>
                            <p class="small text-white-50 mb-0">{{ app()->getLocale() == 'ar' ? 'شعلة نظيفة - وزن دقيق - خدمة فورية' : 'Accurate Weight • Zero Leaks • Fast Service' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
