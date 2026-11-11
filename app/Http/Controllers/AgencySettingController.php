<?php

namespace App\Http\Controllers;

use App\Models\AgencySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AgencySettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:agency-setting-list', ['only' => ['index']]);
        $this->middleware('permission:agency-setting-edit', ['only' => ['update']]);
    }

    /**
     * Display the agency settings form.
     */
    public function index()
    {
        $agencyId = Auth::user()->agency_id;
        $setting = AgencySetting::firstOrCreate(['agency_id' => $agencyId]);

        return view('agency_settings.index', compact('setting'));
    }

    /**
     * Update the agency settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'letterhead' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB
            'is_letterhead_active' => 'nullable|in:0,1',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB for logo
            'top_margin' => 'required|integer|min:0|max:500',
            'bottom_margin' => 'required|integer|min:0|max:500',
        ]);

        $agencyId = Auth::user()->agency_id;
        $setting = AgencySetting::where('agency_id', $agencyId)->first();

        $setting->top_margin = $request->top_margin;
        $setting->bottom_margin = $request->bottom_margin;
        $setting->is_letterhead_active = $request->has('is_letterhead_active') ? (bool)$request->is_letterhead_active : false;

        if ($request->hasFile('letterhead')) {
            // Delete old image if exists
            if ($setting->letterhead && Storage::disk('public')->exists($setting->letterhead)) {
                Storage::disk('public')->delete($setting->letterhead);
            }

            // Store new image
            $path = $request->file('letterhead')->store('letterheads', 'public');
            $setting->letterhead = $path;
        }

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                Storage::disk('public')->delete($setting->logo);
            }

            // Store new logo
            $logoPath = $request->file('logo')->store('logos', 'public');
            $setting->logo = $logoPath;
        }

        $setting->save();

        return redirect()->back()->with('success', 'Agency settings updated successfully.');
    }
}
