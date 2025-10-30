<?php

declare(strict_types=1);

namespace App\Domains\Reports\Enums;

enum ReportStatus: string
{
    case NEW = 'new';
    case IN_PROGRESS = 'in_progress';
    case RESOLVED = 'resolved';
    case CLOSED = 'closed';

    public function label(): string
    {
        return match($this) {
            self::NEW => 'New',
            self::IN_PROGRESS => 'In Progress',
            self::RESOLVED => 'Resolved',
            self::CLOSED => 'Closed',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::NEW => 'text-blue-600 bg-blue-100',
            self::IN_PROGRESS => 'text-yellow-600 bg-yellow-100',
            self::RESOLVED => 'text-green-600 bg-green-100',
            self::CLOSED => 'text-gray-600 bg-gray-100',
        };
    }
}
