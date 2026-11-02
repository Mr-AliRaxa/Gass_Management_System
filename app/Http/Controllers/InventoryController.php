<?php

namespace App\Http\Controllers;

use App\Models\CylinderStock;
use App\Models\SaleItem;
use App\Models\Sale;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:inventory-list', ['only' => ['index', 'downloadPdf']]);
        $this->middleware('permission:inventory-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:inventory-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:inventory-delete', ['only' => ['destroy']]);
    }

    /**
     * Display comprehensive inventory management dashboard.
     */
    public function index(Request $request)
    {
        // 1. Current stock quantities
        $types = ['11kg_empty', '22kg_empty', '44kg_empty'];
        $stocks = [];
        foreach ($types as $t) {
            $stocks[$t] = CylinderStock::where('type', $t)->sum('quantity');
        }

        // 2. Total purchased cylinders and cost
        $totalPurchasedQty = CylinderStock::where('quantity', '>', 0)->sum('quantity');
        $totalPurchaseCost = CylinderStock::where('quantity', '>', 0)->sum('total_cost');

        // 3. Separate Details for each cylinder size (11kg, 22kg, 44kg): Purchase vs Sale Prices & Metrics
        $sizes = ['11kg', '22kg', '44kg'];
        $cylinderSizeDetails = [];

        foreach ($sizes as $s) {
            $stockType = $s . '_empty';

            // Available Remaining Stock
            $remaining = CylinderStock::where('type', $stockType)->sum('quantity');

            // Total Purchased
            $purchasedQty = CylinderStock::where('type', $stockType)->where('quantity', '>', 0)->sum('quantity');
            $purchasedCost = CylinderStock::where('type', $stockType)->where('quantity', '>', 0)->sum('total_cost');
            // Latest or average purchase price
            $latestPurchase = CylinderStock::where('type', $stockType)->where('quantity', '>', 0)->where('unit_price', '>', 0)->latest()->first();
            $purchasePrice = $latestPurchase ? $latestPurchase->unit_price : ($purchasedQty > 0 ? ($purchasedCost / $purchasedQty) : 0);

            // Total Sold (New Cylinders Sold)
            $soldQty = SaleItem::where('type', $stockType)->sum('quantity');
            $soldRevenue = SaleItem::where('type', $stockType)->selectRaw('SUM(quantity * price) as revenue')->value('revenue') ?? 0;
            // Latest or average sale price
            $latestSale = SaleItem::where('type', $stockType)->where('price', '>', 0)->latest()->first();
            $salePrice = $latestSale ? $latestSale->price : ($soldQty > 0 ? ($soldRevenue / $soldQty) : 0);

            // Gross Profit on sold units
            $profit = $soldRevenue - ($soldQty * $purchasePrice);

            $cylinderSizeDetails[$s] = [
                'name' => $s . ' Cylinder',
                'stock_type' => $stockType,
                'remaining' => $remaining,
                'purchased_qty' => $purchasedQty,
                'purchase_price' => $purchasePrice,
                'total_purchase_cost' => $purchasedCost,
                'sold_qty' => $soldQty,
                'sale_price' => $salePrice,
                'total_sale_revenue' => $soldRevenue,
                'estimated_profit' => $profit,
            ];
        }

        $totalSold11kg = $cylinderSizeDetails['11kg']['sold_qty'];
        $totalSold22kg = $cylinderSizeDetails['22kg']['sold_qty'];
        $totalSold44kg = $cylinderSizeDetails['44kg']['sold_qty'];
        $totalSoldCylinders = $totalSold11kg + $totalSold22kg + $totalSold44kg;

        // 4. Monthly Stock Movement Breakdown (Last 6 Months)
        $monthsBreakdown = [];
        for ($i = 0; $i < 6; $i++) {
            $monthDate = Carbon::now()->subMonths($i);
            $monthLabel = $monthDate->format('M Y');

            // Bought per size
            $b11 = CylinderStock::where('type', '11kg_empty')->where('quantity', '>', 0)
                ->whereYear(DB::raw('COALESCE(transaction_date, created_at)'), $monthDate->year)
                ->whereMonth(DB::raw('COALESCE(transaction_date, created_at)'), $monthDate->month)->sum('quantity');
            $b22 = CylinderStock::where('type', '22kg_empty')->where('quantity', '>', 0)
                ->whereYear(DB::raw('COALESCE(transaction_date, created_at)'), $monthDate->year)
                ->whereMonth(DB::raw('COALESCE(transaction_date, created_at)'), $monthDate->month)->sum('quantity');
            $b44 = CylinderStock::where('type', '44kg_empty')->where('quantity', '>', 0)
                ->whereYear(DB::raw('COALESCE(transaction_date, created_at)'), $monthDate->year)
                ->whereMonth(DB::raw('COALESCE(transaction_date, created_at)'), $monthDate->month)->sum('quantity');

            // Total bought & cost in month
            $boughtInMonth = CylinderStock::where('quantity', '>', 0)
                ->whereYear(DB::raw('COALESCE(transaction_date, created_at)'), $monthDate->year)
                ->whereMonth(DB::raw('COALESCE(transaction_date, created_at)'), $monthDate->month)
                ->selectRaw('SUM(quantity) as qty, SUM(total_cost) as cost')
                ->first();

            // Sold per size
            $s11 = SaleItem::where('type', '11kg_empty')->whereHas('sale', function ($q) use ($monthDate) {
                $q->whereYear('date', $monthDate->year)->whereMonth('date', $monthDate->month);
            })->sum('quantity');
            $s22 = SaleItem::where('type', '22kg_empty')->whereHas('sale', function ($q) use ($monthDate) {
                $q->whereYear('date', $monthDate->year)->whereMonth('date', $monthDate->month);
            })->sum('quantity');
            $s44 = SaleItem::where('type', '44kg_empty')->whereHas('sale', function ($q) use ($monthDate) {
                $q->whereYear('date', $monthDate->year)->whereMonth('date', $monthDate->month);
            })->sum('quantity');

            // Total sold revenue in month
            $soldRevenueMonth = SaleItem::whereIn('type', ['11kg_empty', '22kg_empty', '44kg_empty'])->whereHas('sale', function ($q) use ($monthDate) {
                $q->whereYear('date', $monthDate->year)->whereMonth('date', $monthDate->month);
            })->selectRaw('SUM(quantity * price) as revenue')->value('revenue') ?? 0;

            $totalBought = $boughtInMonth->qty ?? 0;
            $totalCost   = $boughtInMonth->cost ?? 0;
            $totalSold   = $s11 + $s22 + $s44;

            $monthsBreakdown[] = [
                'month'         => $monthLabel,
                'bought_11kg'   => $b11,
                'bought_22kg'   => $b22,
                'bought_44kg'   => $b44,
                'bought_qty'    => $totalBought,
                'bought_cost'   => $totalCost,
                'sold_11kg'     => $s11,
                'sold_22kg'     => $s22,
                'sold_44kg'     => $s44,
                'sold_qty'      => $totalSold,
                'sold_revenue'  => $soldRevenueMonth,
                'net_qty'       => $totalBought - $totalSold,
            ];
        }

        // 5. Separate Queries for Purchases Log & Sales Log
        // (A) Purchases Log Query
        $purchaseQuery = CylinderStock::where('quantity', '>', 0)->latest();
        if ($request->filled('type')) {
            $purchaseQuery->where('type', $request->type);
        }
        if ($request->filled('from_date')) {
            $purchaseQuery->whereDate(DB::raw('COALESCE(transaction_date, created_at)'), '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $purchaseQuery->whereDate(DB::raw('COALESCE(transaction_date, created_at)'), '<=', $request->to_date);
        }
        $purchasesList = $purchaseQuery->paginate(15, ['*'], 'purchases_page')->withQueryString();
        $totalPurchasedFilteredQty = (clone $purchaseQuery)->reorder()->sum('quantity');
        $totalPurchasedFilteredCost = (clone $purchaseQuery)->reorder()->sum('total_cost');

        // (B) Sales Log Query (New Cylinders Sold)
        $saleQuery = SaleItem::with(['sale.customer'])->whereIn('type', ['11kg_empty', '22kg_empty', '44kg_empty'])->latest();
        if ($request->filled('type')) {
            $saleQuery->where('type', $request->type);
        }
        if ($request->filled('from_date')) {
            $saleQuery->whereHas('sale', function ($q) use ($request) {
                $q->whereDate('date', '>=', $request->from_date);
            });
        }
        if ($request->filled('to_date')) {
            $saleQuery->whereHas('sale', function ($q) use ($request) {
                $q->whereDate('date', '<=', $request->to_date);
            });
        }
        $salesList = $saleQuery->paginate(15, ['*'], 'sales_page')->withQueryString();
        $totalSoldFilteredQty = (clone $saleQuery)->reorder()->sum('quantity');
        $totalSoldFilteredRevenue = (clone $saleQuery)->reorder()->selectRaw('SUM(quantity * price) as revenue')->value('revenue') ?? 0;

        // (C) Combined Stock Transactions History (All events)
        $query = CylinderStock::latest();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('action')) {
            if ($request->action == 'purchase') {
                $query->where('quantity', '>', 0);
            } elseif ($request->action == 'sale_deduction') {
                $query->where('quantity', '<', 0);
            }
        }
        if ($request->filled('from_date')) {
            $query->whereDate(DB::raw('COALESCE(transaction_date, created_at)'), '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate(DB::raw('COALESCE(transaction_date, created_at)'), '<=', $request->to_date);
        }

        $history = $query->paginate(20, ['*'], 'history_page')->withQueryString();

        return view('inventory.index', compact(
            'stocks',
            'history',
            'purchasesList',
            'salesList',
            'totalPurchasedFilteredQty',
            'totalPurchasedFilteredCost',
            'totalSoldFilteredQty',
            'totalSoldFilteredRevenue',
            'totalPurchasedQty',
            'totalPurchaseCost',
            'totalSoldCylinders',
            'totalSold11kg',
            'totalSold22kg',
            'totalSold44kg',
            'monthsBreakdown',
            'cylinderSizeDetails'
        ));
    }

    public function create()
    {
        return view('inventory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:11kg_empty,22kg_empty,44kg_empty',
            'quantity' => 'required|integer',
            'unit_price' => 'nullable|numeric|min:0',
            'transaction_date' => 'nullable|date',
            'supplier_name' => 'nullable|string|max:255',
            'note' => 'nullable|string',
        ]);

        $data = $request->all();
        $qty = (int) $request->quantity;
        $unitPrice = (float) ($request->unit_price ?? 0);

        // Auto calculate total purchase cost if quantity is positive
        if ($qty > 0 && $unitPrice > 0) {
            $data['total_cost'] = $qty * $unitPrice;
        } else {
            $data['total_cost'] = 0;
        }

        if (empty($data['transaction_date'])) {
            $data['transaction_date'] = Carbon::today()->toDateString();
        }

        CylinderStock::create($data);

        return redirect()->route('inventory.index')
                        ->with('success', 'Cylinder stock entry & purchase details recorded successfully.');
    }

    public function show(CylinderStock $inventory)
    {
        return view('inventory.show', compact('inventory'));
    }

    public function edit(CylinderStock $inventory)
    {
        return view('inventory.edit', compact('inventory'));
    }

    public function update(Request $request, CylinderStock $inventory)
    {
        $request->validate([
            'type' => 'required|in:11kg_empty,22kg_empty,44kg_empty',
            'quantity' => 'required|integer',
            'unit_price' => 'nullable|numeric|min:0',
            'transaction_date' => 'nullable|date',
            'supplier_name' => 'nullable|string|max:255',
            'note' => 'nullable|string',
        ]);

        $data = $request->all();
        $qty = (int) $request->quantity;
        $unitPrice = (float) ($request->unit_price ?? 0);

        if ($qty > 0 && $unitPrice > 0) {
            $data['total_cost'] = $qty * $unitPrice;
        } else {
            $data['total_cost'] = 0;
        }

        $inventory->update($data);

        return redirect()->route('inventory.index')
                        ->with('success', 'Stock entry updated successfully.');
    }

    public function destroy(CylinderStock $inventory)
    {
        $inventory->delete();

        return redirect()->route('inventory.index')
                        ->with('success', 'Stock entry deleted successfully.');
    }

    /**
     * Detailed Inventory PDF Report with purchase, sales and monthly insights.
     */
    public function downloadPdf(Request $request)
    {
        $reportType = $request->query('report_type', 'all'); // 'all', 'purchases', 'sales'

        // 1. Filtered Purchases query
        $purchaseQuery = CylinderStock::where('quantity', '>', 0)->latest();
        if ($request->filled('type')) {
            $purchaseQuery->where('type', $request->type);
        }
        if ($request->filled('from_date')) {
            $purchaseQuery->whereDate(DB::raw('COALESCE(transaction_date, created_at)'), '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $purchaseQuery->whereDate(DB::raw('COALESCE(transaction_date, created_at)'), '<=', $request->to_date);
        }
        $purchasesList = $purchaseQuery->get();
        $totalPurchasedFilteredQty = $purchasesList->sum('quantity');
        $totalPurchasedFilteredCost = $purchasesList->sum('total_cost');

        // 2. Filtered Sales query (New Cylinders Sold)
        $saleQuery = SaleItem::with(['sale.customer'])->whereIn('type', ['11kg_empty', '22kg_empty', '44kg_empty'])->latest();
        if ($request->filled('type')) {
            $saleQuery->where('type', $request->type);
        }
        if ($request->filled('from_date')) {
            $saleQuery->whereHas('sale', function ($q) use ($request) {
                $q->whereDate('date', '>=', $request->from_date);
            });
        }
        if ($request->filled('to_date')) {
            $saleQuery->whereHas('sale', function ($q) use ($request) {
                $q->whereDate('date', '<=', $request->to_date);
            });
        }
        $salesList = $saleQuery->get();
        $totalSoldFilteredQty = $salesList->sum('quantity');
        $totalSoldFilteredRevenue = $salesList->sum(function ($i) {
            return $i->quantity * $i->price;
        });

        // 3. Combined stock transactions
        $query = CylinderStock::latest();
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('action')) {
            if ($request->action == 'purchase') {
                $query->where('quantity', '>', 0);
            } elseif ($request->action == 'sale_deduction') {
                $query->where('quantity', '<', 0);
            }
        }
        if ($request->filled('from_date')) {
            $query->whereDate(DB::raw('COALESCE(transaction_date, created_at)'), '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate(DB::raw('COALESCE(transaction_date, created_at)'), '<=', $request->to_date);
        }
        $history = $query->get();

        // 4. Calculate current stock levels and details per size for PDF
        $sizes = ['11kg', '22kg', '44kg'];
        $cylinderSizeDetails = [];

        foreach ($sizes as $s) {
            $stockType = $s . '_empty';
            $remaining = CylinderStock::where('type', $stockType)->sum('quantity');
            $purchasedQty = CylinderStock::where('type', $stockType)->where('quantity', '>', 0)->sum('quantity');
            $purchasedCost = CylinderStock::where('type', $stockType)->where('quantity', '>', 0)->sum('total_cost');
            $latestPurchase = CylinderStock::where('type', $stockType)->where('quantity', '>', 0)->where('unit_price', '>', 0)->latest()->first();
            $purchasePrice = $latestPurchase ? $latestPurchase->unit_price : ($purchasedQty > 0 ? ($purchasedCost / $purchasedQty) : 0);

            $soldQty = SaleItem::where('type', $stockType)->sum('quantity');
            $soldRevenue = SaleItem::where('type', $stockType)->selectRaw('SUM(quantity * price) as revenue')->value('revenue') ?? 0;
            $latestSale = SaleItem::where('type', $stockType)->where('price', '>', 0)->latest()->first();
            $salePrice = $latestSale ? $latestSale->price : ($soldQty > 0 ? ($soldRevenue / $soldQty) : 0);

            $cylinderSizeDetails[$s] = [
                'name' => $s . ' Cylinder',
                'remaining' => $remaining,
                'purchased_qty' => $purchasedQty,
                'purchase_price' => $purchasePrice,
                'total_purchase_cost' => $purchasedCost,
                'sold_qty' => $soldQty,
                'sale_price' => $salePrice,
                'total_sale_revenue' => $soldRevenue,
                'profit' => $soldRevenue - ($soldQty * $purchasePrice),
            ];
        }

        $stocks = [
            '11kg_empty' => $cylinderSizeDetails['11kg']['remaining'],
            '22kg_empty' => $cylinderSizeDetails['22kg']['remaining'],
            '44kg_empty' => $cylinderSizeDetails['44kg']['remaining'],
        ];

        // Overall stats
        $totalPurchasedQty = CylinderStock::where('quantity', '>', 0)->sum('quantity');
        $totalPurchaseCost = CylinderStock::where('quantity', '>', 0)->sum('total_cost');
        $totalSoldCylinders = SaleItem::whereIn('type', ['11kg_empty', '22kg_empty', '44kg_empty'])->sum('quantity');

        // Monthly Breakdown
        $monthsBreakdown = [];
        for ($i = 0; $i < 6; $i++) {
            $monthDate = Carbon::now()->subMonths($i);
            $monthLabel = $monthDate->format('F Y');

            $b11 = CylinderStock::where('type', '11kg_empty')->where('quantity', '>', 0)
                ->whereYear(DB::raw('COALESCE(transaction_date, created_at)'), $monthDate->year)
                ->whereMonth(DB::raw('COALESCE(transaction_date, created_at)'), $monthDate->month)->sum('quantity');
            $b22 = CylinderStock::where('type', '22kg_empty')->where('quantity', '>', 0)
                ->whereYear(DB::raw('COALESCE(transaction_date, created_at)'), $monthDate->year)
                ->whereMonth(DB::raw('COALESCE(transaction_date, created_at)'), $monthDate->month)->sum('quantity');
            $b44 = CylinderStock::where('type', '44kg_empty')->where('quantity', '>', 0)
                ->whereYear(DB::raw('COALESCE(transaction_date, created_at)'), $monthDate->year)
                ->whereMonth(DB::raw('COALESCE(transaction_date, created_at)'), $monthDate->month)->sum('quantity');

            $boughtInMonth = CylinderStock::where('quantity', '>', 0)
                ->whereYear(DB::raw('COALESCE(transaction_date, created_at)'), $monthDate->year)
                ->whereMonth(DB::raw('COALESCE(transaction_date, created_at)'), $monthDate->month)
                ->selectRaw('SUM(quantity) as qty, SUM(total_cost) as cost')
                ->first();

            $s11 = SaleItem::where('type', '11kg_empty')->whereHas('sale', function ($q) use ($monthDate) {
                $q->whereYear('date', $monthDate->year)->whereMonth('date', $monthDate->month);
            })->sum('quantity');
            $s22 = SaleItem::where('type', '22kg_empty')->whereHas('sale', function ($q) use ($monthDate) {
                $q->whereYear('date', $monthDate->year)->whereMonth('date', $monthDate->month);
            })->sum('quantity');
            $s44 = SaleItem::where('type', '44kg_empty')->whereHas('sale', function ($q) use ($monthDate) {
                $q->whereYear('date', $monthDate->year)->whereMonth('date', $monthDate->month);
            })->sum('quantity');

            $soldRevenueMonth = SaleItem::whereIn('type', ['11kg_empty', '22kg_empty', '44kg_empty'])->whereHas('sale', function ($q) use ($monthDate) {
                $q->whereYear('date', $monthDate->year)->whereMonth('date', $monthDate->month);
            })->selectRaw('SUM(quantity * price) as revenue')->value('revenue') ?? 0;

            $totalBought = $boughtInMonth->qty ?? 0;
            $totalCost   = $boughtInMonth->cost ?? 0;
            $totalSold   = $s11 + $s22 + $s44;

            $monthsBreakdown[] = [
                'month'        => $monthLabel,
                'bought_11kg'  => $b11,
                'bought_22kg'  => $b22,
                'bought_44kg'  => $b44,
                'bought_qty'   => $totalBought,
                'bought_cost'  => $totalCost,
                'sold_11kg'    => $s11,
                'sold_22kg'    => $s22,
                'sold_44kg'    => $s44,
                'sold_qty'     => $totalSold,
                'sold_revenue' => $soldRevenueMonth,
                'net_qty'      => $totalBought - $totalSold,
            ];
        }

        $filename = 'inventory_' . $reportType . '_report_' . date('Y-m-d') . '.pdf';

        $pdf = Pdf::loadView('inventory.pdf', compact(
            'reportType',
            'purchasesList',
            'salesList',
            'totalPurchasedFilteredQty',
            'totalPurchasedFilteredCost',
            'totalSoldFilteredQty',
            'totalSoldFilteredRevenue',
            'stocks',
            'history',
            'totalPurchasedQty',
            'totalPurchaseCost',
            'totalSoldCylinders',
            'monthsBreakdown',
            'cylinderSizeDetails'
        ))->setPaper('a4', 'landscape');

        return $pdf->download($filename);
    }
}
