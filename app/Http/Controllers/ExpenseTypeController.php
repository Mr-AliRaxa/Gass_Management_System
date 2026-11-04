<?php

namespace App\Http\Controllers;

use App\Models\ExpenseType;
use Illuminate\Http\Request;

class ExpenseTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:expense-list', ['only' => ['index']]);
        $this->middleware('permission:expense-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:expense-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:expense-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $expenseTypes = ExpenseType::latest()->paginate($perPage)->withQueryString();
        return view('expense_types.index', compact('expenseTypes'));
    }

    public function create()
    {
        return view('expense_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                \Illuminate\Validation\Rule::unique('expense_types')->where(function ($query) {
                    return $query->where('agency_id', auth()->user()->agency_id);
                }),
            ],
        ]);

        ExpenseType::create($request->all());

        return redirect()->route('expense_types.index')
                        ->with('success', 'Expense Type created successfully.');
    }

    public function show(ExpenseType $expenseType)
    {
        return view('expense_types.show', compact('expenseType'));
    }

    public function edit(ExpenseType $expenseType)
    {
        return view('expense_types.edit', compact('expenseType'));
    }

    public function update(Request $request, ExpenseType $expenseType)
    {
        $request->validate([
            'name' => [
                'required',
                \Illuminate\Validation\Rule::unique('expense_types')->ignore($expenseType->id)->where(function ($query) {
                    return $query->where('agency_id', auth()->user()->agency_id);
                }),
            ],
        ]);

        $expenseType->update($request->all());

        return redirect()->route('expense_types.index')
                        ->with('success', 'Expense Type updated successfully');
    }

    public function destroy(ExpenseType $expenseType)
    {
        $expenseType->delete();

        return redirect()->route('expense_types.index')
                        ->with('success', 'Expense Type deleted successfully');
    }
}
