@extends('layouts.app')

@push('styles')
<style>
    /* ── Page background ── */
    .customers-page { background: #f0f4ff; min-height: 100vh; padding: 24px; }

    /* ── Header ── */
    .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px; flex-wrap: wrap; gap: 12px; }
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
        font-size: 14px; background: #fff; width: 230px; color: #3d4467;
        transition: border-color .2s, box-shadow .2s;
    }
    .search-input:focus { border-color: #4e7fff; box-shadow: 0 0 0 3px rgba(78,127,255,.15); outline: none; }

    .btn-filter {
        border: 1.5px solid #cbd5e1; border-radius: 12px; background: #fff;
        color: #475569; font-size: 14px; font-weight: 600; padding: 10px 18px;
        display: flex; align-items: center; gap: 7px; cursor: pointer; transition: all .2s;
    }
    .btn-filter:hover { background: #f8fafc; border-color: #94a3b8; }

    .btn-add-customer {
        background: linear-gradient(135deg, #4e7fff 0%, #2563eb 100%);
        color: #fff; border: none; border-radius: 12px; font-size: 14px; font-weight: 700;
        padding: 10px 22px; display: flex; align-items: center; gap: 8px;
        box-shadow: 0 4px 14px rgba(78,127,255,.35); transition: opacity .2s;
        text-decoration: none;
    }
    .btn-add-customer:hover { opacity: .88; color: #fff; }

    /* ── Stat Cards ── */
    .stat-cards { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 28px; }
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
    .stat-value { font-size: 30px; font-weight: 800; color: #1a1f36; line-height: 1.1; margin-top: 4px; }

    .stat-bg-icon { position: absolute; right: 18px; bottom: -4px; font-size: 54px; opacity: .12; }
    .stat-bg-icon-blue   { color: #2563eb; }
    .stat-bg-icon-green  { color: #16a34a; }
    .stat-bg-icon-purple { color: #7c3aed; }
    .stat-bg-icon-orange { color: #d97706; }

    /* ── Table card ── */
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
    .cust-table thead tr { background: #f8fafc; }
    .cust-table thead th {
        padding: 13px 18px; font-size: 12px; font-weight: 700; color: #64748b;
        text-transform: uppercase; letter-spacing: .5px; border-bottom: 1.5px solid #f1f5f9;
    }
    .cust-table tbody tr { transition: background .15s; }
    .cust-table tbody tr:hover { background: #f8fafc; }
    .cust-table tbody td { padding: 14px 18px; font-size: 14px; color: #334155; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .cust-table tbody tr:last-child td { border-bottom: none; }

    /* Row number badge */
    .row-num { width: 28px; height: 28px; border-radius: 8px; background: #f1f5f9; color: #64748b; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; }

    /* Avatar */
    .cust-avatar { width: 40px; height: 40px; border-radius: 12px; object-fit: cover; background: #e2e8f0; }
    .cust-avatar-placeholder { width: 40px; height: 40px; border-radius: 12px; background: linear-gradient(135deg, #4e7fff, #2563eb); display: inline-flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 15px; }
    .cust-name-wrap { display: flex; align-items: center; gap: 12px; }
    .cust-name { font-weight: 700; color: #1a1f36; font-size: 14px; }
    .cust-code { font-size: 11px; color: #94a3b8; font-weight: 600; margin-top: 2px; }
    .cust-online-dot { width: 9px; height: 9px; border-radius: 50%; background: #22c55e; display: inline-block; margin-right: 4px; }

    /* Mobile */
    .mobile-link { color: #4e7fff; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 6px; }
    .mobile-link:hover { color: #2563eb; }
    .copy-btn { background: none; border: none; color: #cbd5e1; cursor: pointer; padding: 2px 4px; transition: color .2s; }
    .copy-btn:hover { color: #4e7fff; }

    /* Address */
    .addr-wrap { display: flex; align-items: flex-start; gap: 7px; }
    .addr-icon { color: #4e7fff; margin-top: 1px; font-size: 13px; flex-shrink: 0; }
    .addr-text { font-size: 13px; color: #475569; line-height: 1.4; }

    /* Distance badge */
    .dist-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: #eff6ff; color: #2563eb; border-radius: 20px;
        padding: 5px 12px; font-size: 12px; font-weight: 700;
    }
    .dist-badge i { color: #3b82f6; }

    /* Action buttons */
    .action-wrap { display: flex; gap: 6px; }
    .act-btn { width: 34px; height: 34px; border-radius: 9px; border: none; display: flex; align-items: center; justify-content: center; font-size: 14px; cursor: pointer; transition: opacity .2s; text-decoration: none; }
    .act-btn:hover { opacity: .82; }
    .act-btn-view  { background: #dbeafe; color: #2563eb; }
    .act-btn-edit  { background: #e0f2fe; color: #0284c7; }
    .act-btn-del   { background: #fee2e2; color: #dc2626; }

    /* Empty state */
    .empty-state { padding: 60px 20px; text-align: center; color: #94a3b8; }
    .empty-state i { font-size: 48px; margin-bottom: 14px; display: block; }
    .empty-state p { font-size: 15px; }

    /* Pagination wrapper */
    .pagination-wrap { padding: 16px 26px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; border-top: 1.5px solid #f1f5f9; }
    .pagination-wrap .pagination { margin: 0; }
    .show-entries { font-size: 13px; color: #64748b; display: flex; align-items: center; gap: 6px; }
    .entries-select { border: 1.5px solid #e2e8f0; border-radius: 8px; padding: 4px 8px; font-size: 13px; color: #334155; }
</style>
@endpush

@section('content')
<div class="customers-page">

    {{-- ── Header ── --}}
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-header-icon">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <h1 class="page-title">{{ __('messages.customers_management') }}</h1>
                <p class="page-subtitle">{{ __('messages.customers_subtitle') }}</p>
            </div>
        </div>
        <div class="header-right">
            {{-- Live Search --}}
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="liveSearch" class="search-input"
                       placeholder="{{ __('messages.search_customers') }}" autocomplete="off">
                <span id="searchClearBtn" style="display:none;position:absolute;right:12px;top:50%;transform:translateY(-50%);cursor:pointer;color:#94a3b8;font-size:13px;" onclick="clearSearch()">
                    <i class="fas fa-times"></i>
                </span>
            </div>

            {{-- Add Customer --}}
            @can('customer-create')
            <a href="{{ route('customers.create') }}" class="btn-add-customer">
                <i class="fas fa-plus"></i> {{ __('messages.add_customer') }}
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

    {{-- ── Stat Cards ── --}}
    <div class="stat-cards">
        {{-- Total Customers --}}
        <div class="stat-card stat-card-blue">
            <div>
                <div class="stat-label">{{ __('messages.total_customers_stat') }}</div>
                <div class="stat-value">{{ $totalCustomers }}</div>
            </div>
            <div class="stat-icon stat-icon-blue"><i class="fas fa-users"></i></div>
            <i class="fas fa-chart-bar stat-bg-icon stat-bg-icon-blue"></i>
        </div>

        {{-- Nearby --}}
        <div class="stat-card stat-card-green">
            <div>
                <div class="stat-label">{{ __('messages.nearby') }}</div>
                <div class="stat-value">{{ $customers->filter(fn($c) => $c->distance && (int)$c->distance <= 20)->count() }}</div>
            </div>
            <div class="stat-icon stat-icon-green"><i class="fas fa-map-marker-alt"></i></div>
            <i class="fas fa-map stat-bg-icon stat-bg-icon-green"></i>
        </div>

        {{-- Active Orders --}}
        <div class="stat-card stat-card-purple">
            <div>
                <div class="stat-label">{{ __('messages.active_orders') }}</div>
                <div class="stat-value">{{ \App\Models\Sale::whereDate('date', today())->count() }}</div>
            </div>
            <div class="stat-icon stat-icon-purple"><i class="fas fa-shopping-cart"></i></div>
            <i class="fas fa-car stat-bg-icon stat-bg-icon-purple"></i>
        </div>

        {{-- VIP Customers (top 12 by sales) --}}
        <div class="stat-card stat-card-orange">
            <div>
                <div class="stat-label">{{ __('messages.vip_customers') }}</div>
                <div class="stat-value">{{ \App\Models\Customer::has('sales', '>=', 1)->count() }}</div>
            </div>
            <div class="stat-icon stat-icon-orange"><i class="fas fa-star"></i></div>
            <i class="fas fa-crown stat-bg-icon stat-bg-icon-orange"></i>
        </div>
    </div>

    {{-- ── Table Card ── --}}
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <i class="fas fa-users"></i>
                <span>{{ __('messages.customers') }}</span>
            </div>
            <div style="display:flex;align-items:center;gap:16px;">
                <span class="showing-text">
                    Showing {{ $customers->firstItem() }}–{{ $customers->lastItem() }} of {{ $customers->total() }} customers
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
                        <th>#</th>
                        <th>{{ __('messages.name') }}</th>
                        <th>{{ __('messages.mobile') }}</th>
                        <th>{{ __('messages.address') }}</th>
                        <th>{{ __('messages.distance') }}</th>
                        <th>{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                    <tr class="cust-row" data-search="{{ strtolower($customer->name . ' ' . $customer->mobile . ' ' . $customer->address . ' CUS-' . str_pad($customer->id, 4, '0', STR_PAD_LEFT)) }}">
                        {{-- Row number --}}
                        <td><span class="row-num">{{ $loop->iteration + ($customers->currentPage()-1) * $customers->perPage() }}</span></td>

                        {{-- Name + Avatar --}}
                        <td>
                            <div class="cust-name-wrap">
                                @if($customer->profile_pic)
                                    <img src="{{ asset('storage/'.$customer->profile_pic) }}"
                                         alt="{{ $customer->name }}" class="cust-avatar">
                                @else
                                    <div class="cust-avatar-placeholder">
                                        {{ strtoupper(substr($customer->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="cust-name">
                                        <span class="cust-online-dot"></span>{{ $customer->name }}
                                    </div>
                                    <div class="cust-code">#CUS-{{ str_pad($customer->id, 4, '0', STR_PAD_LEFT) }}</div>
                                </div>
                            </div>
                        </td>

                        {{-- Mobile --}}
                        <td>
                            <div style="display:flex;align-items:center;gap:6px;">
                                <a href="tel:{{ $customer->mobile }}" class="mobile-link">
                                    <i class="fas fa-phone"></i> {{ $customer->mobile }}
                                </a>
                                <button class="copy-btn" onclick="copyText('{{ $customer->mobile }}')" title="Copy">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </td>

                        {{-- Address --}}
                        <td>
                            <div class="addr-wrap">
                                <i class="fas fa-map-marker-alt addr-icon"></i>
                                <span class="addr-text">{{ $customer->address ?: '—' }}</span>
                            </div>
                        </td>

                        {{-- Distance --}}
                        <td>
                            @if($customer->distance)
                            <span class="dist-badge">
                                <i class="fas fa-mountain"></i>
                                {{ $customer->distance }} km
                            </span>
                            @else
                            <span class="text-muted">—</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td>
                            <div class="action-wrap">
                                <a href="{{ route('customers.show', $customer->id) }}"
                                   class="act-btn act-btn-view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @can('customer-edit')
                                <a href="{{ route('customers.edit', $customer->id) }}"
                                   class="act-btn act-btn-edit" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                @endcan
                                @can('customer-delete')
                                <button class="act-btn act-btn-del" title="Delete"
                                        onclick="confirmDelete('{{ route('customers.destroy', $customer->id) }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fas fa-users-slash"></i>
                                <p>{{ __('messages.no_customers_found') }}</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="pagination-wrap">
            <div class="show-entries">
                {{ __('messages.show') }}
                <select class="entries-select" onchange="window.location=window.location.pathname+'?per_page='+this.value">
                    @foreach([10, 25, 50, 100] as $n)
                    <option value="{{ $n }}" {{ $customers->perPage() == $n ? 'selected' : '' }}>{{ $n }}</option>
                    @endforeach
                </select>
                {{ __('messages.entries') }}
            </div>
            {{ $customers->links() }}
        </div>
    </div>

</div>

@push('scripts')
<script>
/* ── Copy phone number ── */
function copyText(text) {
    navigator.clipboard.writeText(text).then(() => {
        const el = event.currentTarget;
        el.innerHTML = '<i class="fas fa-check" style="color:#22c55e"></i>';
        setTimeout(() => el.innerHTML = '<i class="fas fa-copy"></i>', 1500);
    });
}

/* ── Live Search ── */
const searchInput   = document.getElementById('liveSearch');
const clearBtn      = document.getElementById('searchClearBtn');
const rows          = document.querySelectorAll('tr.cust-row');
const showingText   = document.getElementById('showingCount');
const noResultsRow  = document.getElementById('noResultsRow');

function runSearch() {
    const term = searchInput.value.trim().toLowerCase();

    // Show / hide clear button
    clearBtn.style.display = term ? 'inline' : 'none';

    let visible = 0;
    rows.forEach(row => {
        const haystack = row.getAttribute('data-search') || '';
        const match    = haystack.includes(term);
        row.style.display = match ? '' : 'none';
        if (match) visible++;
    });

    // No-results row
    if (noResultsRow) {
        noResultsRow.style.display = visible === 0 ? '' : 'none';
    }

    // Update "Showing X-Y of Z" text
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

searchInput.addEventListener('input', runSearch);
// Save original showing text for reset
if (showingText) showingText.setAttribute('data-original', showingText.textContent);
</script>
@endpush
@endsection
