<?php

declare(strict_types=1);

namespace App\Domains\Reports\Models;

use App\Domains\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportTimeline extends Model
{
    protected $fillable = [
        'case_report_id',
        'user_id',
        'action',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class, 'case_report_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
