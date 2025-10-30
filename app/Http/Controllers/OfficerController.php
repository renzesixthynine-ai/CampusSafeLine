<?php

namespace App\Http\Controllers;

use App\Models\CaseReport;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OfficerController extends Controller
{
    /**
     * Officer dashboard with summary statistics.
     */
    public function dashboard()
    {
        $stats = [
            'new_cases' => CaseReport::where('status', 'new')->count(),
            'in_progress' => CaseReport::where('status', 'in_progress')
                ->where('assigned_officer_id', Auth::id())
                ->count(),
            'resolved_this_month' => CaseReport::where('status', 'resolved')
                ->where('assigned_officer_id', Auth::id())
                ->whereMonth('updated_at', now()->month)
                ->count(),
        ];

        $recent_cases = CaseReport::where('assigned_officer_id', Auth::id())
            ->with('messages')
            ->latest()
            ->take(5)
            ->get();

        return view('officer.dashboard', compact('stats', 'recent_cases'));
    }

    /**
     * List all cases with filtering options.
     */
    public function cases(Request $request)
    {
        $query = CaseReport::query();

        // Apply filters
        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->assigned_to_me) {
            $query->where('assigned_officer_id', Auth::id());
        }

        $cases = $query->latest()
            ->paginate(20)
            ->withQueryString();

        return view('officer.cases', compact('cases'));
    }

    /**
     * Show detailed case view for officers.
     */
    public function showCase(CaseReport $case)
    {
        $case->load(['messages', 'evidence', 'reporter', 'assignedOfficer']);

        return view('officer.case-detail', compact('case'));
    }

    /**
     * Update case details and status.
     */
    public function updateCase(Request $request, CaseReport $case)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,in_progress,resolved,closed',
            'internal_notes' => 'nullable|string|max:10000',
        ]);

        // Start transaction
        DB::beginTransaction();
        try {
            $case->update($validated);

            // If status changed, log it as an internal message
            if ($case->isDirty('status')) {
                Message::create([
                    'case_report_id' => $case->id,
                    'sender_id' => Auth::id(),
                    'message' => "Status updated to: {$case->status}",
                    'is_internal' => true,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to update case.']);
        }

        return back()->with('success', 'Case updated successfully.');
    }

    /**
     * Show officer's message inbox.
     */
    public function messages()
    {
        $messages = Message::whereHas('case', function ($query) {
            $query->where('assigned_officer_id', Auth::id());
        })
        ->with('case')
        ->latest()
        ->paginate(50);

        return view('officer.messages', compact('messages'));
    }
}
