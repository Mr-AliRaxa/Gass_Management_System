<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\User;
use App\Models\AgencyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:agency-list');
    }

    public function index()
    {
        $agencies = Agency::with('users')->get();
        return view('super_admin.agencies.index', compact('agencies'));
    }

    public function edit($id)
    {
        $agency = Agency::findOrFail($id);
        return view('super_admin.agencies.edit', compact('agency'));
    }

    public function update(Request $request, $id)
    {
        $agency = Agency::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $agency->update([
            'name' => $request->name,
            'address' => $request->address,
            'status' => $request->status,
        ]);

        return redirect()->route('super_admin.agencies.index')->with('success', 'Agency updated successfully.');
    }

    public function destroy($id)
    {
        $agency = Agency::findOrFail($id);
        
        \Illuminate\Support\Facades\DB::transaction(function () use ($agency) {
            // 1. Collect all emails related to this agency before deletion
            $ownerEmail = null;
            $allEmails = $agency->users()->pluck('email')->toArray();
            
            // 2. Identify the owner specifically if possible for targeted request cleanup
            // (Assuming the first user created for an agency or any user with Admin role)
            
            // 3. Delete matching AgencyRequests for ALL users in this agency
            // This is the CRITICAL fix for the "Email already taken" issue.
            AgencyRequest::whereIn('email', $allEmails)->delete();
            
            // 4. Delete all users belonging to this agency
            $agency->users()->delete();
            
            // 5. Delete the agency itself
            $agency->delete();
        });

        return redirect()->route('super_admin.agencies.index')->with('success', 'Agency and all associated data, including registration requests, have been completely removed. Emails are now available for reuse.');
    }

    public function create()
    {
        return view('super_admin.agencies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'owner_email' => 'required|email|unique:users,email',
            'owner_password' => 'required|string|min:8',
        ]);

        $agency = Agency::create([
            'name' => $request->name,
        ]);

        $user = User::create([
            'name' => $request->owner_name,
            'email' => $request->owner_email,
            'password' => Hash::make($request->owner_password),
            'agency_id' => $agency->id,
            'is_owner' => true,
        ]);

        $role = Role::firstOrCreate(['name' => 'Admin']);
        $user->assignRole($role);

        return redirect()->route('super_admin.agencies.index')->with('success', 'Agency and Owner created successfully.');
    }

    public function manageRequests()
    {
        $requests = AgencyRequest::orderBy('created_at', 'desc')->get();
        return view('super_admin.requests.index', compact('requests'));
    }

    public function showProcessRequest($id)
    {
        $agencyRequest = AgencyRequest::findOrFail($id);
        
        if ($agencyRequest->status !== 'pending') {
            return redirect()->route('super_admin.requests.index')->with('error', 'Request already processed.');
        }

        return view('super_admin.requests.process', compact('agencyRequest'));
    }

    public function approve(Request $request, $id)
    {
        $agencyRequest = AgencyRequest::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // 1. Create Agency
        $agency = Agency::create([
            'name' => $request->name,
            'address' => $agencyRequest->location,
        ]);

        // 2. Create Owner User
        $user = User::create([
            'name' => $request->owner_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'agency_id' => $agency->id,
            'is_owner' => true,
        ]);

        $role = Role::firstOrCreate(['name' => 'Admin']);
        $user->assignRole($role);

        // 3. Update Request Status
        $agencyRequest->update(['status' => 'approved']);

        return redirect()->route('super_admin.agencies.index')->with('success', "Agency created! Login credentials generated for {$user->email}.");
    }

    public function reject($id)
    {
        $agencyRequest = AgencyRequest::findOrFail($id);
        $agencyRequest->update(['status' => 'rejected']);

        return redirect()->route('super_admin.requests.index')->with('success', 'Agency request rejected.');
    }
}
