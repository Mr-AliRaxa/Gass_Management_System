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
                $targetDate = $request->query('date', Carbon::today()->toDateString());
                $startDate = Carbon::parse($targetDate)->startOfDay();
                $endDate = Carbon::parse($targetDate)->endOfDay();
                $title = "Daily Report - " . $startDate->format('d M Y');
                break;
            case 'weekly':
                $startDate = Carbon::now()->startOfWeek()->startOfDay();
                $endDate = Carbon::now()->endOfWeek()->endOfDay();
                $title = "Weekly Report (" . $startDate->format('d M') . " - " . $endDate->format('d M Y') . ")";
                break;
            case 'monthly':
                if ($selectedMonth && $selectedYear) {
                    $startDate = Carbon::createFromDate($selectedYear, $selectedMonth, 1)->startOfMonth()->startOfDay();
                    $endDate = (clone $startDate)->endOfMonth()->endOfDay();
                } else {
                    $startDate = Carbon::now()->startOfMonth()->startOfDay();
                    $endDate = Carbon::now()->endOfMonth()->endOfDay();
                }
                $title = "Monthly Report - " . $startDate->format('F Y');
                break;
            case 'yearly':
                if ($selectedYear) {
                    $startDate = Carbon::createFromDate($selectedYear, 1, 1)->startOfYear()->startOfDay();
                    $endDate = (clone $startDate)->endOfYear()->endOfDay();
                } else {
                    $startDate = Carbon::now()->startOfYear()->startOfDay();
                    $endDate = Carbon::now()->endOfYear()->endOfDay();
                }
                $title = "Yearly Report - " . $startDate->format('Y');
                break;
            default:
                abort(404);
        }

        if (!$endDate) {
            $endDate = Carbon::today()->endOfDay();
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
            'total_gas_reading_ar' => $arabic->utf8Glyphs('إجمالي استهلاك الغاز'),
            'net_profit_ar' => $arabic->utf8Glyphs('صافي الربح'),
        ];

        $startDateStr = $startDate->toDateString();
        $endDateStr = $endDate->toDateString();

        $sales = Sale::whereDate('date', '>=', $startDateStr)->whereDate('date', '<=', $endDateStr)->get();
        $expenses = Expense::whereDate('date', '>=', $startDateStr)->whereDate('date', '<=', $endDateStr)->get();
        $salaries = Salary::whereDate('date', '>=', $startDateStr)->whereDate('date', '<=', $endDateStr)->get();
        $attendances = Attendance::with('teamMember')->whereDate('date', '>=', $startDateStr)->whereDate('date', '<=', $endDateStr)->get();
        $gasReadings = GasReading::whereDate('date', '>=', $startDateStr)->whereDate('date', '<=', $endDateStr)->get();

        $totalSales = (float) $sales->sum('total_amount');
        $totalExpenses = (float) $expenses->sum('amount');
        $totalSalaries = (float) $salaries->sum('amount');
        $netProfit = $totalSales - ($totalExpenses + $totalSalaries);

        // Calculate total gas consumed / used (positive difference)
        $totalGasUsed = (float) $gasReadings->sum(function ($reading) {
            if ($reading->start_reading !== null && $reading->end_reading !== null) {
                return abs((float)$reading->start_reading - (float)$reading->end_reading);
            }
            return 0;
        });

        $pdf = Pdf::loadView('reports.pdf', compact(
            'type', 'title', 'startDate', 'endDate', 
            'sales', 'expenses', 'salaries', 'attendances', 'gasReadings',
            'totalSales', 'totalExpenses', 'totalSalaries', 'totalGasUsed', 'netProfit', 'setting', 'labels'
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

        if ($type === 'daily') {
            $targetDate = $request->query('date', Carbon::today()->toDateString());
            $startDate = Carbon::parse($targetDate)->startOfDay();
            $endDate = Carbon::parse($targetDate)->endOfDay();
        } elseif ($type === 'monthly') {
            if ($selectedMonth && $selectedYear) {
                $startDate = Carbon::createFromDate($selectedYear, $selectedMonth, 1)->startOfMonth()->startOfDay();
                $endDate = (clone $startDate)->endOfMonth()->endOfDay();
            } else {
                $startDate = Carbon::now()->startOfMonth()->startOfDay();
                $endDate = Carbon::now()->endOfMonth()->endOfDay();
            }
        } elseif ($type === 'yearly') {
            if ($selectedYear) {
                $startDate = Carbon::createFromDate($selectedYear, 1, 1)->startOfYear()->startOfDay();
                $endDate = (clone $startDate)->endOfYear()->endOfDay();
            } else {
                $startDate = Carbon::now()->startOfYear()->startOfDay();
                $endDate = Carbon::now()->endOfYear()->endOfDay();
            }
        } else {
            return response()->json(['error' => 'Invalid type'], 400);
        }

        $sales = (float) Sale::whereDate('date', '>=', $startDate->toDateString())
            ->whereDate('date', '<=', $endDate->toDateString())
            ->sum('total_amount');
        $expenses = (float) Expense::whereDate('date', '>=', $startDate->toDateString())
            ->whereDate('date', '<=', $endDate->toDateString())
            ->sum('amount');
        $salaries = (float) Salary::whereDate('date', '>=', $startDate->toDateString())
            ->whereDate('date', '<=', $endDate->toDateString())
            ->sum('amount');
        $profit = $sales - ($expenses + $salaries);

        $gas = (float) (GasReading::whereDate('date', '>=', $startDate->toDateString())
            ->whereDate('date', '<=', $endDate->toDateString())
            ->selectRaw('SUM(ABS(end_reading - start_reading)) as total')
            ->first()->total ?? 0);

        $totalSum = $sales + $expenses + $salaries + $gas;
        $salesPct = $totalSum > 0 ? number_format(($sales / $totalSum) * 100, 1) : '0.0';
        $expPct = $totalSum > 0 ? number_format(($expenses / $totalSum) * 100, 1) : '0.0';
        $salPct = $totalSum > 0 ? number_format(($salaries / $totalSum) * 100, 1) : '0.0';
        $gasPct = $totalSum > 0 ? number_format(($gas / $totalSum) * 100, 1) : '0.0';

        $formattedPeriod = $startDate->format('d M Y');
        if ($type === 'monthly') {
            $formattedPeriod = $startDate->format('F Y');
        } elseif ($type === 'yearly') {
            $formattedPeriod = $startDate->format('Y');
        }

        return response()->json([
            'sales' => $sales,
            'sales_formatted' => number_format($sales, 3),
            'sales_pct' => $salesPct,

            'expenses' => $expenses,
            'expenses_formatted' => number_format($expenses, 3),
            'expenses_pct' => $expPct,

            'salaries' => $salaries,
            'salaries_formatted' => number_format($salaries, 3),
            'salaries_pct' => $salPct,

            'profit' => $profit,
            'profit_formatted' => number_format($profit, 3),

            'gas' => $gas,
            'gas_formatted' => number_format($gas, 3),
            'gas_pct' => $gasPct,

            'formatted_period' => $formattedPeriod
        ]);
    }
}
