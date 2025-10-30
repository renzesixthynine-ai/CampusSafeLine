<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Evidence extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'case_report_id',
        'file_path',
        'original_name',
        'mime_type',
        'file_size'
    ];

    // Relationships
    public function case()
    {
        return $this->belongsTo(CaseReport::class, 'case_report_id');
    }

    // Helper Methods
    public function getDownloadUrl()
    {
        return route('evidence.download', [
            'case_id' => $this->case_report_id,
            'evidence' => $this->id
        ]);
    }    // Methods
    public function delete()
    {
        // Delete the actual file before deleting the record
        Storage::disk('private')->delete($this->file_path);
        return parent::delete();
    }
}
