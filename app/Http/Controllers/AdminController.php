<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CaseReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Admin dashboard with system overview.
     */
    public function dashboard()
    {
        $stats = [
            'total_cases' => CaseReport::count(),
            'open_cases' => CaseReport::whereIn('status', ['new', 'in_progress'])->count(),
            'total_officers' => User::where('role', 'officer')->count(),
            'cases_this_month' => CaseReport::whereMonth('created_at', now()->month)->count(),
        ];

        $recent_activity = CaseReport::with(['assignedOfficer'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_activity'));
    }

    /**
     * Display user management page.
     */
    public function users()
    {
        $users = User::where('role', '!=', 'reporter')
            ->latest()
            ->paginate(20);

        return view('admin.users', compact('users'));
    }

    /**
     * Show form to create new user.
     */
    public function createUser()
    {
        return view('admin.users.create');
    }

    /**
     * Store a new user.
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'in:officer,admin'],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'phone' => $validated['phone'],
        ]);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show form to edit user.
     */
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user details.
     */
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'role' => ['required', 'in:officer,admin'],
            'phone' => ['nullable', 'string', 'max:20'],
            'is_active' => ['required', 'boolean'],
        ]);

        // Only update password if provided
        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete a user.
     */
    public function destroyUser(User $user)
    {
        // Prevent self-deletion
        if ($user->id === Auth::id()) {
            return back()->withErrors(['error' => 'Cannot delete your own account.']);
        }

        // Start transaction
        DB::beginTransaction();
        try {
            // Reassign cases to null
            CaseReport::where('assigned_officer_id', $user->id)
                ->update(['assigned_officer_id' => null]);

            // Delete the user
            $user->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to delete user.']);
        }

        return redirect()
            ->route('admin.users')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Show system settings page.
     */
    public function settings()
    {
        return view('admin.settings');
    }

    /**
     * Update system settings.
     */
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'contact_email' => ['required', 'email'],
            'emergency_phone' => ['required', 'string', 'max:20'],
            'max_file_size' => ['required', 'integer', 'min:1', 'max:20480'], // KB
            'allowed_file_types' => ['required', 'string'],
        ]);

        // Update settings in database or config
        foreach ($validated as $key => $value) {
            // Store settings in database or config file
            config(["campus_safeline.{$key}" => $value]);
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
