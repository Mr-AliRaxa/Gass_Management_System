@extends('frontend.layout')

@section('title', app()->getLocale() == 'ar' ? 'من نحن | صمد الشأن للغاز - سلطنة عمان' : 'About Us | Samad Al Shan Gas - Muscat, Oman')

@section('content')
    <!-- Banner -->
    <div class="page-banner">
        <div class="container">
            <span class="banner-breadcrumb mb-3">
                <a href="{{ route('landing') }}">{{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}</a>
                <i class="fas fa-chevron-right small text-white-50"></i>
                <span>{{ app()->getLocale() == 'ar' ? 'من نحن' : 'About Us' }}</span>
            </span>
            <h1>{{ app()->getLocale() == 'ar' ? 'من نحن - صمد الشأن للغاز' : 'About Samad Al Shan Gas' }}</h1>
            <p>{{ app()->getLocale() == 'ar' ? 'وكالتكم الموثوقة لتعبئة وتوريد أسطوانات غاز البترول المسال في مسقط وسائر سلطنة عمان' : 'Your Trusted Partner for Safe, Accurate & Certified LPG Cylinder Refilling in Oman' }}</p>
        </div>
    </div>

    <!-- About Story Section -->
    <section class="py-5 my-4">
        <div class="container py-3">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold mb-3">
                        <i class="fas fa-building me-1"></i> {{ app()->getLocale() == 'ar' ? 'عن الوكالة' : 'Our Story' }}
                    </span>
                    <h2 class="fw-bold mb-4" style="color: var(--primary-dark); font-size: 36px;">
                        {{ app()->getLocale() == 'ar' ? 'الريادة والأمان في تعبئة أسطوانات الغاز' : 'Pioneering Safety, Speed & Precision in LPG Supply' }}
                    </h2>
                    <p class="text-muted" style="line-height: 1.8;">
                        {{ app()->getLocale() == 'ar' 
                            ? 'تأسست وكالة صمد الشأن للغاز لتوفير خدمة تعبئة أسطوانات غاز الطبخ (LPG) بأعلى مستويات الجودة والسلامة للمنازل والمطاعم والمؤسسات التجارية في سلطنة عمان. يعتمد نموذج عملنا على استقبال العملاء بأسطواناتهم الفارغة وتعبئتها أو استبدالها فورياً بغاز نقي معتمد وفق تسعيرة وزارة التجارة والصناعة وترويج الاستثمار.' 
                            : 'Samad Al Shan Gas was established with a singular mission: to provide the safest, fastest, and most accurately weighed LPG refilling services in Oman. We specialize in walk-in cylinder refilling where customers bring their empty domestic or commercial cylinders and receive pure, blue-flame LPG filled under certified safety conditions.' }}
                    </p>
                    <p class="text-muted" style="line-height: 1.8;">
                        {{ app()->getLocale() == 'ar' 
                            ? 'نستخدم موازين إلكترونية رقمية دقيقة ونقوم باختبار كل أسطوانة وصمام قبل مغادرة العميل للتأكد من انعدام أي تسريب بنسبة 100%.' 
                            : 'Every single cylinder undergoes valve integrity and electronic digital weighing. We are proud to serve hundreds of families and commercial kitchens in Muscat every day.' }}
                    </p>

                    <div class="row g-3 pt-3">
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-3 border-start border-4 border-primary">
                                <h3 class="fw-bold text-primary mb-0">100%</h3>
                                <small class="text-muted fw-bold">{{ app()->getLocale() == 'ar' ? 'دقة الوزن الرقمي' : 'Digital Weight Accuracy' }}</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-3 border-start border-4 border-warning">
                                <h3 class="fw-bold text-warning mb-0">2 - 5 Min</h3>
                                <small class="text-muted fw-bold">{{ app()->getLocale() == 'ar' ? 'سرعة التعبئة الفورية' : 'Rapid Express Fill' }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <div class="p-4 p-md-5 bg-light rounded-4 border position-relative">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="p-3 bg-primary text-white rounded-circle fs-3" style="width: 60px; height: 60px; display:flex; align-items:center; justify-content:center;">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">{{ app()->getLocale() == 'ar' ? 'رؤيتنا ورسالتنا' : 'Our Mission & Vision' }}</h5>
                                <small class="text-muted">{{ app()->getLocale() == 'ar' ? 'سلامة المجتمع وراحة العميل' : 'Customer safety and seamless energy access' }}</small>
                            </div>
                        </div>
                        <p class="text-muted" style="line-height: 1.7;">
                            {{ app()->getLocale() == 'ar' 
                                ? 'أن نكون الخيار الأول والأكثر ثقة لخدمات غاز البترول المسال في مسقط من خلال الالتزام التام بمعايير الدفاع المدني العماني، وتقديم خدمة راقية وسريعة تليق بأهلنا في عمان.' 
                                : 'To be the most preferred and trusted LPG filling agency in Muscat by upholding top civil defence safety standards, fair pricing in OMR, and unmatched customer care.' }}
                        </p>

                        <hr class="my-4">

                        <h6 class="fw-bold mb-3 text-dark"><i class="fas fa-check-double text-success me-2"></i> {{ app()->getLocale() == 'ar' ? 'لماذا يفضلنا العملاء؟' : 'Why Customers Choose Us' }}</h6>
                        <ul class="list-unstyled text-muted small mb-0 d-flex flex-column gap-2">
                            <li><i class="fas fa-circle-check text-primary me-2"></i> {{ app()->getLocale() == 'ar' ? 'موقع سهل الوصول في شارع مزون، الخوض 7، مسقط' : 'Convenient prime location in Mazoon Street, Al Khoud 7, Muscat' }}</li>
                            <li><i class="fas fa-circle-check text-primary me-2"></i> {{ app()->getLocale() == 'ar' ? 'تعبئة فورية لكافة الأحجام 11 كجم، 22 كجم، 44 كجم' : 'Refill on spot for all sizes: 11kg, 22kg, 44kg' }}</li>
                            <li><i class="fas fa-circle-check text-primary me-2"></i> {{ app()->getLocale() == 'ar' ? 'فواتير رقمية رسمية بالريال العماني بدقة 3 خانات' : 'Official computerized receipts in OMR with 3 decimals' }}</li>
                            <li><i class="fas fa-circle-check text-primary me-2"></i> {{ app()->getLocale() == 'ar' ? 'فحص واستبدال الصمامات والحلقات المطاطية التالفة مجاناً' : 'Valve safety check and rubber ring seal inspections' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to action -->
    <section class="py-5 bg-light">
        <div class="container text-center py-3">
            <h3 class="fw-bold mb-3" style="color: var(--primary-dark);">{{ app()->getLocale() == 'ar' ? 'هل تحتاج إلى تعبئة أسطوانتك اليوم؟' : 'Ready to Refill Your Gas Cylinder Today?' }}</h3>
            <p class="text-muted max-w-md mx-auto mb-4">{{ app()->getLocale() == 'ar' ? 'تفضل بزيارة منفذنا مباشرة أو تواصل معنا عبر الواتساب للاستفسارات' : 'Visit our filling agency counter or contact our team via WhatsApp directly.' }}</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('public.contact') }}" class="btn btn-primary rounded-pill px-4 fw-bold">
                    <i class="fas fa-location-dot me-1"></i> {{ app()->getLocale() == 'ar' ? 'موقعنا وخريطة الوصول' : 'Agency Location & Map' }}
                </a>
                <a href="https://wa.me/96890000000" target="_blank" class="btn btn-flame">
                    <i class="fab fa-whatsapp fs-5"></i> <span>WhatsApp Order</span>
                </a>
            </div>
        </div>
    </section>
@endsection
