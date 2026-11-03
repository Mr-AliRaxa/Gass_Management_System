@extends('layouts.app')

@push('styles')
<style>
    /* ── Page background ── */
    .expenses-page { background: #f0f4ff; min-height: 100vh; padding: 24px; }

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

    .btn-add-expense {
        background: linear-gradient(135deg, #4e7fff 0%, #2563eb 100%);
        color: #fff; border: none; border-radius: 12px; font-size: 14px; font-weight: 700;
        padding: 10px 22px; display: flex; align-items: center; gap: 8px;
        box-shadow: 0 4px 14px rgba(78,127,255,.35); transition: opacity .2s;
        text-decoration: none;
    }
    .btn-add-expense:hover { opacity: .88; color: #fff; }

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
    .stat-card-red    { background: linear-gradient(135deg, #fee2e2 0%, #fef2f2 100%); }
    .stat-card-orange { background: linear-gradient(135deg, #fef3c7 0%, #fffbeb 100%); }

    .stat-icon {
        width: 52px; height: 52px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;
    }
    .stat-icon-blue   { background: linear-gradient(135deg, #4e7fff, #2563eb); color: #fff; box-shadow: 0 4px 12px rgba(78,127,255,.35); }
    .stat-icon-green  { background: linear-gradient(135deg, #22c55e, #16a34a); color: #fff; box-shadow: 0 4px 12px rgba(34,197,94,.35); }
    .stat-icon-red    { background: linear-gradient(135deg, #ef4444, #dc2626); color: #fff; box-shadow: 0 4px 12px rgba(239,68,68,.35); }
    .stat-icon-orange { background: linear-gradient(135deg, #f59e0b, #d97706); color: #fff; box-shadow: 0 4px 12px rgba(245,158,11,.35); }

    .stat-label { font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: .5px; }
    .stat-value { font-size: 28px; font-weight: 800; color: #1a1f36; line-height: 1.1; margin-top: 4px; }

    .stat-bg-icon { position: absolute; right: 18px; bottom: -4px; font-size: 54px; opacity: .12; }
    .stat-bg-icon-blue   { color: #2563eb; }
    .stat-bg-icon-green  { color: #16a34a; }
    .stat-bg-icon-red    { color: #dc2626; }
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

    /* Date badge */
    .date-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: #f8fafc; color: #475569; border-radius: 10px;
        padding: 6px 12px; font-size: 13px; font-weight: 600; border: 1px solid #e2e8f0;
    }

    /* Expense Type Badge */
    .type-badge {
        display: inline-flex; align-items: center; gap: 7px;
        background: #ede9fe; color: #6d28d9; border-radius: 20px;
        padding: 6px 14px; font-size: 13px; font-weight: 700;
    }

    /* Amount badge */
    .amount-badge {
        display: inline-flex; align-items: center; gap: 5px;
        background: #fee2e2; color: #dc2626; border-radius: 20px;
        padding: 6px 14px; font-size: 14px; font-weight: 800;
    }

    /* Note cell */
    .note-text { font-size: 13px; color: #64748b; max-width: 280px; display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

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
<div class="expenses-page">

    {{-- ── Header ── --}}
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-header-icon">
                <i class="fas fa-receipt"></i>
            </div>
            <div>
                <h1 class="page-title">{{ __('messages.expenses_management') }}</h1>
                <p class="page-subtitle">{{ __('messages.expenses') }}</p>
            </div>
        </div>
        <div class="header-right">
            {{-- Live Search --}}
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="liveSearch" class="search-input"
                       placeholder="{{ __('messages.search') }}..." autocomplete="off">
                <span id="searchClearBtn" style="display:none;position:absolute;right:12px;top:50%;transform:translateY(-50%);cursor:pointer;color:#94a3b8;font-size:13px;" onclick="clearSearch()">
                    <i class="fas fa-times"></i>
                </span>
            </div>

            {{-- Download PDF Button --}}
            <a class="btn-pdf" href="{{ route('expenses.downloadPdf', request()->all()) }}">
                <i class="fas fa-file-pdf"></i> {{ __('messages.download_pdf') }}
            </a>

            {{-- Toggle Filters Button --}}
            <button class="btn-filter-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#filterBox" aria-expanded="false">
                <i class="fas fa-filter"></i> {{ __('messages.filters') }}
            </button>

            {{-- Add Expense Button --}}
            @can('expense-create')
            <a href="{{ route('expenses.create') }}" class="btn-add-expense">
                <i class="fas fa-plus"></i> {{ __('messages.add_expense') }}
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
        {{-- Today's Expenses --}}
        <div class="stat-card stat-card-red">
            <div>
                <div class="stat-label">{{ __('messages.today_expenses') }}</div>
                <div class="stat-value">{{ number_format($todayExpense ?? 0, 2) }} <span style="font-size:13px;font-weight:600;">OMR</span></div>
            </div>
            <div class="stat-icon stat-icon-red"><i class="fas fa-calendar-day"></i></div>
            <i class="fas fa-money-bill-alt stat-bg-icon stat-bg-icon-red"></i>
        </div>

        {{-- This Month's Expenses --}}
        <div class="stat-card stat-card-orange">
            <div>
                <div class="stat-label">{{ __('messages.this_month_expenses') }}</div>
                <div class="stat-value">{{ number_format($thisMonthExpense ?? 0, 2) }} <span style="font-size:13px;font-weight:600;">OMR</span></div>
            </div>
            <div class="stat-icon stat-icon-orange"><i class="fas fa-calendar-alt"></i></div>
            <i class="fas fa-file-invoice-dollar stat-bg-icon stat-bg-icon-orange"></i>
        </div>

        {{-- Total Records Count --}}
        <div class="stat-card stat-card-blue">
            <div>
                <div class="stat-label">{{ __('messages.total_expense_slips') }}</div>
                <div class="stat-value">{{ $totalExpenseCount ?? $expenses->total() }}</div>
            </div>
            <div class="stat-icon stat-icon-blue"><i class="fas fa-receipt"></i></div>
            <i class="fas fa-clipboard-list stat-bg-icon stat-bg-icon-blue"></i>
        </div>

        {{-- Total All Time --}}
        <div class="stat-card stat-card-green">
            <div>
                <div class="stat-label">{{ __('messages.all_time_total') }}</div>
                <div class="stat-value">{{ number_format($totalExpenseAllTime ?? 0, 0) }} <span style="font-size:13px;font-weight:600;">OMR</span></div>
            </div>
            <div class="stat-icon stat-icon-green"><i class="fas fa-wallet"></i></div>
            <i class="fas fa-coins stat-bg-icon stat-bg-icon-green"></i>
        </div>
    </div>

    {{-- ── Collapsible Date & Type Filter Form ── --}}
    <div class="collapse {{ (request('start_date') || request('end_date') || request('expense_type_id')) ? 'show' : '' }}" id="filterBox">
        <div class="filter-card">
            <div class="filter-header">
                <span class="filter-title"><i class="fas fa-sliders-h text-primary"></i> {{ __('messages.filter_expense_records') }}</span>
                @if(request('start_date') || request('end_date') || request('expense_type_id'))
                <a href="{{ route('expenses.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">{{ __('messages.clear_filters') }}</a>
                @endif
            </div>
            <form action="{{ route('expenses.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="filter-label">{{ __('messages.start_date') }}</div>
                        <input type="date" name="start_date" class="filter-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3">
                        <div class="filter-label">{{ __('messages.end_date') }}</div>
                        <input type="date" name="end_date" class="filter-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-4">
                        <div class="filter-label">{{ __('messages.expense_category') }}</div>
                        <select name="expense_type_id" class="filter-control">
                            <option value="">{{ __('messages.all_categories') }}</option>
                            @foreach($expenseTypes as $type)
                                <option value="{{ $type->id }}" {{ request('expense_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
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
        <div class="table-card-header">
            <div class="table-card-title">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>{{ __('messages.expenses_history') }}</span>
            </div>
            <div style="display:flex;align-items:center;gap:16px;">
                <span class="showing-text" id="showingCount">
                    Showing {{ $expenses->firstItem() ?? 0 }}–{{ $expenses->lastItem() ?? 0 }} of {{ $expenses->total() ?? 0 }} expenses
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
                        <th>{{ __('messages.category_type') }}</th>
                        <th>{{ __('messages.date') }}</th>
                        <th>{{ __('messages.amount') }}</th>
                        <th>{{ __('messages.notes_description') }}</th>
                        <th>{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($expenses as $expense)
                    <tr class="expense-row" data-search="{{ strtolower(($expense->type->name ?? '') . ' ' . $expense->date . ' ' . $expense->amount . ' ' . ($expense->note ?? '')) }}">
                        {{-- Row number --}}
                        <td><span class="row-num">{{ $loop->iteration + ($expenses->currentPage()-1) * $expenses->perPage() }}</span></td>

                        {{-- Type --}}
                        <td>
                            <span class="type-badge">
                                <i class="fas fa-tag"></i>
                                {{ $expense->type->name ?? 'General' }}
                            </span>
                        </td>

                        {{-- Date --}}
                        <td>
                            <span class="date-badge">
                                <i class="far fa-calendar-alt text-primary"></i>
                                {{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}
                            </span>
                        </td>

                        {{-- Amount --}}
                        <td>
                            <span class="amount-badge">
                                <i class="fas fa-coins"></i>
                                {{ number_format($expense->amount, 2) }} OMR
                            </span>
                        </td>

                        {{-- Note --}}
                        <td>
                            @if($expense->note)
                                <span class="note-text" title="{{ $expense->note }}">
                                    <i class="far fa-clipboard me-1 text-muted"></i>{{ $expense->note }}
                                </span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td>
                            <div class="action-wrap">
                                <a href="{{ route('expenses.show', $expense->id) }}"
                                   class="act-btn act-btn-view" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @can('expense-edit')
                                <a href="{{ route('expenses.edit', $expense->id) }}"
                                   class="act-btn act-btn-edit" title="Edit Expense">
                                    <i class="fas fa-pen"></i>
                                </a>
                                @endcan
                                @can('expense-delete')
                                <button class="act-btn act-btn-del" title="Delete Expense"
                                        onclick="confirmDelete('{{ route('expenses.destroy', $expense->id) }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="initialEmptyRow">
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fas fa-receipt"></i>
                                <p>No expense records found.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                    {{-- Dynamic row for empty live search result --}}
                    <tr id="noResultsRow" style="display:none;">
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fas fa-search-minus"></i>
                                <p>No matching expenses found.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="pagination-wrap">
            <div class="show-entries">
                {{ __('messages.show') }}
                <select class="entries-select" onchange="window.location=window.location.pathname+'?per_page='+this.value">
                    @foreach([10, 20, 50, 100] as $n)
                    <option value="{{ $n }}" {{ $expenses->perPage() == $n ? 'selected' : '' }}>{{ $n }}</option>
                    @endforeach
                </select>
                {{ __('messages.records') }}
            </div>
            {{ $expenses->appends(request()->input())->links() }}
        </div>
    </div>

</div>

@push('scripts')
<script>
/* ── Live Instant Search ── */
const searchInput   = document.getElementById('liveSearch');
const clearBtn      = document.getElementById('searchClearBtn');
const rows          = document.querySelectorAll('tr.expense-row');
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
