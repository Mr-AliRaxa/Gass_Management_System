<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Gas Reading Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 20px 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 12px;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
            color: #1e3a8a;
        }

        .header p {
            margin: 4px 0 0;
            font-size: 11px;
            color: #64748b;
        }

        .date-range-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 6px;
            padding: 10px 14px;
            margin-bottom: 16px;
            font-size: 12px;
            color: #1e40af;
        }

        .date-range-box strong {
            color: #1e3a8a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }

        thead tr {
            background-color: #2563eb;
            color: #ffffff;
        }

        th {
            padding: 8px 10px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 7px 10px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 11px;
        }

        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .consumption-cell {
            font-weight: 700;
            color: #0284c7;
        }

        .total-row {
            background: #1e40af !important;
            color: #ffffff;
            font-weight: 800;
            font-size: 12px;
        }

        .total-row td {
            border-bottom: none;
            padding: 10px;
        }

        .summary-box {
            background: #f0fdf4;
            border: 1px solid #86efac;
            border-radius: 6px;
            padding: 12px 16px;
            margin-top: 14px;
        }

        .summary-box h4 {
            margin: 0 0 6px;
            color: #166534;
            font-size: 14px;
        }

        .summary-box p {
            margin: 3px 0;
            font-size: 12px;
            color: #15803d;
        }

        .footer {
            margin-top: 24px;
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Gas Reading Report</h2>
        <p>Generated on: {{ date('d M Y, h:i A') }}</p>
    </div>

    {{-- Date Range Info --}}
    @if(!empty($fromDate) || !empty($toDate) || !empty($filterDate))
        <div class="date-range-box">
            @if(!empty($filterDate))
                <strong>Filtered Date:</strong> {{ \Carbon\Carbon::parse($filterDate)->format('d M Y') }}
            @elseif(!empty($fromDate) && !empty($toDate))
                <strong>Date Range:</strong> {{ \Carbon\Carbon::parse($fromDate)->format('d M Y') }} — {{ \Carbon\Carbon::parse($toDate)->format('d M Y') }}
            @elseif(!empty($fromDate))
                <strong>From:</strong> {{ \Carbon\Carbon::parse($fromDate)->format('d M Y') }} — Present
            @elseif(!empty($toDate))
                <strong>Up To:</strong> {{ \Carbon\Carbon::parse($toDate)->format('d M Y') }}
            @endif
            &nbsp;&nbsp;|&nbsp;&nbsp; <strong>Total Records:</strong> {{ $gasReadings->count() }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Start Reading</th>
                <th>End Reading</th>
                <th>Consumption (Ton)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($gasReadings as $index => $reading)
                @php
                    $consumption = $reading->end_reading - $reading->start_reading;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($reading->date)->format('d M Y') }}</td>
                    <td>{{ number_format($reading->start_reading, 3) }}</td>
                    <td>{{ number_format($reading->end_reading, 3) }}</td>
                    <td class="consumption-cell">{{ number_format($consumption, 3) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center; color:#94a3b8; padding:20px;">No gas readings found for the selected period.</td>
                </tr>
            @endforelse

            @if($gasReadings->count() > 0)
                <tr class="total-row">
                    <td colspan="4" style="text-align:right;">TOTAL CONSUMPTION:</td>
                    <td>{{ number_format($totalConsumption, 3) }} Ton</td>
                </tr>
            @endif
        </tbody>
    </table>

    @if($gasReadings->count() > 0)
        <div class="summary-box">
            <h4>Summary</h4>
            <p><strong>Total Records:</strong> {{ $gasReadings->count() }}</p>
            <p><strong>Total Consumption:</strong> {{ number_format($totalConsumption, 3) }} Ton</p>
            @if($gasReadings->count() > 0)
                <p><strong>Average Daily Consumption:</strong> {{ number_format($totalConsumption / $gasReadings->count(), 3) }} Ton</p>
                <p><strong>First Record Date:</strong> {{ \Carbon\Carbon::parse($gasReadings->first()->date)->format('d M Y') }}</p>
                <p><strong>Last Record Date:</strong> {{ \Carbon\Carbon::parse($gasReadings->last()->date)->format('d M Y') }}</p>
            @endif
        </div>
    @endif

    <div class="footer">
        This is an auto-generated report. &copy; {{ date('Y') }} Gas Management System
    </div>

</body>

</html>
