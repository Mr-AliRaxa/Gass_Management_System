@extends('layouts.app')

@push('styles')
    <style>
        /* ── Page background ── */
        .readings-page {
            background: #f0f4ff;
            min-height: 100vh;
            padding: 24px;
        }

        /* ── Header ── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .page-header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .page-header-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            background: linear-gradient(135deg, #4e7fff 0%, #2563eb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 14px rgba(78, 127, 255, .35);
        }

        .page-header-icon i {
            color: #fff;
            font-size: 22px;
        }

        .page-title {
            font-size: 26px;
            font-weight: 800;
            color: #1a1f36;
            margin: 0;
        }

        .page-subtitle {
            font-size: 13px;
            color: #8898aa;
            margin: 0;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* Search bar */
        .search-wrapper {
            position: relative;
        }

        .search-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #aab0c0;
            font-size: 14px;
        }

        .search-input {
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 10px 16px 10px 38px;
            font-size: 14px;
            background: #fff;
            width: 220px;
            color: #3d4467;
            transition: border-color .2s, box-shadow .2s;
        }

        .search-input:focus {
            border-color: #4e7fff;
            box-shadow: 0 0 0 3px rgba(78, 127, 255, .15);
            outline: none;
        }

        .btn-pdf {
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            background: #fff;
            color: #dc2626;
            font-size: 14px;
            font-weight: 600;
            padding: 10px 18px;
            display: flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
        }

        .btn-pdf:hover {
            background: #fef2f2;
            border-color: #fca5a5;
            color: #b91c1c;
        }

        .btn-filter-toggle {
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            background: #fff;
            color: #475569;
            font-size: 14px;
            font-weight: 600;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
            transition: all .2s;
        }

        .btn-filter-toggle:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }

        .btn-add-reading {
            background: linear-gradient(135deg, #4e7fff 0%, #2563eb 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            padding: 10px 22px;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 14px rgba(78, 127, 255, .35);
            transition: opacity .2s;
            text-decoration: none;
        }

        .btn-add-reading:hover {
            opacity: .88;
            color: #fff;
        }

        /* ── Stat Cards ── */
        .stat-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        @media (max-width: 768px) {
            .stat-cards {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            border-radius: 18px;
            padding: 20px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .stat-card-blue {
            background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%);
        }

        .stat-card-green {
            background: linear-gradient(135deg, #dcfce7 0%, #f0fdf4 100%);
        }

        .stat-card-purple {
            background: linear-gradient(135deg, #ede9fe 0%, #f5f3ff 100%);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .stat-icon-blue {
            background: linear-gradient(135deg, #4e7fff, #2563eb);
            color: #fff;
            box-shadow: 0 4px 12px rgba(78, 127, 255, .35);
        }

        .stat-icon-green {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: #fff;
            box-shadow: 0 4px 12px rgba(34, 197, 94, .35);
        }

        .stat-icon-purple {
            background: linear-gradient(135deg, #a855f7, #7c3aed);
            color: #fff;
            box-shadow: 0 4px 12px rgba(168, 85, 247, .35);
        }

        .stat-label {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: #1a1f36;
            line-height: 1.1;
            margin-top: 4px;
        }

        .stat-bg-icon {
            position: absolute;
            right: 18px;
            bottom: -4px;
            font-size: 54px;
            opacity: .12;
        }

        .stat-bg-icon-blue {
            color: #2563eb;
        }

        .stat-bg-icon-green {
            color: #16a34a;
        }

        .stat-bg-icon-purple {
            color: #7c3aed;
        }

        /* ── Filter Card ── */
        .filter-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 14px rgba(30, 41, 59, .05);
            padding: 20px 24px;
            margin-bottom: 24px;
            border: 1.5px solid #edf2f7;
        }

        .filter-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .filter-title {
            font-size: 15px;
            font-weight: 700;
            color: #334155;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-label {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 6px;
        }

        .filter-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 8px 12px;
            font-size: 13px;
            color: #334155;
            width: 100%;
            transition: all .2s;
        }

        .filter-control:focus {
            border-color: #4e7fff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(78, 127, 255, .1);
        }

        /* ── Table Card ── */
        .table-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 2px 20px rgba(30, 41, 59, .07);
            overflow: hidden;
        }

        .table-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 26px 16px;
            border-bottom: 1.5px solid #f1f5f9;
            flex-wrap: wrap;
            gap: 10px;
        }

        .table-card-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .table-card-title i {
            color: #4e7fff;
            font-size: 20px;
        }

        .table-card-title span {
            font-size: 18px;
            font-weight: 700;
            color: #1a1f36;
        }

        .showing-text {
            font-size: 13px;
            color: #94a3b8;
        }

        /* ── Table ── */
        .cust-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .cust-table thead tr {
            background: #f8fafc;
        }

        .cust-table thead th {
            padding: 13px 18px;
            font-size: 12px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .5px;
            border-bottom: 1.5px solid #f1f5f9;
        }

        .cust-table tbody tr {
            transition: background .15s;
        }

        .cust-table tbody tr:hover {
            background: #f8fafc;
        }

        .cust-table tbody td {
            padding: 14px 18px;
            font-size: 14px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .cust-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Date badge */
        .date-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f8fafc;
            color: #475569;
            border-radius: 10px;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 600;
            border: 1px solid #e2e8f0;
        }

        /* Reading badges */
        .reading-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f1f5f9;
            color: #334155;
            border-radius: 20px;
            padding: 5px 12px;
            font-size: 13px;
            font-weight: 700;
        }

        .consumption-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #e0f2fe;
            color: #0284c7;
            border-radius: 20px;
            padding: 5px 14px;
            font-size: 13px;
            font-weight: 800;
        }

        /* Action buttons */
        .action-wrap {
            display: flex;
            gap: 6px;
        }

        .act-btn {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            cursor: pointer;
            transition: opacity .2s;
            text-decoration: none;
        }

        .act-btn:hover {
            opacity: .82;
        }

        .act-btn-view {
            background: #dbeafe;
            color: #2563eb;
        }

        .act-btn-edit {
            background: #e0f2fe;
            color: #0284c7;
        }

        .act-btn-del {
            background: #fee2e2;
            color: #dc2626;
        }

        /* Empty state */
        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 14px;
            display: block;
        }

        .empty-state p {
            font-size: 15px;
        }

        /* Pagination wrapper */
        .pagination-wrap {
            padding: 16px 26px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: gap;
            gap: 10px;
            border-top: 1.5px solid #f1f5f9;
        }

        .pagination-wrap .pagination {
            margin: 0;
        }
    </style>
@endpush

@section('content')
    <div class="readings-page">

        {{-- ── Header ── --}}
        <div class="page-header">
            <div class="page-header-left">
                <div class="page-header-icon">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <div>
                    <h1 class="page-title">{{ __('messages.gas_readings_consumption') }}</h1>
                    <p class="page-subtitle">{{ __('messages.gas_readings_subtitle') }}</p>
                </div>
            </div>
            <div class="header-right">
                {{-- Live Search --}}
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" id="liveSearch" class="search-input" placeholder="{{ __('messages.search_readings') }}"
                        autocomplete="off">
                    <span id="searchClearBtn"
                        style="display:none;position:absolute;right:12px;top:50%;transform:translateY(-50%);cursor:pointer;color:#94a3b8;font-size:13px;"
                        onclick="clearSearch()">
                        <i class="fas fa-times"></i>
                    </span>
                </div>

                {{-- Download PDF --}}
                <a class="btn-pdf" id="pdfDownloadBtn" href="{{ route('gas_readings.downloadPdf', request()->all()) }}">
                    <i class="fas fa-file-pdf"></i> {{ __('messages.download_pdf') }}
                </a>

                {{-- Toggle Filter --}}
                <button class="btn-filter-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#filterBox"
                    aria-expanded="false">
                    <i class="fas fa-filter"></i> {{ __('messages.filters') }}
                </button>

                {{-- Add Reading --}}
                @can('gas-reading-create')
                    <a href="{{ route('gas_readings.create') }}" class="btn-add-reading">
                        <i class="fas fa-plus"></i> {{ __('messages.add_reading') }}
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
            $today = now()->toDateString();
            $todayReading = \App\Models\GasReading::whereDate('date', $today)->first();
            $todayConsumption = $todayReading ? ($todayReading->end_reading - $todayReading->start_reading) : 0;
            $totalEntries = \App\Models\GasReading::count();
            $totalLitresUsed = \App\Models\GasReading::selectRaw('SUM(end_reading - start_reading) as total')->value('total') ?? 0;
        @endphp
        <div class="stat-cards">
            <div class="stat-card stat-card-blue">
                <div>
                    <div class="stat-label">{{ __('messages.todays_consumption') }}</div>
                    <div class="stat-value">{{ number_format($todayConsumption, 3) }} <span
                            style="font-size:13px;font-weight:600;">Ton</span></div>
                </div>
                <div class="stat-icon stat-icon-blue"><i class="fas fa-gas-pump"></i></div>
                <i class="fas fa-tint stat-bg-icon stat-bg-icon-blue"></i>
            </div>

            <div class="stat-card stat-card-green">
                <div>
                    <div class="stat-label">{{ __('messages.all_time_consumption') }}</div>
                    <div class="stat-value">{{ number_format($totalLitresUsed, 3) }} <span
                            style="font-size:13px;font-weight:600;">Ton</span></div>
                </div>
                <div class="stat-icon stat-icon-green"><i class="fas fa-chart-line"></i></div>
                <i class="fas fa-burn stat-bg-icon stat-bg-icon-green"></i>
            </div>

            <div class="stat-card stat-card-purple">
                <div>
                    <div class="stat-label"> {{ __('messages.MeterLogsCount') }}</div>
                    <div class="stat-value">{{ $totalEntries }}</div>
                </div>
                <div class="stat-icon stat-icon-purple"><i class="fas fa-list-ol"></i></div>
                <i class="fas fa-tachometer-alt stat-bg-icon stat-bg-icon-purple"></i>
            </div>
        </div>

        {{-- ── Collapsible Date Filter ── --}}
        <div class="collapse {{ (request('date') || request('from_date') || request('to_date')) ? 'show' : '' }}" id="filterBox">
            <div class="filter-card">
                <div class="filter-header">
                    <span class="filter-title"><i class="fas fa-sliders-h text-primary"></i> Filter Meter Reading</span>
                    @if(request('date') || request('from_date') || request('to_date'))
                        <a href="{{ route('gas_readings.index') }}"
                            class="btn btn-sm btn-outline-secondary rounded-pill px-3">Clear Filters</a>
                    @endif
                </div>
                <form action="{{ route('gas_readings.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="filter-label">Single Date</div>
                            <input type="date" name="date" class="filter-control" value="{{ request('date') }}">
                        </div>
                        <div class="col-md-1 d-flex align-items-end justify-content-center pb-1">
                            <span class="text-muted font-weight-bold" style="font-size:12px;">OR</span>
                        </div>
                        <div class="col-md-3">
                            <div class="filter-label">From Date</div>
                            <input type="date" name="from_date" class="filter-control" value="{{ request('from_date') }}">
                        </div>
                        <div class="col-md-3">
                            <div class="filter-label">To Date</div>
                            <input type="date" name="to_date" class="filter-control" value="{{ request('to_date') }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100 rounded-3 font-weight-bold"
                                style="padding:8px 16px;">
                                <i class="fas fa-search me-1"></i> Apply
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
                    <i class="fas fa-clipboard-list"></i>
                    <span>{{ __('messages.gas_reading_history') }}</span>
                </div>
                <div>
                    <span class="showing-text" id="showingCount">
                        Showing {{ $gasReadings->firstItem() ?? 0 }}–{{ $gasReadings->lastItem() ?? 0 }} of
                        {{ $gasReadings->total() ?? 0 }} records
                    </span>
                </div>
            </div>

            <div style="overflow-x:auto;">
                <table class="cust-table">
                    <thead>
                        <tr>
                            <th>{{ __('messages.date') }}</th>
                            <th>{{ __('messages.start_meter_level') }}</th>
                            <th>{{ __('messages.end_meter_level') }}</th>
                            <th>{{ __('messages.total_consumption12') }}</th>
                            <th width="180px">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gasReadings as $reading)
                            @php
                                $consumption = $reading->end_reading - $reading->start_reading;
                            @endphp
                            <tr class="reading-row"
                                data-search="{{ strtolower($reading->date . ' ' . $reading->start_reading . ' ' . $reading->end_reading . ' ' . $consumption) }}">
                                <td>
                                    <span class="date-badge">
                                        <i class="far fa-calendar-alt text-primary"></i>
                                        {{ \Carbon\Carbon::parse($reading->date)->format('d M Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="reading-pill">
                                        <i class="fas fa-play text-muted"></i> {{ number_format($reading->start_reading, 3) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="reading-pill">
                                        <i class="fas fa-stop text-muted"></i> {{ number_format($reading->end_reading, 3) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="consumption-pill">
                                        <i class="fas fa-burn"></i>   {{ number_format($consumption, 3) }} {{ __('messages.GAS_TON') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-wrap">
                                        <a href="{{ route('gas_readings.show', $reading->id) }}" class="act-btn act-btn-view"
                                            title="View"><i class="fas fa-eye"></i></a>
                                        @can('gas-reading-edit')
                                            <a href="{{ route('gas_readings.edit', $reading->id) }}" class="act-btn act-btn-edit"
                                                title="Edit"><i class="fas fa-pen"></i></a>
                                        @endcan
                                        @can('gas-reading-delete')
                                            <button type="button" class="act-btn act-btn-del" title="Delete"
                                                onclick="confirmDelete('{{ route('gas_readings.destroy', $reading->id) }}')">
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
                                        <i class="fas fa-tachometer-alt"></i>
                                        <p>No gas meter readings found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                        <tr id="noResultsRow" style="display:none;">
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="fas fa-search-minus"></i>
                                    <p>No matching gas readings found.</p>
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
                        <option value="{{ $n }}" {{ $gasReadings->perPage() == $n ? 'selected' : '' }}>{{ $n }}</option>
                        @endforeach
                    </select>
                    {{ __('messages.entries') }}
                </div>
                {!! $gasReadings->appends(request()->input())->links() !!}
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            /* ── Live Instant Search ── */
            const searchInput = document.getElementById('liveSearch');
            const clearBtn = document.getElementById('searchClearBtn');
            const rows = document.querySelectorAll('tr.reading-row');
            const showingText = document.getElementById('showingCount');
            const noResultsRow = document.getElementById('noResultsRow');

            if (showingText) {
                showingText.setAttribute('data-original', showingText.textContent);
            }

            function runSearch() {
                const term = searchInput.value.trim().toLowerCase();
                clearBtn.style.display = term ? 'inline' : 'none';

                let visible = 0;
                rows.forEach(row => {
                    const haystack = row.getAttribute('data-search') || '';
                    const match = haystack.includes(term);
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