<?php

declare(strict_types=1);

namespace App\Domains\Reports\Services;

use App\Domains\Reports\Models\Evidence;
use App\Domains\Reports\Models\Report;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class EvidenceService
{
    public function storeEvidence(Report $report, UploadedFile $file): Evidence
    {
        $hashedName = $this->generateHashedFilename($file);
        $path = $file->storeAs(
            "evidence/{$report->case_id}",
            $hashedName,
            ['disk' => 'private']
        );

        return Evidence::create([
            'case_report_id' => $report->id,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'file_hash' => hash_file('sha256', $file->path()),
            'file_path' => $path,
        ]);
    }

    public function getSignedUrl(Evidence $evidence, int $expiresInMinutes = 5): string
    {
        return URL::signedRoute('evidence.download', [
            'evidence' => $evidence->id,
        ], now()->addMinutes($expiresInMinutes));
    }

    public function deleteEvidence(Evidence $evidence): bool
    {
        if (Storage::disk('private')->exists($evidence->file_path)) {
            Storage::disk('private')->delete($evidence->file_path);
        }

        return $evidence->delete();
    }

    private function generateHashedFilename(UploadedFile $file): string
    {
        return Str::random(40) . '.' . $file->getClientOriginalExtension();
    }

    public function validateFile(UploadedFile $file): bool
    {
        $maxSize = 2 * 1024 * 1024; // 2MB
        $allowedMimes = [
            'image/jpeg',
            'image/png',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];

        return $file->getSize() <= $maxSize && in_array($file->getMimeType(), $allowedMimes);
    }
}
