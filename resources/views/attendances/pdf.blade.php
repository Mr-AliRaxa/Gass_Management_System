<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Attendance Report</title>
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
        
        .badge { font-weight: bold; }
        .present { color: #16a34a; }
        .absent { color: #dc2626; }
        .leave { color: #d97706; }
    </style>
</head>
<body>

    @if(isset($setting) && $setting && $setting->hasActiveLetterhead())
    <div class="letterhead-bg">
        <img src="{{ public_path('storage/' . $setting->letterhead) }}" alt="Letterhead">
    </div>
    @endif

    <div class="header">
        <h2>Attendance Report</h2>
        <p>Generated on: {{ date('d M Y, h:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 20%;">Date</th>
                <th style="width: 35%;">Team Member</th>
                <th style="width: 20%;">Status</th>
                <th style="width: 25%;">Note</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $attendance)
            @php
                $statusClass = strtolower($attendance->status) == 'present' ? 'present' : (strtolower($attendance->status) == 'absent' ? 'absent' : 'leave');
            @endphp
            <tr>
                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}</td>
                <td>{{ \App\Helpers\ArabicHelper::shape($attendance->teamMember->name ?? 'N/A') }}</td>
                <td class="badge {{ $statusClass }}">{{ ucfirst($attendance->status) }}</td>
                <td>{{ \App\Helpers\ArabicHelper::shape($attendance->note ?? '-') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; color: #94a3b8; padding: 15px;">No attendance records found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
