<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $sale->id }}</title>
    <style>
        body { font-family: sans-serif; }
        .header { overflow: hidden; margin-bottom: 20px; }
        .company-info { float: left; }
        .invoice-info { float: right; text-align: right; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <div class="header">
        <div class="company-info">
            <h2>Gas Agency</h2>
            <p>Your Address Here</p>
            <p>Phone: 123-456-7890</p>
        </div>
        <div class="invoice-info">
            <h3>INVOICE</h3>
            <p>Invoice #: {{ $sale->id }}</p>
            <p>Date: {{ $sale->date }}</p>
        </div>
    </div>




    <div style="margin-bottom: 20px;">
    <div style="text-align:center;">Customer Gas Sale Report</div>
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="width: 30%; padding-left: 15px 0; font-weight: bold;">
                Customer Name
            </td>
           
            <td style="padding-left: 15px 0;">
                {{ $sale->customer->name }}
            </td>
        </tr>

        <tr>
            <td style="width: 30%; padding-left: 15px 0; font-weight: bold;">
                Address
            </td>
           
            <td style="padding-left: 15px 0;">
                {{ $sale->customer->address }}
            </td>
        </tr>

        <tr>
            <td style="width: 30%; padding-left: 15px 0; font-weight: bold;">
                Mobile
            </td>
            
            <td style="padding-left: 15px 0;">
                {{ $sale->customer->mobile }}
            </td>
        </tr>
    </table>
</div>

    <table>
        <thead>
            <tr>
                <th>Item Description</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->saleItems as $item)
            <tr>
                <td>{{ str_replace('_', ' ', ucfirst($item->type)) }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price, 2) }}</td>
                <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Grand Total</strong></td>
                <td><strong>{{ number_format($sale->total_amount, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 50px; text-align: center;">
        <p>Thank you for your business!</p>
    </div>

</body>
</html>
