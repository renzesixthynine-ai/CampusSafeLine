<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CaseReport extends Model
{
    use HasFactory, SoftDeletes;

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
        'internal_notes'
    ];

    protected $casts = [
        'incident_date' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($case) {
            // Generate unique case ID if not set
            if (!$case->case_id) {
                $case->case_id = 'CSL-' . date('Y') . '-' . Str::upper(Str::random(8));
            }
        });
    }

    // Relationships
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function assignedOfficer()
    {
        return $this->belongsTo(User::class, 'assigned_officer_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function evidence()
    {
        return $this->hasMany(Evidence::class);
    }

    // Status Methods
    public function isOpen(): bool
    {
        return in_array($this->status, ['new', 'in_progress']);
    }

    public function isClosed(): bool
    {
        return in_array($this->status, ['resolved', 'closed']);
    }

    // PIN Verification
    public function verifyPin(string $pin): bool
    {
        return password_verify($pin, $this->pin_hash);
    }
}
