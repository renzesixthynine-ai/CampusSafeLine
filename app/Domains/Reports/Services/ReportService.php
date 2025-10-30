<?php

declare(strict_types=1);

namespace App\Domains\Reports\Services;

use App\Domains\Reports\Models\Report;
use App\Domains\Reports\Models\ReportTimeline;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportService
{
    public function getPaginatedReports(int $perPage = 15): LengthAwarePaginator
    {
        return Report::with(['reporter', 'assignedOfficer'])
            ->latest()
            ->paginate($perPage);
    }

    public function findByCaseId(string $caseId): Report
    {
        return Cache::remember(
            "reports.{$caseId}",
            now()->addMinutes(15),
            fn () => Report::with(['reporter', 'assignedOfficer', 'evidence'])
                ->where('case_id', $caseId)
                ->firstOrFail()
        );
    }

    public function createReport(array $validated): Report
    {
        return DB::transaction(function () use ($validated) {
            $report = Report::create([
                'category' => $validated['category'],
                'description' => $validated['description'],
                'location' => $validated['location'],
                'reporter_id' => Auth::id(),
                'pin_hash' => bcrypt($validated['pin']),
            ]);

            $this->createTimelineEntry($report, 'Report submitted');

            if (isset($validated['evidence'])) {
                $this->handleEvidenceUpload($report, $validated['evidence']);
            }

            return $report;
        });
    }

    public function getReportTimeline(Report $report): Collection
    {
        return Cache::remember(
            "reports.{$report->case_id}.timeline",
            now()->addMinutes(5),
            fn () => $report->timeline()->with(['user'])->get()
        );
    }

    private function createTimelineEntry(Report $report, string $action): void
    {
        ReportTimeline::create([
            'case_report_id' => $report->id,
            'user_id' => Auth::id(),
            'action' => $action,
        ]);

        Cache::forget("reports.{$report->case_id}.timeline");
    }
    public function __construct(
        private readonly EvidenceService $evidenceService,
    ) {}

    private function handleEvidenceUpload(Report $report, array $evidence): void
    {
        foreach ($evidence as $file) {
            if ($file instanceof UploadedFile && $this->evidenceService->validateFile($file)) {
                $this->evidenceService->storeEvidence($report, $file);
            }
        }
    }
}
