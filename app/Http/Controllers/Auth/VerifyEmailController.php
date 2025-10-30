<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\HasRoleBasedRedirects;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    use HasRoleBasedRedirects;
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->redirectWithVerified($request->user());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->redirectWithVerified($request->user());
    }

    /**
     * Get the role-based redirect response.
     */
    protected function redirectWithVerified($user)
    {
        $query = '?verified=1';

        if ($user->role === 'admin') {
            return redirect()->intended(RouteServiceProvider::ADMIN_HOME . $query);
        } elseif ($user->role === 'officer') {
            return redirect()->intended(RouteServiceProvider::OFFICER_HOME . $query);
        }

        return redirect()->intended(RouteServiceProvider::HOME . $query);
    }
}
