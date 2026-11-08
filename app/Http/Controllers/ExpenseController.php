<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\ExpenseType;
use App\Models\AgencySetting;
use Barryvdh\DomPDF\Facade\Pdf;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:expense-list', ['only' => ['index', 'show', 'downloadPdf']]);
        $this->middleware('permission:expense-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:expense-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:expense-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $query = Expense::with('type');

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('date', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('date', '<=', $request->end_date);
        }
        
        if ($request->has('expense_type_id') && $request->expense_type_id != '') {
            $query->where('expense_type_id', $request->expense_type_id);
        }

        $expenses = $query->latest()->paginate(20)->withQueryString();
        $expenseTypes = ExpenseType::all();

        // Expense Statistics
        $today = now()->toDateString();
        $startOfMonth = now()->startOfMonth()->toDateString();
        $todayExpense = Expense::whereDate('date', $today)->sum('amount');
        $thisMonthExpense = Expense::whereDate('date', '>=', $startOfMonth)->sum('amount');
        $totalExpenseAllTime = Expense::sum('amount');
        $totalExpenseCount = Expense::count();

        return view('expenses.index', compact('expenses', 'expenseTypes', 'todayExpense', 'thisMonthExpense', 'totalExpenseAllTime', 'totalExpenseCount'));
    }

    public function create()
    {
        $expenseTypes = ExpenseType::all();
        return view('expenses.create', compact('expenseTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'expense_type_id' => 'required|exists:expense_types,id',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'slip_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'note' => 'nullable|string',
        ]);

        $input = $request->all();

        if ($request->hasFile('slip_image')) {
            $input['slip_image'] = $request->file('slip_image')->store('expense_slips', 'public');
        }

        Expense::create($input);

        return redirect()->route('expenses.index')
                        ->with('success', 'Expense added successfully.');
    }

    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        $expenseTypes = ExpenseType::all();
        return view('expenses.edit', compact('expense', 'expenseTypes'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'expense_type_id' => 'required|exists:expense_types,id',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'slip_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'note' => 'nullable|string',
        ]);

        $input = $request->all();

        if ($request->hasFile('slip_image')) {
            $input['slip_image'] = $request->file('slip_image')->store('expense_slips', 'public');
        }

        $expense->update($input);

        return redirect()->route('expenses.index')
                        ->with('success', 'Expense updated successfully');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')
                        ->with('success', 'Expense deleted successfully');
    }

    public function downloadPdf(Request $request)
    {
        $query = Expense::with('type');

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('date', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('date', '<=', $request->end_date);
        }
        
        if ($request->has('expense_type_id') && $request->expense_type_id != '') {
            $query->where('expense_type_id', $request->expense_type_id);
        }

        $expenses = $query->orderBy('date', 'desc')->get();
        $agencyId = auth()->user()->agency_id ?? null;
        $setting = $agencyId ? AgencySetting::where('agency_id', $agencyId)->first() : null;
        
        $pdf = Pdf::loadView('expenses.pdf', compact('expenses', 'setting'));
        return $pdf->download('expenses_report.pdf');
    }
}
