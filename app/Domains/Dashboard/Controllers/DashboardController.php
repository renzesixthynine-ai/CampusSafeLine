<?php

declare(strict_types=1);

namespace App\Domains\Dashboard\Controllers;

use App\Domains\Dashboard\Services\DashboardService;
use App\Domains\Users\Enums\UserRole;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(
        private readonly DashboardService $dashboardService,
    ) {}
    public function __invoke(): View
    {
        return match(Auth::user()?->role) {
            UserRole::ADMIN => $this->adminDashboard(),
            UserRole::OFFICER => $this->officerDashboard(),
            default => $this->reporterDashboard(),
        };
    }

    private function adminDashboard(): View
    {
        return view('dashboard.admin', [
            'statistics' => $this->dashboardService->getAdminStatistics(),
            'recentReports' => $this->dashboardService->getRecentReports(),
            'officerPerformance' => $this->dashboardService->getOfficerPerformance(),
        ]);
    }

    private function officerDashboard(): View
    {
        return view('dashboard.officer', [
            'assignedCases' => $this->dashboardService->getAssignedCases(),
            'pendingReviews' => $this->dashboardService->getPendingReviews(),
            'resolvedCases' => $this->dashboardService->getResolvedCases(),
        ]);
    }

    private function reporterDashboard(): View
    {
        return view('dashboard.reporter', [
            'myReports' => $this->dashboardService->getUserReports(),
            'notifications' => $this->dashboardService->getUserNotifications(),
            'statistics' => $this->dashboardService->getUserStatistics(),
        ]);
    }
}
