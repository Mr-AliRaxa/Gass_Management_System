@extends('layouts.app')

@push('styles')
<style>
    /* ── Page background ── */
    .visa-page { background: #f0f4ff; min-height: 100vh; padding: 24px; }

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

    .btn-add-visa {
        background: linear-gradient(135deg, #4e7fff 0%, #2563eb 100%);
        color: #fff; border: none; border-radius: 12px; font-size: 14px; font-weight: 700;
        padding: 10px 22px; display: flex; align-items: center; gap: 8px;
        box-shadow: 0 4px 14px rgba(78,127,255,.35); transition: opacity .2s;
        text-decoration: none;
    }
    .btn-add-visa:hover { opacity: .88; color: #fff; }

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
    .stat-card-orange { background: linear-gradient(135deg, #fef3c7 0%, #fffbeb 100%); }
    .stat-card-red    { background: linear-gradient(135deg, #fee2e2 0%, #fef2f2 100%); }

    .stat-icon {
        width: 52px; height: 52px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;
    }
    .stat-icon-blue   { background: linear-gradient(135deg, #4e7fff, #2563eb); color: #fff; box-shadow: 0 4px 12px rgba(78,127,255,.35); }
    .stat-icon-green  { background: linear-gradient(135deg, #22c55e, #16a34a); color: #fff; box-shadow: 0 4px 12px rgba(34,197,94,.35); }
    .stat-icon-orange { background: linear-gradient(135deg, #f59e0b, #d97706); color: #fff; box-shadow: 0 4px 12px rgba(245,158,11,.35); }
    .stat-icon-red    { background: linear-gradient(135deg, #ef4444, #dc2626); color: #fff; box-shadow: 0 4px 12px rgba(239,68,68,.35); }

    .stat-label { font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: .5px; }
    .stat-value { font-size: 28px; font-weight: 800; color: #1a1f36; line-height: 1.1; margin-top: 4px; }

    .stat-bg-icon { position: absolute; right: 18px; bottom: -4px; font-size: 54px; opacity: .12; }
    .stat-bg-icon-blue   { color: #2563eb; }
    .stat-bg-icon-green  { color: #16a34a; }
    .stat-bg-icon-orange { color: #d97706; }
    .stat-bg-icon-red    { color: #dc2626; }

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

    /* Date badge */
    .date-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: #f8fafc; color: #475569; border-radius: 10px;
        padding: 6px 12px; font-size: 13px; font-weight: 600; border: 1px solid #e2e8f0;
    }

    /* Avatar */
    .cust-avatar { width: 40px; height: 40px; border-radius: 12px; object-fit: cover; background: #e2e8f0; }
    .cust-avatar-placeholder { width: 40px; height: 40px; border-radius: 12px; background: linear-gradient(135deg, #4e7fff, #2563eb); display: inline-flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 15px; }
    .cust-name-wrap { display: flex; align-items: center; gap: 12px; }
    .cust-name { font-weight: 700; color: #1a1f36; font-size: 14px; }
    .cust-code { font-size: 11px; color: #94a3b8; font-weight: 600; margin-top: 2px; }

    /* Status badges */
    .status-badge {
        display: inline-flex; align-items: center; gap: 6px;
        border-radius: 20px; padding: 6px 14px; font-size: 12px; font-weight: 700;
    }
    .status-valid   { background: #dcfce7; color: #15803d; }
    .status-warning { background: #fef3c7; color: #b45309; }
    .status-expired { background: #fee2e2; color: #b91c1c; }

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
</style>
@endpush

@section('content')
<div class="visa-page">

    {{-- ── Header ── --}}
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-header-icon">
                <i class="fas fa-passport"></i>
            </div>
            <div>
                <h1 class="page-title">{{ __('messages.visa_management') }}</h1>
                <p class="page-subtitle">{{ __('messages.visa_management_desc') }}</p>
            </div>
        </div>
        <div class="header-right">
            {{-- Live Search --}}
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="liveSearch" class="search-input"
                       placeholder="{{ __('messages.search_visas') }}" autocomplete="off">
                <span id="searchClearBtn" style="display:none;position:absolute;right:12px;top:50%;transform:translateY(-50%);cursor:pointer;color:#94a3b8;font-size:13px;" onclick="clearSearch()">
                    <i class="fas fa-times"></i>
                </span>
            </div>

            {{-- Download Report PDF --}}
            <a class="btn-pdf" href="{{ route('visa_details.downloadPdf') }}">
                <i class="fas fa-file-pdf"></i> {{ __('messages.download_report') }}
            </a>

            {{-- Add Visa Button --}}
            @can('visa-detail-create')
            <a href="{{ route('visa_details.create') }}" class="btn-add-visa">
                <i class="fas fa-plus"></i> {{ __('messages.add_visa') }}
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
    @php
        $allVisas = \App\Models\VisaDetail::all();
        $totalVisas = $allVisas->count();
        $validVisas = 0;
        $expiringSoon = 0;
        $expiredVisas = 0;

        foreach($allVisas as $v) {
            $diff = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($v->expiry_date), false);
            if ($diff < 0) {
                $expiredVisas++;
            } elseif ($diff < 30) {
                $expiringSoon++;
            } else {
                $validVisas++;
            }
        }
    @endphp
    <div class="stat-cards">
        <div class="stat-card stat-card-blue">
            <div>
                <div class="stat-label">{{ __('messages.total_visas') }}</div>
                <div class="stat-value">{{ $totalVisas }}</div>
            </div>
            <div class="stat-icon stat-icon-blue"><i class="fas fa-passport"></i></div>
            <i class="fas fa-id-card stat-bg-icon stat-bg-icon-blue"></i>
        </div>

        <div class="stat-card stat-card-green">
            <div>
                <div class="stat-label">{{ __('messages.valid_visas') }}</div>
                <div class="stat-value">{{ $validVisas }}</div>
            </div>
            <div class="stat-icon stat-icon-green"><i class="fas fa-check-circle"></i></div>
            <i class="fas fa-shield-alt stat-bg-icon stat-bg-icon-green"></i>
        </div>

        <div class="stat-card stat-card-orange">
            <div>
                <div class="stat-label">{{ __('messages.expiring_soon_30') }}</div>
                <div class="stat-value">{{ $expiringSoon }}</div>
            </div>
            <div class="stat-icon stat-icon-orange"><i class="fas fa-exclamation-triangle"></i></div>
            <i class="fas fa-hourglass-half stat-bg-icon stat-bg-icon-orange"></i>
        </div>

        <div class="stat-card stat-card-red">
            <div>
                <div class="stat-label">{{ __('messages.expired_visas') }}</div>
                <div class="stat-value">{{ $expiredVisas }}</div>
            </div>
            <div class="stat-icon stat-icon-red"><i class="fas fa-times-circle"></i></div>
            <i class="fas fa-ban stat-bg-icon stat-bg-icon-red"></i>
        </div>
    </div>

    {{-- ── Table Card ── --}}
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <i class="fas fa-list-alt"></i>
                <span>{{ __('messages.visa_records') }}</span>
            </div>
            <div>
                <span class="showing-text" id="showingCount">
                    Showing {{ $visaDetails->firstItem() ?? 0 }}–{{ $visaDetails->lastItem() ?? 0 }} of {{ $visaDetails->total() ?? 0 }} visas
                </span>
            </div>
        </div>

        <div style="overflow-x:auto;">
            <table class="cust-table">
                <thead>
                    <tr>
                        <th>{{ __('messages.team_member') }}</th>
                        <th>{{ __('messages.issue_date') }}</th>
                        <th>{{ __('messages.expiry_date') }}</th>
                        <th>{{ __('messages.validity_status') }}</th>
                        <th width="180px">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($visaDetails as $visa)
                    @php
                        $daysLeft = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($visa->expiry_date), false);
                        $statusText = $daysLeft < 0 ? 'Expired' : ($daysLeft < 30 ? 'Expiring Soon' : 'Valid');
                        $statusClass = $daysLeft < 0 ? 'status-expired' : ($daysLeft < 30 ? 'status-warning' : 'status-valid');
                        $iconClass = $daysLeft < 0 ? 'fa-times-circle' : ($daysLeft < 30 ? 'fa-exclamation-circle' : 'fa-check-circle');
                    @endphp
                    <tr class="visa-row" data-search="{{ strtolower(($visa->teamMember->name ?? '') . ' ' . $visa->issue_date . ' ' . $visa->expiry_date . ' ' . $statusText) }}">
                        <td>
                            <div class="cust-name-wrap">
                                @if(optional($visa->teamMember)->profile_pic)
                                    <img src="{{ asset('storage/'.$visa->teamMember->profile_pic) }}"
                                         alt="{{ $visa->teamMember->name }}" class="cust-avatar">
                                @else
                                    <div class="cust-avatar-placeholder">
                                        {{ strtoupper(substr($visa->teamMember->name ?? 'M', 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="cust-name">{{ $visa->teamMember->name ?? 'N/A' }}</div>
                                    <div class="cust-code">{{ $visa->teamMember->designation ?? 'Team Member' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="date-badge">
                                <i class="far fa-calendar-check text-muted"></i>
                                {{ \Carbon\Carbon::parse($visa->issue_date)->format('d M Y') }}
                            </span>
                        </td>
                        <td>
                            <span class="date-badge">
                                <i class="far fa-calendar-times text-danger"></i>
                                {{ \Carbon\Carbon::parse($visa->expiry_date)->format('d M Y') }}
                            </span>
                        </td>
                        <td>
                            <span class="status-badge {{ $statusClass }}">
                                <i class="fas {{ $iconClass }}"></i>
                                {{ $statusText }}
                                @if($daysLeft >= 0 && $daysLeft < 30)
                                    ({{ $daysLeft }}d left)
                                @endif
                            </span>
                        </td>
                        <td>
                            <div class="action-wrap">
                                <a href="{{ route('visa_details.show',$visa->id) }}" class="act-btn act-btn-view" title="View"><i class="fas fa-eye"></i></a>
                                @can('visa-detail-edit')
                                <a href="{{ route('visa_details.edit',$visa->id) }}" class="act-btn act-btn-edit" title="Edit"><i class="fas fa-pen"></i></a>
                                @endcan
                                @can('visa-detail-delete')
                                <button type="button" class="act-btn act-btn-del" title="Delete" onclick="confirmDelete('{{ route('visa_details.destroy', $visa->id) }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="initialEmptyRow">
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-passport"></i>
                                <p>No visa records found.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                    <tr id="noResultsRow" style="display:none;">
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-search-minus"></i>
                                <p>No matching visa records found.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap">
            <div></div>
            {!! $visaDetails->links() !!}
        </div>
    </div>

</div>

@push('scripts')
<script>
/* ── Live Instant Search ── */
const searchInput   = document.getElementById('liveSearch');
const clearBtn      = document.getElementById('searchClearBtn');
const rows          = document.querySelectorAll('tr.visa-row');
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
