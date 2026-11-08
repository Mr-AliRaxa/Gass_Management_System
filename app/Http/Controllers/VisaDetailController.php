<?php

namespace App\Http\Controllers;

use App\Models\VisaDetail;
use Illuminate\Http\Request;
use App\Models\TeamMember;
use App\Models\AgencySetting;
use Barryvdh\DomPDF\Facade\Pdf;

class VisaDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:visa-detail-list', ['only' => ['index', 'show', 'downloadPdf']]);
        $this->middleware('permission:visa-detail-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:visa-detail-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:visa-detail-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $visaDetails = VisaDetail::with('teamMember')->latest()->paginate($perPage)->withQueryString();
        return view('visa_details.index', compact('visaDetails'));
    }

    public function create()
    {
        $teamMembers = TeamMember::all();
        return view('visa_details.create', compact('teamMembers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_member_id' => 'required|exists:team_members,id',
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date|after:issue_date',
        ]);

        VisaDetail::create($request->all());

        return redirect()->route('visa_details.index')
                        ->with('success', 'Visa Detail recorded successfully.');
    }

    public function show(VisaDetail $visaDetail)
    {
        return view('visa_details.show', compact('visaDetail'));
    }

    public function edit(VisaDetail $visaDetail)
    {
        $teamMembers = TeamMember::all();
        return view('visa_details.edit', compact('visaDetail', 'teamMembers'));
    }

    public function update(Request $request, VisaDetail $visaDetail)
    {
        $request->validate([
            'team_member_id' => 'required|exists:team_members,id',
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date|after:issue_date',
        ]);

        $visaDetail->update($request->all());

        return redirect()->route('visa_details.index')
                        ->with('success', 'Visa Detail updated successfully');
    }

    public function destroy(VisaDetail $visaDetail)
    {
        $visaDetail->delete();

        return redirect()->route('visa_details.index')
                        ->with('success', 'Visa Detail deleted successfully');
    }

    public function downloadPdf()
    {
        $visaDetails = VisaDetail::with('teamMember')->orderBy('expiry_date', 'asc')->get();
        $agencyId = auth()->user()->agency_id ?? null;
        $setting = $agencyId ? AgencySetting::where('agency_id', $agencyId)->first() : null;

        $pdf = Pdf::loadView('visa_details.pdf', compact('visaDetails', 'setting'));
        return $pdf->download('visa_expiry_report.pdf');
    }
}
