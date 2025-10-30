<?php

declare(strict_types=1);

namespace App\Domains\Users\Models;

use App\Domains\Reports\Models\Report;
use App\Domains\Users\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => UserRole::class,
    ];

    public function submittedReports(): HasMany
    {
        return $this->hasMany(Report::class, 'reporter_id');
    }

    public function assignedReports(): HasMany
    {
        return $this->hasMany(Report::class, 'assigned_officer_id');
    }

    public function isOfficer(): bool
    {
        return $this->role === UserRole::OFFICER;
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRole::ADMIN;
    }
}