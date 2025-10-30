<?php

declare(strict_types=1);

namespace App\Domains\Dashboard\Services;

use App\Domains\Reports\Enums\ReportStatus;
use App\Domains\Reports\Models\Report;
use App\Domains\Users\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class DashboardService
{
    public function getAdminStatistics(): array
    {
        return Cache::remember('admin.statistics', now()->addMinutes(15), function () {
            return [
                'total_reports' => Report::count(),
                'pending_reports' => Report::where('status', ReportStatus::NEW)->count(),
                'in_progress' => Report::where('status', ReportStatus::IN_PROGRESS)->count(),
                'resolved' => Report::where('status', ReportStatus::RESOLVED)->count(),
                'officers' => User::where('role', 'officer')->count(),
            ];
        });
    }

    public function getRecentReports(int $limit = 5): Collection
    {
        return Report::with(['reporter', 'assignedOfficer'])
            ->latest()
            ->take($limit)
            ->get();
    }

    public function getOfficerPerformance(): Collection
    {
        return Cache::remember('officer.performance', now()->addHours(1), function () {
            return DB::table('users')
                ->join('case_reports', 'users.id', '=', 'case_reports.assigned_officer_id')
                ->select(
                    'users.name',
                    DB::raw('COUNT(*) as total_cases'),
                    DB::raw('SUM(CASE WHEN status = "resolved" THEN 1 ELSE 0 END) as resolved_cases'),
                    DB::raw('AVG(CASE WHEN status = "resolved"
                        THEN TIMESTAMPDIFF(HOUR, created_at, updated_at)
                        ELSE NULL END) as avg_resolution_time')
                )
                ->where('users.role', 'officer')
                ->groupBy('users.id', 'users.name')
                ->get();
        });
    }
    public function getAssignedCases(): LengthAwarePaginator
    {
        return Report::with(['reporter'])
            ->where('assigned_officer_id', Auth::id())
            ->whereIn('status', [ReportStatus::NEW, ReportStatus::IN_PROGRESS])
            ->latest()
            ->paginate(10);
    }

    public function getPendingReviews(): Collection
    {
        return Report::with(['reporter'])
            ->where('status', ReportStatus::NEW)
            ->whereNull('assigned_officer_id')
            ->latest()
            ->take(5)
            ->get();
    }
    public function getResolvedCases(): Collection
    {
        return Report::with(['reporter'])
            ->where('assigned_officer_id', Auth::id())
            ->where('status', ReportStatus::RESOLVED)
            ->latest()
            ->take(5)
            ->get();
    }
    public function getUserReports(): LengthAwarePaginator
    {
        return Report::where('reporter_id', Auth::id())
            ->with(['assignedOfficer'])
            ->latest()
            ->paginate(10);
    }

    public function getUserNotifications(): Collection
    {
        $userId = Auth::id();
        if (! $userId) {
            return collect();
        }

        return DatabaseNotification::where('notifiable_type', User::class)
            ->where('notifiable_id', $userId)
            ->latest()
            ->take(5)
            ->get();
    }

    public function getUserStatistics(): array
    {
        $userId = Auth::id();

        return Cache::remember("user.{$userId}.statistics", now()->addMinutes(15), function () use ($userId) {
            return [
                'total_reports' => Report::where('reporter_id', $userId)->count(),
                'in_progress' => Report::where('reporter_id', $userId)
                    ->where('status', ReportStatus::IN_PROGRESS)
                    ->count(),
                'resolved' => Report::where('reporter_id', $userId)
                    ->where('status', ReportStatus::RESOLVED)
                    ->count(),
            ];
        });
    }
}
