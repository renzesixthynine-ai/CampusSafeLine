<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        $user = Auth::user();

        // Hardcoded credentials for officer and admin
        if ($user->email === 'admin@example.com' && $request->input('password') === 'admin123') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->email === 'officer@example.com' && $request->input('password') === 'officer123') {
            return redirect()->route('officer.dashboard');
        }
        // Default: reporter
        $role = Auth::user()->role;
        return redirect()->route($role === 'admin' ? 'admin.dashboard' :
            ($role === 'officer' ? 'officer.dashboard' : 'reporter.dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
