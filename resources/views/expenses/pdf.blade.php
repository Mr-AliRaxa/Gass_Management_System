<!DOCTYPE html>
<html>
<head>
    <title>Expenses Report</title>
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

    <h2>Expenses Report</h2>
    <p>Generated on: {{ date('Y-m-d') }}</p>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Note</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($expenses as $expense)
            <tr>
                <td>{{ $expense->date }}</td>
                <td>{{ $expense->type->name }}</td>
                <td>{{ $expense->note }}</td>
                <td>{{ number_format($expense->amount, 2) }}</td>
            </tr>
            @php $total += $expense->amount; @endphp
            @endforeach
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Total</strong></td>
                <td><strong>{{ number_format($total, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

</body>
</html>
