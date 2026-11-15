<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\TeamMember;
use App\Models\AgencySetting;
use Barryvdh\DomPDF\Facade\Pdf;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:attendance-list', ['only' => ['index', 'show', 'downloadPdf']]);
        $this->middleware('permission:attendance-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:attendance-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:attendance-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $query = Attendance::with('teamMember');

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('date', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('date', '<=', $request->end_date);
        }
        
        if ($request->has('team_member_id') && $request->team_member_id != '') {
            $query->where('team_member_id', $request->team_member_id);
        }

        $attendances = $query->latest()->paginate(20)->withQueryString();
        $teamMembers = TeamMember::all();

        // Attendance stats for today
        $today = now()->toDateString();
        $todayPresent = Attendance::whereDate('date', $today)->where('status', 'present')->count();
        $todayAbsent  = Attendance::whereDate('date', $today)->where('status', 'absent')->count();
        $todayLeave   = Attendance::whereDate('date', $today)->where('status', 'leave')->count();
        $totalRecordedToday = Attendance::whereDate('date', $today)->count();
        
        return view('attendances.index', compact('attendances', 'teamMembers', 'todayPresent', 'todayAbsent', 'todayLeave', 'totalRecordedToday'));
    }

    public function create()
    {
        $teamMembers = TeamMember::all();
        return view('attendances.create', compact('teamMembers'));
    }

    public function checkDateRecorded(Request $request)
    {
        $memberId = $request->query('team_member_id');
        $date = $request->query('date', now()->toDateString());
        $excludeId = $request->query('exclude_id');

        if (!$memberId || !$date) {
            return response()->json(['recorded' => false]);
        }

        $dateStr = \Carbon\Carbon::parse($date)->toDateString();

        $query = Attendance::where('team_member_id', $memberId)
            ->whereDate('date', $dateStr);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        $existing = $query->first();

        if ($existing) {
            $member = TeamMember::find($memberId);
            $formattedDate = \Carbon\Carbon::parse($dateStr)->format('d M Y');
            $statusLabel = __('messages.' . $existing->status);
            return response()->json([
                'recorded' => true,
                'attendance_id' => $existing->id,
                'status' => $existing->status,
                'status_label' => $statusLabel,
                'member_name' => $member?->name ?? '',
                'date' => $formattedDate,
                'message' => __('messages.attendance_already_recorded', [
                    'member' => $member?->name ?? '',
                    'date' => $formattedDate,
                    'status' => $statusLabel
                ])
            ]);
        }

        return response()->json(['recorded' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_member_id' => 'required|exists:team_members,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,leave',
            'note' => 'nullable|string',
        ]);

        $dateStr = \Carbon\Carbon::parse($request->date)->toDateString();
        $existing = Attendance::where('team_member_id', $request->team_member_id)
            ->whereDate('date', $dateStr)
            ->first();

        if ($existing) {
            $member = TeamMember::find($request->team_member_id);
            $formattedDate = \Carbon\Carbon::parse($dateStr)->format('d M Y');
            $statusLabel = __('messages.' . $existing->status);
            return redirect()->back()
                ->withInput()
                ->with('error', __('messages.attendance_already_recorded', [
                    'member' => $member?->name ?? '',
                    'date' => $formattedDate,
                    'status' => $statusLabel
                ]));
        }

        Attendance::create($request->all());

        return redirect()->route('attendances.index')
                        ->with('success', 'Attendance recorded successfully.');
    }

    public function show(Attendance $attendance)
    {
        return view('attendances.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $teamMembers = TeamMember::all();
        return view('attendances.edit', compact('attendance', 'teamMembers'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'team_member_id' => 'required|exists:team_members,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,leave',
            'note' => 'nullable|string',
        ]);

        $dateStr = \Carbon\Carbon::parse($request->date)->toDateString();
        $existing = Attendance::where('team_member_id', $request->team_member_id)
            ->where('id', '!=', $attendance->id)
            ->whereDate('date', $dateStr)
            ->first();

        if ($existing) {
            $member = TeamMember::find($request->team_member_id);
            $formattedDate = \Carbon\Carbon::parse($dateStr)->format('d M Y');
            $statusLabel = __('messages.' . $existing->status);
            return redirect()->back()
                ->withInput()
                ->with('error', __('messages.attendance_already_recorded', [
                    'member' => $member?->name ?? '',
                    'date' => $formattedDate,
                    'status' => $statusLabel
                ]));
        }

        $attendance->update($request->all());

        return redirect()->route('attendances.index')
                        ->with('success', 'Attendance updated successfully');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendances.index')
                        ->with('success', 'Attendance deleted successfully');
    }

    public function downloadPdf(Request $request)
    {
         $query = Attendance::with('teamMember');

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('date', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('date', '<=', $request->end_date);
        }
        
        if ($request->has('team_member_id') && $request->team_member_id != '') {
             $query->where('team_member_id', $request->team_member_id);
        }

        $attendances = $query->orderBy('date', 'desc')->get();
        $agencyId = auth()->user()->agency_id ?? null;
        $setting = $agencyId ? AgencySetting::where('agency_id', $agencyId)->first() : null;
        
        $pdf = Pdf::loadView('attendances.pdf', compact('attendances', 'setting'));
        return $pdf->download('attendance_report.pdf');
    }
}
