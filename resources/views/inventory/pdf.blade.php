<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        @if(($reportType ?? 'all') == 'purchases')
            Cylinder Purchases & Investment Report
        @elseif(($reportType ?? 'all') == 'sales')
            Cylinder Sales & Revenue Report
        @else
            Cylinder Inventory Management & Audit Report
        @endif
    </title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; color: #1e293b; margin: 0; padding: 15px; }
        .header { text-align: center; border-bottom: 2px solid #2563eb; padding-bottom: 12px; margin-bottom: 18px; }
        .title { font-size: 19px; font-weight: bold; color: #1e3a8a; margin: 0; text-transform: uppercase; }
        .subtitle { font-size: 11px; color: #64748b; margin-top: 4px; }
        
        .kpi-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        .kpi-box { padding: 9px 12px; border: 1px solid #cbd5e1; background: #f8fafc; border-radius: 6px; text-align: center; }
        .kpi-title { font-size: 10px; color: #64748b; text-transform: uppercase; font-weight: bold; }
        .kpi-val { font-size: 15px; font-weight: bold; color: #1e293b; margin-top: 3px; }

        .section-title { font-size: 12.5px; font-weight: bold; color: #1e40af; border-left: 4px solid #2563eb; padding-left: 8px; margin: 16px 0 8px; }

        table.data-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; font-size: 10px; }
        table.data-table th, table.data-table td { border: 1px solid #e2e8f0; padding: 6px 8px; }
        table.data-table th { background-color: #f1f5f9; color: #334155; font-weight: bold; text-align: left; }
        table.data-table tr:nth-child(even) { background-color: #f8fafc; }

        .text-success { color: #15803d; font-weight: bold; }
        .text-danger { color: #b91c1c; font-weight: bold; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }

        .badge-positive { background-color: #dcfce7; color: #15803d; padding: 2px 6px; border-radius: 4px; font-weight: bold; }
        .badge-negative { background-color: #fee2e2; color: #b91c1c; padding: 2px 6px; border-radius: 4px; font-weight: bold; }
        .badge-blue { background-color: #e0f2fe; color: #0369a1; padding: 2px 6px; border-radius: 4px; font-weight: bold; }

        .total-row { background-color: #e2e8f0 !important; font-weight: bold; }
        .footer { margin-top: 25px; border-top: 1px solid #e2e8f0; padding-top: 8px; text-align: right; font-size: 9px; color: #94a3b8; }
    </style>
</head>
<body>

    @php
        $rType = $reportType ?? 'all';
    @endphp

    <div class="header">
        <h1 class="title">
            @if($rType == 'purchases')
                CYLINDER PURCHASES &amp; SUPPLIER INVESTMENT REPORT
            @elseif($rType == 'sales')
                CYLINDER SALES &amp; CUSTOMER REVENUE REPORT
            @else
                CYLINDER INVENTORY MANAGEMENT &amp; AUDIT REPORT
            @endif
        </h1>
        <div class="subtitle">
            Generated on: {{ date('d M Y, h:i A') }} &bull; Gas Agency Cylinder Management System
        </div>
    </div>

    {{-- ═════════════════════════════════════════════════════════ --}}
    {{-- A) PURCHASES REPORT VIEW --}}
    {{-- ═════════════════════════════════════════════════════════ --}}
    @if($rType == 'purchases')
        
        {{-- Purchases KPIs --}}
        <table class="kpi-table">
            <tr>
                <td width="25%">
                    <div class="kpi-box" style="border-top: 3px solid #16a34a;">
                        <div class="kpi-title">Total Cylinders Bought</div>
                        <div class="kpi-val" style="color: #16a34a;">{{ number_format($totalPurchasedFilteredQty ?? $totalPurchasedQty) }} Units</div>
                    </div>
                </td>
                <td width="25%">
                    <div class="kpi-box" style="border-top: 3px solid #2563eb;">
                        <div class="kpi-title">Total Purchase Cost</div>
                        <div class="kpi-val" style="color: #2563eb;">{{ number_format($totalPurchasedFilteredCost ?? $totalPurchaseCost, 2) }} OMR</div>
                    </div>
                </td>
                <td width="25%">
                    <div class="kpi-box" style="border-top: 3px solid #7c3aed;">
                        <div class="kpi-title">Purchase Transactions</div>
                        <div class="kpi-val" style="color: #7c3aed;">{{ count($purchasesList ?? []) }} Entries</div>
                    </div>
                </td>
                <td width="25%">
                    <div class="kpi-box" style="border-top: 3px solid #d97706;">
                        <div class="kpi-title">Avg Unit Buy Cost</div>
                        @php
                            $pQty = $totalPurchasedFilteredQty ?? $totalPurchasedQty;
                            $pCost = $totalPurchasedFilteredCost ?? $totalPurchaseCost;
                            $avgBuy = $pQty > 0 ? ($pCost / $pQty) : 0;
                        @endphp
                        <div class="kpi-val" style="color: #d97706;">{{ number_format($avgBuy, 2) }} OMR</div>
                    </div>
                </td>
            </tr>
        </table>

        {{-- Size Wise Purchases --}}
        <div class="section-title">1. Cylinder Size-Wise Purchases Summary (11kg, 22kg, 44kg)</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Cylinder Size</th>
                    <th class="text-center">Total Bought (Units)</th>
                    <th class="text-right">Buy Unit Price</th>
                    <th class="text-right">Total Investment Cost</th>
                    <th class="text-center">Current Remaining Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cylinderSizeDetails as $sizeKey => $item)
                <tr>
                    <td><strong>{{ $item['name'] }}</strong></td>
                    <td class="text-center">{{ number_format($item['purchased_qty']) }}</td>
                    <td class="text-right">{{ number_format($item['purchase_price'], 2) }} OMR</td>
                    <td class="text-right" style="font-weight:bold; color:#1e40af;">{{ number_format($item['total_purchase_cost'], 2) }} OMR</td>
                    <td class="text-center">{{ $item['remaining'] }}</td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td>TOTAL PURCHASES:</td>
                    <td class="text-center">{{ number_format($totalPurchasedQty) }} Units</td>
                    <td class="text-right">—</td>
                    <td class="text-right">{{ number_format($totalPurchaseCost, 2) }} OMR</td>
                    <td class="text-center">{{ number_format(($stocks['11kg_empty'] ?? 0) + ($stocks['22kg_empty'] ?? 0) + ($stocks['44kg_empty'] ?? 0)) }} Units</td>
                </tr>
            </tbody>
        </table>

        {{-- Monthly Purchases Breakdown --}}
        <div class="section-title">2. Monthly Cylinder Purchases History (Last 6 Months)</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Month &amp; Year</th>
                    <th class="text-center">11kg Bought</th>
                    <th class="text-center">22kg Bought</th>
                    <th class="text-center">44kg Bought</th>
                    <th class="text-center">Total Bought Units</th>
                    <th class="text-right">Purchase Investment (OMR)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthsBreakdown as $m)
                <tr>
                    <td><strong>{{ $m['month'] }}</strong></td>
                    <td class="text-center">{{ $m['bought_11kg'] ?? 0 }}</td>
                    <td class="text-center">{{ $m['bought_22kg'] ?? 0 }}</td>
                    <td class="text-center">{{ $m['bought_44kg'] ?? 0 }}</td>
                    <td class="text-center">
                        <span class="badge-positive">+{{ $m['bought_qty'] }} Units</span>
                    </td>
                    <td class="text-right" style="font-weight: bold; color: #16a34a;">
                        {{ number_format($m['bought_cost'], 2) }} OMR
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Detailed Purchases Log --}}
        <div class="section-title">3. Detailed Cylinder Purchases &amp; Inward Stock Log</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Cylinder Type</th>
                    <th class="text-center">Purchased Qty</th>
                    <th class="text-right">Unit Buy Price</th>
                    <th class="text-right">Total Purchase Cost</th>
                    <th>Supplier Name</th>
                    <th>Note / Reference</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchasesList as $idx => $p)
                @php
                    $pDate = $p->transaction_date ? \Carbon\Carbon::parse($p->transaction_date)->format('d M Y') : $p->created_at->format('d M Y');
                    $pType = str_replace(['_empty', '_'], [' New Cylinder', ' '], ucfirst($p->type));
                @endphp
                <tr>
                    <td class="text-center">{{ $idx + 1 }}</td>
                    <td>{{ $pDate }}</td>
                    <td><strong>{{ $pType }}</strong></td>
                    <td class="text-center"><span class="badge-positive">+{{ $p->quantity }}</span></td>
                    <td class="text-right">{{ number_format($p->unit_price, 2) }} OMR</td>
                    <td class="text-right" style="font-weight: bold; color:#1e40af;">{{ number_format($p->total_cost, 2) }} OMR</td>
                    <td><strong>{{ $p->supplier_name ?: '—' }}</strong></td>
                    <td>{{ $p->note ?: '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 15px; color: #94a3b8;">No cylinder purchase records found.</td>
                </tr>
                @endforelse
                @if(count($purchasesList) > 0)
                <tr class="total-row">
                    <td colspan="3" class="text-right">TOTAL:</td>
                    <td class="text-center">+{{ number_format($totalPurchasedFilteredQty) }} Units</td>
                    <td class="text-right">—</td>
                    <td class="text-right">{{ number_format($totalPurchasedFilteredCost, 2) }} OMR</td>
                    <td colspan="2"></td>
                </tr>
                @endif
            </tbody>
        </table>

    {{-- ═════════════════════════════════════════════════════════ --}}
    {{-- B) SALES REPORT VIEW --}}
    {{-- ═════════════════════════════════════════════════════════ --}}
    @elseif($rType == 'sales')

        {{-- Sales KPIs --}}
        <table class="kpi-table">
            <tr>
                <td width="25%">
                    <div class="kpi-box" style="border-top: 3px solid #dc2626;">
                        <div class="kpi-title">Total Cylinders Sold</div>
                        <div class="kpi-val" style="color: #dc2626;">{{ number_format($totalSoldFilteredQty ?? $totalSoldCylinders) }} Units</div>
                    </div>
                </td>
                <td width="25%">
                    <div class="kpi-box" style="border-top: 3px solid #2563eb;">
                        <div class="kpi-title">Total Sales Revenue</div>
                        <div class="kpi-val" style="color: #2563eb;">{{ number_format($totalSoldFilteredRevenue, 2) }} OMR</div>
                    </div>
                </td>
                <td width="25%">
                    <div class="kpi-box" style="border-top: 3px solid #7c3aed;">
                        <div class="kpi-title">Sale Transactions</div>
                        <div class="kpi-val" style="color: #7c3aed;">{{ count($salesList ?? []) }} Entries</div>
                    </div>
                </td>
                <td width="25%">
                    <div class="kpi-box" style="border-top: 3px solid #16a34a;">
                        <div class="kpi-title">Avg Sale Price</div>
                        @php
                            $sQty = $totalSoldFilteredQty ?? $totalSoldCylinders;
                            $sRev = $totalSoldFilteredRevenue;
                            $avgSale = $sQty > 0 ? ($sRev / $sQty) : 0;
                        @endphp
                        <div class="kpi-val" style="color: #16a34a;">{{ number_format($avgSale, 2) }} OMR</div>
                    </div>
                </td>
            </tr>
        </table>

        {{-- Size Wise Sales --}}
        <div class="section-title">1. Cylinder Size-Wise Sales &amp; Revenue Details (11kg, 22kg, 44kg)</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Cylinder Size</th>
                    <th class="text-center">Total Sold (Units)</th>
                    <th class="text-right">Average Sale Price</th>
                    <th class="text-right">Total Sale Revenue</th>
                    <th class="text-right">Estimated Gross Profit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cylinderSizeDetails as $sizeKey => $item)
                <tr>
                    <td><strong>{{ $item['name'] }}</strong></td>
                    <td class="text-center">{{ number_format($item['sold_qty']) }}</td>
                    <td class="text-right">{{ number_format($item['sale_price'], 2) }} OMR</td>
                    <td class="text-right" style="font-weight:bold; color:#1e40af;">{{ number_format($item['total_sale_revenue'], 2) }} OMR</td>
                    <td class="text-right {{ $item['profit'] >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ $item['profit'] >= 0 ? '+' : '' }}{{ number_format($item['profit'], 2) }} OMR
                    </td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td>TOTAL SALES:</td>
                    <td class="text-center">{{ number_format($totalSoldCylinders) }} Units</td>
                    <td class="text-right">—</td>
                    <td class="text-right">{{ number_format(array_sum(array_column($cylinderSizeDetails, 'total_sale_revenue')), 2) }} OMR</td>
                    <td class="text-right text-success">+{{ number_format(array_sum(array_column($cylinderSizeDetails, 'profit')), 2) }} OMR</td>
                </tr>
            </tbody>
        </table>

        {{-- Monthly Sales Breakdown --}}
        <div class="section-title">2. Monthly Cylinder Sales History (Last 6 Months)</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Month &amp; Year</th>
                    <th class="text-center">11kg Sold</th>
                    <th class="text-center">22kg Sold</th>
                    <th class="text-center">44kg Sold</th>
                    <th class="text-center">Total Sold Units</th>
                    <th class="text-right">Monthly Sales Revenue (OMR)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthsBreakdown as $m)
                <tr>
                    <td><strong>{{ $m['month'] }}</strong></td>
                    <td class="text-center">{{ $m['sold_11kg'] ?? 0 }}</td>
                    <td class="text-center">{{ $m['sold_22kg'] ?? 0 }}</td>
                    <td class="text-center">{{ $m['sold_44kg'] ?? 0 }}</td>
                    <td class="text-center">
                        <span class="badge-negative">-{{ $m['sold_qty'] }} Sold</span>
                    </td>
                    <td class="text-right" style="font-weight: bold; color: #1e40af;">
                        {{ number_format($m['sold_revenue'] ?? 0, 2) }} OMR
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Detailed Sales Log --}}
        <div class="section-title">3. Detailed Cylinder Sales &amp; Outward Customer Log</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Cylinder Type</th>
                    <th class="text-center">Sold Qty</th>
                    <th class="text-right">Unit Sale Price</th>
                    <th class="text-right">Total Amount</th>
                    <th>Customer Name</th>
                    <th>Invoice / Sale Ref</th>
                </tr>
            </thead>
            <tbody>
                @forelse($salesList as $idx => $s)
                @php
                    $sDate = $s->sale ? \Carbon\Carbon::parse($s->sale->date)->format('d M Y') : '—';
                    $sType = str_replace(['_empty', '_'], [' New Cylinder', ' '], ucfirst($s->type));
                    $sTotal = $s->quantity * $s->price;
                @endphp
                <tr>
                    <td class="text-center">{{ $idx + 1 }}</td>
                    <td>{{ $sDate }}</td>
                    <td><strong>{{ $sType }}</strong></td>
                    <td class="text-center"><span class="badge-negative">{{ $s->quantity }}</span></td>
                    <td class="text-right">{{ number_format($s->price, 2) }} OMR</td>
                    <td class="text-right" style="font-weight: bold; color: #1e40af;">{{ number_format($sTotal, 2) }} OMR</td>
                    <td><strong>{{ $s->sale?->customer?->name ?? 'Walk-in Customer' }}</strong></td>
                    <td>
                        <span class="badge-blue">#SALE-{{ $s->sale_id }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 15px; color: #94a3b8;">No cylinder sales records found.</td>
                </tr>
                @endforelse
                @if(count($salesList) > 0)
                <tr class="total-row">
                    <td colspan="3" class="text-right">TOTAL:</td>
                    <td class="text-center">{{ number_format($totalSoldFilteredQty) }} Units</td>
                    <td class="text-right">—</td>
                    <td class="text-right">{{ number_format($totalSoldFilteredRevenue, 2) }} OMR</td>
                    <td colspan="2"></td>
                </tr>
                @endif
            </tbody>
        </table>

    {{-- ═════════════════════════════════════════════════════════ --}}
    {{-- C) ALL INVENTORY COMBINED REPORT VIEW --}}
    {{-- ═════════════════════════════════════════════════════════ --}}
    @else

        {{-- Top Overview KPIs --}}
        <table class="kpi-table">
            <tr>
                <td width="25%">
                    <div class="kpi-box">
                        <div class="kpi-title">Total Cylinders Bought</div>
                        <div class="kpi-val" style="color: #16a34a;">{{ number_format($totalPurchasedQty) }} Units</div>
                    </div>
                </td>
                <td width="25%">
                    <div class="kpi-box">
                        <div class="kpi-title">Total Purchase Cost</div>
                        <div class="kpi-val" style="color: #2563eb;">{{ number_format($totalPurchaseCost, 2) }} OMR</div>
                    </div>
                </td>
                <td width="25%">
                    <div class="kpi-box">
                        <div class="kpi-title">Total Cylinders Sold</div>
                        <div class="kpi-val" style="color: #dc2626;">{{ number_format($totalSoldCylinders) }} Units</div>
                    </div>
                </td>
                <td width="25%">
                    <div class="kpi-box">
                        <div class="kpi-title">Current Net Balance</div>
                        <div class="kpi-val">{{ number_format(($stocks['11kg_empty'] ?? 0) + ($stocks['22kg_empty'] ?? 0) + ($stocks['44kg_empty'] ?? 0)) }} Units</div>
                    </div>
                </td>
            </tr>
        </table>

        {{-- Size Wise Comparison --}}
        <div class="section-title">1. Cylinder Size-Wise: Purchase vs Sale Comparison (11kg, 22kg, 44kg)</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Cylinder Size</th>
                    <th class="text-center">Stock Left</th>
                    <th class="text-center">Bought (Qty)</th>
                    <th class="text-right">Buy Unit Price</th>
                    <th class="text-right">Total Buy Cost</th>
                    <th class="text-center">Sold (Qty)</th>
                    <th class="text-right">Sale Unit Price</th>
                    <th class="text-right">Sale Revenue</th>
                    <th class="text-right">Gross Profit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cylinderSizeDetails as $sizeKey => $item)
                <tr>
                    <td><strong>{{ $item['name'] }}</strong></td>
                    <td class="text-center"><strong>{{ $item['remaining'] }}</strong></td>
                    <td class="text-center">{{ number_format($item['purchased_qty']) }}</td>
                    <td class="text-right">{{ number_format($item['purchase_price'], 2) }} OMR</td>
                    <td class="text-right">{{ number_format($item['total_purchase_cost'], 2) }} OMR</td>
                    <td class="text-center">{{ number_format($item['sold_qty']) }}</td>
                    <td class="text-right">{{ number_format($item['sale_price'], 2) }} OMR</td>
                    <td class="text-right">{{ number_format($item['total_sale_revenue'], 2) }} OMR</td>
                    <td class="text-right {{ $item['profit'] >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ $item['profit'] >= 0 ? '+' : '' }}{{ number_format($item['profit'], 2) }} OMR
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Monthly Combined Breakdown --}}
        <div class="section-title">2. Monthly Cylinder Purchases &amp; Sales Audit (Last 6 Months)</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Month &amp; Year</th>
                    <th class="text-center">Purchased (In)</th>
                    <th class="text-right">Purchase Cost (OMR)</th>
                    <th class="text-center">Sold (Out)</th>
                    <th class="text-right">Sales Revenue (OMR)</th>
                    <th class="text-center">Net Monthly Movement</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthsBreakdown as $m)
                @php $net = $m['bought_qty'] - $m['sold_qty']; @endphp
                <tr>
                    <td><strong>{{ $m['month'] }}</strong></td>
                    <td class="text-center">{{ $m['bought_qty'] > 0 ? '+' . $m['bought_qty'] : '0' }}</td>
                    <td class="text-right">{{ $m['bought_cost'] > 0 ? number_format($m['bought_cost'], 2) : '0.00' }}</td>
                    <td class="text-center">{{ $m['sold_qty'] > 0 ? '-' . $m['sold_qty'] : '0' }}</td>
                    <td class="text-right">{{ ($m['sold_revenue'] ?? 0) > 0 ? number_format($m['sold_revenue'], 2) : '0.00' }}</td>
                    <td class="text-center {{ $net >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ $net > 0 ? '+' . $net : $net }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Detailed Transaction Log --}}
        <div class="section-title">3. Detailed Stock Transactions, Purchases &amp; Adjustments History</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Cylinder Type</th>
                    <th class="text-center">Qty Change</th>
                    <th class="text-right">Buy Price</th>
                    <th class="text-right">Total Cost</th>
                    <th>Supplier / Notes</th>
                </tr>
            </thead>
            <tbody>
                @forelse($history as $item)
                @php
                    $isPurchase = $item->quantity > 0;
                    $dateStr = $item->transaction_date ? \Carbon\Carbon::parse($item->transaction_date)->format('d M Y') : $item->created_at->format('d M Y');
                    $typeLabel = str_replace(['_empty', '_'], [' New Cylinder', ' '], ucfirst($item->type));
                @endphp
                <tr>
                    <td>{{ $dateStr }}</td>
                    <td>{{ $typeLabel }}</td>
                    <td class="text-center">
                        <span class="{{ $isPurchase ? 'badge-positive' : 'badge-negative' }}">
                            {{ $isPurchase ? '+' : '' }}{{ $item->quantity }}
                        </span>
                    </td>
                    <td class="text-right">{{ $item->unit_price > 0 ? number_format($item->unit_price, 2) . ' OMR' : '—' }}</td>
                    <td class="text-right">{{ $item->total_cost > 0 ? number_format($item->total_cost, 2) . ' OMR' : '—' }}</td>
                    <td>
                        @if($item->supplier_name)
                            <strong>{{ $item->supplier_name }}</strong> - 
                        @endif
                        {{ $item->note ?: '—' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No transaction records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    @endif

    <div class="footer">
        Automated Inventory Report &bull; Printed by {{ auth()->user()->name ?? 'Administrator' }}
    </div>

</body>
</html>
