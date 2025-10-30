<?php

declare(strict_types=1);

namespace App\Domains\Reports\Controllers;

use App\Domains\Reports\Requests\StoreReportRequest;
use App\Domains\Reports\Services\ReportService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function __construct(
        private readonly ReportService $reportService,
    ) {}

    public function index(): View
    {
        return view('reports.index', [
            'reports' => $this->reportService->getPaginatedReports(),
        ]);
    }

    public function create(): View
    {
        return view('reports.create');
    }

    public function store(StoreReportRequest $request): RedirectResponse
    {
        $report = $this->reportService->createReport($request->validated());

        return redirect()
            ->route('reports.show', $report)
            ->with('success', 'Report submitted successfully.');
    }

    public function show(string $caseId): View
    {
        $report = $this->reportService->findByCaseId($caseId);

        return view('reports.show', [
            'report' => $report,
            'timeline' => $this->reportService->getReportTimeline($report),
        ]);
    }
}
