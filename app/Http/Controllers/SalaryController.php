<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use Illuminate\Http\Request;
use App\Models\TeamMember;
use App\Models\AgencySetting;
use Barryvdh\DomPDF\Facade\Pdf;

class SalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:salary-list', ['only' => ['index', 'show', 'downloadPdf']]);
        $this->middleware('permission:salary-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:salary-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:salary-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $query = Salary::with('teamMember');

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('date', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('date', '<=', $request->end_date);
        }
        
        if ($request->has('team_member_id') && $request->team_member_id != '') {
            $query->where('team_member_id', $request->team_member_id);
        }

        $perPage = $request->input('per_page', 20);
        $salaries = $query->latest()->paginate($perPage)->withQueryString();
        $teamMembers = TeamMember::all();

        return view('salaries.index', compact('salaries', 'teamMembers'));
    }

    public function create()
    {
        $teamMembers = TeamMember::all();
        return view('salaries.create', compact('teamMembers'));
    }

    public function checkMonthPaid(Request $request)
    {
        $memberId = $request->query('team_member_id');
        $date = $request->query('date', now()->toDateString());
        $excludeId = $request->query('exclude_id');

        if (!$memberId || !$date) {
            return response()->json(['paid' => false]);
        }

        $carbonDate = \Carbon\Carbon::parse($date);
        $year = $carbonDate->year;
        $month = $carbonDate->month;

        $query = Salary::where('team_member_id', $memberId)
            ->whereYear('date', $year)
            ->whereMonth('date', $month);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        $existing = $query->first();

        if ($existing) {
            $member = TeamMember::find($memberId);
            $monthName = $carbonDate->translatedFormat('F Y');
            return response()->json([
                'paid' => true,
                'salary_id' => $existing->id,
                'paid_date' => $existing->date,
                'amount' => number_format($existing->amount, 3),
                'member_name' => $member?->name ?? '',
                'month_name' => $monthName,
                'message' => __('messages.salary_already_paid_month', [
                    'member' => $member?->name ?? '',
                    'month' => $monthName
                ])
            ]);
        }

        return response()->json(['paid' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_member_id' => 'required|exists:team_members,id',
            'amount' => 'required|numeric',
            'bonus' => 'nullable|numeric',
            'date' => 'required|date',
            'salary_slip' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'note' => 'nullable|string',
        ]);

        $carbonDate = \Carbon\Carbon::parse($request->date);
        $existing = Salary::where('team_member_id', $request->team_member_id)
            ->whereYear('date', $carbonDate->year)
            ->whereMonth('date', $carbonDate->month)
            ->first();

        if ($existing) {
            $member = TeamMember::find($request->team_member_id);
            $monthName = $carbonDate->translatedFormat('F Y');
            return redirect()->back()
                ->withInput()
                ->with('error', __('messages.salary_already_paid_month', [
                    'member' => $member?->name ?? '',
                    'month' => $monthName
                ]));
        }

        $input = $request->all();
        $input['bonus'] = $input['bonus'] ?? 0;

        if ($request->hasFile('salary_slip')) {
            $input['salary_slip'] = $request->file('salary_slip')->store('salary_slips', 'public');
        }

        Salary::create($input);

        return redirect()->route('salaries.index')
                        ->with('success', 'Salary recorded successfully.');
    }

    public function show(Salary $salary)
    {
        return view('salaries.show', compact('salary'));
    }

    public function edit(Salary $salary)
    {
        $teamMembers = TeamMember::all();
        return view('salaries.edit', compact('salary', 'teamMembers'));
    }

    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'team_member_id' => 'required|exists:team_members,id',
            'amount' => 'required|numeric',
            'bonus' => 'nullable|numeric',
            'date' => 'required|date',
            'salary_slip' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'note' => 'nullable|string',
        ]);

        $carbonDate = \Carbon\Carbon::parse($request->date);
        $existing = Salary::where('team_member_id', $request->team_member_id)
            ->where('id', '!=', $salary->id)
            ->whereYear('date', $carbonDate->year)
            ->whereMonth('date', $carbonDate->month)
            ->first();

        if ($existing) {
            $member = TeamMember::find($request->team_member_id);
            $monthName = $carbonDate->translatedFormat('F Y');
            return redirect()->back()
                ->withInput()
                ->with('error', __('messages.salary_already_paid_month', [
                    'member' => $member?->name ?? '',
                    'month' => $monthName
                ]));
        }

        $input = $request->all();
        $input['bonus'] = $input['bonus'] ?? 0;

        if ($request->hasFile('salary_slip')) {
            $input['salary_slip'] = $request->file('salary_slip')->store('salary_slips', 'public');
        }

        $salary->update($input);

        return redirect()->route('salaries.index')
                        ->with('success', 'Salary updated successfully');
    }

    public function destroy(Salary $salary)
    {
        $salary->delete();

        return redirect()->route('salaries.index')
                        ->with('success', 'Salary deleted successfully');
    }

    public function downloadPdf(Request $request)
    {
        $query = Salary::with('teamMember');

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('date', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('date', '<=', $request->end_date);
        }
        
        if ($request->has('team_member_id') && $request->team_member_id != '') {
            $query->where('team_member_id', $request->team_member_id);
        }

        $salaries = $query->orderBy('date', 'desc')->get();
        $agencyId = auth()->user()->agency_id ?? null;
        $setting = $agencyId ? AgencySetting::where('agency_id', $agencyId)->first() : null;
        
        $pdf = Pdf::loadView('salaries.pdf', compact('salaries', 'setting'));
        return $pdf->download('salary_report.pdf');
    }
}
