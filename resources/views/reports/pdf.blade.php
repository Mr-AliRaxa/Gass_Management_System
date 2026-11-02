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
        .header { text-align: center; margin-bottom: 30px; }
        .summary-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .summary-table th, .summary-table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .summary-table th { background-color: #f2f2f2; }
        .profit { font-weight: bold; color: green; }
        .loss { font-weight: bold; color: red; }
        .footer { position: fixed; bottom: 10mm; width: 100%; text-align: center; font-size: 10px; }
        .section-title { background-color: #eee; padding: 5px; margin-top: 20px; font-weight: bold; }
        .data-table { width: 100%; border-collapse: collapse; font-size: 12px; }
        .data-table th, .data-table td { border: 1px solid #ddd; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    @if($setting && $setting->letterhead)
    <div class="letterhead-bg">
        <img src="{{ public_path('storage/' . $setting->letterhead) }}" alt="">
    </div>
    @endif

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
            <td>{{ number_format($totalSales, 2) }}</td>
        </tr>
        <tr>
            <th>
                <span style="float: left;">Total Expenses</span>
                <span style="float: right;">{{ $labels['total_expenses_ar'] }}</span>
            </th>
            <td>{{ number_format($totalExpenses, 2) }}</td>
        </tr>
        <tr>
            <th>
                <span style="float: left;">Total Paid Salaries</span>
                <span style="float: right;">{{ $labels['total_salaries_ar'] }}</span>
            </th>
            <td>{{ number_format($totalSalaries, 2) }}</td>
        </tr>
        <tr class="{{ $netProfit >= 0 ? 'profit' : 'loss' }}">
            <th>
                <span style="float: left;">Net Profit</span>
                <span style="float: right;">{{ $labels['net_profit_ar'] }}</span>
            </th>
            <td>{{ number_format($netProfit, 2) }}</td>
        </tr>
    </table>

    <div class="footer">
        Generated on {{ date('d M Y H:i') }}
    </div>

    <div class="section-title">
        <span style="float: left;">Sales Detail</span>
        <span style="float: right;">{{ $labels['sales_detail_ar'] }}</span>
        <div style="clear: both;"></div>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Customer</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
            <tr>
                <td>{{ date('d-m-Y', strtotime($sale->date)) }}</td>
                <td>{{ $sale->customer->name ?? 'N/A' }}</td>
                <td>{{ number_format($sale->total_amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section-title">
        <span style="float: left;">Expenses Detail</span>
        <span style="float: right;">{{ $labels['expenses_detail_ar'] }}</span>
        <div style="clear: both;"></div>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Note</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
            <tr>
                <td>{{ date('d-m-Y', strtotime($expense->date)) }}</td>
                <td>{{ $expense->note ?? 'N/A' }}</td>
                <td>{{ number_format($expense->amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section-title">
        <span style="float: left;">Salaries Detail</span>
        <span style="float: right;">{{ $labels['salaries_detail_ar'] }}</span>
        <div style="clear: both;"></div>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Member</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salaries as $salary)
            <tr>
                <td>{{ date('d-m-Y', strtotime($salary->date)) }}</td>
                <td>{{ $salary->teamMember->name ?? 'N/A' }}</td>
                <td>{{ number_format($salary->amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section-title">
        <span style="float: left;">Attendance Detail</span>
        <span style="float: right;">{{ $labels['attendance_detail_ar'] }}</span>
        <div style="clear: both;"></div>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Member</th>
                <th>Status</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr>
                <td>{{ date('d-m-Y', strtotime($attendance->date)) }}</td>
                <td>{{ $attendance->teamMember->name ?? 'N/A' }}</td>
                <td>{{ ucfirst($attendance->status) }}</td>
                <td>{{ $attendance->note ?? '-' }}</td>
            </tr>
            @endforeach
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
                <th>Date</th>
                <th>Start Reading</th>
                <th>End Reading</th>
                <th>Used</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gasReadings as $reading)
            <tr>
                <td>{{ date('d-m-Y', strtotime($reading->date)) }}</td>
                <td>{{ number_format($reading->start_reading, 2) }}</td>
                <td>{{ number_format($reading->end_reading, 2) }}</td>
                <td>{{ number_format($reading->end_reading - $reading->start_reading, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</body>
</html>
