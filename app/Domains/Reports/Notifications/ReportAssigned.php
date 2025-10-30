<?php

declare(strict_types=1);

namespace App\Domains\Reports\Notifications;

use App\Domains\Reports\Models\Report;
use App\Domains\Users\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportAssigned extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly Report $report,
        private readonly User $officer,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("New Case Report Assigned: {$this->report->case_id}")
            ->line("You have been assigned to case report {$this->report->case_id}.")
            ->line("Category: {$this->report->category}")
            ->line("Status: {$this->report->status->label()}")
            ->action('View Report', route('reports.show', $this->report->case_id))
            ->line('Please review and take appropriate action.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'case_id' => $this->report->case_id,
            'officer_id' => $this->officer->id,
            'category' => $this->report->category,
            'assigned_at' => now(),
        ];
    }
}
