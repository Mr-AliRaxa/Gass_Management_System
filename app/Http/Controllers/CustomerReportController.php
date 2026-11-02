<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Customer;
use App\Models\AgencySetting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CustomerReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:customer-report-list', ['only' => ['index', 'downloadPdf']]);
    }

    /**
     * Display the Customers Sales & Cylinder Report.
     */
    public function index(Request $request)
    {
        $customers = Customer::orderBy('name')->get();
        
        $customerId = $request->query('customer_id');
        $fromDate   = $request->query('from_date');
        $toDate     = $request->query('to_date');

        $query = Sale::with(['customer', 'saleItems']);

        if ($request->filled('customer_id')) {
            $query->where('customer_id', $customerId);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('date', '>=', $fromDate);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('date', '<=', $toDate);
        }

        // Summary calculations (on the filtered dataset before pagination)
        $summaryQuery = clone $query;
        $filteredSaleIds = $summaryQuery->pluck('id');

        $totalRevenue = (clone $query)->sum('total_amount');
        $totalOrders  = $filteredSaleIds->count();

        // Quantities breakdown from SaleItem
        $itemStats = SaleItem::whereIn('sale_id', $filteredSaleIds)
            ->select('type', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(quantity * price) as total_subtotal'))
            ->groupBy('type')
            ->pluck('total_qty', 'type');

        $stats = [
            'filled_11kg' => (int) ($itemStats['11kg_full'] ?? 0),
            'filled_22kg' => (int) ($itemStats['22kg_full'] ?? 0),
            'filled_44kg' => (int) ($itemStats['44kg_full'] ?? 0),
            'new_11kg'    => (int) ($itemStats['11kg_empty'] ?? 0),
            'new_22kg'    => (int) ($itemStats['22kg_empty'] ?? 0),
            'new_44kg'    => (int) ($itemStats['44kg_empty'] ?? 0),
        ];

        $stats['total_filled']   = $stats['filled_11kg'] + $stats['filled_22kg'] + $stats['filled_44kg'];
        $stats['total_new']      = $stats['new_11kg'] + $stats['new_22kg'] + $stats['new_44kg'];
        $stats['total_cylinders']= $stats['total_filled'] + $stats['total_new'];
        $stats['total_revenue']  = $totalRevenue;
        $stats['total_orders']   = $totalOrders;

        // Selected customer info (if filtered by single customer)
        $selectedCustomer = null;
        $customerLifetimeStats = null;
        if ($request->filled('customer_id')) {
            $selectedCustomer = Customer::withCount('sales')
                ->withSum('sales', 'total_amount')
                ->find($customerId);
        }

        // Paginate results
        $sales = $query->latest('date')->latest('id')->paginate(30)->withQueryString();

        return view('customer_reports.index', compact(
            'customers',
            'sales',
            'stats',
            'selectedCustomer',
            'customerId',
            'fromDate',
            'toDate'
        ));
    }

    /**
     * Download or Print the Customer Report as PDF.
     */
    public function downloadPdf(Request $request)
    {
        $customerId = $request->query('customer_id');
        $fromDate   = $request->query('from_date');
        $toDate     = $request->query('to_date');

        $query = Sale::with(['customer', 'saleItems']);

        $selectedCustomer = null;
        if ($request->filled('customer_id')) {
            $query->where('customer_id', $customerId);
            $selectedCustomer = Customer::find($customerId);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('date', '>=', $fromDate);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('date', '<=', $toDate);
        }

        $sales = $query->latest('date')->latest('id')->get();

        // Compute totals
        $totals = [
            'filled_11kg' => 0,
            'filled_22kg' => 0,
            'filled_44kg' => 0,
            'new_11kg'    => 0,
            'new_22kg'    => 0,
            'new_44kg'    => 0,
            'total_filled'=> 0,
            'total_new'   => 0,
            'total_qty'   => 0,
            'grand_amount'=> 0,
        ];

        foreach ($sales as $sale) {
            $totals['grand_amount'] += (float) $sale->total_amount;
            foreach ($sale->saleItems as $item) {
                $qty = (int) $item->quantity;
                switch ($item->type) {
                    case '11kg_full':  $totals['filled_11kg'] += $qty; $totals['total_filled'] += $qty; break;
                    case '22kg_full':  $totals['filled_22kg'] += $qty; $totals['total_filled'] += $qty; break;
                    case '44kg_full':  $totals['filled_44kg'] += $qty; $totals['total_filled'] += $qty; break;
                    case '11kg_empty': $totals['new_11kg'] += $qty; $totals['total_new'] += $qty; break;
                    case '22kg_empty': $totals['new_22kg'] += $qty; $totals['total_new'] += $qty; break;
                    case '44kg_empty': $totals['new_44kg'] += $qty; $totals['total_new'] += $qty; break;
                }
                $totals['total_qty'] += $qty;
            }
        }

        $agencyId = auth()->user()->agency_id;
        $setting = AgencySetting::where('agency_id', $agencyId)->first();

        $pdf = Pdf::loadView('customer_reports.pdf', compact(
            'sales',
            'totals',
            'selectedCustomer',
            'fromDate',
            'toDate',
            'setting'
        ))->setPaper('a4', 'landscape');

        $fileName = 'customer_report_' . ($selectedCustomer ? str_replace(' ', '_', $selectedCustomer->name) . '_' : 'all_') . now()->format('Ymd_His') . '.pdf';

        return $pdf->download($fileName);
    }
}

