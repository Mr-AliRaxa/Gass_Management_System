<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:customer-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:customer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Customer::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('mobile', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $customers    = $query->paginate(10)->withQueryString();
        $totalCustomers = Customer::count();

        return view('customers.index', compact('customers', 'totalCustomers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_card_front' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_card_back' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('profile_pic')) {
            $input['profile_pic'] = $request->file('profile_pic')->store('customers', 'public');
        }
        if ($request->hasFile('id_card_front')) {
            $input['id_card_front'] = $request->file('id_card_front')->store('customers', 'public');
        }
        if ($request->hasFile('id_card_back')) {
            $input['id_card_back'] = $request->file('id_card_back')->store('customers', 'public');
        }

        Customer::create($input);

        return redirect()->route('customers.index')
                        ->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_card_front' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_card_back' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('profile_pic')) {
            $input['profile_pic'] = $request->file('profile_pic')->store('customers', 'public');
        }
        if ($request->hasFile('id_card_front')) {
            $input['id_card_front'] = $request->file('id_card_front')->store('customers', 'public');
        }
        if ($request->hasFile('id_card_back')) {
            $input['id_card_back'] = $request->file('id_card_back')->store('customers', 'public');
        }

        $customer->update($input);

        return redirect()->route('customers.index')
                        ->with('success', 'Customer updated successfully');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
                        ->with('success', 'Customer deleted successfully');
    }
}
