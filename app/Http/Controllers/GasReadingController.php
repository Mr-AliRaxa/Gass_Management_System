<?php

namespace App\Http\Controllers;

use App\Models\GasReading;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class GasReadingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:gas-reading-list', ['only' => ['index', 'show', 'downloadPdf']]);
        $this->middleware('permission:gas-reading-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:gas-reading-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:gas-reading-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $query = GasReading::query();

        if ($request->has('date') && $request->date != '') {
            $query->whereDate('date', $request->date);
        }

        if ($request->has('from_date') && $request->from_date != '') {
            $query->whereDate('date', '>=', $request->from_date);
        }

        if ($request->has('to_date') && $request->to_date != '') {
            $query->whereDate('date', '<=', $request->to_date);
        }

        $perPage = $request->input('per_page', 10);
        $gasReadings = $query->latest()->paginate($perPage)->withQueryString();
        return view('gas_readings.index', compact('gasReadings'));
    }

    public function create()
    {
        return view('gas_readings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'start_reading' => 'required|numeric',
            'start_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'end_reading' => 'required|numeric',
            'end_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('start_image')) {
            $input['start_image'] = $request->file('start_image')->store('gas_readings', 'public');
        }
        if ($request->hasFile('end_image')) {
            $input['end_image'] = $request->file('end_image')->store('gas_readings', 'public');
        }

        GasReading::create($input);

        return redirect()->route('gas_readings.index')
                        ->with('success', 'Gas Reading recorded successfully.');
    }

    public function show(GasReading $gasReading)
    {
        return view('gas_readings.show', compact('gasReading'));
    }

    public function edit(GasReading $gasReading)
    {
        return view('gas_readings.edit', compact('gasReading'));
    }

    public function update(Request $request, GasReading $gasReading)
    {
        $request->validate([
            'date' => 'required|date',
            'start_reading' => 'required|numeric',
            'start_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'end_reading' => 'required|numeric',
            'end_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('start_image')) {
            $input['start_image'] = $request->file('start_image')->store('gas_readings', 'public');
        }
        if ($request->hasFile('end_image')) {
            $input['end_image'] = $request->file('end_image')->store('gas_readings', 'public');
        }

        $gasReading->update($input);

        return redirect()->route('gas_readings.index')
                        ->with('success', 'Gas Reading updated successfully');
    }

    public function destroy(GasReading $gasReading)
    {
        $gasReading->delete();

        return redirect()->route('gas_readings.index')
                        ->with('success', 'Gas Reading deleted successfully');
    }

    public function downloadPdf(Request $request)
    {
        $query = GasReading::query();

        if ($request->has('date') && $request->date != '') {
            $query->whereDate('date', $request->date);
        }

        if ($request->has('from_date') && $request->from_date != '') {
            $query->whereDate('date', '>=', $request->from_date);
        }

        if ($request->has('to_date') && $request->to_date != '') {
            $query->whereDate('date', '<=', $request->to_date);
        }

        $gasReadings = $query->orderBy('date', 'asc')->get();

        // Calculate total consumption for the filtered set
        $totalConsumption = $gasReadings->sum(function ($r) {
            return $r->end_reading - $r->start_reading;
        });

        $fromDate = $request->from_date;
        $toDate   = $request->to_date;
        $filterDate = $request->date;

        $pdf = Pdf::loadView('gas_readings.pdf', compact('gasReadings', 'totalConsumption', 'fromDate', 'toDate', 'filterDate'));
        return $pdf->download('gas_reading_report.pdf');
    }
}
