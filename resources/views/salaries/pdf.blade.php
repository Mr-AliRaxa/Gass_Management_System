<!DOCTYPE html>
<html>
<head>
    <title>Salaries Report</title>
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

    <h2>Salaries Report</h2>
    <p>Generated on: {{ date('Y-m-d') }}</p>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Team Member</th>
                <th>Amount</th>
                <th>Bonus</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
             @php $totalAmount = 0; $totalBonus = 0; @endphp
            @foreach($salaries as $salary)
            <tr>
                <td>{{ $salary->date }}</td>
                <td>{{ $salary->teamMember->name }}</td>
                <td>{{ number_format($salary->amount, 2) }}</td>
                <td>{{ number_format($salary->bonus, 2) }}</td>
                <td>{{ $salary->note }}</td>
            </tr>
             @php 
                $totalAmount += $salary->amount; 
                $totalBonus += $salary->bonus;
            @endphp
            @endforeach
            <tr>
                <td colspan="2" style="text-align: right;"><strong>Total</strong></td>
                <td><strong>{{ number_format($totalAmount, 2) }}</strong></td>
                 <td><strong>{{ number_format($totalBonus, 2) }}</strong></td>
                 <td></td>
            </tr>
        </tbody>
    </table>

</body>
</html>
