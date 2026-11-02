<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAgencyStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->agency_id) {
            $agency = Auth::user()->agency;
            if ($agency && $agency->status !== 'active') {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your agency is inactive. Please contact the administrator.');
            }
        }

        return $next($request);
    }
}
