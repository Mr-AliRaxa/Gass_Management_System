<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
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

    <h2>Attendance Report</h2>
    <p>Generated on: {{ date('Y-m-d') }}</p>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Team Member</th>
                <th>Status</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr>
                <td>{{ $attendance->date }}</td>
                <td>{{ $attendance->teamMember->name }}</td>
                <td>{{ ucfirst($attendance->status) }}</td>
                <td>{{ $attendance->note }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
