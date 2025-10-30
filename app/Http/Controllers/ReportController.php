<?php

namespace App\Http\Controllers;

use App\Models\CaseReport;
use App\Models\Evidence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Show the form for creating a new report.
     */
    public function create()
    {
        return view('report.create');
    }

    /**
     * Store a newly created report in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:10000',
            'location' => 'nullable|string|max:255',
            'incident_date' => 'nullable|date',
        ]);

        // Generate a random 6-digit PIN
        $pin = Str::random(6);

        // Create the case report
        $report = CaseReport::create([
            'category' => $validated['category'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'incident_date' => $validated['incident_date'],
            'pin_hash' => Hash::make($pin),
            'reporter_id' => Auth::check() ? Auth::id() : null, // Will be null for anonymous reports
        ]);

        // Store the case details in session for the next request
        session()->flash('case_id', $report->case_id);
        session()->flash('pin', $pin);

        return redirect()->route('report.success');
    }

    /**
     * Handle evidence upload for a case.
     */
    public function uploadEvidence(Request $request)
    {
        $request->validate([
            'case_id' => 'required|string|exists:case_reports,case_id',
            'pin' => 'required|string',
            'file' => 'required|file|max:10240', // 10MB max
        ]);

        $case = CaseReport::where('case_id', $request->case_id)->firstOrFail();

        // Verify PIN
        if (!$case->verifyPin($request->pin)) {
            return back()->withErrors(['pin' => 'Invalid PIN provided.']);
        }

        // Store the file in private storage
        $file = $request->file('file');
        $path = $file->store("evidence/{$case->case_id}", 'private');

        // Create evidence record
        Evidence::create([
            'case_report_id' => $case->id,
            'file_path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return back()->with('success', 'Evidence uploaded successfully.');
    }
}
