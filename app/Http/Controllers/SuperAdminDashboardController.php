<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\AgencyRequest;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:agency-list');
    }

    public function index()
    {
        $totalAgencies = Agency::count();
        $pendingRequests = AgencyRequest::where('status', 'pending')->count();
        $totalUsers = User::count();
        
        $recentAgencies = Agency::latest()->take(5)->get();
        $recentRequests = AgencyRequest::latest()->take(5)->get();

        return view('super_admin.dashboard', compact(
            'totalAgencies', 
            'pendingRequests', 
            'totalUsers',
            'recentAgencies',
            'recentRequests'
        ));
    }
}
