@extends('layouts.app')

@push('styles')
<style>
    body { background-color: #f0f4ff; }

    /* Page Header */
    .report-header-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #edf2f7;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04);
        margin-bottom: 24px;
    }
    .report-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 22px;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    /* KPI Gradient Cards */
    .kpi-card {
        border: none !important;
        border-radius: 16px !important;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        color: #ffffff !important;
        overflow: hidden;
        position: relative;
    }
    .kpi-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(15, 23, 42, 0.15) !important;
    }
    .kpi-purple { background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); }
    .kpi-blue   { background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%); }
    .kpi-emerald{ background: linear-gradient(135deg, #059669 0%, #10b981 100%); }
    .kpi-amber  { background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%); }

    .kpi-title {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 6px;
    }
    .kpi-val {
        font-size: 26px;
        font-weight: 800;
        color: #ffffff;
        line-height: 1.1;
    }
    .kpi-sub {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.9);
        margin-top: 8px;
    }
    .kpi-watermark {
        position: absolute;
        right: 14px;
        bottom: 10px;
        font-size: 50px;
        color: rgba(255, 255, 255, 0.15);
        pointer-events: none;
    }
    .kpi-pill {
        display: inline-block;
        background: rgba(255, 255, 255, 0.22);
        padding: 2px 8px;
        border-radius: 9999px;
        font-size: 11px;
        font-weight: 700;
        margin-right: 4px;
        margin-top: 4px;
    }

    /* Filter Card */
    .filter-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #edf2f7;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03);
        padding: 22px;
        margin-bottom: 24px;
    }
    .form-label-custom {
        font-size: 13px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 6px;
    }
    .form-control-custom, .form-select-custom {
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        padding: 10px 14px;
        font-size: 14px;
        transition: all 0.2s;
    }
    .form-control-custom:focus, .form-select-custom:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    }

    /* Selected Customer Info Highlight Banner */
    .customer-spotlight {
        background: linear-gradient(135deg, #eff6ff 0%, #e0e7ff 100%);
        border: 1.5px solid #bfdbfe;
        border-radius: 16px;
        padding: 18px 22px;
        margin-bottom: 24px;
    }
    .customer-avatar {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: #ffffff;
        font-weight: 800;
        font-size: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);
    }

    /* Table Design */
    .table-container-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #edf2f7;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
        overflow: hidden;
        margin-bottom: 24px;
    }
    .table-header-custom {
        padding: 18px 24px;
        background: #ffffff;
        border-bottom: 1.5px solid #f1f5f9;
    }

    .report-table {
        margin-bottom: 0;
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .report-table thead th {
        vertical-align: middle;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-top: none;
        border-bottom: 1.5px solid #e2e8f0;
        padding: 12px 14px;
    }
    .report-table tbody td {
        padding: 14px 14px;
        vertical-align: middle;
        font-size: 13.5px;
        border-bottom: 1px solid #f1f5f9;
    }
    .report-table tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Table category column headers */
    .th-filled-group {
        background: #eff6ff !important;
        color: #1d4ed8 !important;
        border-bottom: 2px solid #93c5fd !important;
    }
    .th-new-group {
        background: #f0fdf4 !important;
        color: #15803d !important;
        border-bottom: 2px solid #86efac !important;
    }
    .th-sub-filled {
        background: #f8fafc !important;
        color: #1e40af !important;
    }
    .th-sub-new {
        background: #f8fafc !important;
        color: #166534 !important;
    }

    /* Quantity Badges */
    .qty-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        height: 26px;
        padding: 0 6px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
    }
    .qty-filled { background: #dbeafe; color: #1e40af; }
    .qty-new    { background: #dcfce7; color: #15803d; }
    .qty-zero   { color: #94a3b8; font-weight: 500; font-size: 13px; }
    .qty-total  { background: #ede9fe; color: #6d28d9; font-weight: 800; }

    /* Footer Row */
    .report-table tfoot td {
        background: #f8fafc;
        font-weight: 800;
        border-top: 2px solid #cbd5e1;
        padding: 14px 14px;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .report-header-card { padding: 16px; }
        .kpi-val { font-size: 22px; }
        .filter-card { padding: 16px; }
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-0">

    <!-- Top Page Header -->
    <div class="report-header-card d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="report-icon-box">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <div>
                <h3 class="mb-1 font-weight-bold" style="color: #0f172a; font-weight: 800;">
                    {{ __('messages.customer_reports_title') }}
                </h3>
                <p class="text-muted mb-0 small">
                    {{ __('messages.customer_reports_desc') }}
                </p>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2 flex-wrap">
            <!-- Print / PDF Download Button -->
            <a href="{{ route('customer_reports.downloadPdf', request()->all()) }}" 
               class="btn btn-danger d-inline-flex align-items-center gap-2 shadow-sm"
               style="border-radius: 12px; padding: 10px 18px; font-weight: 700;"
               title="Download or Print PDF Report">
                <i class="fas fa-file-pdf"></i>
                <span>{{ __('messages.download_print_pdf') }}</span>
            </a>

            <!-- Quick Link to Sales -->
            <a href="{{ route('sales.index') }}" 
               class="btn btn-outline-primary d-inline-flex align-items-center gap-2"
               style="border-radius: 12px; padding: 10px 16px; font-weight: 600;">
                <i class="fas fa-shopping-cart"></i>
                <span>{{ __('messages.all_sales') }}</span>
            </a>
        </div>
    </div>

    <!-- KPI Summary Overview Cards -->
    <div class="row g-3 mb-4">
        <!-- 1. Total Revenue -->
        <div class="col-xl-3 col-md-6">
            <div class="card kpi-card kpi-purple shadow-sm p-4 h-100">
                <div class="kpi-title">Total Sales Revenue</div>
                <div class="kpi-val">{{ number_format($stats['total_revenue'], 2) }} <small style="font-size: 15px; font-weight: 600;">OMR</small></div>
                <div class="kpi-sub">
                    <i class="fas fa-receipt me-1"></i> {{ $stats['total_orders'] }} Total Invoices
                </div>
                <i class="fas fa-coins kpi-watermark"></i>
            </div>
        </div>

        <!-- 2. Filled Cylinders Sold (Refill) -->
        <div class="col-xl-3 col-md-6">
            <div class="card kpi-card kpi-blue shadow-sm p-4 h-100">
                <div class="kpi-title">Filled Cylinders Sold (Refill)</div>
                <div class="kpi-val">{{ number_format($stats['total_filled']) }} <small style="font-size: 15px; font-weight: 600;">Qty</small></div>
                <div class="kpi-sub mt-2">
                    <span class="kpi-pill">11kg: {{ $stats['filled_11kg'] }}</span>
                    <span class="kpi-pill">22kg: {{ $stats['filled_22kg'] }}</span>
                    <span class="kpi-pill">44kg: {{ $stats['filled_44kg'] }}</span>
                </div>
                <i class="fas fa-fire-flame-simple kpi-watermark"></i>
            </div>
        </div>

        <!-- 3. New Cylinders Sold -->
        <div class="col-xl-3 col-md-6">
            <div class="card kpi-card kpi-emerald shadow-sm p-4 h-100">
                <div class="kpi-title">New Cylinders Sold (Empty/New)</div>
                <div class="kpi-val">{{ number_format($stats['total_new']) }} <small style="font-size: 15px; font-weight: 600;">Qty</small></div>
                <div class="kpi-sub mt-2">
                    <span class="kpi-pill">11kg: {{ $stats['new_11kg'] }}</span>
                    <span class="kpi-pill">22kg: {{ $stats['new_22kg'] }}</span>
                    <span class="kpi-pill">44kg: {{ $stats['new_44kg'] }}</span>
                </div>
                <i class="fas fa-shield-halved kpi-watermark"></i>
            </div>
        </div>

        <!-- 4. Total Cylinders Volume -->
        <div class="col-xl-3 col-md-6">
            <div class="card kpi-card kpi-amber shadow-sm p-4 h-100">
                <div class="kpi-title">Total Cylinders Volume</div>
                <div class="kpi-val">{{ number_format($stats['total_cylinders']) }} <small style="font-size: 15px; font-weight: 600;">Total</small></div>
                <div class="kpi-sub">
                    <i class="fas fa-boxes-stacked me-1"></i> Filled ({{ $stats['total_filled'] }}) + New ({{ $stats['total_new'] }})
                </div>
                <i class="fas fa-cubes kpi-watermark"></i>
            </div>
        </div>
    </div>

    <!-- Filter Section Card -->
    <div class="filter-card">
        <form method="GET" action="{{ route('customer_reports.index') }}" id="filterForm">
            <div class="row g-3 align-items-end">
                <!-- Select Customer Dropdown -->
                <div class="col-lg-4 col-md-6">
                    <label class="form-label-custom">
                        <i class="fas fa-user-tag text-primary me-1"></i> Select Customer
                    </label>
                    <select name="customer_id" class="form-select form-select-custom">
                        <option value="">-- All Customers (Overall Report) --</option>
                        @foreach($customers as $c)
                            <option value="{{ $c->id }}" {{ (string)$customerId === (string)$c->id ? 'selected' : '' }}>
                                {{ $c->name }} ({{ $c->mobile ?? 'No phone' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Date From -->
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <label class="form-label-custom">
                        <i class="far fa-calendar-alt text-muted me-1"></i> Date From
                    </label>
                    <input type="date" name="from_date" class="form-control form-control-custom" value="{{ $fromDate }}">
                </div>

                <!-- Date To -->
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <label class="form-label-custom">
                        <i class="far fa-calendar-check text-muted me-1"></i> Date To
                    </label>
                    <input type="date" name="to_date" class="form-control form-control-custom" value="{{ $toDate }}">
                </div>

                <!-- Action Buttons -->
                <div class="col-lg-2 col-md-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100 d-inline-flex align-items-center justify-content-center gap-2" style="border-radius: 12px; padding: 10px; font-weight: 700;">
                        <i class="fas fa-filter"></i>
                        <span>Filter</span>
                    </button>

                    <a href="{{ route('customer_reports.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center justify-content-center" style="border-radius: 12px; padding: 10px 14px;" title="Reset Filter">
                        <i class="fas fa-redo"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Customer Spotlight Banner (Visible if single customer is selected) -->
    @if($selectedCustomer)
    <div class="customer-spotlight d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
        <div class="d-flex align-items-center gap-3">
            @if($selectedCustomer->profile_pic)
                <img src="{{ asset('storage/'.$selectedCustomer->profile_pic) }}" alt="{{ $selectedCustomer->name }}" style="width: 52px; height: 52px; border-radius: 14px; object-fit: cover;">
            @else
                <div class="customer-avatar">
                    {{ strtoupper(substr($selectedCustomer->name, 0, 1)) }}
                </div>
            @endif
            <div>
                <h5 class="mb-1 font-weight-bold" style="color: #1e3a8a;">
                    {{ $selectedCustomer->name }}
                    <span class="badge bg-primary ms-2" style="font-size: 11px; border-radius: 8px;">Customer #{{ $selectedCustomer->id }}</span>
                </h5>
                <div class="d-flex align-items-center gap-3 text-muted small flex-wrap">
                    <span><i class="fas fa-phone-alt me-1 text-primary"></i> {{ $selectedCustomer->mobile ?? 'N/A' }}</span>
                    <span><i class="fas fa-map-marker-alt me-1 text-danger"></i> {{ $selectedCustomer->address ?? 'N/A' }}</span>
                    @if($selectedCustomer->distance)
                        <span><i class="fas fa-route me-1 text-info"></i> {{ $selectedCustomer->distance }} km</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-4">
            <div class="text-md-end">
                <small class="text-muted text-uppercase" style="font-size: 11px; font-weight: 700;">Lifetime Purchases</small>
                <div class="h5 mb-0 font-weight-bold text-primary">
                    {{ number_format($selectedCustomer->sales_sum_total_amount ?? 0, 2) }} OMR
                </div>
            </div>
            <div class="text-md-end">
                <small class="text-muted text-uppercase" style="font-size: 11px; font-weight: 700;">Lifetime Orders</small>
                <div class="h5 mb-0 font-weight-bold text-dark">
                    {{ $selectedCustomer->sales_count ?? 0 }}
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Data Table Container -->
    <div class="table-container-card">
        <!-- Table Header -->
        <div class="table-header-custom d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <h5 class="mb-0 font-weight-bold" style="color: #0f172a;">
                    Sales History & Cylinder Breakdown
                </h5>
                <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 12px; border-radius: 8px;">
                    {{ $sales->total() }} Records
                </span>
            </div>

            @if($fromDate || $toDate)
            <div class="small text-muted">
                <i class="far fa-clock me-1"></i> Period: 
                <strong>{{ $fromDate ? \Carbon\Carbon::parse($fromDate)->format('d M Y') : 'Start' }}</strong> 
                to 
                <strong>{{ $toDate ? \Carbon\Carbon::parse($toDate)->format('d M Y') : 'Today' }}</strong>
            </div>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table report-table align-middle">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center" style="width: 70px;">Inv #</th>
                        <th rowspan="2" style="width: 110px;">Date</th>
                        <th rowspan="2">Customer</th>
                        
                        <!-- Filled Cylinders Group -->
                        <th colspan="4" class="text-center th-filled-group">
                            <i class="fas fa-burn me-1"></i> Filled Cylinders Sold (Refill)
                        </th>

                        <!-- New Cylinders Group -->
                        <th colspan="4" class="text-center th-new-group">
                            <i class="fas fa-shield-alt me-1"></i> New Cylinders Sold (New)
                        </th>

                        <th rowspan="2" class="text-center" style="width: 90px;">Total Qty</th>
                        <th rowspan="2" class="text-end" style="width: 130px;">Amount (OMR)</th>
                        <th rowspan="2" class="text-center" style="width: 80px;">Action</th>
                    </tr>
                    <tr>
                        <!-- Sub-headers for Filled -->
                        <th class="text-center th-sub-filled" style="width: 65px;">11kg</th>
                        <th class="text-center th-sub-filled" style="width: 65px;">22kg</th>
                        <th class="text-center th-sub-filled" style="width: 65px;">44kg</th>
                        <th class="text-center th-sub-filled font-weight-bold" style="width: 75px; background: #e0f2fe !important;">Total</th>

                        <!-- Sub-headers for New -->
                        <th class="text-center th-sub-new" style="width: 65px;">11kg</th>
                        <th class="text-center th-sub-new" style="width: 65px;">22kg</th>
                        <th class="text-center th-sub-new" style="width: 65px;">44kg</th>
                        <th class="text-center th-sub-new font-weight-bold" style="width: 75px; background: #dcfce7 !important;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $pageFilled11 = 0; $pageFilled22 = 0; $pageFilled44 = 0;
                        $pageNew11    = 0; $pageNew22    = 0; $pageNew44    = 0;
                        $pageGrandQty = 0; $pageGrandAmt = 0;
                    @endphp

                    @forelse($sales as $sale)
                        @php
                            $items = $sale->saleItems->groupBy('type');
                            $getQty = function($type) use ($items) {
                                return $items->has($type) ? (int) $items->get($type)->sum('quantity') : 0;
                            };

                            $f11 = $getQty('11kg_full');
                            $f22 = $getQty('22kg_full');
                            $f44 = $getQty('44kg_full');
                            $totalFilled = $f11 + $f22 + $f44;

                            $n11 = $getQty('11kg_empty');
                            $n22 = $getQty('22kg_empty');
                            $n44 = $getQty('44kg_empty');
                            $totalNew = $n11 + $n22 + $n44;

                            $rowTotalQty = $totalFilled + $totalNew;

                            $pageFilled11 += $f11; $pageFilled22 += $f22; $pageFilled44 += $f44;
                            $pageNew11    += $n11; $pageNew22    += $n22; $pageNew44    += $n44;
                            $pageGrandQty += $rowTotalQty;
                            $pageGrandAmt += $sale->total_amount;
                        @endphp
                        <tr>
                            <!-- Inv # -->
                            <td class="text-center font-weight-bold text-primary">
                                #{{ $sale->id }}
                            </td>

                            <!-- Date -->
                            <td style="white-space: nowrap;">
                                <i class="far fa-calendar text-muted me-1"></i>
                                {{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}
                            </td>

                            <!-- Customer -->
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width: 32px; height: 32px; border-radius: 8px; background: #f1f5f9; color: #475569; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 12px;">
                                        {{ strtoupper(substr($sale->customer->name ?? 'C', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-weight-bold" style="color: #0f172a; font-size: 13.5px;">
                                            {{ $sale->customer->name ?? 'Walk-in Customer' }}
                                        </div>
                                        @if(optional($sale->customer)->mobile)
                                            <small class="text-muted"><i class="fas fa-phone-alt me-1" style="font-size: 10px;"></i>{{ $sale->customer->mobile }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Filled 11kg -->
                            <td class="text-center">
                                @if($f11 > 0)
                                    <span class="qty-badge qty-filled">{{ $f11 }}</span>
                                @else
                                    <span class="qty-zero">-</span>
                                @endif
                            </td>

                            <!-- Filled 22kg -->
                            <td class="text-center">
                                @if($f22 > 0)
                                    <span class="qty-badge qty-filled">{{ $f22 }}</span>
                                @else
                                    <span class="qty-zero">-</span>
                                @endif
                            </td>

                            <!-- Filled 44kg -->
                            <td class="text-center">
                                @if($f44 > 0)
                                    <span class="qty-badge qty-filled">{{ $f44 }}</span>
                                @else
                                    <span class="qty-zero">-</span>
                                @endif
                            </td>

                            <!-- Total Filled -->
                            <td class="text-center font-weight-bold" style="background: #f0f7ff;">
                                @if($totalFilled > 0)
                                    <span class="qty-badge" style="background: #bfdbfe; color: #1e3a8a;">{{ $totalFilled }}</span>
                                @else
                                    <span class="qty-zero">0</span>
                                @endif
                            </td>

                            <!-- New 11kg -->
                            <td class="text-center">
                                @if($n11 > 0)
                                    <span class="qty-badge qty-new">{{ $n11 }}</span>
                                @else
                                    <span class="qty-zero">-</span>
                                @endif
                            </td>

                            <!-- New 22kg -->
                            <td class="text-center">
                                @if($n22 > 0)
                                    <span class="qty-badge qty-new">{{ $n22 }}</span>
                                @else
                                    <span class="qty-zero">-</span>
                                @endif
                            </td>

                            <!-- New 44kg -->
                            <td class="text-center">
                                @if($n44 > 0)
                                    <span class="qty-badge qty-new">{{ $n44 }}</span>
                                @else
                                    <span class="qty-zero">-</span>
                                @endif
                            </td>

                            <!-- Total New -->
                            <td class="text-center font-weight-bold" style="background: #f0fdf4;">
                                @if($totalNew > 0)
                                    <span class="qty-badge" style="background: #bbf7d0; color: #14532d;">{{ $totalNew }}</span>
                                @else
                                    <span class="qty-zero">0</span>
                                @endif
                            </td>

                            <!-- Total Qty -->
                            <td class="text-center">
                                <span class="qty-badge qty-total">{{ $rowTotalQty }}</span>
                            </td>

                            <!-- Amount -->
                            <td class="text-end font-weight-bold text-dark" style="font-size: 14px;">
                                {{ number_format($sale->total_amount, 2) }}
                            </td>

                            <!-- Action -->
                            <td class="text-center">
                                <a href="{{ route('sales.downloadPdf', $sale->id) }}" 
                                   class="btn btn-sm btn-outline-danger" 
                                   style="border-radius: 8px; padding: 4px 8px; font-size: 12px;"
                                   title="Download Invoice PDF">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="text-center py-5">
                                <div class="py-4">
                                    <div style="width: 64px; height: 64px; border-radius: 50%; background: #f1f5f9; color: #94a3b8; display: inline-flex; align-items: center; justify-content: center; font-size: 28px; margin-bottom: 12px;">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <h5 class="text-dark font-weight-bold mb-1">No Sales Records Found</h5>
                                    <p class="text-muted small mb-3">No sales match the selected customer and date range.</p>
                                    <a href="{{ route('customer_reports.index') }}" class="btn btn-sm btn-primary rounded-pill px-3">
                                        Reset Filters
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                @if($sales->count() > 0)
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-center text-uppercase">
                            Filtered Totals (Overall)
                        </td>
                        <!-- Filled Totals -->
                        <td class="text-center" style="color: #1e40af;">{{ $stats['filled_11kg'] }}</td>
                        <td class="text-center" style="color: #1e40af;">{{ $stats['filled_22kg'] }}</td>
                        <td class="text-center" style="color: #1e40af;">{{ $stats['filled_44kg'] }}</td>
                        <td class="text-center" style="background: #e0f2fe; color: #1e3a8a;">{{ $stats['total_filled'] }}</td>

                        <!-- New Totals -->
                        <td class="text-center" style="color: #166534;">{{ $stats['new_11kg'] }}</td>
                        <td class="text-center" style="color: #166534;">{{ $stats['new_22kg'] }}</td>
                        <td class="text-center" style="color: #166534;">{{ $stats['new_44kg'] }}</td>
                        <td class="text-center" style="background: #dcfce7; color: #14532d;">{{ $stats['total_new'] }}</td>

                        <!-- Grand Total Qty -->
                        <td class="text-center" style="background: #ede9fe; color: #6d28d9;">
                            {{ $stats['total_cylinders'] }}
                        </td>

                        <!-- Grand Total Revenue -->
                        <td class="text-end" style="color: #0f172a; font-size: 15px;">
                            {{ number_format($stats['total_revenue'], 2) }}
                        </td>

                        <td></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>

        @if($sales->hasPages())
        <div class="pagination-wrap">
            {{ $sales->links() }}
        </div>
        @endif
    </div>

</div>
@endsection

