<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    /**
     * Determine if the user can access reporter features
     */
    public function reporter(User $user): bool
    {
        return $user->role === 'reporter';
    }

    /**
     * Determine if the user can access officer features
     */
    public function officer(User $user): bool
    {
        return $user->role === 'officer';
    }

    /**
     * Determine if the user can access admin features
     */
    public function admin(User $user): bool
    {
        return $user->role === 'admin';
    }
}