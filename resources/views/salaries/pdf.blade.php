<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Salaries Report</title>
    <style>
        @if(isset($setting) && $setting && $setting->hasActiveLetterhead())
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

    @if(isset($setting) && $setting && $setting->hasActiveLetterhead())
    <div class="letterhead-bg">
        <img src="{{ public_path('storage/' . $setting->letterhead) }}" alt="Letterhead">
    </div>
    @endif

    <div class="header">
        <h2>Salaries Report</h2>
        <p>Generated on: {{ date('d M Y, h:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 18%;">Date</th>
                <th style="width: 28%;">Team Member</th>
                <th style="width: 18%; text-align: right;">Amount (OMR)</th>
                <th style="width: 16%; text-align: right;">Bonus (OMR)</th>
                <th style="width: 20%;">Note</th>
            </tr>
        </thead>
        <tbody>
            @php $totalAmount = 0; $totalBonus = 0; @endphp
            @forelse($salaries as $salary)
            <tr>
                <td>{{ \Carbon\Carbon::parse($salary->date)->format('d/m/Y') }}</td>
                <td>{{ \App\Helpers\ArabicHelper::shape($salary->teamMember->name ?? 'N/A') }}</td>
                <td style="text-align: right;">{{ number_format($salary->amount, 3) }}</td>
                <td style="text-align: right;">{{ number_format($salary->bonus, 3) }}</td>
                <td>{{ \App\Helpers\ArabicHelper::shape($salary->note ?? '-') }}</td>
            </tr>
            @php 
                $totalAmount += $salary->amount; 
                $totalBonus += $salary->bonus;
            @endphp
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #94a3b8; padding: 15px;">No salary records found.</td>
            </tr>
            @endforelse
            @if(count($salaries) > 0)
            <tr class="total-row">
                <td colspan="2" style="text-align: right;">Total</td>
                <td style="text-align: right;">{{ number_format($totalAmount, 3) }}</td>
                <td style="text-align: right;">{{ number_format($totalBonus, 3) }}</td>
                <td></td>
            </tr>
            @endif
        </tbody>
    </table>

</body>
</html>
