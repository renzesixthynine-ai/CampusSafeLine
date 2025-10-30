<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'case_report_id',
        'sender_id',
        'message',
        'is_internal',
        'read_at'
    ];

    protected $casts = [
        'is_internal' => 'boolean',
        'read_at' => 'datetime'
    ];

    // Relationships
    public function case()
    {
        return $this->belongsTo(CaseReport::class, 'case_report_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Scopes
    public function scopePublic($query)
    {
        return $query->where('is_internal', false);
    }

    public function scopeInternal($query)
    {
        return $query->where('is_internal', true);
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }
}
