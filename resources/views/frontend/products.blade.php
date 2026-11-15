@extends('frontend.layout')

@section('title', app()->getLocale() == 'ar' ? 'الأسطوانات والمنتجات | صمد الشأن للغاز' : 'LPG Cylinders & Products | Samad Al Shan Gas Oman')

@section('content')
    <!-- Banner -->
    <div class="page-banner">
        <div class="container">
            <span class="banner-breadcrumb mb-3">
                <a href="{{ route('landing') }}">{{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}</a>
                <i class="fas fa-chevron-right small text-white-50"></i>
                <span>{{ app()->getLocale() == 'ar' ? 'الأسطوانات' : 'Products' }}</span>
            </span>
            <h1>{{ app()->getLocale() == 'ar' ? 'أسطوانات الغاز المعتمدة في عمان' : 'Certified LPG Gas Cylinders & Sizes' }}</h1>
            <p>{{ app()->getLocale() == 'ar' ? 'نوفر تعبئة واستبدال وبيع جميع أحجام أسطوانات الغاز المعتمدة للمنازل والمطاعم' : 'Available for immediate walk-in empty refill exchange and brand new cylinder purchase' }}</p>
        </div>
    </div>

    <!-- Products Grid -->
    <section class="py-5 my-4">
        <div class="container py-3">
            <div class="text-center max-w-xl mx-auto mb-5" data-aos="fade-up">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold mb-2">
                    {{ app()->getLocale() == 'ar' ? 'المقاسات الرسمية' : 'Official Capacities' }}
                </span>
                <h2 class="fw-bold" style="color: var(--primary-dark); font-size: 36px;">
                    {{ app()->getLocale() == 'ar' ? 'اختر الأسطوانة المناسبة لاحتياجك' : 'Choose The Right Cylinder For Your Needs' }}
                </h2>
                <p class="text-muted">
                    {{ app()->getLocale() == 'ar' 
                        ? 'سواء كنت بحاجة لتعبئة أسطوانتك الفارغة أو شراء أسطوانة جديدة بالكامل، نحن نوفر لك الخدمة الفورية.' 
                        : 'Whether you need an instant refill for your empty cylinder or want to purchase a brand-new certified unit.' }}
                </p>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- 11 KG Cylinder -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 border rounded-4 shadow-sm overflow-hidden">
                        <div class="p-4 text-center bg-light border-bottom position-relative">
                            <span class="badge bg-primary position-absolute top-0 end-0 m-3 rounded-pill px-3 py-1">Compact</span>
                            <div class="my-3">
                                <i class="fas fa-bottle-droplet text-primary" style="font-size: 70px;"></i>
                            </div>
                            <h4 class="fw-bold mb-1">11 KG LPG Cylinder</h4>
                            <p class="text-muted small mb-0">{{ app()->getLocale() == 'ar' ? 'للمطابخ الصغيرة والتخييم والرحلات' : 'Small Household & Outdoor BBQ' }}</p>
                        </div>
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <ul class="list-unstyled mb-4 small">
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">{{ app()->getLocale() == 'ar' ? 'وزن الغاز الصافي:' : 'Net Gas Weight:' }}</span>
                                    <strong>11.000 KG</strong>
                                </li>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">{{ app()->getLocale() == 'ar' ? 'الاستخدام الأمثل:' : 'Best For:' }}</span>
                                    <strong>{{ app()->getLocale() == 'ar' ? 'منازل صغيرة / شوي خارجي' : 'Apartments, BBQ, Camping' }}</strong>
                                </li>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">{{ app()->getLocale() == 'ar' ? 'نوع الصمام:' : 'Valve Type:' }}</span>
                                    <strong>Quick-On 20mm Safety Valve</strong>
                                </li>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">{{ app()->getLocale() == 'ar' ? 'الخدمة المتاحة:' : 'Service:' }}</span>
                                    <strong class="text-primary">{{ app()->getLocale() == 'ar' ? 'تعبئة فارغ / بيع جديد' : 'Refill / New Purchase' }}</strong>
                                </li>
                            </ul>
                            <a href="https://wa.me/96890000000?text=Hello,%20I%20want%2011kg%20gas%20refill" target="_blank" class="btn btn-outline-primary w-100 rounded-pill fw-bold">
                                <i class="fab fa-whatsapp me-1"></i> {{ app()->getLocale() == 'ar' ? 'اطلب تعبئة 11 كجم' : 'Order 11KG Refill' }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 22 KG Cylinder (Standard) -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100 border-primary rounded-4 shadow overflow-hidden" style="border-width: 2px;">
                        <div class="p-4 text-center border-bottom position-relative" style="background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);">
                            <span class="badge bg-danger position-absolute top-0 end-0 m-3 rounded-pill px-3 py-1">
                                {{ app()->getLocale() == 'ar' ? 'الأكثر طلباً في عمان' : 'Most Popular in Oman' }}
                            </span>
                            <div class="my-3">
                                <i class="fas fa-fire-flame-curved text-danger" style="font-size: 80px;"></i>
                            </div>
                            <h4 class="fw-bold mb-1 text-primary">22 KG Standard Cylinder</h4>
                            <p class="text-muted small mb-0">{{ app()->getLocale() == 'ar' ? 'الأسطوانة الأساسية للمنازل والعائلات' : 'Standard Omani Family Kitchen' }}</p>
                        </div>
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <ul class="list-unstyled mb-4 small">
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">{{ app()->getLocale() == 'ar' ? 'وزن الغاز الصافي:' : 'Net Gas Weight:' }}</span>
                                    <strong class="text-primary fs-6">22.000 KG</strong>
                                </li>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">{{ app()->getLocale() == 'ar' ? 'الاستخدام الأمثل:' : 'Best For:' }}</span>
                                    <strong>{{ app()->getLocale() == 'ar' ? 'مطابخ المنازل والفلل والمخابز' : 'Family Homes, Villas, Bakeries' }}</strong>
                                </li>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">{{ app()->getLocale() == 'ar' ? 'جودة الشعلة:' : 'Flame Quality:' }}</span>
                                    <strong class="text-success"><i class="fas fa-check me-1"></i> Clean Blue Flame</strong>
                                </li>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">{{ app()->getLocale() == 'ar' ? 'وقت التعبئة:' : 'Fill Time:' }}</span>
                                    <strong class="text-danger">2 - 3 Minutes Instant</strong>
                                </li>
                            </ul>
                            <a href="https://wa.me/96890000000?text=Hello,%20I%20want%2022kg%20gas%20refill" target="_blank" class="btn btn-flame w-100 justify-content-center">
                                <i class="fab fa-whatsapp me-1"></i> {{ app()->getLocale() == 'ar' ? 'اطلب تعبئة 22 كجم' : 'Order 22KG Refill' }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 44 KG Cylinder (Commercial) -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 border rounded-4 shadow-sm overflow-hidden">
                        <div class="p-4 text-center bg-light border-bottom position-relative">
                            <span class="badge bg-dark position-absolute top-0 end-0 m-3 rounded-pill px-3 py-1">Commercial</span>
                            <div class="my-3">
                                <i class="fas fa-industry text-success" style="font-size: 70px;"></i>
                            </div>
                            <h4 class="fw-bold mb-1">44 KG Jumbo Cylinder</h4>
                            <p class="text-muted small mb-0">{{ app()->getLocale() == 'ar' ? 'للمطاعم والفنادق وشركات الإعاشة' : 'Restaurants, Hotels & Catering' }}</p>
                        </div>
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <ul class="list-unstyled mb-4 small">
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">{{ app()->getLocale() == 'ar' ? 'وزن الغاز الصافي:' : 'Net Gas Weight:' }}</span>
                                    <strong>44.000 KG</strong>
                                </li>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">{{ app()->getLocale() == 'ar' ? 'الاستخدام الأمثل:' : 'Best For:' }}</span>
                                    <strong>{{ app()->getLocale() == 'ar' ? 'المطاعم الكبيرة والشركات' : 'Heavy Commercial Use' }}</strong>
                                </li>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">{{ app()->getLocale() == 'ar' ? 'عقود التوريد:' : 'Contract Supply:' }}</span>
                                    <strong class="text-success">{{ app()->getLocale() == 'ar' ? 'متاح توريد دوري منتظم' : 'Available on recurring schedule' }}</strong>
                                </li>
                                <li class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-muted">{{ app()->getLocale() == 'ar' ? 'الفحص والتأكيد:' : 'Inspection:' }}</span>
                                    <strong>Tare Weight &amp; Seal Verified</strong>
                                </li>
                            </ul>
                            <a href="https://wa.me/96890000000?text=Hello,%20I%20want%2044kg%20gas%20refill" target="_blank" class="btn btn-outline-primary w-100 rounded-pill fw-bold">
                                <i class="fab fa-whatsapp me-1"></i> {{ app()->getLocale() == 'ar' ? 'اطلب تعبئة 44 كجم' : 'Order 44KG Refill' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Accessories & Regulators Notice -->
            <div class="mt-5 p-4 bg-light rounded-4 border text-center">
                <h5 class="fw-bold mb-2">{{ app()->getLocale() == 'ar' ? 'هل تحتاج إلى منظم غاز جديد أو خرطوم أمان؟' : 'Need A New Gas Regulator Or Safety Hose?' }}</h5>
                <p class="text-muted mb-0 small">{{ app()->getLocale() == 'ar' ? 'نوفر منظمات ضغط منخفض وضغط عالي معتمدة وحلقات مطاطية لمنع التسريب في منفذنا بمسقط.' : 'We also stock certified low-pressure domestic and high-pressure commercial regulators and safety seals at our outlet.' }}</p>
            </div>
        </div>
    </section>
@endsection
