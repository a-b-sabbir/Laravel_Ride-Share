<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPilotStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $pilot = Auth::user();  // Get the currently authenticated user (pilot)

        // Check if the user is a pilot
        if ($pilot) {
            if ($pilot->pilot->account_status == 'Suspended') {
                return redirect()->route('login')->with('error', 'Your account is Suspended. Please contact support.');
            }

            if ($pilot->pilot->account_status == 'Deactivated') {
                return redirect()->route('login')->with('error', 'Your account is Deactivated. Please contact support.');
            }

            if ($pilot->pilot->account_status == 'Active') {
                return $next($request);
            }
        }

        // Default case (if user is not a pilot or account status is not 'Active')
        return redirect()->route('login')->with('error', 'Your account status is invalid.');
    }
}
