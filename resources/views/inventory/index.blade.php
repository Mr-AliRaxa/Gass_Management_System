@extends('layouts.app')

@push('styles')
<style>
    /* ── Page background ── */
    .inventory-page { background: #f0f4ff; min-height: 100vh; padding: 24px; }

    /* ── Header ── */
    .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; flex-wrap: wrap; gap: 12px; }
    .page-header-left { display: flex; align-items: center; gap: 16px; }
    .page-header-icon {
        width: 56px; height: 56px; border-radius: 14px;
        background: linear-gradient(135deg, #4e7fff 0%, #2563eb 100%);
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 14px rgba(78,127,255,.35);
    }
    .page-header-icon i { color: #fff; font-size: 22px; }
    .page-title { font-size: 26px; font-weight: 800; color: #1a1f36; margin: 0; }
    .page-subtitle { font-size: 13px; color: #8898aa; margin: 0; }
    .header-right { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }

    /* Search bar */
    .search-wrapper { position: relative; }
    .search-wrapper i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #aab0c0; font-size: 14px; }
    .search-input {
        border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 10px 16px 10px 38px;
        font-size: 14px; background: #fff; width: 220px; color: #3d4467;
        transition: border-color .2s, box-shadow .2s;
    }
    .search-input:focus { border-color: #4e7fff; box-shadow: 0 0 0 3px rgba(78,127,255,.15); outline: none; }

    .btn-pdf {
        border: 1.5px solid #cbd5e1; border-radius: 12px; background: #fff;
        color: #dc2626; font-size: 14px; font-weight: 600; padding: 10px 18px;
        display: flex; align-items: center; gap: 7px; cursor: pointer; transition: all .2s;
        text-decoration: none;
    }
    .btn-pdf:hover { background: #fef2f2; border-color: #fca5a5; color: #b91c1c; }

    .btn-filter-toggle {
        border: 1.5px solid #cbd5e1; border-radius: 12px; background: #fff;
        color: #475569; font-size: 14px; font-weight: 600; padding: 10px 16px;
        display: flex; align-items: center; gap: 7px; cursor: pointer; transition: all .2s;
    }
    .btn-filter-toggle:hover { background: #f8fafc; border-color: #94a3b8; }

    .btn-adjust-stock {
        background: linear-gradient(135deg, #4e7fff 0%, #2563eb 100%);
        color: #fff; border: none; border-radius: 12px; font-size: 14px; font-weight: 700;
        padding: 10px 22px; display: flex; align-items: center; gap: 8px;
        box-shadow: 0 4px 14px rgba(78,127,255,.35); transition: opacity .2s;
        text-decoration: none;
    }
    .btn-adjust-stock:hover { opacity: .88; color: #fff; }

    /* ── Stock Analytics KPI Cards (4 Cards) ── */
    .stat-cards-grid {
        display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;
    }
    @media (max-width: 992px) { .stat-cards-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 576px) { .stat-cards-grid { grid-template-columns: 1fr; } }

    .stat-kpi-card {
        border-radius: 18px; padding: 20px 22px; display: flex;
        align-items: center; justify-content: space-between; position: relative; overflow: hidden;
    }
    .stat-kpi-blue   { background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%); }
    .stat-kpi-green  { background: linear-gradient(135deg, #dcfce7 0%, #f0fdf4 100%); }
    .stat-kpi-purple { background: linear-gradient(135deg, #ede9fe 0%, #f5f3ff 100%); }
    .stat-kpi-orange { background: linear-gradient(135deg, #fef3c7 0%, #fffbeb 100%); }

    .stat-kpi-icon {
        width: 52px; height: 52px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;
    }
    .stat-kpi-icon-blue   { background: linear-gradient(135deg, #4e7fff, #2563eb); color: #fff; box-shadow: 0 4px 12px rgba(78,127,255,.35); }
    .stat-kpi-icon-green  { background: linear-gradient(135deg, #22c55e, #16a34a); color: #fff; box-shadow: 0 4px 12px rgba(34,197,94,.35); }
    .stat-kpi-icon-purple { background: linear-gradient(135deg, #a855f7, #7c3aed); color: #fff; box-shadow: 0 4px 12px rgba(168,85,247,.35); }
    .stat-kpi-icon-orange { background: linear-gradient(135deg, #f59e0b, #d97706); color: #fff; box-shadow: 0 4px 12px rgba(245,158,11,.35); }

    .stat-kpi-label { font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: .5px; }
    .stat-kpi-value { font-size: 28px; font-weight: 800; color: #1a1f36; line-height: 1.1; margin-top: 4px; }
    .stat-kpi-bg-icon { position: absolute; right: 18px; bottom: -4px; font-size: 54px; opacity: .12; }

    /* ── Stock Levels Cards (11kg, 22kg, 44kg) ── */
    .stock-cards-grid {
        display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px;
    }
    @media (max-width: 992px) { .stock-cards-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 600px) { .stock-cards-grid { grid-template-columns: 1fr; } }

    .stock-card {
        border-radius: 18px; padding: 20px 22px; display: flex;
        align-items: center; justify-content: space-between; position: relative; overflow: hidden;
        background: #ffffff; border: 1.5px solid #edf2f7; box-shadow: 0 2px 14px rgba(30,41,59,.04);
    }
    .stock-card-left { display: flex; flex-direction: column; }
    .stock-size-title { font-size: 16px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 8px; }
    .stock-balance-val { font-size: 32px; font-weight: 800; color: #1e293b; margin: 4px 0 2px; }
    .stock-status-pill {
        display: inline-flex; align-items: center; gap: 4px;
        font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 12px; width: fit-content;
    }
    .pill-healthy { background: #dcfce7; color: #15803d; }
    .pill-low { background: #fee2e2; color: #b91c1c; }

    /* ── Monthly Insights Card ── */
    .monthly-insights-card {
        background: #ffffff; border-radius: 20px; box-shadow: 0 2px 20px rgba(30,41,59,.06);
        border: 1.5px solid #edf2f7; margin-bottom: 24px; overflow: hidden;
    }
    .monthly-insights-header {
        padding: 18px 24px; border-bottom: 1.5px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;
    }
    .monthly-insights-title { font-size: 16px; font-weight: 700; color: #1e293b; display: flex; align-items: center; gap: 8px; }

    .monthly-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    .monthly-table th { background: #f8fafc; padding: 12px 20px; font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; border-bottom: 1.5px solid #f1f5f9; }
    .monthly-table td { padding: 14px 20px; font-size: 13px; color: #334155; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .monthly-table tr:last-child td { border-bottom: none; }

    /* ── Collapsible Filter Box ── */
    .filter-card {
        background: #fff; border-radius: 18px; box-shadow: 0 2px 14px rgba(30,41,59,.05);
        padding: 20px 24px; margin-bottom: 24px; border: 1.5px solid #edf2f7;
    }
    .filter-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
    .filter-title { font-size: 15px; font-weight: 700; color: #334155; display: flex; align-items: center; gap: 8px; }
    .filter-label { font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px; }
    .filter-control {
        border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 8px 12px;
        font-size: 13px; color: #334155; width: 100%; transition: all .2s;
    }
    .filter-control:focus { border-color: #4e7fff; outline: none; box-shadow: 0 0 0 3px rgba(78,127,255,.1); }

    /* ── Main Table Card ── */
    .table-card { background: #fff; border-radius: 20px; box-shadow: 0 2px 20px rgba(30,41,59,.07); overflow: hidden; }
    .table-card-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 20px 26px 16px; border-bottom: 1.5px solid #f1f5f9; flex-wrap: wrap; gap: 10px;
    }
    .table-card-title { display: flex; align-items: center; gap: 12px; }
    .table-card-title i { color: #4e7fff; font-size: 20px; }
    .table-card-title span { font-size: 18px; font-weight: 700; color: #1a1f36; }
    .showing-text { font-size: 13px; color: #94a3b8; }

    /* ── Modern Inventory Sub-Tabs ── */
    .inv-tab-pill-box {
        background: #f1f5f9;
        border-radius: 12px;
        padding: 4px;
        display: inline-flex;
        gap: 4px;
        flex-wrap: wrap;
    }
    .inv-tab-pill-btn {
        border-radius: 9px !important;
        padding: 7px 16px !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        color: #64748b !important;
        border: none !important;
        background: transparent !important;
        transition: all 0.2s ease !important;
        text-decoration: none !important;
    }
    .inv-tab-pill-btn:hover {
        color: #0f172a !important;
    }
    .inv-tab-pill-btn.active {
        background: #ffffff !important;
        color: #2563eb !important;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08) !important;
    }
    .btn-pdf-sub {
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        padding: 6px 14px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }
    .btn-pdf-sub:hover {
        transform: translateY(-1px);
        opacity: 0.9;
    }

    /* ── Table Styling ── */
    .cust-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    .cust-table thead tr { background: #f8fafc; }
    .cust-table thead th {
        padding: 13px 18px; font-size: 12px; font-weight: 700; color: #64748b;
        text-transform: uppercase; letter-spacing: .5px; border-bottom: 1.5px solid #f1f5f9;
    }
    .cust-table tbody tr { transition: background .15s; }
    .cust-table tbody tr:hover { background: #f8fafc; }
    .cust-table tbody td { padding: 14px 18px; font-size: 13px; color: #334155; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .cust-table tbody tr:last-child td { border-bottom: none; }

    /* Badges */
    .date-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: #f8fafc; color: #475569; border-radius: 10px;
        padding: 5px 11px; font-size: 12px; font-weight: 600; border: 1px solid #e2e8f0;
    }
    .type-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: #eff6ff; color: #2563eb; border-radius: 20px;
        padding: 5px 12px; font-size: 12px; font-weight: 700;
    }
    .qty-change-pill {
        display: inline-flex; align-items: center; gap: 4px;
        border-radius: 20px; padding: 4px 10px; font-size: 12px; font-weight: 800;
    }
    .qty-positive { background: #dcfce7; color: #15803d; }
    .qty-negative { background: #fee2e2; color: #dc2626; }

    .price-pill {
        display: inline-flex; align-items: center; gap: 4px;
        background: #f1f5f9; color: #334155; border-radius: 12px;
        padding: 4px 10px; font-size: 12px; font-weight: 700;
    }
    .total-cost-pill {
        display: inline-flex; align-items: center; gap: 4px;
        background: #ecfdf5; color: #047857; border-radius: 20px;
        padding: 5px 12px; font-size: 13px; font-weight: 800;
    }

    /* Action buttons */
    .action-wrap { display: flex; gap: 6px; }
    .act-btn { width: 34px; height: 34px; border-radius: 9px; border: none; display: flex; align-items: center; justify-content: center; font-size: 13px; cursor: pointer; transition: opacity .2s; text-decoration: none; }
    .act-btn:hover { opacity: .82; }
    .act-btn-edit  { background: #e0f2fe; color: #0284c7; }
    .act-btn-del   { background: #fee2e2; color: #dc2626; }

    /* Empty state */
    .empty-state { padding: 60px 20px; text-align: center; color: #94a3b8; }
    .empty-state i { font-size: 48px; margin-bottom: 14px; display: block; }
    .empty-state p { font-size: 15px; }

    /* Pagination */
    .pagination-wrap { padding: 16px 26px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; border-top: 1.5px solid #f1f5f9; }
    .pagination-wrap .pagination { margin: 0; }
</style>
@endpush

@section('content')
<div class="inventory-page">

    {{-- ── Header ── --}}
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-header-icon">
                <i class="fas fa-boxes"></i>
            </div>
            <div>
                <h1 class="page-title">{{ __('messages.cylinder_inv_mgmt') }}</h1>
                <p class="page-subtitle">{{ __('messages.cylinder_inv_subtitle') }}</p>
            </div>
        </div>
        <div class="header-right">
            {{-- Live Search --}}
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="liveSearch" class="search-input"
                       placeholder="{{ __('messages.search_records') }}" autocomplete="off">
                <span id="searchClearBtn" style="display:none;position:absolute;right:12px;top:50%;transform:translateY(-50%);cursor:pointer;color:#94a3b8;font-size:13px;" onclick="clearSearch()">
                    <i class="fas fa-times"></i>
                </span>
            </div>

            {{-- Comprehensive PDF Export Dropdown --}}
            <div class="dropdown">
                <button class="btn-pdf dropdown-toggle" type="button" id="invPdfDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-file-pdf"></i> {{ __('messages.download_pdf_reports') }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="invPdfDropdown" style="border-radius: 14px; padding: 8px; min-width: 250px;">
                    <li>
                        <a class="dropdown-item py-2 px-3 fw-bold" href="{{ route('inventory.downloadPdf', array_merge(request()->all(), ['report_type' => 'all'])) }}">
                            <i class="fas fa-file-invoice text-primary me-2"></i> {{ __('messages.complete_inv_report_pdf') }}
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2 px-3 fw-bold" href="{{ route('inventory.downloadPdf', array_merge(request()->all(), ['report_type' => 'purchases'])) }}">
                            <i class="fas fa-arrow-down text-success me-2"></i> {{ __('messages.purchases_only_report_pdf') }}
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2 px-3 fw-bold" href="{{ route('inventory.downloadPdf', array_merge(request()->all(), ['report_type' => 'sales'])) }}">
                            <i class="fas fa-arrow-up text-danger me-2"></i> {{ __('messages.sales_only_report_pdf') }}
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Filter Toggle Button --}}
            <button class="btn-filter-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#filterBox" aria-expanded="false">
                <i class="fas fa-filter"></i> {{ __('messages.filters') }}
            </button>

            {{-- Buy / Adjust Stock Button --}}
            @can('inventory-create')
            <a href="{{ route('inventory.create') }}" class="btn-adjust-stock">
                <i class="fas fa-plus"></i> {{ __('messages.buy_add_cylinders') }}
            </a>
            @endcan
        </div>
    </div>

    {{-- ── Flash Messages ── --}}
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- ── 1. Top High-Level Analytics KPI Cards (4 Cards) ── --}}
    <div class="stat-cards-grid">
        {{-- Total Purchased Cylinders --}}
        <div class="stat-kpi-card stat-kpi-blue">
            <div>
                <div class="stat-kpi-label">{{ __('messages.total_purchased_in') }}</div>
                <div class="stat-kpi-value">{{ number_format($totalPurchasedQty) }} <span style="font-size:13px;font-weight:600;">{{ __('messages.units') }}</span></div>
            </div>
            <div class="stat-kpi-icon stat-kpi-icon-blue"><i class="fas fa-arrow-down"></i></div>
            <i class="fas fa-dolly stat-kpi-bg-icon text-primary"></i>
        </div>

        {{-- Total Purchase Investment / Cost --}}
        <div class="stat-kpi-card stat-kpi-green">
            <div>
                <div class="stat-kpi-label">{{ __('messages.purchase_investment') }}</div>
                <div class="stat-kpi-value">{{ number_format($totalPurchaseCost, 3) }} <span style="font-size:13px;font-weight:600;">{{ __('messages.omr') }}</span></div>
            </div>
            <div class="stat-kpi-icon stat-kpi-icon-green"><i class="fas fa-money-bill-wave"></i></div>
            <i class="fas fa-coins stat-kpi-bg-icon text-success"></i>
        </div>

        {{-- Total Cylinders Sold --}}
        <div class="stat-kpi-card stat-kpi-orange">
            <div>
                <div class="stat-kpi-label">{{ __('messages.total_cylinders_sold_out') }}</div>
                <div class="stat-kpi-value">{{ number_format($totalSoldCylinders) }} <span style="font-size:13px;font-weight:600;">{{ __('messages.units') }}</span></div>
            </div>
            <div class="stat-kpi-icon stat-kpi-icon-orange"><i class="fas fa-arrow-up"></i></div>
            <i class="fas fa-shopping-cart stat-kpi-bg-icon text-warning"></i>
        </div>

        {{-- Current Net Balance Available --}}
        @php
            $currentNetStock = ($stocks['11kg_empty'] ?? 0) + ($stocks['22kg_empty'] ?? 0) + ($stocks['44kg_empty'] ?? 0);
        @endphp
        <div class="stat-kpi-card stat-kpi-purple">
            <div>
                <div class="stat-kpi-label">{{ __('messages.available_in_stock_net') }}</div>
                <div class="stat-kpi-value">{{ number_format($currentNetStock) }} <span style="font-size:13px;font-weight:600;">{{ __('messages.units') }}</span></div>
            </div>
            <div class="stat-kpi-icon stat-kpi-icon-purple"><i class="fas fa-cubes"></i></div>
            <i class="fas fa-warehouse stat-kpi-bg-icon text-info"></i>
        </div>
    </div>

    {{-- ── 2. Detailed Purchase vs Sale Breakdown by Cylinder Size (11kg, 22kg, 44kg) ── --}}
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h5 class="font-weight-bold text-gray-800 m-0" style="font-size: 18px;">
                <i class="fas fa-balance-scale text-primary me-2"></i> {{ __('messages.cylinder_comparison_title') }}
            </h5>
            <small class="text-muted">{{ __('messages.cylinder_comparison_subtitle') }}</small>
        </div>
    </div>

    @php
        $sizeThemes = [
            '11kg' => ['color' => '#2563eb', 'bg' => '#eff6ff', 'border' => '#bfdbfe', 'icon' => 'fa-gas-pump'],
            '22kg' => ['color' => '#16a34a', 'bg' => '#f0fdf4', 'border' => '#bbf7d0', 'icon' => 'fa-fill-drip'],
            '44kg' => ['color' => '#d97706', 'bg' => '#fffbeb', 'border' => '#fde68a', 'icon' => 'fa-fire'],
        ];
    @endphp

    <div class="row g-4 mb-4">
        @foreach($cylinderSizeDetails as $sizeKey => $item)
        @php
            $theme = $sizeThemes[$sizeKey] ?? ['color' => '#2563eb', 'bg' => '#eff6ff', 'border' => '#bfdbfe', 'icon' => 'fa-gas-pump'];
            $cylinderLocalizedName = match($sizeKey) {
                '11kg' => __('messages.cylinder_11kg'),
                '22kg' => __('messages.cylinder_22kg'),
                '44kg' => __('messages.cylinder_44kg'),
                default => $item['name']
            };
        @endphp
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm" style="border-radius: 20px; border: 1.5px solid {{ $theme['border'] }}; overflow: hidden; background: #ffffff;">
                
                {{-- Card Header --}}
                <div style="background: {{ $theme['bg'] }}; padding: 16px 20px; border-bottom: 1px solid {{ $theme['border'] }}; display: flex; align-items: center; justify-content: space-between;">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 42px; height: 42px; border-radius: 12px; background: {{ $theme['color'] }}; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                            <i class="fas {{ $theme['icon'] }}"></i>
                        </div>
                        <div>
                            <h5 class="m-0 font-weight-bold" style="color: #1e293b; font-size: 17px;">{{ $cylinderLocalizedName }}</h5>
                            <small style="color: {{ $theme['color'] }}; font-weight: 700;">{{ __('messages.new_pole_cylinder') }}</small>
                        </div>
                    </div>
                    <div>
                        @if($item['remaining'] <= 5)
                            <span class="stock-status-pill pill-low"><i class="fas fa-exclamation-triangle"></i> {{ __('messages.low_stock') }} ({{ $item['remaining'] }})</span>
                        @else
                            <span class="stock-status-pill pill-healthy"><i class="fas fa-check-circle"></i> {{ __('messages.stock_count', ['count' => $item['remaining']]) }}</span>
                        @endif
                    </div>
                </div>

                {{-- Card Body --}}
                <div class="card-body p-3">
                    
                    {{-- Purchase Info Box --}}
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 14px; margin-bottom: 12px;">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span style="font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.5px;">
                                <i class="fas fa-cart-arrow-down text-primary me-1"></i> {{ __('messages.purchase_buy_details') }}
                            </span>
                            <span class="badge" style="background: #e2e8f0; color: #334155; font-size: 11px;">{{ __('messages.stock_in') }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-muted" style="font-size: 13px;">{{ __('messages.total_bought_qty') }}:</span>
                            <strong style="font-size: 14px; color: #1e293b;">{{ number_format($item['purchased_qty']) }} {{ __('messages.units') }}</strong>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-muted" style="font-size: 13px;">{{ __('messages.buy_unit_price') }}:</span>
                            <strong style="font-size: 14px; color: #2563eb;">{{ number_format($item['purchase_price'], 3) }} {{ __('messages.omr') }}</strong>
                        </div>
                        <div class="d-flex align-items-center justify-content-between pt-1" style="border-top: 1px dashed #cbd5e1;">
                            <span class="text-muted" style="font-size: 13px; font-weight: 600;">{{ __('messages.total_purchase_cost') }}:</span>
                            <strong style="font-size: 15px; color: #0f172a;">{{ number_format($item['total_purchase_cost'], 3) }} {{ __('messages.omr') }}</strong>
                        </div>
                    </div>

                    {{-- Sale Info Box --}}
                    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 14px; padding: 14px; margin-bottom: 12px;">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span style="font-size: 11px; font-weight: 800; color: #15803d; text-transform: uppercase; letter-spacing: 0.5px;">
                                <i class="fas fa-hand-holding-usd me-1"></i> {{ __('messages.sale_details_new') }}
                            </span>
                            <span class="badge" style="background: #dcfce7; color: #166534; font-size: 11px;">{{ __('messages.sold_out') }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-muted" style="font-size: 13px;">{{ __('messages.total_sold_qty') }}:</span>
                            <strong style="font-size: 14px; color: #1e293b;">{{ number_format($item['sold_qty']) }} {{ __('messages.units') }}</strong>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-muted" style="font-size: 13px;">{{ __('messages.sale_unit_price') }}:</span>
                            <strong style="font-size: 14px; color: #16a34a;">{{ number_format($item['sale_price'], 3) }} {{ __('messages.omr') }}</strong>
                        </div>
                        <div class="d-flex align-items-center justify-content-between pt-1" style="border-top: 1px dashed #86efac;">
                            <span class="text-muted" style="font-size: 13px; font-weight: 600;">{{ __('messages.total_sale_revenue') }}:</span>
                            <strong style="font-size: 15px; color: #15803d;">{{ number_format($item['total_sale_revenue'], 3) }} {{ __('messages.omr') }}</strong>
                        </div>
                    </div>

                    {{-- Profit / Margin Summary Footer --}}
                    <div style="background: #fefce8; border: 1px solid #fef08a; border-radius: 14px; padding: 12px 14px; display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <span style="font-size: 12px; font-weight: 700; color: #854d0e;">{{ __('messages.est_gross_profit') }}:</span>
                            <div style="font-size: 11px; color: #a16207;">{{ __('messages.revenue_minus_cost') }}</div>
                        </div>
                        <div style="font-size: 17px; font-weight: 800; color: {{ $item['estimated_profit'] >= 0 ? '#15803d' : '#dc2626' }};">
                            {{ $item['estimated_profit'] >= 0 ? '+' : '' }}{{ number_format($item['estimated_profit'], 3) }} {{ __('messages.omr') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ── 3. Monthly Stock In/Out Tracking (Kis month mein kitna buy hua / kitna sale hua) ── --}}
    <div class="monthly-insights-card">
        <div class="monthly-insights-header">
            <div>
                <span class="monthly-insights-title">
                    <i class="fas fa-chart-bar text-primary"></i> {{ __('messages.monthly_movement_title') }}
                </span>
                <small class="text-muted">{{ __('messages.monthly_movement_desc') }}</small>
            </div>
            <!-- Sub-tabs for Purchases / Sales -->
            <div class="inv-tab-pill-box">
                <button type="button" class="inv-tab-pill-btn active" onclick="switchMonthlyTab('purchases', this)">
                    <i class="fas fa-arrow-down text-success me-1"></i> {{ __('messages.purchases_stock_in') }}
                </button>
                <button type="button" class="inv-tab-pill-btn" onclick="switchMonthlyTab('sales', this)">
                    <i class="fas fa-arrow-up text-danger me-1"></i> {{ __('messages.sales_stock_out') }}
                </button>
            </div>
        </div>

        <!-- Monthly Purchases Sub-Tab -->
        <div id="monthlyPurchasesTab" style="overflow-x: auto;">
            <table class="monthly-table">
                <thead>
                    <tr>
                        <th>{{ __('messages.month_and_year') }}</th>
                        <th>{{ __('messages.bought_11kg') }}</th>
                        <th>{{ __('messages.bought_22kg') }}</th>
                        <th>{{ __('messages.bought_44kg') }}</th>
                        <th>{{ __('messages.total_units_in') }}</th>
                        <th>{{ __('messages.purchase_cost_investment') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($monthsBreakdown as $m)
                    <tr>
                        <td><strong>{{ $m['month'] }}</strong></td>
                        <td>
                            @if(($m['bought_11kg'] ?? 0) > 0)
                                <span class="badge" style="background:#eff6ff; color:#1d4ed8; font-size:12px; padding:4px 9px; border-radius:10px;">+{{ $m['bought_11kg'] }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if(($m['bought_22kg'] ?? 0) > 0)
                                <span class="badge" style="background:#f0fdf4; color:#15803d; font-size:12px; padding:4px 9px; border-radius:10px;">+{{ $m['bought_22kg'] }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if(($m['bought_44kg'] ?? 0) > 0)
                                <span class="badge" style="background:#fffbeb; color:#b45309; font-size:12px; padding:4px 9px; border-radius:10px;">+{{ $m['bought_44kg'] }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if(($m['bought_qty'] ?? 0) > 0)
                                <span class="badge" style="background:#dcfce7; color:#15803d; font-size:12px; padding:5px 11px; border-radius:12px; font-weight:800;">
                                    <i class="fas fa-arrow-down me-1"></i> +{{ $m['bought_qty'] }} {{ __('messages.units') }}
                                </span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if(($m['bought_cost'] ?? 0) > 0)
                                <strong style="color: #047857; font-size:14px;">{{ number_format($m['bought_cost'], 3) }} {{ __('messages.omr') }}</strong>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Monthly Sales Sub-Tab -->
        <div id="monthlySalesTab" style="overflow-x: auto; display: none;">
            <table class="monthly-table">
                <thead>
                    <tr>
                        <th>{{ __('messages.month_and_year') }}</th>
                        <th>{{ __('messages.sold_11kg') }}</th>
                        <th>{{ __('messages.sold_22kg') }}</th>
                        <th>{{ __('messages.sold_44kg') }}</th>
                        <th>{{ __('messages.total_units_sold') }}</th>
                        <th>{{ __('messages.sales_revenue') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($monthsBreakdown as $m)
                    <tr>
                        <td><strong>{{ $m['month'] }}</strong></td>
                        <td>
                            @if(($m['sold_11kg'] ?? 0) > 0)
                                <span class="badge" style="background:#eff6ff; color:#1d4ed8; font-size:12px; padding:4px 9px; border-radius:10px;">{{ $m['sold_11kg'] }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if(($m['sold_22kg'] ?? 0) > 0)
                                <span class="badge" style="background:#f0fdf4; color:#15803d; font-size:12px; padding:4px 9px; border-radius:10px;">{{ $m['sold_22kg'] }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if(($m['sold_44kg'] ?? 0) > 0)
                                <span class="badge" style="background:#fffbeb; color:#b45309; font-size:12px; padding:4px 9px; border-radius:10px;">{{ $m['sold_44kg'] }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if(($m['sold_qty'] ?? 0) > 0)
                                <span class="badge" style="background:#fee2e2; color:#b91c1c; font-size:12px; padding:5px 11px; border-radius:12px; font-weight:800;">
                                    <i class="fas fa-arrow-up me-1"></i> {{ $m['sold_qty'] }} {{ __('messages.sold') }}
                                </span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if(($m['sold_revenue'] ?? 0) > 0)
                                <strong style="color: #15803d; font-size:14px;">{{ number_format($m['sold_revenue'], 3) }} {{ __('messages.omr') }}</strong>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- ── 4. Collapsible Filter Form ── --}}
    <div class="collapse {{ (request('type') || request('action') || request('from_date') || request('to_date')) ? 'show' : '' }}" id="filterBox">
        <div class="filter-card">
            <div class="filter-header">
                <span class="filter-title"><i class="fas fa-sliders-h text-primary"></i> {{ __('messages.filter_stock_history') }}</span>
                @if(request('type') || request('action') || request('from_date') || request('to_date'))
                <a href="{{ route('inventory.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">{{ __('messages.clear_filters') }}</a>
                @endif
            </div>
            <form action="{{ route('inventory.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="filter-label">{{ __('messages.cylinder_type') }}</div>
                        <select name="type" class="filter-control">
                            <option value="">{{ __('messages.all_cylinder_types') }}</option>
                            <option value="11kg_empty" {{ request('type') == '11kg_empty' ? 'selected' : '' }}>{{ __('messages.cylinder_11kg') }}</option>
                            <option value="22kg_empty" {{ request('type') == '22kg_empty' ? 'selected' : '' }}>{{ __('messages.cylinder_22kg') }}</option>
                            <option value="44kg_empty" {{ request('type') == '44kg_empty' ? 'selected' : '' }}>{{ __('messages.cylinder_44kg') }}</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="filter-label">{{ __('messages.action_entry_type') }}</div>
                        <select name="action" class="filter-control">
                            <option value="">{{ __('messages.all_actions') }}</option>
                            <option value="purchase" {{ request('action') == 'purchase' ? 'selected' : '' }}>{{ __('messages.purchases_stock_in') }}</option>
                            <option value="sale_deduction" {{ request('action') == 'sale_deduction' ? 'selected' : '' }}>{{ __('messages.sales_out') }}</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="filter-label">{{ __('messages.from_date') }}</div>
                        <input type="date" name="from_date" class="filter-control" value="{{ request('from_date') }}">
                    </div>
                    <div class="col-md-2">
                        <div class="filter-label">{{ __('messages.to_date') }}</div>
                        <input type="date" name="to_date" class="filter-control" value="{{ request('to_date') }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100 rounded-3 font-weight-bold" style="padding:8px 16px;">
                            <i class="fas fa-search me-1"></i> {{ __('messages.apply_filters') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- ── 5. Detailed Separate Logs (Purchases Log & Sales Log) ── --}}
    
    {{-- (A) Purchases & Stock In Log Card --}}
    <div class="table-card mb-4" id="purchases-log-card">
        <div class="table-card-header" style="background: #f8fafc;">
            <div class="table-card-title">
                <div style="width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #22c55e, #16a34a); display: flex; align-items: center; justify-content: center; color: #fff; box-shadow: 0 4px 10px rgba(34,197,94,.25);">
                    <i class="fas fa-cart-arrow-down" style="font-size: 16px; color: #fff;"></i>
                </div>
                <div>
                    <span style="font-size: 17px; font-weight: 800; color: #1e293b;">{{ __('messages.purchases_log_title') }}</span>
                    <span class="badge ms-2" style="background: #dcfce7; color: #15803d; font-size: 12px; font-weight: 700; border-radius: 12px; padding: 4px 10px;">
                        {{ $purchasesList->total() }} {{ __('messages.records') }}
                    </span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('inventory.downloadPdf', array_merge(request()->all(), ['report_type' => 'purchases'])) }}" 
                   class="btn-pdf-sub shadow-sm" 
                   style="background: #15803d; color: #fff; border: none; padding: 7px 14px; border-radius: 10px;">
                    <i class="fas fa-file-pdf"></i> {{ __('messages.purchases_pdf') }}
                </a>
                <span class="showing-text" style="font-size: 12px;">
                    {{ __('messages.showing') }} {{ $purchasesList->firstItem() ?? 0 }}–{{ $purchasesList->lastItem() ?? 0 }} {{ __('messages.of') }} {{ $purchasesList->total() ?? 0 }}
                </span>
            </div>
        </div>

        <div style="overflow-x:auto;">
            <table class="cust-table">
                <thead>
                    <tr>
                        <th>{{ __('messages.date') }}</th>
                        <th>{{ __('messages.cylinder_type') }}</th>
                        <th>{{ __('messages.qty_purchased') }}</th>
                        <th>{{ __('messages.buy_unit_price') }}</th>
                        <th>{{ __('messages.total_buy_cost') }}</th>
                        <th>{{ __('messages.supplier_details') }}</th>
                        <th>{{ __('messages.action11') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($purchasesList as $item)
                    @php
                        $typeNamesMap = [
                            '11kg_empty' => __('messages.cylinder_11kg_new'),
                            '22kg_empty' => __('messages.cylinder_22kg_new'),
                            '44kg_empty' => __('messages.cylinder_44kg_new'),
                            '11kg_full' => __('messages.cylinder_11kg'),
                            '22kg_full' => __('messages.cylinder_22kg'),
                            '44kg_full' => __('messages.cylinder_44kg'),
                        ];
                        $typeName = $typeNamesMap[$item->type] ?? str_replace(['_empty', '_'], [' ' . __('messages.new_cylinder'), ' '], ucfirst($item->type));
                        $displayDate = $item->transaction_date ? \Carbon\Carbon::parse($item->transaction_date)->format('d M Y') : $item->created_at->format('d M Y');
                    @endphp
                    <tr class="history-row" data-search="{{ strtolower($displayDate . ' ' . $typeName . ' ' . $item->quantity . ' ' . ($item->supplier_name ?? '') . ' ' . ($item->note ?? '')) }}">
                        {{-- Date --}}
                        <td>
                            <span class="date-badge">
                                <i class="far fa-calendar-alt text-success"></i>
                                {{ $displayDate }}
                            </span>
                        </td>

                        {{-- Type --}}
                        <td>
                            <span class="type-badge" style="background: #f0fdf4; color: #16a34a;">
                                <i class="fas fa-gas-pump"></i> {{ $typeName }}
                            </span>
                        </td>

                        {{-- Qty Purchased --}}
                        <td>
                            <span class="qty-change-pill qty-positive">
                                <i class="fas fa-arrow-down"></i> +{{ $item->quantity }} {{ __('messages.units') }}
                            </span>
                        </td>

                        {{-- Buy Unit Price --}}
                        <td>
                            @if($item->unit_price > 0)
                                <span class="price-pill">
                                    <i class="fas fa-tag text-muted"></i> {{ number_format($item->unit_price, 3) }} {{ __('messages.omr') }}
                                </span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        {{-- Total Purchase Cost --}}
                        <td>
                            @if($item->total_cost > 0)
                                <span class="total-cost-pill">
                                    <i class="fas fa-coins"></i> {{ number_format($item->total_cost, 3) }} {{ __('messages.omr') }}
                                </span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        {{-- Supplier / Note --}}
                        <td>
                            <div>
                                @if($item->supplier_name)
                                    <div style="font-weight: 700; color: #1e293b; font-size: 13px;">
                                        <i class="fas fa-truck text-muted me-1"></i> {{ $item->supplier_name }}
                                    </div>
                                @endif
                                @if($item->note)
                                    <small class="text-muted"><i class="far fa-clipboard me-1"></i>{{ $item->note }}</small>
                                @elseif(!$item->supplier_name)
                                    <span class="text-muted">—</span>
                                @endif
                            </div>
                        </td>

                        {{-- Actions --}}
                        <td>
                            <div class="action-wrap">
                                @can('inventory-edit')
                                <a href="{{ route('inventory.edit', $item->id) }}" class="act-btn act-btn-edit" title="{{ __('messages.edit') }}">
                                    <i class="fas fa-pen"></i>
                                </a>
                                @endcan
                                @can('inventory-delete')
                                <button class="act-btn act-btn-del" title="{{ __('messages.delete') }}" onclick="confirmDelete('{{ route('inventory.destroy', $item->id) }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state" style="padding: 40px 20px;">
                                <i class="fas fa-box-open text-muted"></i>
                                <p class="mb-0">{{ __('messages.no_purchases_found') }}</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @if($purchasesList->count() > 0)
                <tfoot>
                    <tr style="background: #f8fafc; font-weight: 700;">
                        <td colspan="2" class="text-end" style="padding: 12px 18px; font-size: 13px; color: #475569;">
                            <strong>{{ __('messages.total_filtered') }}:</strong>
                        </td>
                        <td style="padding: 12px 18px;">
                            <span class="badge" style="background: #dcfce7; color: #15803d; font-size: 13px; padding: 5px 10px;">
                                +{{ number_format($totalPurchasedFilteredQty) }} {{ __('messages.units') }}
                            </span>
                        </td>
                        <td></td>
                        <td style="padding: 12px 18px;">
                            <strong style="color: #047857; font-size: 14px;">{{ number_format($totalPurchasedFilteredCost, 3) }} {{ __('messages.omr') }}</strong>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>

        <div class="pagination-wrap">
            {{ $purchasesList->appends(request()->query())->links() }}
        </div>
    </div>


    {{-- (B) New Cylinder Sales Log Card --}}
    <div class="table-card mb-4" id="sales-log-card">
        <div class="table-card-header" style="background: #fff5f5;">
            <div class="table-card-title">
                <div style="width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #ef4444, #dc2626); display: flex; align-items: center; justify-content: center; color: #fff; box-shadow: 0 4px 10px rgba(239,68,68,.25);">
                    <i class="fas fa-shopping-cart" style="font-size: 16px; color: #fff;"></i>
                </div>
                <div>
                    <span style="font-size: 17px; font-weight: 800; color: #1e293b;">{{ __('messages.sales_log_title') }}</span>
                    <span class="badge ms-2" style="background: #fee2e2; color: #dc2626; font-size: 12px; font-weight: 700; border-radius: 12px; padding: 4px 10px;">
                        {{ $salesList->total() }} {{ __('messages.records') }}
                    </span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('inventory.downloadPdf', array_merge(request()->all(), ['report_type' => 'sales'])) }}" 
                   class="btn-pdf-sub shadow-sm" 
                   style="background: #dc2626; color: #fff; border: none; padding: 7px 14px; border-radius: 10px;">
                    <i class="fas fa-file-pdf"></i> {{ __('messages.sales_pdf') }}
                </a>
                <span class="showing-text" style="font-size: 12px;">
                    {{ __('messages.showing') }} {{ $salesList->firstItem() ?? 0 }}–{{ $salesList->lastItem() ?? 0 }} {{ __('messages.of') }} {{ $salesList->total() ?? 0 }}
                </span>
            </div>
        </div>

        <div style="overflow-x:auto;">
            <table class="cust-table">
                <thead>
                    <tr>
                        <th>{{ __('messages.date') }}</th>
                        <th>{{ __('messages.cylinder_type') }}</th>
                        <th>{{ __('messages.qty_sold12') }}</th>
                        <th>{{ __('messages.sale_unit_price') }}</th>
                        <th>{{ __('messages.total_sale_revenue') }}</th>
                        <th>{{ __('messages.customer_name12') }}</th>
                        <th>{{ __('messages.sale_invoice_no') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($salesList as $saleItem)
                    @php
                        $typeNamesMap = [
                            '11kg_empty' => __('messages.cylinder_11kg_new'),
                            '22kg_empty' => __('messages.cylinder_22kg_new'),
                            '44kg_empty' => __('messages.cylinder_44kg_new'),
                            '11kg_full' => __('messages.cylinder_11kg'),
                            '22kg_full' => __('messages.cylinder_22kg'),
                            '44kg_full' => __('messages.cylinder_44kg'),
                        ];
                        $typeName = $typeNamesMap[$saleItem->type] ?? str_replace(['_empty', '_'], [' ' . __('messages.new_cylinder'), ' '], ucfirst($saleItem->type));
                        $saleDate = $saleItem->sale && $saleItem->sale->date ? \Carbon\Carbon::parse($saleItem->sale->date)->format('d M Y') : $saleItem->created_at->format('d M Y');
                        $custName = $saleItem->sale && $saleItem->sale->customer ? $saleItem->sale->customer->name : __('messages.walk_in_cash');
                        $invoiceNo = $saleItem->sale ? ($saleItem->sale->invoice_number ?? ('#' . $saleItem->sale_id)) : '—';
                        $itemTotal = $saleItem->quantity * $saleItem->price;
                    @endphp
                    <tr class="history-row" data-search="{{ strtolower($saleDate . ' ' . $typeName . ' ' . $saleItem->quantity . ' ' . $custName . ' ' . $invoiceNo) }}">
                        {{-- Date --}}
                        <td>
                            <span class="date-badge">
                                <i class="far fa-calendar-alt text-danger"></i>
                                {{ $saleDate }}
                            </span>
                        </td>

                        {{-- Type --}}
                        <td>
                            <span class="type-badge" style="background: #fef2f2; color: #dc2626;">
                                <i class="fas fa-fire"></i> {{ $typeName }}
                            </span>
                        </td>

                        {{-- Qty Sold --}}
                        <td>
                            <span class="qty-change-pill qty-negative">
                                <i class="fas fa-arrow-up"></i> {{ $saleItem->quantity }} {{ __('messages.sold') }}
                            </span>
                        </td>

                        {{-- Sale Unit Price --}}
                        <td>
                            <span class="price-pill">
                                <i class="fas fa-tag text-muted"></i> {{ number_format($saleItem->price, 3) }} {{ __('messages.omr') }}
                            </span>
                        </td>

                        {{-- Total Sale Revenue --}}
                        <td>
                            <span class="total-cost-pill" style="background: #fef2f2; color: #dc2626;">
                                <i class="fas fa-coins"></i> {{ number_format($itemTotal, 3) }} {{ __('messages.omr') }}
                            </span>
                        </td>

                        {{-- Customer Name --}}
                        <td>
                            <div style="font-weight: 700; color: #1e293b; font-size: 13px;">
                                <i class="fas fa-user text-muted me-1"></i> {{ $custName }}
                            </div>
                        </td>

                        {{-- Sale Invoice Ref --}}
                        <td>
                            @if($saleItem->sale)
                                <a href="{{ route('sales.show', $saleItem->sale_id) }}" class="badge" style="background: #eff6ff; color: #2563eb; font-size: 12px; padding: 5px 10px; border-radius: 8px; text-decoration: none;">
                                    <i class="fas fa-receipt me-1"></i> {{ $invoiceNo }}
                                </a>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state" style="padding: 40px 20px;">
                                <i class="fas fa-box-open text-muted"></i>
                                <p class="mb-0">{{ __('messages.no_sales_found') }}</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @if($salesList->count() > 0)
                <tfoot>
                    <tr style="background: #fff5f5; font-weight: 700;">
                        <td colspan="2" class="text-end" style="padding: 12px 18px; font-size: 13px; color: #475569;">
                            <strong>{{ __('messages.total_filtered') }}:</strong>
                        </td>
                        <td style="padding: 12px 18px;">
                            <span class="badge" style="background: #fee2e2; color: #dc2626; font-size: 13px; padding: 5px 10px;">
                                {{ number_format($totalSoldFilteredQty) }} {{ __('messages.units_sold') }}
                            </span>
                        </td>
                        <td></td>
                        <td style="padding: 12px 18px;">
                            <strong style="color: #dc2626; font-size: 14px;">{{ number_format($totalSoldFilteredRevenue, 3) }} {{ __('messages.omr') }}</strong>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>

        <div class="pagination-wrap">
            {{ $salesList->appends(request()->query())->links() }}
        </div>
    </div>

</div>

@push('scripts')
<script>
/* ── Tab Switcher for Monthly Cylinder Movement ── */
function switchMonthlyTab(tab, btn) {
    document.querySelectorAll('.inv-tab-pill-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    
    const purchasesTab = document.getElementById('monthlyPurchasesTab');
    const salesTab = document.getElementById('monthlySalesTab');
    
    if (tab === 'purchases') {
        purchasesTab.style.display = 'block';
        salesTab.style.display = 'none';
    } else {
        purchasesTab.style.display = 'none';
        salesTab.style.display = 'block';
    }
}
/* ── Live Instant Search ── */
const searchInput   = document.getElementById('liveSearch');
const clearBtn      = document.getElementById('searchClearBtn');
const rows          = document.querySelectorAll('tr.history-row');
const showingText   = document.getElementById('showingCount');
const noResultsRow  = document.getElementById('noResultsRow');

if (showingText) {
    showingText.setAttribute('data-original', showingText.textContent);
}

function runSearch() {
    const term = searchInput.value.trim().toLowerCase();
    clearBtn.style.display = term ? 'inline' : 'none';

    let visible = 0;
    rows.forEach(row => {
        const haystack = row.getAttribute('data-search') || '';
        const match    = haystack.includes(term);
        row.style.display = match ? '' : 'none';
        if (match) visible++;
    });

    if (noResultsRow) {
        noResultsRow.style.display = (visible === 0 && rows.length > 0) ? '' : 'none';
    }

    if (showingText) {
        showingText.textContent = term
            ? `Showing ${visible} result${visible !== 1 ? 's' : ''} for "${searchInput.value.trim()}"`
            : showingText.getAttribute('data-original');
    }
}

function clearSearch() {
    searchInput.value = '';
    runSearch();
    searchInput.focus();
}

if (searchInput) {
    searchInput.addEventListener('input', runSearch);
}
</script>
@endpush
@endsection
