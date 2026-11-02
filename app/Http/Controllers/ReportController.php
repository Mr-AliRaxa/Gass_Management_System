<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Expense;
use App\Models\Salary;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Attendance;
use App\Models\GasReading;

class ReportController extends Controller
{
    public function download($type, Request $request)
    {
        $startDate = null;
        $endDate = null;
        $title = "";

        $selectedMonth = $request->query('month');
        $selectedYear = $request->query('year');

        switch ($type) {
            case 'daily':
                $startDate = Carbon::today();
                $endDate = Carbon::today();
                $title = "Daily Report - " . $startDate->format('d M Y');
                break;
            case 'weekly':
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                $title = "Weekly Report (" . $startDate->format('d M') . " - " . $endDate->format('d M Y') . ")";
                break;
            case 'monthly':
                if ($selectedMonth && $selectedYear) {
                    $startDate = Carbon::createFromDate($selectedYear, $selectedMonth, 1)->startOfMonth();
                    $endDate = (clone $startDate)->endOfMonth();
                } else {
                    $startDate = Carbon::now()->startOfMonth();
                    $endDate = Carbon::now()->endOfMonth();
                }
                $title = "Monthly Report - " . $startDate->format('F Y');
                break;
            case 'yearly':
                if ($selectedYear) {
                    $startDate = Carbon::createFromDate($selectedYear, 1, 1)->startOfYear();
                    $endDate = (clone $startDate)->endOfYear();
                } else {
                    $startDate = Carbon::now()->startOfYear();
                    $endDate = Carbon::now()->endOfYear();
                }
                $title = "Yearly Report - " . $startDate->format('Y');
                break;
            default:
                abort(404);
        }

        if (!$endDate) {
            $endDate = Carbon::today();
        }
        
        $agencyId = auth()->user()->agency_id;
        $setting = \App\Models\AgencySetting::where('agency_id', $agencyId)->first();

        // Arabic text shaping for PDF
        $arabic = new \ArPHP\I18N\Arabic();
        $labels = [
            'sales_detail_ar' => $arabic->utf8Glyphs('تفاصيل المبيعات'),
            'expenses_detail_ar' => $arabic->utf8Glyphs('تفاصيل المصروفات'),
            'salaries_detail_ar' => $arabic->utf8Glyphs('تفاصيل الرواتب'),
            'attendance_detail_ar' => $arabic->utf8Glyphs('تفاصيل الحضور'),
            'gas_reading_detail_ar' => $arabic->utf8Glyphs('تفاصيل قراءة الغاز'),
            'total_sales_ar' => $arabic->utf8Glyphs('إجمالي المبيعات'),
            'total_expenses_ar' => $arabic->utf8Glyphs('إجمالي المصروفات'),
            'total_salaries_ar' => $arabic->utf8Glyphs('إجمالي الرواتب المدفوعة'),
            'net_profit_ar' => $arabic->utf8Glyphs('صافي الربح'),
        ];

        $sales = Sale::whereBetween('date', [$startDate, $endDate])->get();
        $expenses = Expense::whereBetween('date', [$startDate, $endDate])->get();
        $salaries = Salary::whereBetween('date', [$startDate, $endDate])->get();
        $attendances = Attendance::with('teamMember')->whereBetween('date', [$startDate, $endDate])->get();
        $gasReadings = GasReading::whereBetween('date', [$startDate, $endDate])->get();

        $totalSales = $sales->sum('total_amount');
        $totalExpenses = $expenses->sum('amount');
        $totalSalaries = $salaries->sum('amount');
        $netProfit = $totalSales - ($totalExpenses + $totalSalaries);

        $pdf = Pdf::loadView('reports.pdf', compact(
            'type', 'title', 'startDate', 'endDate', 
            'sales', 'expenses', 'salaries', 'attendances', 'gasReadings',
            'totalSales', 'totalExpenses', 'totalSalaries', 'netProfit', 'setting', 'labels'
        ));

        return $pdf->download(strtolower(str_replace(' ', '_', $title)) . '.pdf');
    }

    public function getData(Request $request)
    {
        $type = $request->query('type', 'monthly');
        $selectedMonth = $request->query('month');
        $selectedYear = $request->query('year');

        $startDate = null;
        $endDate = null;

        if ($type === 'monthly') {
            if ($selectedMonth && $selectedYear) {
                $startDate = Carbon::createFromDate($selectedYear, $selectedMonth, 1)->startOfMonth();
                $endDate = (clone $startDate)->endOfMonth();
            } else {
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
            }
        } elseif ($type === 'yearly') {
            if ($selectedYear) {
                $startDate = Carbon::createFromDate($selectedYear, 1, 1)->startOfYear();
                $endDate = (clone $startDate)->endOfYear();
            } else {
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
            }
        } else {
            return response()->json(['error' => 'Invalid type'], 400);
        }

        $sales = (float) Sale::whereBetween('date', [$startDate, $endDate])->sum('total_amount');
        $expenses = (float) Expense::whereBetween('date', [$startDate, $endDate])->sum('amount');
        $salaries = (float) Salary::whereBetween('date', [$startDate, $endDate])->sum('amount');
        $profit = $sales - ($expenses + $salaries);

        $gas = (float) (GasReading::whereBetween('date', [$startDate, $endDate])
            ->selectRaw('SUM(end_reading - start_reading) as total')
            ->first()->total ?? 0);

        $totalSum = $sales + $expenses + $salaries + $gas;
        $salesPct = $totalSum > 0 ? number_format(($sales / $totalSum) * 100, 1) : '0.0';
        $expPct = $totalSum > 0 ? number_format(($expenses / $totalSum) * 100, 1) : '0.0';
        $salPct = $totalSum > 0 ? number_format(($salaries / $totalSum) * 100, 1) : '0.0';
        $gasPct = $totalSum > 0 ? number_format(($gas / $totalSum) * 100, 1) : '0.0';

        return response()->json([
            'sales' => $sales,
            'sales_formatted' => number_format($sales, 2),
            'sales_pct' => $salesPct,

            'expenses' => $expenses,
            'expenses_formatted' => number_format($expenses, 2),
            'expenses_pct' => $expPct,

            'salaries' => $salaries,
            'salaries_formatted' => number_format($salaries, 2),
            'salaries_pct' => $salPct,

            'profit' => $profit,
            'profit_formatted' => number_format($profit, 2),

            'gas' => $gas,
            'gas_formatted' => number_format($gas, 2),
            'gas_pct' => $gasPct,

            'formatted_period' => $type === 'monthly' ? $startDate->format('F Y') : $startDate->format('Y')
        ]);
    }
}
