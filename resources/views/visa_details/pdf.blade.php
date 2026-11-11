<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Visa Expiry Report</title>
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
        .text-danger { color: #dc2626; font-weight: bold; }
        .text-warning { color: #d97706; font-weight: bold; }
        .text-success { color: #16a34a; font-weight: bold; }
    </style>
</head>
<body>

    @if(isset($setting) && $setting && $setting->hasActiveLetterhead())
    <div class="letterhead-bg">
        <img src="{{ public_path('storage/' . $setting->letterhead) }}" alt="Letterhead">
    </div>
    @endif

    <div class="header">
        <h2>Visa Expiry Report</h2>
        <p>Generated on: {{ date('d M Y, h:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 35%;">Team Member</th>
                <th style="width: 20%;">Issue Date</th>
                <th style="width: 20%;">Expiry Date</th>
                <th style="width: 25%;">Days Until Expiry</th>
            </tr>
        </thead>
        <tbody>
            @forelse($visaDetails as $visa)
            @php
                $expiry = \Carbon\Carbon::parse($visa->expiry_date);
                $daysLeft = (int) round(\Carbon\Carbon::now()->diffInDays($expiry, false));
                $class = $daysLeft < 30 ? 'text-danger' : ($daysLeft < 60 ? 'text-warning' : 'text-success');
            @endphp
            <tr>
                <td>{{ \App\Helpers\ArabicHelper::shape($visa->teamMember->name ?? 'N/A') }}</td>
                <td>{{ \Carbon\Carbon::parse($visa->issue_date)->format('d/m/Y') }}</td>
                <td>{{ $expiry->format('d/m/Y') }}</td>
                <td class="{{ $class }}">
                    @if($daysLeft < 0)
                        Expired ({{ abs($daysLeft) }} days ago)
                    @else
                        {{ $daysLeft }} Days
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; color: #94a3b8; padding: 15px;">No visa details found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
