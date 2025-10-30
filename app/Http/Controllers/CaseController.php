<?php

namespace App\Http\Controllers;

use App\Models\CaseReport;
use App\Models\Message;
use App\Models\Evidence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CaseController extends Controller
{
    /**
     * Check if the current user has access to the specified case.
     */
    protected function hasAccess(string $case_id): bool
    {
        return session('case_access.' . $case_id) ||
            (\Illuminate\Support\Facades\Gate::allows('view', CaseReport::class));
    }

    /**
     * Get case by ID or fail with appropriate message.
     */
    protected function getCaseOrFail(string $case_id): CaseReport
    {
        return CaseReport::where('case_id', $case_id)->firstOr(function () {
            abort(404, 'Case not found.');
        });
    }

    /**
     * Show the case tracking form.
     */
    public function trackForm()
    {
        return view('case.track');
    }

    /**
     * Verify case access credentials and redirect to case view.
     */
    public function access(Request $request)
    {
        $validated = $request->validate([
            'case_id' => 'required|string|exists:case_reports,case_id',
            'pin' => 'required|string',
        ]);

        $case = $this->getCaseOrFail($validated['case_id']);

        if (!$case->verifyPin($validated['pin'])) {
            return back()
                ->withInput($request->only('case_id'))
                ->withErrors(['pin' => 'Invalid PIN provided.']);
        }

        // Store case access in session
        session(['case_access.' . $case->case_id => true]);

        return redirect()
            ->route('case.show', $case->case_id)
            ->with('success', 'Access granted successfully.');
    }

    /**
     * Display the case details.
     */
    public function show(string $case_id)
    {
        if (!$this->hasAccess($case_id)) {
            abort(403, 'You do not have permission to view this case.');
        }

        $case = CaseReport::where('case_id', $case_id)
            ->with(['messages' => function ($query) {
                $query->public()->latest();
            }, 'evidence'])
            ->firstOr(function() {
                abort(404, 'Case not found.');
            });

        return view('case.show', compact('case'));
    }

    /**
     * Store a new message for the case.
     */
    public function storeMessage(Request $request, string $case_id)
    {
        if (!$this->hasAccess($case_id)) {
            abort(403, 'You do not have permission to add messages to this case.');
        }

        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $case = $this->getCaseOrFail($case_id);

        Message::create([
            'case_report_id' => $case->id,
            'message' => $validated['message'],
            'sender_id' => Auth::id(),
            'is_internal' => false
        ]);

        return back()->with('success', 'Message sent successfully.');
    }

    /**
     * Download evidence file securely.
     */
    public function downloadEvidence(string $case_id, Evidence $evidence)
    {
        // Check access
        if (!session('case_access.' . $case_id) && !Auth::check()) {
            abort(403, 'Access denied.');
        }

        $case = $this->getCaseOrFail($case_id);

        // Verify evidence belongs to this case
        if ($evidence->case_report_id !== $case->id) {
            abort(404, 'Evidence not found for this case.');
        }

        try {
            $filePath = Storage::disk('private')->path($evidence->file_path);
            if (!file_exists($filePath)) {
                abort(404, 'Evidence file not found.');
            }
            return response()->download($filePath, $evidence->original_name);
        } catch (\Exception $e) {
            abort(404, 'Evidence file not found.');
    }
}}
