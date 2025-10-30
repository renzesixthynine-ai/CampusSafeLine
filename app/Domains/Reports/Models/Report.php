<?php

declare(strict_types=1);

namespace App\Domains\Reports\Models;

use App\Domains\Reports\Enums\ReportStatus;
use App\Domains\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'case_reports';

    protected $fillable = [
        'case_id',
        'pin_hash',
        'category',
        'description',
        'location',
        'incident_date',
        'reporter_id',
        'assigned_officer_id',
        'status',
        'internal_notes',
    ];

    protected $casts = [
        'incident_date' => 'datetime',
        'status' => ReportStatus::class,
    ];

    protected $hidden = [
        'pin_hash',
        'internal_notes',
    ];

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function assignedOfficer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_officer_id');
    }

    public function evidence(): HasMany
    {
        return $this->hasMany(Evidence::class, 'case_report_id');
    }

    public function timeline(): HasMany
    {
        return $this->hasMany(ReportTimeline::class, 'case_report_id')->orderByDesc('created_at');
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Report $report) {
            $report->case_id = static::generateUniqueCaseId();
        });
    }

    private static function generateUniqueCaseId(): string
    {
        do {
            $caseId = 'CSL-' . strtoupper(substr(uniqid(), -8));
        } while (static::where('case_id', $caseId)->exists());

        return $caseId;
    }
}
