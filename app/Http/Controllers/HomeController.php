<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Expense;
use App\Models\Salary;
use App\Models\GasReading;
use App\Models\Customer;
use App\Models\CylinderStock;
use App\Models\VisaDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return redirect()->route('super_admin.dashboard');
        }
        // Daily Stats
        $dailySales = Sale::whereDate('date', Carbon::today())->sum('total_amount');
        $dailyExpenses = Expense::whereDate('date', Carbon::today())->sum('amount');
        $dailySalaries = Salary::whereDate('date', Carbon::today())->sum('amount');
        $dailyProfit = $dailySales - ($dailyExpenses + $dailySalaries);

        // Weekly Stats
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $weeklySales = Sale::whereBetween('date', [$startOfWeek, $endOfWeek])->sum('total_amount');
        $weeklyExpenses = Expense::whereBetween('date', [$startOfWeek, $endOfWeek])->sum('amount');
        $weeklySalaries = Salary::whereBetween('date', [$startOfWeek, $endOfWeek])->sum('amount');
        $weeklyProfit = $weeklySales - ($weeklyExpenses + $weeklySalaries);

        // Monthly Stats
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $monthlySales = Sale::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('total_amount');
        $monthlyExpenses = Expense::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('amount');
        $monthlySalaries = Salary::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('amount');
        $monthlyProfit = $monthlySales - ($monthlyExpenses + $monthlySalaries);

        // Yearly Stats
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        $yearlySales = Sale::whereBetween('date', [$startOfYear, $endOfYear])->sum('total_amount');
        $yearlyExpenses = Expense::whereBetween('date', [$startOfYear, $endOfYear])->sum('amount');
        $yearlySalaries = Salary::whereBetween('date', [$startOfYear, $endOfYear])->sum('amount');
        $yearlyProfit = $yearlySales - ($yearlyExpenses + $yearlySalaries);

        $totalExpenses = Expense::sum('amount');
        $totalSalaries = Salary::sum('amount');

        // Gas Readings Aggregation
        $getGasUsed = function($startDate, $endDate) {
            return GasReading::whereBetween('date', [$startDate, $endDate])
                ->select(DB::raw('SUM(end_reading - start_reading) as total'))
                ->first()->total ?? 0;
        };

        $dailyGas = GasReading::whereDate('date', Carbon::today())
            ->select(DB::raw('SUM(end_reading - start_reading) as total'))
            ->first()->total ?? 0;
            
        $weeklyGas = $getGasUsed($startOfWeek->toDateString(), $endOfWeek->toDateString());
        $monthlyGas = $getGasUsed($startOfMonth->toDateString(), $endOfMonth->toDateString());
        $yearlyGas = $getGasUsed($startOfYear->toDateString(), $endOfYear->toDateString());

        $totalCustomers = Customer::count();
        $totalTeamMembers = \App\Models\TeamMember::count();
        $totalStaff = \App\Models\User::where('agency_id', auth()->user()->agency_id)->count();
        $totalUsers = $totalStaff;
        $paidTeamMembersCount = Salary::distinct('team_member_id')->count('team_member_id');
        
        $recentLogins = \App\Models\LoginLog::with('user')
            ->whereHas('user', function($query) {
                $query->where('agency_id', auth()->user()->agency_id);
            })
            ->latest()
            ->take(10)
            ->get();

        // Today's Filled Cylinders Sold (11kg, 22kg, 44kg)
        $todayFilledCylinders = [];
        foreach (['11kg', '22kg', '44kg'] as $size) {
            $todayFilledCylinders[$size] = SaleItem::whereHas('sale', function ($q) {
                    $q->whereDate('date', Carbon::today());
                })
                ->where('type', $size . '_full')
                ->sum('quantity');
        }
        $totalTodayFilledCylinders = array_sum($todayFilledCylinders);

        // Cylinder Stock (11kg, 22kg, 44kg from Inventory)
        $stocks = [
            '11kg' => (int) CylinderStock::where('type', '11kg_empty')->sum('quantity'),
            '22kg' => (int) CylinderStock::where('type', '22kg_empty')->sum('quantity'),
            '44kg' => (int) CylinderStock::where('type', '44kg_empty')->sum('quantity'),
        ];

        // Charts Data (Last 7 days sales)
        $dates = collect();
        foreach(range(6, 0) as $i) {
            $date = Carbon::today()->subDays($i);
            $dates->put($date->format('Y-m-d'), 0);
        }

        $salesData = Sale::where('date', '>=', $dates->keys()->first())
            ->groupBy('date')
            ->orderBy('date')
            ->select(DB::raw('DATE(date) as date'), DB::raw('SUM(total_amount) as total'))
            ->pluck('total', 'date');

        $chartData = $dates->merge($salesData);

        // Previous 7 days sales (for % comparison)
        $prevStart = Carbon::today()->subDays(13)->format('Y-m-d');
        $prevEnd   = Carbon::today()->subDays(7)->format('Y-m-d');
        $prevWeekSales = Sale::whereBetween('date', [$prevStart, $prevEnd])->sum('total_amount');
        $last7DaysSales = $chartData->sum();
        $salesGrowthPct = ($prevWeekSales > 0)
            ? round((($last7DaysSales - $prevWeekSales) / $prevWeekSales) * 100, 1)
            : ($last7DaysSales > 0 ? 100 : 0);

        // Visa Expiration Alerts (Expiring in <= 40 days or already expired)
        $limitDate = Carbon::now()->addDays(40)->toDateString();
        $expiringVisas = VisaDetail::with('teamMember')
            ->whereDate('expiry_date', '<=', $limitDate)
            ->orderBy('expiry_date', 'asc')
            ->get();

        return view('home', compact(
            'dailySales', 'dailyExpenses', 'dailySalaries', 'dailyProfit',
            'weeklySales', 'weeklyExpenses', 'weeklySalaries', 'weeklyProfit',
            'monthlySales', 'monthlyExpenses', 'monthlySalaries', 'monthlyProfit',
            'yearlySales', 'yearlyExpenses', 'yearlySalaries', 'yearlyProfit',
            'dailyGas', 'weeklyGas', 'monthlyGas', 'yearlyGas',
            'totalExpenses', 'totalSalaries', 'paidTeamMembersCount',
            'totalCustomers', 'totalTeamMembers', 'totalStaff', 'totalUsers', 'recentLogins',
            'stocks', 'chartData', 'todayFilledCylinders', 'totalTodayFilledCylinders', 'expiringVisas',
            'last7DaysSales', 'prevWeekSales', 'salesGrowthPct'
        ));
    }
}
