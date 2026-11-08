<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sales Report</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; }
        .bg-info { background-color: #d1ecf1 !important; }
        .bg-success { background-color: #d4edda !important; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>GAS AGENCY SALES REPORT</h2>
        <p>Generated on: {{ now()->format('d M Y, h:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="2">Inv #</th>
                <th rowspan="2">Date</th>
                <th rowspan="2">Customer</th>
                <th colspan="3" class="text-center bg-info">Filled (Refill)</th>
                <th colspan="3" class="text-center bg-success">New (Pole)</th>
                <th rowspan="2">Total (OMR)</th>
            </tr>
            <tr>
                <th class="text-center">11kg</th>
                <th class="text-center">22kg</th>
                <th class="text-center">44kg</th>
                <th class="text-center">11kg</th>
                <th class="text-center">22kg</th>
                <th class="text-center">44kg</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $grandTotal = 0;
                $totals = [
                    '11kg_full' => 0, '22kg_full' => 0, '44kg_full' => 0,
                    '11kg_empty' => 0, '22kg_empty' => 0, '44kg_empty' => 0
                ];
            @endphp
            @foreach ($sales as $sale)
                @php
                    $items = $sale->saleItems->groupBy('type');
                    $getQty = function($type) use ($items) {
                        return $items->has($type) ? $items->get($type)->sum('quantity') : 0;
                    };
                    $grandTotal += $sale->total_amount;
                    foreach(array_keys($totals) as $t) {
                        $totals[$t] += $getQty($t);
                    }
                @endphp
                <tr>
                    <td class="font-bold">#{{ $sale->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($sale->date)->format('d/m/Y') }}</td>
                    <td>{{ \App\Helpers\ArabicHelper::shape($sale->customer->name ?? 'Walk-in Customer') }}</td>
                    <td class="text-center">{{ $getQty('11kg_full') }}</td>
                    <td class="text-center">{{ $getQty('22kg_full') }}</td>
                    <td class="text-center">{{ $getQty('44kg_full') }}</td>
                    <td class="text-center">{{ $getQty('11kg_empty') }}</td>
                    <td class="text-center">{{ $getQty('22kg_empty') }}</td>
                    <td class="text-center">{{ $getQty('44kg_empty') }}</td>
                    <td class="font-bold">{{ number_format($sale->total_amount, 3) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="font-bold bg-light">
                <td colspan="3" class="text-center">GRAND TOTALS</td>
                <td class="text-center">{{ $totals['11kg_full'] }}</td>
                <td class="text-center">{{ $totals['22kg_full'] }}</td>
                <td class="text-center">{{ $totals['44kg_full'] }}</td>
                <td class="text-center">{{ $totals['11kg_empty'] }}</td>
                <td class="text-center">{{ $totals['22kg_empty'] }}</td>
                <td class="text-center">{{ $totals['44kg_empty'] }}</td>
                <td class="text-primary">{{ number_format($grandTotal, 3) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Page {PAGENO}
    </div>
</body>
</html>
