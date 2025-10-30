<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all reporters
        $reporters = User::where('role', 'reporter')->get();

        foreach ($reporters as $reporter) {
            // Create a welcome notification
            Notification::create([
                'user_id' => $reporter->id,
                'title' => 'Welcome to CampusSafeLine',
                'message' => 'Thank you for registering. You can now submit and track your reports safely.',
                'type' => 'welcome',
                'is_read' => false,
            ]);

            // Create a system notification
            Notification::create([
                'user_id' => $reporter->id,
                'title' => 'System Update',
                'message' => 'New features have been added to help you track your reports more effectively.',
                'type' => 'system',
                'is_read' => false,
            ]);
        }
    }
}
