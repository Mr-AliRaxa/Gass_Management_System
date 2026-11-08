@extends('layouts.app')

@push('styles')
<style>
    /* ── Page background ── */
    .sales-page { background: #f0f4ff; min-height: 100vh; padding: 24px; }

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
        color: #dc2626; font-size: 14px; font-weight: 600; padding: 10px 16px;
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

    .btn-print {
        border: 1.5px solid #cbd5e1; border-radius: 12px; background: #fff;
        color: #475569; font-size: 14px; font-weight: 600; padding: 10px 16px;
        display: flex; align-items: center; gap: 7px; cursor: pointer; transition: all .2s;
    }
    .btn-print:hover { background: #f8fafc; border-color: #94a3b8; }

    .btn-add-sale {
        background: linear-gradient(135deg, #4e7fff 0%, #2563eb 100%);
        color: #fff; border: none; border-radius: 12px; font-size: 14px; font-weight: 700;
        padding: 10px 22px; display: flex; align-items: center; gap: 8px;
        box-shadow: 0 4px 14px rgba(78,127,255,.35); transition: opacity .2s;
        text-decoration: none;
    }
    .btn-add-sale:hover { opacity: .88; color: #fff; }

    /* ── Stat Cards ── */
    .stat-cards { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
    @media (max-width: 900px) { .stat-cards { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 500px) { .stat-cards { grid-template-columns: 1fr; } }

    .stat-card {
        border-radius: 18px; padding: 20px 22px; display: flex;
        align-items: center; justify-content: space-between; position: relative; overflow: hidden;
    }
    .stat-card-blue   { background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%); }
    .stat-card-green  { background: linear-gradient(135deg, #dcfce7 0%, #f0fdf4 100%); }
    .stat-card-purple { background: linear-gradient(135deg, #ede9fe 0%, #f5f3ff 100%); }
    .stat-card-orange { background: linear-gradient(135deg, #fef3c7 0%, #fffbeb 100%); }

    .stat-icon {
        width: 52px; height: 52px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;
    }
    .stat-icon-blue   { background: linear-gradient(135deg, #4e7fff, #2563eb); color: #fff; box-shadow: 0 4px 12px rgba(78,127,255,.35); }
    .stat-icon-green  { background: linear-gradient(135deg, #22c55e, #16a34a); color: #fff; box-shadow: 0 4px 12px rgba(34,197,94,.35); }
    .stat-icon-purple { background: linear-gradient(135deg, #a855f7, #7c3aed); color: #fff; box-shadow: 0 4px 12px rgba(168,85,247,.35); }
    .stat-icon-orange { background: linear-gradient(135deg, #f59e0b, #d97706); color: #fff; box-shadow: 0 4px 12px rgba(245,158,11,.35); }

    .stat-label { font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: .5px; }
    .stat-value { font-size: 28px; font-weight: 800; color: #1a1f36; line-height: 1.1; margin-top: 4px; }

    .stat-bg-icon { position: absolute; right: 18px; bottom: -4px; font-size: 54px; opacity: .12; }
    .stat-bg-icon-blue   { color: #2563eb; }
    .stat-bg-icon-green  { color: #16a34a; }
    .stat-bg-icon-purple { color: #7c3aed; }
    .stat-bg-icon-orange { color: #d97706; }

    /* ── Collapsible Filter Drawer ── */
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

    /* ── Table Card ── */
    .table-card { background: #fff; border-radius: 20px; box-shadow: 0 2px 20px rgba(30,41,59,.07); overflow: hidden; }
    .table-card-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 20px 26px 16px; border-bottom: 1.5px solid #f1f5f9; flex-wrap: wrap; gap: 10px;
    }
    .table-card-title { display: flex; align-items: center; gap: 12px; }
    .table-card-title i { color: #4e7fff; font-size: 20px; }
    .table-card-title span { font-size: 18px; font-weight: 700; color: #1a1f36; }
    .showing-text { font-size: 13px; color: #94a3b8; }

    .view-toggle { display: flex; gap: 4px; }
    .view-btn {
        width: 34px; height: 34px; border-radius: 8px; border: 1.5px solid #e2e8f0;
        background: #fff; color: #94a3b8; display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: all .2s; font-size: 14px;
    }
    .view-btn.active { background: #4e7fff; border-color: #4e7fff; color: #fff; }

    /* ── Table ── */
    .cust-table { width: 100%; border-collapse: separate; border-spacing: 0; }
    .cust-table thead th {
        padding: 10px 14px; font-size: 12px; font-weight: 700;
        text-transform: uppercase; letter-spacing: .5px; border-bottom: 1.5px solid #f1f5f9;
        vertical-align: middle;
    }
    .cust-table thead tr:first-child th { background: #f8fafc; color: #64748b; }
    .cust-table thead tr:last-child th { background: #f1f5f9; color: #475569; font-size: 11px; }

    .th-filled-header { background: linear-gradient(135deg, #0284c7, #0369a1) !important; color: #fff !important; }
    .th-new-header { background: linear-gradient(135deg, #16a34a, #15803d) !important; color: #fff !important; }

    .cust-table tbody tr { transition: background .15s; }
    .cust-table tbody tr:hover { background: #f8fafc; }
    .cust-table tbody td { padding: 12px 14px; font-size: 13px; color: #334155; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .cust-table tbody tr:last-child td { border-bottom: none; }

    /* Inv badge */
    .inv-badge {
        font-weight: 800; color: #2563eb; background: #eff6ff;
        padding: 5px 10px; border-radius: 8px; font-size: 13px; display: inline-block;
    }

    /* Date badge */
    .date-badge {
        display: inline-flex; align-items: center; gap: 5px;
        background: #f8fafc; color: #475569; border-radius: 8px;
        padding: 5px 10px; font-size: 12px; font-weight: 600; border: 1px solid #e2e8f0;
    }

    /* Customer Name cell */
    .cust-cell { display: flex; align-items: center; gap: 8px; }
    .cust-avatar-sm {
        width: 32px; height: 32px; border-radius: 10px;
        background: linear-gradient(135deg, #4e7fff, #2563eb);
        color: #fff; font-weight: 700; font-size: 12px;
        display: inline-flex; align-items: center; justify-content: center;
    }
    .cust-fullname { font-weight: 700; color: #1e293b; }

    /* Quantity cells */
    .qty-num {
        font-weight: 700; padding: 4px 8px; border-radius: 6px; display: inline-block; min-width: 28px; text-align: center;
    }
    .qty-active-filled { background: #e0f2fe; color: #0369a1; }
    .qty-active-new { background: #dcfce7; color: #15803d; }
    .qty-zero { color: #cbd5e1; }

    /* Total amount */
    .total-amount-pill {
        display: inline-flex; align-items: center; gap: 4px;
        background: #eff6ff; color: #1d4ed8; font-weight: 800; font-size: 14px;
        padding: 5px 12px; border-radius: 20px;
    }

    /* Action buttons */
    .action-wrap { display: flex; gap: 6px; }
    .act-btn { width: 34px; height: 34px; border-radius: 9px; border: none; display: flex; align-items: center; justify-content: center; font-size: 13px; cursor: pointer; transition: opacity .2s; text-decoration: none; }
    .act-btn:hover { opacity: .82; }
    .act-btn-view  { background: #dbeafe; color: #2563eb; }
    .act-btn-pdf   { background: #fee2e2; color: #dc2626; }
    .act-btn-del   { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

    /* Empty state */
    .empty-state { padding: 60px 20px; text-align: center; color: #94a3b8; }
    .empty-state i { font-size: 48px; margin-bottom: 14px; display: block; }
    .empty-state p { font-size: 15px; }

    /* Pagination wrapper */
    .pagination-wrap { padding: 16px 26px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; border-top: 1.5px solid #f1f5f9; }
    .pagination-wrap .pagination { margin: 0; }
    .show-entries { font-size: 13px; color: #64748b; display: flex; align-items: center; gap: 6px; }
    .entries-select { border: 1.5px solid #e2e8f0; border-radius: 8px; padding: 4px 8px; font-size: 13px; color: #334155; }

    /* Print styles */
    @media print {
        .d-print-none, #wrapper .d-flex.flex-column.flex-shrink-0, .page-header, .stat-cards, .filter-card, .search-wrapper, .view-toggle, .pagination-wrap, .act-btn { display: none !important; }
        .sales-page { background: #fff !important; padding: 0 !important; }
        .table-card { box-shadow: none !important; border: none !important; }
        body { background: white !important; }
    }
</style>
@endpush

@section('content')
<div class="sales-page">

    {{-- ── Header ── --}}
    <div class="page-header d-print-none">
        <div class="page-header-left">
            <div class="page-header-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div>
                <h1 class="page-title">{{ __('messages.daily_sales_management') }}</h1>
                <p class="page-subtitle">{{ __('messages.sales_management_subtitle') }}</p>
            </div>
        </div>
        <div class="header-right">
            {{-- Live Instant Search --}}
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="liveSearch" class="search-input"
                       placeholder="{{ __('messages.search_invoices') }}" autocomplete="off">
                <span id="searchClearBtn" style="display:none;position:absolute;right:12px;top:50%;transform:translateY(-50%);cursor:pointer;color:#94a3b8;font-size:13px;" onclick="clearSearch()">
                    <i class="fas fa-times"></i>
                </span>
            </div>

            {{-- Print Button --}}
            <button type="button" class="btn-print" onclick="window.print()">
                <i class="fas fa-print"></i> {{ __('messages.print') }}
            </button>

            {{-- Download Filtered PDF --}}
            <a class="btn-pdf" href="{{ route('sales.exportFilteredPdf', request()->all()) }}">
                <i class="fas fa-file-pdf"></i> {{ __('messages.export_pdf') }}
            </a>

            {{-- Toggle Filters Button --}}
            <button class="btn-filter-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#filterBox" aria-expanded="false">
                <i class="fas fa-filter"></i> {{ __('messages.filters') }}
            </button>

            {{-- Add New Sale Button --}}
            @can('sale-create')
            <a href="{{ route('sales.create') }}" class="btn-add-sale">
                <i class="fas fa-plus"></i> {{ __('messages.add_new_sale') }}
            </a>
            @endcan
        </div>
    </div>

    {{-- ── Flash Messages ── --}}
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4 d-print-none" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- ── Stat Cards ── --}}
    <div class="stat-cards d-print-none">
        {{-- Today's Sales Revenue --}}
        <div class="stat-card stat-card-blue">
            <div>
                <div class="stat-label">{{ __('messages.todays_revenue') }}</div>
                <div class="stat-value">{{ number_format($todayRevenue ?? 0, 3) }} <span style="font-size:14px;font-weight:600;">OMR</span></div>
            </div>
            <div class="stat-icon stat-icon-blue"><i class="fas fa-coins"></i></div>
            <i class="fas fa-chart-line stat-bg-icon stat-bg-icon-blue"></i>
        </div>

        {{-- Today's Invoices --}}
        <div class="stat-card stat-card-green">
            <div>
                <div class="stat-label">{{ __('messages.todays_invoices') }}</div>
                <div class="stat-value">{{ $todayInvoicesCount ?? 0 }}</div>
            </div>
            <div class="stat-icon stat-icon-green"><i class="fas fa-file-invoice"></i></div>
            <i class="fas fa-receipt stat-bg-icon stat-bg-icon-green"></i>
        </div>

        {{-- Total Invoices (All Time) --}}
        <div class="stat-card stat-card-purple">
            <div>
                <div class="stat-label">{{ __('messages.total_invoices') }}</div>
                <div class="stat-value">{{ $totalOrdersCount ?? $sales->total() }}</div>
            </div>
            <div class="stat-icon stat-icon-purple"><i class="fas fa-clipboard-list"></i></div>
            <i class="fas fa-file-alt stat-bg-icon stat-bg-icon-purple"></i>
        </div>

        {{-- Total Revenue (All Time) --}}
        <div class="stat-card stat-card-orange">
            <div>
                <div class="stat-label">{{ __('messages.total_sales') }}</div>
                <div class="stat-value">{{ number_format($totalSalesRevenue ?? 0, 3) }} <span style="font-size:14px;font-weight:600;">OMR</span></div>
            </div>
            <div class="stat-icon stat-icon-orange"><i class="fas fa-wallet"></i></div>
            <i class="fas fa-money-bill-wave stat-bg-icon stat-bg-icon-orange"></i>
        </div>
    </div>

    {{-- ── Collapsible Filter Box ── --}}
    <div class="collapse {{ (request('customer_id') || request('from_date') || request('to_date')) ? 'show' : '' }} d-print-none" id="filterBox">
        <div class="filter-card">
            <div class="filter-header">
                <span class="filter-title"><i class="fas fa-sliders-h text-primary"></i> {{ __('messages.filter_sales_invoices') }}</span>
                @if(request('customer_id') || request('from_date') || request('to_date'))
                <a href="{{ route('sales.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">{{ __('messages.clear_filters') }}</a>
                @endif
            </div>
            <form action="{{ route('sales.index') }}" method="GET" id="filterForm">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="filter-label">{{ __('messages.customer') }}</div>
                        <select name="customer_id" class="filter-control">
                            <option value="">{{ __('messages.all_customers') }}</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="filter-label">{{ __('messages.from_date') }}</div>
                        <input type="date" name="from_date" class="filter-control" value="{{ request('from_date') }}">
                    </div>
                    <div class="col-md-3">
                        <div class="filter-label">{{ __('messages.to_date') }}</div>
                        <input type="date" name="to_date" class="filter-control" value="{{ request('to_date') }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100 rounded-3 font-weight-bold" style="padding:8px 16px;">
                            <i class="fas fa-search me-1"></i> {{ __('messages.apply') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- ── Table Card ── --}}
    <div class="table-card">
        <div class="table-card-header d-print-none">
            <div class="table-card-title">
                <i class="fas fa-list-alt"></i>
                <span>{{ __('messages.sales_records') }}</span>
            </div>
            <div style="display:flex;align-items:center;gap:16px;">
                <span class="showing-text" id="showingCount">
                    Showing {{ $sales->firstItem() ?? 0 }}–{{ $sales->lastItem() ?? 0 }} of {{ $sales->total() ?? 0 }} invoices
                </span>
                <div class="view-toggle">
                    <button class="view-btn active"><i class="fas fa-th"></i></button>
                    <button class="view-btn"><i class="fas fa-list"></i></button>
                </div>
            </div>
        </div>

        <div style="overflow-x:auto;">
            <table class="cust-table">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle">{{ __('messages.inv_no') }}</th>
                        <th rowspan="2" class="align-middle">{{ __('messages.date') }}</th>
                        <th rowspan="2" class="align-middle">{{ __('messages.customer') }}</th>
                        <th colspan="3" class="text-center th-filled-header">
                            <i class="fas fa-gas-pump me-1"></i> {{ __('messages.filled_refill') }}
                        </th>
                        <th colspan="3" class="text-center th-new-header">
                            <i class="fas fa-box me-1"></i> {{ __('messages.new_cylinder') }}
                        </th>
                        <th rowspan="2" class="align-middle text-end">{{ __('messages.total_amount_label') }}</th>
                        <th rowspan="2" class="align-middle text-center d-print-none" width="130px">{{ __('messages.actions') }}</th>
                    </tr>
                    <tr>
                        <th class="text-center">11kg</th>
                        <th class="text-center">22kg</th>
                        <th class="text-center">44kg</th>
                        <th class="text-center">11kg</th>
                        <th class="text-center">22kg</th>
                        <th class="text-center">44kg</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                    @php
                        $items = $sale->saleItems->groupBy('type');
                        $getQty = function($type) use ($items) {
                            return $items->has($type) ? $items->get($type)->sum('quantity') : 0;
                        };
                        $filled11 = $getQty('11kg_full');
                        $filled22 = $getQty('22kg_full');
                        $filled44 = $getQty('44kg_full');
                        $new11 = $getQty('11kg_empty');
                        $new22 = $getQty('22kg_empty');
                        $new44 = $getQty('44kg_empty');
                    @endphp
                    <tr class="sale-row" data-search="{{ strtolower($sale->id . ' ' . $sale->customer->name . ' ' . $sale->date . ' ' . $sale->total_amount) }}">
                        {{-- Inv # --}}
                        <td>
                            <span class="inv-badge">#{{ $sale->id }}</span>
                        </td>

                        {{-- Date --}}
                        <td>
                            <span class="date-badge">
                                <i class="far fa-calendar-alt text-primary"></i>
                                {{ \Carbon\Carbon::parse($sale->date)->format('M d, Y') }}
                            </span>
                        </td>

                        {{-- Customer --}}
                        <td>
                            <div class="cust-cell">
                                <div class="cust-avatar-sm">
                                    {{ strtoupper(substr($sale->customer->name, 0, 1)) }}
                                </div>
                                <span class="cust-fullname">{{ $sale->customer->name }}</span>
                            </div>
                        </td>

                        {{-- Filled Cylinders --}}
                        <td class="text-center">
                            <span class="qty-num {{ $filled11 > 0 ? 'qty-active-filled' : 'qty-zero' }}">{{ $filled11 }}</span>
                        </td>
                        <td class="text-center">
                            <span class="qty-num {{ $filled22 > 0 ? 'qty-active-filled' : 'qty-zero' }}">{{ $filled22 }}</span>
                        </td>
                        <td class="text-center">
                            <span class="qty-num {{ $filled44 > 0 ? 'qty-active-filled' : 'qty-zero' }}">{{ $filled44 }}</span>
                        </td>

                        {{-- New Cylinders --}}
                        <td class="text-center">
                            <span class="qty-num {{ $new11 > 0 ? 'qty-active-new' : 'qty-zero' }}">{{ $new11 }}</span>
                        </td>
                        <td class="text-center">
                            <span class="qty-num {{ $new22 > 0 ? 'qty-active-new' : 'qty-zero' }}">{{ $new22 }}</span>
                        </td>
                        <td class="text-center">
                            <span class="qty-num {{ $new44 > 0 ? 'qty-active-new' : 'qty-zero' }}">{{ $new44 }}</span>
                        </td>

                        {{-- Total Amount --}}
                        <td class="text-end">
                            <span class="total-amount-pill">
                                {{ number_format($sale->total_amount, 3) }} OMR
                            </span>
                        </td>

                        {{-- Action Buttons --}}
                        <td class="text-center d-print-none">
                            <div class="action-wrap justify-content-center">
                                <a href="{{ route('sales.show', $sale->id) }}"
                                   class="act-btn act-btn-view" title="View Invoice">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('sales.downloadPdf', $sale->id) }}"
                                   class="act-btn act-btn-pdf" title="Download PDF Invoice">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                @can('sale-delete')
                                <button type="button" class="act-btn act-btn-del" title="Delete Sale"
                                        onclick="confirmDelete('{{ route('sales.destroy', $sale->id) }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="initialEmptyRow">
                        <td colspan="11">
                            <div class="empty-state">
                                <i class="fas fa-receipt"></i>
                                <p>No sales records found.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                    {{-- Dynamic row for empty live search result --}}
                    <tr id="noResultsRow" style="display:none;">
                        <td colspan="11">
                            <div class="empty-state">
                                <i class="fas fa-search-minus"></i>
                                <p>No matching sales invoices found.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="pagination-wrap d-print-none">
            <div class="show-entries">
                {{ __('messages.show') }}
                <select class="entries-select" onchange="window.location=window.location.pathname+'?per_page='+this.value">
                    @foreach([25, 50, 100, 200] as $n)
                    <option value="{{ $n }}" {{ $sales->perPage() == $n ? 'selected' : '' }}>{{ $n }}</option>
                    @endforeach
                </select>
                {{ __('messages.invoices') }}
            </div>
            {{ $sales->appends(request()->input())->links() }}
        </div>
    </div>

</div>

@push('scripts')
<script>
/* ── Live Instant Search ── */
const searchInput   = document.getElementById('liveSearch');
const clearBtn      = document.getElementById('searchClearBtn');
const rows          = document.querySelectorAll('tr.sale-row');
const showingText   = document.getElementById('showingCount');
const noResultsRow  = document.getElementById('noResultsRow');

if (showingText) {
    showingText.setAttribute('data-original', showingText.textContent);
}

function runSearch() {
    const term = searchInput.value.trim().toLowerCase();

    // Show/hide clear button
    clearBtn.style.display = term ? 'inline' : 'none';

    let visible = 0;
    rows.forEach(row => {
        const haystack = row.getAttribute('data-search') || '';
        const match    = haystack.includes(term);
        row.style.display = match ? '' : 'none';
        if (match) visible++;
    });

    // Show/hide no results row
    if (noResultsRow) {
        noResultsRow.style.display = (visible === 0 && rows.length > 0) ? '' : 'none';
    }

    // Update Showing count text
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
