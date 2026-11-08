<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        @page {
            margin-top: {{ ($setting->top_margin ?? 120) . 'px' }};
            margin-bottom: {{ ($setting->bottom_margin ?? 80) . 'px' }};
            margin-left: 40px;
            margin-right: 40px;
        }
        body { 
            font-family: 'DejaVu Sans', sans-serif; 
            margin: 0px;
            padding: 0px;
            color: #1e293b;
        }
        @if($setting && $setting->letterhead)
        .letterhead-bg {
            position: fixed;
            top: -{{ ($setting->top_margin ?? 120) . 'px' }};
            left: -40px;
            width: 210mm; /* A4 Width */
            height: 297mm; /* A4 Height */
            z-index: -1000;
        }
        .letterhead-bg img {
            width: 100%;
            height: 100%;
        }
        @endif
        .content-wrapper {
            width: 100%;
        }
        .header { text-align: center; margin-bottom: 24px; }
        .header h1 { margin: 0 0 6px; font-size: 22px; color: #0f172a; }
        .header h2 { margin: 0; font-size: 16px; color: #2563eb; font-weight: 700; }
        
        .summary-table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
        .summary-table th, .summary-table td { border: 1px solid #cbd5e1; padding: 8px 12px; text-align: left; font-size: 12px; }
        .summary-table th { background-color: #f8fafc; width: 65%; }
        .summary-table td { font-weight: bold; width: 35%; }
        .profit td { font-weight: bold; color: #16a34a; background-color: #f0fdf4; }
        .loss td { font-weight: bold; color: #dc2626; background-color: #fef2f2; }
        
        .footer { 
            position: fixed; 
            bottom: -25px; 
            left: 0; 
            right: 0; 
            text-align: center; 
            font-size: 10px; 
            color: #64748b; 
        }
        
        .section-title { 
            background-color: #f1f5f9; 
            padding: 6px 10px; 
            margin-top: 18px; 
            margin-bottom: 6px; 
            font-weight: bold; 
            font-size: 12px; 
            border-left: 3px solid #2563eb; 
            page-break-after: avoid; 
        }
        .data-table { 
            width: 100%; 
            border-collapse: collapse; 
            font-size: 11px; 
            margin-bottom: 12px; 
        }
        .data-table th, .data-table td { 
            border: 1px solid #e2e8f0; 
            padding: 6px 8px; 
            text-align: left; 
        }
        .data-table th { 
            background-color: #f8fafc; 
            font-weight: 700; 
            color: #334155; 
        }
        .data-table tr { 
            page-break-inside: avoid; 
        }
    </style>
</head>
<body>
    @if($setting && $setting->letterhead)
    <div class="letterhead-bg">
        <img src="{{ public_path('storage/' . $setting->letterhead) }}" alt="">
    </div>
    @endif

    <div class="footer">
        Generated on {{ date('d M Y H:i') }} &bull; {{ $title }}
    </div>

    <div class="content-wrapper">
        <div class="header">
            @if(!($setting && $setting->letterhead))
                <h1>Gas Agency</h1>
            @endif
            <h2>{{ $title }}</h2>
        </div>

    <table class="summary-table">
        <tr>
            <th>
                <span style="float: left;">Total Sales</span>
                <span style="float: right;">{{ $labels['total_sales_ar'] }}</span>
            </th>
            <td>{{ number_format($totalSales, 2) }} OMR</td>
        </tr>
        <tr>
            <th>
                <span style="float: left;">Total Expenses</span>
                <span style="float: right;">{{ $labels['total_expenses_ar'] }}</span>
            </th>
            <td>{{ number_format($totalExpenses, 2) }} OMR</td>
        </tr>
        <tr>
            <th>
                <span style="float: left;">Total Paid Salaries</span>
                <span style="float: right;">{{ $labels['total_salaries_ar'] }}</span>
            </th>
            <td>{{ number_format($totalSalaries, 2) }} OMR</td>
        </tr>
        <tr>
            <th>
                <span style="float: left;">Total Gas Used / Consumption</span>
                <span style="float: right;">{{ $labels['total_gas_reading_ar'] }}</span>
            </th>
            <td><strong>{{ number_format($totalGasUsed, 2) }}</strong> Ton</td>
        </tr>
        <tr class="{{ $netProfit >= 0 ? 'profit' : 'loss' }}">
            <th>
                <span style="float: left;">Net Profit</span>
                <span style="float: right;">{{ $labels['net_profit_ar'] }}</span>
            </th>
            <td>{{ number_format($netProfit, 2) }} OMR</td>
        </tr>
    </table>

    <div class="section-title">
        <span style="float: left;">Sales Detail</span>
        <span style="float: right;">{{ $labels['sales_detail_ar'] }}</span>
        <div style="clear: both;"></div>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="30px">#</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Amount (OMR)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $index => $sale)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ date('d-m-Y', strtotime($sale->date)) }}</td>
                <td>{{ \App\Helpers\ArabicHelper::shape($sale->customer->name ?? 'Walk-in / Cash') }}</td>
                <td>{{ number_format($sale->total_amount, 2) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; color: #94a3b8; padding: 10px;">No sales recorded for this period.</td>
            </tr>
            @endforelse
        </tbody>
        @if($sales->count() > 0)
        <tfoot>
            <tr style="background: #f8fafc; font-weight: bold;">
                <td colspan="3" style="text-align: right;">Total Sales:</td>
                <td>{{ number_format($totalSales, 2) }} OMR</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <div class="section-title">
        <span style="float: left;">Expenses Detail</span>
        <span style="float: right;">{{ $labels['expenses_detail_ar'] }}</span>
        <div style="clear: both;"></div>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="30px">#</th>
                <th>Date</th>
                <th>Note / Category</th>
                <th>Amount (OMR)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($expenses as $index => $expense)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ date('d-m-Y', strtotime($expense->date)) }}</td>
                <td>{{ \App\Helpers\ArabicHelper::shape($expense->note ?: ($expense->expenseType->name ?? 'N/A')) }}</td>
                <td>{{ number_format($expense->amount, 2) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; color: #94a3b8; padding: 10px;">No expenses recorded for this period.</td>
            </tr>
            @endforelse
        </tbody>
        @if($expenses->count() > 0)
        <tfoot>
            <tr style="background: #f8fafc; font-weight: bold;">
                <td colspan="3" style="text-align: right;">Total Expenses:</td>
                <td>{{ number_format($totalExpenses, 2) }} OMR</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <div class="section-title">
        <span style="float: left;">Salaries Detail</span>
        <span style="float: right;">{{ $labels['salaries_detail_ar'] }}</span>
        <div style="clear: both;"></div>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="30px">#</th>
                <th>Date</th>
                <th>Staff Member</th>
                <th>Amount (OMR)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($salaries as $index => $salary)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ date('d-m-Y', strtotime($salary->date)) }}</td>
                <td>{{ \App\Helpers\ArabicHelper::shape($salary->teamMember->name ?? 'N/A') }}</td>
                <td>{{ number_format($salary->amount, 2) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; color: #94a3b8; padding: 10px;">No salary payments recorded for this period.</td>
            </tr>
            @endforelse
        </tbody>
        @if($salaries->count() > 0)
        <tfoot>
            <tr style="background: #f8fafc; font-weight: bold;">
                <td colspan="3" style="text-align: right;">Total Salaries:</td>
                <td>{{ number_format($totalSalaries, 2) }} OMR</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <div class="section-title">
        <span style="float: left;">Attendance Detail</span>
        <span style="float: right;">{{ $labels['attendance_detail_ar'] }}</span>
        <div style="clear: both;"></div>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="30px">#</th>
                <th>Date</th>
                <th>Staff Member</th>
                <th>Status</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $index => $attendance)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ date('d-m-Y', strtotime($attendance->date)) }}</td>
                <td>{{ \App\Helpers\ArabicHelper::shape($attendance->teamMember->name ?? 'N/A') }}</td>
                <td>{{ ucfirst($attendance->status) }}</td>
                <td>{{ \App\Helpers\ArabicHelper::shape($attendance->note ?? '-') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #94a3b8; padding: 10px;">No attendance records found for this period.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">
        <span style="float: left;">Gas Reading Detail</span>
        <span style="float: right;">{{ $labels['gas_reading_detail_ar'] }}</span>
        <div style="clear: both;"></div>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th width="30px">#</th>
                <th>Date</th>
                <th>Start Reading</th>
                <th>End Reading</th>
                <th>Used / Consumption</th>
            </tr>
        </thead>
        <tbody>
            @forelse($gasReadings as $index => $reading)
            @php
                $used = ($reading->start_reading !== null && $reading->end_reading !== null)
                    ? abs((float)$reading->start_reading - (float)$reading->end_reading)
                    : 0;
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ date('d-m-Y', strtotime($reading->date)) }}</td>
                <td>{{ number_format($reading->start_reading, 2) }}</td>
                <td>{{ $reading->end_reading !== null ? number_format($reading->end_reading, 2) : '—' }}</td>
                <td><strong>{{ number_format($used, 2) }}</strong> Ton</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #94a3b8; padding: 10px;">No gas readings recorded for this period.</td>
            </tr>
            @endforelse
        </tbody>
        @if($gasReadings->count() > 0)
        <tfoot>
            <tr style="background: #f8fafc; font-weight: bold;">
                <td colspan="4" style="text-align: right;">Total Gas Consumption:</td>
                <td><strong>{{ number_format($totalGasUsed, 2) }}</strong> Ton</td>
            </tr>
        </tfoot>
        @endif
    </table>
    </div>
</body>
</html>
