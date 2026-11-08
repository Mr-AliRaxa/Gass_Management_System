<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Expenses Report</title>
    <style>
        @if(isset($setting) && $setting && $setting->letterhead)
        @page {
            margin-top: {{ ($setting->top_margin ?? 120) . 'px' }};
            margin-bottom: {{ ($setting->bottom_margin ?? 80) . 'px' }};
            margin-left: 40px;
            margin-right: 40px;
        }
        .letterhead-bg {
            position: fixed;
            top: -{{ ($setting->top_margin ?? 120) . 'px' }};
            left: -40px;
            width: 210mm;
            height: 297mm;
            z-index: -1000;
        }
        .letterhead-bg img {
            width: 100%;
            height: 100%;
        }
        @endif

        body { 
            font-family: 'DejaVu Sans', sans-serif; 
            font-size: 12px;
            color: #1e293b;
        }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0 0 4px 0; font-size: 20px; color: #0f172a; }
        .header p { margin: 0; color: #64748b; font-size: 11px; }

        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #cbd5e1; padding: 7px 10px; text-align: left; font-size: 11px; }
        th { background-color: #f1f5f9; color: #1e293b; font-weight: bold; }
        tbody tr:nth-child(even) { background-color: #f8fafc; }
        .total-row { background-color: #f1f5f9; font-weight: bold; }
    </style>
</head>
<body>

    @if(isset($setting) && $setting && $setting->letterhead)
    <div class="letterhead-bg">
        <img src="{{ public_path('storage/' . $setting->letterhead) }}" alt="Letterhead">
    </div>
    @endif

    <div class="header">
        <h2>Expenses Report</h2>
        <p>Generated on: {{ date('d M Y, h:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 20%;">Date</th>
                <th style="width: 25%;">Type</th>
                <th style="width: 35%;">Note</th>
                <th style="width: 20%; text-align: right;">Amount (OMR)</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @forelse($expenses as $expense)
            <tr>
                <td>{{ \Carbon\Carbon::parse($expense->date)->format('d/m/Y') }}</td>
                <td>{{ \App\Helpers\ArabicHelper::shape($expense->type->name ?? 'N/A') }}</td>
                <td>{{ \App\Helpers\ArabicHelper::shape($expense->note ?? '-') }}</td>
                <td style="text-align: right;">{{ number_format($expense->amount, 2) }}</td>
            </tr>
            @php $total += $expense->amount; @endphp
            @empty
            <tr>
                <td colspan="4" style="text-align: center; color: #94a3b8; padding: 15px;">No expenses found.</td>
            </tr>
            @endforelse
            @if(count($expenses) > 0)
            <tr class="total-row">
                <td colspan="3" style="text-align: right;">Total</td>
                <td style="text-align: right;">{{ number_format($total, 2) }}</td>
            </tr>
            @endif
        </tbody>
    </table>

</body>
</html>
