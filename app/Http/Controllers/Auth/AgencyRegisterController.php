<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AgencyRequest;
use Illuminate\Http\Request;

class AgencyRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.agency_register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'agency_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'email' => 'required|email|unique:agency_requests,email|unique:users,email',
            'phone' => 'required|string|max:20',
            'location' => 'required|string',
            'note' => 'nullable|string',
        ]);

        AgencyRequest::create($request->all());

        return redirect()->route('login')->with('success', 'Data send successfully. Your registration request has been submitted.');
    }
}
