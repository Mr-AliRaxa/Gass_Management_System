@extends('layouts.app')

@push('styles')
<style>
    /* Background */
    body { background-color: #f0f4ff; }

    /* Gradient KPI cards */
    .gradient-card {
        border: none !important;
        border-radius: 14px !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        color: white !important;
        overflow: hidden;
    }
    .gradient-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
    }
    .gradient-primary { background: linear-gradient(135deg, #4e54c8 0%, #8f94fb 100%); }
    .gradient-success { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
    .gradient-warning { background: linear-gradient(135deg, #f2994a 0%, #f2c94c 100%); }
    .gradient-danger { background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%); }
    .gradient-info { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); }

    .gradient-card .text-white-50 { color: rgba(255,255,255,0.85) !important; font-size: 11px; letter-spacing: 0.5px; }
    .gradient-card .h5, .gradient-card .h3 { color: white !important; font-weight: 700; }
    .gradient-card i { opacity: 0.35; }

    /* Modern cards */
    .card {
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.05);
        border: none;
        background-color: #fff;
    }
    .card-header {
        border-bottom: 1px solid #f1f5f9;
        background: #ffffff;
        border-radius: 14px 14px 0 0 !important;
        padding: 1.1rem 1.5rem;
    }
    .card-body {
        padding: 1.5rem;
    }

    /* Tables */
    .table {
        background: #fff;
        margin-bottom: 0;
    }
    .table th, .table td {
        padding: 12px 18px;
        font-size: 13px;
        vertical-align: middle;
    }
    .table thead {
        background: #f8fafc;
    }

    /* Badges */
    .badge-modern {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 20px;
    }
    .badge-red { background: #fee2e2; color: #b91c1c; }
    .badge-yellow { background: #fef3c7; color: #b45309; }
    .badge-green { background: #dcfce7; color: #15803d; }

    /* Progress bars */
    .progress {
        height: 10px;
        border-radius: 8px;
        background-color: #f1f5f9;
    }
    .progress-bar {
        border-radius: 8px;
    }

    /* Responsive adjustments for phones and tablets */
    @media (max-width: 576px) {
        .col-xl-3, .col-xl-4, .col-md-6 {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }
    }
    @media (max-width: 767.98px) {
        .card-body {
            padding: 1rem;
        }
        .card-header {
            padding: 0.9rem 1rem;
        }
        .table th, .table td {
            padding: 8px 10px;
            font-size: 12px;
        }
        .nav-tabs .nav-link {
            padding: 6px 10px;
            font-size: 12px;
        }
        .gradient-card .h5 {
            font-size: 1.1rem;
        }
        .gradient-card i {
            font-size: 2rem !important;
        }
    }

    /* ═════════════════════════════════════════════════════════
       FINANCIAL PERFORMANCE REPORTS (Exact Match to Uploaded Image)
       ═════════════════════════════════════════════════════════ */
    .fin-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #edf2f7;
        box-shadow: 0 4px 25px rgba(15, 23, 42, 0.05);
        overflow: hidden;
        position: relative;
    }
    .fin-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50px;
        background: radial-gradient(ellipse at 50% 100%, rgba(219, 234, 254, 0.45) 0%, rgba(255, 255, 255, 0) 70%);
        pointer-events: none;
    }
    .fin-header {
        padding: 24px 24px 18px 24px;
        background: #ffffff;
        border-bottom: none;
    }
    .fin-header-icon {
        width: 44px;
        height: 44px;
        border-radius: 13px;
        background: linear-gradient(135deg, #3b82f6 0%, #0284c7 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 20px;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.35);
    }
    .btn-period-pill {
        background: #eff6ff !important;
        border: 1.5px solid #dbeafe !important;
        border-radius: 9999px !important;
        color: #2563eb !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        padding: 8px 18px !important;
        transition: all 0.2s ease !important;
    }
    .btn-period-pill:hover {
        background: #dbeafe !important;
    }

    /* Floating Pill Tabs */
    .fin-tab-wrapper {
        background: #f1f5f9;
        border-radius: 14px;
        padding: 5px;
        display: inline-flex;
        gap: 4px;
        max-width: 100%;
        overflow-x: auto;
    }
    .fin-tab-btn {
        border-radius: 10px !important;
        padding: 8px 18px !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        color: #475569 !important;
        border: none !important;
        background: transparent !important;
        transition: all 0.2s ease !important;
        white-space: nowrap;
    }
    .fin-tab-btn:hover {
        color: #0f172a !important;
    }
    .fin-tab-btn.active {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35) !important;
    }

    /* Sub-header Bar inside Tab */
    .fin-subbar {
        background: #f8fafc;
        border-radius: 14px;
        border: 1px solid #edf2f7;
        padding: 10px 16px;
        margin-bottom: 22px;
    }
    .fin-net-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 10px;
        padding: 7px 15px;
        color: #1e3a8a;
        font-size: 14px;
        font-weight: 600;
    }
    .fin-net-pill i {
        color: #2563eb;
    }
    .btn-pdf-gradient {
        background: linear-gradient(135deg, #7c3aed 0%, #6366f1 100%) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 12px !important;
        padding: 8px 18px !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        box-shadow: 0 3px 12px rgba(124, 58, 237, 0.3) !important;
        transition: all 0.2s ease !important;
        text-decoration: none !important;
    }
    .btn-pdf-gradient:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(124, 58, 237, 0.4) !important;
        color: #ffffff !important;
    }
    .pdf-tag-badge {
        background: rgba(255, 255, 255, 0.22);
        padding: 2px 6px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Donut Chart Container */
    .fin-donut-wrapper {
        position: relative;
        width: 220px;
        height: 220px;
        margin: 0 auto;
    }
    .fin-donut-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        pointer-events: none;
    }
    .fin-donut-val {
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.1;
    }
    .fin-donut-lbl {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        color: #64748b;
        letter-spacing: 0.5px;
        margin-top: 3px;
    }

    /* Breakdown List Card */
    .fin-breakdown-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1.5px solid #edf2f7;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03);
        padding: 16px 22px;
    }
    .fin-breakdown-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 11px 0;
        border-bottom: 1px solid #f8fafc;
    }
    .fin-breakdown-row:last-child {
        border-bottom: none;
    }
    .fin-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
        flex-shrink: 0;
    }
    .fin-dot-sales     { background: #007aff; }
    .fin-dot-expenses  { background: #f59e0b; }
    .fin-dot-salaries  { background: #10b981; }
    .fin-dot-gas       { background: #8b5cf6; }

    .fin-lbl-name {
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
    }
    .fin-lbl-amount {
        font-size: 15px;
        font-weight: 800;
        color: #0f172a;
        margin-right: 14px;
    }
    .fin-pct-pill {
        padding: 4px 10px;
        border-radius: 9999px;
        font-size: 11.5px;
        font-weight: 700;
        min-width: 52px;
        text-align: center;
    }
    .fin-pct-blue   { background: #eff6ff; color: #2563eb; }
    .fin-pct-orange { background: #fffbeb; color: #d97706; }
    .fin-pct-green  { background: #f0fdf4; color: #16a34a; }
    .fin-pct-purple { background: #faf5ff; color: #7c3aed; }

    /* Net profit capsule inside subbar */
    .fin-net-capsule {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 10px;
        padding: 7px 15px;
        color: #1e3a8a;
        font-size: 14px;
        font-weight: 600;
    }
    .fin-net-capsule i {
        color: #2563eb;
    }

    @media (max-width: 767.98px) {
        .fin-tab-btn {
            padding: 7px 12px !important;
            font-size: 12px !important;
        }
        .fin-donut-wrapper {
            width: 170px;
            height: 170px;
        }
        .fin-lbl-amount {
            font-size: 13px;
            margin-right: 8px;
        }
        .fin-donut-val {
            font-size: 18px;
        }
    }

    /* ═════════════════════════════════════════════════════════
       LAST 7 DAYS SALES CARD (Modern Design)
       ═════════════════════════════════════════════════════════ */
    .sales7-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #edf2f7;
        box-shadow: 0 4px 25px rgba(15, 23, 42, 0.05);
        overflow: hidden;
    }
    .sales7-header {
        padding: 22px 24px 14px 24px;
    }
    .sales7-icon {
        width: 44px;
        height: 44px;
        border-radius: 13px;
        background: linear-gradient(135deg, #3b82f6 0%, #0284c7 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 20px;
        box-shadow: 0 4px 12px rgba(59,130,246,0.35);
        flex-shrink: 0;
    }
    .sales7-period-pill {
        background: #eff6ff !important;
        border: 1.5px solid #dbeafe !important;
        border-radius: 9999px !important;
        color: #2563eb !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        padding: 7px 16px !important;
    }
    .sales7-stat-box {
        background: #f8fafc;
        border-radius: 14px;
        border: 1px solid #f1f5f9;
        padding: 14px 20px;
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .sales7-stat-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }
    .sales7-total-val {
        font-size: 26px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.1;
    }
    .sales7-total-lbl {
        font-size: 12px;
        color: #64748b;
        font-weight: 500;
        margin-top: 1px;
    }
    .sales7-divider {
        width: 1px;
        height: 40px;
        background: #e2e8f0;
        margin: 0 4px;
    }
    .sales7-growth-val {
        font-size: 18px;
        font-weight: 800;
        line-height: 1.1;
    }
    .sales7-growth-lbl {
        font-size: 11px;
        color: #64748b;
        font-weight: 500;
        margin-top: 1px;
    }
    .sales7-footer {
        margin: 16px 24px 20px 24px;
        background: #f0f7ff;
        border-radius: 14px;
        padding: 12px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }
    .sales7-footer-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: #dbeafe;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }
    .sales7-footer-text strong {
        color: #1d4ed8;
        font-size: 13.5px;
        font-weight: 700;
    }
    .sales7-footer-text span {
        display: block;
        font-size: 12px;
        color: #475569;
        margin-top: 1px;
    }
    #salesAreaChart {
        height: 200px !important;
    }

    /* ═════════════════════════════════════════════════════════
       CYLINDER STOCK & RECENT LOGIN CARDS (Modern Design)
       ═════════════════════════════════════════════════════════ */
    .dashboard-modern-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #edf2f7;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.05);
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .dashboard-modern-card:hover {
        box-shadow: 0 8px 30px rgba(15, 23, 42, 0.08);
    }
    .stock-row-item {
        padding: 11px 14px;
        background: #f8fafc;
        border-radius: 12px;
        margin-bottom: 10px;
        border: 1px solid #f1f5f9;
        transition: all 0.2s ease;
    }
    .stock-row-item:last-child {
        margin-bottom: 0;
    }
    .stock-row-item:hover {
        background: #f1f5f9;
        border-color: #e2e8f0;
    }
    .login-user-item {
        padding: 12px 14px;
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.15s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }
    .login-user-item:last-child {
        border-bottom: none;
    }
    .login-user-item:hover {
        background: #f8fafc;
        border-radius: 12px;
    }
    .user-avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-weight: 700;
        font-size: 15px;
        flex-shrink: 0;
        box-shadow: 0 3px 8px rgba(0,0,0,0.12);
    }
</style>
@endpush

@section('content')
<!-- Financial Analysis Overview -->
<div class="row mb-4">
    <div class="col-12">
        <h4 class="font-weight-bold text-gray-800 mb-3">{{ __('messages.system_overview') }}</h4>
    </div>
    <!-- Total Team Members -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-card gradient-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">{{ __('messages.total_team_members') }}</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalTeamMembers }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-3x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Total Customers -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-card gradient-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">{{ __('messages.total_customers') }}</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalCustomers }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-tag fa-3x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Total Staff (from /users) -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-card gradient-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">{{ __('messages.total_staff') }}</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalStaff }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-friends fa-3x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Total Login Users -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-card gradient-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">{{ __('messages.total_login_users') }}</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalUsers }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-lock fa-3x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <h4 class="font-weight-bold text-gray-800 mb-3">{{ __('messages.total_expenses') }}</h4>
    </div>
    <!-- Today Expenses -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-card gradient-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">{{ __('messages.today_expenses') }}</div>
                        <div class="h5 mb-0 font-weight-bold">{{ number_format($dailyExpenses, 3) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-receipt fa-3x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- This Week Expenses -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-card gradient-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">{{ __('messages.this_week_expenses') }}</div>
                        <div class="h5 mb-0 font-weight-bold">{{ number_format($weeklyExpenses, 3) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-week fa-3x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Monthly Expenses -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-card gradient-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">{{ __('messages.this_month_expenses') }}</div>
                        <div class="h5 mb-0 font-weight-bold">{{ number_format($monthlyExpenses, 3) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-invoice-dollar fa-3x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Total Expenses -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-card gradient-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">{{ __('messages.total_expenses_all_time') }}</div>
                        <div class="h5 mb-0 font-weight-bold">{{ number_format($totalExpenses, 3) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-wallet fa-3x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <h4 class="font-weight-bold text-gray-800 mb-3">{{ __('messages.total_salaries') }}</h4>
    </div>
    <!-- Today Salary -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-card gradient-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">{{ __('messages.today_paid_salary') }}</div>
                        <div class="h5 mb-0 font-weight-bold">{{ number_format($dailySalaries, 3) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-check fa-3x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- This Month Salary -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-card gradient-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">{{ __('messages.this_month_salaries') }}</div>
                        <div class="h5 mb-0 font-weight-bold">{{ number_format($monthlySalaries, 3) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users-cog fa-3x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Total Salary -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-card gradient-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">{{ __('messages.total_salaries_all_time') }}</div>
                        <div class="h5 mb-0 font-weight-bold">{{ number_format($totalSalaries, 3) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-bill-wave fa-3x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Paid Team Members (Extra Card) -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-card gradient-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">{{ __('messages.paid_team_members') }}</div>
                        <div class="h5 mb-0 font-weight-bold">{{ $paidTeamMembersCount }} {{ __('messages.members') }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hand-holding-usd fa-3x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===================== TODAY'S FILLED CYLINDERS SOLD ===================== --}}
<div class="row mb-4">
    <div class="col-12">
        <h4 class="font-weight-bold text-gray-800 mb-3">{{ __('messages.filled_cylinders_sold_today') }}</h4>
    </div>

    @php
        $cylinderGradients = ['11kg' => 'gradient-primary', '22kg' => 'gradient-success', '44kg' => 'gradient-warning'];
        $cylinderIcons     = ['11kg' => 'fa-tint', '22kg' => 'fa-fill-drip', '44kg' => 'fa-gas-pump'];
    @endphp

    @foreach($todayFilledCylinders as $size => $qty)
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-card {{ $cylinderGradients[$size] }} shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">
                            {{ __('messages.today_filled_sold', ['size' => $size]) }}
                        </div>
                        <div class="h5 mb-0 font-weight-bold">{{ $qty }} {{ __('messages.cylinders') }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas {{ $cylinderIcons[$size] }} fa-3x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Total Filled Cylinders Sold Today (11kg + 22kg + 44kg) -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-card gradient-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white-50 text-uppercase mb-1">
                            {{ __('messages.total_filled_sold_today') }}
                        </div>
                        <div class="h5 mb-0 font-weight-bold">{{ $totalTodayFilledCylinders }} {{ __('messages.cylinders') }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fire fa-3x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- ======================================================================== --}}

<div class="row">
    <!-- Financial Performance Reports (Card Matching Uploaded Image) -->
    <div class="col-xl-8 col-lg-7 mb-4">
        <div class="card fin-card h-100">
            <!-- Card Header -->
            <div class="fin-header d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="fin-header-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 font-weight-bold" style="color: #0f172a; font-weight: 800; font-size: 19px;">
                            {{ __('messages.financial_performance') }}
                        </h5>
                        <div class="text-muted" style="font-size: 13px; margin-top: 2px;">
                            {{ __('messages.financial_overview') }}
                        </div>
                    </div>
                </div>

                <!-- Select Period Pill Dropdown -->
                <div>
                    <div class="dropdown">
                        <button class="btn btn-period-pill dropdown-toggle" type="button" id="periodDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="far fa-calendar-alt text-primary me-1"></i> <span id="currentPeriodLabel">{{ __('messages.daily_report') }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="periodDropdown" style="border-radius: 14px; padding: 6px;">
                            <li><a class="dropdown-item py-2 px-3 fw-bold" href="javascript:void(0)" onclick="selectReportTab('daily')"><i class="far fa-calendar-alt text-primary me-2"></i> {{ __('messages.daily_report') }}</a></li>
                            <li><a class="dropdown-item py-2 px-3 fw-bold" href="javascript:void(0)" onclick="selectReportTab('weekly')"><i class="far fa-calendar-alt text-info me-2"></i> {{ __('messages.weekly_report') }}</a></li>
                            <li><a class="dropdown-item py-2 px-3 fw-bold" href="javascript:void(0)" onclick="selectReportTab('monthly')"><i class="far fa-calendar-alt text-success me-2"></i> {{ __('messages.monthly_report') }}</a></li>
                            <li><a class="dropdown-item py-2 px-3 fw-bold" href="javascript:void(0)" onclick="selectReportTab('yearly')"><i class="far fa-calendar-alt text-warning me-2"></i> {{ __('messages.yearly_report') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body pt-0 px-4 pb-4">
                <!-- Nav Pills Bar -->
                <div class="fin-tab-wrapper mb-3">
                    <ul class="nav nav-pills border-0" id="reportTab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link fin-tab-btn active" data-bs-toggle="pill" data-bs-target="#daily" type="button">
                                <i class="far fa-calendar-alt me-1"></i> {{ __('messages.daily_report') }}
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link fin-tab-btn" data-bs-toggle="pill" data-bs-target="#weekly" type="button">
                                <i class="far fa-calendar-alt me-1"></i> {{ __('messages.weekly_report') }}
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link fin-tab-btn" data-bs-toggle="pill" data-bs-target="#monthly" type="button">
                                <i class="far fa-calendar-alt me-1"></i> {{ __('messages.monthly_report') }}
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link fin-tab-btn" data-bs-toggle="pill" data-bs-target="#yearly" type="button">
                                <i class="far fa-calendar-alt me-1"></i> {{ __('messages.yearly_report') }}
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="reportTabContent">
                    {{-- ── DAILY TAB ── --}}
                    @php
                        $dTotal = $dailySales + $dailyExpenses + $dailySalaries + $dailyGas;
                        $dSalesPct = $dTotal > 0 ? number_format(($dailySales / $dTotal) * 100, 1) : '0.0';
                        $dExpPct   = $dTotal > 0 ? number_format(($dailyExpenses / $dTotal) * 100, 1) : '0.0';
                        $dSalPct   = $dTotal > 0 ? number_format(($dailySalaries / $dTotal) * 100, 1) : '0.0';
                        $dGasPct   = $dTotal > 0 ? number_format(($dailyGas / $dTotal) * 100, 1) : '0.0';
                    @endphp
                    <div class="tab-pane fade show active" id="daily" role="tabpanel">
                        <!-- Sub-header bar -->
                        <div class="fin-subbar d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
                            <div class="fin-net-capsule">
                                <i class="fas fa-file-alt"></i>
                                <span>{{ __('messages.daily_report') }}: <strong>{{ number_format($dailyProfit, 3) }}</strong></span>
                            </div>
                            <a href="{{ route('reports.download', 'daily') }}" class="btn btn-pdf-gradient">
                                <span class="pdf-tag-badge">{{ __('messages.pdf') }}</span>
                                <span>{{ __('messages.download_pdf') }}</span>
                                <i class="fas fa-download"></i>
                            </a>
                        </div>

                        <!-- Donut + Breakdown Row -->
                        <div class="row align-items-center g-4">
                            <div class="col-md-5 text-center">
                                <div class="fin-donut-wrapper">
                                    <canvas id="dailyDonutChart"></canvas>
                                    <div class="fin-donut-center">
                                        <div class="fin-donut-val">{{ number_format($dailyProfit, 3) }}</div>
                                        <div class="fin-donut-lbl">Total</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="fin-breakdown-card">
                                    <div class="fin-breakdown-row">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fin-dot fin-dot-sales"></span>
                                            <span class="fin-lbl-name">{{ __('messages.sales') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="fin-lbl-amount">{{ number_format($dailySales, 3) }}</span>
                                            <span class="fin-pct-pill fin-pct-blue">{{ $dSalesPct }}%</span>
                                        </div>
                                    </div>
                                    <div class="fin-breakdown-row">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fin-dot fin-dot-expenses"></span>
                                            <span class="fin-lbl-name">{{ __('messages.expenses') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="fin-lbl-amount">{{ number_format($dailyExpenses, 3) }}</span>
                                            <span class="fin-pct-pill fin-pct-orange">{{ $dExpPct }}%</span>
                                        </div>
                                    </div>
                                    <div class="fin-breakdown-row">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fin-dot fin-dot-salaries"></span>
                                            <span class="fin-lbl-name">{{ __('messages.salaries') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="fin-lbl-amount">{{ number_format($dailySalaries, 3) }}</span>
                                            <span class="fin-pct-pill fin-pct-green">{{ $dSalPct }}%</span>
                                        </div>
                                    </div>
                                    <div class="fin-breakdown-row">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fin-dot fin-dot-gas"></span>
                                            <span class="fin-lbl-name">{{ __('messages.gas_readings') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="fin-lbl-amount">{{ number_format($dailyGas, 2) }} ℓ</span>
                                            <span class="fin-pct-pill fin-pct-purple">{{ $dGasPct }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ── WEEKLY TAB ── --}}
                    @php
                        $wTotal = $weeklySales + $weeklyExpenses + $weeklySalaries + $weeklyGas;
                        $wSalesPct = $wTotal > 0 ? number_format(($weeklySales / $wTotal) * 100, 1) : '0.0';
                        $wExpPct   = $wTotal > 0 ? number_format(($weeklyExpenses / $wTotal) * 100, 1) : '0.0';
                        $wSalPct   = $wTotal > 0 ? number_format(($weeklySalaries / $wTotal) * 100, 1) : '0.0';
                        $wGasPct   = $wTotal > 0 ? number_format(($weeklyGas / $wTotal) * 100, 1) : '0.0';
                    @endphp
                    <div class="tab-pane fade" id="weekly" role="tabpanel">
                        <div class="fin-subbar d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
                            <div class="fin-net-capsule">
                                <i class="fas fa-file-alt"></i>
                                <span>{{ __('messages.weekly_report') }}: <strong>{{ number_format($weeklyProfit, 3) }}</strong></span>
                            </div>
                            <a href="{{ route('reports.download', 'weekly') }}" class="btn btn-pdf-gradient">
                                <span class="pdf-tag-badge">{{ __('messages.pdf') }}</span>
                                <span>{{ __('messages.download_pdf') }}</span>
                                <i class="fas fa-download"></i>
                            </a>
                        </div>

                        <div class="row align-items-center g-4">
                            <div class="col-md-5 text-center">
                                <div class="fin-donut-wrapper">
                                    <canvas id="weeklyDonutChart"></canvas>
                                    <div class="fin-donut-center">
                                        <div class="fin-donut-val">{{ number_format($weeklyProfit, 3) }}</div>
                                        <div class="fin-donut-lbl">Total</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="fin-breakdown-card">
                                    <div class="fin-breakdown-row">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fin-dot fin-dot-sales"></span>
                                            <span class="fin-lbl-name">{{ __('messages.sales') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="fin-lbl-amount">{{ number_format($weeklySales, 3) }}</span>
                                            <span class="fin-pct-pill fin-pct-blue">{{ $wSalesPct }}%</span>
                                        </div>
                                    </div>
                                    <div class="fin-breakdown-row">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fin-dot fin-dot-expenses"></span>
                                            <span class="fin-lbl-name">{{ __('messages.expenses') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="fin-lbl-amount">{{ number_format($weeklyExpenses, 3) }}</span>
                                            <span class="fin-pct-pill fin-pct-orange">{{ $wExpPct }}%</span>
                                        </div>
                                    </div>
                                    <div class="fin-breakdown-row">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fin-dot fin-dot-salaries"></span>
                                            <span class="fin-lbl-name">{{ __('messages.salaries') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="fin-lbl-amount">{{ number_format($weeklySalaries, 3) }}</span>
                                            <span class="fin-pct-pill fin-pct-green">{{ $wSalPct }}%</span>
                                        </div>
                                    </div>
                                    <div class="fin-breakdown-row">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fin-dot fin-dot-gas"></span>
                                            <span class="fin-lbl-name">{{ __('messages.gas_readings') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="fin-lbl-amount">{{ number_format($weeklyGas, 2) }} ℓ</span>
                                            <span class="fin-pct-pill fin-pct-purple">{{ $wGasPct }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ── MONTHLY TAB ── --}}
                    @php
                        $mTotal = $monthlySales + $monthlyExpenses + $monthlySalaries + $monthlyGas;
                        $mSalesPct = $mTotal > 0 ? number_format(($monthlySales / $mTotal) * 100, 1) : '0.0';
                        $mExpPct   = $mTotal > 0 ? number_format(($monthlyExpenses / $mTotal) * 100, 1) : '0.0';
                        $mSalPct   = $mTotal > 0 ? number_format(($monthlySalaries / $mTotal) * 100, 1) : '0.0';
                        $mGasPct   = $mTotal > 0 ? number_format(($monthlyGas / $mTotal) * 100, 1) : '0.0';
                    @endphp
                    <div class="tab-pane fade" id="monthly" role="tabpanel">
                        <div class="fin-subbar d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
                            <div class="fin-net-capsule">
                                <i class="fas fa-file-alt"></i>
                                <span>{{ __('messages.monthly_report') }}: <strong id="monthlyProfitNet">{{ number_format($monthlyProfit, 3) }}</strong></span>
                            </div>
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <select id="monthlyReportMonth" class="form-select form-select-sm" style="border-radius: 10px; font-weight: 600; width: auto; border: 1.5px solid #e2e8f0;">
                                    @foreach(range(1, 12) as $m)
                                        <option value="{{ $m }}" {{ $m == date('n') ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                    @endforeach
                                </select>
                                <select id="monthlyReportYear" class="form-select form-select-sm" style="border-radius: 10px; font-weight: 600; width: auto; border: 1.5px solid #e2e8f0;">
                                    @foreach(range(date('Y') - 5, date('Y') + 2) as $y)
                                        <option value="{{ $y }}" {{ $y == date('Y') ? 'selected' : '' }}>{{ $y }}</option>
                                    @endforeach
                                </select>
                                <a id="monthlyDownloadBtn" href="{{ route('reports.download', 'monthly') }}" class="btn btn-pdf-gradient">
                                    <span class="pdf-tag-badge">{{ __('messages.pdf') }}</span>
                                    <span>{{ __('messages.download_pdf') }}</span>
                                    <i class="fas fa-download"></i>
                                </a>
                            </div>
                        </div>

                        <div class="row align-items-center g-4">
                            <div class="col-md-5 text-center">
                                <div class="fin-donut-wrapper">
                                    <canvas id="monthlyDonutChart"></canvas>
                                    <div class="fin-donut-center">
                                        <div class="fin-donut-val" id="monthlyDonutCenterVal">{{ number_format($monthlyProfit, 3) }}</div>
                                        <div class="fin-donut-lbl">Total</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="fin-breakdown-card">
                                    <div class="fin-breakdown-row">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fin-dot fin-dot-sales"></span>
                                            <span class="fin-lbl-name">{{ __('messages.sales') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="fin-lbl-amount" id="monthlySalesVal">{{ number_format($monthlySales, 3) }}</span>
                                            <span class="fin-pct-pill fin-pct-blue" id="monthlySalesPct">{{ $mSalesPct }}%</span>
                                        </div>
                                    </div>
                                    <div class="fin-breakdown-row">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fin-dot fin-dot-expenses"></span>
                                            <span class="fin-lbl-name">{{ __('messages.expenses') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="fin-lbl-amount" id="monthlyExpensesVal">{{ number_format($monthlyExpenses, 3) }}</span>
                                            <span class="fin-pct-pill fin-pct-orange" id="monthlyExpensesPct">{{ $mExpPct }}%</span>
                                        </div>
                                    </div>
                                    <div class="fin-breakdown-row">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fin-dot fin-dot-salaries"></span>
                                            <span class="fin-lbl-name">{{ __('messages.salaries') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="fin-lbl-amount" id="monthlySalariesVal">{{ number_format($monthlySalaries, 3) }}</span>
                                            <span class="fin-pct-pill fin-pct-green" id="monthlySalariesPct">{{ $mSalPct }}%</span>
                                        </div>
                                    </div>
                                    <div class="fin-breakdown-row">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fin-dot fin-dot-gas"></span>
                                            <span class="fin-lbl-name">{{ __('messages.gas_readings') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="fin-lbl-amount" id="monthlyGasVal">{{ number_format($monthlyGas, 2) }} ℓ</span>
                                            <span class="fin-pct-pill fin-pct-purple" id="monthlyGasPct">{{ $mGasPct }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ── YEARLY TAB ── --}}
                    @php
                        $yTotal = $yearlySales + $yearlyExpenses + $yearlySalaries + $yearlyGas;
                        $ySalesPct = $yTotal > 0 ? number_format(($yearlySales / $yTotal) * 100, 1) : '0.0';
                        $yExpPct   = $yTotal > 0 ? number_format(($yearlyExpenses / $yTotal) * 100, 1) : '0.0';
                        $ySalPct   = $yTotal > 0 ? number_format(($yearlySalaries / $yTotal) * 100, 1) : '0.0';
                        $yGasPct   = $yTotal > 0 ? number_format(($yearlyGas / $yTotal) * 100, 1) : '0.0';
                    @endphp
                    <div class="tab-pane fade" id="yearly" role="tabpanel">
                        <div class="fin-subbar d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
                            <div class="fin-net-capsule">
                                <i class="fas fa-file-alt"></i>
                                <span>{{ __('messages.yearly_report') }}: <strong id="yearlyProfitNet">{{ number_format($yearlyProfit, 3) }}</strong></span>
                            </div>
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <select id="yearlyReportYear" class="form-select form-select-sm" style="border-radius: 10px; font-weight: 600; width: auto; border: 1.5px solid #e2e8f0;">
                                    @foreach(range(date('Y') - 5, date('Y') + 3) as $y)
                                        <option value="{{ $y }}" {{ $y == date('Y') ? 'selected' : '' }}>{{ $y }}</option>
                                    @endforeach
                                </select>
                                <a id="yearlyDownloadBtn" href="{{ route('reports.download', 'yearly') }}" class="btn btn-pdf-gradient">
                                    <span class="pdf-tag-badge">{{ __('messages.pdf') }}</span>
                                    <span>{{ __('messages.download_pdf') }}</span>
                                    <i class="fas fa-download"></i>
                                </a>
                            </div>
                        </div>

                        <div class="row align-items-center g-4">
                            <div class="col-md-5 text-center">
                                <div class="fin-donut-wrapper">
                                    <canvas id="yearlyDonutChart"></canvas>
                                    <div class="fin-donut-center">
                                        <div class="fin-donut-val" id="yearlyDonutCenterVal">{{ number_format($yearlyProfit, 3) }}</div>
                                        <div class="fin-donut-lbl">Total</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="fin-breakdown-card">
                                    <div class="fin-breakdown-row">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fin-dot fin-dot-sales"></span>
                                            <span class="fin-lbl-name">{{ __('messages.sales') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="fin-lbl-amount" id="yearlySalesVal">{{ number_format($yearlySales, 3) }}</span>
                                            <span class="fin-pct-pill fin-pct-blue" id="yearlySalesPct">{{ $ySalesPct }}%</span>
                                        </div>
                                    </div>
                                    <div class="fin-breakdown-row">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fin-dot fin-dot-expenses"></span>
                                            <span class="fin-lbl-name">{{ __('messages.expenses') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="fin-lbl-amount" id="yearlyExpensesVal">{{ number_format($yearlyExpenses, 3) }}</span>
                                            <span class="fin-pct-pill fin-pct-orange" id="yearlyExpensesPct">{{ $yExpPct }}%</span>
                                        </div>
                                    </div>
                                    <div class="fin-breakdown-row">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fin-dot fin-dot-salaries"></span>
                                            <span class="fin-lbl-name">{{ __('messages.salaries') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="fin-lbl-amount" id="yearlySalariesVal">{{ number_format($yearlySalaries, 3) }}</span>
                                            <span class="fin-pct-pill fin-pct-green" id="yearlySalariesPct">{{ $ySalPct }}%</span>
                                        </div>
                                    </div>
                                    <div class="fin-breakdown-row">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fin-dot fin-dot-gas"></span>
                                            <span class="fin-lbl-name">{{ __('messages.gas_readings') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="fin-lbl-amount" id="yearlyGasVal">{{ number_format($yearlyGas, 2) }} ℓ</span>
                                            <span class="fin-pct-pill fin-pct-purple" id="yearlyGasPct">{{ $yGasPct }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Key Metrics Card -->
    <div class="col-xl-4 col-lg-5 mb-4">
        <div class="card h-100 shadow-sm" style="border-radius: 20px; border: 1px solid #edf2f7; background: #ffffff;">
            <div class="card-header py-3 d-flex align-items-center gap-3" style="background: transparent; border-bottom: 1px solid #f1f5f9;">
                <div style="width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #6366f1, #4f46e5); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 17px; box-shadow: 0 4px 10px rgba(99, 102, 241, 0.25);">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div>
                    <h6 class="m-0 font-weight-bold" style="color: #0f172a; font-size: 16px;">{{ __('messages.key_metrics') }}</h6>
                    <small class="text-muted">{{ __('messages.high_level_summaries') }}</small>
                </div>
            </div>
            <div class="card-body d-flex flex-column justify-content-between p-4">
                <div>
                    <!-- Metric 1: Monthly Sales Volume -->
                    <div class="p-3 mb-3" style="background: #f8fafc; border-radius: 14px; border: 1px solid #f1f5f9;">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-xs font-weight-bold text-uppercase" style="color: #4f46e5; font-size: 11px; letter-spacing: 0.5px;">{{ __('messages.monthly_report') }} ({{ __('messages.sales') }})</span>
                            <span class="badge" style="background: #e0e7ff; color: #4338ca; border-radius: 6px; font-size: 10px;">{{ __('messages.this_month_salaries') }}</span>
                        </div>
                        <div class="h3 mb-0 font-weight-bold" style="color: #0f172a;">{{ number_format($monthlySales, 3) }} <small style="font-size: 14px; color: #64748b;">OMR</small></div>
                    </div>

                    <!-- Metric 2: Total Customer Base -->
                    <div class="p-3 mb-3" style="background: #f8fafc; border-radius: 14px; border: 1px solid #f1f5f9;">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-xs font-weight-bold text-uppercase" style="color: #d97706; font-size: 11px; letter-spacing: 0.5px;">{{ __('messages.total_customers') }}</span>
                            <span class="badge" style="background: #fef3c7; color: #b45309; border-radius: 6px; font-size: 10px;">{{ __('messages.active') }}</span>
                        </div>
                        <div class="h3 mb-0 font-weight-bold" style="color: #0f172a;">{{ $totalCustomers }} <small style="font-size: 14px; color: #64748b;">{{ __('messages.customers') }}</small></div>
                    </div>

                    <!-- Metric 3: Total Expenses (All Time) -->
                    <div class="p-3" style="background: #f8fafc; border-radius: 14px; border: 1px solid #f1f5f9;">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-xs font-weight-bold text-uppercase" style="color: #dc2626; font-size: 11px; letter-spacing: 0.5px;">{{ __('messages.all_time_expenses') }}</span>
                            <span class="badge" style="background: #fee2e2; color: #b91c1c; border-radius: 6px; font-size: 10px;">{{ __('messages.cumulative') }}</span>
                        </div>
                        <div class="h3 mb-0 font-weight-bold" style="color: #0f172a;">{{ number_format($totalExpenses, 3) }} <small style="font-size: 14px; color: #64748b;">OMR</small></div>
                    </div>
                </div>

                <div class="pt-3 border-top mt-3">
                    <p class="small text-muted mb-0 d-flex align-items-center gap-2">
                        <i class="fas fa-sync-alt text-primary" style="font-size: 12px;"></i>
                        <span>{{ __('messages.financial_updated_notice') }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════ LAST 7 DAYS SALES (Modern) - Above Visa Alerts ═══════════ --}}
<div class="row mb-2">
    <div class="col-12">
        @php
            $growthPositive = $salesGrowthPct >= 0;
            $growthColor    = $growthPositive ? '#16a34a' : '#dc2626';
            $growthIcon     = $growthPositive ? 'fa-arrow-up' : 'fa-arrow-down';
            $footerMsg      = $growthPositive
                ? __('messages.sales_increased_msg', ['pct' => abs($salesGrowthPct)])
                : __('messages.sales_decreased_msg', ['pct' => abs($salesGrowthPct)]);
        @endphp
        <div class="sales7-card mb-4">
            {{-- Header --}}
            <div class="sales7-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="sales7-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 font-weight-bold" style="color:#0f172a;font-size:19px;font-weight:800;">{{ __('messages.last_7_days_sales') }}</h5>
                        <div class="text-muted" style="font-size:13px;margin-top:2px;">{{ __('messages.sales_overview_7_days') }}</div>
                    </div>
                </div>
                <button class="btn sales7-period-pill">
                    <i class="far fa-calendar-alt me-1"></i> {{ __('messages.last_7_days') }} &nbsp;&#8964;
                </button>
            </div>

            {{-- Stats Row --}}
            <div class="px-4 pb-3">
                <div class="sales7-stat-box">
                    <div class="sales7-stat-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div>
                        <div class="sales7-total-val">{{ number_format($last7DaysSales, 3) }}</div>
                        <div class="sales7-total-lbl">{{ __('messages.total_sales') }}</div>
                    </div>
                    <div class="sales7-divider"></div>
                    <div>
                        <div class="sales7-growth-val" style="color: {{ $growthColor }};">
                            <i class="fas {{ $growthIcon }}" style="font-size:14px;"></i>
                            {{ $growthPositive ? '+' : '' }}{{ $salesGrowthPct }}%
                        </div>
                        <div class="sales7-growth-lbl">{{ __('messages.vs_previous_7_days') }}</div>
                    </div>
                </div>
            </div>

            {{-- Chart --}}
            <div class="px-4" style="position:relative;">
                <canvas id="salesAreaChart"></canvas>
            </div>

            {{-- Footer --}}
            <div class="sales7-footer">
                <div class="d-flex align-items-center gap-3">
                    <div class="sales7-footer-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="sales7-footer-text">
                        <strong>{{ $growthPositive ? __('messages.great_performance') : __('messages.needs_attention') }}</strong>
                        <span>{{ $footerMsg }}</span>
                    </div>
                </div>
                <i class="fas fa-chart-line" style="color:#2563eb;font-size:20px;opacity:0.6;"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Visa Expiration Alerts Section -->
    <div class="col-12">
        <div class="card shadow mb-4" style="border-radius: 16px; border: none; overflow: hidden;">
            <div class="card-header py-3 d-flex align-items-center justify-content-between" style="background: #ffffff; border-bottom: 1.5px solid #f1f5f9;">
                <div class="d-flex align-items-center gap-2">
                    <div style="width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #f59e0b, #d97706); display: flex; align-items: center; justify-content: center; color: #fff;">
                        <i class="fas fa-passport"></i>
                    </div>
                    <div>
                        <h6 class="m-0 font-weight-bold" style="color: #1e293b; font-size: 16px;">
                            {{ __('messages.visa_expiration_alerts') }}
                        </h6>
                        <small class="text-muted">{{ __('messages.visa_alerts_desc') }}</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="badge-modern badge-red">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ __('messages.urgent_red') }}
                    </span>
                    <span class="badge-modern badge-yellow">
                        <i class="fas fa-clock me-1"></i> {{ __('messages.warning_yellow') }}
                    </span>
                    <a href="{{ route('visa_details.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 ms-2">
                        {{ __('messages.view_all_visas') }} <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0" style="width: 100%;">
                        <thead style="background: #f8fafc;">
                            <tr>
                                <th style="padding: 12px 20px; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase;">{{ __('messages.team_members') }}</th>
                                <th style="padding: 12px 20px; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase;">{{ __('messages.designation') }}</th>
                                <th style="padding: 12px 20px; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase;">{{ __('messages.issue_date') }}</th>
                                <th style="padding: 12px 20px; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase;">{{ __('messages.expiry_date') }}</th>
                                <th style="padding: 12px 20px; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase;">{{ __('messages.days_remaining') }}</th>
                                <th style="padding: 12px 20px; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; text-align: center;">{{ __('messages.status') }}</th>
                                <th style="padding: 12px 20px; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; text-align: end;">{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($expiringVisas as $visa)
                                @php
                                    $daysRemaining = (int) \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($visa->expiry_date), false);
                                    
                                    if ($daysRemaining < 0) {
                                        $badgeBg = '#fee2e2';
                                        $badgeColor = '#b91c1c';
                                        $badgeText = __('messages.expired_days_ago', ['days' => abs($daysRemaining)]);
                                        $badgeIcon = 'fa-ban';
                                        $statusClass = 'danger';
                                    } elseif ($daysRemaining <= 20) {
                                        $badgeBg = '#fee2e2';
                                        $badgeColor = '#b91c1c';
                                        $badgeText = __('messages.days_left_urgent', ['days' => $daysRemaining]);
                                        $badgeIcon = 'fa-exclamation-triangle';
                                        $statusClass = 'danger';
                                    } else {
                                        $badgeBg = '#fef3c7';
                                        $badgeColor = '#b45309';
                                        $badgeText = __('messages.days_left_warning', ['days' => $daysRemaining]);
                                        $badgeIcon = 'fa-hourglass-half';
                                        $statusClass = 'warning';
                                    }
                                @endphp
                                <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                    <td style="padding: 14px 20px;">
                                        <div class="d-flex align-items-center gap-2">
                                            @if(optional($visa->teamMember)->profile_pic)
                                                <img src="{{ asset('storage/'.$visa->teamMember->profile_pic) }}"
                                                     alt="{{ $visa->teamMember->name }}"
                                                     style="width: 36px; height: 36px; border-radius: 10px; object-fit: cover;">
                                            @else
                                                <div style="width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #4e7fff, #2563eb); color: #fff; font-weight: 700; font-size: 14px; display: flex; align-items: center; justify-content: center;">
                                                    {{ strtoupper(substr($visa->teamMember->name ?? 'M', 0, 1)) }}
                                                </div>
                                            @endif
                                            <div>
                                                <div style="font-weight: 700; color: #1e293b; font-size: 14px;">
                                                    {{ $visa->teamMember->name ?? 'Unknown Member' }}
                                                </div>
                                                <small class="text-muted">#MEM-{{ str_pad($visa->team_member_id, 4, '0', STR_PAD_LEFT) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding: 14px 20px; color: #475569; font-size: 13px;">
                                        <span class="badge" style="background: #f1f5f9; color: #475569; font-weight: 600; padding: 5px 10px; border-radius: 12px;">
                                            {{ $visa->teamMember->designation ?? 'Staff Member' }}
                                        </span>
                                    </td>
                                    <td style="padding: 14px 20px; color: #64748b; font-size: 13px;">
                                        <i class="far fa-calendar-check text-muted me-1"></i>
                                        {{ \Carbon\Carbon::parse($visa->issue_date)->format('d M Y') }}
                                    </td>
                                    <td style="padding: 14px 20px; font-weight: 600; color: #1e293b; font-size: 13px;">
                                        <i class="far fa-calendar-times {{ $statusClass == 'danger' ? 'text-danger' : 'text-warning' }} me-1"></i>
                                        {{ \Carbon\Carbon::parse($visa->expiry_date)->format('d M Y') }}
                                    </td>
                                    <td style="padding: 14px 20px;">
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <span style="font-size: 13px; font-weight: 700; color: {{ $badgeColor }};">
                                                {{ $daysRemaining < 0 ? abs($daysRemaining) . 'd ago' : $daysRemaining . ' days' }}
                                            </span>
                                            <div class="progress" style="height: 6px; width: 70px; background: #e2e8f0; border-radius: 4px;">
                                                @php
                                                    $progressPercent = $daysRemaining <= 0 ? 100 : max(0, min(100, (40 - $daysRemaining) / 40 * 100));
                                                @endphp
                                                <div class="progress-bar bg-{{ $statusClass }}" role="progressbar" style="width: {{ $progressPercent }}%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding: 14px 20px; text-align: center;">
                                        <span class="badge" style="background: {{ $badgeBg }}; color: {{ $badgeColor }}; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 700;">
                                            <i class="fas {{ $badgeIcon }} me-1"></i> {{ $badgeText }}
                                        </span>
                                    </td>
                                    <td style="padding: 14px 20px; text-align: end;">
                                        <a href="{{ route('visa_details.edit', $visa->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px; font-size: 12px; font-weight: 600;" title="Update Visa">
                                            <i class="fas fa-edit me-1"></i> {{ __('messages.renew_edit') }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4" style="color: #64748b;">
                                        <div class="d-flex flex-column align-items-center justify-content-center py-3">
                                            <div style="width: 48px; height: 48px; border-radius: 50%; background: #dcfce7; color: #15803d; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 8px;">
                                                <i class="fas fa-check"></i>
                                            </div>
                                            <strong style="color: #1e293b;">{{ __('messages.all_visas_up_to_date') }}</strong>
                                            <span style="font-size: 13px;">{{ __('messages.no_expiring_visas') }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Current Cylinder Stock -->
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card dashboard-modern-card h-100">
            <div class="card-header bg-white py-3 px-4 d-flex align-items-center justify-content-between border-0" style="border-bottom: 1.5px solid #f1f5f9 !important;">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 42px; height: 42px; border-radius: 12px; background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 18px; box-shadow: 0 4px 12px rgba(14, 165, 233, 0.35);">
                        <i class="fas fa-gas-pump"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 font-weight-bold" style="color: #0f172a; font-size: 17px; font-weight: 800;">
                            {{ __('messages.current_cylinder_stock') }}
                        </h5>
                        <small class="text-muted" style="font-size: 12px;">{{ __('messages.live_inventory') }}</small>
                    </div>
                </div>
                <div>
                    @php
                        $totalStockCount = array_sum($stocks);
                    @endphp
                    <span class="badge" style="background: #e0f2fe; color: #0369a1; border-radius: 9999px; font-weight: 700; padding: 6px 14px; font-size: 12px;">
                        <i class="fas fa-layer-group me-1"></i> {{ $totalStockCount }} {{ __('messages.total_stock') }}
                    </span>
                </div>
            </div>
            <div class="card-body p-4" style="max-height: 440px; overflow-y: auto;">
                @php
                    $cylinderIcons = [
                        '11kg' => ['color' => '#2563eb', 'bg' => '#eff6ff', 'icon' => 'fa-gas-pump', 'name' => '11KG ' . __('messages.cylinder_type')],
                        '22kg' => ['color' => '#16a34a', 'bg' => '#f0fdf4', 'icon' => 'fa-fill-drip', 'name' => '22KG ' . __('messages.cylinder_type')],
                        '44kg' => ['color' => '#d97706', 'bg' => '#fffbeb', 'icon' => 'fa-fire', 'name' => '44KG ' . __('messages.cylinder_type')],
                    ];
                @endphp
                @foreach($stocks as $size => $qty)
                    @php
                        $info = $cylinderIcons[$size] ?? ['color' => '#2563eb', 'bg' => '#eff6ff', 'icon' => 'fa-gas-pump', 'name' => strtoupper($size) . ' ' . __('messages.cylinder_type')];
                        $isLow = $qty < 5;
                        $progressPercent = min(max($qty * 2, 5), 100);
                        $barColor = $isLow ? 'linear-gradient(90deg, #ef4444, #dc2626)' : 'linear-gradient(90deg, ' . $info['color'] . ', #1d4ed8)';
                    @endphp
                    <div class="stock-row-item">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <span style="width: 32px; height: 32px; border-radius: 9px; background: {{ $info['bg'] }}; color: {{ $info['color'] }}; display: flex; align-items: center; justify-content: center; font-size: 14px;">
                                    <i class="fas {{ $info['icon'] }}"></i>
                                </span>
                                <div>
                                    <strong style="color: #1e293b; font-size: 14px;">{{ $info['name'] }}</strong>
                                    <div class="text-muted" style="font-size: 11px;">{{ __('messages.empty_new_stock') }}</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                @if($isLow)
                                    <span class="badge" style="background: #fee2e2; color: #b91c1c; font-size: 10px; font-weight: 700; border-radius: 6px;">
                                        {{ __('messages.low_stock') }}
                                    </span>
                                @else
                                    <span class="badge" style="background: #dcfce7; color: #15803d; font-size: 10px; font-weight: 700; border-radius: 6px;">
                                        {{ __('messages.in_stock') }}
                                    </span>
                                @endif
                                <span class="badge" style="background: #ffffff; color: #0f172a; border: 1.5px solid #e2e8f0; font-size: 13px; font-weight: 800; padding: 5px 12px; border-radius: 8px;">
                                    {{ $qty }} <small style="font-size: 11px; font-weight: 600; color: #64748b;">{{ __('messages.units') }}</small>
                                </span>
                            </div>
                        </div>
                        <div class="progress" style="height: 8px; border-radius: 10px; background: #e2e8f0;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $progressPercent }}%; background: {{ $barColor }}; border-radius: 10px;" aria-valuenow="{{ $qty }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Recent Login Users -->
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card dashboard-modern-card h-100">
            <div class="card-header bg-white py-3 px-4 d-flex align-items-center justify-content-between border-0" style="border-bottom: 1.5px solid #f1f5f9 !important;">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 42px; height: 42px; border-radius: 12px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 18px; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.35);">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 font-weight-bold" style="color: #0f172a; font-size: 17px; font-weight: 800;">
                            {{ __('messages.recent_login_activity') }}
                        </h5>
                        <small class="text-muted" style="font-size: 12px;">{{ __('messages.latest_user_sessions') }}</small>
                    </div>
                </div>
                <div>
                    <span class="badge" style="background: #eef2ff; color: #4338ca; border-radius: 9999px; font-weight: 700; padding: 6px 14px; font-size: 12px;">
                        <i class="fas fa-users me-1"></i> {{ $totalUsers }} {{ __('messages.total_staff') }}
                    </span>
                </div>
            </div>
            <div class="card-body p-3" style="max-height: 440px; overflow-y: auto;">
                @forelse($recentLogins as $log)
                    @php
                        $userInitials = strtoupper(substr($log->user->name ?? 'U', 0, 1));
                        $colors = [
                            'linear-gradient(135deg, #3b82f6, #1d4ed8)',
                            'linear-gradient(135deg, #10b981, #047857)',
                            'linear-gradient(135deg, #8b5cf6, #6d28d9)',
                            'linear-gradient(135deg, #f59e0b, #d97706)',
                            'linear-gradient(135deg, #ec4899, #be185d)'
                        ];
                        $bgGradient = $colors[($log->user_id ?? 0) % count($colors)];
                        $roleName = $log->user ? ($log->user->roles->first()?->name ?? 'Staff') : 'User';
                    @endphp
                    <div class="login-user-item">
                        <div class="d-flex align-items-center gap-3" style="min-width: 0;">
                            <div class="user-avatar-circle" style="background: {{ $bgGradient }};">
                                {{ $userInitials }}
                            </div>
                            <div style="min-width: 0;">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <strong class="text-dark" style="font-size: 14px;">{{ $log->user->name ?? 'Unknown User' }}</strong>
                                    <span class="badge" style="background: {{ $roleName === 'Admin' ? '#dbeafe' : '#f3e8ff' }}; color: {{ $roleName === 'Admin' ? '#1e40af' : '#7e22ce' }}; font-size: 10px; font-weight: 700; border-radius: 6px; padding: 2px 7px;">
                                        {{ $roleName }}
                                    </span>
                                </div>
                                <div class="text-muted text-truncate" style="font-size: 12px;">
                                    {{ $log->user->email ?? 'No email' }}
                                </div>
                            </div>
                        </div>
                        <div class="text-end flex-shrink-0">
                            <div style="font-weight: 700; color: #1e293b; font-size: 12.5px;">
                                <i class="far fa-clock text-primary me-1"></i>
                                {{ $log->login_at ? $log->login_at->format('d M Y, h:i A') : 'N/A' }}
                            </div>
                            <div class="d-flex align-items-center justify-content-end gap-1 mt-1">
                                <span class="badge" style="background: #f1f5f9; color: #64748b; font-size: 11px; font-weight: 600; border-radius: 6px; padding: 3px 8px;">
                                    <i class="fas fa-network-wired me-1" style="font-size: 10px;"></i> {{ $log->ip_address ?? '127.0.0.1' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-user-clock fa-3x mb-3 text-gray-300"></i>
                        <p class="mb-0">{{ __('messages.no_login_activity') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // ══════════════════════════════════════════
    // LAST 7 DAYS SALES — Modern Area Chart
    // ══════════════════════════════════════════
    (function() {
        const salesCanvas = document.getElementById('salesAreaChart');
        if (!salesCanvas) return;

        const salesLabels = @json($chartData->keys());
        const salesValues = @json($chartData->values());

        new Chart(salesCanvas, {
            type: 'line',
            data: {
                labels: salesLabels,
                datasets: [{
                    label: 'Sales',
                    data: salesValues,
                    backgroundColor: function(context) {
                        const chart = context.chart;
                        const { ctx, chartArea } = chart;
                        if (!chartArea) return 'rgba(37,99,235,0.08)';
                        const gradient = ctx.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
                        gradient.addColorStop(0, 'rgba(37,99,235,0.22)');
                        gradient.addColorStop(1, 'rgba(37,99,235,0.01)');
                        return gradient;
                    },
                    borderColor: '#2563eb',
                    borderWidth: 2.5,
                    pointRadius: 5,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#2563eb',
                    pointBorderWidth: 2.5,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#2563eb',
                    pointHoverBorderColor: '#ffffff',
                    pointHoverBorderWidth: 2,
                    pointHitRadius: 12,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: { padding: { left: 4, right: 4, top: 10, bottom: 4 } },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e40af',
                        titleColor: '#bfdbfe',
                        bodyColor: '#ffffff',
                        padding: 12,
                        cornerRadius: 10,
                        displayColors: false,
                        callbacks: {
                            title: function(items) { return items[0].label; },
                            label: function(item) { return '\uD83D\uDED2 ' + Number(item.raw).toFixed(2) + ' Sales'; }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { color: 'rgba(226,232,240,0.6)', drawBorder: false },
                        ticks: { color: '#94a3b8', font: { size: 11 } }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(226,232,240,0.6)', drawBorder: false },
                        ticks: { color: '#94a3b8', font: { size: 11 } }
                    }
                }
            }
        });
    })();

    // Dynamic Report Download URL Updates & Live AJAX Data Fetching
    const monthlyMonth = document.getElementById('monthlyReportMonth');
    const monthlyYear = document.getElementById('monthlyReportYear');
    const monthlyBtn = document.getElementById('monthlyDownloadBtn');
    
    function updateMonthlyLink() {
        const baseUrl = "{{ route('reports.download', 'monthly') }}";
        if (monthlyBtn) {
            monthlyBtn.href = `${baseUrl}?month=${monthlyMonth.value}&year=${monthlyYear.value}`;
        }
    }

    function fetchMonthlyData() {
        updateMonthlyLink();
        const month = monthlyMonth.value;
        const year = monthlyYear.value;
        const url = `{{ route('reports.data') }}?type=monthly&month=${month}&year=${year}`;

        fetch(url)
            .then(res => res.json())
            .then(data => {
                if (data.error) return;

                // Update text fields
                const netEl = document.getElementById('monthlyProfitNet');
                if (netEl) netEl.textContent = data.profit_formatted;

                const centerValEl = document.getElementById('monthlyDonutCenterVal');
                if (centerValEl) centerValEl.textContent = data.profit_formatted;

                const salesValEl = document.getElementById('monthlySalesVal');
                if (salesValEl) salesValEl.textContent = data.sales_formatted;
                const salesPctEl = document.getElementById('monthlySalesPct');
                if (salesPctEl) salesPctEl.textContent = data.sales_pct + '%';

                const expValEl = document.getElementById('monthlyExpensesVal');
                if (expValEl) expValEl.textContent = data.expenses_formatted;
                const expPctEl = document.getElementById('monthlyExpensesPct');
                if (expPctEl) expPctEl.textContent = data.expenses_pct + '%';

                const salValEl = document.getElementById('monthlySalariesVal');
                if (salValEl) salValEl.textContent = data.salaries_formatted;
                const salPctEl = document.getElementById('monthlySalariesPct');
                if (salPctEl) salPctEl.textContent = data.salaries_pct + '%';

                const gasValEl = document.getElementById('monthlyGasVal');
                if (gasValEl) gasValEl.textContent = data.gas_formatted + ' ℓ';
                const gasPctEl = document.getElementById('monthlyGasPct');
                if (gasPctEl) gasPctEl.textContent = data.gas_pct + '%';

                // Update Donut Chart
                updateDonutChart('monthly', [data.sales, data.expenses, data.salaries, Math.max(0, data.gas)]);
            })
            .catch(err => console.error('Error fetching monthly report data:', err));
    }
    
    if (monthlyMonth && monthlyYear) {
        monthlyMonth.addEventListener('change', fetchMonthlyData);
        monthlyYear.addEventListener('change', fetchMonthlyData);
        updateMonthlyLink(); // Initialize
    }

    const yearlyYear = document.getElementById('yearlyReportYear');
    const yearlyBtn = document.getElementById('yearlyDownloadBtn');
    
    function updateYearlyLink() {
        const baseUrl = "{{ route('reports.download', 'yearly') }}";
        if (yearlyBtn) {
            yearlyBtn.href = `${baseUrl}?year=${yearlyYear.value}`;
        }
    }

    function fetchYearlyData() {
        updateYearlyLink();
        const year = yearlyYear.value;
        const url = `{{ route('reports.data') }}?type=yearly&year=${year}`;

        fetch(url)
            .then(res => res.json())
            .then(data => {
                if (data.error) return;

                // Update text fields
                const netEl = document.getElementById('yearlyProfitNet');
                if (netEl) netEl.textContent = data.profit_formatted;

                const centerValEl = document.getElementById('yearlyDonutCenterVal');
                if (centerValEl) centerValEl.textContent = data.profit_formatted;

                const salesValEl = document.getElementById('yearlySalesVal');
                if (salesValEl) salesValEl.textContent = data.sales_formatted;
                const salesPctEl = document.getElementById('yearlySalesPct');
                if (salesPctEl) salesPctEl.textContent = data.sales_pct + '%';

                const expValEl = document.getElementById('yearlyExpensesVal');
                if (expValEl) expValEl.textContent = data.expenses_formatted;
                const expPctEl = document.getElementById('yearlyExpensesPct');
                if (expPctEl) expPctEl.textContent = data.expenses_pct + '%';

                const salValEl = document.getElementById('yearlySalariesVal');
                if (salValEl) salValEl.textContent = data.salaries_formatted;
                const salPctEl = document.getElementById('yearlySalariesPct');
                if (salPctEl) salPctEl.textContent = data.salaries_pct + '%';

                const gasValEl = document.getElementById('yearlyGasVal');
                if (gasValEl) gasValEl.textContent = data.gas_formatted + ' ℓ';
                const gasPctEl = document.getElementById('yearlyGasPct');
                if (gasPctEl) gasPctEl.textContent = data.gas_pct + '%';

                // Update Donut Chart
                updateDonutChart('yearly', [data.sales, data.expenses, data.salaries, Math.max(0, data.gas)]);
            })
            .catch(err => console.error('Error fetching yearly report data:', err));
    }
    
    if (yearlyYear) {
        yearlyYear.addEventListener('change', fetchYearlyData);
        updateYearlyLink(); // Initialize
    }

    // ═════════════════════════════════════════════════════════
    // FINANCIAL PERFORMANCE DONUT CHARTS (Matching Uploaded Image)
    // ═════════════════════════════════════════════════════════
    const finDonutConfigs = {
        daily: {
            id: 'dailyDonutChart',
            data: [{{ (float)$dailySales }}, {{ (float)$dailyExpenses }}, {{ (float)$dailySalaries }}, {{ (float)$dailyGas }}]
        },
        weekly: {
            id: 'weeklyDonutChart',
            data: [{{ (float)$weeklySales }}, {{ (float)$weeklyExpenses }}, {{ (float)$weeklySalaries }}, {{ (float)$weeklyGas }}]
        },
        monthly: {
            id: 'monthlyDonutChart',
            data: [{{ (float)$monthlySales }}, {{ (float)$monthlyExpenses }}, {{ (float)$monthlySalaries }}, {{ (float)$monthlyGas }}]
        },
        yearly: {
            id: 'yearlyDonutChart',
            data: [{{ (float)$yearlySales }}, {{ (float)$yearlyExpenses }}, {{ (float)$yearlySalaries }}, {{ (float)$yearlyGas }}]
        }
    };

    const finDonutInstances = {};

    function updateDonutChart(key, newData) {
        if (!finDonutConfigs[key]) return;
        finDonutConfigs[key].data = newData;
        if (finDonutInstances[key]) {
            const hasData = newData.some(val => val > 0);
            finDonutInstances[key].data.datasets[0].data = hasData ? newData : [1];
            finDonutInstances[key].data.datasets[0].backgroundColor = hasData 
                ? ['#007aff', '#f59e0b', '#10b981', '#8b5cf6'] 
                : ['#e2e8f0'];
            finDonutInstances[key].options.plugins.tooltip.enabled = hasData;
            finDonutInstances[key].update();
        }
    }

    function initFinDonut(key) {
        if (!finDonutConfigs[key]) return;
        
        if (finDonutInstances[key]) {
            finDonutInstances[key].resize();
            return;
        }

        const cfg = finDonutConfigs[key];
        const canvas = document.getElementById(cfg.id);
        if (!canvas) return;

        const hasData = cfg.data.some(val => val > 0);
        const dataValues = hasData ? cfg.data : [1];
        const bgColors = hasData 
            ? ['#007aff', '#f59e0b', '#10b981', '#8b5cf6'] 
            : ['#e2e8f0'];

        finDonutInstances[key] = new Chart(canvas, {
            type: 'doughnut',
            data: {
                labels: ['Sales', 'Expenses', 'Salaries', 'Gas Readings'],
                datasets: [{
                    data: dataValues,
                    backgroundColor: bgColors,
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        enabled: hasData,
                        callbacks: {
                            label: function(ctx) {
                                return ' ' + ctx.label + ': ' + Number(ctx.raw).toFixed(2);
                            }
                        }
                    }
                }
            }
        });
    }

    // Initialize daily donut on page load
    initFinDonut('daily');

    // Tab switch handling for pills & dropdown
    document.querySelectorAll('button[data-bs-toggle="pill"]').forEach(btn => {
        btn.addEventListener('shown.bs.tab', function(e) {
            const target = e.target.getAttribute('data-bs-target').replace('#', '');
            initFinDonut(target);

            const periodNames = {
                daily: 'Daily Report',
                weekly: 'Weekly Report',
                monthly: 'Monthly Report',
                yearly: 'Yearly Report'
            };
            const labelEl = document.getElementById('currentPeriodLabel');
            if (labelEl && periodNames[target]) {
                labelEl.textContent = periodNames[target];
            }
        });
    });

    function selectReportTab(period) {
        const triggerBtn = document.querySelector(`button[data-bs-target="#${period}"]`);
        if (triggerBtn) {
            bootstrap.Tab.getOrCreateInstance(triggerBtn).show();
        }
    }
</script>
@endsection
