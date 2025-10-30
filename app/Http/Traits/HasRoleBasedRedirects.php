<?php

namespace App\Http\Traits;

use App\Providers\RouteServiceProvider;

trait HasRoleBasedRedirects
{
    /**
     * Get the role-based redirect response.
     *
     * @param \App\Models\User $user
     * @param bool $verified
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function getRedirectForRole($user, $verified = false)
    {
        $redirects = [
            'admin' => RouteServiceProvider::ADMIN_HOME,
            'officer' => RouteServiceProvider::OFFICER_HOME,
            'student' => RouteServiceProvider::HOME,
        ];

        $path = $redirects[$user->role] ?? RouteServiceProvider::HOME;

        if ($verified) {
            $path .= '?verified=1';
        }

        return redirect()->intended($path);
    }
}
