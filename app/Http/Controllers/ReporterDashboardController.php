<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CaseReport;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReporterDashboardController extends Controller
{
    /**
     * Display the reporter dashboard.
     */
    public function index(): \Illuminate\View\View
    {
        $user = Auth::user();

        $cases = CaseReport::with('officer')
            ->where('reporter_id', $user->id)
            ->latest()
            ->get();

        // Fetch notifications for the authenticated reporter
        $notifications = Notification::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('reporter.dashboard', compact('user', 'cases', 'notifications'));
    }

    /**
     * Show a specific case for the reporter.
     */
    public function viewCase(int $id): \Illuminate\View\View
    {
        $case = CaseReport::with(['messages', 'evidences', 'officer'])
            ->where('id', $id)
            ->where('reporter_id', Auth::id())
            ->firstOrFail();

        return view('reporter.view-case', compact('case'));
    }
}
