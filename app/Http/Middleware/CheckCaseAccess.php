<?php

namespace App\Http\Middleware;

use App\Models\CaseReport;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCaseAccess
{
    /**
     * Handle access to case details.
     */
    public function handle(Request $request, Closure $next)
    {
        $case_id = $request->route('case_id');

        // Allow authenticated officers and admins
        if (Auth::check() && in_array(Auth::user()->role, ['officer', 'admin'])) {
            return $next($request);
        }

        // Check session-based access for reporters
        if (!session('case_access.' . $case_id)) {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
