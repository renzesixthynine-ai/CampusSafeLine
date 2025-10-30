<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ReporterSettingsController extends Controller
{
    /**
     * Display the settings page.
     *
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        return view('reporter.settings');
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'student_id' => ['required', 'string', 'max:255', 'unique:users,student_id,' . Auth::id()],
        ]);

        /** @var \App\Models\User $user */
        $user = User::find(Auth::id());
        
        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->student_id = $validated['student_id'];
        $user->save();

        return back()->with('status', 'Profile updated successfully.');
    }

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password:web'],
            'password' => ['required', 'confirmed', Password::defaults(), 'different:current_password'],
            'password_confirmation' => ['required'],
        ]);

        /** @var \App\Models\User $user */
        $user = User::find(Auth::id());
        
        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('status', 'Password updated successfully.');
    }
}