<?php

declare(strict_types=1);

namespace App\Domains\Reports\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evidence extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'case_report_id',
        'original_name',
        'mime_type',
        'file_size',
        'file_hash',
        'file_path',
    ];

    protected $casts = [
        'file_size' => 'integer',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class, 'case_report_id');
    }
}