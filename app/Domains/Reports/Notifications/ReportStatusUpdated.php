<?php

declare(strict_types=1);

namespace App\Domains\Reports\Notifications;

use App\Domains\Reports\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class ReportStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly Report $report,
        private readonly string $previousStatus,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Case Report {$this->report->case_id} Status Updated")
            ->line("Your case report status has been updated from {$this->previousStatus} to {$this->report->status->label()}.")
            ->line("Current Status: {$this->report->status->label()}")
            ->action('View Report', route('reports.show', $this->report->case_id))
            ->line('Thank you for using our application!');
    }
    public function toArray(object $notifiable): array
    {
        return [
            'case_id' => $this->report->case_id,
            'previous_status' => $this->previousStatus,
            'new_status' => $this->report->status->value,
            'updated_by' => Auth::id(),
        ];
    }

}
