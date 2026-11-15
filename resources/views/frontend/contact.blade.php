@extends('frontend.layout')

@section('title', app()->getLocale() == 'ar' ? 'اتصل بنا | صمد الشأن للغاز - مسقط عمان' : 'Contact Us | Samad Al Shan Gas Muscat Oman')

@section('content')
    <!-- Banner -->
    <div class="page-banner">
        <div class="container">
            <span class="banner-breadcrumb mb-3">
                <a href="{{ route('landing') }}">{{ app()->getLocale() == 'ar' ? 'الرئيسية' : 'Home' }}</a>
                <i class="fas fa-chevron-right small text-white-50"></i>
                <span>{{ app()->getLocale() == 'ar' ? 'اتصل بنا' : 'Contact' }}</span>
            </span>
            <h1>{{ app()->getLocale() == 'ar' ? 'تواصل معنا - صمد الشأن للغاز' : 'Contact Our Gas Agency' }}</h1>
            <p>{{ app()->getLocale() == 'ar' ? 'يسعدنا استقبالكم في منفذنا في مسقط أو التواصل المباشر عبر الهاتف والواتساب' : 'We welcome walk-in clients at our Muscat filling station. Call or WhatsApp us anytime.' }}</p>
        </div>
    </div>

    <!-- Contact & Form Section -->
    <section class="py-5 my-4">
        <div class="container py-3">
            <div class="row g-5">
                <!-- Contact Info Col -->
                <div class="col-lg-5" data-aos="fade-right">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold mb-3">
                        <i class="fas fa-map-pin me-1"></i> {{ app()->getLocale() == 'ar' ? 'معلومات الاتصال والمنفذ' : 'Station Information' }}
                    </span>
                    <h2 class="fw-bold mb-4" style="color: var(--primary-dark); font-size: 34px;">
                        {{ app()->getLocale() == 'ar' ? 'تفضل بزيارة منفذ التعبئة في الخوض، مسقط' : 'Visit Our Refilling Agency In Muscat' }}
                    </h2>
                    <p class="text-muted" style="line-height: 1.8;">
                        {{ app()->getLocale() == 'ar' 
                            ? 'أحضر أسطوانات الغاز الفارغة مباشرة إلى موقعنا، حيث يتواجد فريقنا الفني لتعبئتها فورياً خلال دقائق، أو تواصل معنا لطلبات التوريد للمطاعم والشركات.' 
                            : 'Bring your empty cylinders directly to our refilling counter. Our team will verify, weigh, and refill your cylinders immediately.' }}
                    </p>

                    <div class="d-flex flex-column gap-3 my-4">
                        <div class="d-flex align-items-start gap-3 p-3 bg-light rounded-3 border">
                            <div class="p-2 bg-primary text-white rounded-3 mt-1 fs-5" style="width: 44px; height: 44px; display:flex; align-items:center; justify-content:center;">
                                <i class="fas fa-location-dot"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark">{{ app()->getLocale() == 'ar' ? 'العنوان والموقع:' : 'Agency Address:' }}</strong>
                                <span class="text-muted small">Mazoon Street, Al Khoud 7, Muscat, Sultanate of Oman</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3 p-3 bg-light rounded-3 border">
                            <div class="p-2 bg-success text-white rounded-3 mt-1 fs-5" style="width: 44px; height: 44px; display:flex; align-items:center; justify-content:center;">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark">{{ app()->getLocale() == 'ar' ? 'الواتساب والهاتف:' : 'Phone & WhatsApp:' }}</strong>
                                <a href="https://wa.me/96890000000" target="_blank" class="text-success text-decoration-none fw-bold small">+968 (Oman Hotline & WhatsApp)</a>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3 p-3 bg-light rounded-3 border">
                            <div class="p-2 bg-warning text-dark rounded-3 mt-1 fs-5" style="width: 44px; height: 44px; display:flex; align-items:center; justify-content:center;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <strong class="d-block text-dark">{{ app()->getLocale() == 'ar' ? 'ساعات العمل:' : 'Working Hours:' }}</strong>
                                <span class="text-muted small d-block">{{ app()->getLocale() == 'ar' ? 'السبت - الخميس: 7:00 صباحاً - 10:00 مساءً' : 'Saturday - Thursday: 7:00 AM - 10:00 PM' }}</span>
                                <span class="text-muted small d-block">{{ app()->getLocale() == 'ar' ? 'الجمعة: 3:00 مساءً - 10:00 مساءً' : 'Friday: 3:00 PM - 10:00 PM' }}</span>
                            </div>
                        </div>
                    </div>

                    <a href="https://wa.me/96890000000" target="_blank" class="btn btn-flame w-100 justify-content-center py-3">
                        <i class="fab fa-whatsapp fs-5"></i> <span>{{ app()->getLocale() == 'ar' ? 'محادثة فورية عبر الواتساب' : 'Chat On WhatsApp' }}</span>
                    </a>
                </div>

                <!-- Form Col -->
                <div class="col-lg-7" data-aos="fade-left">
                    <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5 bg-white">
                        <h3 class="fw-bold mb-2 text-primary">{{ app()->getLocale() == 'ar' ? 'أرسل استفسارك أو طلبك' : 'Send Direct Message / Request' }}</h3>
                        <p class="text-muted small mb-4">{{ app()->getLocale() == 'ar' ? 'يرجى كتابة بياناتك وسيقوم فريق وكالتنا بالتواصل معك في أقرب وقت' : 'Leave your inquiry and our agency support team will contact you promptly.' }}</p>

                        <form onsubmit="event.preventDefault(); alert('{{ app()->getLocale() == 'ar' ? 'شكراً لتواصلك! تم استلام رسالتك وسنقوم بالرد عليك في أقرب وقت.' : 'Thank you! Your inquiry has been submitted. Our team will contact you shortly.' }}');">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">{{ app()->getLocale() == 'ar' ? 'الاسم الكريم' : 'Full Name' }}</label>
                                    <input type="text" class="form-control rounded-3 py-2" placeholder="e.g. Salim Al-Harthy" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">{{ app()->getLocale() == 'ar' ? 'رقم الهاتف (عمان)' : 'Phone Number (+968)' }}</label>
                                    <input type="tel" class="form-control rounded-3 py-2" placeholder="+968 9XXXXXXX" required>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">{{ app()->getLocale() == 'ar' ? 'نوع الطلب' : 'Service Type' }}</label>
                                    <select class="form-select rounded-3 py-2">
                                        <option value="refill">{{ app()->getLocale() == 'ar' ? 'تعبئة أسطوانة فارغة' : 'Empty Cylinder Refill' }}</option>
                                        <option value="new">{{ app()->getLocale() == 'ar' ? 'شراء أسطوانة جديدة' : 'Purchase New Cylinder' }}</option>
                                        <option value="commercial">{{ app()->getLocale() == 'ar' ? 'عقد توريد مطعم أو مقهى' : 'Commercial Restaurant Contract' }}</option>
                                        <option value="other">{{ app()->getLocale() == 'ar' ? 'استفسار عام' : 'General Inquiry' }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">{{ app()->getLocale() == 'ar' ? 'حجم الأسطوانة' : 'Cylinder Size' }}</label>
                                    <select class="form-select rounded-3 py-2">
                                        <option value="22">22 KG (Standard Family)</option>
                                        <option value="11">11 KG (Small Compact)</option>
                                        <option value="44">44 KG (Commercial Jumbo)</option>
                                        <option value="all">Multiple / All Sizes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small">{{ app()->getLocale() == 'ar' ? 'الرسالة أو التفاصيل' : 'Message / Details' }}</label>
                                <textarea class="form-control rounded-3" rows="4" placeholder="{{ app()->getLocale() == 'ar' ? 'اكتب تفاصيل طلبك هنا...' : 'Write your question or request details here...' }}"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold">
                                <i class="fas fa-paper-plane me-1"></i> {{ app()->getLocale() == 'ar' ? 'إرسال الطلب الآن' : 'Submit Inquiry' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
