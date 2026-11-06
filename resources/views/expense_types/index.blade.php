@extends('layouts.app')

@push('styles')
<style>
    /* ── Page background ── */
    .expense-types-page { background: #f0f4ff; min-height: 100vh; padding: 24px; }

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

    .btn-add-type {
        background: linear-gradient(135deg, #4e7fff 0%, #2563eb 100%);
        color: #fff; border: none; border-radius: 12px; font-size: 14px; font-weight: 700;
        padding: 10px 22px; display: flex; align-items: center; gap: 8px;
        box-shadow: 0 4px 14px rgba(78,127,255,.35); transition: opacity .2s;
        text-decoration: none;
    }
    .btn-add-type:hover { opacity: .88; color: #fff; }

    /* ── Stat Cards ── */
    .stat-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px; }
    @media (max-width: 768px) { .stat-cards { grid-template-columns: 1fr; } }

    .stat-card {
        border-radius: 18px; padding: 20px 22px; display: flex;
        align-items: center; justify-content: space-between; position: relative; overflow: hidden;
    }
    .stat-card-blue   { background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%); }
    .stat-card-purple { background: linear-gradient(135deg, #ede9fe 0%, #f5f3ff 100%); }
    .stat-card-green  { background: linear-gradient(135deg, #dcfce7 0%, #f0fdf4 100%); }

    .stat-icon {
        width: 52px; height: 52px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;
    }
    .stat-icon-blue   { background: linear-gradient(135deg, #4e7fff, #2563eb); color: #fff; box-shadow: 0 4px 12px rgba(78,127,255,.35); }
    .stat-icon-purple { background: linear-gradient(135deg, #a855f7, #7c3aed); color: #fff; box-shadow: 0 4px 12px rgba(168,85,247,.35); }
    .stat-icon-green  { background: linear-gradient(135deg, #22c55e, #16a34a); color: #fff; box-shadow: 0 4px 12px rgba(34,197,94,.35); }

    .stat-label { font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: .5px; }
    .stat-value { font-size: 28px; font-weight: 800; color: #1a1f36; line-height: 1.1; margin-top: 4px; }

    .stat-bg-icon { position: absolute; right: 18px; bottom: -4px; font-size: 54px; opacity: .12; }
    .stat-bg-icon-blue   { color: #2563eb; }
    .stat-bg-icon-purple { color: #7c3aed; }
    .stat-bg-icon-green  { color: #16a34a; }

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

    /* Type badge */
    .type-pill {
        display: inline-flex; align-items: center; gap: 8px;
        background: #ede9fe; color: #6d28d9; border-radius: 20px;
        padding: 6px 16px; font-size: 14px; font-weight: 700;
    }

    /* Action buttons */
    .action-wrap { display: flex; gap: 6px; }
    .act-btn { width: 34px; height: 34px; border-radius: 9px; border: none; display: flex; align-items: center; justify-content: center; font-size: 14px; cursor: pointer; transition: opacity .2s; text-decoration: none; }
    .act-btn:hover { opacity: .82; }
    .act-btn-edit  { background: #e0f2fe; color: #0284c7; }
    .act-btn-del   { background: #fee2e2; color: #dc2626; }

    /* Empty state */
    .empty-state { padding: 60px 20px; text-align: center; color: #94a3b8; }
    .empty-state i { font-size: 48px; margin-bottom: 14px; display: block; }
    .empty-state p { font-size: 15px; }

    /* Pagination wrapper */
    .pagination-wrap { padding: 16px 26px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; border-top: 1.5px solid #f1f5f9; }
    .pagination-wrap .pagination { margin: 0; }
</style>
@endpush

@section('content')
<div class="expense-types-page">

    {{-- ── Header ── --}}
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-header-icon">
                <i class="fas fa-tags"></i>
            </div>
            <div>
                <h1 class="page-title">{{ __('messages.expense_categories_types') }}</h1>
                <p class="page-subtitle">{{ __('messages.expense_types_subtitle') }}</p>
            </div>
        </div>
        <div class="header-right">
            {{-- Live Search --}}
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="liveSearch" class="search-input"
                       placeholder="{{ __('messages.search_categories') }}" autocomplete="off">
                <span id="searchClearBtn" style="display:none;position:absolute;right:12px;top:50%;transform:translateY(-50%);cursor:pointer;color:#94a3b8;font-size:13px;" onclick="clearSearch()">
                    <i class="fas fa-times"></i>
                </span>
            </div>

            {{-- Add Type Button --}}
            @can('expense-create')
            <a href="{{ route('expense_types.create') }}" class="btn-add-type">
                <i class="fas fa-plus"></i> {{ __('messages.create_new_type') }}
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
        <div class="stat-card stat-card-blue">
            <div>
                <div class="stat-label">{{ __('messages.total_categories') }}</div>
                <div class="stat-value">{{ $expenseTypes->total() }}</div>
            </div>
            <div class="stat-icon stat-icon-blue"><i class="fas fa-tags"></i></div>
            <i class="fas fa-folder stat-bg-icon stat-bg-icon-blue"></i>
        </div>

        <div class="stat-card stat-card-purple">
            <div>
                <div class="stat-label"> {{ __('messages.active_status') }}  </div>
                <div class="stat-value"> {{ __('messages.exp_active') }} </div>
            </div>
            <div class="stat-icon stat-icon-purple"><i class="fas fa-check-circle"></i></div>
            <i class="fas fa-shield-alt stat-bg-icon stat-bg-icon-purple"></i>
        </div>

        <div class="stat-card stat-card-green">
            <div>
                <div class="stat-label"> {{ __('messages.exp_sliplink') }} </div>
                <div class="stat-value">{{ \App\Models\Expense::count() }}</div>
            </div>
            <div class="stat-icon stat-icon-green"><i class="fas fa-receipt"></i></div>
            <i class="fas fa-file-invoice stat-bg-icon stat-bg-icon-green"></i>
        </div>
    </div>

    {{-- ── Table Card ── --}}
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <i class="fas fa-list"></i>
                <span>{{ __('messages.categories_list') }}</span>
            </div>
            <div>
                <span class="showing-text" id="showingCount">
                    Showing {{ $expenseTypes->firstItem() ?? 0 }}–{{ $expenseTypes->lastItem() ?? 0 }} of {{ $expenseTypes->total() ?? 0 }} types
                </span>
            </div>
        </div>

        <div style="overflow-x:auto;">
            <table class="cust-table">
                <thead>
                    <tr>
                        <th width="80px">#</th>
                        <th>{{ __('messages.ex_type_list') }}</th>
                        <th>{{ __('messages.description') }}</th>
                        <th width="160px" class="text-center">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($expenseTypes as $expenseType)
                    <tr class="type-row" data-search="{{ strtolower($expenseType->name . ' ' . $expenseType->description) }}">
                        <td><span class="row-num">{{ $loop->iteration + ($expenseTypes->currentPage()-1) * $expenseTypes->perPage() }}</span></td>
                        <td>
                            <span class="type-pill">
                                <i class="fas fa-tag"></i> {{ $expenseType->name }}
                            </span>
                        </td>
                        <td>
                            @if($expenseType->description)
                                <span class="text-secondary small">{{ Str::limit($expenseType->description, 70) }}</span>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="action-wrap justify-content-center">
                                @can('expense-edit')
                                <a class="act-btn act-btn-edit" href="{{ route('expense_types.edit',$expenseType->id) }}" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                @endcan
                                @can('expense-delete')
                                <button type="button" class="act-btn act-btn-del" title="Delete" onclick="confirmDelete('{{ route('expense_types.destroy', $expenseType->id) }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="initialEmptyRow">
                        <td colspan="4">
                            <div class="empty-state">
                                <i class="fas fa-folder-open"></i>
                                <p> {{ __('messages.ex_type_listfontno') }} </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                    <tr id="noResultsRow" style="display:none;">
                        <td colspan="4">
                            <div class="empty-state">
                                <i class="fas fa-search-minus"></i>
                                <p> {{ __('messages.ex_match_cata_fontno') }}       </p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap">
            <div class="show-entries">
                {{ __('messages.show') }}
                <select class="entries-select" onchange="window.location=window.location.pathname+'?per_page='+this.value">
                    @foreach([10, 25, 50, 100] as $n)
                    <option value="{{ $n }}" {{ $expenseTypes->perPage() == $n ? 'selected' : '' }}>{{ $n }}</option>
                    @endforeach
                </select>
                {{ __('messages.entries') }}
            </div>
            {!! $expenseTypes->links() !!}
        </div>
    </div>

</div>

@push('scripts')
<script>
/* ── Live Instant Search ── */
const searchInput   = document.getElementById('liveSearch');
const clearBtn      = document.getElementById('searchClearBtn');
const rows          = document.querySelectorAll('tr.type-row');
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
