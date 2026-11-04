@extends('layouts.app')

@push('styles')
<style>
    /* ── Page background ── */
    .users-page { background: #f0f4ff; min-height: 100vh; padding: 24px; }

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

    .btn-add-user {
        background: linear-gradient(135deg, #4e7fff 0%, #2563eb 100%);
        color: #fff; border: none; border-radius: 12px; font-size: 14px; font-weight: 700;
        padding: 10px 22px; display: flex; align-items: center; gap: 8px;
        box-shadow: 0 4px 14px rgba(78,127,255,.35); transition: opacity .2s;
        text-decoration: none;
    }
    .btn-add-user:hover { opacity: .88; color: #fff; }

    /* ── Stat Cards ── */
    .stat-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px; }
    @media (max-width: 768px) { .stat-cards { grid-template-columns: 1fr; } }

    .stat-card {
        border-radius: 18px; padding: 20px 22px; display: flex;
        align-items: center; justify-content: space-between; position: relative; overflow: hidden;
    }
    .stat-card-blue   { background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%); }
    .stat-card-green  { background: linear-gradient(135deg, #dcfce7 0%, #f0fdf4 100%); }
    .stat-card-purple { background: linear-gradient(135deg, #ede9fe 0%, #f5f3ff 100%); }

    .stat-icon {
        width: 52px; height: 52px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;
    }
    .stat-icon-blue   { background: linear-gradient(135deg, #4e7fff, #2563eb); color: #fff; box-shadow: 0 4px 12px rgba(78,127,255,.35); }
    .stat-icon-green  { background: linear-gradient(135deg, #22c55e, #16a34a); color: #fff; box-shadow: 0 4px 12px rgba(34,197,94,.35); }
    .stat-icon-purple { background: linear-gradient(135deg, #a855f7, #7c3aed); color: #fff; box-shadow: 0 4px 12px rgba(168,85,247,.35); }

    .stat-label { font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: .5px; }
    .stat-value { font-size: 28px; font-weight: 800; color: #1a1f36; line-height: 1.1; margin-top: 4px; }

    .stat-bg-icon { position: absolute; right: 18px; bottom: -4px; font-size: 54px; opacity: .12; }
    .stat-bg-icon-blue   { color: #2563eb; }
    .stat-bg-icon-green  { color: #16a34a; }
    .stat-bg-icon-purple { color: #7c3aed; }

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

    /* Avatar */
    .cust-avatar-placeholder { width: 40px; height: 40px; border-radius: 12px; background: linear-gradient(135deg, #4e7fff, #2563eb); display: inline-flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 15px; }
    .cust-name-wrap { display: flex; align-items: center; gap: 12px; }
    .cust-name { font-weight: 700; color: #1a1f36; font-size: 14px; }
    .cust-online-dot { width: 9px; height: 9px; border-radius: 50%; background: #22c55e; display: inline-block; margin-right: 4px; }

    /* Role badges */
    .role-badge {
        display: inline-flex; align-items: center; gap: 5px;
        background: #eff6ff; color: #2563eb; border-radius: 16px;
        padding: 5px 12px; font-size: 12px; font-weight: 700; margin-right: 4px;
    }
    .role-badge-super {
        background: #fef3c7; color: #b45309;
    }

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
<div class="users-page">

    {{-- ── Header ── --}}
    <div class="page-header">
        <div class="page-header-left">
            <div class="page-header-icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <div>
                <h1 class="page-title">{{ __('messages.users_roles_mgmt') }}</h1>
                <p class="page-subtitle">{{ __('messages.users_roles_subtitle') }}</p>
            </div>
        </div>
        <div class="header-right">
            {{-- Live Search --}}
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="liveSearch" class="search-input"
                       placeholder="{{ __('messages.search_users') }}" autocomplete="off">
                <span id="searchClearBtn" style="display:none;position:absolute;right:12px;top:50%;transform:translateY(-50%);cursor:pointer;color:#94a3b8;font-size:13px;" onclick="clearSearch()">
                    <i class="fas fa-times"></i>
                </span>
            </div>

            {{-- Add User Button --}}
            @can('user-create')
            <a href="{{ route('users.create') }}" class="btn-add-user">
                <i class="fas fa-plus"></i> {{ __('messages.create_user') }}
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
                <div class="stat-label">{{ __('messages.total_users') }}</div>
                <div class="stat-value">{{ $data->total() }}</div>
            </div>
            <div class="stat-icon stat-icon-blue"><i class="fas fa-users"></i></div>
            <i class="fas fa-user-friends stat-bg-icon stat-bg-icon-blue"></i>
        </div>

        <div class="stat-card stat-card-green">
            <div>
                <div class="stat-label">{{ __('messages.active_logins') }}</div>
                <div class="stat-value">{{ \App\Models\LoginLog::whereDate('login_at', today())->distinct('user_id')->count() }}</div>
            </div>
            <div class="stat-icon stat-icon-green"><i class="fas fa-user-check"></i></div>
            <i class="fas fa-shield-alt stat-bg-icon stat-bg-icon-green"></i>
        </div>

        <div class="stat-card stat-card-purple">
            <div>
                <div class="stat-label">{{ __('messages.roles_configured') }}</div>
                <div class="stat-value">{{ \Spatie\Permission\Models\Role::count() }}</div>
            </div>
            <div class="stat-icon stat-icon-purple"><i class="fas fa-user-tag"></i></div>
            <i class="fas fa-id-badge stat-bg-icon stat-bg-icon-purple"></i>
        </div>
    </div>

    {{-- ── Table Card ── --}}
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <i class="fas fa-users-cog"></i>
                <span>{{ __('messages.system_users') }}</span>
            </div>
            <div>
                <span class="showing-text" id="showingCount">
                    Showing {{ $data->firstItem() ?? 0 }}–{{ $data->lastItem() ?? 0 }} of {{ $data->total() ?? 0 }} users
                </span>
            </div>
        </div>

        <div style="overflow-x:auto;">
            <table class="cust-table">
                <thead>
                    <tr>
                        <th width="70px">#</th>
                        <th>{{ __('messages.user_name') }}</th>
                        <th>{{ __('messages.email_address') }}</th>
                        <th>{{ __('messages.assigned_roles') }}</th>
                        <th width="180px">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $key => $user)
                    @php
                        $roleNames = $user->getRoleNames()->implode(' ');
                    @endphp
                    <tr class="user-row" data-search="{{ strtolower($user->name . ' ' . $user->email . ' ' . $roleNames) }}">
                        <td><span class="row-num">{{ $loop->iteration + ($data->currentPage()-1) * $data->perPage() }}</span></td>
                        <td>
                            <div class="cust-name-wrap">
                                <div class="cust-avatar-placeholder">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="cust-name">
                                        <span class="cust-online-dot"></span>{{ $user->name }}
                                        @if($user->isAgencyOwner())
                                            <span class="badge ms-1" style="background: #eef2ff; color: #4338ca; border: 1px solid #c7d2fe; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 6px;" title="{{ __('messages.owner_protected_tooltip') }}">
                                                <i class="fas fa-crown text-warning me-1"></i>{{ __('messages.owner') }}
                                            </span>
                                        @endif
                                    </div>
                                    <small class="text-muted">ID: #USR-{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-muted"><i class="far fa-envelope me-1"></i>{{ $user->email }}</span>
                        </td>
                        <td>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <span class="role-badge {{ $v == 'Super Admin' ? 'role-badge-super' : '' }}">
                                        <i class="fas fa-shield-alt"></i> {{ $v }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-wrap">
                                <a class="act-btn act-btn-view" href="{{ route('users.show',$user->id) }}" title="{{ __('messages.view') }}"><i class="fas fa-eye"></i></a>
                                @if($user->hasRole('Super Admin'))
                                    {{-- Super Admin: fully locked --}}
                                    <span class="badge" style="background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0;font-size:11px;padding:6px 10px;border-radius:8px;">
                                        <i class="fas fa-lock me-1"></i>{{ __('messages.system_protected') }}
                                    </span>
                                @elseif($user->isAgencyOwner())
                                    {{-- Agency Owner: can be edited but NOT deleted --}}
                                    @can('user-edit')
                                    <a class="act-btn act-btn-edit" href="{{ route('users.edit',$user->id) }}" title="{{ __('messages.edit') }}"><i class="fas fa-pen"></i></a>
                                    @endcan
                                    <span class="badge" title="{{ __('messages.owner_protected_tooltip') }}" style="background:#fef3c7;color:#92400e;border:1px solid #fde68a;font-size:11px;padding:6px 10px;border-radius:8px;cursor:help;">
                                        <i class="fas fa-crown me-1" style="color:#d97706;"></i>{{ __('messages.owner_protected') }}
                                    </span>
                                @else
                                    {{-- Normal sub-user: edit & delete allowed --}}
                                    @can('user-edit')
                                    <a class="act-btn act-btn-edit" href="{{ route('users.edit',$user->id) }}" title="{{ __('messages.edit') }}"><i class="fas fa-pen"></i></a>
                                    @endcan
                                    @can('user-delete')
                                    <button type="button" class="act-btn act-btn-del" title="{{ __('messages.delete') }}" onclick="confirmDelete('{{ route('users.destroy', $user->id) }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endcan
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="initialEmptyRow">
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-users-slash"></i>
                                <p>No users found.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                    <tr id="noResultsRow" style="display:none;">
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-search-minus"></i>
                                <p>No matching users found.</p>
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
                    <option value="{{ $n }}" {{ $data->perPage() == $n ? 'selected' : '' }}>{{ $n }}</option>
                    @endforeach
                </select>
                {{ __('messages.entries') }}
            </div>
            {!! $data->links() !!}
        </div>
    </div>

</div>

@push('scripts')
<script>
/* ── Live Instant Search ── */
const searchInput   = document.getElementById('liveSearch');
const clearBtn      = document.getElementById('searchClearBtn');
const rows          = document.querySelectorAll('tr.user-row');
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
