<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Customer Sales & Cylinder Report</title>
    <style>
        @page {
            margin: 15mm 12mm 15mm 12mm;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }
        .header-table {
            width: 100%;
            border-bottom: 2px solid #4f46e5;
            padding-bottom: 12px;
            margin-bottom: 15px;
        }
        .agency-title {
            font-size: 20px;
            font-weight: bold;
            color: #1e1b4b;
            margin: 0 0 4px 0;
        }
        .report-title {
            font-size: 15px;
            font-weight: bold;
            color: #4f46e5;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .meta-text {
            font-size: 10px;
            color: #64748b;
        }

        /* Summary Boxes */
        .summary-table {
            width: 100%;
            margin-bottom: 15px;
            border-collapse: separate;
            border-spacing: 8px 0;
        }
        .summary-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 8px 10px;
            text-align: center;
        }
        .summary-box-title {
            font-size: 9px;
            text-transform: uppercase;
            font-weight: bold;
            color: #64748b;
            margin-bottom: 3px;
        }
        .summary-box-val {
            font-size: 16px;
            font-weight: bold;
            color: #0f172a;
        }
        .summary-box-sub {
            font-size: 9px;
            color: #475569;
            margin-top: 2px;
        }

        /* Customer spotlight if selected */
        .customer-card {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 6px;
            padding: 8px 12px;
            margin-bottom: 15px;
        }

        /* Main Data Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        .data-table th, .data-table td {
            border: 1px solid #cbd5e1;
            padding: 6px 6px;
            font-size: 10px;
        }
        .data-table thead th {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9px;
            letter-spacing: 0.3px;
            text-align: center;
        }
        .th-filled {
            background-color: #dbeafe !important;
            color: #1e40af !important;
        }
        .th-new {
            background-color: #dcfce7 !important;
            color: #166534 !important;
        }
        .th-main {
            background-color: #f1f5f9 !important;
            color: #334155 !important;
        }
        .text-center { text-align: center; }
        .text-end    { text-align: right; }
        .text-start  { text-align: left; }
        .font-bold   { font-weight: bold; }

        /* Row styling */
        .data-table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .col-filled-total {
            background-color: #eff6ff;
            font-weight: bold;
            color: #1e3a8a;
        }
        .col-new-total {
            background-color: #f0fdf4;
            font-weight: bold;
            color: #14532d;
        }

        /* Footer Total Row */
        .data-table tfoot td {
            background-color: #e2e8f0;
            font-weight: bold;
            font-size: 10px;
            border-top: 2px solid #64748b;
        }

        /* Page Footer */
        .footer-table {
            width: 100%;
            margin-top: 20px;
            border-top: 1px solid #e2e8f0;
            padding-top: 8px;
            font-size: 9px;
            color: #94a3b8;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <table class="header-table">
        <tr>
            <td style="width: 65%; vertical-align: top;">
                @if(optional($setting)->agency_name)
                    <div class="agency-title">{{ $setting->agency_name }}</div>
                @else
                    <div class="agency-title">{{ config('app.name', 'Gas Agency System') }}</div>
                @endif
                <div class="report-title">Customers Sales & Cylinder Report</div>
                <div class="meta-text" style="margin-top: 4px;">
                    Detailed breakdown of Filled (Refill) & New cylinder sales
                </div>
            </td>
            <td style="width: 35%; text-align: right; vertical-align: top;">
                <div class="meta-text">
                    <strong>Generated Date:</strong> {{ now()->format('d M Y, h:i A') }}
                </div>
                <div class="meta-text" style="margin-top: 3px;">
                    <strong>Report Period:</strong> 
                    {{ $fromDate ? \Carbon\Carbon::parse($fromDate)->format('d/m/Y') : 'All Time' }} 
                    - 
                    {{ $toDate ? \Carbon\Carbon::parse($toDate)->format('d/m/Y') : 'Present' }}
                </div>
                @if(optional($setting)->phone)
                    <div class="meta-text" style="margin-top: 3px;">
                        <strong>Phone:</strong> {{ $setting->phone }}
                    </div>
                @endif
            </td>
        </tr>
    </table>

    <!-- Customer Details if Single Customer Selected -->
    @if($selectedCustomer)
    <div class="customer-card">
        <table style="width: 100%;">
            <tr>
                <td style="width: 50%;">
                    <strong style="font-size: 13px; color: #1e3a8a;">Customer: {{ \App\Helpers\ArabicHelper::shape($selectedCustomer->name) }}</strong>
                    <div class="meta-text" style="margin-top: 2px;">
                        Phone: {{ $selectedCustomer->mobile ?? 'N/A' }} | Address: {{ $selectedCustomer->address ?? 'N/A' }}
                    </div>
                </td>
                <td style="width: 50%; text-align: right;">
                    <span style="font-size: 11px; font-weight: bold; color: #1e3a8a;">
                        Filtered Purchases: {{ number_format($totals['grand_amount'], 3) }} OMR ({{ $sales->count() }} Invoices)
                    </span>
                </td>
            </tr>
        </table>
    </div>
    @endif

    <!-- Summary Overview Tiles -->
    <table class="summary-table">
        <tr>
            <td style="width: 25%;">
                <div class="summary-box">
                    <div class="summary-box-title">Total Sales Revenue</div>
                    <div class="summary-box-val" style="color: #4f46e5;">{{ number_format($totals['grand_amount'], 3) }} OMR</div>
                    <div class="summary-box-sub">{{ $sales->count() }} Total Invoices</div>
                </div>
            </td>
            <td style="width: 25%;">
                <div class="summary-box">
                    <div class="summary-box-title">Filled Cylinders (Refill)</div>
                    <div class="summary-box-val" style="color: #0284c7;">{{ $totals['total_filled'] }}</div>
                    <div class="summary-box-sub">11k: {{ $totals['filled_11kg'] }} | 22k: {{ $totals['filled_22kg'] }} | 44k: {{ $totals['filled_44kg'] }}</div>
                </div>
            </td>
            <td style="width: 25%;">
                <div class="summary-box">
                    <div class="summary-box-title">New Cylinders (Empty)</div>
                    <div class="summary-box-val" style="color: #059669;">{{ $totals['total_new'] }}</div>
                    <div class="summary-box-sub">11k: {{ $totals['new_11kg'] }} | 22k: {{ $totals['new_22kg'] }} | 44k: {{ $totals['new_44kg'] }}</div>
                </div>
            </td>
            <td style="width: 25%;">
                <div class="summary-box">
                    <div class="summary-box-title">Total Cylinders Volume</div>
                    <div class="summary-box-val" style="color: #d97706;">{{ $totals['total_qty'] }}</div>
                    <div class="summary-box-sub">Filled + New Cylinders</div>
                </div>
            </td>
        </tr>
    </table>

    <!-- Main Data Table -->
    <table class="data-table">
        <thead>
            <tr>
                <th rowspan="2" class="th-main" style="width: 45px;">Inv #</th>
                <th rowspan="2" class="th-main" style="width: 70px;">Date</th>
                <th rowspan="2" class="th-main" style="width: 140px;">Customer Name</th>
                <th colspan="4" class="th-filled">Filled Cylinders Sold (Refill)</th>
                <th colspan="4" class="th-new">New Cylinders Sold (Empty)</th>
                <th rowspan="2" class="th-main" style="width: 55px;">Total Qty</th>
                <th rowspan="2" class="th-main" style="width: 80px;">Amount (OMR)</th>
            </tr>
            <tr>
                <!-- Filled Sub-headers -->
                <th class="th-filled" style="width: 45px;">11kg</th>
                <th class="th-filled" style="width: 45px;">22kg</th>
                <th class="th-filled" style="width: 45px;">44kg</th>
                <th class="th-filled" style="width: 50px;">Total</th>

                <!-- New Sub-headers -->
                <th class="th-new" style="width: 45px;">11kg</th>
                <th class="th-new" style="width: 45px;">22kg</th>
                <th class="th-new" style="width: 45px;">44kg</th>
                <th class="th-new" style="width: 50px;">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
                @php
                    $items = $sale->saleItems->groupBy('type');
                    $getQty = function($type) use ($items) {
                        return $items->has($type) ? (int) $items->get($type)->sum('quantity') : 0;
                    };

                    $f11 = $getQty('11kg_full');
                    $f22 = $getQty('22kg_full');
                    $f44 = $getQty('44kg_full');
                    $totFilled = $f11 + $f22 + $f44;

                    $n11 = $getQty('11kg_empty');
                    $n22 = $getQty('22kg_empty');
                    $n44 = $getQty('44kg_empty');
                    $totNew = $n11 + $n22 + $n44;

                    $rowQty = $totFilled + $totNew;
                @endphp
                <tr>
                    <td class="text-center font-bold">#{{ $sale->id }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($sale->date)->format('d/m/Y') }}</td>
                    <td class="text-start">{{ \App\Helpers\ArabicHelper::shape($sale->customer->name ?? 'Walk-in Customer') }}</td>

                    <!-- Filled Breakdowns -->
                    <td class="text-center">{{ $f11 > 0 ? $f11 : '-' }}</td>
                    <td class="text-center">{{ $f22 > 0 ? $f22 : '-' }}</td>
                    <td class="text-center">{{ $f44 > 0 ? $f44 : '-' }}</td>
                    <td class="text-center col-filled-total">{{ $totFilled }}</td>

                    <!-- New Breakdowns -->
                    <td class="text-center">{{ $n11 > 0 ? $n11 : '-' }}</td>
                    <td class="text-center">{{ $n22 > 0 ? $n22 : '-' }}</td>
                    <td class="text-center">{{ $n44 > 0 ? $n44 : '-' }}</td>
                    <td class="text-center col-new-total">{{ $totNew }}</td>

                    <td class="text-center font-bold">{{ $rowQty }}</td>
                    <td class="text-end font-bold">{{ number_format($sale->total_amount, 3) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" class="text-center" style="padding: 20px; color: #64748b;">
                        No sales records found matching the filter criteria.
                    </td>
                </tr>
            @endforelse
        </tbody>
        @if($sales->count() > 0)
        <tfoot>
            <tr>
                <td colspan="3" class="text-center font-bold">GRAND TOTALS</td>
                <td class="text-center">{{ $totals['filled_11kg'] }}</td>
                <td class="text-center">{{ $totals['filled_22kg'] }}</td>
                <td class="text-center">{{ $totals['filled_44kg'] }}</td>
                <td class="text-center col-filled-total">{{ $totals['total_filled'] }}</td>

                <td class="text-center">{{ $totals['new_11kg'] }}</td>
                <td class="text-center">{{ $totals['new_22kg'] }}</td>
                <td class="text-center">{{ $totals['new_44kg'] }}</td>
                <td class="text-center col-new-total">{{ $totals['total_new'] }}</td>

                <td class="text-center font-bold">{{ $totals['total_qty'] }}</td>
                <td class="text-end font-bold">{{ number_format($totals['grand_amount'], 3) }}</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <!-- Footer Section -->
    <table class="footer-table">
        <tr>
            <td style="width: 50%;">
                Gas Agency Management System &bull; Confidential &amp; Proprietary Report
            </td>
            <td style="width: 50%; text-align: right;">
                Printed on: {{ now()->format('d M Y, h:i A') }}
            </td>
        </tr>
    </table>

</body>
</html>

