<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\View\View;

class ReporterNotificationController extends Controller
{
    /**
     * Display all notifications for the reporter.
     */
    public function index(): \Illuminate\View\View
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('reporter.notifications', compact('notifications'));
    }
}
