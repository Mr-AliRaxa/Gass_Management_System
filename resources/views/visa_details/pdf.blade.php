<!DOCTYPE html>
<html>
<head>
    <title>Visa Expiry Report</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>

    <h2>Visa Expiry Report</h2>
    <p>Generated on: {{ date('Y-m-d') }}</p>

    <table>
        <thead>
            <tr>
                <th>Team Member</th>
                <th>Issue Date</th>
                <th>Expiry Date</th>
                <th>Days Until Expiry</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visaDetails as $visa)
             @php
                $daysLeft = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($visa->expiry_date), false);
            @endphp
            <tr>
                <td>{{ $visa->teamMember->name }}</td>
                <td>{{ $visa->issue_date }}</td>
                <td>{{ $visa->expiry_date }}</td>
                <td style="{{ $daysLeft < 30 ? 'color: red;' : '' }}">
                    {{ round($daysLeft) }} Days
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
