<?php

declare(strict_types=1);

namespace App\Domains\Users\Enums;

enum UserRole: string
{
    case REPORTER = 'reporter';
    case OFFICER = 'officer';
    case ADMIN = 'admin';

    public function label(): string
    {
        return match($this) {
            self::REPORTER => 'Reporter',
            self::OFFICER => 'Safety Officer',
            self::ADMIN => 'Administrator',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::REPORTER => 'text-blue-600',
            self::OFFICER => 'text-green-600',
            self::ADMIN => 'text-purple-600',
        };
    }
}
