@extends('frontend.layout')

@section('title', app()->getLocale() == 'ar' ? 'خدماتنا | صمد الشأن للغاز - سلطنة عمان' : 'Our Services | Samad Al Shan Gas LPG Oman')

@section('content')
    <!-- Banner -->
    <div class="page-banner">
        <div class="container">
            <span class="banner-breadcrumb mb-3">
                <a href="{{ route('landing') }}">{{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}</a>
                <i class="fas fa-chevron-right small text-white-50"></i>
                <span>{{ app()->getLocale() == 'ar' ? 'خدماتنا' : 'Services' }}</span>
            </span>
            <h1>{{ app()->getLocale() == 'ar' ? 'خدمات الغاز المتكاملة' : 'Comprehensive LPG Gas Solutions' }}</h1>
            <p>{{ app()->getLocale() == 'ar' ? 'نقدم حلول تعبئة وتوريد الغاز للمنازل، المطاعم، المقاهي والمؤسسات التجارية في مسقط' : 'From walk-in empty cylinder refilling to commercial restaurant supply contracts in Oman' }}</p>
        </div>
    </div>

    <!-- Services Grid -->
    <section class="py-5 my-4">
        <div class="container py-3">
            <div class="row g-4">
                <!-- Service 1 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 border rounded-4 p-4 shadow-sm">
                        <div class="d-inline-flex p-3 rounded-4 bg-primary bg-opacity-10 text-primary fs-3 mb-3" style="width: 60px; height: 60px; align-items:center; justify-content:center;">
                            <i class="fas fa-arrows-rotate"></i>
                        </div>
                        <h4 class="fw-bold mb-2">{{ app()->getLocale() == 'ar' ? 'تعبئة الأسطوانات الفارغة' : 'Walk-In Empty Cylinder Refill' }}</h4>
                        <p class="text-muted small" style="line-height: 1.8;">
                            {{ app()->getLocale() == 'ar' 
                                ? 'يأتي العميل بأسطوانته الفارغة ونقوم بتفريغ أي رواسب، فحص الصمام، وتعبئتها بغاز بترول مسال نقي وفق الوزن المحدد على الفور.' 
                                : 'Bring your empty 11kg, 22kg, or 44kg gas cylinder. We inspect, purge residual air, and refill with certified high-purity LPG.' }}
                        </p>
                        <span class="badge bg-light text-primary border rounded-pill py-2 px-3 align-self-start font-monospace">2 - 5 Minutes Service</span>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100 border rounded-4 p-4 shadow-sm">
                        <div class="d-inline-flex p-3 rounded-4 bg-warning bg-opacity-10 text-warning fs-3 mb-3" style="width: 60px; height: 60px; align-items:center; justify-content:center;">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                        <h4 class="fw-bold mb-2">{{ app()->getLocale() == 'ar' ? 'بيع أسطوانات جديدة' : 'New Cylinder Purchase' }}</h4>
                        <p class="text-muted small" style="line-height: 1.8;">
                            {{ app()->getLocale() == 'ar' 
                                ? 'إذا كنت تنتقل إلى منزل جديد أو تحتاج أسطوانة إضافية، نوفر أسطوانات جديدة ومطابقة للمواصفات العمانية ومعتمدة من الدفاع المدني.' 
                                : 'Moving into a new home or expanding your kitchen? Purchase brand-new, factory-certified cylinders with valid inspection stamps.' }}
                        </p>
                        <span class="badge bg-light text-warning border rounded-pill py-2 px-3 align-self-start font-monospace">Factory Certified</span>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 border rounded-4 p-4 shadow-sm">
                        <div class="d-inline-flex p-3 rounded-4 bg-success bg-opacity-10 text-success fs-3 mb-3" style="width: 60px; height: 60px; align-items:center; justify-content:center;">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h4 class="fw-bold mb-2">{{ app()->getLocale() == 'ar' ? 'عقود المطاعم والفنادق' : 'Commercial Restaurant Contracts' }}</h4>
                        <p class="text-muted small" style="line-height: 1.8;">
                            {{ app()->getLocale() == 'ar' 
                                ? 'توريد دوري منتظم لأسطوانات 44 كجم و22 كجم للمطابخ التجارية، المطاعم، المخابز وشركات الإعاشة مع التزام صارم بالمواعيد.' 
                                : 'Reliable scheduled cylinder replenishment for cafeterias, bakeries, catering kitchens, and hotels across Muscat.' }}
                        </p>
                        <span class="badge bg-light text-success border rounded-pill py-2 px-3 align-self-start font-monospace">Dedicated Bulk Supply</span>
                    </div>
                </div>

                <!-- Service 4 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="card h-100 border rounded-4 p-4 shadow-sm">
                        <div class="d-inline-flex p-3 rounded-4 bg-danger bg-opacity-10 text-danger fs-3 mb-3" style="width: 60px; height: 60px; align-items:center; justify-content:center;">
                            <i class="fas fa-shield-virus"></i>
                        </div>
                        <h4 class="fw-bold mb-2">{{ app()->getLocale() == 'ar' ? 'فحص واستبدال الصمامات' : 'Valve & Seal Safety Inspection' }}</h4>
                        <p class="text-muted small" style="line-height: 1.8;">
                            {{ app()->getLocale() == 'ar' 
                                ? 'فحص الصمامات القديمة واستبدال الحلقات المطاطية المتهالكة لضمان عدم حدوث أي تسريب أثناء تركيب الأسطوانة في المنزل.' 
                                : 'Our safety team checks worn valves, replaces aged rubber O-rings, and conducts leak tests on every cylinder before dispatch.' }}
                        </p>
                        <span class="badge bg-light text-danger border rounded-pill py-2 px-3 align-self-start font-monospace">Zero Leak Policy</span>
                    </div>
                </div>

                <!-- Service 5 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="card h-100 border rounded-4 p-4 shadow-sm">
                        <div class="d-inline-flex p-3 rounded-4 bg-info bg-opacity-10 text-info fs-3 mb-3" style="width: 60px; height: 60px; align-items:center; justify-content:center;">
                            <i class="fas fa-truck-fast"></i>
                        </div>
                        <h4 class="fw-bold mb-2">{{ app()->getLocale() == 'ar' ? 'النقل والتوصيل الآمن' : 'Safe Cylinder Delivery' }}</h4>
                        <p class="text-muted small" style="line-height: 1.8;">
                            {{ app()->getLocale() == 'ar' 
                                ? 'سيارات نقل مجهزة بأقفاص حماية لنقل أسطوانات الغاز بطريقة آمنة ومطابقة لقوانين السلامة المرورية والبيئية في عمان.' 
                                : 'Safety-caged delivery vehicles designed to securely transport LPG cylinders directly to commercial and residential sites.' }}
                        </p>
                        <span class="badge bg-light text-info border rounded-pill py-2 px-3 align-self-start font-monospace">Safety Caged Fleet</span>
                    </div>
                </div>

                <!-- Service 6 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="card h-100 border rounded-4 p-4 shadow-sm">
                        <div class="d-inline-flex p-3 rounded-4 bg-secondary bg-opacity-10 text-dark fs-3 mb-3" style="width: 60px; height: 60px; align-items:center; justify-content:center;">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <h4 class="fw-bold mb-2">{{ app()->getLocale() == 'ar' ? 'فواتير رقمية رسمية' : 'Digital Invoicing (OMR)' }}</h4>
                        <p class="text-muted small" style="line-height: 1.8;">
                            {{ app()->getLocale() == 'ar' 
                                ? 'إصدار فواتير بيع وتعبئة رقمية موثقة بدقة 3 خانات عشرية بالريال العماني لتسهيل الحسابات والمراجعة المالية للمطاعم والشركات.' 
                                : 'Computerized billing system tracking exact sales and transactions in OMR with 3 decimals for crystal-clear accounting.' }}
                        </p>
                        <span class="badge bg-light text-dark border rounded-pill py-2 px-3 align-self-start font-monospace">Transparent Receipts</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
