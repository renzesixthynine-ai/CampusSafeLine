<?php

namespace App\Http\Controllers\Reporter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Show the form for creating a new report.
     */
    public function create()
    {
        return view('reporter.submit-report');
    }

    /**
     * Store a newly created report in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'category' => 'required|string',
            'witness' => 'nullable|string',
            'evidence' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048'
        ]);

        // TODO: Store the report in the database
        // For now, just redirect back with success message

        return redirect()->route('report.track')
            ->with('success', 'Report submitted successfully. You can track its status here.');
    }
}
