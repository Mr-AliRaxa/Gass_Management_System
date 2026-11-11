<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #{{ $sale->id }}</title>
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
            font-size: 13px;
            color: #1e293b;
        }
        .header { overflow: hidden; margin-bottom: 20px; }
        .company-info { float: left; width: 60%; }
        .company-info h2 { margin: 0 0 5px 0; font-size: 20px; color: #0f172a; }
        .company-info p { margin: 2px 0; color: #475569; font-size: 12px; }
        .invoice-info { float: right; width: 35%; text-align: right; }
        .invoice-info h3 { margin: 0 0 5px 0; font-size: 20px; color: #2563eb; }
        .invoice-info p { margin: 2px 0; color: #475569; font-size: 12px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table, th, td { border: 1px solid #cbd5e1; }
        th, td { padding: 8px 10px; text-align: left; }
        th { background-color: #f1f5f9; color: #1e293b; }
        
        .customer-header {
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            padding: 8px;
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-bottom: none;
            color: #0f172a;
        }
    </style>
</head>
<body>

    @if(isset($setting) && $setting && $setting->hasActiveLetterhead())
    <div class="letterhead-bg">
        <img src="{{ public_path('storage/' . $setting->letterhead) }}" alt="Letterhead">
    </div>
    @endif

    <div class="header">
        @if(!($setting && $setting->hasActiveLetterhead()))
        <div class="company-info">
            <h2>{{ \App\Helpers\ArabicHelper::shape($agency->name ?? 'Gas Agency') }}</h2>
            <p>{{ \App\Helpers\ArabicHelper::shape($agency->address ?? 'Your Address Here') }}</p>
            <p>Phone: {{ $agency->phone ?? '123-456-7890' }}</p>
        </div>
        @endif
        <div class="invoice-info" style="{{ (isset($setting) && $setting && $setting->hasActiveLetterhead()) ? 'width: 100%; text-align: right;' : '' }}">
            <h3>INVOICE</h3>
            <p><strong>Invoice #:</strong> {{ $sale->id }}</p>
            <p><strong>Date:</strong> {{ $sale->date }}</p>
        </div>
    </div>

    <div style="margin-bottom: 20px;">
        <div class="customer-header">Customer Gas Sale Report</div>
        <table style="margin-top: 0;">
            <tr>
                <td style="width: 30%; font-weight: bold; background-color: #f8fafc;">
                    Customer Name
                </td>
                <td>
                    {{ \App\Helpers\ArabicHelper::shape($sale->customer->name ?? 'Walk-in Customer') }}
                </td>
            </tr>

            <tr>
                <td style="width: 30%; font-weight: bold; background-color: #f8fafc;">
                    Address
                </td>
                <td>
                    {{ \App\Helpers\ArabicHelper::shape($sale->customer->address ?? '-') }}
                </td>
            </tr>

            <tr>
                <td style="width: 30%; font-weight: bold; background-color: #f8fafc;">
                    Mobile
                </td>
                <td>
                    {{ $sale->customer->mobile ?? '-' }}
                </td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th>Item Description</th>
                <th style="text-align: center; width: 15%;">Quantity</th>
                <th style="text-align: right; width: 20%;">Unit Price</th>
                <th style="text-align: right; width: 20%;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->saleItems as $item)
            <tr>
                <td>{{ str_replace('_', ' ', ucfirst($item->type)) }}</td>
                <td style="text-align: center;">{{ $item->quantity }}</td>
                <td style="text-align: right;">{{ number_format($item->price, 3) }}</td>
                <td style="text-align: right;">{{ number_format($item->quantity * $item->price, 3) }}</td>
            </tr>
            @endforeach
            <tr style="background-color: #f8fafc;">
                <td colspan="3" style="text-align: right;"><strong>Grand Total</strong></td>
                <td style="text-align: right;"><strong>{{ number_format($sale->total_amount, 3) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 40px; text-align: center; color: #64748b; font-size: 12px;">
        <p>Thank you for your business!</p>
    </div>

</body>
</html>
