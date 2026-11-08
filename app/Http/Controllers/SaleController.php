<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Models\SaleItem;
use App\Models\Customer;
use App\Models\CylinderStock;
use App\Models\Agency;
use App\Models\AgencySetting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:sale-list', ['only' => ['index', 'show', 'downloadPdf']]);
        $this->middleware('permission:sale-create', ['only' => ['create', 'store', 'getRate']]);
        $this->middleware('permission:sale-edit', ['only' => ['edit', 'update']]); // Added edit/update permissions
        $this->middleware('permission:sale-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $customers = Customer::all();
        $query = Sale::with(['customer', 'saleItems']);

        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('date', '<=', $request->to_date);
        }

        $sales = $query->latest()->paginate(50)->withQueryString(); // Increased pagination for easier filtering view
        
        // Sales statistics
        $today = now()->toDateString();
        $todayRevenue = Sale::whereDate('date', $today)->sum('total_amount');
        $todayInvoicesCount = Sale::whereDate('date', $today)->count();
        $totalSalesRevenue = Sale::sum('total_amount');
        $totalOrdersCount = Sale::count();

        return view('sales.index', compact('sales', 'customers', 'todayRevenue', 'todayInvoicesCount', 'totalSalesRevenue', 'totalOrdersCount'));
    }

    public function create()
    {
        $customers = Customer::all();
        // Get current stock levels
        $stockLevels = CylinderStock::select('type', DB::raw('SUM(quantity) as total'))
            ->groupBy('type')
            ->pluck('total', 'type');

        return view('sales.create', compact('customers', 'stockLevels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            // No longer validating "items" array as a whole if we use flat fields, 
            // but we'll collect the data below.
        ]);

        try {
            DB::beginTransaction();

            $sale = Sale::create([
                'customer_id' => $request->customer_id,
                'date' => $request->date,
                'total_amount' => 0, // Will update below
            ]);

            $totalAmount = 0;
            $items = [];

            // Define categories
            $categories = [
                'filled' => ['11kg', '22kg', '44kg'],
                'new' => ['11kg', '22kg', '44kg'],
            ];

            foreach ($categories as $cat => $weights) {
                foreach ($weights as $weight) {
                    $qtyKey = "{$cat}_{$weight}_qty";
                    $priceKey = "{$cat}_{$weight}_price";
                    
                    $qty = $request->$qtyKey;
                    $price = $request->$priceKey;

                    if ($qty > 0) {
                        $type = "{$weight}_" . ($cat == 'filled' ? 'full' : 'empty');
                        
                        // IF NEW CYLINDER, CHECK STOCK
                        if ($cat == 'new') {
                            $stockType = "{$weight}_empty";
                            $currentStock = (int) CylinderStock::where('type', $stockType)->sum('quantity');
                            
                            if ($currentStock <= 0) {
                                throw new \Exception(__('messages.new_cylinder_not_in_stock_error', ['weight' => $weight]));
                            }

                            if ($currentStock < $qty) {
                                throw new \Exception(__('messages.insufficient_stock_error', [
                                    'weight' => $weight,
                                    'stock' => $currentStock,
                                    'qty' => $qty,
                                ]));
                            }

                            // Reduce Stock for New Cylinder
                            CylinderStock::create([
                                'type' => $stockType,
                                'quantity' => -1 * abs($qty),
                                'note' => "New Cylinder Sale #{$sale->id}",
                            ]);
                        }

                        // SAVE SALE ITEM
                        SaleItem::create([
                            'sale_id' => $sale->id,
                            'type' => $type,
                            'quantity' => $qty,
                            'price' => $price,
                        ]);

                        $totalAmount += ($qty * $price);
                    }
                }
            }

            $sale->update(['total_amount' => $totalAmount]);

            DB::commit();

            return redirect()->route('sales.index')
                            ->with('success', 'Sale created successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Sale $sale)
    {
        $sale->load('customer', 'saleItems');
        return view('sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        // Complex to edit sales affecting inventory.
        // For simplicity, maybe restrict editing or handle inventory reversal.
        // I will return 'Not Implemented' or simple edit without inventory update for now, 
        // to be safe, or just allow editing date/customer.
        return redirect()->route('sales.index')->with('error', 'Editing sales is not supported for data integrity. Delete and re-create if needed.');
    }

    public function update(Request $request, Sale $sale)
    {
        // Not implemented
    }

    public function destroy(Sale $sale)
    {
        // Logic to reverse inventory? 
        // For now, soft delete or just delete.
        // Users can manually correct stock if they delete a sale.
        $sale->delete();
        return redirect()->route('sales.index')
                        ->with('success', 'Sale deleted successfully.');
    }

    public function downloadPdf(Sale $sale)
    {
        $sale->load('customer', 'saleItems');
        $agencyId = auth()->user()->agency_id ?? ($sale->agency_id ?? null);
        $agency = $agencyId ? Agency::with('setting')->find($agencyId) : null;
        $setting = $agency ? $agency->setting : null;

        $pdf = Pdf::loadView('sales.pdf', compact('sale', 'agency', 'setting'));
        return $pdf->download('invoice_'.$sale->id.'.pdf');
    }

    public function downloadFilteredPdf(Request $request)
    {
        $query = Sale::with(['customer', 'saleItems']);

        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('date', '<=', $request->to_date);
        }

        $sales = $query->latest()->get();
        $pdf = Pdf::loadView('sales.report_pdf', compact('sales'))->setPaper('a4', 'landscape');
        
        return $pdf->download('sales_report_'.now()->format('Y-m-d').'.pdf');
    }
}
